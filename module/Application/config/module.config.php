<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'route'    => '/[:controller[/:action[/:id][/:id2]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9a-zA-Z]*',
                                'id2' => '[0-9a-zA-Z]*'
                            ),
                            'defaults' => array(
                                /*'NAMESPACE'=>'Application\Controller',
                                'controller'=>'Test',
                                'action'=>'index',
                                'id'=>*/
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
     'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            
            //TableGateway
            // Votes
            'VotesTableGateway' => function ($sm){
                $adapter= $sm->get('Zend\Db\Adapter'); // obetenir l'adapter
                $resultSet= new Zend\Db\ResultSet\ResultSet(); // initialise l'objet
                 // on dit qu'on ne veut pas un array comme réponse mai sbine un objet
                $resultSet-> setArrayObjectPrototype(new \Application\Model\Vote());
                // \Zend\Db\TableGateway\TableGateway($table, $adapter);
                // $table est remplacé par le nom de la table de DB avec laquelle on souhaite travailler  
                return new \Zend\Db\TableGateway\TableGateway('votes', $adapter , null, $resultSet); 
            },   
            'VotesTableCRUD'=> function ($sm) {
                $tableGateway = $sm->get ("VotesTableGateway");
                $voteManager = new \Application\Model\VotesTable($tableGateway);
                return $voteManager;
            },
            // Copies
            'CopiesTableGateway' => function ($sm){
                $adapter= $sm->get('Zend\Db\Adapter\Adapter'); 
                $resultSet= new Zend\Db\ResultSet\ResultSet();
                $resultSet-> setArrayObjectPrototype(new \Application\Model\Copie());
                return new \Zend\Db\TableGateway\TableGateway('copies', $adapter , null, $resultSet); 
            },   
            'CopiesTableCRUD'=> function ($sm) {
                $tableGateway = $sm->get("CopiesTableGateway");
                $toolsTableGateway = $sm->get("ToolsTableGateway");
                $copieManager = new \Application\Model\CopiesTable($tableGateway,$toolsTableGateway);
                return $copieManager;
            },
            // Tools
            'ToolsTableGateway' => function ($sm){
                $adapter= $sm->get('Zend\Db\Adapter\Adapter');
                $resultSet= new Zend\Db\ResultSet\ResultSet();
                $resultSet-> setArrayObjectPrototype(new \Application\Model\Tool());
                return new \Zend\Db\TableGateway\TableGateway('tools', $adapter , null, $resultSet); 
            },   
            'ToolsTableCRUD'=> function ($sm) {
                $tableGateway = $sm->get("ToolsTableGateway");
                $categoriesTableGateway = $sm->get("CategoriesTableGateway");
                $toolManager = new \Application\Model\ToolsTable($tableGateway,$categoriesTableGateway);
                return $toolManager;
            },
             // Users
            'UsersTableGateway' => function ($sm){
                $adapter= $sm->get('Zend\Db\Adapter\Adapter');
                $resultSet= new Zend\Db\ResultSet\ResultSet();
                $resultSet-> setArrayObjectPrototype(new \Application\Model\User());
                return new \Zend\Db\TableGateway\TableGateway('users', $adapter , null, $resultSet); 
            },   
            'UsersTableCRUD'=> function ($sm) {
                $tableGateway = $sm->get("UsersTableGateway");
                $userManager = new \Application\Model\UsersTable($tableGateway);
                return $userManager;
            },
              // bookOffer
            'BookOffersTableGateway' => function ($sm){
                $adapter= $sm->get('Zend\Db\Adapter\Adapter');
                $resultSet= new Zend\Db\ResultSet\ResultSet(); 
                $resultSet-> setArrayObjectPrototype(new \Application\Model\BookOffer());
                return new \Zend\Db\TableGateway\TableGateway('bookOffer', $adapter , null, $resultSet); 
            },   
            'BookOffersTableCRUD'=> function ($sm) {
                $tableGateway = $sm->get("BookOffersTableGateway");
                $usersTableGateway = $sm->get("UsersTableGateway");
                $copiesTableGateway = $sm->get("CopiesTableGateway");
                $bookOfferManager = new \Application\Model\BookOffersTable($tableGateway,$usersTableGateway,$copiesTableGateway);
                return $bookOfferManager;
            },
              // Categories
            'CategoriesTableGateway' => function ($sm){
                $adapter= $sm->get('Zend\Db\Adapter\Adapter'); 
                $resultSet= new Zend\Db\ResultSet\ResultSet(); 
                $resultSet-> setArrayObjectPrototype(new \Application\Model\Categorie());
                return new \Zend\Db\TableGateway\TableGateway('categories', $adapter , null, $resultSet); 
            },   
            'CategoriesTableCRUD'=> function ($sm) {
                $tableGateway = $sm->get("CategoriesTableGateway");
                $categorieManager = new \Application\Model\CategoriesTable($tableGateway);
                return $categorieManager;
            }
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Book' => 'Application\Controller\BookController',
            'Application\Controller\User' => 'Application\Controller\UserController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
