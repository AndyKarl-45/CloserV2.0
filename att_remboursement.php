<?php
require('fpdf/fpdf.php');
include('phpqrcode/qrlib.php');

// Infos de connection à la BD
try{
   $db = new PDO('mysql:host=localhost;dbname=closer_onigc_syges;charset=utf8', 'closer_onigc_syges_root', 'j,jjkp{.RE${');

}catch(PDOException $e){
    die('Erreur: '.$e->getMessage());
}

function dateToFrench($date, $format)
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}

class PDF extends FPDF
{
    // Page header
//    function Header()
//    {
//        // GFG logo image
//        $this->Image('Picture1.png', 10, 6, 40, 40);
//
//        // Set font-family and font-size
//        $this->SetFont('Times','B',20);
//
//        // Move to the right
//        $this->Cell(20);
//
//        // Set the title of pages.
//        $this->Cell(30, 20, ' ', 0, 2, 'C');
//
//        // Break line with given space
//        $this->Ln(5);
//    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);

        // Set font-family and font-size of footer.
        $this->SetFont('Arial', 'I', 8);

        // set page number
        //$this->Cell(0, 10, 'Page ' . $this->PageNo() .
          //  '/{nb}', 0, 0, 'C');
    }
    
    function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0)
{
    // resize font
    $subFontSizeold = $this->FontSizePt;
    $this->SetFontSize($subFontSize);
    
    // reposition y
    $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
    $subX        = $this->x;
    $subY        = $this->y;
    $this->SetXY($subX, $subY - $subOffset);

    //Output text
    $this->Write($h, $txt, $link);

    // restore y position
    $subX        = $this->x;
    $subY        = $this->y;
    $this->SetXY($subX,  $subY + $subOffset);

    // restore font size
    $this->SetFontSize($subFontSizeold);
}
}

// Script SQL pour charger les données de ta tables.
if(isset($_GET['id'])!=""){
  $id_rem = $_GET['id'];
}else{

    ?>
                                        <script>
                                            alert('INCORRECT.');
                                                  window.location.href='<?=$demande_entreprise['option1_link']?>';
                                        </script>
                                        <?php

}


$id_entreprise = 1;

$query = "SELECT * from remboursement where id_rem='$id_rem'";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_rem = $row['id_rem'];
    $id_ing = $row['id_ing'];
    $montant = $row['montant'];
    $etat = $row['etat'];
    $ref_paie = $row['ref_paie'];
    $ope = $row['ope'];
    $ref_dem_rem = $row['ref_dem_rem'];
    $date_dem_rem = $row['date_dem_rem'];
    $date_val_rem = $row['date_val_rem'];
    $id_perso = $row['id_perso'];
    //---caractère
    // $nub_char=strlen($objet);
    // $ligne=$nub_char/45;
    // $objets=chunk_split($objet,51,"\r\n");
    // $objets_f=explode("\r\n", $objets);
    //---
    // $droit = $row['droit'];
    // $statut = $row['statut'];
    // $date_dem_ent = $row['date_dem_ent'];
    // $id_perso = $row['id_perso'];
    // $etat_payer = $row['etat'];

    $nom_en = 'N/A';
    $nom = 'N/A';

    $sql = "SELECT * from mytable where id_ingenieur = '$id_ing'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($tables as $table)
    {
        $nom_ing=strtoupper($table['nom_ing']);
        $nom_ing=ucwords($nom_ing);
        $matricule = $table['matricule'];
        $num_ordre = $table['num_ordre'];
        $tel_ing = $table['tel_ing'];
        $annee = $table['annee'];
        $tail_nom=strlen($nom_ing);
    }

    // $sql = "SELECT * from caisse where id_caisse = '$id_caisse'";

    // $stmt = $db->prepare($sql);
    // $stmt->execute();

    // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // foreach ($tables as $table) {
    //     $caisse = $table['caisse'];
    // }

 
    $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $nom = strtoupper($table['nom']) . ' ' . strtolower($table['prenom']);
        $nom=ucwords($nom);
          $tail_nom_pers=strlen($nom);
    }

    // $sql = "SELECT YEAR('$date_dem_ent') as total  ";
    // $stmt = $db->prepare($sql);
    // $stmt->execute();

    // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // foreach ($tables as $table) {
    //     $annee = $table['total'];
    // }

}
// $date=dateToFrench($date_dem_rem, "d F Y");
// $tailles=strlen($date);
    $tempDir = 'filesRem/';
    $liens='http://closer.cm/attestation_remboursement.php?id='.$id_rem;
