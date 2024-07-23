<?php
	session_start();
	if($_SESSION['ruolo']=="C")
    {
        if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");
          $query="DELETE FROM ordini WHERE idOrdine=".$_GET['id'];
          $db->query($query);
          header("Location: ".$_SERVER['HTTP_REFERER']);
        }
        else
        {
          include("navCameriere.php");
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