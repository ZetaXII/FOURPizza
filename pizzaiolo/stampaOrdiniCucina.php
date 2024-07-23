<?php
	session_start();
	if($_SESSION['ruolo']=="P")
    {
		include("navPizzaiolo.php");    
    	if($_SESSION['stato']==1)
        {          
 ?>
          <div class="container">
              <div class="row">
                  <div class="col">
                      <br/><h1 class="text-center">ORDINI IN CUCINA</h1><br/>                    
 <?php
          include("../check/connessioneDatabase.php");
          $queryT="SELECT * FROM tavoli WHERE attivo=1 ORDER BY numTavolo ASC";
          $selezionaT=$db->query($queryT);
          if($selezionaT->num_rows>0)
          {
              while($rigaT=$selezionaT->fetch_object())
              {
 ?>
                  <table class="table table-responsive-lg table-bordered table-hover text-center">
                  <tr class="bg-dark text-white"><th colspan="8">ORDINI TAVOLO N° <?php echo $rigaT->numTavolo ?></th></tr>
 <?php
                  $queryO="SELECT * FROM ordini WHERE stato=1 AND tavolo=".$rigaT->idTavolo." ORDER BY ora ASC";
                  $selezionaO=$db->query($queryO);
                  if($selezionaO->num_rows>0)
                  {     
 ?>					                     
                      <tr><th>Pietanza</th><th>Qt.</th><th>Note</th><th>Cameriere</th><th>Data</th><th>Ora</th><th colspan="2">Azioni</th></tr>   
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
                              <tr><td><?php echo $rigaM->nomeMenu; ?></td><td><?php echo $rigaO->quantita." pz."; ?></td><td><?php echo $note; ?></td><td><?php echo $rigaS->nome." ".$rigaS->cognome; ?></td><td><?php echo $rigaO->data; ?></td><td><?php echo $rigaO->ora; ?></td><td><?php echo"<a href='cancellaOrdine.php?id=$rigaO->idOrdine'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Cancella</p></a>";?></td><td><?php echo"<a href='preparaOrdine.php?id=$rigaO->idOrdine'><p style='color:#FFCE00;'><img src='../img/deliver.svg' style='width:25px;height:25px;'/>&nbsp;Prepara</p></a>";?></td></tr>
 <?php
                            }
                          }
                          else
                          {                        
 ?>
                              <tr><td><?php echo $rigaM->nomeMenu; ?></td><td><?php echo $rigaO->quantita." pz."; ?></td><td><?php echo $note; ?></td><td>Ordinaz. del Cliente</td><td><?php echo $rigaO->data; ?></td><td><?php echo $rigaO->ora; ?></td><td><?php echo"<a href='cancellaOrdine.php?id=$rigaO->idOrdine'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Cancella</p></a>";?></td><td><?php echo"<a href='preparaOrdine.php?id=$rigaO->idOrdine'><p style='color:#FFCE00;'><img src='../img/deliver.svg' style='width:25px;height:25px;'/>&nbsp;Prepara</p></a>";?></td></tr> 
 <?php                    
                          }
                        }                   	
                     }
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