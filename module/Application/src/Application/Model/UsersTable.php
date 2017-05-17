<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway; 

class UsersTable{
    
    
    protected $tableGateway; 
    
    public function __construct($tableGateway){
        $this->tableGateway= $tableGateway;
      
    }
    
    public function insertUser($user){
        $tabUser = $user->toArray();
        $resultat = $this->tableGateway->insert($tabUser);
        return ($resultat);
    }
    
    public function updateUser($user){
        $tabUser = $user->toArray();
        $idUser = $user->getIdUser();
        $resultat = $this->tableGateway->update($tabUser,['idUser'=>$idUser]);
        return ($resultat);
    }
    
    public function deleteUser($user){
        $idUser = $user->getIdUser();
        $resultat = $this->tableGateway->delete(['idUser'=>$idUser]);
        return ($resultat);
    }
    
    // Partie du futur Admin + pour fct update UserController 
      public function obtenirUserPar($filtres = []){
        $resultats = $this->tableGateway->select($filtres); 
        $tabUser= $resultats->current();
        return $tabUser;
    }
}