<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>তরুলতা - বাগান পরিচর্যা সেবা | চট্টগ্রাম</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
            line-height: 1.6;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0f766e 0%, #065f46 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .price-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .price-card:hover {
            border-color: #10b981;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
        }

        .price-card.featured {
            background: #065f46;
            border: 2px solid #10b981;
            color: white;
        }

        .price-card.featured .text-gray-800 {
            color: white !important;
        }

        .price-card.featured .text-gray-600 {
            color: #d1fae5 !important;
        }

        .price-card.featured .text-gray-700 {
            color: #ecfdf5 !important;
        }

        .service-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .service-card:hover {
            border-color: #10b981;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
        }

        .btn-primary {
            background: #10b981;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: white;
            color: #10b981;
            border: 2px solid #10b981;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #10b981;
            color: white;
        }

        .section-padding {
            padding: 5rem 0;
        }

        .text-shadow {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="hero-gradient shadow-sm sticky top-0 z-40">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-seedling text-white text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white">তরুলতা</h1>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#packages" class="text-white hover:text-green-200 transition-colors">প্যাকেজ</a>
                    <a href="#services" class="text-white hover:text-green-200 transition-colors">সেবা</a>
                    <a href="#contact" class="text-white hover:text-green-200 transition-colors">যোগাযোগ</a>
                    <div class="flex items-center space-x-3 ml-4">
                        <a href="#" class="text-white hover:text-green-200 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-white hover:text-green-200 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <a href="tel:01886950681"
                    class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-full transition-all">
                    <i class="fas fa-phone mr-2"></i>কল করুন
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center text-white">
                <div class="mb-8">
                    <i class="fas fa-leaf text-5xl text-green-200"></i>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-shadow">
                    গাছের যত্ন নিতে পারছেন না?
                </h1>
                <p class="text-xl md:text-2xl mb-8 leading-relaxed opacity-90">
                    বাগান আছে কিন্তু পরিচর্যার সময় নেই, তাই বাগানের গাছের অবস্থা খারাপ?
                    চট্টগ্রাম শহরে এখন ঘরে বসেই পাচ্ছেন নির্ভরযোগ্য মালি সার্ভিস—আপনার গাছের জন্য ঠিক ততটা যত্ন, যতটা
                    আপনার নিজের জন্য চান।
                </p>
                <div class="glass-effect rounded-2xl p-8 max-w-2xl mx-auto mb-8">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        <i class="fas fa-home text-2xl"></i>
                        <h3 class="text-2xl font-semibold">ঘরে বসেই পেশাদার সেবা</h3>
                    </div>
                    <p class="text-lg opacity-90">বিশেষজ্ঞ মালি দিয়ে আপনার বাগানকে জীবন্ত করুন</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#packages" class="btn-secondary px-8 py-4 rounded-full font-semibold">
                        <i class="fas fa-tags mr-2"></i>প্যাকেজ দেখুন
                    </a>
                    <a href="https://wa.me/8801886950681" class="btn-primary px-8 py-4 rounded-full font-semibold">
                        <i class="fab fa-whatsapp mr-2"></i>হোয়াটসঅ্যাপ
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Monthly Packages -->
    <section id="packages" class="section-padding bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    মাসিক পরিচর্যার <span class="gradient-text">প্যাকেজ</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    আপনার বাগানের জন্য উপযুক্ত প্যাকেজ বেছে নিন
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Basic Package -->
                <div class="price-card rounded-2xl p-8 hover-lift">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-seedling text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">মৌলিক প্যাকেজ</h3>
                        <div class="text-4xl font-bold text-green-600 mb-2">৬০০ টাকা</div>
                        <p class="text-gray-600 mb-2">মাসে ২ বার</p>
                        <p class="text-sm text-gray-500 mb-6">১.৫ - ২ ঘন্টার সেবা</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            গাছ ছাঁটাই
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            আগাছা পরিষ্কার
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            সার-পানি দেওয়া
                        </li>
                    </ul>
                    <a href="tel:01886950681"
                        class="w-full btn-primary py-3 rounded-xl font-semibold text-center block">
                        <i class="fas fa-phone mr-2"></i>বুক করুন
                    </a>
                </div>

                <!-- Standard Package -->
                <div class="price-card featured rounded-2xl p-8 hover-lift relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-full text-sm font-bold">
                            <i class="fas fa-star mr-1"></i>সবচেয়ে জনপ্রিয়
                        </span>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-tree text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">স্ট্যান্ডার্ড প্যাকেজ</h3>
                        <div class="text-4xl font-bold mb-2">৯০০ টাকা</div>
                        <p class="mb-2">মাসে ৩ বার</p>
                        <p class="text-sm mb-6">১.৫ - ২ ঘন্টার সেবা</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            গাছ ছাঁটাই
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            আগাছা পরিষ্কার
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            সার-পানি দেওয়া
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            মেডিসিন দেওয়া
                        </li>
                    </ul>
                    <a href="tel:01886950681"
                        class="w-full btn-secondary py-3 rounded-xl font-semibold text-center block">
                        <i class="fas fa-phone mr-2"></i>বুক করুন
                    </a>
                </div>

                <!-- Premium Package -->
                <div class="price-card rounded-2xl p-8 hover-lift">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-crown text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">প্রিমিয়াম প্যাকেজ</h3>
                        <div class="text-4xl font-bold text-green-600 mb-2">১২০০ টাকা</div>
                        <p class="text-gray-600 mb-2">মাসে ৪ বার</p>
                        <p class="text-sm text-gray-500 mb-6">১.৫ - ২ ঘন্টার সেবা</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            গাছ ছাঁটাই
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            আগাছা পরিষ্কার
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            সার-পানি দেওয়া
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            মেডিসিন দেওয়া
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            বিশেষ যত্ন
                        </li>
                    </ul>
                    <a href="tel:01886950681"
                        class="w-full btn-primary py-3 rounded-xl font-semibold text-center block">
                        <i class="fas fa-phone mr-2"></i>বুক করুন
                    </a>
                </div>
            </div>

            <div class="text-center mt-12">
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 max-w-2xl mx-auto">
                    <i class="fas fa-info-circle text-blue-500 text-2xl mb-3"></i>
                    <p class="text-gray-700 text-lg">
                        <span class="font-semibold">নোট:</span> প্যাকেজটি ছাদ বাগান এবং বারান্দার বাগানের জন্য
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Plant-Based Packages -->
    <section class="section-padding bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    গাছের সংখ্যা অনুযায়ী <span class="gradient-text">পূর্ণ দিনের সেবা</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    বড় বাগানের জন্য গাছের সংখ্যা অনুযায়ী পূর্ণ দিনের সেবা
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Package 1 -->
                <div class="price-card rounded-2xl p-8 hover-lift">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-seedling text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">ছোট বাগান</h3>
                        <div class="text-4xl font-bold text-green-600 mb-2">৬৯৯ টাকা</div>
                        <p class="text-gray-600 mb-2">৩০-৩০ টি গাছ</p>
                        <p class="text-sm text-gray-500 mb-6">পূর্ণ দিনের সেবা</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            গাছ ছাঁটাই
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            আগাছা পরিষ্কার
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            সার-পানি দেওয়া
                        </li>
                    </ul>
                    <a href="tel:01886950681"
                        class="w-full btn-primary py-3 rounded-xl font-semibold text-center block">
                        <i class="fas fa-phone mr-2"></i>বুক করুন
                    </a>
                </div>

                <!-- Package 2 -->
                <div class="price-card rounded-2xl p-8 hover-lift relative border-2 border-green-400">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                            <i class="fas fa-star mr-1"></i>জনপ্রিয়
                        </span>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-tree text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">মাঝারি বাগান</h3>
                        <div class="text-4xl font-bold text-green-600 mb-2">৮৯৯ টাকা</div>
                        <p class="text-gray-600 mb-2">৩০-৪০ টি গাছ</p>
                        <p class="text-sm text-gray-500 mb-6">পূর্ণ দিনের সেবা</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            গাছ ছাঁটাই
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            আগাছা পরিষ্কার
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            সার-পানি দেওয়া
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            মেডিসিন দেওয়া
                        </li>
                    </ul>
                    <a href="tel:01886950681"
                        class="w-full btn-primary py-3 rounded-xl font-semibold text-center block">
                        <i class="fas fa-phone mr-2"></i>বুক করুন
                    </a>
                </div>

                <!-- Package 3 -->
                <div class="price-card rounded-2xl p-8 hover-lift">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-crown text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">বড় বাগান</h3>
                        <div class="text-4xl font-bold text-green-600 mb-2">১০৯৯ টাকা</div>
                        <p class="text-gray-600 mb-2">৪০-৫০ টি গাছ</p>
                        <p class="text-sm text-gray-500 mb-6">পূর্ণ দিনের সেবা</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            গাছ ছাঁটাই
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            আগাছা পরিষ্কার
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            সার-পানি দেওয়া
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            মেডিসিন দেওয়া
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            বিশেষ যত্ন
                        </li>
                    </ul>
                    <a href="tel:01886950681"
                        class="w-full btn-primary py-3 rounded-xl font-semibold text-center block">
                        <i class="fas fa-phone mr-2"></i>বুক করুন
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Landscaping Services -->
    <section class="section-padding bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    <span class="gradient-text">ল্যান্ডস্কেপিং</span> সেবা
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    বড় বাগানের জন্য স্কয়ার ফিট অনুযায়ী সেবা
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift border border-gray-200">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-ruler-combined text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">স্কয়ার ফিট অনুযায়ী সেবা</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            বড় বাগান বা ল্যান্ডস্কেপিং প্রকল্পের জন্য আমাদের বিশেষ সেবা
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">সেবার অন্তর্ভুক্ত:</h4>
                            <ul class="space-y-3">
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    সম্পূর্ণ বাগান ডিজাইন
                                </li>
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    গাছ রোপণ ও ব্যবস্থাপনা
                                </li>
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    সেচ ব্যবস্থা স্থাপন
                                </li>
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    পাথর ও পাথুরে সাজসজ্জা
                                </li>
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    আলোকসজ্জা
                                </li>
                            </ul>
                        </div>

                        <div class="bg-green-50 rounded-xl p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">মূল্য নির্ধারণ:</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">স্কয়ার ফিট অনুযায়ী</span>
                                    <span class="font-bold text-green-600">চুক্তি ভিত্তিক</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">মূল্যায়ন</span>
                                    <span class="font-bold text-green-600">বিনামূল্যে</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">ডিজাইন পরিকল্পনা</span>
                                    <span class="font-bold text-green-600">অন্তর্ভুক্ত</span>
                                </div>
                            </div>
                            <div class="mt-6 p-4 bg-white rounded-lg">
                                <p class="text-sm text-gray-600 text-center">
                                    <i class="fas fa-phone text-green-500 mr-2"></i>
                                    বিস্তারিত জানতে কল করুন: <strong>01886-950681</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section-padding bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    যা যা <span class="gradient-text">থাকছে</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    আমাদের পেশাদার সেবার বিস্তারিত
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="service-card rounded-2xl p-8 hover-lift">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-cut text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">গাছ ছাঁটাই</h3>
                    <p class="text-gray-600">পেশাদার উপায়ে গাছের ছাঁটাই করে সুন্দর আকৃতি দেওয়া</p>
                </div>

                <div class="service-card rounded-2xl p-8 hover-lift">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-broom text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">আগাছা পরিষ্কার</h3>
                    <p class="text-gray-600">বাগান থেকে সব ধরনের আগাছা পরিষ্কার করা</p>
                </div>

                <div class="service-card rounded-2xl p-8 hover-lift">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-tint text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">সার-পানি দেওয়া</h3>
                    <p class="text-gray-600">গাছের জন্য প্রয়োজনীয় সার ও পানি সরবরাহ</p>
                </div>

                <div class="service-card rounded-2xl p-8 hover-lift">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-pills text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">মেডিসিন দেওয়া</h3>
                    <p class="text-gray-600">গাছের রোগ-বালাই থেকে রক্ষার জন্য প্রয়োজনীয় ওষুধ</p>
                </div>

                <div class="service-card rounded-2xl p-8 hover-lift">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-leaf text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">সবুজ প্রাণবন্ত করা</h3>
                    <p class="text-gray-600">আপনার বাগানটাকে আবার সবুজ প্রাণবন্ত করে তোলা</p>
                </div>

                <div class="service-card rounded-2xl p-8 hover-lift">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-tools text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">সরঞ্জাম প্রদান</h3>
                    <p class="text-gray-600">সব কাজের সরঞ্জাম তরুলতা থেকে প্রদান করা হবে</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Important Note -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-amber-50 border-l-4 border-amber-400 rounded-r-2xl p-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-amber-500 text-3xl"></i>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">গুরুত্বপূর্ণ তথ্য</h3>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                শুধুমাত্র কাজের সরঞ্জামসমূহ প্রদান করা হবে তরুলতা থেকে।
                                সার কিংবা অন্য সকল জিনিস গ্রাহক থেকে সরবরাহ করতে হবে।
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding hero-gradient">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    বুকিং করুন <span class="text-green-200">এখনই</span>
                </h2>
                <p class="text-xl text-green-100 max-w-2xl mx-auto">
                    আমাদের সাথে যোগাযোগ করে আপনার বাগানের যত্ন শুরু করুন
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="glass-effect rounded-2xl p-8 text-center hover-lift">
                        <div
                            class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-phone text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">ফোন করুন</h3>
                        <a href="tel:01886950681"
                            class="text-3xl font-bold text-green-200 hover:text-white transition-colors block mb-4">
                            01886-950681
                        </a>
                        <p class="text-green-100">সরাসরি কল করে কথা বলুন</p>
                    </div>

                    <div class="glass-effect rounded-2xl p-8 text-center hover-lift">
                        <div
                            class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fab fa-whatsapp text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">হোয়াটসঅ্যাপ</h3>
                        <a href="https://wa.me/8801886950681"
                            class="text-3xl font-bold text-green-200 hover:text-white transition-colors block mb-4">
                            01886-950681
                        </a>
                        <p class="text-green-100">হোয়াটসঅ্যাপে বিস্তারিত আলোচনা করুন</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-seedling text-white text-xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold">তরুলতা</h3>
                </div>
                <p class="text-gray-300 text-lg mb-4">
                    চট্টগ্রামের নির্ভরযোগ্য বাগান পরিচর্যা সেবা
                </p>
                <div class="flex justify-center space-x-6 mb-6">
                    <a href="tel:01886950681" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fas fa-phone mr-2"></i>01886-950681
                    </a>
                    <a href="https://wa.me/8801886950681" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i>হোয়াটসঅ্যাপ
                    </a>
                </div>
                <div class="flex justify-center space-x-4 mb-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
                <p class="text-gray-500 text-sm mb-2">@tarulatagardening</p>
                <p class="text-gray-500 text-sm">
                    © 2024 তরুলতা। সকল অধিকার সংরক্ষিত।
                </p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/8801886950681"
        class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg hover-lift transition-all duration-300 z-50">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>

    <!-- Scroll to Top Button -->
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-6 left-6 bg-gray-800 hover:bg-gray-700 text-white p-3 rounded-full shadow-lg hover-lift transition-all duration-300 z-50">
        <i class="fas fa-arrow-up"></i>
    </button>
</body>

</html>