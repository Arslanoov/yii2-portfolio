<?php

namespace portfolio\useCases;

use portfolio\entities\Contact\Message;
use portfolio\forms\ContactForm;
use yii\mail\MailerInterface;
use RuntimeException;
use portfolio\repositories\Contact\MessageRepository;

class ContactService
{
    private $adminEmail;
    private $mailer;
    private $messages;

    public function __construct($adminEmail, MailerInterface $mailer, MessageRepository $messages)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
        $this->messages = $messages;
    }

    public function send(ContactForm $form): void
    {
        $sent = $this->mailer->compose()
            ->setTo($this->adminEmail)
            ->setSubject('Письмо от ' . $form->username)
            ->setTextBody($form->message)
            ->send();

        if (!$sent) {
            throw new RuntimeException('Возникла ошибка');
        }

        $message = Message::create(
            $form->username,
            $form->email,
            $form->message
        );

        $this->messages->save($message);
    }
}