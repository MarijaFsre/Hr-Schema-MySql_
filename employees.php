<?php
//php file koji vrsi primanje parametara name i lastname s frontend-a odnosno s klijentske strane to jest index.html. Nakon primljni parametara spaja se na bazu hr i u tablici employees trazi sve zaposlenike koji u imenu ili prezimenu imaju rijeci koje su primljnje s klijenta i ispisuje trazeni rezultat.

$hint = "";
$name = "";
$lastname = "";

//echo $_POST['title'];
// lookup all hints from array if $q is different from ""
if(isset($_POST["name"]) && isset($_POST["lastname"])) {
  $name = $_POST["name"];
  $lastname = $_POST["lastname"];


/**********************************************************/
$conn = mysqli_connect("localhost","root","");

if($conn) {

$result = mysqli_select_db($conn,"hr") or die("Do�lo je do problema prilikom odabira baze...");
$sql="SELECT * FROM employees where first_name LIKE '%$name%' OR last_name LIKE '%$lastname%'";
//print $sql;
$result2 = mysqli_query($conn, $sql) or die("Do�lo je do problema prilikom izvrsavanja upita...");
$n=mysqli_num_rows($result2);

if ($n > 0){
	while ($myrow=mysqli_fetch_row($result2)){
			//echo $myrow[0].",".$myrow[1].",".$myrow[2];
            //$hint .= "<div name=\"result\" id=\"".$myrow[0]."\">".$myrow[1].",".$myrow[2].",</div>";
            $hint .="<div class='employees'>
                <h2> Ime :".$myrow[1]."</h2>
                <h5> Prezime :".$myrow[2]."</h5>
                <p><h5>email : ".$myrow[3]."</h5></p>
                <p><h6>Broj : ".$myrow[4]."</h6></p>
                <p><h6>Placa : ".$myrow[7]."</h6></p>
            </div>";

		}
	}
else {
//echo "No patern rows returned<br>";
}
mysqli_close($conn);
}
else {
echo "<br>Nije proslo spajanje<br>";
}
/**********************************************************/
echo $hint === "" ? "no suggestion" : $hint;

}
// Output "no suggestion" if no hint was found or output correct values

?>
