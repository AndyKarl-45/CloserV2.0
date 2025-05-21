<?php
include('fpdf/fpdf.php');
include('phpqrcode/qrlib.php');
include('fpdf/rotation.php');

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

class PDF extends PDF_Rotate
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

function Header()
{
    //Put the watermark
    $this->SetFont('Arial','B',50);
    $this->SetTextColor(255,192,203);
    $this->RotatedText(55,190,'S P E C I M E N',45);
}

function RotatedText($x, $y, $txt, $angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}


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
  $id_dem_ent = $_GET['id'];
}else{

    ?>
                                        <script>
                                            alert('INCORRECT.');
                                                  window.location.href='<?=$demande_entreprise['option1_link']?>';
                                        </script>
                                        <?php

}


$id_entreprise = 1;

$query = "SELECT * from demande_entreprise where id_dem_ent='$id_dem_ent' ";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_dem_ent = $row['id_dem_ent'];
    $ref_dem_ent = $row['ref_dem_ent'];
    $id_caisse = $row['id_caisse'];
    $id_ing = $row['id_ing'];
    $id_entreprise = $row['id_entreprise'];
    $objet = $row['objet'];
    //---caractère
    $nub_char=strlen($objet);
    $ligne=intval(ceil($nub_char/56));
     $objets=chunk_split($objet,56,"\r\n");//51
    $objets_f=explode("\r\n", $objets);
    //---
    $droit = $row['droit'];
    $statut = $row['statut'];
    $date_dem_ent = $row['date_dem_ent'];
    $id_perso = $row['id_perso'];
    $etat_payer = 0;

    $nom_en = 'N/A';
    $nom = 'N/A';

    $sql = "SELECT *from entreprise where id_entreprise = '$id_entreprise'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $nom_en = $table['nom_en'];
        $nom_en_maj=strtoupper($nom_en); 

        
    }

    $sql = "SELECT * from caisse where id_caisse = '$id_caisse'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $caisse = $table['caisse'];
    }

    $sql = "SELECT * from mytable where id_ingenieur = '$id_ing'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $nom_ing = $table['nom_ing'] . ' ' . $table['prenom_ing'];
        $matricule = $table['matricule'];
        $id_ingenieur = $table['id_ingenieur'];
        $tail_nom=strlen($nom_ing);
    }
    $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $nom = $table['nom'] . ' ' . $table['prenom'];
    }

    $sql = "SELECT YEAR('$date_dem_ent') as total  ";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $annee = $table['total'];
    }

}
$date=dateToFrench($date_dem_ent, "d F Y");
$tailles=strlen($date);
    $tempDir = 'filesEnt/';
    $liens='http://closer.cm/attestation.php?id='.$id_dem_ent;
$codeContents = 'N° d\'attesation: '.$ref_dem_ent."\n".'Nom de l’ingénieur: '.$nom_ing."\n".' Tableau de l’Ordre pour l’année: '.$annee."\n".' Matricule: '.$matricule."\n".' Fait à Yaoundé: '.dateToFrench($date_dem_ent, "j F Y")."\n".'lien de l\'attestation d\'entreprise :'.$liens;

$fileName = 'qrcode_ent_'.$id_ingenieur.'.png';

$pngAbsoluteFilePath = $tempDir.$fileName;
$urlRelativeFilePath = 'filesEnt/'.$fileName;

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
$pdf->Image('logos.jpeg', 85,5,60, 40);
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
$pdf->Line(20, 50,190,50);

$pdf->SetFont('Candara-Bold','',12);
$pdf->Text(130,60,iconv('UTF-8', 'windows-1252', $ref_dem_ent));

$pdf->SetFont('CenturyGothic-Bold','',28);
if($etat_payer==1){
$pdf->Text(60,75,'A T T E S T A T I O N');
}else{
 $pdf->Text(45,70,'ATTESTATION PROVISOIRE');  
}

$pdf->SetFont('Candara-Bold','',18);
$pdf->Text(70,95,iconv('UTF-8', 'windows-1252', 'Le Président de l’Ordre'));

$pdf->SetFont('Candara','',16);
$pdf->Text(90,105,'atteste que');

