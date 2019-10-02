<?php
//Api sucelje, koje pozivom na odredenu http metodu (get,post,put,delete) poziva odredenu metodu iz objekta Employees i tako vrsi zadatak dohvacanja/kreiranja/azuriranja/brisanja zaposlenika.

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
?>
