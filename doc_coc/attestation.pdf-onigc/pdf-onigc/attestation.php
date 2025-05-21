<?php
require('fpdf/fpdf.php');

// Infos de connection à la BD
try{
    $db = new PDO('mysql:host=localhost;dbname=apfood_onig_syges;charset=utf8', 'root', '');

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
        $this->Cell(0, 10, 'Page ' . $this->PageNo() .
            '/{nb}', 0, 0, 'C');
    }
}

// Script SQL pour charger les données de ta tables.
//if(isset($_GET['id'])!=""){
//   $id_entreprise = $_GET['id'];
//}

$id_entreprise = 1;

$query = "SELECT * from demande_entreprise  order by date_dem_ent asc";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_dem_ent = $row['id_dem_ent'];
    $ref_dem_ent = $row['ref_dem_ent'];
    $id_caisse = $row['id_caisse'];
    $id_ing = $row['id_ing'];
    $id_entreprise = $row['id_entreprise'];
    $objet = $row['objet'];
    $droit = $row['droit'];
    $statut = $row['statut'];
    $date_dem_ent = $row['date_dem_ent'];
    $id_perso = $row['id_perso'];

    $nom_en = 'N/A';
    $nom = 'N/A';

    $sql = "SELECT * from entreprise where id_entreprise = '$id_entreprise'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $nom_en = $table['nom_en'];
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


// Create new object.
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();

// Add new pages
$pdf->AddPage('P');

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',9);
//header
$pdf->Text(20,10,iconv('UTF-8', 'windows-1252', 'République du Cameroun'));
$pdf->Image('Picture1.png', 83,5,50, 40);
$pdf->Text(155,10,'Republic of Cameroon');

$pdf->SetFont('Times','B',7);
$pdf->Text(27,13,'Paix - Travail - Patrie');
$pdf->Text(158,13,'Peace - Work - Fatherland');

$pdf->SetFont('Times','B',16);
$pdf->Text(20,25,'Ordre National des');
$pdf->Text(12,31,iconv('UTF-8', 'windows-1252', 'Ingénieurs de Génie Civil'));

$pdf->Text(150,25,'National Order of');
$pdf->Text(153,31,'Civil Engineers');


//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',10);
$pdf->Text(75,48,'Conseil de l\'Ordre - Council of the Order');
$pdf->Line(20, 50,190,50);

$pdf->SetFont('Arial','B',12);
$pdf->Text(130,60,iconv('UTF-8', 'windows-1252', $ref_dem_ent));

$pdf->SetFont('Arial','BU',28);
$pdf->Text(80,85,'Attestation');


$pdf->SetFont('Arial','B',18);
$pdf->Text(70,100,iconv('UTF-8', 'windows-1252', 'Le Président de l’Ordre'));

$pdf->SetFont('Arial','B',16);
$pdf->Text(90,123,'atteste que');

$pdf->SetFont('Arial','',16);
$pdf->Text(55,133,iconv('UTF-8', 'windows-1252', 'l’Ingénieur'));
$pdf->SetFont('Arial','B',16);
$pdf->setFillColor(230,230,230);
//$pdf->Text(85,133,'xxx');
$pdf -> SetXY(83,128.5);
$pdf->Cell(0,6,iconv('UTF-8', 'windows-1252', $nom_ing),0,1,'L',1);



$pdf->SetFont('Arial','',16);
$pdf->Text(35,149,iconv('UTF-8', 'windows-1252', 'est bien inscrit au Tableau de l’Ordre pour l’année '.$annee));
$pdf->Text(70,156,'sous le matricule');
$pdf->SetFont('Arial','B',16);
$pdf -> SetXY(114,151.5);
$pdf->Cell(30,6,$matricule,0,1,'L',1);
//$pdf->Text(115,156,'XXXX');

$pdf->SetFont('Arial','',14);
$pdf->Text(40,163,iconv('UTF-8', 'windows-1252', 'à ce titre, il est autorisé à exercer la profession d’Ingénieur'));
$pdf->Text(60,169,iconv('UTF-8', 'windows-1252', 'de Génie Civil pour la période allant'));
$pdf->Text(55,176,'du 1er janvier '.$annee.' au 31 decembre '.$annee);
$pdf->Text(45,183,iconv('UTF-8', 'windows-1252', 'et à faire prévaloir la présente attestation dans le cadre'));

$pdf->SetTextColor(0 , 112, 192);
$pdf->Text(80,190,'d\'un usage personnel');

$pdf->SetTextColor(0 , 0, 0);
$pdf->Text(23,200,iconv('UTF-8', 'windows-1252', 'Fait à Yaoundé, le '));
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0 , 112, 192);
$pdf->Text(64,200,iconv('UTF-8', 'windows-1252', dateToFrench($date_dem_ent, "j F Y")));

$pdf->SetFont('Arial','',14);

$pdf->SetTextColor(0 , 0, 0);
$pdf->Text(108,200,'pour servir et valoir ce que de droit./-');

$pdf->SetFont('Arial','B',14);
$pdf->Text(115,215,iconv('UTF-8', 'windows-1252', 'P. le Président de l\'Ordre,'));

$pdf->SetFont('Arial','BU',14);
$pdf->Text(120,220,iconv('UTF-8', 'windows-1252', 'Le Sécretaire Général'));


$pdf->SetFont('Arial','I',10);
$pdf->Text(20,265,iconv('UTF-8', 'windows-1252', 'NB : Seul l\'original du présent document est valable.'));
$pdf->Line(20, 270,190,270);

$pdf->SetFont('Arial','I',8);
$pdf->SetTextColor(54 , 95, 145);
$str = 'Montée Elig Essono -Yaoundé- BP: 20822 – Tel: (+237)2221.42.58- 7766.10.66  - Email: noceonigc@yahoo.fr - Site Web: www.onigc.cm';
$str = iconv('UTF-8', 'windows-1252', $str);
$pdf->Text(20,275,$str);

$pdf->SetFont('Arial','I',7);
$pdf->SetTextColor(0 , 0, 0);
$str = 'Comptes bancairesBICEC-Ydé –Vallée sous le N° 31615665001-03 / ECO BANK Ydé-Hippodrome 01316146701-72';
$str = iconv('UTF-8', 'windows-1252', $str);
$pdf->Text(35,280,$str);

//Cell(width , height , text , border , end line , [align] )

//Splitter
$pdf->Cell(10,36,'',0);

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',7);



$pdf->Output();

?>

