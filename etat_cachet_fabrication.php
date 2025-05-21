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
header('Content-type: text/html; charset=utf-8');
$filename = "etat_cachet_fabrication".$heure.".xls";
header("Content-Disposition:attachment;filename = \"$filename\" ");

?>

<table class="table table-bordered"  border="1">
    <thead>
    <tr class="bg-primary">
        <th><p align="center" style="color: black">Matricule </p></th>
        <th><p align="center" style="color: black">Membre</p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Téléphone');?></p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'N°Recu');?></p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Ville');?></p></th>
        <th><p align="center" style="color: black">Statut</p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Année');?></p></th>
    </tr>
    </thead>
    <tbody>
    <?php

    $rsc1="N/A";
    $rsc2="N/A";
    $year = (new DateTime())->format("Y");


    $query = "SELECT * from demande_cachet where statut='2' and date_cachet LIKE '$year%' order by date_cachet asc";
    $q = $db->query($query);
    while ($row = $q->fetch()) {
        $id_cachet = $row['id_cachet'];
            $matricule = $row['matricule'];
            $id_ingenieur = $row['id_ingenieur'];
            $tel = $row['tel'];
            $recu = $row['recu'];
            $ville = $row['ville'];
            $statut = $row['statut'];
            $tel = $row['tel'];
            $date_cachet = $row['date_cachet'];
            //$date=date("Y", $date_cachet);


            $sql = "SELECT nom_ing, prenom_ing from mytable where id_ingenieur = '$id_ingenieur'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                    {
                                        $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                    }
             $sql = "SELECT DISTINCT nom from statut_cachet where id_statut = '$statut'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                    {
                                        $nom=$table['nom'];
                                    }

        ?>


        <tr align="center">
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $matricule);?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $nom_ing);?></td>
            <td><?= $tel?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $recu);?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $ville);?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $nom);?></td>
            <td><?=$date_cachet?></td>

        </tr>
    <?php } ?>

    </tbody>
</table>



