<?php
include("conectare_user.php");
?>
<td valign="top" width="150">
<div style="width:120px; background-color:#F9F1E7; padding:4px; border:solid #632415 1px">
<a href="index.php"><b><p align="center">Acasa</p></b></a>
<a href="cos.php"><b><p align="center">Cosul meu</p></b></a>
<?php

if(isset($_SESSION["username"])) {
	print 'Salut, <b>'.$_SESSION["username"].'</b>. ';
	print '<a href="logout.php">Logout</a>';
}
else
	print '<a href="login.php"><b><p align="center">Login</p></b></a>';
?>



</div>
<br>
<div style="width:120px; background-color:#F9F1E7; padding:4px; border: solid #632415 1px">
<b> Alege domeniul </b> <HR size="1">

<?php
include("conectare.php");
$sql ="SELECT * FROM domenii ORDER BY nume_domeniu ASC";
$resursa=mysql_query($sql);

while($row=mysql_fetch_array($resursa))
{
	print '<a href="domeniu.php?id_domeniu='.$row['id_domeniu'].'">'.$row['nume_domeniu'].'</a><br>';
}

?>

</div>
<br>
<div style="width:120px; background-color:#F9F1E7; padding:4px; border:solid #632415 1px">

<form action="cautare.php" method="GET">

<b> Cautare </b> <br>

<input type="text" name="cuvant" size="12"> <br>
<input type="submit" value="Cauta">
</form>
</div>
<br>
<div style="width=:120px; background-color:#F9F1E7; padding:4px; border:solid #632415 1px">
	<b>Coş</b><br>
<?php
	$nrCarti=0;
	$totalValoare=0;
	//daca exista carti in cos
	if(isset($_SESSION['titlu']))
	{
	for($i=0;$i<count($_SESSION['titlu']);$i++)
		
	{
		$nrCarti=$nrCarti+$_SESSION['nr_buc'][$i];
		$totalValoare=$totalValoare+($_SESSION['nr_buc'][$i]*$_SESSION['pret'][$i]);
	}
	}
?>

Aveţi <b><?php echo $nrCarti ?></b> cărţi în coş, în valoare totală de <b> <?php echo $totalValoare ?> </b> lei
<a href="cos.php"> <br>Click aici pentru a vedea conţinutul coşului! </a>
</div>
</td>


