<?php
$pol=new PDO('mysql:host=localhost;dbname=wizyty;port=3306','root','');
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$usun=$pol->prepare('DELETE FROM dane WHERE id=:id');
	$usun->bindParam(':id',$id,PDO::PARAM_INT);
	$usun->execute();
	header('Location:baza.php');
}
?>