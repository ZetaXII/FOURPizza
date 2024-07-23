<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	if($_SESSION['stato']==1)
    	{
            include("../check/connessioneDatabase.php");
            $queryselect="SELECT stato FROM staff WHERE idStaff=".$_GET['id'];
            $select=$db->query($queryselect);
            $select->num_rows;
            while($stato=$select->fetch_object())
            {
              switch($stato->stato)
              {
                  case 0:
                  $query="UPDATE staff SET stato=1 WHERE idStaff=".$_GET['id'];
                  break;
                  case 0:
                  $query="UPDATE staff SET stato=0 WHERE idStaff=".$_GET['id'];
                  break;     
                  default:
                  $query="UPDATE staff SET stato=0 WHERE idStaff=".$_GET['id'];
                  break;                        
              }
            }
            $db->query($query);
            header("Location: stampaStaff.php");
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