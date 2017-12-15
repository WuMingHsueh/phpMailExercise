<?php

include __DIR__ . "./vendor/autoload.php";

use MailExercise\MailDeal as MailDeal;

$mailGetter = "ri3567@gmail.com";
$mailFrom = 'rick1870@ares.com.tw';
$subject = "PHP Send Mail Success";
$content = <<<EOT
送信愉快

鄔明學
2017.12.15
EOT;

try {
    $mailer = new MailDeal(__DIR__."./mailSetting.ini");
    $mailer->createMessage($mailFrom, $mailGetter, $subject, $content);
    echo ($mailer->send())? "送信成功" : "送信失敗";
} catch (\Exception $e) {
    echo $e->getMessage();
}
