<?php

class loginview extends login{
    public function showErrors($err){
        $error = $err;
        print_r($error);
    }

    public function returnUserId(){
        if(isset($_SESSION['USERSESSION'])){
            return $this->getUserId();
        }
    }
}