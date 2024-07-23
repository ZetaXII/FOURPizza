<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {    	    	
        if($_SESSION['stato']==1)
        {           
          include("../check/connessioneDatabase.php");
          $queryForm="SELECT * FROM categorie WHERE idCategoria=".$_GET['id'];
          $categoria=$db->query($queryForm);
          $categoria->num_rows;
          while($riga=$categoria->fetch_object())
          {
              $catForm=$riga->nomeCategoria;
          }    	
          if(isset($_POST['modifica']))
          {
            $cat=$_POST['categoria'];
            $selectCategoria="SELECT * FROM categorie WHERE nomeCategoria='".$cat."' AND idCategoria!=".$_GET['id'];
            $controllaCategoria=$db->query($selectCategoria);
            if($controllaCategoria->num_rows==0)
            {                
                  $query="UPDATE categorie SET nomeCategoria='".$cat."' WHERE idCategoria=".$_GET['id'];
                  $db->query($query);
                  header("location: stampaCategorie.php");                
			}
            else
            {
              include("navAdmin.php");
?>            
              &nbsp;<a href="stampaCategorie.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
              <div class="alert alert-danger" role="alert">
                ERRORE! Categoria già esistente
              </div> 
<?php              
            }
          }
          else
          {            
          	include("navAdmin.php");
  ?>
          &nbsp;<a href="stampaCategorie.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
          <h1 class="text-center">MODIFICA CATEGORIA PIETANZA</h1>
          	<form action="#" method="post">
           		<table class="text-left" style="margin: 0px auto !important;">
               		<tr><th>Nome Categoria</th><td><input type="text" class="form-control" name="categoria" minlength="4" maxlength="30" value="<?php echo $catForm; ?>" required/></td></tr>      					
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