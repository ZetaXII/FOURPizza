<?php
	include("../check/checkCodiceTavolo.php");
	if($_SESSION['idTav']!=NULL)
    {    	
    	include("navCliente.php");
?>
		<div class="container">
        	<div class="row">
            	<div class="col-sm">
					<br/><h1 class="text-center">ORDINI IN CUCINA</h1><br/>                    
<?php		
        include("../check/connessioneDatabase.php");
        $queryT="SELECT * FROM tavoli WHERE attivo=1 AND idTavolo='".$_SESSION['idTav']."'";
        $selezionaT=$db->query($queryT);
        if($selezionaT->num_rows>0)
        {
			while($rigaT=$selezionaT->fetch_object())
            {
?>
            	<table class="table table-responsive-lg table-bordered table-hover text-center">
            	<tr class="bg-dark text-white"><th colspan="6">ORDINI TAVOLO N° <?php echo $rigaT->numTavolo ?></th></tr>
<?php
				$queryO="SELECT * FROM ordini WHERE stato=1 AND tavolo=".$rigaT->idTavolo." ORDER BY ora ASC";
                $selezionaO=$db->query($queryO);
                if($selezionaO->num_rows>0)
                {     
?>					                     
                	<tr><th>Pietanza</th><th>Qt.</th><th>Note</th><th>Cameriere</th><th>Data</th><th>Ora</th></tr>   
<?php                   
                    while($rigaO=$selezionaO->fetch_object())
                    {                   
                      $queryM="SELECT * FROM menu WHERE idMenu=".$rigaO->pietanza;
                      $selezionaM=$db->query($queryM); 
                      if($rigaO->note==NULL || $rigaO->note=='')
                      {
                          $note="/";
                      }
                      else
                      {
                          $note=$rigaO->note;
                      }                      
                      while($rigaM=$selezionaM->fetch_object())
                      {                         
                      	if($rigaO->cameriere!=NULL)
                        {
                          $queryS="SELECT * FROM staff WHERE idStaff=".$rigaO->cameriere;
                          $selezionaS=$db->query($queryS); 
                          $selezionaS->num_rows;
                          while($rigaS=$selezionaS->fetch_object())
                          {
                          
?>
                            <tr><td><?php echo $rigaM->nomeMenu; ?></td><td><?php echo $rigaO->quantita." pz."; ?></td><td><?php echo $note; ?></td><td><?php echo $rigaS->nome." ".$rigaS->cognome; ?></td><td><?php echo $rigaO->data; ?></td><td><?php echo $rigaO->ora; ?></td></tr>
<?php
                          }
                      	}
                        else
                        {                        
?>
                            <tr><td><?php echo $rigaM->nomeMenu; ?></td><td><?php echo $rigaO->quantita." pz."; ?></td><td><?php echo $note; ?></td><td>Ordinaz. del Cliente</td><td><?php echo $rigaO->data; ?></td><td><?php echo $rigaO->ora; ?></td></tr> 
<?php                    
                        }
                      }                    	
                    }
                }
                else
                {
?>
                  <tr><td colspan="8"><div class="alert alert-warning" role="alert">
                    Nessun ordine disponibile.<a href="nuovoOrdine.php"> Effettua un ordine qui</a>
                  </div></td></tr>
<?php                
                }
            }
        }
        else
        {
?>
                  <div class="alert alert-danger" role="alert">
                    Nessun tavolo disponibile.
                  </div>
<?php                
        }
?>                   
				</table>
			</div>
        </div>
    </div>
<?php
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>