$pdf->SetFont('Candara','',16);
$pdf->Text(55,115,iconv('UTF-8', 'windows-1252', 'l’Ingénieur'));
$pdf->SetFont('Candara-Bold','',16);
$pdf->setFillColor(230,230,230);
//$pdf->Text(85,133,'xxx');
$pdf -> SetXY(83,110.5);
$pdf->Cell($tail_nom*3,6,iconv('UTF-8', 'windows-1252', $nom_ing),0,1,'L',1);



$pdf->SetFont('Candara','',16);
$pdf->Text(38,123,iconv('UTF-8', 'windows-1252', 'est bien inscrit au Tableau de l’Ordre pour l’année '.$annee));
$pdf->Text(69,131,'sous le matricule');
$pdf->SetFont('Candara-Bold','',16);
$pdf -> SetXY(113,126.5);
$pdf->Cell(30,6,$matricule,0,1,'L',1);

//$pdf->Text(115,156,'XXXX');

$pdf->SetFont('Candara','',14);
$pdf->Text(59,145,iconv('UTF-8', 'windows-1252', 'A ce titre, il est autorisé à exercer la profession '));
$pdf->Text(58,152,iconv('UTF-8', 'windows-1252', 'd’Ingénieur de Génie Civil pour la période allant'));
$pdf->Text(63.5,159,iconv('UTF-8', 'windows-1252','du 1    janvier '.$annee.' au 31 décembre '.$annee));
$pdf->SetXY(71,157);
$pdf->subWrite(5,'er','',10,10);
$pdf->Text(60,166,iconv('UTF-8', 'windows-1252', 'et à faire prévaloir la présente attestation'));

$pdf->Text(43,173,iconv('UTF-8','windows-1252', 'demandée par '));
$pdf->SetTextColor(0 , 112, 182);
$pdf->SetFont('Candara-Bold','',12);
$pdf->Text(76,173,iconv('UTF-8', 'windows-1252',$nom_en_maj));
$pdf->SetFont('Candara','',14);
$pdf->SetTextColor(0 , 0, 0);
$pdf->Text(43,180,iconv('UTF-8', 'windows-1252','pour'));

$plus=0;
$minus=0;
$autres=0;
for($i=0; $i<$ligne; $i++){
    if($ligne<5){
        $pdf->SetTextColor(0 , 112, 182);
        $pdf->SetFont('Candara-Bold','',12);
        $pdf->Text(56-$minus,180+$plus,iconv('UTF-8', 'windows-1252', mb_strtoupper($objets_f[$i])));
        $plus+=5;
        $autres=2*$ligne;
        $minus=13;
    }
}
$autres ? $autres : 0;
// $pdf->SetTextColor(0 , 112, 192);
// $pdf->SetFont('Candara-Bold','',14);
// $pdf->Text(59,190,iconv('UTF-8', 'windows-1252',strtoupper($objet)));

$pdf->SetTextColor(0 , 0, 0);
$pdf->SetFont('Candara','',14);
$pdf->Text(26,193+$autres,iconv('UTF-8', 'windows-1252', 'Fait à Yaoundé, le '));
$pdf->SetFont('Candara-Bold','',14);
$pdf->SetTextColor(0 , 112, 182);
$pdf->Text(67,193+$autres,iconv('UTF-8', 'windows-1252', $date));

$pdf->SetFont('Candara','',14);

$pdf->SetTextColor(0 , 0, 0);
$pdf->Text(67+($tailles*2.7),193+$autres,' pour servir et valoir ce que de droit.');
if($etat_payer==1){
$pdf->Image('filesEnt/qrcode_ent_'.$id_ingenieur.'.png', 38,230,25,25);
}
$pdf->SetFont('Candara-Bold','',14);
$pdf->Text(125,220,iconv('UTF-8', 'windows-1252', 'Le Président de l\'Ordre'));
if($etat_payer==1){
$pdf->SetLineWidth(.5);
$pdf->Line(125, 221, 174, 221);
$pdf->Image('img/cachetOgnic2.png', 130, 228.5, 40, 35);
}



$pdf->SetFont('Candara','',10);
$pdf->Text(20,259,iconv('UTF-8', 'windows-1252', 'Ce document est généré par     CLOSER.'));
$pdf->SetXY(62.5,256);
$pdf->subWrite(3,'(c)','',6,5);
$pdf->Text(20,264,iconv('UTF-8', 'windows-1252', 'Le QR-CODE atteste de son authenticité'));
//$pdf->Text(20,265,iconv('UTF-8', 'windows-1252', 'NB : Seul l\'original du présent document est valable.'));
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

?>

