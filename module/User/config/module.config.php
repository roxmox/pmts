<?php
return array(
    'controllers' => array(
        'invokables' => array(
           //'User\Controller\Admin' => 'User\Controller\AdminController',
        ),
        'factories' => array(
            'user' => 'User\Controller\UserControllerFactory',
            'user-admin' => 'User\Controller\AdminControllerFactory',
        ),
    ),
    
    //routing
    'router' => array(
        'routes' => array(
            'user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/user[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'user',
                        'action'     => 'index',
                    ),
                ),
           ),
            
           'user-admin' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/user-admin[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'user-admin',
                        'action'     => 'index',
                    ),
                ),
           ),
            
            
        ),
    ),
   
    'view_manager' => array(
        'template_path_stack' => array(
            'user' => __DIR__ . '/../view',
        ),
        
        'template_map' => array(
            'widget/logout' => realpath(__DIR__ . '/../view/user/widget/logout.phtml'),
            'widget/login'  => realpath(__DIR__ . '/../view/user/widget/login.phtml'),
        ),
    ),
    
    'view_helpers' => array(
       'factories' => array(
           'UserShowWidget' => 'User\View\Helper\UserShowWidgetFactory',
           'UserIsAllowed' => 'User\View\Helper\UserIsAllowedFactory',
       ),
    ),
    
    'service_manager' => array(
        'invokables' => array(
            'User\Model\Entities\User' => 'User\Model\Entities\User',
            'User\Forms\Login' => 'User\Forms\LoginForm',
        ),
        'factories' =>array(
            'User\Model\Dbtables\User'  => 'User\Model\Dbtables\UserTableFactory',
            'User\Auth\AuthAdapter'  => 'User\Authentication\AuthAdapterFactory',
            'User\Auth\AuthService'  => 'User\Authentication\AuthServiceFactory',
            'User\Acl\AclService'  => 'User\Acl\AclServiceFactory',
            'User\Service\User'  => 'User\Service\UserServiceFactory',
            'user_navi' => 'User\Navigation\UserNavigationFactory',
        ),
    ),
    
    'input_filters' => array(
        'invokables' => array(
            'User\Filter\User'   => 'User\Filter\UserFilter',
        ),
    ),
    
     'navigation' => array(
        'user_menu' => array(
            'home' => array(
                'type'       => 'mvc',
                'order'      => '600',
                'label'      => 'Home',
                'route'      => 'application',
                'controller' => 'index',
                'action'     => 'index',
            ),
            'user' => array(
                'type'       => 'mvc',
                'order'      => '700',
                'label'      => 'Benutzer',
                'route'      => 'user-admin',
                'controller' => 'admin',
                'action'     => 'index',
            ),
             'add' => array(
                'type'       => 'mvc',
                'order'      => '700',
                'label'      => 'Neuer User',
                'route'      => 'user-admin',
                'controller' => 'admin',
                'action'     => 'add',
            ),
         ),
    ),
);