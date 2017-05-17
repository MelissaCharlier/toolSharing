<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway; 

class ToolsTable{
    
    
    protected $tableGateway; 
    protected $categoriesTableGateway;
    
    public function __construct(TableGateway $tableGateway, $categoriesTableGateway){
        $this->tableGateway= $tableGateway;
        $this->categoriesTableGateway= $categoriesTableGateway;
    }
    
//  test 
//     public function obtenirTools(){
//        return ($this->tableGateway->select());
//    }
//    
    //Sélectionne les object génriques (tools) par id;
    public function obtenirToolParId($idTool){
       $vrTool=$this->tableGateway->select(['idTool'=>$idTool]);
       return($vrTool->current());
   }
      // Sélectionne les objets génériques (tools) de la catégotie choisie ( categorie)
   public function obtenirToolsParCategorie($idCategorie){
       $objTools=$this->tableGateway->select(['idCategorie'=>$idCategorie]);
        return($objTools);
   }
    
    // Partie du futur admin 
    
    public function insertCopy($tool) 
    {
        $toolsTab = $tool->toArray();
        $resultat = $this->tableGateway->insert($toolsTab);
        return ($resultat);
    }
    
    public function updateCopy($tool) 
    {
        $toolsTab = $tool->toArray();
        $idTool = $tool->getId();
        $resultat = $this->tableGateway->update($toolsTab,['Id'=>$idTool]);
        return ($resultat);
    }
    
    public function deleteCopy($tool) 
    {
        $idTool = $tool->getId();
        $resultat = $this->tableGateway->delete(['Id'=>$idTool]);
        return ($resultat);
    }
}