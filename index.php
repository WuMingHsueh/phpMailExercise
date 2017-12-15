<?php

include __DIR__ . "./vendor/autoload.php";

use MailExercise\MailDeal as MailDeal;

$attachPath1 = __DIR__ . './刀.jpg';
$attachPath2 = __DIR__ . './snippets.json';
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
    $mailer->attachment($attachPath1);
    $mailer->attachment($attachPath2);
    echo ($mailer->send())? "送信成功" : "送信失敗";
} catch (\Exception $e) {
    echo $e->getMessage();
}
