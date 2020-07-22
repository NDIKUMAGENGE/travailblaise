<?php 
ob_start();
?>
<?php

include_once '../config/database.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
    $id=$_GET['id'];
$request="select * from facture where num_fact='$id'";
$resultat=$db->query($request);
$t=$resultat->fetch();
$num_fact=$t['num_fact'];
$num_dossier=$t['num_dossier'];
$montant_base=$t['montant_base'];

//recherche de l' id client
$requestc="select * from dossier where num_dossier='$num_dossier'";
$resultatc=$db->query($requestc);
$tc=$resultatc->fetch();
$idclient=$tc['benificiaire'];
//recherche des information du client

$requestci="select * from client where id='$idclient'";
$resultatci=$db->query($requestci);
$tci=$resultatci->fetch();
$nom=$tci['nom'];
$prenom=$tci['prenom'];
$cni=$tci['n_identite'];


    ?>
    <page>
<div style="background-color:#ccc">

    <div><img style="width:60px;" src="../img/so2.jpg"/></div>
    <div> Nom du cabinet--------------------------------------------------------------------------------------------------------------</div>
    <div> Adresse-------------------------------------------------------------------------------------------------------------------------------------------------</div>
    <div> Telephone------------------------------------------------------------------------------------------------------------------------------------------------------</div>
    <div> Mail---------------------------------------------------------------------------------------------------------------------------------------------------</div>
    <div> Represantant--------------------------------------------------------------------------------------------------------------------------------------------------------</div>
    <div> NIF------------------------------------------------------------------------------------------------------------------------------------------------------------S</div>
<div> Nom  ----------------------------- <?php echo $nom;?></div>

<div>Prenom  ------------------------- <?php echo $prenom;?></div>

<div>Cni  -------------------<?php echo $cni;?></div>

<div>Numero Dossier-------------------------<?php echo $num_dossier;?></div>
    <div> numero Facture-------------<?php echo $num_fact;?></div>
    <div> Montant :------------------------<?php echo $montant_base;?> frbu</div>
    <div></div>
    <div></div>
    <div> Signature :------------------------</div>
   
    
<?php







include('qrcode.php');
// how to build raw content - QRCode to send email, with extras
    
    $tempDir = 'qrcode/';
    // we building raw data
    $codeContents = " \nNumero:".$num_fact."\ndoSsier:".$num_dossier."\nM:".$montant_base."\AKIWACU";
	$tab=explode("/",$num_fact);
	$chemin=$num_fact.'--'.$num_dossier;
	
    $ficher="".$chemin.".png";
	
    // generating
    QRcode::png($codeContents, $tempDir."".$ficher, QR_ECLEVEL_L, 3);
   
    // displaying
   // echo '<div id="blockQrcode"><img src="'.$tempDir.''.$ficher.'" /></div>'; 
 
	 echo '<img style="margin-top:50px; margin-left:400px" src="qrcode/'.$ficher.'"/>';

?>

</div>

</page>
<?php
$content=ob_get_clean();
  require("../html2pdf/html2pdf.class.php");
try{ $pdf= new HTML2PDF('p','A5','fr');
    $pdf->writeHTML($content);
    $pdf->output('test.pdf');

}catch(HTML2PDF_exception $e){
    die($e);
}?>