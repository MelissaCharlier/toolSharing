<?php
namespace Application\Model;

class Vote
{
    private $idVote;
    private $resultat;
    
    
    private $idPurchase;
    private $idUser;
  
    public function exchangeArray($donnees){
        $this->setIdVote=(!empty($donnees['idVote']))? $donnees ['idVote'] : null;
        $this->setResultat=(!empty($donnees['resultat']))? $donnees ['resultat'] : null;
        $this->setIdPurchase=(!empty($donnees['idPurchase']))? $donnees ['idPurchase'] : null;
        $this->setIdUser=(!empty($donnees['idUser']))? $donnees ['idUser'] : null;
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
    
//    porterties
    
     function getIdVote() {
        return $this->idVote;
    }

    function getResultat() {
        return $this->resultat;
    }

    function getIdPurchase() {
        return $this->idPurchase;
    }
    
    function getIdUser() {
        return $this->idUser;
    }
    
    function setIdVote($idVote) {
        $this->idVote = $idvote;
    }

    function setResultat($resultat) {
        $this->resultat = $resultat;
    }
    
    function setIdPurchase($idPurchase) {
        $this->idPurchase = $idPurchase;
    }
    
     function setIdUser($idUser) {
        $this->idUser = $idUser;
    }
    
//    function getProduitsListe() {
//        return $this->produitsListe;
//    }
//
//    function setProduitsListe($produitsListe) {
//        $this->produitsListe = $produitsListe;
//    }


}
