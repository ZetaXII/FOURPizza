<?php
	session_start();
    $_SESSION['stato']=1;
    include("statoUtente.php");
	include("logout.php");
    header("location: ../index.html");
?>