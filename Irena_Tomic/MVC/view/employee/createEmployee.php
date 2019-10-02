<?php
//Prikuplja podatke od korisnika iz forme i salje te podatke kontroleru koji  ih ispitiva da li su valjani i dalje on salje modelu te model te podatke sprema u bazu.
require_once('../../controller/EmployeesController.php');

session_start();
$employeesController = new EmployeesController();

if(isset($_REQUEST['submit_btn'])){

  if(
      !empty($_POST["first_name"]) &&
      !empty($_POST["last_name"]) &&
      !empty($_POST["email"]) &&
      !empty($_POST["phone_number"]) &&
      !empty($_POST["hire_date"]) &&
      !empty($_POST["job_id"]) &&
      !empty($_POST["salary"]) &&
      !empty($_POST["department_id"])){


        $arrayName = array(
            'first_name' => $_POST["first_name"],
            'last_name' =>  $_POST["last_name"],
            'email' =>  $_POST["email"],
            'phone_number' =>  $_POST["phone_number"],
            'hire_date' => $_POST["hire_date"],
            'job_id' =>  $_POST["job_id"],
            'salary' => $_POST["salary"],
            'department_id' =>  $_POST["department_id"]);

            $res=$employeesController->createEmployee($arrayName);

  }else {
    echo $_POST["first_name"].' '.$_POST["department_id"].$_POST["job_id"].' '.$_POST["email"].$_POST["phone_number"].' '.$_POST["hire_date"].' '.$_POST["salary"].$_POST["last_name"];
    $err="Niste unijeli sva polja";
  }


}
include('../public/header.php');


if (isset($_SESSION['logiran'])) {
		echo "<main>
            <div class='main_frame'>
              <div class='search_form'>
                <p>Unesite zaposlenika</p>
                <form id='form' action='' method='POST'>
                  <label for='first_name'>Ime</label>
                  <input type='text' id='first_name' name='first_name' placeholder='first_name..'>

                  <label for='last_name'>Prezime</label>
                  <input type='text' id='last_name' name='last_name' placeholder='last_name..'>

                  <label for='email'>email</label>
                  <input type='email' step='any' id='email' name='email' class='number' placeholder='email..'>

                  <label for='phone_number'>Broj telefona</label>
                  <input type='text' step='any' id='phone_number' name='phone_number' class='number' placeholder='phone_number..'>

                  <label for='hire_date'>Datum zaposlenja</label>
                  <input type='text' step='any' id='hire_date' name='hire_date' class='number' placeholder='hire_date..'>";

                  $data=$employeesController->listJobs();
                  echo "<select id='job_id' name='job_id'>";
                  for ($i=0; $i < sizeof($data); $i++) {
                      $job = $data[$i];
                  echo "<option value='$job->job_id'>$job->job_title</option>";
                  }
                echo "</select>";



                echo  "<label for='salary'>Placa</label>
                  <input type='number' step='any' id='salary' name='salary' class='number' placeholder='salary..'>";

                  $data=$employeesController->listDepartments();
                  echo "<select id='department_id' name='department_id'>";
                  for ($i=0; $i < sizeof($data); $i++) {
                      $department = $data[$i];
                    echo "<option value='$department->department_id'>$department->department_name</option>";
                    }
                  echo "</select>";

                  echo "<input type='submit' value='Spremi' class='button button4' name='submit_btn'>
                </form>
              </div>


       <div class='frame1'>";


               if(isset($res['message'])){echo "<p>".$res['message']."</p>";}elseif (isset($err)) {
                 echo $err;
               }

        echo "</div>
        </div>
      </main>";

    }
    else {
    	echo "<p>Niste prijavljeni ili nemate pristup ovim dijelovima web sjedista</p>";
    	echo "Pokusajte se  <a href=\"../LoginSession/login.php\">prijaviti</a>";

    	}

       include('../public/footer.php');
     ?>
