<?php

namespace Tickets\Model\Entities;

use Zend\Filter\StaticFilter;

class Ticket 
{
    public $id = null;
    
    public $projectId = null;
    public $project = null;
    public $projectColor = null;
    
    public $creatorId = null;
    public $creatorFirstname = null;
    public $creatorLastname = null;
    
    public $assignId = null;
    public $assignFirstname = null;
    public $assignLastname = null;
    
    public $title = null;
    public $ticket = null;
    
    public $statusId = null;
    public $status = null;
    public $statusColor = null;
    
    public $prioId = null;
    public $prio = null;
    public $prioColor = null;
    
    public $create = null;
    public $deadline = null;
    public $departmentId = null;
    public $department = null;
    
    public $assumed = null;
    public $denyReason = null;




    /*
     * get referenceMap for Table relations
     */
    public function getReferenceMap()
    {
        return  array(
            'status' => array(
                'status',
                'color',
            ),
            'prio' => array(
                'prio',
                'color',
            ),
            'department' => array(
                'department',
            ),
            'project' => array(
                'project',
                'color',
            ),
        );       
    }
    
    
    
    /*
     * id get and set
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    /*
     * projectId get and set
     */
    public function setProjectId($id)
    {
        $this->projectId = $id;
    }
    
    public function getProjectId()
    {
        return $this->projectId;
    }
    
    /*
     * project get and set
     */
    public function setProject($value)
    {
        $this->project = $value;
    }
    
    public function getProject()
    {
        return $this->project;
    }
    
    /*
     * projectColor get and set
     */
    public function setProjectColor($value)
    {
        $this->projectColor = $value;
    }
    
    public function getProjectColor()
    {
        return $this->projectColor;
    }
    
    /*
     * creatorId get and set
     */
    public function setCreatorId($id)
    {
        $this->creatorId = $id;
    }
    
    public function getCreatorId()
    {
        return $this->creatorId;
    }
    
    /*
     * creator (User->firstname)get and set
     */
    public function setCreatorFirstname($value)
    {
        $this->creatorFirstname = $value;
    }
    
    public function getCreatorFirstname()
    {
        return $this->creatorFirstname;
    }
    
    /*
     * creator (User->lastname)get and set
     */
    public function setCreatorLastname($value)
    {
        $this->creatorLastname = $value;
    }
    
    public function getCreatorLastname()
    {
        return $this->creatorLastname;
    }
    
    /*
     * titel get and set
     */
    public function setTitle($value)
    {
        $this->title = $value;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    /*
     * ticket get and set
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }
    
    public function getTicket()
    {
        return $this->ticket;
    }
    
    /*
     * assignId get and set
     */
    public function setAssignId($id)
    {
        $this->assignId = $id;
    }
    
    public function getAssignId()
    {
        return $this->assignId;
    }
    
    /*
     * assign(User->firstname) get and set
     */
    public function setAssignFirstname($value)
    {
        $this->assignFirstname = $value;
    }
    
    public function getAssignFirstname()
    {
        return $this->assignFirstname;
    }
    
    /*
     * assign(User->lastname) get and set
     */
    public function setAssignLastname($value)
    {
        $this->assignLastname = $value;
    }
    
    public function getAssignLastname()
    {
        return $this->assignLastname;
    }
    
    /*
     * statusId get and set
     */
    public function setStatusId($id)
    {
        $this->statusId = $id;
    }
    
    public function getStatusId()
    {
        return $this->statusId;
    }
    
    /*
     * status get and set
     */
    public function setStatus($value)
    {
        $this->status = $value;
    }
    
    public function getStatusy()
    {
        return $this->status;
    }
    
    /*
     * statusColor get and set
     */
    public function setStatusColor($value)
    {
        $this->statusColor = $value;
    }
    
    public function getStatusColor()
    {
        return $this->statusColor;
    }
    
    /*
     * prioId get and set
     */
    public function setPrioId($id)
    {
        $this->prioId = $id;
    }
    
    public function getPrioId()
    {
        return $this->prioId;
    }
    
    /*
     * prio get and set
     */
    public function setPrio($value)
    {
        $this->prio = $value;
    }
    
    public function getPrio()
    {
        return $this->prio;
    }
    
    /*
     * prio get and set
     */
    public function setPrioColor($value)
    {
        $this->prioColor = $value;
    }
    
    public function getPrioColor()
    {
        return $this->prioColor;
    }
    
    /*
     * create get and set
     */
    public function setCreate($create)
    {
        $this->create = $create;
    }
    
    public function getCreate()
    {
        return $this->create;
    }
    
    /*
     * deadline get and set
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }
    
    public function getDeadline()
    {
        return $this->deadline;
    }
    
    /*
     * departmentId get and set
     */
    public function setDepartmentId($id)
    {
        $this->departmentId = $id;
    }
    
    public function getDepartmentId()
    {
        return $this->departmentId;
    }
    
    /*
     * departmentEntity get and set
     */
    public function setDepartment($value)
    {
        $this->department = $value;
    }
    
    public function getDepartment()
    {
        return $this->department;
    }
    
    /*
     * assumed get and set
     */
    public function setAssumed($value)
    {
        $this->assumed = $value;
    }
    
    public function getAssumed()
    {
        return $this->assumed;
    }
    
    /*
     * assumed get and set
     */
    public function setDenyReason($value)
    {
        $this->denyReason = $value;
    }
    
    public function getDenyReason()
    {
        return $this->denyReason;
    }
       
    public function exchangeArray(Array $data)
    {
        foreach($data AS $key => $value){
            if(empty($value)){
                continue;
            }
            
            $method = 'set' . StaticFilter::execute($key, 'wordunderscoretocamelcase');
            
            if(!method_exists($this, $method)){
                continue;
            }
            $this->$method($value);
        }
    }
    
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'project_id' => $this->getProjectId(),
            'creator_id' => $this->getCreatorId(),
            'title' => $this->getTitle(),
            'ticket' => $this->getTicket(),
            'assign_id' => $this->getAssignId(),
            'status_id' => $this->getStatusId(),
            'prio_id' => $this->getPrioId(),
            'create' => $this->getCreate(),
            'department_id' => $this->getDepartmentId(),
            'deadline' => $this->getDeadline(),
            'assumed' => $this->getAssumed(),
        );
    }
}

