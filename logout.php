<?php
session_start();

session_destroy();
unset($_SESSION['uzytkownik']);
header("location:formularz.php");


?>