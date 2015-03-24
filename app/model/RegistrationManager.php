<?php

namespace App\Model;

use Nette,
    Nette\Database\Context;

class RegistrationManager extends Nette\Object {

    private $database;

    public function __construct(Context $database) {
        $this->database = $database;
    }

    /**
     * Registration checker
     *
     * @param string $email
     * @return boolean TRUE when email is found in database, FALSE otherwise
     */
    public function isRegistred($email) {
        $inDB = $this->database->table('users')->where('email', $email)->count("*");

        return (bool) $inDB;
    }

    /**
     * Add user to database
     *
     * @param Nette\Utils\ArrayHash $user
     */
    public function addUser($user) {

        $this->database->table('users')
                ->insert(array(
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'gender' => $user->gender,
                    'email' => $user->email
                        )
        );
    }

}
