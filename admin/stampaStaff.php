<?php
	session_start();
	if($_SESSION['ruolo']=="A")
    {
    	include("navAdmin.php");
?>
		<div class="container">
        	<div class="row">
            	<div class="col">
					<br/><h1 class="text-center">GESTIONE STAFF</h1><br/>
                    <a href="aggiungiStaff.php" style="text-decoration:none;"><button class="btn btn-success btn-block">Aggiungi Staff</button></a>
<?php
        include("../check/connessioneDatabase.php");
        $query="SELECT * FROM staff WHERE idStaff!=".$_SESSION['idStaff']." ORDER BY ruolo ASC";
        $staff=$db->query($query);
        if($staff->num_rows<=0)
        {
?>            
              <div class="alert alert-danger" role="alert">
                Nessun membro dello staff. Clicca <a href="aggiungiStaff.php">qui</a> per aggiungere un dipendente
              </div> 
<?php    
        }
        else
        {
                switch($_SESSION['stato'])
                {
                   case 0:
                   $stato="<p class='badge badge-danger'>Offline</p>";
                   break;
                   case 1:
                   $stato="<p class='badge badge-success'>Online</p>";
                   break;
                   default:
                   $stato="<p class='badge badge-dark'>N/A</p>";
                   break;                 
                }               
?>            
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <tr><th></th><th>Nome</th><th>Cognome</th><th>Nickname</th><th>E-mail</th><th>Ruolo</th><th>Cellulare</th><th colspan="2">Azioni</th><th>Stato</th></tr>
<?php       
			if($_SESSION['immagine']!=NULL || $_SESSION['immagine']!=FALSE)
            {
            	$imgTd="<img src='data:image/jpeg;base64,".$_SESSION['immagine']."' style='width:32px; height:32px; border:1px solid gray; border-radius:30px;'/>";
            }
            else
            {
            	$imgTd="<img src='../img/standardImg.jpg' style='width:32px; border-radius:80px;'/>";
            }
			echo"<tr><td>".$imgTd."</td><td>".$_SESSION['nome']."</td><td>".$_SESSION['cognome']."</td><td>".$_SESSION['nick']."</td><td>".$_SESSION['email']."</td><td><p class='badge badge-primary'>Admin</p></td><td>".$_SESSION['cellulare']."</td><td colspan='2'>Nessuna azione</td><td>".$stato."</td></tr>";
            while($riga=$staff->fetch_object())
            {
                switch($riga->ruolo)
                {
                   case "A":
                   $ruolo="<p class='badge badge-primary'>Admin</p>";
                   break;
                   case "C":
                   $ruolo="<p class='badge badge-warning'>Cameriere</p>";
                   break;
                   case "P":
                   $ruolo="<p class='badge badge-info'>Pizzaiolo</p>";
                   break;
                   default:
                   $ruolo="<p class='badge badge-dark'>N/A</p>";
                   break;                 
                }
                switch($riga->stato)
                {
                   case 0:
                   $stato="<p class='badge badge-danger'>Offline</p>";
                   break;
                   case 1:
                   $stato="<p class='badge badge-success'>Online</p>";
                   break;
                   default:
                   $stato="<p class='badge badge-dark'>N/A</p>";
                   break;                 
                }
                if($riga->immagine==NULL)
                {
                	$img="<img src='../img/standardImg.jpg' style='width:32px; height:32px; border:1px solid gray; border-radius:30px;'/>";
                }
                else
                {
                	$img="<img src='data:image/jpeg;base64,".$riga->immagine."' style='width:32px; height:32px; border:1px solid gray; border-radius:30px;'/>";
                }
                echo "<tr><td>".$img."</td><td>$riga->nome</td><td>$riga->cognome</td><td>$riga->nick</td><td>$riga->email</td><td>$ruolo</td><td>$riga->cellulare</td><td><a href='licenziaStaff.php?id=$riga->idStaff' script='conferma()'><p style='color:#C12020;'><img src='../img/bin.svg' style='width:20px;height:20px;'/>&nbsp;Licenzia</p></a></td><td><a href='modificaStaff.php?id=$riga->idStaff'><p style='color:#1273EB;'><img src='../img/edit.svg' style='height:20px;'/>&nbsp;Modifica</p></a></td><td><a href='statoStaff.php?id=$riga->idStaff'>".$stato."</a></td></tr>";
          }
?>
                </table>
            </div>
        </div>
    </div>
<?php
        }
    }
    else
    {
    	header("location: ../check/accessonegato.html");
    }
?>