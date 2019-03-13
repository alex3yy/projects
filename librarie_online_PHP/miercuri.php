<?php
include("conectare.php");
?>

<h1>Adaugare comentariu</h1>
<form action="miercuri.php" method="GET">

Nume: <input type="text" name="nume"><br><br>
E-mail:<input type="text" name="mail"><br><br>
Comentariu:<br> <textarea name="comentariu" cols="45"></textarea><br><br>
<input type="submit" value="Adauga"></center>
</form>
<?php
$sql="";

if(isset($_GET['nume']) && isset($_GET['mail']) && isset($_GET['comentariu'])){
	/*if($_GET['nume']=="" || $_GET['mail']=="" || $_GET['comentariu']=="")
	{
	print "Trebuie sa completati toate campurile!";
	}
	else {*/
$sql = "INSERT into comentarii (id_carte,nume_utilizator, adresa_email, comentariu) values('4','".$_GET['nume']."','".$_GET['mail']."','".$_GET['comentariu']."')";
mysql_query($sql);
	header("location: miercuri.php");
}
?>