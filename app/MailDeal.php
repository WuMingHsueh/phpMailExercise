<?php

namespace MailExercise;

class MailDeal
{
    private $attachment;
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

    public function attachment($path, $fileName = null)
    {
        $this->attachment = \Swift_Attachment::fromPath($path);
        $this->attachment->setFilename(
            (is_null($fileName))? basename($path) : $fileName
        );

        if (is_null($this->message)) return false;
        $this->message->attach($this->attachment);
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
