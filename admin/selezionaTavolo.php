<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {    	
    	if($_SESSION['stato']==1)
        {       
          include("../check/connessioneDatabase.php");
          if(isset($_POST['tavolo']) && isset($_POST['continua']))
          { 
          	$tavolo=$_POST['tavolo'];
            header("location: stampaOrdiniPagare.php?idTav=$tavolo");
          }
          else
          {
          		include("navAdmin.php");
?>                    		
				<h1 class="text-center">SELEZIONA TAVOLO</h1>
 				<div class="container text-center">
 					<div class="row">
                    	<div class="col-lg-5">
                        </div>
                        <div class="col-lg-2">                          
                          <form action="#" method="post">                	
<?php 
                              $query="SELECT * FROM tavoli WHERE attivo=1 ORDER BY numTavolo ASC";
                              $seleziona=$db->query($query);
                              if($seleziona->num_rows>0)
                              {                  
                                while($tavolo=$seleziona->fetch_object())
                                {
?>
                                  <div class="input-group text-center mb-3">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text bg-dark w-100">
                                      	<input type="radio" name="tavolo" value="<?php echo $tavolo->idTavolo; ?>" required/>
                                      </div>
                                    </div>
                                      <span class="input-group-text bg-white w-75" id="inputGroup-sizing-default">Tavolo N°<?php echo $tavolo->numTavolo; ?></span>
                                  </div>
<?php
                                }
?>	
                               <input type="submit" value="Continua" name="continua" class="btn btn-success text-center"/>		
                             </form>    
                        </div>
                    	<div class="col-lg-5">
                        </div>
                      </div>
                    </div>
<?php                      
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