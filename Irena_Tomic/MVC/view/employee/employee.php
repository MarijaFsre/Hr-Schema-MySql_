<?php
require_once('../../controller/EmployeesController.php');
include('../public/header.php');

 ?>
     <main>

             <div class="main_frame">


        <div class="frame1">
          <?php
          $employeesController = new EmployeesController();
          $id=$_GET["id"];
          if(is_numeric($id)){

            $data = $employeesController->listEmployees($id);

            if(isset($data['message'])){
                echo $data['message'];
            }else {

              for ($i=0; $i < sizeof($data); $i++) {
                  $employees = $data[$i];
                echo "<div class='employees'>
                      <h2>Ime : ".$employees->first_name."</h2>
                      <h5> Prezime : ".$employees->last_name."</h5>
                      <p><h5>Email: ".$employees->email."</h5></p>
                      <p><h5>Broj telefona : ".$employees->phone_number."</h5></p>
                      <p><h5>Datum zaposlenja : ".$employees->hire_date."</h5></p>
                      <p><h5>Plaća : ".$employees->salary."</h5></p>
                      <p><h5>Ime odjela : ".$employees->department_name."</h5></p>
                      <p><h5>Posao : ".$employees->job_title."</h5></p>";

                      if(isset($_SESSION['logiran'])){
                          echo "
                            <form action='../employee/delEmployee.php' method='get'>
                              <input type='hidden' name='id' value=".$employees->employee_id.">
                              <input type='submit' class='button button4' value='Obrisi....'>
                            </form>";
                      }


                echo "</div>";
              }
            }
          }

           ?>
        </div>
       </div>
     </main>

     <?php
       include('../public/footer.php');
     ?>
