<?php

require_once('../data/DBConnect.class.php');
require_once('../entities/User.class.php');



class UserDAO
{
    private $handler;
    private $sql;
    private $query;
    private $result;
    private $lijst;

    private function connectToDB()
    {
        /**
         * Connect to DB
         */
        $this->handler = new DBConnect();
        $this->handler = $this->handler->startConnection();
    }


    public function check($login = 'admin', $password = '123456')
    {
        self::connectToDB();
        $this->sql = "SELECT * FROM users WHERE login = ? AND password = ?";

        try {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($login, $password));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->handler = null;
            $this->query->closeCursor();

            foreach ($this->result as $row) {

            }

            $this->lijst = new User();

            return $this->lijst;
        } catch (Exception $e) {
            echo "Error: Ошибка с запросом";
            return false;
        }
    }
}
