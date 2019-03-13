<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
$cuvant=$_GET['cuvant'];
?>
<td valign="top">
<h1>Rezultatele căutarii</h1>
<p>Textul căutat: <br>
<b><?php echo $cuvant?>
</b></p>
<b>Autori</b>
<blockquote>
<?php
//returnez autorii ale caror nume contin in cuvantul introdus
$sql="select id_autor,nume_autor from autori where nume_autor like '%".$cuvant."%'";
$resursa=mysql_query($sql);
if (mysql_num_rows($resursa)==0)
{
	print"<i>Nici un rezultat</i>";
}
//daca se gasesc autori care se potrivesc cuvantului introdus
//boldez literele cautate
while($row=mysql_fetch_array($resursa))
{
	$nume_autor=str_replace($cuvant,"<b>$cuvant</b>",$row['nume_autor']);
	print '<a href="autor.php?id_autor='.$row['id_autor'].'">'.$nume_autor.'</a><br>';
}
?>
</blockquote>
<b>Titluri</b>
<blockquote>
<?php
$sql="select id_carte, titlu from carti where titlu like '%".$cuvant."%'";
$resursa=mysql_query($sql);
if(mysql_num_rows($resursa)==0)
{
	print "<i>Nici un rezultat</i>";
}
while($row=mysql_fetch_array($resursa))
{
	$titlu=str_replace($cuvant,"<b>$cuvant</b>",$row['titlu']);
	print '<a href="carte.php?id_carte='.$row['id_carte'].'">'.$titlu.'</a><br>'; 
}
?>
</blockquote>	
<b>Descrieri</b>
<blockquote>
<?php
$sql="select id_carte, titlu, descriere from carti where descriere like '%".$cuvant."%'";
$resursa=mysql_query($sql);
if(mysql_num_rows($resursa)==0)
{
	print "<i>Nici un rezultat</i>";
}
while($row=mysql_fetch_array($resursa))
{
	$descriere=str_replace($cuvant,"<b>$cuvant</b>",$row['descriere']);
	print '<a href="carte.php?id_carte='.$row['id_carte'].'">'.$row['titlu'].'</a><br>'.$descriere.'<br><br>';
}
?>
</blockquote>
</td>
<?php include("page_bottom.php");
?>