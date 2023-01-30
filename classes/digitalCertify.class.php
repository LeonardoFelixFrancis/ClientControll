<?php

class digitalCertify extends dataBaseConnect{
    
    protected $client;
    protected $clientDebt;
    protected $paymentDay;
    protected $status;
    protected $userid;
    protected $rg;
    protected $cpf;
    protected $filePath;
    protected $fileTypes = ['pdf', 'docx'];
    protected $lastId;
    protected $expDate;
    protected $mail;
    protected $phone;
    protected $origin;
    protected $type;
    protected $comission;
    protected $changeId;
    protected $passed;

    protected $error = [];
    protected $duplicated = false;
    protected $delId;

    protected function queryErrorHandler(){
        $sql = "SELECT * FROM clients WHERE client=? AND clientDebt=? AND iDate=? AND stat=? AND userid=? AND rg=? AND cpf=? AND mail=? AND phone=? AND origin=? AND certType=? AND comission=? AND passed=?";

        $errorQuery = $this->makeConnection()->prepare($sql);
        $errorQuery->execute([$this->client, $this->clientDebt, $this->paymentDay, $this->status, $this->userid, $this->rg, $this->cpf, $this->mail, $this->phone, $this->origin, $this->type, $this->comission, $this->passd]);

        if($errorQuery->fetch()){
            $this->duplicated = true;
        }
    }

    protected function insertDigitalCertify(){
        $sql = "INSERT INTO clients (client, clientDebt, iDate, stat, userid,rg,cpf, expDate, mail, phone, origin, certType, comission, passed) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $pd = $this->makeConnection();
        $clientQuerry = $pd->prepare($sql);
        $clientQuerry->execute([$this->client, $this->clientDebt, $this->paymentDay, $this->status, $this->userid, $this->rg,$this->cpf, $this->expDate, $this->mail, $this->phone, $this->origin, $this->type, $this->comission, $this->passed]);
        $this->lastId = $pd->lastInsertId();
    }

    protected function getDigitalCerify(){
        $sql = "SELECT * FROM clients WHERE userid=?";
        $getQuerry = $this->makeConnection()->prepare($sql);
        $getQuerry->execute([$this->userid]);
        return $getQuerry;
    }

    protected function getOrigins(){
        $sql = "SELECT origin FROM clients WHERE userid=?";
        $getQuerry = $this->makeConnection()->prepare($sql);
        $getQuerry->execute([$this->userid]);
        return $getQuerry;
    }

    protected function connDeleteClient(){
        $sql = 'DELETE FROM clients WHERE id=?';
        $delConn = $this->makeConnection()->prepare($sql);
        $delConn->execute([$this->delId]);
    }

    protected function updateClient(){
        $sql = 'UPDATE clients SET client=?, clientDebt=?, iDate=?, stat=?, rg=?, cpf=?, expDate=?, mail=?, phone=?, origin=?, certType=?, comission=?, passed=? WHERE id=?';
        $updateConn = $this->makeConnection()->prepare($sql);
        $updateConn->execute([$this->client, $this->clientDebt, $this->paymentDay, $this->status, $this->rg,$this->cpf, $this->expDate, $this->mail, $this->phone, $this->origin, $this->type, $this->comission, $this->passed,$this->changeId]);
    }
}