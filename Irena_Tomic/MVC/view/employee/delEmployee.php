<?php
require_once('../../controller/EmployeesController.php');

session_start();

if(isset($_SESSION['logiran'])){

  $employeesController = new EmployeesController();

  if(
      !empty($_GET["id"])
    ){

            $res=$employeesController->delete_employee($_GET["id"]);
            if(isset($res['statusCode']) && $res['statusCode'] ==200){
                header('Location: ./listEmployees.php');
            }
            else{

              include('../public/header.php');
              echo " <p style='padding: 50px 5px'>".$res['message']."</p> ";
              include('../public/footer.php');
            }
  }

}
else{
  include('../public/header.php');
  echo " <p style='padding: 50px 5px'>Nemozete izvrsiti radnju brisanja niste logirani u sustav</p> ";
  include('../public/footer.php');

}
