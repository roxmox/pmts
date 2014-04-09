<?php
return array(
    'controllers' => array(
        'factories' => array(
            'tickets' => 'Tickets\Controller\TicketsControllerFactory',
            'comments' => 'Tickets\Controller\CommentsControllerFactory',
        ),
    ),
    
    //routing
    'router' => array(
        'routes' => array(
            'tickets' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/tickets[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'tickets',
                        'action'     => 'index',
                    ),
                ),
           ),
           'comments' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/comments[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'comments',
                        'action'     => 'index',
                    ),
                ),
           ),
       ),
    ),
   
    'view_manager' => array(
        'template_path_stack' => array(
            'tickets' => __DIR__ . '/../view',
        ),
        
        'template_map' => array(
            'widget/controller' => realpath(__DIR__ . '/../view/tickets/widget/controller.phtml'),
            'widget/navi' => realpath(__DIR__ . '/../view/tickets/widget/navi.phtml'),
            'comments/helper' => realpath(__DIR__ . '/../view/tickets/comments/comments_helper.phtml'),
            'tickets/new' => realpath(__DIR__ . '/../view/tickets/partial/index/new_tickets.phtml'),
            'mytickets/assumed' => realpath(__DIR__ . '/../view/tickets/partial/mytickets/assumed_tickets.phtml'),
            'mytickets/created' => realpath(__DIR__ . '/../view/tickets/partial/mytickets/created_tickets.phtml'),
            'mytickets/deny' => realpath(__DIR__ . '/../view/tickets/partial/mytickets/deny_tickets.phtml'),
            'mytickets/not_assumed' => realpath(__DIR__ . '/../view/tickets/partial/mytickets/not_assumed_tickets.phtml'),
        ),
    ),
    
    'view_helpers' => array(
       'factories' => array(
           'ShowControllerWidget' => 'Tickets\View\Helper\ShowControllerWidgetFactory',
           'NaviWidget' => 'Tickets\View\Helper\NaviWidgetFactory',
           'CommentHelper' => 'Tickets\View\Helper\CommentsHelperFactory',
       ),
        
    ),
    
    'service_manager' => array(
        'invokables' => array(
            'Tickets\Model\Entities\Project' => 'Tickets\Model\Entities\Project',
            'Tickets\Model\Entities\Ticket' => 'Tickets\Model\Entities\Ticket',
            'Tickets\Model\Entities\Comment' => 'Tickets\Model\Entities\Comment',
            'Tickets\Model\Entities\Status' => 'Tickets\Model\Entities\Status',
            'Tickets\Model\Entities\Prio' => 'Tickets\Model\Entities\Prio',
            'Tickets\Model\Entities\File' => 'Tickets\Model\Entities\File',
            'Tickets\Model\Entities\Department' => 'Tickets\Model\Entities\Department',
            'Tickets\Forms\UploadForm'  => 'Tickets\Forms\UploadForm',
        ),
        'factories' =>array(
            //db tables
            'Tickets\Model\Tables\PrioTable'  => 'Tickets\Model\Tables\Factories\PrioTableFactory',
            'Tickets\Model\Tables\ProjectTable' => 'Tickets\Model\Tables\Factories\ProjectTableFactory',
            'Tickets\Model\Tables\StatusTable'  => 'Tickets\Model\Tables\Factories\StatusTableFactory',
            'Tickets\Model\Tables\TicketTable'  => 'Tickets\Model\Tables\Factories\TicketTableFactory',
            'Tickets\Model\Tables\CommentTable'  => 'Tickets\Model\Tables\Factories\CommentTableFactory',
            'Tickets\Model\Tables\DepartmentTable'  => 'Tickets\Model\Tables\Factories\DepartmentTableFactory',
            'Tickets\Model\Tables\FilesTable'  => 'Tickets\Model\Tables\Factories\FilesTableFactory',
            'Tickets\Model\Tables\UserTable'  => 'User\Model\Dbtables\UserTableFactory',
            //services
            'Tickets\Service\Ticket'  => 'Tickets\Service\TicketServiceFactory',
            'Tickets\Service\Comments'  => 'Tickets\Service\CommentServiceFactory',
            //forms
            'Tickets\Forms\TicketForm'  => 'Tickets\Forms\TicketFormFactory',
            'Tickets\Forms\CommentForm'  => 'Tickets\Forms\CommentFormFactory',
            //call getName() method to define navigation
            'ticket_navi' => 'Tickets\Navigation\TicketNavigationFactory',
           
        ),
    ),
    
    'input_filters' => array(
        'invokables' => array(
            'Ticket\Filter\Ticket'   => 'Tickets\Filter\TicketFilter',
        ),
    ),
    
     'navigation' => array(
         'tickets_menu' => array(
             'home' => array(
                'type'       => 'mvc',
                'order'      => '600',
                'label'      => 'Home',
                'route'      => 'application',
                'controller' => 'index',
                'action'     => 'index',
            ),
            'postbox' => array(
                'type'       => 'mvc',
                'order'      => '700',
                'label'      => 'Ticket Eingang',
                'route'      => 'tickets',
                'controller' => 'tickets',
                'action'     => 'index',
                
            ),
            'tickets' => array(
                'type'       => 'mvc',
                'order'      => '800',
                'label'      => 'Meine Tickets',
                'route'      => 'tickets',
                'controller' => 'tickets',
                'action'     => 'mytickets',
                
            ),
            'new' => array(
                'type'       => 'mvc',
                'order'      => '900',
                'label'      => 'Neues Ticket',
                'route'      => 'tickets',
                'controller' => 'tickets',
                'action'     => 'new',
                
            ),
        ),
    ),
);