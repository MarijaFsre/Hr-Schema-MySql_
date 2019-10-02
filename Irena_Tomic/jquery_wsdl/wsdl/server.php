<?php
//prima parameta employee_id te vrsi poziv na bazu podatak i dohvaca trazene podatke za trenutni posao i za poslove koje je prije radio.

if(!extension_loaded("soap")){
  dl("php_soap.dll");
}

ini_set("soap.wsdl_cache_enabled","0");

$server = new SoapServer("employees.wsdl");

function getEmployes($employees_id){

  //$employee_id = ;
  $resultData= array();
  //echo $_POST['title'];
  // lookup all hints from array if $q is different from ""

    $employee_id = $employees_id;



  $conn = mysqli_connect("localhost","root","");

  if($conn) {

  $result = mysqli_select_db($conn,"hr");
  if(!$result){ throw new SoapFault("Server","Nije se spojio na bazu.");}

  $sqlJob="SELECT employees.employee_id,employees.first_name,employees.last_name,departments.department_name,jobs.min_salary,jobs.max_salary FROM employees INNER JOIN jobs on employees.job_id=jobs.job_id INNER JOIN departments on employees.department_id=departments.department_id WHERE  employees.employee_id='$employee_id'";

  $sqlJobsHistory="SELECT employees.employee_id,employees.first_name,employees.last_name,departments.department_name,jobs.min_salary,jobs.max_salary FROM employees INNER JOIN job_history on employees.employee_id=job_history.employee_id INNER JOIN jobs on job_history.job_id=jobs.job_id INNER JOIN departments on job_history.department_id=departments.department_id WHERE  employees.employee_id='$employee_id'";
  //$sql="SELECT actor.actor_id,actor.first_name,actor.last_name,film.title,film.description,category.name FROM film_actor INNER JOIN actor ON actor.actor_id=film_actor.actor_id INNER JOIN film ON film.film_id=film_actor.film_id INNER JOIN film_category ON film_category.film_id=film.film_id INNER JOIN category ON category.category_id=film_category.category_id WHERE actor.first_name='$employees_id' OR actor.last_name='$surname'";
  //print $sql;
  $result1 = mysqli_query($conn, $sqlJob);
  $result2 = mysqli_query($conn, $sqlJobsHistory);
  if(!$result2){throw new SoapFault("Server","Nije dohvatio rezultat trenutno zaposlenje.");}
  if(!$result2){throw new SoapFault("Server","Nije dohvatio rezultat povjest zaposlenja.");}


      // Fetch all

  while($row = mysqli_fetch_array($result1)) {
    $new_array = array( 'zaposlenje' => 'Trenutno zaposenje');

    $final_array=array_merge($row, $new_array);
      //array_push($row, 'zaposlenje' => 'Trenutno zaposenje');
      $resultData[]=$final_array;
  }
  while ($row= mysqli_fetch_array($result2)) {
    // code...
    $new_array = array( 'zaposlenje' => 'Predhodno zaposenje');

    $final_array=array_merge($row, $new_array);
    //array_push($row, 'zaposlenje' => 'Predhodno zaposenje');
    $resultData[]=$final_array;
  }
  return $resultData;

    // Free result set
  //mysqli_free_result($result2);
  mysqli_close($conn);
  }
  else {
  throw new SoapFault("Server","Nije se spojio na server baze.");
  }
  //var_dump($resultData);
    //return $result2;
  //return array(array(1,"$employees_id",'$yourSurname','asdasd','dsada','dasda'),array(1,"asdada",'asdas','asdasd','dsada','dasda'));
}

$server->AddFunction("getEmployes");
$server->handle();
?>
