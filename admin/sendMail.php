<?php
namespace App\Tasks;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use SendGrid\Mail\From;
use SendGrid\Mail\Mail;
use SendGrid\Mail\To;

class SendDailyMetrics
{
        public function __invoke()
        {
            // retrieve user count as at previous day
            $yesterday = Carbon::yesterday()->format('Y-m-d');
            $usersFromYesterday = User::whereDate('created_at', $yesterday)->count();

            // retrieve user count as at today
            $today = Carbon::today()->format('Y-m-d');
            $usersToday = User::whereDate('created_at', $today)->count();

            // calculate the percentage difference
            if ($usersFromYesterday > 0) {
                $percentageDiff = ((abs($usersFromYesterday - $usersToday)) / $usersFromYesterday) * 100;
                if ($usersFromYesterday > $usersToday) {
                    // convert to it's negative equivalent if the number of users declined
                    $percentageDiff = -1 * $percentageDiff;
                }
                $this->sendEmail($usersToday, $percentageDiff);
            }
            $this->sendEmail($usersToday);
        }

        private function sendEmail(int $userCount, $percentageDiff = 0) {
            // only append the '%' sign if an actual percentage was provided.
            $percentageDiff = ($percentageDiff == 0) ? $userCount : $percentageDiff."%";

            $name = getenv('ADMIN_NAME');
            $htmlContent = "<p>Hi $name, We got <b>$userCount</b> new users today,
                a <b>$percentageDiff</b> difference from yesterday</p>";
            $textContent = "Hi $name, We got $userCount new users today,
                a $percentageDiff difference from yesterday</p>";
            $from = new From(getenv('ADMIN_EMAIL'), getenv('ADMIN_NAME'));
            $subject = "Here's how our app performed today.";
            $recipient = new To(getenv('ADMIN_EMAIL'), getenv('ADMIN_NAME'));

            $email = new Mail();
            $email->setFrom($from);
            $email->setSubject($subject);
            $email->addTo($recipient);
            $email->addContent("text/plain", $textContent);
            $email->addContent("text/html", $htmlContent);

            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
            try {
                $response = $sendgrid->send($email);
                $context = json_decode($response->body());
                if ($response->statusCode() == 202) {
                    Log::info("Metric email has been sent", ["context" => $context]);
                }else {
                    Log::error("Failed to send metric email", ["context" => $context]);
                }
            } catch (\Exception $e) {
                Log::error($e);
            }
        }
}