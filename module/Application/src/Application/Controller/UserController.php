<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

// indiquez au controller l'existence du formulaire
use Application\model\User;
use Application\model\BookOffer;

class UserController extends AbstractActionController
{
        // essais raté d'une insertoin d'une vue dans une vue 
//    public function indexAction()
//    {
//        $viewModelChild = new ViewModel();
//        $viewModelChild->setTemplate('user/book-summary.phtml');
//
//        $viewModel = new ViewModel();
//        $viewModel->addChild($viewModelChild);
//        return $viewModel;
//    }

    public function pagePersoAction(){
        
        
//        session_start();
//        $booksTable = $this->getServiceLocator()->get("BookOffersTableCRUD"); 
//        $books= [];
//        $books = $booksTable->obtenirBookOfferByUser(['idUser' => $_SESSION['user']['idUser']]);
//        foreach ($books as $book){
//        $time=$book->bookingDate;
//        $t= $time->getTimestamp();
//        var_dump($t);
//        }
//        $listFuturBooks = [];
//        $listOldBooks = [];
//        
//        $now = new\DateTime(Date('Y-m-01'));
//        $tpStNow = $now->getTimestamp();
//        var_dump($tpStNow);
//        
//        $tpStBook = $this->bookingDate;
//            var_dump($tpStBook);
//        foreach ($books as $objBook){
//            $tpStBook = $objBook->bookingDate->getTimestamp();
//            var_dump($tpStBook);
//            $idCopieBook = $objBook->idCopie;
//            $copiesTable = $this->getServiceLocator()-> get("CopiesTableCRUD");
//            $objCopy = $copiesTable->obtenirCopiePar(['IdCopieBook'=>$idCopieBook]);
//            $listBookCopie = ['objBook'=>$objBook,'objcopy'=> $objCopy];
//            // comparer le timestamp de l'objbook et now pour déterminer l'[] qui convient
//            if ( $tpStBook > $tpStNow){
//                $listFuturBooks[] = $listBookCopie;
//            }
//            else{
//                $listOldBooks[] = $listBookCopie;
//            }
//        return new ViewModel(['reversationavenir'=>$listFuturBooks, 'reservationpassee'=>$listOldBooks]);
//        }
    }
    
    public function connexionAction(){
        $uname = $this->getRequest()->getPost('uname');
        $pwd = $this->getRequest()->getPost('pwd');
        $usersTable = $this->getServiceLocator()->get("UsersTableCRUD");
        $user = $usersTable->obtenirUserPar(['Username'=>$uname]);
//        if (password_verify($pwd,$user->getPassword())) {
          if ($pwd == $user->getPassword()){
            session_start();
            $_SESSION['user']=$user->toArray();
            $this->redirect()->toUrl('/application/Index/afficherToutesLesCategories');
        }
        else {
            return new ViewModel(["msg"=>"Votre nom d'utilisateur et/ou votre mot de passe ne correspondent pas à nos données, veuillez ré-essayer. "]);
        }
    }
    
    public function deconnexionAction() {
        session_start();
        session_destroy();
        return new ViewModel();
    }
    
    public function updateAction() {
        session_start();     
        if ($this->getRequest()->getPost('mail') != "") {
           $mail = $this->getRequest()->getPost('mail');
        } else {$mail = $_SESSION['user']['mail'];}
        
        $usersTable = $this->getServiceLocator()->get("UsersTableCRUD");
        $uname = $this->getRequest()->getPost ('uname');
        if($uname !=""){
           $unameVerif = $usersTable->obtenirUserPar(['userName' => $uname]);
           if (is_object($unameVerif)){
                return new ViewModel(["msg"=>"Ce nom d'utilisateur est déjà utilisé dans votre communauté, veuillez en choisir un autre"]);
            }
            else {
                
                return new ViewModel(["msg"=>"Nom d'utilisateur enregistré"]);
            }
        } else {$uname=$_SESSION['user']['userName'];}
        
        if ($this->getRequest()->getPost('street') != "") {
           $street = $this->getRequest()->getPost('street');
        } else {$street = $_SESSION['user']['street'];}
        
        if ($this->getRequest()->getPost('number') != "") {
           $number = $this->getRequest()->getPost('number');
        } else {$number = $_SESSION['user']['number'];}
        
        if ($this->getRequest()->getPost('city') != "") {
           $city = $this->getRequest()->getPost('city');
        } else {$city = $_SESSION['user']['city'];}
        
        if ($this->getRequest()->getPost('name') != "") {
           $name = $this->getRequest()->getPost('name');
        } else {$name = $_SESSION['user']['number'];}
        
        if ($this->getRequest()->getPost('firstName') != "") {
           $firstname= $this->getRequest()->getPost('firstName');
        } else {$firstname = $_SESSION['user']['firstName'];}
        
        $userTable = $this->getServiceLocator()->get("UsersTableCRUD");
        $user = new User(['Id'=>$_SESSION['user']['idUser'], 'firstName'=>$firstname, 'name'=>$name, 'street'=>$street,
                        'number'=>$number, 'city'=>$city, 'mail'=>$mail, 'userName'=>$uname]);
        
        if ($userTable->updateUser($user)) {
            $msg = "Vos données ont été changées!";
        } else { $msg = "Error! Veuillez re-essayer! Merci!";}
            
        return new ViewModel(["msg"=>$msg]);
    }
    
    // partie admin
       public function inscriptionAction() {      
        $usersTable = $this->getServiceLocator()->get("UsersTableCRUD");
        $mailVerif = $usersTable->getUser(['mail' => $this->getRequest()->getPost('mail')]);
        
        if (is_object($mailVerif)) {
                return new ViewModel(["msg"=>"Cet utilisateur est déjà dans la base de données"]);
        }
        else {
            $user = new User(['Nom'=>$this->getRequest()->getPost('nom'), 'Prenom'=>$this->getRequest()->getPost('prenom'), 'Email'=>$this->getRequest()->getPost('email'),
                              'Telephone'=>$this->getRequest()->getPost('telephone'), 'Adresse'=>$this->getRequest()->getPost('adresse'), 'Password'=>$pwdHash]);

            if ($usersTable->insertUser($user)) {
                $msg = "Insertion réussie";
            }
            else {
                $msg = "Une erreure s'est produite";
            }

            return new ViewModel(["msg"=>$msg]);
        }
    }
}