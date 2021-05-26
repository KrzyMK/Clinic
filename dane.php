<?php
echo '
<div id="prawy">


';
session_start();

$pol=new PDO('mysql:host=localhost; dbname=przychodnia', 'root','');

if(isset($_SESSION['uzytkownik']))
{
$spr=$pol->prepare('select *from users WHERE login=:log and passwd=:pass');

		$spr->bindParam(':log',$_SESSION['uzytkownik']['login'],PDO::PARAM_STR);
		$spr->bindParam(':pass',$_SESSION['uzytkownik']['passwd'],PDO::PARAM_STR);
		$spr->execute();
		
if($spr->rowCount()==1)
		{
 echo ' </div>
';
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
<div class="przyciski"><a href="dodaj.php">Dodaj wizytę</a></div>
<div class="przyciski"><a href="dane.php">Dane</a></div> 
<div class="przyciski"><a href="logout.php">Wyloguj</a></div>
<div style="clear:both;"></div>
</center>
</div>


<div id="tekst2">
<div style="overflow-y:scroll;overflow-x:hidden;height:520px !important;width:1100px;min-width:148px;position:relative;left:3px;">
';


$pol=new PDO('mysql:host=localhost;dbname=wizyty;port=3306','root','');

$pokaz=$pol->prepare('select *from `dane` ORDER BY `id` ');

$pokaz->execute();


$i=1;
foreach($pokaz as $wiersz)
{
	$login2 = $wiersz['login'];
	$pokaz2=$pol->prepare("select * from info WHERE login='$login2'");
	$pokaz2->execute();
	
	foreach($pokaz2 as $wiersz2)
	{
		$data2= $wiersz2['data'];
		$ilosc2=$wiersz2['ilosc'];
	}
	echo '<div class="infoo">';
	echo'<center>'.$i.'</center></br>
	Login: '.$wiersz['login'].'</br>
	Email: '.$wiersz['email'].'</br>
	Data Wizyty: '.$data2.'</br>
	
	';
	
	echo '</div>';
			
	
	
	
	$i++;
	
}



echo '

</div>

</div></div>

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
 
 ';
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