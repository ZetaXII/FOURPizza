<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {    	
        if($_SESSION['stato']==1)
        {           
          include("../check/connessioneDatabase.php");
          $queryForm="SELECT * FROM menu WHERE idMenu=".$_GET['id'];
          $menu=$db->query($queryForm);
          $menu->num_rows;
          while($rigaM=$menu->fetch_object())
          {
              $nomeM=$rigaM->nomeMenu;
              $categoria=$rigaM->categoria;
              $prezzoM=$rigaM->prezzo;
              $descrizioneM=$rigaM->descrizione;
          }    	
          if(isset($_POST['modifica']))
          {
            $nome=ucfirst($_POST['nome']);
            $tipo=$_POST['tipo'];
            $prezzo=$_POST['prezzo'];
            $descrizione=$_POST['descrizione'];
            $query="UPDATE menu set nomeMenu='".$nome."' , categoria='".$tipo."' , descrizione='".$descrizione."' , prezzo=".$prezzo." WHERE idMenu=".$_GET['id'];
            $db->query($query);
            header("location: stampaMenu.php");
          }
          else
          {
            include("navAdmin.php");
  ?>
          &nbsp;<a href="stampaMenu.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
          <h1 class="text-center">MODIFICA PIETANZA</h1>
          <form action="#" method="post">
              <table class="text-left" style="margin: 0px auto !important;">
              <tr><th>Pietanza</th><td><input type="text" class="form-control" name="nome" maxlength="30" value="<?php echo $nomeM; ?>" required/></td></tr>
              <tr><th>Tipo</th>
                  <td>
                   <select class="form-control" name="tipo">
<?php
						   $queryCatCorrente="SELECT * FROM categorie WHERE idCategoria=".$categoria;
                           $catCorrente=$db->query($queryCatCorrente);
                           if($catCorrente->num_rows>0)
                           {
                           		while($rigaCatCorrente=$catCorrente->fetch_object())
                                {
                                	echo "<option value='$rigaCatCorrente->idCategoria'>$rigaCatCorrente->nomeCategoria</option>";
                                }
                           }
?>                          
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
                  <tr><th>Descrizione</th><td><textarea name="descrizione" class="form-control" maxlength="50" minlength="3"><?php echo $descrizioneM; ?></textarea></td></tr>
              	  <tr><th>Prezzo</th><td><input type="text" class="form-control" name="prezzo" minlength="1" value="<?php echo $prezzoM; ?>" required/></td></tr>
              	  <tr class="text-center"><td colspan="2"><input type="submit" value="Modifica" name="modifica" class="btn btn-success"/>&nbsp;<input type="reset" value="Resetta" class="btn btn-danger"/></td></tr>
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