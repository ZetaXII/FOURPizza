<?php
	include("../check/checkCodiceTavolo.php");
	if($_SESSION['idTav']!=NULL)
    {
          include("../check/connessioneDatabase.php");
          echo $query="UPDATE ordini SET stato=1 WHERE stato=0 AND tavolo=".$_SESSION['idTav'];
          if($db->query($query))
          {
          	header("Location: ".$_SERVER['HTTP_REFERER']);
          }
          else
          {
            include("navCliente.php");
?>
            <div class="alert alert-danger" role="alert">
              ERRORE! Accesso negato.
            </div>
<?php
          }        
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>