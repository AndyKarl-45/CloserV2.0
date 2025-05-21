<?php
include('php/dbconnect.php');
include('php/db.php');

// function dateToFrench($date, $format){
//     $english_days = array('Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday','Sunday');
//     $french_days = array('Lundi', 'Mardi', 'Mercredi', 'jeudi', 'Vendredi', 'Samedi', 'Dimanche');
//     $english_months = array('January', 'February', 'March','April','May', 'June','July','August', 'September','October', 'November', 'December');
//     $french_months = array('Janvier', 'Février', 'Mars','Avril','Mai', 'Juin','Juillet','Aout', 'Septembre','Octobre', 'Novembre', 'Décembre');
//     return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
// }
// function rav($base){

//     try{
//     $db = new PDO('mysql:host=localhost;dbname=apfood_syges_paie;charset=utf8', 'apfood_syges_paie_root', '5f3V+O)l?}E}');

// }catch(PDOException $e){
//     die('Erreur: '.$e->getMessage());
// }

//     $result =0;
//     $query = "SELECT * FROM rav";
//     $q = $db->query($query);
//     while($row = $q->fetch())
//     {
//         $tranche_min = $row['tranche_min'];
//         $tranche_max = $row['tranche_max'];
//         $redevance = $row['redevance'];

//         if($tranche_min < $base && $base < $tranche_max)
//             $result = $redevance;
//     }
//     return $result;
// }

// function tdl($base){
//     try{
//     $db = new PDO('mysql:host=localhost;dbname=apfood_syges_paie;charset=utf8', 'apfood_syges_paie_root', '5f3V+O)l?}E}');

// }catch(PDOException $e){
//     die('Erreur: '.$e->getMessage());
// }

//     $result =0;
//     $query = "SELECT * FROM tdl";
//     $q = $db->query($query);
//     while($row = $q->fetch())
//     {
//         $tranche_min = $row['tranche_min'];
//         $tranche_max = $row['tranche_max'];
//         $taxe_com = $row['taxe_com'];

//         if($tranche_min < $base && $base < $tranche_max)
//             $result = $taxe_com;
//     }
//     return $result;
// }

$heure = date("G_i");
header("Content-type: application/vnd-ms-excel");
$filename = "etat_liste_entreprise".$heure.".xls";
header("Content-Disposition:attachment;filename = \"$filename\" ");

?>

<table class="table table-bordered"  border="1">
    <thead>
    <tr class="bg-primary">
        <th>Entreprises</th>
        <th>Type </th>
        <th>Tel </th>
        <th>NUI </th>
        <th>Localisation </th>
        <th>Point Focal</th>
        <th>Contact</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $query = "SELECT * from entreprise where nom_en!='' and  open_close!=1 order by nom_en asc";
    $q = $db->query($query);
    while ($row = $q->fetch()) {
        $id_entreprise = $row['id_entreprise'];
            $nom_en = $row['nom_en'];
            $type_en = $row['type_en'];
            $pays_en = $row['pays_en'];;
            $ville_en = $row['ville_en'];;
            $tel_en = $row['tel_en'];
            $nui = $row['nui'];
            $localisation = $row['localisation'];
            $email_en = $row['email_en'];
            $pers_en = $row['pers_en'];
            $contact_en = $row['contact_en'];


        ?>


        <tr align="center">
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $nom_en);?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $type_en);?></td>
            <td><?= $tel_en?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $nui);?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $ville);?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $pers_en);?></td>
            <td><?=$contact_en?></td>

        </tr>
    <?php } ?>

    </tbody>
</table>



