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
use Application\Module\Tool;
use Application\Module\Categorie;

class IndexController extends AbstractActionController
{

//    public function afficherCopiesAction()
//    {
//        $copiesTable = $this->getServiceLocator()->get("CopiesTableCRUD");
//        //On crée une varaiable pour recevoir l'appel de l'objet qui fait appel au service manager qui gère CopieTableCRUD
//        $copies = $copiesTable->obtenirCopies();
//        //On crée une varaible pour stocker l'appel de la fonction 
//        
//        return new ViewModel(["toutesLesCopies"=>$copies]);
//    }
//    
//     public function afficherToolsAction()
//    {
//        $toolsTable = $this->getServiceLocator()->get("ToolsTableCRUD");
//        //On crée une varaiable pour recevoir l'appel de l'objet qui fait appel au service manager qui gère CopieTableCRUD
//        $tools = $toolsTable->obtenirTools();
//        //On crée une varaible pour stocker l'appel de la fonction 
//        
//        return new ViewModel(["tousLesTools"=>$tools]);
//    }
//    
//      public function afficherListeCopiesAction()
//    {
//        $copiesTable = $this->getServiceLocator()->get("CopiesTableCRUD");
//        $idTool= $this->params()->fromQuery('id');
//        $listeCopies = $copiesTable->obtenirCopiesParTool($idTool);
//        return new ViewModel(["listeCopies"=>$listeCopies]);
//    }
    //Catalogue des catégories
    public function afficherToutesLesCategoriesAction(){
        $categoriesTable=$this->getServiceLocator()->get("CategoriesTableCRUD");//obtenir le service 
        $categories=$categoriesTable->obtenirCategories();//obtenir les données de la BD
        return new ViewModel(['toutesLesCategories'=>$categories]);//renvoyer à la vue 
    }  
    
    //Lister les tools (génériques) de la catégories
    public function afficherListeToolsDeLaCategorieAction()
    {
        $toolsTable = $this->getServiceLocator()->get("ToolsTableCRUD");
        $idCategorie= $this->params()->fromQuery('id');
        $listeTools = $toolsTable->obtenirToolsParCategorie($idCategorie);
        return new ViewModel(["listeTools"=>$listeTools]);
    }
    
    // Lister les outils appartenant à tool générique choisi
    public function afficherListeCopiesDuToolAction()
    {
        $copiesTable = $this->getServiceLocator()->get("CopiesTableCRUD");
        $idTool= $this->params()->fromQuery('id');
        $listeCopies = $copiesTable->obtenirCopiesParTool($idTool);
        return new ViewModel(["listeCopies"=>$listeCopies]);
    }
    
    public function afficherFormBookAction(){
        return new ViewModel();
    }
    // Partie Admin
    
   
}
