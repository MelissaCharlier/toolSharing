<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway; 

class CategoriesTable{

    protected $tableGateway; 

    
   
    public function __construct(TableGateway $tableGateway){
        $this->tableGateway= $tableGateway;
    }
    
    // renvoie toutes les categories
    public function obtenirCategories(){
        return ($this->tableGateway->select());
    }
    
    // Partie du futur admin 
    
    public function insertCategory($category) 
    {
        $categoriesTab = $category->toArray();
        $resultat = $this->tableGateway->insert($categoriesTab);
        return ($resultat);
    }
    
    public function updateCategory($category) 
    {
        $categoriesTab = $category->toArray();
        $idCategorie = $category->getId();
        $resultat = $this->tableGateway->update($categoriesTab,['Id'=>$idCategorie]);
        return ($resultat);
    }
    
    public function deleteCategory($category) 
    {
        $idCategorie = $category->getId();
        $resultat = $this->tableGateway->delete(['Id'=>$idCategorie]);
        return ($resultat);
    }
}  

    

