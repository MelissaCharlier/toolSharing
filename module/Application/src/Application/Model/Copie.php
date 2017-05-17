<?php

namespace Application\Model;

class Copie
{
    public $idCopie;
    public $barcode;
    public $stateWear;
    public $details;
    public $pictures;
    
    //Lien avec   
    public $idTool;

    
    public function exchangeArray($donnees){
        $this->idCopie=(!empty($donnees['idCopie']))? $donnees ['idCopie'] : null;
        $this->barcode=(!empty($donnees['barcode']))? $donnees ['barcode'] : null;
        $this->stateWear=(!empty($donnees['stateWear']))? $donnees ['stateWear'] : null;
        $this->details=(!empty($donnees['details']))? $donnees ['details'] : null;
        $this->pictures=(!empty($donnees['pictures']))? $donnees ['pictures'] : null;
        $this->idTool=(!empty($donnees['idTool']))? $donnees ['idTool']: null;
    }
    
    public function __construct ($donnees =[]){
        
        $this->hydrate ($donnees);
    }
    
    // version automatique
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
        // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
            
        }
        
    }
    
    public function toArray()
    {
           
        return (['idCopie'=>$this->getIdCopie(), 
                 'barcode'=>$this->getBarcode(),
                 'stateWear'=>$this->getStateWear(),
                 'details'=>$this->getDetails(),
                 'pictures'=>$this->getPicture()]);
    }
   
    function getIdCopie() {
        return $this->idCopie;
    }

    function getBarcode() {
        return $this->barcode;
    }

    function getStateWear() {
        return $this->stateWear;
    }

    function getDetails() {
        return $this->details;
    }

    function getPictures() {
        return $this->pictures;
    }
    
    function setIdCopie($idCopie) {
        $this->idCopie = $idCopie;
    }

    function setBarcode($barcode) {
        $this->barcode = $barcode;
    }

    function setStateWear($stateWear) {
        $this->stateWear = $stateWear;
    }

    function setDetails($details) {
        $this->details = $details;
    }

    function setPictures($pictures) {
        $this->pictures = $pictures;
    }  

     // lien
    function getIdTool() {
        return $this->idTool;
    }

    function setIdTool($idTool) {
        $this->idTool = $idTool;
    }
}
 