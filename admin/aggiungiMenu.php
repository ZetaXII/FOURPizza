<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");          
          if(isset($_POST['aggiungi']))
          {
            $pietanza=ucfirst($_POST['pietanza']);
            $tipo=$_POST['tipo'];
            $descrizione=$_POST['descrizione'];
            $prezzo=$_POST['prezzo'];
            $query="INSERT INTO menu (`nomeMenu`, `categoria`, `descrizione`, `prezzo`, `attivo`) VALUES ('".$pietanza."','".$tipo."','".$descrizione."','".$prezzo."','0')";
            $db->query($query);        
            header("location: stampaMenu.php");
          }
          else
          {
          		include("navAdmin.php");
 ?>
 				&nbsp;<a href="stampaMenu.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
 				<h1 class="text-center">AGGIUNGI PIETANZA</h1>
                <form action="#" method="post">
                	<table class="text-left" style="margin: 0px auto !important;">
                    	<tr><th>Pietanza</th><td><input type="text" class="form-control" name="pietanza" maxlength="30" minlength="3" required/></td></tr>      
                    	<tr><th>Tipo</th>
                        	<td>
                        		<select class="form-control" name="tipo">
                                	<option value=""></option>
<?php
									$queryCat="SELECT * FROM categorie ORDER BY nomeCategoria ASC";
                                    $cat=$db->query($queryCat);
                                    if($cat->num_rows>0)
                                    {
                                    	while($rigaCat=$cat->fetch_object())
                                        {
                                        	echo "<option value='$rigaCat->idCategoria'>$rigaCat->nomeCategoria</option>";
                                        }
                                    }
?>
                                </select>
                        	</td></tr>
                            <tr><th>Descrizione</th><td><textarea name="descrizione" class="form-control" maxlength="50" minlength="3"></textarea></td></tr>
                            <tr><th>Prezzo</th><td><input type="text" class="form-control" name="prezzo" minlength="1" required/></td></tr>         
                    	<tr class="text-center"><td colspan="2"><input type="submit" value="Aggiungi" name="aggiungi" class="btn btn-success"/>&nbsp;<input type="reset" value="Resetta" class="btn btn-danger"/></td></tr>
                 	</table>
                 </form>
         
 <?php
 			}
       }
       else
       {
       	  include("navAdmin.php");
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