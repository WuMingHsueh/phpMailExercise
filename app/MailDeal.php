<?php

namespace MailExercise;

class MailDeal
{
    private $transport;
    private $message;
    public $mailer;

    public function __construct($configPath)
    {
        $params = \parse_ini_file($configPath);
        if ($params === false) {
            throw new Exception("Error Read Mail Config fail");
        }

        $this->transport = (new \Swift_SmtpTransport($params['smtpHost'], $params['port']))
                            ->setUsername($params['user'])
                            ->setPassword($params['password']);
        
        $this->mailer = new \Swift_Mailer($this->transport);
    }

    public function createMessage($fromUser, $ToUser, $subject, $content)
    {
        $this->message = (new \Swift_Message($subject))
                            ->setFrom($fromUser)
                            ->setTo([$ToUser => $ToUser])
                            ->setBody($content);
    }

    public function send()
    {
        if (is_null($this->message)) {
            throw new Exception("Error Mail Message is Empty");
        }

        return $this->mailer->send($this->message);
    }
}
