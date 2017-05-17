<?php

namespace Application\Model;

class User{
    
    private $idUser;
    private $firstName;
    private $name;
    private $street;
    private $number;
    private $city;
    private $mail;
    private $userName;
    private $password;
    private $pictures;
    
 
     function exchangeArray($data){
        $this->idUser=(!empty($data['idUser'])?$data['idUser']:null);
        $this->firstName=(!empty($data['firstName'])?$data['firstName']:null);
        $this->name=(!empty($data['name'])?$data['name']:null);
        $this->street=(!empty($data['street'])?$data['street']:null);
        $this->number=(!empty($data['number'])?$data['number']:null);
        $this->city=(!empty($data['city'])?$data['city']:null);
        $this->mail=(!empty($data['mail'])?$data['mail']:null);
        $this->userName=(!empty($data['userName'])?$data['userName']:null);
        $this->password=(!empty($data['password'])?$data['password']:null);
        $this->pictures=(!empty($data['pictures'])?$data['pictures']:null);
    }
    
      public function __construct ($donnees=[]){
        $this->hydrate ($donnees);
    }
        
    
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    public function toArray()
    {
        return get_object_vars($this);
    }
   
    function getIdUser() {
        return $this->idUser;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getName() {
        return $this->name;
    }

    function getStreet() {
        return $this->street;
    }

    function getNumber() {
        return $this->number;
    }

    function getCity() {
        return $this->city;
    }

    function getMail() {
        return $this->mail;
    }

    function getUserName() {
        return $this->userName;
    }

    function getPassword() {
        return $this->password;
    }

    function getPictures() {
        return $this->pictures;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setStreet($street) {
        $this->street = $street;
    }

    function setNumber($number) {
        $this->number = $number;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setPictures($pictures) {
        $this->pictures = $pictures;
    }


    
   
}

