<?php  
	session_start();
	if($_SESSION['ruolo']=="A")
    {
      if($_SESSION['stato']==1)
      {    
          include("../check/connessioneDatabase.php");
          $f="scontrino.txt";
          unlink($f); //elimina il contenuto del file
          $file=fopen($f,"a");
          header('Content-Type: text/txt'); //specifica il tipo di file
          header("Content-Transfer-Encoding: Binary"); //codifica il contenuto in binario
          header("Content-disposition: attachment; filename=\"" . basename($f) . "\""); //genera il file specificando il nome e l'estensione (già specificata nella variabile $f)                     
		  $queryO="SELECT * FROM ordini WHERE stato='3' AND tavolo=".$_GET['idTav'];
          $selezionaO=$db->query($queryO);
          $i=1;
          //scrivo sul file utilizzando la stampa delle varie stringhe (con echo) anzichè fwrite siccome con l'auto download fwrite crea problemi di scrittura.
          if($selezionaO->num_rows>0)
          {     				                     
              echo "---------------------------------------------------------------------------- \n\r"; 
              echo "RISTORANTE-PIZZERIA FOUR PIZZA | tel. +39 309-1219-233 | Via della Seta n.12 \n\r";
              echo "---------------------------------------------------------------------------- \n\r";
              echo "-----------[SCONTRINO EFFETTUATO IL: ".date("d/m/Y")." ALLE ORE ".date('H:i')."]------------- \n\r";
              while($rigaO=$selezionaO->fetch_object())
              {                   
                  if($rigaO->note==NULL || $rigaO->note=='')
                  {
                      $note=" ";
                  }
                  else
                  {
                      $note="(".$rigaO->note.")";
                  }                
                  $queryM="SELECT * FROM menu WHERE idMenu=".$rigaO->pietanza;
                  $selezionaM=$db->query($queryM);                   
                  while($rigaM=$selezionaM->fetch_object())
                  {                  	
					echo $i.". ".$rigaM->nomeMenu.$note." - "; 
                    echo "qt.".$rigaO->quantita." - ";
                    echo $rigaO->tot."€ - ";                    
                    echo "consegnato al tavolo alle ".$rigaO->ora."\n\r";
                    $i++;
                  }                         	
            	}   
                	echo "Totale importo: ".$_GET['totale']."€ IVA. esclusa. \n\r";
                    echo "-----------------------[ ARRIVEDERCI E GRAZIE <3 ]----------------------------\n\r";
            }
            else
            {
?>
            	<tr><td><div class="alert alert-warning" role="alert">
                	Nessun ordine disponibile per questo tavolo.
               	</div></td></tr>
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