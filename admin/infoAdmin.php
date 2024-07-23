<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	include("../check/connessioneDatabase.php");
        $nome=$_SESSION['nome'];
        $cognome=$_SESSION['cognome'];
        $email=$_SESSION['email'];
        $password=$_SESSION['password'];
        $nick=$_SESSION['nick'];
        $ruolo=$_SESSION['ruolo'];
        $cellulare=$_SESSION['cellulare'];   
        $imgSession=$_SESSION['immagine'];     	
    	if(isset($_POST['modifica']))
        {
          if(isset($_POST['imgCanc']))
          {
              $imgCanc=$_POST['imgCanc'];
          }
          else
          {
              $imgCanc=NULL;
          }
          $nome=$_POST['nome'];
          $cognome=$_POST['cognome'];
          $email=$_POST['email'];
          $nick=$_POST['nick'];         
          $ruolo=$_POST['ruolo'];
          $cellulare=$_POST['cellulare'];            
          $password=$_POST['password'];
          if($password==" " || $password=="" || $password==NULL && $password>3)
          {
          	$password=$_SESSION['password'];
          }
          else
          {
          	$password=md5($password);
          }	          
          $queryControllaEmail="SELECT * FROM staff WHERE email='".$email."' AND idStaff!=".$_SESSION['idStaff'];
          $controllaEmail=$db->query($queryControllaEmail);
          $queryControllaNickname="SELECT * FROM staff WHERE nick='".$nick."' AND idStaff!=".$_SESSION['idStaff'];
          $controllaNickname=$db->query($queryControllaNickname);    
          if($controllaEmail->num_rows>=1)
          {
             include("navAdmin.php");
			 echo "&nbsp;<a href='infoAdmin.php'><button class='btn btn-danger' style='margin:10px auto;'>Indietro</button></a>
             <div class='alert alert-danger' role='alert'>
                ERRORE! Indirizzo e-mail gi&agrave; registrato.
             </div>";
          }
          else if($controllaNickname->num_rows>=1)
          {
             include("navAdmin.php");
			 echo "&nbsp;<a href='infoAdmin.php'><button class='btn btn-danger' style='margin:10px auto;'>Indietro</button></a>
             <div class='alert alert-danger' role='alert'>
                ERRORE! Nickname gi&agrave; registrato.
             </div>";
          }             
          else if($_FILES['img']['tmp_name']!=NULL && $imgCanc!='on')
          {
          	$grandezzaImg=(filesize($_FILES['img']['tmp_name'])/1024);          
            if($grandezzaImg<=64)
            {
              $_SESSION['nome']=$nome;
              $_SESSION['cognome']=$cognome;
              $_SESSION['email']=$email;
              $_SESSION['nick']=$nick;
              $_SESSION['password']=$password;
              $_SESSION['ruolo']=$ruolo;
              $_SESSION['cellulare']=$cellulare;                
              $nomeImg=addslashes($_FILES['img']['tmp_name']);
              $immagine=addslashes($_FILES['img']['tmp_name']);
              $immagine=file_get_contents($immagine);
              $immagine=base64_encode($immagine);
              $query="UPDATE staff set nome='".$nome."' , cognome='".$cognome."' , email='".$email."' , nick='".$nick."' , password='".$password."' , ruolo='".$ruolo."' , cellulare=".$cellulare." , immagine='".$immagine."' WHERE idStaff=".$_SESSION['idStaff'];
              $db->query($query);
              $_SESSION['immagine']=$immagine;
          	  header("location: homeAdmin.php");                              
            }
            else
            {
              include("navAdmin.php");
			  echo "&nbsp;<a href='infoAdmin.php'><button class='btn btn-danger' style='margin:10px auto;'>Indietro</button></a>
              <div class='alert alert-danger' role='alert'>
                Dimensione file troppo grande oppure formato immagine errato! (".$grandezzaImg."Kb)
              </div>";
            }
          }
          else
          {
            $_SESSION['nome']=$nome;
            $_SESSION['cognome']=$cognome;
            $_SESSION['email']=$email;
            $_SESSION['nick']=$nick;
            $_SESSION['password']=$password;
            $_SESSION['ruolo']=$ruolo;
            $_SESSION['cellulare']=$cellulare;              
            if($imgCanc=='on')
            {
              $immagine=NULL;
              $query="UPDATE staff set nome='".$nome."' , cognome='".$cognome."' , email='".$email."' , nick='".$nick."' , password='".$password."' , ruolo='".$ruolo."' , cellulare=".$cellulare." , immagine='".$immagine."' WHERE idStaff=".$_SESSION['idStaff'];
              $_SESSION['immagine']=$immagine;
              $db->query($query);          
              header("location: homeAdmin.php");              
            }      
            else
            {
          		$query="UPDATE staff set nome='".$nome."' , cognome='".$cognome."' , email='".$email."' , nick='".$nick."' , password='".$password."' , ruolo='".$ruolo."' , cellulare=".$cellulare." WHERE idStaff=".$_SESSION['idStaff'];
                $db->query($query);          
          		header("location: homeAdmin.php");
            }
          }
        }
        else
        {
            include("navAdmin.php");
?>				
				<h1 class="text-center">INFO ACCOUNT</h1>
                <form action="#" method="post" enctype="multipart/form-data">
                	<table class="text-left" style="margin: 0px auto !important;">
                    	<tr>
                          <th colspan="2" class="text-center">
<?php 
                            if($_SESSION['immagine']!=NULL || $_SESSION['immagine']!=FALSE)
                            {
                                echo "<img src='data:image/jpeg;base64,".$_SESSION['immagine']."' style='width:64px; height:64px; border-radius:80px;'/>";
                                }
                                else
                                {
                                    echo "<img src='../img/standardImg.jpg' style='width:64px; border-radius:80px;'/>";
                                } 
?>
                          </th>
                        </tr>
                        <tr>
                          <td colspan="2">
                         	 <div class="custom-file">
                            	<input type="file" class="custom-file-input" name="img" accept="image/*"/>
                            	<label class="custom-file-label"><img src="../img/edit.svg" style="height:18px"/> Cambia immagine</label>
                          	</div>    
                          <div class="input-group mb-3">
                            <label class="form-control"><img src="../img/bin.svg" style="height:20px"/> Elimina immagine</label>
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                              <input type="radio" name="imgCanc">
                              </div>
                            </div>  
                          </div>                          
                        </td>
                        </tr>
                    	<tr><th>Nome</th><td><input type="text" class="form-control" name="nome" maxlength="30" minlength="3" value="<?php echo $nome ?>" required/></td></tr>
                    	<tr><th>Cognome</th><td><input type="text" class="form-control" name="cognome" maxlength="30" minlength="3" value="<?php echo $cognome ?>" required/></td></tr>
                    	<tr><th>Nickname</th><td><input type="text" class="form-control" name="nick" maxlength="15" minlength="4" value="<?php echo $nick ?>" required/></td></tr>
                    	<tr><th>E-mail</th><td><input type="email" class="form-control" name="email" maxlength="45" minlength="10" value="<?php echo $email ?>" required/></td></tr>
                    	<tr><th>Password</th><td><input type="password" class="form-control" name="password" maxlength="30" minlength="4" placeholder="abc123"/></td></tr>
                    	<tr><th>Cellulare</th><td><input type="text" class="form-control" name="cellulare" maxlength="9" minlength="9" pattern="\d*" value="<?php echo $cellulare ?>" required/></td></tr>                
                    	<tr><th>Ruolo</th>
<?php
						switch($ruolo)
                        {
                        	case "A":
?>                            
                        	<td><input type="radio" class="radio-inline" name="ruolo" value="A" checked="checked">&nbsp;Admin&nbsp;<input type="radio" name="ruolo" value="P">&nbsp;Pizzaiolo&nbsp;<input type="radio" name="ruolo" value="C">&nbsp;Cameriere</td></tr> 
<?php
							break;
                        	case "P":
?>                            
							<td><input type="radio" class="radio-inline" name="ruolo" value="A">&nbsp;Admin&nbsp;<input type="radio" name="ruolo" value="P" checked="checked">&nbsp;Pizzaiolo&nbsp;<input type="radio" name="ruolo" value="C">&nbsp;Cameriere</td></tr>               
<?php
							break;
                        	case "C":
?>                            
                        	<td><input type="radio" class="radio-inline" name="ruolo" value="A">&nbsp;Admin&nbsp;<input type="radio" name="ruolo" value="P">&nbsp;Pizzaiolo&nbsp;<input type="radio" name="ruolo" value="C" checked="checked">&nbsp;Cameriere</td></tr> 
<?php
							break; 
                        	default:
?>                            
							<td><input type="radio" class="radio-inline" name="ruolo" value="A">&nbsp;Admin&nbsp;<input type="radio" name="ruolo" value="P">&nbsp;Pizzaiolo&nbsp;<input type="radio" name="ruolo" value="C">&nbsp;Cameriere</td></tr>           
<?php
							break; 
                        }
?>                        
						
                        <tr class="text-center"><td colspan="2"><input type="submit" value="Modifica" name="modifica" class="btn btn-success"/>&nbsp;<input type="reset" value="Resetta" class="btn btn-danger"/></td></tr>
                 	</table>
                 </form>
<?php
        }
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>