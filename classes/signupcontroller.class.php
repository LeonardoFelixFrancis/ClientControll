<?php

class signupcontroller extends signup{
    
    protected $error = [];

    private function errorHandler($user, $mail,$pwd, $confpwd){
        
        $this->error = [];
        
        if(!isset($user)){
            $this->error['errorUser'] = 'User field is required';
        }
        if(!isset($mail)){
            $this->error['errorMail'] = 'Mail field is required';
        }
        if(!isset($pwd)){
            $this->error['errorPwd'] = 'Password field is required';
        }
        if(!isset($confpwd)){
            $this->error['errorConfPwd'] = 'Confirm password field is required';
        }

        if(isset($pwd) && isset($confpwd)){
            if($pwd != $confpwd){
                $this->error['errorPwdMatch'] = 'The password and the confirm password are different';
            }
        }

        if($this->checkUser($user)){
            $this->error['errorUserUnavailable'] = "The user name is unavailable";
        }
        if($this->checkMail($mail)){
            $this->error['errorMailUnavailable'] = "The e-mail is already in use";
        }

        return $this->error;
    }
    
    public function signUpUser($user, $mail,$pwd, $confpwd){
        $this->error = $this->errorHandler($user, $mail, $pwd, $confpwd);
        if(!count($this->error)){
            $hsdPwd = password_hash($pwd, PASSWORD_DEFAULT);
            $this->insertUser($user, $mail, $hsdPwd);
        }
    }
}