<?php

session_start();

if ((isset($_SESSION['logiran'])) && ($_SESSION['logiran']='DA')) {

  header("Location: ../listFilms/listFilms.php");
}
else {

	if ((isset($_POST['email'])) && (isset($_POST['password']))){

		if ($_POST['email']=='admin' && $_POST['password']=='admin'){

		$_SESSION['logiran']='DA';
		$_SESSION['vrijeme']=time();
		$_SESSION['user']=$_POST['email'];

		//proslijedimo na zasticeni dio stranice
		header("Location: ../employee/createEmployee.php");
		}
		else {
    include('../public/header.php');
		echo "<p>Netocno korisnicko ime i/ili lozinka</p><br>";
		echo "<p>Ponovno pokusajte <a href=\"login.php\">prijavu</a></p>";
    include('../public/footer.php');
		}
	}
	else {
		//krivi poziv programa/skripte, presumjeri na login
		header("Location: login.php");
	}
}
