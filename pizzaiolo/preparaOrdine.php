<?php
	session_start();
	if($_SESSION['ruolo']=="P")
    {
        if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");
          $query="UPDATE `ordini` SET `stato`=2 , `ora`='".date('H:i')."' WHERE idOrdine=".$_GET['id'];
          $db->query($query);
          header("location: ".$_SERVER['HTTP_REFERER']);
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