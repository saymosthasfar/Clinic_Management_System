<?php
require("../Sections/SectionClass.php");

class clinic {
    protected $name;
    protected $address;
    protected $isActive;
    protected $phoneNumber;
    protected $isFullTime;
    protected $id;
    protected $sections;

    /* CLINICS AREA */
    public function addSectionToDb($section)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("INSERT INTO sections (title, is_active) VALUES (?,?)");
        $title = $section->getTitle();
        $active = $section->getIsActive();
        $action->bind_param("ss", $title, $active);
        $action->execute();
    }
    public function removeSectionFromDb($id)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("DELETE FROM sections WHERE id=?");
        $action->bind_param("s", $id);
        $action->execute();
    }
    public function editSection($id, $section)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("UPDATE sections SET title=?, is_active=? WHERE id=?");
        $title = $section->getTitle();
        $active = $section->getIsActive();
        $action->bind_param("sss", $title, $active, $id);
        $action->execute();
    }
    /* CLINICS AREA END */
    public function addSection($section)
    {
        $this->sections[] = $section;
    }
    public function getSections()
    {
        return $this->sections;
    }
    
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    
    public function getIsActive()
    {
        return $this->isActive;
    }
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }
    
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
    
    public function getIsFullTime()
    {
        return $this->isFullTime;
    }
    public function setIsFullTime($isFullTime)
    {
        $this->isFullTime = $isFullTime;
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
}