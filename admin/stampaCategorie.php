<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	include("navAdmin.php");
?>
		<div class="container">
        	<div class="row">
            	<div class="col">
					<br/><h1 class="text-center">GESTIONE CATEGORIE PIETANZE</h1><br/>
                    <a href="aggiungiCategoria.php" style="text-decoration:none;"><button class="btn btn-success btn-block">Aggiungi Categoria</button></a>
<?php        
    	include("../check/connessioneDatabase.php");
        $query="SELECT * FROM categorie ORDER BY nomeCategoria ASC";
        $categoria=$db->query($query);
        if($categoria->num_rows<=0)
        {
?>            
              <div class="alert alert-danger" role="alert">
                Nessuna categoria. Clicca <a href="aggiungiCategoria.php">qui</a> per aggiungere una categoria
              </div> 
<?php         
        }
        else
        {
?>            
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <tr><th>Categoria</th><th colspan="2">Azioni</th></tr>
<?php            
          while($riga=$categoria->fetch_object())
          {          
              	echo "<tr><td>$riga->nomeCategoria</td><td><a href='cancellaCategoria.php?id=$riga->idCategoria'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Cancella</p></a></td><td><a href='modificaCategoria.php?id=$riga->idCategoria'><p style='color:#1273EB;'><img src='../img/edit.svg' style='height:20px;'/>&nbsp;Modifica</p></a></td></tr>";
          }
          echo "</table>";
        }
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>