<?php
	session_start();
    switch($_SESSION['ruolo'])
    {
    	case "A":
        header("location: ../admin/homeAdmin.php");
        break;
        
    	case "C":
        header("location: ../cameriere/homeCameriere.php");
        break;
        
    	case "P":
        header("location: ../pizzaiolo/homePizzaiolo.php");
        break;
        
        default:
        include("logout.php");
        header("location: accessonegato.html");
        break;
    }
?>