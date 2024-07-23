<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
        if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");
          $queryCancO="DELETE FROM ordini WHERE pietanza=".$_GET['id'];
          $queryCancM="DELETE FROM menu WHERE idMenu=".$_GET['id'];
          $db->query($queryCancO);
          $db->query($queryCancM);
          header("location: stampaMenu.php");
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