<?php
namespace Application\Model;

class Categorie{
    // les attributs de base de la categorie
    public $idCategorie;
    public $name;
    public $pictures;
     
    // Lien avec la table outils(génériques) et compétences
    public $idTool;
//    public $idSkill;
    
    
    
    
    public function exchangeArray($data){
        $this->idCategorie=(!empty($data['idCategorie'])?$data['idCategorie']:null);
        $this->name=(!empty($data['name'])?$data['name']:null);
        $this->pictures=(!empty($data['pictures'])?$data['pictures']:null);
        $this->idTool=(!empty($data['idTool'])?$data['idTool']:null);
        $this->idSkill=(!empty($data['idSkill'])?$data['idSkill']:null);
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
        
        
        return (['idCategorie'=>$this->getIdCategorie(),
                 'nom'=>$this->getNom(),
                 'pictures'=>$this->getPictures()
                ]);
        
    }
    
    
    function getIdCategorie() {
        return $this->idCategorie;
    }

    function getName() {
        return $this->name;
    }
    
    function getPictures() {
        return $this->pictures;
    }
    
    function getIdTool() {
        return $this->idTool;
    }

//    function getIdSkill() {
//        return $this->idSkill;
//    }
    
    function setIdCategorie($idCategorie) {
        $this->idCategorie = $idCategorie;
    }

    function setNom($name) {
        $this->name = $name;
    }
    
    function setPictures($pictures) {
        $this->pictures = $pictures;
    }
   
    function setIdTool($idTool) {
        $this->idTool = $idTool;
    }
    
//    function setIdSkill($idSkill) {
//        $this->idSkill = $idSkill;
//    }

    

}
