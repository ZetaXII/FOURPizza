<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	include("navAdmin.php");
?>
		<div class="container">
        	<div class="row">
            	<div class="col">
					<br/><h1 class="text-center">GESTIONE MEN&Ugrave;</h1><br/>
                    <a href="aggiungiMenu.php" style="text-decoration:none;"><button class="btn btn-success btn-block">Aggiungi pietanza</button></a>
<?php        
    	include("../check/connessioneDatabase.php");
        $queryM="SELECT * FROM menu";
        $menu=$db->query($queryM);
        if($menu->num_rows>0)
        {
?>            
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <tr><th>#</th><th>Pietanza</th><th>Tipo</th><th>Descrizione</th><th>Prezzo</th><th colspan="2">Azioni</th><th>Disponibile</th></tr> 
<?php                
        	while($rigaM=$menu->fetch_object())
            {
                $queryC="SELECT * FROM categorie WHERE idCategoria=".$rigaM->categoria;
                $cat=$db->query($queryC);
                if($cat->num_rows>0)
                {
                  while($rigaCat=$cat->fetch_object())
                  {
                        switch($rigaM->attivo)
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
                        if($rigaM->descrizione=="" || $rigaM->descrizione==" " || $rigaM->descrizione==NULL)
                        {
                            $stampDescrizione="/";
                        }
                        else
                        {
                            $stampDescrizione=$rigaM->descrizione;
                        }
                        echo "<tr><td>#".$rigaM->idMenu."</td><td>$rigaM->nomeMenu</td><td>$rigaCat->nomeCategoria</td><td>$stampDescrizione</td><td>".$rigaM->prezzo."€</td><td><a href='cancellaMenu.php?id=$rigaM->idMenu'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Cancella</p></a></td><td><a href='modificaMenu.php?id=$rigaM->idMenu'><p style='color:#1273EB;'><img src='../img/edit.svg' style='height:20px;'/>&nbsp;Modifica</p></a></td><td><a href='attivaMenu.php?id=$rigaM->idMenu'>$stato</a></td></tr>";
                    }
                }
            }
          	echo "</table>";
        }
        else
        {
?>            
              <div class="alert alert-danger" role="alert">
                Nessuna pietanza nel men&ugrave;. Clicca <a href="aggiungiMenu.php">qui</a> per aggiungere una pietanza
              </div> 
<?php               
        }
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>