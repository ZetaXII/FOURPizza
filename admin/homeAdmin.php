<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
		include("navAdmin.php");
?>        		
        <div class="container text-center">
        	<div class="row">
            	<div class="col-sm-2">
                </div>
            	<div class="col-sm-8">
                	<br/>
<?php 
                    if($_SESSION['immagine']!=NULL || $_SESSION['immagine']!=FALSE)
                    {
                    	echo "<img src='data:image/jpeg;base64,".$_SESSION['immagine']."' style='width:128px; height:128px; border-radius:80px;'/>";
                    }
                    else
                    {
                    	echo "<img src='../img/standardImg.jpg' style='width:128px; height:128px; border-radius:800px;'/>";
                    } 
?>
                	<br/><br/><h1>BENTORNATO ADMIN</h1>
                </div>
            	<div class="col-sm-2">
                </div>    
            </div>
        	<div class="row">
            	<div class="col-sm-2">
                </div>
            	<div class="col-sm-8">
                	<h2><?php echo strtoupper($_SESSION['nome'])." ".strtoupper($_SESSION['cognome']);?></h2>
                    <br/><br/><h4>Oggi &egrave; il <?php echo date("d/m/Y"); ?> </h4>
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