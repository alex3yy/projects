<form action="modifica.php" method="POST">

<?php
mysql_connect("localhost", "root", "");
mysql_select_db("librarie");
$sql="SELECT id_carte, titlu, descriere from carti";
$resursa = mysql_query($sql);

while($row = mysql_fetch_array($resursa))
{
	print "<input type='radio' name='id_carte' value='".$row['id_carte']."'>
	<b>".$row['titlu']."</b><br>
	<i>".$row['descriere']."</i>
	<br><br>";
}
?>
<input type="submit" value="Modifica">
</form>
