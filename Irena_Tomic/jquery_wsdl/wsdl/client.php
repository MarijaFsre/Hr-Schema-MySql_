<?php
//client.php file prima parametar employee_id te pomocu soap protokola i wsdla salje primljeni parameta na server koji treba primiti parametar i izvrsiti obradu podataka s bazom

if (isset($_POST["employees_id"])) {
		$employees_id = $_POST['employees_id'];;

try{
 ini_set('soap.wsdl_cache_enabled',0);
 ini_set('soap.wsdl_cache_ttl',0);

	$sClient = new SoapClient(dirname(__DIR__).'/wsdl/employees.wsdl',
						 array('cache_wsdl'=>WSDL_CACHE_NONE,'trace' => 1)
						 );


	$response = $sClient->getEmployes($employees_id);

	//var_dump($response);

	//var_dump($x->__getLastResponseHeaders());
// var_dump($sClient->__getLastRequest());
//$sClient->__getLastRequest();

	//var_dump($response






} catch(SoapFault $e){
	var_dump($e);
	echo $e;
}
{
	//  print($sClient->__getLastResponse());
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../style.css">
</head>
<body>

    <div class="header">
      <h1>Hr-schema-mysql database</h1>
    </div>

    <header>
        <div class="topnav" id="myTopnav">
					<a href="../jquery/index.html" class="active">jQuery Employees</a>
					<a href="./employees.html">Wsdl Employees</a>
					<a href="../../MVC/view/employee/listEmployees.php">Putanja na MVC dio</a>
            <a href="javascript:void(0);" class="icon" onclick="navBarResponzive()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>

    <main>

            <div class="main_frame">

              <div class="search_form">
								<p>Pretrazite zaposlenike po sifri</p>
                <form action="./client.php" method="post">
                  <label for="employees_id">Sifra zaposlenika</label>
                  <input type="text" id="employees_id" name="employees_id" placeholder="Sifra zaposlenika..">

                  <button type="submit">Pretrazi</button>
                </form>
              </div>
       <div class="frame1">
				 <?php
				 	for($j=0;$j<sizeof($response);$j++) {
							echo "<div class='employees'>
                  <h4>ID : ".$response[$j]['employee_id']."</h4>
                  <h5>Ime : ".$response[$j]['first_name']."</h5>
                  <p><h5>Prezime : ".$response[$j]['last_name']."</h5></p>
									<p><h5>Naziv odjela : ".$response[$j]['department_name']."</h5></p>
									<p><h5>Min placaa : ".$response[$j]['min_salary']."</h5></p>
									<p><h5>Max placa : ".$response[$j]['max_salary']."</h5></p>
									<p><h3>Zaposlenje : ".$response[$j]['zaposlenje']."</h3></p>
              </div>";

					}
				 ?>

       </div>
      </div>
    </main>

    <footer class="footer">
      <h2>Footer</h2>
    </footer>

    <script src="./javascrip.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </body>
</html>
