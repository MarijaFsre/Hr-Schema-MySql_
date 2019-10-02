<?php
//kontroler koji sluzi da dohvaca i salje potrebne podatke na view i model.Odnosno komunicira izmedu modlea i view-a

define('ROOT_PATH', dirname(__DIR__) . '/');
include(ROOT_PATH.'/model/Employees.php');
 //include "../model/Employees.php";
 //include './connection.php';
 include(ROOT_PATH.'connection.php');

class EmployeesController{

  //private $db;
	//private $connection;
	private $employees;

  public function __construct() {
        $db = new Connection();
        $connection =  $db->getConnstring();
        $this->employees = new Employees($connection);
 }


public function listEmployees($id=0){
  $data = $this->employees->get_employees($id);
  return $data;
}
public function listJobs(){
  $data = $this->employees->get_jobs();
  return $data;
}
public function listDepartments(){
  $data = $this->employees->get_departments();
  return $data;
}

public function createEmployee($data){
  if(
      !empty($data['first_name']) &&
      !empty($data['last_name']) &&
      !empty($data['email']) &&
      !empty($data['phone_number']) &&
      !empty($data['hire_date']) &&
      !empty($data['job_id']) &&
      !empty($data['salary']) &&
      !empty($data['department_id'])
  ){
    $res = $this->employees->post_employee($data['first_name'],$data['last_name'],$data['email'],$data['phone_number'],$data['hire_date'],$data['job_id'],$data['salary'],$data['department_id']);
    return $res;
  }else {
    return array("message" => "Nije moguce unijeti zaposlenika. Svi podatci nisu tu.");
  }

}
public function update_employee($data){
  if(
      !empty($data->first_name) &&
      !empty($data->last_name) &&
      !empty($data->email) &&
      !empty($data->phone_number) &&
      !empty($data->hire_date) &&
      !empty($data->job_id) &&
      !empty($data->salary) &&
      !empty($data->department_id)
  ){
    $res = $this->employees->update_employee($data->first_name,$data->last_name,$data->email,$data->phone_number,$data->hire_date,$data->job_id,$data->salary,$data->department_id);
    return $res;
  }else {
    return array("message" => "Nije moguce azurirati zaposlenika. Svi podatci nisu tu.");
  }

}
	public function delete_employee($id){
	  if(!empty($id)){
	      $res = $this->employees->delete_employee($id);
	      return $res;
	  }
	  else {
	    return array("message" => "Nije moguce obrisati zaposlenika. Nije unesen id zaposlenika.");
	  }
	}
}
?>
