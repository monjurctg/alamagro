<?php
$secret = "MyStrongPassword";
if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    http_response_code(403);
    die("<div style='font-family: Arial, sans-serif; padding: 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; max-width: 600px; margin: 50px auto;'>Access Denied - Invalid or missing key</div>");
}

$publicDir = '/home/tarumuog/public_html';
$gitRepo   = 'https://github.com/monjurctg/alamagro.git';

chdir($publicDir);

function runCommand($cmd, $ignoreError = false) {
    echo "<div style='background: #2d3748; color: #e2e8f0; padding: 10px 15px; border-radius: 5px; margin: 10px 0; font-family: monospace; white-space: pre-wrap;'>";
    echo "<span style='color: #81e6d9'>$</span> <span style='color: #ffd700'>".htmlspecialchars($cmd)."</span>\n";

    $output = [];
    $returnCode = 0;
    exec($cmd . ' 2>&1', $output, $returnCode);

    foreach ($output as $line) {
        echo htmlspecialchars($line) . "\n";
    }

    if ($returnCode !== 0 && !$ignoreError) {
        echo "<span style='color:#fc8181'>⚠ Exit code: $returnCode</span>\n";
    } elseif ($returnCode === 0) {
        echo "<span style='color:#68d391'>✓ Done</span>\n";
    }

    echo "</div>";
    flush();
    return $returnCode;
}

function sectionHeader($title) {
    echo "<h2 style='border-left: 4px solid #667eea; padding-left: 10px; color: #4a5568;'>$title</h2>";
    echo "<p style='color:#718096; font-size:13px; margin-top:-10px;'>⏰ " . date('H:i:s') . "</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚀 Tarulata Deployment</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; line-height: 1.6; color: #333; max-width: 900px; margin: 0 auto; padding: 20px; background: #f5f7fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border-radius: 8px; margin-bottom: 20px; }
        .header h1 { margin: 0 0 5px; font-size: 26px; }
        .header p { margin: 0; opacity: 0.85; font-size: 14px; }
        .container { background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 25px; margin-bottom: 20px; }
        .success { background: #48bb78; color: white; padding: 18px; border-radius: 8px; text-align: center; font-weight: bold; margin-top: 20px; font-size: 18px; }
        .warning { background: #ed8936; color: white; padding: 12px 18px; border-radius: 5px; margin: 8px 0; }
        .info-box { background: #ebf8ff; border: 1px solid #90cdf4; padding: 12px 18px; border-radius: 5px; margin: 12px 0; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚀 Tarulata — Laravel Deployment</h1>
        <p>Server: <?php echo htmlspecialchars($publicDir); ?> &nbsp;|&nbsp; Time: <?php echo date('d M Y, H:i:s'); ?></p>
    </div>

    <div class="container">
        <?php

        // ============================================================
        // STEP 1: GIT — PULL FROM REMOTE
        // ============================================================
        if (!is_dir($publicDir . '/.git')) {

            sectionHeader('① Git — Fresh Repository Setup');
            runCommand("git init");
            runCommand("git remote add origin $gitRepo");
            runCommand("git fetch origin main");
            runCommand("git reset --hard origin/main");

        } else {

            sectionHeader('① Git — Pull Latest Changes');

            // Stash any server-specific local changes (e.g. .env, storage symlinks)
            // so git pull doesn't abort due to conflicts
            echo "<div class='info-box'>ℹ️ Stashing local server changes before pull...</div>";
            runCommand("git stash push -m 'deploy-auto-stash' --include-untracked", true);

            // Now pull cleanly
            $pullCode = runCommand("git pull origin main");

            if ($pullCode !== 0) {
                echo "<div class='warning'>⚠️ git pull failed. Trying fetch + reset...</div>";
                runCommand("git fetch origin main");
                runCommand("git reset --hard origin/main");
            }

            // Restore stashed changes (server .env, local configs, etc.)
            echo "<div class='info-box'>ℹ️ Restoring local server configs from stash...</div>";
            runCommand("git stash pop", true);
        }

        // ============================================================
        // STEP 2: COMPOSER
        // ============================================================
        sectionHeader('② Composer — Install Dependencies');

        // cPanel-এ composer সরাসরি PATH-এ নাও থাকতে পারে। Multiple paths check করি।
        $composerPaths = [
            '/usr/local/bin/composer',
            '/usr/bin/composer',
            '/opt/cpanel/composer/bin/composer',
            $publicDir . '/composer.phar',
            '/home/' . get_current_user() . '/composer.phar',
        ];

        $composerCmd = null;
        foreach ($composerPaths as $path) {
            if (file_exists($path) && is_executable($path)) {
                $composerCmd = $path;
                break;
            }
        }

        // যদি কোথাও না পাওয়া যায় — auto download করো
        if (!$composerCmd) {
            echo "<div class='warning'>⚠️ composer not found. Auto-downloading composer.phar...</div>";
            runCommand("php -r \"copy('https://getcomposer.org/installer', 'composer-setup.php');\"");
            runCommand("php composer-setup.php --quiet");
            runCommand("rm composer-setup.php");
            $composerCmd = 'php ' . $publicDir . '/composer.phar';
        } else {
            echo "<div class='info-box'>✅ Composer found at: <code>" . htmlspecialchars($composerCmd) . "</code></div>";
            // composer.phar হলে php দিয়ে চালাতে হবে
            if (str_ends_with($composerCmd, '.phar')) {
                $composerCmd = 'php ' . $composerCmd;
            }
        }

        runCommand("$composerCmd install --no-dev --optimize-autoloader --no-interaction");

        // ============================================================
        // STEP 3: CACHE CLEAR
        // ============================================================
        sectionHeader('③ Cache — Clear All');
        runCommand("php artisan config:clear");
        runCommand("php artisan cache:clear");
        runCommand("php artisan route:clear");
        runCommand("php artisan view:clear");
        runCommand("php artisan event:clear");

        // ============================================================
        // STEP 4: DATABASE MIGRATION (safe — migrations have hasTable/hasColumn guards)
        // ============================================================
        sectionHeader('④ Database — Run Migrations');
        echo "<div class='info-box'>ℹ️ All migrations have <code>hasTable()</code> / <code>hasColumn()</code> guards — safe on existing DB.</div>";
        $migrateCode = runCommand("php artisan migrate --force");

        if ($migrateCode !== 0) {
            echo "<div class='warning'>⚠️ Some migrations had issues (see above). Running only new migration...</div>";
            runCommand("php artisan migrate --path=database/migrations/2026_08_18_000000_create_product_variations_table.php --force", true);
        }

        // ============================================================
        // STEP 5: OPTIMIZE
        // ============================================================
        sectionHeader('⑤ Optimize — Cache Routes & Config');
        runCommand("php artisan config:cache");
        runCommand("php artisan route:cache");

        // ============================================================
        // STEP 6: PERMISSIONS
        // ============================================================
        sectionHeader('⑥ Permissions');
        runCommand("chmod -R 775 storage");
        runCommand("chmod -R 775 bootstrap/cache");

        ?>

        <div class="success">
            ✅ Deployment Completed — <?php echo date('H:i:s'); ?>
        </div>
    </div>
</body>
</html>
