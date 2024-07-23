<?php
	if($_SESSION['ruolo']=="C")
    {
	  include("../check/connessioneDatabase.php");
      $selstato="SELECT stato FROM staff WHERE idStaff=".$_SESSION['idStaff'];
      $seleziona=$db->query($selstato);
      $seleziona->num_rows;
      while($riga=$seleziona->fetch_object())
      {
      	$stato=$riga->stato;
        $_SESSION['stato']=$stato;
      }
	}
    else
    {
    	include("../check/accessoNegato.html");
    }