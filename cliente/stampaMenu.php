<?php
	include("../check/checkCodiceTavolo.php");
	if($_SESSION['idTav']!=NULL)
    {
    	include("navCliente.php");
?>
		<div class="container">
        	<div class="row">
            	<div class="col">
					<br/><h1 class="text-center">MEN&Ugrave;</h1><br/>                    
<?php        
    	include("../check/connessioneDatabase.php");
        $queryCategoria="SELECT * FROM categorie ORDER BY nomeCategoria ASC";
        $categoria=$db->query($queryCategoria);
        if($categoria->num_rows>0)
        {
?>
		  <table class="table table-responsive-lg table-bordered table-hover text-center">
<?php
          while($rigacategoria=$categoria->fetch_object())
          {
?>          
          		<tr><th colspan="4" class="bg-dark text-light"><?php echo $rigacategoria->nomeCategoria; ?></th></tr>
<?php                
            	$queryM="SELECT * FROM menu WHERE categoria=".$rigacategoria->idCategoria." AND attivo=1 ORDER BY prezzo ASC"; 
                $menu=$db->query($queryM);
                if($menu->num_rows>0)
                {
                    while($rigaM=$menu->fetch_object())
                    {           
                        if($rigaM->descrizione=="" || $rigaM->descrizione==" " || $rigaM->descrizione==NULL)
                        {
                            $stampDescrizione="/";
                        }
                        else
                        {
                            $stampDescrizione=$rigaM->descrizione;
                        }
                        echo "<tr><td>#".$rigaM->idMenu."</td><td>$rigaM->nomeMenu</td><td>$stampDescrizione</td><td>".$rigaM->prezzo."€</td></tr>";
                    }
                }
                else
                {
?>
                    <tr><td colspan="4"><div class="alert alert-danger" role="alert">
                      Errore! Non c'&egrave; nessuna pietanza nel men&ugrave; per questa categoria
                    </div></td></tr>
<?php                    
                }
        	}
?>
			</table>
<?php            
    	}
        else
        {
?>
            <tr><td colspan="4"><div class="alert alert-danger" role="alert">
                Errore! Non c'&egrave; nessuna pietanza nel men&ugrave;
            </div></td></tr>
<?php                    
        }           
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>