$codeContents = 'N° d\'attesation: '.$ref_dem_rem."\n".'Nom de l’ingénieur: '.$nom_ing."\n".' Tableau de l’Ordre pour l’année: '.$annee."\n".' Matricule: '.$matricule."\n".' Fait à Yaoundé: '.dateToFrench($date_dem_rem, "j F Y")."\n".'lien de l\'attestation d\'entreprise :'.$liens;

$fileName = 'qrcode_rem_'.$id_ing.'.png';

$pngAbsoluteFilePath = $tempDir.$fileName;
$urlRelativeFilePath = 'filesRem/'.$fileName;

QRcode::png($codeContents, $pngAbsoluteFilePath); 


// Create new object.
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();

$pdf->AddFont('CalistoMT','','CALIST.php');
$pdf->AddFont('CalisMTBol','','CALISTB.php');
$pdf->AddFont('CalistoMT-BoldItalic','','CALISTBI.php');
$pdf->AddFont('CenturyGothic','','07558_CenturyGothic.php');
$pdf->AddFont('CenturyGothic-Bold','','07723_Cgothicb0.php');
$pdf->AddFont('CenturyGothic-Italic','','07557_CenturyGothicKursiv.php');
$pdf->AddFont('CenturyGothic-BoldItalic','','07724_CGOTHICBI.php');
$pdf->AddFont('Candara','','Candara.php');

$pdf->AddFont('Candara-Italic','','Candara_Italic (1).php');
$pdf->AddFont('Candara-BoldItalic','','Candara_Bold_Italic.php');

$pdf->AddFont('Candara-Bold','','Candara_Bold.php');


// Add new pages
$pdf->AddPage('P');

//set font to arial, bold, 14pt
$pdf->SetFont('CalisMTBol','',9);
//header
$pdf->Text(20,10,iconv('UTF-8', 'windows-1252', 'République du Cameroun'));
$pdf->Image('logos.png', 85,5,60, 40);
$pdf->Text(155,10,'Republic of Cameroon');

$pdf->SetFont('CalistoMT','',7);
$pdf->Text(27,13,'Paix - Travail - Patrie');
$pdf->Text(158,13,'Peace - Work - Fatherland');

$pdf->SetFont('CenturyGothic-Bold','',16);
$pdf->Text(20,25,'Ordre National des');
$pdf->Text(12,31,iconv('UTF-8', 'windows-1252', 'Ingénieurs de Génie Civil'));

$pdf->Text(150,25,'National Order of');
$pdf->Text(153,31,'Civil Engineers');


//set font to arial, bold, 14pt
$pdf->SetFont('CenturyGothic-Bold','',10);
// $pdf->Text(75,48,'Conseil de l\'Ordre - Council of the Order');
$pdf->Line(20, 50,190,50);

// $pdf->SetFont('Candara-Bold','',12);
// $pdf->Text(130,60,iconv('UTF-8', 'windows-1252', $ref_dem_rem));

$pdf->SetFont('CenturyGothic-Bold','',22);
$pdf->Text(65,65,'DEMANDE D\'ACTIVATION');

$dateday=date('Y-m-d');
$pdf->SetFont('CenturyGothic-Bold','',12);
$pdf->Text(20,75,iconv('UTF-8', 'windows-1252', 'Le '.dateToFrench($dateday, "j F Y")));

$pdf->SetFont('Candara','',16);
$pdf->Text(20,95,'Madame, Monsieur,');

