<?php

session_start();

$pol=new PDO('mysql:host=localhost; dbname=przychodnia;port=3306', 'root','');

if(isset($_SESSION['uzytkownik']))
{
$spr=$pol->prepare('select *from users WHERE login=:log and passwd=:pass');

		$spr->bindParam(':log',$_SESSION['uzytkownik']['login'],PDO::PARAM_STR);
		$spr->bindParam(':pass',$_SESSION['uzytkownik']['passwd'],PDO::PARAM_STR);
		$spr->execute();
		
if($spr->rowCount()==1)
		{
 echo ' </div>';
  echo '
 <!DOCTYPE HTML>';
 echo '<html>';
 echo '<head>';
 echo '<meta charset="utf-8"/>
			<title>Baza danych</title>
		';
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
<div class="przyciski"><a href="dodaj.php">Dodaj</a></div>
<div class="przyciski"><a href="dane.php">Dane</a></div> 
<div class="przyciski"><a href="logout.php">Wyloguj</a></div>
<div style="clear:both;"></div>
</center>
</div>

';

$pol=new PDO('mysql:host=localhost;dbname=wizyty;port=3306','root','');
if(isset($_POST['spec']) and isset($_POST['imie']) and isset($_POST['nazwisko'])
		and isset($_POST['cena']) and isset($_POST['przyczyna']) and isset($_POST['datta'])
		and isset($_POST['id']))
{
		$n=$_POST['spec'];
		$m=$_POST['imie'];
		$c=$_POST['nazwisko'];
		$k=$_POST['cena'];
		$t=$_POST['przyczyna'];
		$ko=$_POST['datta'];
		$id=$_POST['id'];
		
		
	$edytuj=$pol->prepare('UPDATE dane SET spec=:n, imie=:m, nazwisko=:c, 
	cena=:k, przyczyna=:t, datta=:ko, WHERE id=:id');
	$edytuj->bindParam(':spec',$n,PDO::PARAM_STR);
	$edytuj->bindParam(':imie',$m,PDO::PARAM_STR);
	$edytuj->bindParam(':nazwisko',$c,PDO::PARAM_STR);
	$edytuj->bindParam(':cena',$k,PDO::PARAM_INT);
	$edytuj->bindParam(':przyczyna',$t,PDO::PARAM_STR);
	$edytuj->bindParam(':datta',$ko,PDO::PARAM_STR);

	$edytuj->bindParam(':id',$id,PDO::PARAM_INT);
	$edytuj->execute();
	header('Location:baza.php');
}else
{
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$pokaz=$pol->prepare('SELECT* FROM dane WHERE id=:id');
		$pokaz->bindParam(':id',$id,PDO::PARAM_INT);
		$pokaz->execute();
	if($pokaz->rowCount()==1)
	{
		$tab=$pokaz->fetch();
        $spec=$tab['spec'];
		$imie=$tab['imie'];
		$nazwisko=$tab['nazwisko'];
		$cena=$tab['cena'];
		$przyczyna=$tab['przyczyna'];
		$datta=$tab['datta'];
		
	}}}
	?>
	
<div id="tekst1">
</br>
<center>
<form action="edytuj.php" method="post">
<table class="edu">
	<input type="hidden" name="id" value="'<?php echo $id ?>">
	<tr>
		<td>Zmień <i>specjaliste</i></td>
		<td> <input type="text" name="spec" value="<?php echo $spec?> "></td>
	</tr>
	<tr>
		<td>Popraw <i>imię</i></td>
		<td> <input type="text" name="imie" value="<?php echo $imie ?> "></td>
	</tr>
	<tr>
		<td>Popraw <i>naziwsko</i></td>
		<td><input type="text" name="nazwisko" value="<?php echo $nazwisko ?>"></td>
	</tr>
	<tr>
		<td>Edytuj <i>cel wizyty</i></td>
		<td> <input type="text" name="przczyna" value="<?php echo $przyczyna ?>"></td>
	</tr>
	<tr>
		<td>Popraw <i>kwotę</i></td>
		<td> <input type="text" name="kwota" value="<?php echo $cena ?>"></td>
	</tr>
	<tr>
		<td>Zmień <i>date wizyty</i></td>
		<td><input type="text" name="datta" value="<?php echo $datta ?>"></td>
	</tr>

	
	<tr>
		<td colspan="2"><center><input type="submit" value="Edytuj"></center></td>
	</tr>
</table>
	</form>
	
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