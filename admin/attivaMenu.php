<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	if($_SESSION['stato']==1)
    	{
            include("../check/connessioneDatabase.php");
            $queryselect="SELECT attivo FROM menu WHERE idMenu=".$_GET['id'];
            $select=$db->query($queryselect);
            $select->num_rows;
            while($stato=$select->fetch_object())
            {
              switch($stato->attivo)
              {
                  case 0:
                  $query="UPDATE menu SET attivo=1 WHERE idMenu=".$_GET['id'];
                  break;
                  case 0:
                  $query="UPDATE menu SET attivo=0 WHERE idMenu=".$_GET['id'];
                  break;     
                  default:
                  $query="UPDATE menu SET attivo=0 WHERE idMenu=".$_GET['id'];
                  break;                        
              }
            }
            $db->query($query);
            header("Location: stampaMenu.php");
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