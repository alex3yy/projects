<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
include("goleste.php");
$scoate="disabled";

if(isset($_GET['actiune'])&&$_GET['actiune']=="adauga"){
	$_SESSION['id_carte'][]=$_POST['id_carte'];
	$_SESSION['nr_buc'][]=1;
	$_SESSION['pret'][]=$_POST['pret'];
	$_SESSION['titlu'][]=$_POST['titlu'];
	$_SESSION['nume_autor'][]=$_POST['nume_autor'];
	header("location: cos.php");
}
if(isset($_GET['actiune'])&&$_GET['actiune']=="modifica")
{
	for($i=0;$i<count($_SESSION['id_carte']);$i++)
	{
		if(isset($_POST['noulNrBuc'][$i]) && $_POST['noulNrBuc'][$i]>=0 && $_POST['noulNrBuc'][$i]<=1000)
			$_SESSION['nr_buc'][$i]=$_POST['noulNrBuc'][$i];
		
	}
	header("location: cos.php");
}
?>
<td valign="top">
<h1>Coşul de shopping!</h1>
<?php
$check = 0;
if(isset($_SESSION['id_carte']))
for($i=0;$i<count($_SESSION['id_carte']);$i++)
	if($_SESSION['nr_buc'][$i] != 0)
		$check = 1;
$totalGeneral=0;
if(isset($_SESSION['id_carte']) && $check == 1)
{
	print '<form action="cos.php?actiune=modifica" method="POST">
<table border="1" cellspacing="0" cellpadding="4">
<tr bgcolor="#F9F1E7">
	<td><b>Nr buc</b></td>
	<td><b>Carte</b></td>
	<td><b>Preţ</b></td>
	<td><b>Total</b></td>
</tr>';
for($i=0;$i<count($_SESSION['id_carte']);$i++)
	{
		if($_SESSION['nr_buc'][$i]!=0)
		{
			$scoate="";
		print '<tr><td><input type="number" name="noulNrBuc['.$i.']" maxlength="1000" min="0" max="1000" value="'.$_SESSION['nr_buc'][$i].'"></td>
			<td><b>'.$_SESSION['titlu'][$i].'</b> de '.$_SESSION['nume_autor'][$i].'</td>
			<td align="right">'.$_SESSION['pret'][$i].' lei</td>
			<td align="right">'.($_SESSION['pret'][$i]*$_SESSION['nr_buc'][$i]).' lei</td>
			</tr>';
		$totalGeneral=$totalGeneral+($_SESSION['pret'][$i]*$_SESSION['nr_buc'][$i]);	
		}
		
		
	}
	print '<tr><td align="right" colspan="3"><b>Total in cos</b></td>
		<td align="right"><b>'.$totalGeneral.'</b> lei </td></tr></table>
<input type="submit" value="Update cos" '.$scoate.'> <br><br> Introduceţi <b>0</b> pentru cărţile pe care doriţi să le scoateţi din coş!';
print '<h1>Continuare</h1>
			<br>
			<br>
			<table>
			<tr><td width="200" align="center">

			<a href="index.php" ><img src="back_to_shop.jpg" height="150px" width="150px">Continuă cumpărăturile </a></td>
			<td width="200" align="center">
			<a href="casa.php"><img src="checkout.jpg" height="150px" width="150px"><br>Mergi la casă</a>
			</td>
			</tr>
			</table>';
}
else print 'Nu exista obiecte in cos!</td>';

?>
</form>
			
<?php
include ("page_bottom.php");
?>


	

