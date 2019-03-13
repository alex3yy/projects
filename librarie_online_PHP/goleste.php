<?php
if(isset($_GET['check'])){
if(isset($_SESSION['id_carte'])) {
	session_unset();
	header("location: cos.php");
}
}

?>

<form action="cos.php" method="GET">
<input type="hidden" name="check" value="goleste">
<input type="submit" value="Goleste cos">
</form>