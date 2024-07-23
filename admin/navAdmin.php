<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="generator" content="AlterVista - Editor HTML"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>
  	function conferma()
    {
    	var conferma=confirm("Sei sicuro di voler uscire?");
        if(conferma==true)
        {
        	location.href='../check/logoutBtn.php';
        }
    }  
  </script>
</head>
<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light border-bottom">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>                 
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <ul class="navbar-nav">
    		<li class="nav-item">
      			<img src="../img/four.png" style="width:48px;height:48px;top:0px;"/>
    		</li>        
    		<li class="nav-item">
      			&nbsp;&nbsp;&nbsp;
    		</li>            
    		<li class="nav-item">
      			<a class="nav-link" href="homeAdmin.php">Home</a>
    		</li>
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Ordini
                  </a>
                  <div class="dropdown-menu">
      				<a class="nav-link" href="stampaOrdiniCucina.php"><img src="../img/kitchen.svg" style="width:20px; height:20px;"/> in Cucina</a> 
                    <a class="nav-link" href="stampaOrdiniConsegna.php"><img src="../img/clocherestaurant.svg" style="width:20px; height:20px; fill:black;"/> in Consegna</a>
                    <a class="nav-link" href="selezionaTavolo.php"><img src="../img/pagaordine.svg" style="width:20px; height:20px;"/> da Pagare</a>                    
                  </div>
            </li>
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Gestione
                  </a>
                  <div class="dropdown-menu">
      				<a class="nav-link" href="stampaStaff.php"><img src="../img/people.svg" style="width:20px; height:20px;"/> Staff</a>
                    <a class="nav-link" href="stampaMenu.php"><img src="../img/menurestaurant.svg" style="width:20px; height:20px;"/> Men&ugrave;</a>
                    <a class="nav-link" href="stampaCategorie.php"><img src="../img/categorie.svg" style="width:20px; height:20px;"/> Categorie</a>
                    <a class="nav-link" href="stampaTavoli.php"><img src="../img/tablerestaurant.svg" style="width:20px; height:20px;"/> Tavoli</a>                                         
                  </div>
    		</li>
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  <?php 
                        echo $_SESSION['nick']; 
                   ?>
                  </a>
                  <div class="dropdown-menu">
      				<a class="nav-link" href="infoAdmin.php"><img src="../img/info.svg" style="width:20px; height:20px;"/> Info personali</a>
                    <a class="nav-link" onclick="conferma();" style="cursor:pointer;"><img src="../img/logout.svg" style="width:20px; height:20px;"/> Logout</a>                   
                  </div>
            </li>
  		</ul>          
      </div>
<?php
	  switch($_SESSION['stato'])
      {
      		case 1:
            echo "<label class='badge badge-dark text-right'>Stato: &nbsp;<a href='../check/statoUtente.php' style='text-decoration:none;' class='btn-sm btn-success'>ON</a></label>";
            break;
            case 0:
            echo "<label class='badge badge-dark text-right'>Stato: &nbsp;<a href='../check/statoUtente.php' style='text-decoration:none;' class='btn-sm btn-danger'>OFF</a></label>";
            break;
            default:
            echo "<label class='badge badge-dark text-right'>Stato: &nbsp;<a href='../check/statoUtente.php' style='text-decoration:none;' class='btn-sm btn-dark'>???</a></label>";
            break;          
      }
?>
</nav>
<br/><br/><br/>