<?php
session_start();
include ("conectare.php");
include ("page_top.php");
include ("meniu.php");
$id_autor = $_GET['id_autor'];
$sqld = "SELECT nume_autor FROM autori WHERE id_autor=".$id_autor;
$resd = mysql_query($sqld);
$numeAutor = mysql_result($resd,0,"nume_autor");
?>
<td valign="top">
	<h1>Autor: <?=$numeAutor?></h1>
	<b>Carti al lui <u><i><?=$numeAutor?></i></u>:</b>
	<table cellpadding="5">
	<?php
	$sql = "select id_carte, titlu, descriere, pret, nume_autor from carti, autori where carti.id_autor=autori.id_autor and carti.id_autor=".$id_autor;
	$resursa = mysql_query($sql);
	while ($row = mysql_fetch_array($resursa))
	{
		print '<tr> <td align="center">';
		$adresaImagine = "coperte/".$row['id_carte'].".jpg";
		if(file_exists($adresaImagine))
		{
			print '<img src="'.$adresaImagine.'" width=75 height=100><br>';
		}
		else
		{
			print '<div style="width:75px; height:100px; border: 1px black solid; background-color:#cccccc"> Fara imagine</div>';
		}
		?>
		</td>
		<td>
		<b><a href="carte.php?id_carte=<?=$row['id_carte']?>"><?=$row['titlu']?></a></b><br><i>de <?=$row['nume_autor']?></i><br>Pret: <?=$row['pret']?> lei</td></tr>
<?php
	}
	?>
</table>
</td>
<?php
include("page_bottom.php");
?>
