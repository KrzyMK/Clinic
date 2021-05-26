<!DOCTYPE HTML>
<html >
<head>
		<meta charset="utf-8"/>
		<title>Przychodnia</title>
		<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="xd">

			<div id="calosc">

					<div id="menu">
							
							<a href="formularz.php?opcja=1"></br>Zaloguj</a>&nbsp lub&nbsp
							<a href="formularz.php?opcja=2">Zarejestruj &nbsp &nbsp &nbsp </a>
					
					</div>
			
					<div id="lewy">

						<div id="obrazki">
								<img class="slajdy" src="1.jpg">
								<img class="slajdy" src="4.jpg">
								<img class="slajdy" src="2.jpg">
								<img class="slajdy" src="3.jpg">
						</div>

						<script>
						var indeks=0;
						pokaz();
						function pokaz()
						{

						var tab=document.getElementsByClassName("slajdy");

						for(i=0;i<tab.length;i++)

						{
							tab[i].style.display="none";

						}
						indeks++;
						if(indeks>tab.length)
						{
							indeks=1;
						}
						tab[indeks-1].style.display="block";
						setTimeout(pokaz,2500);
						}
						</script>
						
					</div>
					
					
					<div id="prawy">


<?php
if (isset($_GET['opcja']))
{
	echo '<div id="form">';
	if($_GET['opcja']==1)
	{
		echo '
		<FORM action="logowanie.php" method="POST">
		<table>
		<tr><td>Login </td><td><input type="text" class="pole" name="login"></td></tr>
		<tr><td>Hasło </td><td><input type="password" class="pole" name="haslo"></td></tr>
		<tr><td colspan="2"><center></br><input type="submit" value="Zaloguj" class="guzik"></center></td></tr>
		</table>
		</FORM>';
	}else
	
	if($_GET['opcja']==2)
	{
		echo '
		<FORM action="rejestracja.php" method="POST">
		<table>
		<tr><td>Podaj login</td><td> <input type="text" class="pole" name="login"></td></tr>
		<tr><td>Podaj hasło </td><td><input type="password" class="pole" name="haslo"></td></tr>
		<tr><td>Powtórz hasło </td><td><input type="password" class="pole" name="phaslo"></td></tr>
		<tr><td>Podaj e-mail </td><td><input type="text" class="pole" name="email"></td></tr>
		<tr><td>Podaj imię </td><td><input type="text" class="pole" name="imi"></td></tr>
		<tr><td>Podaj naziwsko </td><td><input type="text" class="pole" name="naziwsk"></td></tr>
		<tr><td>Podaj PESEL </td><td><input type="text" class="pole" name="pesel"></td></tr>
		<tr><td colspan="2"><center></br><input type="submit" value="Zarejestruj" class="guzik"></center></td></tr>
		</table>
		</FORM>';
	}	
	echo '</div>';
}
?>

</div>

<div id="data">
</div>
			</div>

</body>
</html>