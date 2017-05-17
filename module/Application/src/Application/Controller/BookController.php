 <?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Module\Copie;
use Application\Module\BookOffer;
use Application\Module\User;

class BookController extends AbstractActionController
{
     // Ajout d'un Book
    public function insertBookAction(){
        session_start();
        $booksTable= $this->getServiceLocator()->get("BookOffersTableCRUD");
        $idUser = $this->getRequest()->getPost('nom');
        $idCopie = $this->getRequest()->getPost('copie');
        $DateChoisie = $this->getRequest()->getPost('dateChoisie');
        $newBook= new book(['BookingDate'=>$DateChoisie,
                               'idCopie'=>$idCopie,
                               'idUser'=>$idUser,
                              ]); 
        // Message de confirmation de l'insertion
        if($booksTable->insertBook($newBook)){
            $msg="Insertion ok";
        }
        else {
            $msg="Probleme insertion";
        }
        return new ViewModel (['msg'=>$msg]);
        
        
    }
  
    // Mise à jour Bookingdate
    public function updateBookingAction() {
        $booksTable= $this->getServiceLocator()->get("BookOffersTableCRUD");
        $idBook= $this->params()->fromQuery('id');
        $unBook= $booksTable->obtenirBookParId($idBook);
      
        
        // on change de date
        $unBook->setBookingDate('');
        
        
        // message de validation de l'action
        if($booksTable->updateBook($unBook)){
            $msg="Update ok";
        }
        else {
            $msg="Probleme update";
        }
        return new ViewModel (['msg'=>$msg]);
    }
     // Mise à jour copie
    public function updateTestCopieAction() {
        $booksTable= $this->getServiceLocator()->get("BookOffersTableCRUD");
        $idBook= $this->params()->fromQuery('id');
        $uneCopie= $booksTable->obtenirBookParId($idBook);
      
        
        // on change de copie
        $uneCopie->setIdCopie('');
        
        
        // message de validation de l'action
        if($booksTable->updateBook($uneCopie)){
            $msg="Update ok";
        }
        else {
            $msg="Probleme update";
        }
        return new ViewModel (['msg'=>$msg]);
    }
    
    // Effacer un Book
    public function deleteProduitTestAction(){
        $booksTable= $this->getServiceLocator()->get("BookOffersTableCRUD");
        $idBook= $this->params()->fromQuery('id');
        $unBook= $booksTable->obtenirBookParId($idBook);
      
           
        if ($booksTable->deleteProduit($unBook)){
            $msg="Supression ok";
        }
        else {
            $msg="Probleme supression";
        }
        return new ViewModel (['msg'=>$msg]);
        
    }
}