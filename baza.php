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


	

';


        $pol=new PDO('mysql:host=localhost;dbname=wizyty;port=3306','root','');

        $pokaz=$pol->prepare('select *from dane');

        $pokaz->execute();



        echo '
<table class="tabelka"><tr>
						<td>Zdjęcie</td>
						<td>Nazwa longboarda</td>
						<td>Cena</td>
						</tr>';


        foreach($pokaz as $wiersz)
        {
            echo '
			<tr>
			<td><center><div id="miniaturki"><img src="img/'.$wiersz['material'].'"></center></div></td>
			<td>'.$wiersz['nazwa'].'</td>
			<td>'.$wiersz['cena'].' zł</td>
			<td><a href="baza.php?id='.$wiersz['id'].'"><button type="button" id="edytuj">INFO</button></a></td>
			</div>';
        }
        echo '</table>';


        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $pol=new PDO('mysql:host=localhost;dbname=wizyty;port=3306','root','');
            $pok=$pol->prepare('SELECT* FROM dane WHERE id=:id');
            $pok->bindParam(':id',$id,PDO::PARAM_INT);
            $pok->execute();



            if($pok->rowCount()==1)
            {
                $tab=$pok->fetch();
                $foto=$tab['material'];
                $nazwa=$tab['nazwa'];
                $marka=$tab['marka'];
                $cena=$tab['cena'];
                $ksztalt=$tab['ksztalt'];
                $trucki=$tab['trucki'];
                $kolka=$tab['kolka'];
                $lozyska=$tab['lozyska'];
                $dlugosc=$tab['dlugosc'];
                $szerokosc=$tab['szerokosc'];
            }
            echo'<div id="kwadrat">
	<table class="xdd">
	
						<tr>
						<td rowspan="11"><img src="img/'.$foto.' "></td></tr>  
						<tr><td>Nazwa: '.$nazwa.'</td></tr>
						<tr><td>Marka: '.$marka.'</td></tr>
						<tr><td>Cena: '.$cena.' zł</td></tr>
						<tr><td>Polecane do: '.$ksztalt.'</td></tr>
						<tr><td>Trucki: '.$trucki.'</td></tr>
						<tr><td>Kółka: '.$kolka.'</td></tr>
						<tr><td>Truck typ: '.$lozyska.'</td></tr>
						<tr><td>Długość decku: '.$dlugosc.'</td></tr>
						<tr><td>Szerokość decku: '.$szerokosc.'</td></tr>
						<tr><td><a href="usun.php?id='.$wiersz['id'].'"><button type="button" id="edytuj" >Usuń</button></a>
								   <a href="edytuj.php?id='.$wiersz['id'].'"><button type="button" id="edytuj">Edytuj</button></a><br/></td></tr>
						
	</table>
	
	</div>
	<div style="clear:both;"></div>
		';

        }

    }


    echo '</div>
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
 
';
    $pol=new PDO('mysql:host=localhost;dbname=wizyty;port=3306','root','');
    if(isset($_FILES['material']))
    {
        $gdzie="img/";
        move_uploaded_file($_FILES['material']['tmp_name'],$gdzie.$_FILES['material']['name']);

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