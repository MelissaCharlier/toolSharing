<?php

namespace Application\Model;

class Tool{
    
    public $idTool;
    public $name;
    public $pictures;
    public $idCategorie;
    
 
     function exchangeArray($data){
        $this->idTool=(!empty($data['idTool'])?$data['idTool']:null); 
        $this->name=(!empty($data['name'])?$data['name']:null);
        $this->pictures=(!empty($data['pictures'])?$data['pictures']:null);
        $this->idCategorie=(!empty($data['idCategorie'])?$data['idCategorie']:null); 
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
   
    function getIdTool() {
        return $this->idTool;
    }

    function getName() {
        return $this->name;
    }

    function getPictures() {
        return $this->pictures;
    }
    
     function getIdCategorie() {
        return $this->idCategorie;
    }
    
    function setIdTool($idTool) {
        $this->idTool = $idTool;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPictures($pictures) {
        $this->pictures = $pictures;
    }
    
    function setIdCategorie($idCategorie) {
        $this->idCategorie = $idCategorie;
    }
   
}

