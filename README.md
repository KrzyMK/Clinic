# Project Name
> Clinic

## Table of contents
* [General Information](#general-information)
* [Technologies](#technologies)
* [Features](#features)
* [Screenshots](#screenshots)
* [Code Examples](#code-examples)
* [Setup](#setup)
* [Status](#status)
* [Contact](#contact)

## General Information
Project **Clinic** is a small and simple system for managing a medical clinic created with PHP and MySQL.
The project was created for the needs of the classes.

## Technologies
Project is created with:
- PhpStorm version: 2021.1.1.
- PHP version: 8.0.3
- MySQL

## Features
- The patient can create an account and log in
- Admin can add and remove patients, doctors and visits

**To Do:**
- The patient can add his opinion about visit
- The patient get notification before his visit

## Screenshots
Example screenshots showing the operation of the clinic.

Login panel:
![Screenshot_1](https://user-images.githubusercontent.com/84870985/119725074-c9219280-be6f-11eb-8332-9d6f6fe4c4d0.png)

Registration panel:
![Screenshot_2](https://user-images.githubusercontent.com/84870985/119725995-e30fa500-be70-11eb-818b-d0650f833c07.png)



## Code Examples
The code represents how to login in:
```
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

```

## Setup
To run this project locally on your home computer, you need to install XAMPP frome [here](http://www.apachefriends.org/en/xampp-windows.html#641) . 
After correct installation, launch the XAMPP control panel. 
Click "start" in Actions column on Apache and MySql.
You need make database MySQL created via *localhost/phpmyadmin*. 
Then put the project folder in *htdocs* and run in your browser.

## Status
Project is: *in progress*.

## Contact
Created by [Krzysztof Makówka](https://github.com/KrzyMK).
<br>E-mail: anor.spam@gmail.com -easy way to me contact !
