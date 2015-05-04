<?php

require_once('data/UserDAO.class.php');

class UserService
{
    private $userSvc;

    public function userValidation($login, $password)
    {
        $this->userSvc = new UserDAO();
        $this->userSvc = $this->userSvc->getData($login, $password);
        if(!empty($this->userSvc))
        {
            return $this->userSvc = new User($this->userSvc[0]['id'],$this->userSvc[0]['login'], $this->userSvc[0]['password']);
        }
        else
        {
            return false;
        }
    }
}




