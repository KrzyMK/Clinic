<?php

session_start();

$pol=new PDO('mysql:host=localhost; dbname=przychodnia', 'root','');

if(isset($_SESSION['uzytkownik']))
{
	$spr=$pol->prepare('SELECT * from users where login=:log and passwd=:pass');
	$spr->bindParam(':log',$_SESSION['uzytkownik']['login'],PDO::PARAM_STR);
	$spr->bindParam(':pass',$_SESSION['uzytkownik']['passwd'],PDO::PARAM_STR);
	$spr->execute();
	if($spr->rowCount()==1)
	{
		
$pol=new PDO('mysql:host=localhost; dbname=wizyty;port=3306', 'root','');
		if(isset($_FILES['material']))
	 {
		 //$gdzie="img/";
		 //move_uploaded_file($_FILES['material']['tmp_name'],$gdzie.$_FILES['material']['name']);
		 
	 }


 echo ' 
 <!DOCTYPE HTML>';
 echo '<html>';
 echo '<head>';
 echo '<meta charset="utf-8"/>
			<title>Baza danych</title>';
 echo '<link rel="stylesheet" type="text/css" href="style2.css">
 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		</head>
		<body id="xd">
		<div id="calosc">
		<div id="menu">';
echo '<center><div id="logo">';
 echo "Witaj ".$_SESSION['uzytkownik']['login'];
 echo " !</div>";
 echo '</center>';
 echo '
</div>

<div id="lewy">
<div id="menu2">

<center>
<div class="przyciski"><a href="baza.php">Lista wizyt</a></div> 
<div class="przyciski"><a href="dodaj.php">Dodaj wizytę</a></div>
<div class="przyciski"><a href="dane.php">Dane</a></div> 
<div class="przyciski"><a href="logout.php">Wyloguj</a></div>
<div style="clear:both;"></div>
</center>
</div>';


	
		 echo '
	<div id="tekst1">
</br>
<center>';

?>
<form action="dodaj.php" method="post" enctype="multipart/form-data">

<table class="dodaj">
	
	<tr>
		<td>Podaj specjalizacje</td>
		<td> <input type="text" name="spec"></td>
	</tr>
	
	<tr>
		<td>Podaj imie</td>
		<td> <input type="text" name="imie"></td>
	</tr>

	<tr>
		<td>Podaj naziwsko</td>
		<td><input type="text" name="nazwisko"></td>
	</tr>
	<tr>
		<td>Powod wizyty</td>
		<td> <input type="text" name="przyczyna"></td>
	</tr>
	<tr>
		<td>Kwota</td>
		<td> <input type="text" name="cena"></td>
	</tr>
	<tr>
		<td>Data Wizyty</td>
		<td> <input type="text" name="datta"></td>
	</tr>

	<tr>
		<td colspan="2"><center><input type="submit" value="Dodaj"></center></td>
	</tr>
		
</table>

	</form>
	<?php
	$pol=new PDO('mysql:host=localhost;dbname=wizyty;port=3306','root','');
	
	if(isset($_POST['spec']) and isset($_POST['imie']) and isset($_POST['nazwisko'])
		and isset($_POST['cena']) and isset($_POST['przyczyna']) and isset($_POST['datta']))
	{
		$n=$_POST['spec'];
		$m=$_POST['imie'];
		$c=$_POST['nazwisko'];
		$k=$_POST['cena'];
		$t=$_POST['przyczyna'];
		$ko=$_POST['datta'];

		$dodaj=$pol->prepare('INSERT INTO dane (spec,imie,nazwisko,cena,przyczyna,datta,)
		values (:spec,:imie,:nazwisko,:cena,:przyczyna,:datta)');
		$dodaj->bindParam(':spec',$n,PDO::PARAM_STR);
		$dodaj->bindParam(':imie',$m,PDO::PARAM_STR);
		$dodaj->bindParam(':nazwisko',$c,PDO::PARAM_STR);
		$dodaj->bindParam(':cena',$k,PDO::PARAM_INT);
		$dodaj->bindParam(':przyczyna',$t,PDO::PARAM_STR);
		$dodaj->bindParam(':datta',$ko,PDO::PARAM_);
		$dodaj->execute();
	
		header('Location:baza.php');
	} ;?> 
</br>
</div>


</div>
<div id="data">
					</br>
<SCRIPT LANGUAGE="JavaScript">

DayName = new Array(7)
DayName[0] = "niedziela "
DayName[1] = "poniedziałek "
DayName[2] = "wtorek "
DayName[3] = "środa "
DayName[4] = "czwartek "
DayName[5] = "piątek "
DayName[6] = "sobota "

MonthName = new Array(12)
MonthName[0] = "stycznia "
MonthName[1] = "lutego "
MonthName[2] = "marca "
MonthName[3] = "kwietnia "
MonthName[4] = "maja "
MonthName[5] = "czerwca "
MonthName[6] = "lipca "
MonthName[7] = "sierpnia "
MonthName[8] = "września "
MonthName[9] = "października "
MonthName[10] = "listopada "
MonthName[11] = "grudnia "

function getDateStr(){
    var Today = new Date()
    var WeekDay = Today.getDay()
    var Month = Today.getMonth()
    var Day = Today.getDate()
    var Year = Today.getFullYear()

    if(Year <= 99)
        Year += 1900

    return DayName[WeekDay] + " " + "    " + Day + " " + MonthName[Month] + "  " + Year
}
</SCRIPT>
<SCRIPT>document.write("Dzisiaj jest " + " "+ getDateStr())</SCRIPT>
					</div>
			
			</div>

</body>
</html>
 <?php
}
 }else
 {
	 echo'<script type="text/javascript">
				alert("Zaloguj się!");
				window.location.href="index.php";
				</script>';
				header("location:formularz.php?opcja=1");
 }
?>