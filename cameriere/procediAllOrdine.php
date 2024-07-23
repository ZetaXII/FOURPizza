<?php
	session_start();
	if($_SESSION['ruolo']=="C")
    {
    	if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");
          echo $query="UPDATE ordini SET stato=1 WHERE stato=0 AND tavolo=".$_GET['idTav'];
          if($db->query($query))
          {
          	header("Location: ".$_SERVER['HTTP_REFERER']);
          }
          else
          {
            include("navCameriere.php");
?>
            <div class="alert alert-danger" role="alert">
              ERRORE! Accesso negato.
            </div>
<?php
          } 
    	}
        else
        {
        	include("navCameriere.php");
?>
            <div class="alert alert-danger" role="alert">
              ERRORE! Controlla che tu sia Online.
            </div>
<?php        
        }
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>