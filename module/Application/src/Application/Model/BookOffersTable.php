<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class BookOffersTable
{
   protected $tableGateway; 
   protected $usersTableGateway;
   protected $copiesTableGateway;
//   protected $skillsTableGateway;
    
    function __construct(TableGateway $tableGateway,$usersTableGateway,$copiesTableGateway) {
       $this->tableGateway = $tableGateway;
       $this->usersTableGateway = $usersTableGateway; 
       $this->copiesTableGateway = $copiesTableGateway; 
    }

    // Sélectionne les books par leur clé primaire
    function obtenirBookParId($idBookOffer){
       $vrBook=$this->tableGateway->select(['idBookOffer'=>$idBookOffer]);
       return($vrBook->current());
   }
 
    // Obtenir tous les BookOffer de l'utilisateur
    function obtenirBookOfferByUser($idUser){
        $vrBook=$this->tableGateway->select($idUser);
        return($vrBook);
    }
    
    // Insère un objet dans la BD. Cette fonction reçoit un objet et le transforme dans un array
    // dont la fonction insert de TableGateway a besoin
    function insertBook($book){
        
        // transformer en array
        $bookTab= $book->toArray();
        $resultat=$this->tableGateway->insert($bookTab);
        return ($resultat);
    }
    
    // Update une ligne dans la BD. Cette fonction reçoit un objet et le transforme dans un array
    // dont la fonction update de TableGateway a besoin
    function updateBook ($bookChanged){
        
        // transformer en array
        $bookChangedTab = $bookChanged->toArray();
        // on obtient l'id de l'objet à modifier. Update a besoin de connaitre
        // quelle est la ligne à modifier dans la BD
        $idBookOffer=$bookChanged->getIdProduit();
        $resultat=$this->tableGateway->update($bookChangedTab,['idBookOffer'=> $idBookOffer]);
        return ($resultat);
    }
 
    function deleteBook($bookDeleted){
        
        // on obtient l'id de l'objet à effacer. Delete a besoin de connaitre
        // quelle est la ligne à effacer dans la BD        
        $idBookOffer=$bookDeleted->getIdProduit();
        $resultat=$this->tableGateway->delete(['idBookOffer'=> $idBookOffer]);
        return ($resultat);
    }
   
   }

