<?php

require_once('data/DBConnect.class.php');
require_once('entities/User.class.php');



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


    public function getData($login, $password)
    {
        self::connectToDB();
        $this->sql = "SELECT * FROM users WHERE login = ? AND password = ?";

        try {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($login, $password));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->handler = null;
            $this->query->closeCursor();

//            $this->lijst = new User($this->result[0]['id'], $this->result[0]['login'], $this->result[0]['password']);

            return $this->result;

        } catch (Exception $e) {
            echo "Error: Ошибка с запросом";
            return false;
        }
    }
}

/*$obj = new UserDAO();
echo "<pre>";
print_r($aa = $obj->check());
echo "</pre>";
echo $aa->getId();*/