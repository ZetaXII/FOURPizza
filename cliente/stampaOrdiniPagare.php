<?php
	include("../check/checkCodiceTavolo.php");
	if($_SESSION['idTav']!=NULL)
    {
    	include("navCliente.php");
?>
		<div class="container">
        	<div class="row">
            	<div class="col">
					<br/>                   
<?php
        include("../check/connessioneDatabase.php");
        $queryT="SELECT * FROM tavoli WHERE idTavolo=".$_SESSION['idTav'];
        $selezionaT=$db->query($queryT);
        if($selezionaT->num_rows>0)
        {
            $totale=0;
			while($rigaT=$selezionaT->fetch_object())
            {
?>				
				<br/><h2 class="text-center">ORDINI DA PAGARE TAVOLO N°<?php echo $rigaT->numTavolo ?></h2><br/>                    
            	<table class="table table-responsive-lg table-bordered table-hover text-center">
<?php
				$queryO="SELECT * FROM ordini WHERE stato='3' AND tavolo=".$rigaT->idTavolo;
                $selezionaO=$db->query($queryO);
                if($selezionaO->num_rows>0)
                {     
?>					                     
                	<tr><th>Pietanza</th><th>Qt.</th><th>Note</th><th>Prezzo al pz.</th><th>Prezzo Tot.</th><th>Data</th><th>Ora</th><th>Cameriere</th></tr>   
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
                                <tr><td><?php echo $rigaM->nomeMenu; ?></td><td><?php echo $rigaO->quantita." pz."; ?></td><td><?php echo $note;?></td><td><?php echo $rigaO->tot/$rigaO->quantita."€"; ?></td><td><?php echo $rigaO->tot."€"; ?></td><td><?php echo $rigaO->data; ?></td><td><?php echo $rigaO->ora; ?></td><td><?php echo $rigaS->nome." ".$rigaS->cognome; ?></td></tr>
<?php
                                
                            } 
                        }
                        else
                        {
?>
                            <tr><td><?php echo $rigaM->nomeMenu; ?></td><td><?php echo $rigaO->quantita." pz."; ?></td><td><?php echo $note;?></td><td><?php echo $rigaO->tot/$rigaO->quantita."€"; ?></td><td><?php echo $rigaO->tot."€"; ?></td><td><?php echo $rigaO->data; ?></td><td><?php echo $rigaO->ora; ?></td><td>Ordinaz. del Cliente</td></tr>
<?php                            
                        }
                        $totale=$totale+$rigaO->tot;
                      }                    	
                    }
?>                    
                    <tr><th colspan="8">TOTALE DA PAGARE: <?php echo $totale ?>€ <b>IVA. esclusa</b></th></tr>
<?php                    
                }
                else
                {
?>
                  <tr><td><div class="alert alert-warning" role="alert">
                    Nessun ordine disponibile per questo tavolo.
                  </div></td></tr>
<?php                
                }
            }
        }
        else
        {
?>
                  <div class="alert alert-danger" role="alert">
                    Nessun tavolo selezionato.
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