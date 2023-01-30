<?php
class login extends dataBaseConnect{

    protected $user;
    protected $pwd;
    protected $error = [];
    
    protected function tryLoginUser(){
        $sql = "SELECT * FROM users WHERE user=?";
        $connQuery = $this->makeConnection()->prepare($sql);
        $connQuery->execute([$this->user]);

        if($row = $connQuery->fetch()){
            if(!password_verify($this->pwd, $row['pwd'])){
                array_push($this->error, "Wrong password");
            }
        }else{
            array_push($this->error,"User does'nt exist");
        };
    }

    protected function getUserId(){
        $user = $_SESSION['USERSESSION'];
        $sql = "SELECT * FROM users WHERE user=?";
        $connQuery = $this->makeConnection()->prepare($sql);
        $connQuery->execute([$user]);

        if($row = $connQuery->fetch()){
            return $row['id'];
        }
    }

    protected function getMail($mail){
        $sql = "SELECT * FROM users WHERE mail=?";
        $connQuery = $this->makeConnection()->prepare($sql);
        $connQuery->execute([$mail]);

        if($row = $connQuery->fetch()){
            return $row['mail'];
        }
    }
}