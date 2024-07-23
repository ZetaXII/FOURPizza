<?php
	session_start();
	if($_SESSION['ruolo']=="A" || $_SESSION['ruolo']=="C" || $_SESSION['ruolo']=="P")
    {
    	include("../check/connessioneDatabase.php");
        switch($_SESSION['stato'])
        {
        	case 0:
            $query="UPDATE staff SET stato=1 WHERE idStaff=".$_SESSION['idStaff'];
            $_SESSION['stato']=1;
            break;
        	case 1:
            $query="UPDATE staff SET stato=0 WHERE idStaff=".$_SESSION['idStaff'];
            $_SESSION['stato']=0;
            break;     
        	default:
            $query="UPDATE staff SET stato=1 WHERE idStaff=".$_SESSION['idStaff'];
            $_SESSION['stato']=0;
            break;                        
        }
        $db->query($query);
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>