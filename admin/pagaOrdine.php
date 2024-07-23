<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
        if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");          
          $query="UPDATE `ordini` SET `stato`='4' WHERE tavolo=".$_GET['idTav']." AND `stato`=3";
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