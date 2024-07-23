<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {    	
    	if($_SESSION['stato']==1)
        {
          include("../check/connessioneDatabase.php");          
          if(isset($_POST['aggiungi']))
          {
            $nome=ucfirst($_POST['nome']);
            $cognome=ucfirst($_POST['cognome']);
            $nick=$_POST['nick'];
            $email=$_POST['email'];
            $password=md5($_POST['password']);
            $ruolo=$_POST['ruolo'];
            $cellulare=$_POST['cellulare'];
            $queryControllaEmail="SELECT * FROM staff WHERE email='".$email."'";
            $controllaEmail=$db->query($queryControllaEmail);
            $queryControllaNickname="SELECT * FROM staff WHERE nick='".$nick."'";
            $controllaNickname=$db->query($queryControllaNickname);              
            if($controllaEmail->num_rows>=1)
            {
                include("navAdmin.php");
?>
&nbsp;<a href="aggiungiStaff.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
<div class="alert alert-danger" role="alert">
    ERRORE! Indirizzo e-mail già utilizzato da un altro utente.
</div>
<?php
            }
            else if($controllaNickname->num_rows>=1)
            {
                include("navAdmin.php");
?>
&nbsp;<a href="aggiungiStaff.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
<div class="alert alert-danger" role="alert">
    ERRORE! Nickname già utilizzato da un altro utente.
</div>
<?php
            }              
            else
            {
                $query="INSERT INTO staff (`nome`, `cognome`, `nick`,`email`, `password`, `ruolo`, `cellulare`,`stato`) VALUES ('".$nome."','".$cognome."','".$nick."','".$email."','".$password."','".$ruolo."','".$cellulare."','0')";
                $db->query($query);
                header("location: stampaStaff.php");
            }
          }
          else
          {
          		include("navAdmin.php");
 ?>
 				&nbsp;<a href="stampaStaff.php"><button class="btn btn-danger" style="margin:10px auto;">Indietro</button></a>
 				<h1 class="text-center">AGGIUNGI UTENTE</h1>
                <form action="#" method="post">
                	<table class="text-left" style="margin: 0px auto !important;">
                    	<tr><th>Nome</th><td><input type="text" class="form-control" name="nome" maxlength="30" minlength="3" required/></td></tr>
                    	<tr><th>Cognome</th><td><input type="text" class="form-control" name="cognome" maxlength="30" minlength="3" required/></td></tr>
                    	<tr><th>Nickname</th><td><input type="text" class="form-control" name="nick" maxlength="15" minlength="4" required/></td></tr>
                    	<tr><th>E-mail</th><td><input type="email" class="form-control" name="email" maxlength="45" minlength="10" required/></td></tr>
                    	<tr><th>Password</th><td><input type="password" class="form-control" name="password" maxlength="30" minlength="4" required/></td></tr>
                    	<tr><th>Cellulare</th><td><input type="text" class="form-control" name="cellulare" maxlength="9" minlength="9" pattern="\d*" required/></td></tr>                
                    	<tr><th>Ruolo</th><td><input type="radio" class="radio-inline" name="ruolo" value="A">&nbsp;Admin&nbsp;<input type="radio" name="ruolo" value="P">&nbsp;Pizzaiolo&nbsp;<input type="radio" name="ruolo" value="C">&nbsp;Cameriere</td></tr> 
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