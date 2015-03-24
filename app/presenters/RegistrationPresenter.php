<?php

namespace App\Presenters;

use Nette,
    App\Components\RegistrationMailer,
    App\Model\RegistrationManager,
    App\Forms\RegistrationFormFactory;

class RegistrationPresenter extends BasePresenter {

    /** @var RegistrationFormFactory @inject */
    public $formFactory;

    /** @var RegistrationManager @inject */
    public $registration;

    /** @var RegistrationMailer @inject */
    public $mailer;

    /**
     * Form component
     *
     * @return Nette\Application\UI\Form
     */
    protected function createComponentRegistrationForm() {
        $form = $this->formFactory->create();

        $date = new \DateTime('NOW');
        $this->template->date = $date->getTimestamp();

        $form->onSuccess[] = array($this, 'registrationFormSucceeded');

        return $form;
    }

    /**
     * Registration action
     *
     * @param Nette\Application\UI\Form $form
     * @param Nette\Utils\ArrayHash $user
     */
    public function registrationFormSucceeded($form, $user) {

        if (!$this->registration->isRegistred($user->email)) {

            $this->registration->addUser($user);

            $this->mailer->sendMail($user);

            $this->redirect('Registration:sent');
        } else {
            $this->flashMessage('Zadaný E-mail je již registrovan.');
        }
    }

}
