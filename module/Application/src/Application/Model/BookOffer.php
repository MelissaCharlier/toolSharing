<?php

namespace Application\Model;

class BookOffer
{
    public $idBookOffer;
    public $bookingDate;
//    public $offeringDate;
//    public $state;
    
    //Lien avec   
    public $idUser;
    public $idCopie;
//    public $idSkill;

    
    public function exchangeArray($donnees){
        $this->idBookOffer=(!empty($donnees['idBookOffer']))? $donnees ['idBookOffer'] : null;
        $this->bookingDate=(!empty($donnees['bookingDate']))? $donnees ['bookingDate'] : null;
//        $this->offeringDate=(!empty($donnees['offeringDate']))? $donnees ['offeringDate'] : null;
//        $this->state=(!empty($donnees['state']))? $donnees ['state'] : null;
        $this->idUser=(!empty($donnees['idUser']))? $donnees ['idUser'] : null;
        $this->idCopie=(!empty($donnees['idCopie']))? $donnees ['idCopie'] : null;
//        $this->idSkill=(!empty($donnees['idSkill']))? $donnees ['idSkill'] : null;
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
           
        return (['idBookOffer'=>$this->getIdBookOffer(), 
                 'bookingDate'=>$this->getBookingDate(),
//                 'offeringDate'=>$this->getOfferingDate(),
//                 'state'=>$this->getState()
                 ]);
                
    }
   
    function getIdBookOffer() {
        return $this->idBookOffer;
    }

    function getBookingDate() {
        return $this->bookingDate;
    }

//    function getOfferingDate() {
//        return $this->offeringDate;
//    }

//    function getState() {
//        return $this->state;
//    }

    function getIdUser() {
        return $this->idUser;
    }

    function getIdCopie() {
        return $this->idCopie;
    }

//    function getIdSkill() {
//        return $this->idSkill;
//    }

    function setIdBookOffer($idBookOffer) {
        $this->idBookOffer = $idBookOffer;
    }

    function setBookingDate($bookingDate) {
        $this->bookingDate = $bookingDate;
    }

//    function setOfferingDate($offeringDate) {
//        $this->offeringDate = $offeringDate;
//    }

//    function setState($state) {
//        $this->state = $state;
//    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setIdCopie($idCopie) {
        $this->idCopie = $idCopie;
    }

//    function setIdSkill($idSkill) {
//        $this->idSkill = $idSkill;
//    }



}
 