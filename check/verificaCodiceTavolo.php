<!DOCTYPE html>
<html>
<head>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="generator" content="AlterVista - Editor HTML"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	if(isset($_POST['verifica']))
    {
    	include("connessioneDatabase.php");
        $queryTavolo="SELECT * FROM tavoli WHERE codVerifica='".$_POST['codVerifica']."' AND attivo=1";
        $tavolo=$db->query($queryTavolo);
        if($tavolo->num_rows>0)
        {
        	session_start();
        	while($rigaTavolo=$tavolo->fetch_object())
            {
              $_SESSION['idTav']=$rigaTavolo->idTavolo;
              $_SESSION['codVerifica']=$rigaTavolo->codVerifica;
              header("location: ../cliente/homeCliente.php");            
            }
        }
        else
        {
?>
          <div class="alert alert-danger" role="alert">
              Errore! Codice errato, <a href="../cliente/FormVerificaCodiceTavolo.html">clicca qui</a> per tornare indietro
          </div>
<?php          
        }
    }
?>
</body>
</html>