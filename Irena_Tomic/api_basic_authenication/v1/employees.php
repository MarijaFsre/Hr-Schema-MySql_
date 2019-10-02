<?php

//Isti Rest  Api  samo s basic autentifikacijom koja je trazena u zadaci autorizacije i autentifikacije

$username = null;
$password = null;

// mod_php
if (isset($_SERVER['PHP_AUTH_USER'])) {
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

// most other servers
}elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {

        if (strpos(strtolower($_SERVER['HTTP_AUTHORIZATION']),'basic')===0)
          list($username,$password) = explode(':',base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));

}

if (is_null($username) || $username != "admin" || $password != "admin") {

    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo ' 401 Unauthorized';

    die();

} else {

// Connect to database
	include("../connection.php");
	include("../employeesModel.php");
	// include database and object files

	$db = new Connection();
	$connection =  $db->getConnstring();

	$employees= new Employees($connection);

	$request_method=$_SERVER["REQUEST_METHOD"];
	switch($request_method)
	{
		case 'GET':
			// Retrive Products
			//print_r($_GET);
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$result=$employees->get_employees($id);
				echo $result;
			}
			else
			{
				$result=$employees->get_employees();
				echo $result;
			}
			break;

		case 'POST':
				// Insert Product
				$data = json_decode(file_get_contents('php://input'));
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
					$result =	$employees->post_employee($data->first_name,$data->last_name,$data->email,$data->phone_number,$data->hire_date,$data->job_id,$data->salary,$data->department_id);
					echo $result;
				}
				else{
					http_response_code(400);
			    // tell the user
			    echo json_encode(array("message" => "Nije moguce unijeti zaposlenika. Svi podatci nisu tu."));
				}
				break;

		case 'PUT':
			// Update Product
			if (isset($_GET["id"])){
				$id=intval($_GET["id"]);

				$data = json_decode(file_get_contents('php://input'));
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
					$result =	$employees->update_employee($id,$data->first_name,$data->last_name,$data->email,$data->phone_number,$data->hire_date,$data->job_id,$data->salary,$data->department_id);
					echo $result;
				}
				else{
					http_response_code(400);
			    // tell the user
			    echo json_encode(array("message" => "Nije moguce azurirati zaposlenika. Svi podatci nisu tu."));
				}
			}
			else{
				header('Content-Type: application/json');
				echo json_encode("Error while calling method and parametars");

			}

			break;

			case 'DELETE':
			// Delete Product
			$id=intval($_GET["id"]);
			$result=$employees->delete_employee($id);
			echo $result;
			break;

		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
}
?>
