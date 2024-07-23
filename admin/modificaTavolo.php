<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {    	    	
        if($_SESSION['stato']==1)
        {           
          include("../check/connessioneDatabase.php");
          $queryForm="SELECT * FROM tavoli WHERE idTavolo=".$_GET['id'];
          $tavolo=$db->query($queryForm);
          $tavolo->num_rows;
          while($riga=$tavolo->fetch_object())
          {
              $numero=$riga->numTavolo;
              $posti=$riga->numPosti;
              $codVerifica=$riga->codVerifica;
          }    	
          if(isset($_POST['modifica']))
          {
            $numTavolo=$_POST['numTavolo'];
            $numPosti=$_POST['numPosti'];
            $codVerifica=$_POST['codVerifica'];
            $selectTavoli="SELECT * FROM tavoli WHERE numTavolo=".$numTavolo." AND idTavolo!=".$_GET['id'];
            $controlloTav=$db->query($selectTavoli);
            if($controlloTav->num_rows==0)
            {                
            	$selectCodiceVerifica="SELECT * FROM tavoli WHERE codVerifica=".$codVerifica." AND idTavolo!=".$_GET['id'];;
                $controlloCodice=$db->query($selectCodiceVerifica);
                if($controlloCodice->num_rows==0)
            	{  
                  echo $query="UPDATE tavoli SET numTavolo='".$numTavolo."' , numPosti='".$numPosti."' , codVerifica='".$codVerifica."' WHERE idTavolo=".$_GET['id'];
                  $db->query($query);
                  header("location: stampaTavoli.php");
                }
                else
            	{
              		include("navAdmin.php");
?>            
                    &nbsp;<a href="stampaTavoli.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
                    <div class="alert alert-danger" role="alert">
                      ERRORE! Codice già assegnato ad un tavolo.
                    </div> 
<?php              
            	}                
			}
            else
            {
              include("navAdmin.php");
?>            
              &nbsp;<a href="stampaTavoli.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
              <div class="alert alert-danger" role="alert">
                ERRORE! Tavolo già esistente. Clicca <a href="aggiungiTavolo.php">qui</a> per aggiungere un tavolo
              </div> 
<?php              
            }
          }
          else
          {            
          	include("navAdmin.php");
  ?>
          &nbsp;<a href="stampaTavoli.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
          <h1 class="text-center">MODIFICA TAVOLO</h1>
          	<form action="#" method="post">
           		<table class="text-left" style="margin: 0px auto !important;">
               		<tr><th>Numero Tavolo</th><td><input type="number" class="form-control" name="numTavolo" min="1" min="1" value="<?php echo $numero; ?>" required/></td></tr>      
					<tr><th>Numero Posti</th><td><input type="number" class="form-control" name="numPosti" min="1" min="1" value="<?php echo $posti; ?>" required/></td></tr>  
                    <tr><th>Codice Tavolo</th><td><input type="text" class="form-control" name="codVerifica" minlength="6" maxlength="6" value="<?php echo $codVerifica; ?>" required/></td></tr>
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