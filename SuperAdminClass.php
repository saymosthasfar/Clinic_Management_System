<?php
require("Admins/AdminClass.php");

class SuperAdmin
{
    protected $admins;
    protected $clinics;

    public function addClinic($clinic)
    {
        $this->clinics[] = $clinic;
    }
    public function getClinics()
    {
        return $this->clinics;
    }
    public function addClinicToDb($clinic)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("INSERT INTO clinics (name, address, is_active, phone, is_full_time) VALUES (?,?,1,?,?)");
        $name = $clinic->getName();
        $address = $clinic->getAddress();
        $phone = $clinic->getPhoneNumber();
        $fulltime = $clinic->getIsFullTime();
        $action->bind_param("ssss", $name, $address, $phone, $fulltime);
        $action->execute();
    }
    public function removeClinicFromDb($id)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("DELETE FROM clinics WHERE id=?");
        $action->bind_param("s", $id);
        $action->execute();
    }
    public function editClinic($id, $clinic)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("UPDATE clinics SET name=?, address=?, phone=?, is_full_time=? WHERE id=?");
        $name = $clinic->getName();
        $address = $clinic->getAddress();
        $phone = $clinic->getPhoneNumber();
        $fulltime = $clinic->getIsFullTime();
        $action->bind_param("sssss", $name, $address, $phone, $fulltime, $id);
        $action->execute();
    }

    /* ADMINS AREA */
    public function addAdmin($admin)
    {
        $this->admins[] = $admin;
    }
    public function getAdmins()
    {
        return $this->admins;
    }
    public function addAdminToDb($admin)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("INSERT INTO admins (username, password, email, is_active) VALUES (?,?,?,1)");
        $username = $admin->getUsername();
        $password = $admin->getPassword();
        $email = $admin->getEmail();
        $action->bind_param("sss", $username, /*password_hash($password, PASSWORD_BCRYPT)*/$password, $email);
        $action->execute();
    }
    public function removeAdminFromDb($id)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("DELETE FROM admins WHERE id=?");
        $action->bind_param("s", $id);
        $action->execute();
    }
    public function editAdmin($id, $admin)
    {
        $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
        $action = $dbHnd->dbObject->prepare("UPDATE admins SET username=?, password=?, email=? WHERE id=?");
        $username = $admin->getUsername();
        $password = $admin->getPassword();
        $email = $admin->getEmail();
        $action->bind_param("ssss", $username, $password, $email, $id);
        $action->execute();
    }
    /* ADMINS AREA END */
}