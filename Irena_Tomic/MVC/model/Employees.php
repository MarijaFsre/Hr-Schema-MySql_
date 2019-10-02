<?php
//Model employees koji ima zadatak da vrsi dohvat i sljenje podataka na bazu.

class Employees {

    private $employee_id ;
    private $first_name;
    private $last_name;
    private $email;
    private $phone_number;
    private $hire_date;
    private $job_id;
    private $salary;
    private $commision_pct;
    private $manager_id;
    private $department_id;

    private $conn;

    public function __construct($db){
        $this->conn=$db;
    }

    public function get_employees($id=0)
    {
    	$query="SELECT employees.employee_id,employees.first_name,employees.last_name,employees.email,employees.phone_number,employees.hire_date,employees.salary,departments.department_name,jobs.job_title FROM employees INNER JOIN jobs on employees.job_id=jobs.job_id INNER JOIN departments on employees.department_id=departments.department_id";

    	if($id != 0)
    	{
    		$query.=" WHERE employees.employee_id='$id' LIMIT 100";
    	}
    	//$response=array();
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute();
      $num = $stmt->rowCount();

      // check if more than 0 record found
      if($num>0){
          // products array
          $response=array();
          // retrieve our table contents
          while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              $response[]=$row;
          }
          // set response code - 200 OK
          http_response_code(200);
          header('Content-Type: text/html; charset=UTF-8');
        	return $response;
          //echo json_encode($response);
      }
      else{
          // set response code - 404 Not found
          http_response_code(404);
          header('Content-Type: text/html; charset=UTF-8');
          // tell the user no products found
          return array("message" => "zaposlenici ili zaposlenik nije pronadjen.");
      }
    }

    public function post_employee($first_name,$last_name,$email,$phone_number,$hire_date,$job_id,$salary,$department_id)
    	{
        // query to insert record
        $query ="INSERT INTO `employees`(`first_name`, `last_name`, `email`, `phone_number`,`hire_date`, `job_id`, `salary`, `department_id`)
                VALUES (?,?,?,?,?,?,?,?)";

        // prepare query
        $stmt = $this->conn->prepare($query);


            // bind values
            $stmt->bindParam(1, $first_name);
            $stmt->bindParam(2, $last_name);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $phone_number);
            $stmt->bindParam(5, $hire_date);
            $stmt->bindParam(6, $job_id);
            $stmt->bindParam(7, $salary);
            $stmt->bindParam(8, $department_id);

            // execute query
            if ($stmt->execute()) {

              http_response_code(201);
              // tell the user
              return array("message" => "Novi zaposlenik je unesen.");
            }

            // set response code - 503 service unavailable
            http_response_code(503);
            // tell the user
            return array("message" => "Nije moguce unijeti zaposlenika.");
    	}
      public function update_employee($id,$first_name,$last_name,$email,$phone_number,$hire_date,$job_id,$salary,$department_id)
      	{
          // query to update record

          $query ="UPDATE `employees` SET `first_name`=?,`last_name`=?,`email`=?,`phone_number`=?,`hire_date`=?,`job_id`=?,`salary`=?,`department_id`=? WHERE `employee_id`=?";

          // prepare query
          $stmt = $this->conn->prepare($query);


              // bind values
              $stmt->bindParam(1, $first_name);
              $stmt->bindParam(2, $last_name);
              $stmt->bindParam(3, $email);
              $stmt->bindParam(4, $phone_number);
              $stmt->bindParam(5, $hire_date);
              $stmt->bindParam(6, $job_id);
              $stmt->bindParam(7, $salary);
              $stmt->bindParam(8, $department_id);
              $stmt->bindParam(9, $id);

              // execute query
              if ($stmt->execute()) {

                http_response_code(200);
                // tell the user
                return array("message" => "Zaposlenik je azuriran.");
              }

              // set response code - 503 service unavailable
              http_response_code(503);
              // tell the user
              return array("message" => "Nije moguce azurirati zaposlenika.");
      	}



        function delete_employee($id)
        {
        	$query="DELETE FROM employees WHERE employee_id=?";

          // prepare query
          $stmt = $this->conn->prepare($query);

          // bind values
          $stmt->bindParam(1, $id);

          // execute query
          if ($stmt->execute()) {

            http_response_code(200);
            // tell the user
            return array("message" => "Zaposlenik je uspijesno obrisan.","statusCode"=>"200");
          }

          // set response code - 503 service unavailable
          http_response_code(503);
          // tell the user
          header('Content-Type: text/html; charset=UTF-8');
          return array("message" => "Nije moguce obrisati zaposlenika.","statusCode"=>"503");
        }

        public function get_jobs()
        {
        	$query="SELECT jobs.job_id,jobs.job_title FROM jobs";
        	//$response=array();
          $stmt = $this->conn->prepare($query);
          // execute query
          $stmt->execute();
          $num = $stmt->rowCount();

          // check if more than 0 record found
          if($num>0){
              // products array
              $response=array();
              // retrieve our table contents
              while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                  $response[]=$row;
              }
              // set response code - 200 OK
              http_response_code(200);
              header('Content-Type: text/html; charset=UTF-8');
            	return $response;
              //echo json_encode($response);
          }
          else{
              // set response code - 404 Not found
              http_response_code(404);
              header('Content-Type: text/html; charset=UTF-8');
              // tell the user no products found
              return array("message" => "poslovi nisu pronadeni.","statusCode"=>"404");
          }
        }
        public function get_departments()
        {
        	$query="SELECT departments.department_id,departments.department_name FROM departments";
        	//$response=array();
          $stmt = $this->conn->prepare($query);
          // execute query
          $stmt->execute();
          $num = $stmt->rowCount();

          // check if more than 0 record found
          if($num>0){
              // products array
              $response=array();
              // retrieve our table contents
              while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                  $response[]=$row;
              }
              // set response code - 200 OK
              http_response_code(200);
              header('Content-Type: text/html; charset=UTF-8');
            	return $response;
              //echo json_encode($response);
          }
          else{
              // set response code - 404 Not found
              http_response_code(404);
              header('Content-Type: text/html; charset=UTF-8');
              // tell the user no products found
              return array("message" => "odjeljenja nisu pronadena.","statusCode"=>"404");
          }
        }

  }

  ?>
