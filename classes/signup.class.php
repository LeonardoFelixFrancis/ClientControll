<?php

class signup extends dataBaseConnect{
    protected function checkUser($userValue){
        $sql = "SELECT * FROM users WHERE user=?";
        $connQuery = $this->makeConnection()->prepare($sql);
        $connQuery->execute([$userValue]);
        
        return $connQuery->rowCount();
    }

    protected function checkMail($mailValue){
        $sql = "SELECT * FROM users WHERE mail=?";
        $connQuery = $this->makeConnection()->prepare($sql);
        $connQuery->execute([$mailValue]);

        return $connQuery->rowCount();
    }

    protected function insertUser($user, $mail, $pwd){
        $sql = "INSERT INTO users (user, mail, pwd) VALUES (?,?,?)";
        $connQuery = $this->makeConnection()->prepare($sql);
        $connQuery->execute([$user,$mail,$pwd]);
    }
}