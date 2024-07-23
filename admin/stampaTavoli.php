<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	include("navAdmin.php");
?>
		<div class="container">
        	<div class="row">
            	<div class="col">
					<br/><h1 class="text-center">GESTIONE TAVOLI</h1><br/>
                    <a href="aggiungiTavolo.php" style="text-decoration:none;"><button class="btn btn-success btn-block">Aggiungi Tavolo</button></a>
<?php        
    	include("../check/connessioneDatabase.php");
        $query="SELECT * FROM tavoli ORDER BY numTavolo ASC";
        $tavolo=$db->query($query);
        if($tavolo->num_rows<=0)
        {
?>            
              <div class="alert alert-danger" role="alert">
                Nessun Tavolo. Clicca <a href="aggiungiTavolo.php">qui</a> per aggiungere un tavolo
              </div> 
<?php    
        }
        else
        {
?>            
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <tr><th>N° Tavolo</th><th>Per</th><th>Codice Verifica</th><th colspan="2">Azioni</th><th>Disponibile</th></tr>
<?php            
          while($riga=$tavolo->fetch_object())
          {
                switch($riga->attivo)
                {
                   case 0:
                   $stato="<p class='badge badge-danger'>NO</p>";
                   break;
                   case 1:
                   $stato="<p class='badge badge-success'>SI</p>";
                   break;
                   default:
                   $stato="<p class='badge badge-dark'>N/A</p>";
                   break;                 
                }             
              	echo "<tr><td>$riga->numTavolo</td><td>".$riga->numPosti." persone</td><td>".$riga->codVerifica."</td><td><a href='cancellaTavolo.php?id=$riga->idTavolo'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Cancella</p></a></td><td><a href='modificaTavolo.php?id=$riga->idTavolo'><p style='color:#1273EB;'><img src='../img/edit.svg' style='height:20px;'/>&nbsp;Modifica</p></a></td><td><a href='attivaTavolo.php?id=$riga->idTavolo'>$stato</a></td></tr>";
          }
          echo "</table>";
        }
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>