$pdf->SetFont('Candara','',16);
$pdf->Text(20,105,iconv('UTF-8', 'windows-1252', 'Par     la     présente,      je      me     permets     de     vous     faire     la '));
$pdf->Text(20,113,iconv('UTF-8', 'windows-1252', 'demande      d\'activer      l\'attestation      avec      Les      références    de '));
$pdf->Text(20,121,iconv('UTF-8', 'windows-1252', 'paiement  suivantes : '));


$pdf->SetFont('Candara-Bold','',16);
$pdf->Text(20,132,iconv('UTF-8', 'windows-1252', 'Nom: '.iconv('UTF-8', 'windows-1252', $nom_ing)));
$pdf->Text(20,140,iconv('UTF-8', 'windows-1252', 'Matricule: '.iconv('UTF-8', 'windows-1252', $matricule)));
$pdf->Text(20,148,iconv('UTF-8', 'windows-1252', 'Reference de paiement: '.iconv('UTF-8', 'windows-1252', $ref_paie)));
$pdf->Text(20,157,iconv('UTF-8', 'windows-1252', 'Reference attestation: '.iconv('UTF-8', 'windows-1252', $ref_dem_rem)));


// $pdf->SetFont('Candara','',16);
// $pdf->Text(20,169,iconv('UTF-8', 'windows-1252', 'Le montant   du   remboursement   que  sollicite  aujourd’hui   s’élève   à '));
// $pdf->Text(20,177,iconv('UTF-8', 'windows-1252', '1000    FCFA.     Je     vous     prie     de    bien    vouloir     procéder     à    ce  '));
// $pdf->Text(20,185,iconv('UTF-8', 'windows-1252', 'remboursement  dans  les  plus  brefs  délais. '));



$pdf->SetFont('Candara','',16);
$pdf->Text(20,169,iconv('UTF-8', 'windows-1252', 'Je    vous   remercie    pour    l’attention    que    vous    porterez     à    ma '));
$pdf->Text(20,177,iconv('UTF-8', 'windows-1252', 'demande.     Veillez     agréer,    Madame,    Monsieur,    l’expression    de '));
$pdf->Text(20,185,iconv('UTF-8', 'windows-1252', 'mes  salutations  distinguées.'));

$pdf->SetFont('Candara-Bold','',14);
$pdf->Text(20+((60-$tail_nom)/2),200,iconv('UTF-8', 'windows-1252', $nom_ing));
// $pdf->Image('filesEnt/qrcode_ent_'.$id_ingenieur.'.png', 38,230,25,25);

$pdf->SetFont('Candara-Bold','',14);
$pdf->Text(115+$tail_nom_pers,200,iconv('UTF-8', 'windows-1252', $nom));

// $pdf->SetLineWidth(.5);
// $pdf->Line(115, 221, 164, 221);
// $pdf->Image('img/cachet onigc.png', 115, 223, 50, 45);




// $pdf->SetFont('Candara','',10);
// $pdf->Text(20,259,iconv('UTF-8', 'windows-1252', 'Ce document est généré par     CLOSER.'));
// $pdf->SetXY(62.5,256);
// $pdf->subWrite(3,'(c)','',6,5);
// $pdf->Text(20,264,iconv('UTF-8', 'windows-1252', 'Le QR-CODE atteste de son authenticité'));
// //$pdf->Text(20,265,iconv('UTF-8', 'windows-1252', 'NB : Seul l\'original du présent document est valable.'));
$pdf->SetLineWidth(.1);
$pdf->Line(20, 270,190,270);

$pdf->SetFont('CenturyGothic-BoldItalic','',8);
$pdf->SetTextColor(54 , 95, 145);
$str = 'Montée Elig Essono - Yaoundé -      20822 -    (+237) 677.66.10.66 / 655.01.02.03 -    noceonigc@yahoo.fr -    www.onigc.cm';
$str = iconv('UTF-8', 'windows-1252', $str);
$pdf->Text(20,275,$str);
$pdf->Image('img/enveloppe.png', 64,272.5,3, 3);
$pdf->Image('img/old-typical-phone.png', 78,272.5,3, 3);
$pdf->Image('img/mouse.png', 128,272.5,3, 3);
$pdf->Image('img/laptop.png', 162,272.5,3, 3);

