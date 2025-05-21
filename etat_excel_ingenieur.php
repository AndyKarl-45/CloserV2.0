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
$filename = "liste_ingenieurs_onig_".$heure.".xls";
header("Content-Disposition:attachment;filename = \"$filename\" ");

?>

<table class="table table-bordered"  border="1">
    <thead>
    <tr class="bg-primary">
        <th><p align="center" style="color: black">Matricule</p></th>
        <th><p align="center" style="color: black">Muméro ordre</p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Année');?></p></th>
        <th><p align="center" style="color: black">Nom</p></th>
        <th><p align="center" style="color: black">Phone</p></th>
        <th><p align="center" style="color: black">Email</p></th>
        <th><p align="center" style="color: black">Date Inscription</p></th>
    </tr>
    </thead>
    <tbody>
    <?php

   $query = "SELECT * from mytable where statut='N/A' ";
        
        $q = $db->query($query);
        while ($row = $q->fetch()) {
            $id_ingenieur = $row['id_ingenieur'];
            $matricule = $row['matricule'];
            $nom_ing = $row['nom_ing'];
            $prenom_ing = $row['prenom_ing'];
            $num_ordre = $row['num_ordre'];
            $tel_ing = $row['tel_ing'];
            $email_ing = $row['email_ing'];
            $date_inscription = $row['date_inscription'];
            $annee = $row['annee'];
            
            // $reste=0;
            
            // $sql = "SELECT DISTINCT somme, payer from dette where id_ing = '$id_ingenieur'";

            // $stmt = $db->prepare($sql);
            // $stmt->execute();

            // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // foreach($tables as $table)
            // {
            //     $somme=$table['somme'];
            //     $payer=$table['payer'];
            //     $reste=$somme-$payer;
            // }

        ?>


        <tr align="center">
            
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $matricule);?></td>
            <td >
                <?php  echo $num_ordre; ?>
            </td>
            <td >
                <?php  echo $annee; ?>
            </td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252',  $nom_ing.' '.$prenom_ing) ?></td>
            <td><?=$tel_ing?> </td>
            <td><?php echo $email_ing?></td>
            <td><?php echo $date_inscription?></td>
        </tr>
    <?php } ?>

    </tbody>
</table>



