<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class CopiesTable
{
   protected $tableGateway; 
   protected $toolsTableGateway;
    
  function __construct(TableGateway $tableGateway,$toolsTableGateway) {
       $this->tableGateway = $tableGateway;
       $this->toolsTableGateway = $toolsTableGateway; 
   }
   
// Test
//   public function obtenirCopies() {
//       return ($this->tableGateway->select());
//   }
//   
   
   // Sélectionne les Copies par
   public function obtenirCopiePar($filtres=[]){
       $vrCopie=$this->tableGateway->select($filtres);
       $tabCopies = $vrCopie->current();
       return($tabCopies);
   }
   
   // Sélectionne les objets existants(copies) de l'objet générique choisi (tool)
   public function obtenirCopiesParTool($idTool){
       $ListCopies=$this->tableGateway->select(['idTool'=>$idTool]);
           return($ListCopies);
   }
   
    // Partie du futur admin 
    
    public function insertCopy($copy) 
    {
        $copiesTab = $copy->toArray();
        $resultat = $this->tableGateway->insert($copiesTab);
        return ($resultat);
    }
    
    public function updateCopy($copy) 
    {
        $copiesTab = $copy->toArray();
        $idCopie = $copy->getId();
        $resultat = $this->tableGateway->update($copiesTab,['Id'=>$idCopie]);
        return ($resultat);
    }
    
    public function deleteCopy($copy) 
    {
        $idCopie = $copy->getId();
        $resultat = $this->tableGateway->delete(['Id'=>$idCopie]);
        return ($resultat);
    }
  }
?>