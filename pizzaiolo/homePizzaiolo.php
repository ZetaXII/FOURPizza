<?php
	session_start();
	if($_SESSION['ruolo']=="P")
    {
		include("navPizzaiolo.php");
?>        
<style> .imgAccount{width:140px; height:140px; border:1px solid gray; border-radius:100px;} </style>
        <div class="container text-center">
        	<div class="row">
            	<div class="col-sm-2">
                </div>
            	<div class="col-sm-8">
                	<br/>
                        <?php 
                        	if($_SESSION['immagine']!=NULL || $_SESSION['immagine']!=FALSE)
                        	{
                         		echo "<img src='data:image/jpeg;base64,".$_SESSION['immagine']."' style='width:128px; height:128px; border-radius:80px; border:1px solid gray'/>";
                        	}
                        	else
                        	{
                         		echo "<img src='../img/standardImg.jpg' style='width:128px; height:128px; border-radius:80px;'/>";
                        	} 
                         ?>					
                	<br/><br/><h1>BENTORNATO PIZZAIOLO</h1>
                </div>
            	<div class="col-sm-2">
                </div>    
            </div>
        	<div class="row">
            	<div class="col-sm-2">
                </div>
            	<div class="col-sm-8">
                	<h1><?php echo strtoupper($_SESSION['nome'])." ".strtoupper($_SESSION['cognome']);?></h1>
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