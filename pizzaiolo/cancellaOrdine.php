<?php
	session_start();
	if($_SESSION['ruolo']=="P")
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
          include("navPizzaiolo.php");
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