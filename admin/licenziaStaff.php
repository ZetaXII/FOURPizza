<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
      if($_SESSION['stato']==1)
      {    
          include("../check/connessioneDatabase.php");
          $queryModOrdini="UPDATE ordini SET cameriere=NULL WHERE cameriere=".$_GET['id'];
          $queryCancStaff="DELETE FROM staff WHERE idStaff=".$_GET['id'];
          $db->query($queryModOrdini);
          $db->query($queryCancStaff);
          header("location: stampaStaff.php");
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