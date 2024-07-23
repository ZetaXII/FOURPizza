<?php
	include("../check/checkCodiceTavolo.php");
	if($_SESSION['idTav']!=NULL)
    {
    	  include("navCliente.php");        
          include("../check/connessioneDatabase.php");
          $totaleOrdinazione=0;
          if(isset($_POST['inserisci']))
          {             
            $str=explode(" | ",$_POST['pietanza']);
            $pietanza=$str[0];
            $prezzo=$str[1];
            $quantita=$_POST['quantita'];
            $note=$_POST['note'];
            $tot=$prezzo*$quantita;
            $query="INSERT INTO `ordini` (`pietanza`, `tavolo`, `quantita`, `note`, `data`, `ora`, `tot`, `stato`) VALUES ('".$pietanza."', '".$_SESSION['idTav']."', '".$quantita."', '".$note."', '".date('d/m/Y')."', '".date('H:i')."', '".$tot."', '0');";
            $db->query($query);
            $str=NULL;
            $pietanza=NULL;
            $prezzo=NULL;
            $quantita=NULL;
            $tot=NULL;            
          }
 ?> 			
 				<div class="container text-center">
 					<div class="row">
                        <div class="col-sm-6">                           
                          <h3 class="text-center">ORDINAZIONE</h3>
<?php
                          $queryM="SELECT * FROM menu WHERE attivo=1 ORDER BY categoria ASC";
                          $selezionaM=$db->query($queryM);
                          if($selezionaM->num_rows>0)
                          {  
?>                        
                          <form action="#" method="post">   
                          	<table class="text-left" style="margin: 0px auto !important;">
                          	<tr class="mb-3"><th>Pietanza</th><td><select name="pietanza" class="form-control" required>
                            	<option value=""></option>
<?php               
                                while($menu=$selezionaM->fetch_object())
                                {
                                    $queryCategoriaForm="SELECT * FROM categorie WHERE idCategoria=".$menu->categoria;
                                    $selezCategoriaForm=$db->query($queryCategoriaForm);
                                    if($selezCategoriaForm>0)
                                    {
                                        while($categoriaForm=$selezCategoriaForm->fetch_object())
                                        {
?>									
                                            <option value="<?php echo $menu->idMenu." | ".$menu->prezzo; ?>"><?php echo $categoriaForm->nomeCategoria.": ".$menu->nomeMenu; ?></option>                                    
<?php                                            
                                        }
                                    }
                                }
?>	
							   </select></td></tr>
                               <tr class="mb-3"><th>Quantit&agrave;</th><td><input type="number" name="quantita" class="form-control" min="1" max="50" required/></td></tr>
                               <tr class="mb-3"><th>Note</th><td><textarea class="form-control" name="note"></textarea></tr>
                               <tr class="mb-3"><td colspan="2" class="text-center"><input type="submit" value="Aggiungi" name="inserisci" class="btn btn-success text-center"/>&nbsp;<input type="reset" value="Resetta" class="btn btn-danger text-center"/></td></tr>		
                             </table>
                             </form>
<?php 
							  }
                              else
                              {
?>
                                <div class="alert alert-danger" role="alert">
                                  Nessun pietanza disponibile, contattare l'Admin
                                </div>
<?php                              
                              }
?>                            <br/>                           
                        </div>
                    	<div class="col-sm-6">
                         	 <h3 class="text-center">RESOCONTO ORDINE:</h3>
<?php 
                              $queryT="SELECT * FROM tavoli WHERE idTavolo=".$_SESSION['idTav'];
                              $selezionaT=$db->query($queryT);
                              if($selezionaT->num_rows>0)
                              {
                                while($tavolo=$selezionaT->fetch_object())
                                {
                                  $queryO="SELECT * FROM ordini WHERE stato=0 AND tavolo=".$tavolo->idTavolo." AND data='".date('d/m/Y')."'";
                                  $selezionaO=$db->query($queryO);
                                  if($selezionaO->num_rows>0)
                                  {  
?>                              
                                    <table class="table table-responsive-sm table-bordered table-hover text-center" style="margin: 0px auto !important;">
                                        <tr><th>Pietanza</th><th>Categoria</th><th>Qt.</th><th>Note</th><th>Prezzo</th><th>Azioni</th></tr>                            		
<?php                                
                                        while($ordine=$selezionaO->fetch_object())
                                        {
                                            $queryMenu="SELECT * FROM menu WHERE idMenu=".$ordine->pietanza;
                                            $selezionaMenu=$db->query($queryMenu);
                                            while($menu=$selezionaMenu->fetch_object())
                                            {
                                                $queryCategoria="SELECT * FROM categorie WHERE idCategoria=".$menu->categoria;
                                                $selezionaCategoria=$db->query($queryCategoria);
                                                if($selezionaCategoria->num_rows>0)
                                                {

                                                    while($categoria=$selezionaCategoria->fetch_object())
                                                    {
                                                        if($ordine->note==NULL || $ordine->note=='' || $ordine->note==' ')
                                                        {
                                                            $note="/";
                                                        }
                                                        else
                                                        {
                                                            $note=$ordine->note;
                                                        }
?>
                                                        <tr><td><?php echo $menu->nomeMenu; ?></td><td><?php echo $categoria->nomeCategoria; ?></td><td><?php echo $ordine->quantita; ?> pz.</td><td><?php echo $note; ?></td><td><?php echo $ordine->tot; ?>€</td><td><?php echo"<a href='cancellaOrdine.php?id=$ordine->idOrdine'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Cancella</p></a>";?></td></tr>
<?php
                                                        $totaleOrdinazione=$totaleOrdinazione+$ordine->tot;
                                                    }
                                                  }                                        
                                               }                                  
                                            }
?>
                                            <tr class="bg-light text-dark text-center"><td colspan="6">Totale ordinazione: <?php echo $totaleOrdinazione."€"; ?></td></tr>
                                            <tr class="bg-light text-dark text-center"><td colspan="6"><a href="procediAllOrdine.php"><button class="btn btn-success">Procedi all'ordine</button></a></td></tr>
<?php                                    
                                      }                 
                                      else
                                      {
?>
                                        <div class="alert alert-warning" role="alert">
                                          Nessun pietanza aggiunto all'ordinazione.
                                        </div>
<?php
                                      } 
                                    }
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