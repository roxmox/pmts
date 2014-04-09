<?php
namespace Tickets\Forms;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TicketFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $status = $serviceLocator->get('Tickets\Model\Tables\StatusTable')->getFormArray();
        $prio = $serviceLocator->get('Tickets\Model\Tables\PrioTable')->getFormArray();
        $departments = $serviceLocator->get('Tickets\Model\Tables\DepartmentTable')->getFormArray();
        $users = $serviceLocator->get('User\Model\Dbtables\User')->getFormArray();
        $projects = $serviceLocator->get('Tickets\Model\Tables\ProjectTable')->getFormArray();
        $identity = $serviceLocator->get('User\Auth\AuthService')->getIdentity();
        $form = new TicketForm();
        if($identity){
            $form->setStatusArray($status);
            $form->setPrioArray($prio);
            $form->setDepartmentsArray($departments);
            $form->setUserId($identity->id);
            $form->setUserArray($users);
            $form->setProjectsArray($projects);
          }
          return $form->getForm();
    }
}
