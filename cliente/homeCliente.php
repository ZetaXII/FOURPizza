<?php
	include("../check/checkCodiceTavolo.php");
	if($_SESSION['idTav']!=NULL)
    {
		include("navCliente.php");
?>        		
        <div class="container text-center">
        	<div class="row">
            	<div class="col-sm-2">
                </div>
            	<div class="col-sm-8">
                	<br/>
                      <br/><br/><h1>BENVENUTO CLIENTE!</h1><br/>
                </div>
            	<div class="col-sm-2">
                </div>    
            </div>
        	<div class="row">
            	<div class="col-sm-2">
                </div>
            	<div class="col-sm-8">
                    <a href="nuovoOrdine.php"><button class="btn btn-success btn-lg">Inizia ad ordinare!</button></a><br/><br/>
                    <p>oppure</p>
                    <a href="stampaMenu.php"><button class="btn btn-danger btn-lg">Consulta il men&ugrave;</button></a><br/><br/>
                </div>
            	<div class="col-sm-2">                	
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