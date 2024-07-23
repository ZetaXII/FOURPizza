<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
        if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");
          $query="UPDATE `ordini` SET `stato`=3 , `ora`='".date("H:i")."' WHERE idOrdine=".$_GET['id'];
          $db->query($query);
          header("Location: ".$_SERVER['HTTP_REFERER']);
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