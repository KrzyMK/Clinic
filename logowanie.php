<?php
session_start();
$pol=new PDO('mysql:host=localhost; dbname=przychodnia;port=3306', 'root','');

if(isset($_POST['login']) and isset($_POST['haslo']))
{
    if(strlen($_POST['login'])!=0 and strlen($_POST['haslo'])!=0)
    {
        $login=$_POST['login'];
        $haslo=$_POST['haslo'];
        $spr=$pol->prepare('SELECT*FROM users WHERE login=:log');
        $spr->bindParam(':log',$login,PDO::PARAM_STR);
        $spr->execute();
        if($spr->rowCount()==1)
        {
            $tab=$spr->fetch();
            $h=$tab['passwd'];

            if($h==sha1($haslo))
            {
                $spr=$pol->prepare('SELECT*FROM users WHERE login=:log');
                $spr->bindParam(':log',$login,PDO::PARAM_STR);
                $spr->execute();

                $_SESSION['login']=$login;
                $wynik=$spr->fetch(PDO::FETCH_ASSOC);
                $_SESSION['uzytkownik']=$wynik;
                $data= date("d/m/Y");
                $godzina= date('H:i:s');


                $spr=$pol->prepare("UPDATE info SET data='$data $godzina' WHERE login='$login'");
                $spr->execute();
                header("location:baza.php");






            }else
            {
                echo '<script type="text/javascript">
				alert("Złe hasło!");
				window.location.href="formularz.php?opcja=1";
				</script>';
            }
        }
    }else
    {
        echo '<script type="text/javascript">
						alert("Uzupełnij poprawnie pola!");
						window.location.href="formularz.php?opcja=1";
						</script>';
    }


}


?>