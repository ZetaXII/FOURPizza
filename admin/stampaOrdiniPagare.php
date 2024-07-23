<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	include("navAdmin.php");
?>
		<div class="container">
        	<div class="row">
            	<div class="col">
					<br/>                   
<?php
        include("../check/connessioneDatabase.php");
        $queryT="SELECT * FROM tavoli WHERE idTavolo=".$_GET['idTav'];
        $selezionaT=$db->query($queryT);
        if($selezionaT->num_rows>0)
        {
            $totale=0;
			while($rigaT=$selezionaT->fetch_object())
            {
?>
				&nbsp;<a href="selezionaTavolo.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
				<br/><h2 class="text-center">ORDINI DA PAGARE TAVOLO N°<?php echo $rigaT->numTavolo ?></h2><br/>                    
            	<table class="table table-responsive-lg table-bordered table-hover text-center">
<?php
				$queryO="SELECT * FROM ordini WHERE stato=3 AND tavolo=".$rigaT->idTavolo;
                $selezionaO=$db->query($queryO);
                if($selezionaO->num_rows>0)
                {     
?>					                     
                	<tr><th>Pietanza</th><th>Qt.</th><th>Note</th><th>Prezzo al pz.</th><th>Prezzo Tot.</th><th>Data</th><th>Ora</th><th>Cameriere</th><th colspan="2">Azioni</th></tr>   
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
                                <tr><td><?php echo $rigaM->nomeMenu; ?></td><td><?php echo $rigaO->quantita." pz."; ?></td><td><?php echo $note;?></td><td><?php echo $rigaO->tot/$rigaO->quantita."€"; ?></td><td><?php echo $rigaO->tot."€"; ?></td><td><?php echo $rigaO->data; ?></td><td><?php echo $rigaO->ora; ?></td><td><?php echo $rigaS->nome." ".$rigaS->cognome; ?></td><td colspan="2"><?php echo"<a href='cancellaOrdine.php?id=$rigaO->idOrdine'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Cancella</p></a>";?></td></tr>
<?php
                                
                            } 
                        }
                        else
                        {
?>
                            <tr><td><?php echo $rigaM->nomeMenu; ?></td><td><?php echo $rigaO->quantita." pz."; ?></td><td><?php echo $note;?></td><td><?php echo $rigaO->tot/$rigaO->quantita."€"; ?></td><td><?php echo $rigaO->tot."€"; ?></td><td><?php echo $rigaO->data; ?></td><td><?php echo $rigaO->ora; ?></td><td>Ordinaz. del Cliente</td><td colspan="2"><?php echo"<a href='cancellaOrdine.php?id=$rigaO->idOrdine'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Cancella</p></a>";?></td></tr>
<?php                            
                        }
                        $totale=$totale+$rigaO->tot;
                      }                    	
                    }
?>                    
                    <tr><th colspan="7">TOTALE DA PAGARE: <?php echo $totale ?>€ <b>IVA. esclusa</b></th><td class="bg-light"><?php echo"<a href='Scontrino.php?idTav=".$_GET['idTav']." & totale=".$totale."'><button class='btn btn-warning text-light'><img src='../img/scontrino.svg' style='width:25px;height:25px;'/>&nbsp;&nbsp;Scontrino</button></a>";?></td><td class="bg-light"><?php echo"<a href='pagaOrdine.php?idTav=".$_GET['idTav']." & totale=".$totale."'><button class='btn btn-success'><img src='../img/paybtn.svg' style='width:25px;height:25px;'/>&nbsp;&nbsp;Paga</button></a>";?></td></tr>
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