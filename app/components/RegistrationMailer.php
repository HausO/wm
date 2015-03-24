<?php

namespace App\Components;

use Nette,
    Nette\Mail\Message,
    Nette\Latte;

/**
 * Mailer factory
 */
class RegistrationMailer extends Nette\Object {

    /** @var string  */
    private $recipient_email;

    /** @var string */
    private $recipient_name;

    /** @var Nette\Mail\IMailer  */
    private $mailer;

    public function __construct(Nette\Mail\IMailer $mailer, $recipient_email, $recipient_name) {
        $this->mailer = $mailer;
        $this->recipient_email = $recipient_email;
        $this->recipient_name = $recipient_name;
    }

    /**
     * Send mail
     *
     * @param Nette\Utils\ArrayHash $user
     */
    public function sendMail($user) {
        $mail = new Message;
        $mail->setSubject('Nová registrace.');
        $mail->setFrom($user->email, $user->name . ' ' . $user->surname);
        $mail->addTo($this->recipient_email, $this->recipient_name);

        $gender = array(
            'm' => 'muž',
            'f' => 'žena',
        );

        $date = new \DateTime('NOW');

        $params = array(
            'name' => $user->name,
            'surname' => $user->surname,
            'gender_string' => $gender[$user->gender],
            'email' => $user->email,
            'date' => $date->getTimestamp()
        );

        $template = new Latte\Engine;
        $content = $template->renderToString(__DIR__ . '/../templates/Mail/registration.latte', $params);

        $mail->setHtmlBody($content);

        $this->mailer->send($mail);
    }

}
