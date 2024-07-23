<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
        if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");
          $querySelMenu="SELECT * FROM menu WHERE categoria=".$_GET['id'];
          $selMenu=$db->query($querySelMenu);
          $selMenu->num_rows;
          while($rigaMenu=$selMenu->fetch_object())
          {
          	$queryCancOrdine="DELETE FROM ordini WHERE pietanza=".$rigaMenu->idMenu;
            $db->query($queryCancOrdine);
          }
          $queryCancMenu="DELETE FROM menu WHERE categoria=".$_GET['id'];
          $db->query($queryCancMenu);
          $queryCancCategoria="DELETE FROM categorie WHERE idCategoria=".$_GET['id'];
          $db->query($queryCancCategoria);
          header("location: stampaCategorie.php");
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