$pdf->SetFont('CenturyGothic-Italic','',7);
$pdf->SetTextColor(0 , 0, 0);
$str = 'Comptes  bancaires : BICEC Yaoundé – Vallée sous le N° 31615665001-03 / ECOBANK Yaoundé - Hippodrome sous le N° 01316146701-72';
$str = iconv('UTF-8', 'windows-1252', $str);
$pdf->Text(20,280,$str);

//Cell(width , height , text , border , end line , [align] )

//Splitter
$pdf->Cell(10,36,'',0);

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',7);



$pdf->Output();

/*---------------------*/

// $pdf->SetFont('Candara-Bold','',16);
// $pdf->setFillColor(230,230,230);
// //$pdf->Text(85,133,'xxx');
// $pdf -> SetXY(83,120.5);
// $pdf->Cell($tail_nom*3,6,iconv('UTF-8', 'windows-1252', $nom_ing),0,1,'L',1);



// $pdf->SetFont('Candara','',16);
// $pdf->Text(38,133,iconv('UTF-8', 'windows-1252', 'est bien inscrit au Tableau de l’Ordre pour l’année '.$annee));
// $pdf->Text(69,141,'sous le matricule');
// $pdf->SetFont('Candara-Bold','',16);
// $pdf -> SetXY(113,136.5);
// $pdf->Cell(30,6,$matricule,0,1,'L',1);

//$pdf->Text(115,156,'XXXX');

// $pdf->SetFont('Candara','',14);
// $pdf->Text(53,155,iconv('UTF-8', 'windows-1252', 'A ce titre, il est autorisé à exercer la profession '));
// $pdf->Text(52,162,iconv('UTF-8', 'windows-1252', 'd’Ingénieur de Génie Civil pour la période allant'));
// $pdf->Text(57.5,169,'du 1    janvier '.$annee.' au 31 decembre '.$annee);
// $pdf->SetXY(65,167);
// $pdf->subWrite(5,'er','',10,10);
// $pdf->Text(57.5,176,iconv('UTF-8', 'windows-1252', 'et à faire prévaloir la présente attestation'));

// $pdf->Text(77,183,iconv('UTF-8','windows-1252', 'demandée par '));
// $pdf->SetTextColor(0 , 112, 192);
// $pdf->SetFont('Candara-Bold','',14);
// $pdf->Text(110,183,iconv('UTF-8', 'windows-1252',$nom_en_maj));
// $pdf->SetFont('Candara','',14);
// $pdf->SetTextColor(0 , 0, 0);
// $pdf->Text(43,190,iconv('UTF-8', 'windows-1252','pour'));

// $plus=0;
// for($i=0; $i<$ligne; $i++){
//     if($ligne<5){
// $pdf->SetTextColor(0 , 112, 192);
// $pdf->SetFont('Candara-Bold','',14);
// $pdf->Text(56,190+$plus,iconv('UTF-8', 'windows-1252', strtoupper($objets_f[$i])));
// $plus+=5;
// $autres=2*$ligne;
//     }
// }

// $pdf->SetTextColor(0 , 112, 192);
// $pdf->SetFont('Candara-Bold','',14);
// $pdf->Text(59,190,iconv('UTF-8', 'windows-1252',strtoupper($objet)));

// $pdf->SetTextColor(0 , 0, 0);
// $pdf->SetFont('Candara','',14);
// $pdf->Text(26,203+$autres,iconv('UTF-8', 'windows-1252', 'Fait à Yaoundé, le '));
// $pdf->SetFont('Candara-Bold','',14);
// $pdf->SetTextColor(0 , 112, 192);
// $pdf->Text(67,203+$autres,iconv('UTF-8', 'windows-1252', $date));

// $pdf->SetFont('Candara','',14);

// $pdf->SetTextColor(0 , 0, 0);
// $pdf->Text(67+($tailles*2.7),203+$autres,' pour servir et valoir ce que de droit.');

/*---------------------*/
?>

