<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
        if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");
          $queryCancOrd="DELETE FROM ordini WHERE tavolo=".$_GET['id'];                   
          $queryCancTav="DELETE FROM tavoli WHERE idTavolo=".$_GET['id'];
          $db->query($queryCancOrd); 
          $db->query($queryCancTav);
          header("location: stampaTavoli.php");
        }
        else
        {
          include("navAdmin.php");
?>
          <div class="alert alert-danger" role="alert">
            Controlla che tu sia online
          </div>
<?php
        }        
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>