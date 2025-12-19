<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageBooking;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class BookingStartController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_name' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msgType' => 'error',
                'msg' => $validator->errors()->first()
            ]);
        }

        // Save to Database
        $booking = new PackageBooking();
        $booking->package_name = $request->input('package_name');
        $booking->name = $request->input('name');
        $booking->phone = $request->input('phone');
        $booking->address = $request->input('address');
        $booking->message = $request->input('message');
        $booking->save();

        // Send Email
        $gtext = gtext();
        $res = array();

        if ($gtext['ismail'] == 1) {
            try {
                require 'vendor/autoload.php';
                $mail = new PHPMailer(true);
                $mail->CharSet = "UTF-8";

                if ($gtext['mailer'] == 'smtp') {
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host       = $gtext['smtp_host'];
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $gtext['smtp_username'];
                    $mail->Password   = $gtext['smtp_password'];
                    $mail->SMTPSecure = $gtext['smtp_security'];
                    $mail->Port       = $gtext['smtp_port'];
                }

                $mail->setFrom($gtext['from_mail'], $gtext['from_name']);
                $mail->addAddress($gtext['to_mail'], $gtext['to_name']); // Send to Admin
                $mail->isHTML(true);
                $mail->Subject = "New Booking Request: " . $booking->package_name;

                $body = "<table style='background-color:#edf2f7;color:#111111;padding:40px 0px;line-height:24px;font-size:14px;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                            <tr>
                                <td>
                                    <table style='background-color:#fff;max-width:600px;margin:0 auto;padding:30px;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                        <tr><td style='padding-bottom:10px;'><strong>Package:</strong> " . $booking->package_name . "</td></tr>
                                        <tr><td style='padding-bottom:10px;'><strong>Name:</strong> " . $booking->name . "</td></tr>
                                        <tr><td style='padding-bottom:10px;'><strong>Phone:</strong> " . $booking->phone . "</td></tr>
                                        <tr><td style='padding-bottom:10px;'><strong>Address:</strong> " . $booking->address . "</td></tr>
                                        <tr><td style='padding-bottom:10px;'><strong>Message:</strong> " . $booking->message . "</td></tr>
                                        <tr><td style='padding-top:20px;'>Please check the admin panel for more details.</td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>";

                $mail->Body = $body;
                $mail->send();

            } catch (Exception $e) {
                // Log error but generally return success for the user's booking if DB saved
            }
        }

        return response()->json([
            'msgType' => 'success',
            'msg' => 'Your booking request has been received! We will contact you soon.'
        ]);
    }
}
