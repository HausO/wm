<?php

namespace App\Forms;

use Nette,
    Nette\Application\UI\Form;

/**
 * Registration Form Factory
 *
 * @author Tomáš Domanik <tdomanik@gmail.com>
 */
class RegistrationFormFactory extends Nette\Application\UI\Form {

    /**
     * factory method
     *
     * @return Nette\Application\UI\Form
     */
    public function create() {
        $form = new Form;

        $form->addText('name', 'Jméno:')
                ->addRule(Form::MIN_LENGTH, 'Jméno musí mít alespoň %d znaky', 2)
                ->addRule(Form::PATTERN, 'Jméno musí obsahovat pouze male a velké znaky abecedy', '[a-zA-ZěščřžýáíéďťňúůĚŠČŘŽÝÁÍÉĎŤŇÚŮ .]+');


        $form->addText('surname', 'Příjmení:')
                ->addRule(Form::MIN_LENGTH, 'Příjmení musí mít alespoň %d znaky', 2)
                ->addRule(Form::PATTERN, 'Příjmení musí obsahovat pouze male a velké znaky abecedy', '[a-zA-ZěščřžýáíéďťňúůĚŠČŘŽÝÁÍÉĎŤŇÚŮ .]+');

        $form->addText('email', 'Email:')
                ->setType('email')
                ->addRule(Form::EMAIL, 'Zadaná adresa není ve správnem tvaru.')
                ->setRequired('Zadejte e-mailovou adresu');

        $gender = array(
            'm' => 'muž',
            'f' => 'žena',
        );
        $form->addRadioList('gender', 'Pohlaví:', $gender)
                ->setRequired('Vyberte pohlaví')
                ->getSeparatorPrototype()
                ->setName(NULL);


        $form->addSubmit('send', 'Odeslat formulář');

        return $form;
    }

}
