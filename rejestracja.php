<?php

$pol=new PDO('mysql:host=localhost; dbname=przychodnia;port=3306', 'root','');


if(isset($_POST['login']) and isset($_POST['haslo']) and isset($_POST['phaslo']) and isset($_POST['email']))
{
    $login=$_POST['login'];
    $haslo=$_POST['haslo'];
    $phaslo=$_POST['phaslo'];
    $email=$_POST['email'];



    if(preg_match('/^(.+?)@(([a-z0-9\.-]+?)\.[a-z]{2,5})$/i',$email))
    {
        if($haslo==$phaslo)
        {
            if(preg_match("/^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()+_|-])/",$haslo))
            {
                if(preg_match("/^([a-z0-9\.-]+?)$/i",$login))
                {
                    $spr=$pol->prepare('SELECT*FROM users WHERE login=:log');
                    $spr->bindParam(':log',$login,PDO::PARAM_STR);
                    $spr->execute();
                    if($spr->rowCount()==1)
                    {
                        echo '<script type="text/javascript">alert("Konto o podanym loginie już istnieje!");
											window.location.href="formularz.php?opcja=2";
											</script>';
                    }else
                        $dodaj=$pol->prepare('INSERT INTO users (login,passwd,email) values (:l,sha1(:p),:e)');
                    $dodaj->bindParam(':l',$login,PDO::PARAM_STR);
                    $dodaj->bindParam(':p',$haslo,PDO::PARAM_STR);
                    $dodaj->bindParam(':e',$email,PDo::PARAM_STR);
                    $dodaj->execute();

                    $dodaj=$pol->prepare("INSERT INTO info (login,data) VALUES ('$login','brak')");
                    $dodaj->execute();
                    header ("Location:formularz.php?opcja=1");



                }else

                    echo'<script type="text/javascript">alert("Login składa się z niedozwolonych znaków. Dozwolone znaki to a-z oraz 0-9");
											window.location.href="formularz.php?opcja=2";
											</script>';
            }else

                echo'<script type="text/javascript">
										alert("Hasło nie jest silne");
											window.location.href="formularz.php?opcja=2";
											</script>';
        }else

            echo'<script type="text/javascript">
							alert("Hasła nie są takie same");
								window.location.href="formularz.php?opcja=2";
								</script>';
    }else

        echo'<script type="text/javascript">
							alert("Zły e-mail");
							window.location.href="formularz.php?opcja=2";
						</script>';


}




?>