<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {    	
    	if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");          
          if(isset($_POST['aggiungi']))
          {
            $categoria=$_POST['categoria'];
            $selectCategorie="SELECT * FROM categorie WHERE nomeCategoria='".$categoria."'";
            $controllaCategorie=$db->query($selectCategorie);
            if($controllaCategorie->num_rows==0)
            {                
                  $query="INSERT INTO categorie (`nomeCategoria`) VALUES ('".$categoria."')";
                  $db->query($query);
                  header("location: stampaCategorie.php");          
			}
            else
            {
              include("navAdmin.php");
?>            
              <div class="alert alert-danger" role="alert">
                ERRORE! Categoria già esistente. Clicca <a href="aggiungiCategoria.php">qui</a> per aggiungere una categoria
              </div> 
<?php              
            }
          }
          else
          {
          		include("navAdmin.php");
 ?>
 				&nbsp;<a href="stampaCategorie.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
 				<h1 class="text-center">AGGIUNGI CATEGORIA PIETANZE</h1>
                <form action="#" method="post">
                	<table class="text-left" style="margin: 0px auto !important;">
                    	<tr><th>Nome Categoria</th><td><input type="text" class="form-control" name="categoria" minlength="4" maxlength="30" required/></td></tr>      						
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