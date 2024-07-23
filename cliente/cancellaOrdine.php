<?php
	include("../check/checkCodiceTavolo.php");
	if($_SESSION['idTav']!=NULL)
    {
          include("../check/connessioneDatabase.php");
          $query="DELETE FROM ordini WHERE idOrdine=".$_GET['id'];
          if($db->query($query))
          {
          	header("Location: ".$_SERVER['HTTP_REFERER']);
          }
          else
          {
            include("navCliente.php");
?>
            <div class="alert alert-danger" role="alert">
              ERRORE! Accesso negato
            </div>
<?php
          }        
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>