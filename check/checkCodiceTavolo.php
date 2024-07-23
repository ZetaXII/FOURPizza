<?php
	session_start();
    if($_SESSION['idTav']!=NULL)
    {
    	include("connessioneDatabase.php");
        $queryTav="SELECT * FROM tavoli WHERE idTavolo=".$_SESSION['idTav']." AND attivo=1";
        $selezionaTav=$db->query($queryTav);
        if($selezionaTav->num_rows>0)
        {
        	while($rigaTav=$selezionaTav->fetch_object())
            {
            	if($_SESSION['codVerifica']!=$rigaTav->codVerifica)
                {
					include("../check/logout.php");
                }
            }
        }
        else
        {
    		header("location: ../check/accessonegato.html");
    	}
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>