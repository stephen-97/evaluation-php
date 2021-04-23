<?php

class AccountManager{

    private \PDO $_db;

    public function  __construct(\PDO $_db){
        $this->_db = $_db;
    }

    public function setDb (\PDO $db) {
        $this->_db = $db;
    }

    public function addAccount(string $username, string $password){

        $ADD_ARTICLE = $this->_db->prepare('
            INSERT INTO account_examen 
            SET username=:username, password=:password');
        $ADD_ARTICLE->bindValue(':username', $username);
        $ADD_ARTICLE->bindValue(':password', $password);
        if(!$ADD_ARTICLE->execute()){
            var_dump($ADD_ARTICLE->errorInfo());
            die;
        }
    }

    public function update(string $username, string $password, int $id){
        $ADD_ARTICLE = $this->_db->prepare('
            UPDATE account_examen 
            SET username=:username, password=:password WHERE id=:id');
        $ADD_ARTICLE->bindValue(':username', $username);
        $ADD_ARTICLE->bindValue(':password', $password);
        $ADD_ARTICLE->execute(['username' => $username, 'password' => $password, 'id' => $id]);
    }

    public function getAccountValues(string $email, string $password)
    {
        $sth = $this->_db->prepare("SELECT * FROM account_examen WHERE username=:username AND password=:password"
        );
        $bool = empty($sth->execute(['username' => $email, 'password' => $password]));

        return $sth->fetch();
    }

    public function isAlreadySetOrNot(string $email){
        $sth = $this->_db->prepare("SELECT * FROM account_examen WHERE username=:username"
        );
        $sth->execute(['username' => $email]);
        return $sth->fetchAll();
    }

    public function getAccountid(string $email){
        $sth = $this->_db->prepare("SELECT * FROM account_examen WHERE username=:username");
        $sth->execute(['username' => $email]);
        $tab = $sth->fetchAll();
        $id = $tab[0]['id'];
        return $id;
    }

}