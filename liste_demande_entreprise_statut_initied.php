<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');
include("api/Payment.php");


// $payment = new Payment();

// $sql="SELECT DISTINCT pay_token, transaction_id FROM payement_statut WHERE status <> 'SUCCESS' ";
// $stmt = $db->prepare($sql);
// $stmt->execute();

// $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     foreach($tables as $table)
//         {
//           $pay_token=$table['pay_token'];
//           $transaction_id=$table['transaction_id'];
//           $pay_checker = $payment->payState($pay_token);
            
//           if(strcmp($pay_checker->status,"INITIATED") !== 0 || strcmp($pay_checker->status,"PENDING") !== 0){
//             $query1 = "UPDATE payement_statut SET status = '$pay_checker->status' WHERE transaction_id = '$transaction_id'";
//             $sql1 = $db->prepare($query1);
//             $sql1->execute();
//           }
//     }
        
?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i> Liste  des demandes d'attestations pour le compte des entreprises </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>
                <!--                Main Body              -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Ref_DE</th>
                                    <!--<th>Caisse</th> -->
                                    <th>Date</th>
                                    <th>Matricule</th>
                                    <th>Nom ingénieur</th>
                                    <th>Entreprise</th>
                                     <!--<th>Responsable</th>-->
                                    <!--<th>Objet</th>-->
                                    <!--<th>Droit</th>-->
                                    <th>Statut</th>
                                     <th class="text-right"><i class="fas fa-bars"></i></th> 
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $year = (new DateTime())->format("Y");
                                    $sum=0;
                                if($lvl==1){
                                    $query = "SELECT * from demande_entreprise where id_ing='$id_perso' and open_close!=1 and date_dem_ent LIKE '$year%' order by date_dem_ent asc";
                                }else{
                                    $query = "SELECT * from demande_entreprise where   open_close!=1 and date_dem_ent LIKE '$year%'  order by date_dem_ent desc";
                                }
                                
                                
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
                                    $id_person = $row['id_perso'];
                                    $ref_dem_ent_cp = $row['ref_dem_ent_cp'];

                                    $nom_en='N/A';
                                    $nom='N/A';
                                    // $status='FAILED';
                                    
                                    if($ref_dem_ent_cp=='N/A'){}else{
                                     if(!empty($ref_dem_ent_cp)){
                                    $sql = "SELECT transaction_id FROM payement_init WHERE 	ref_ing_cost = '$ref_dem_ent_cp'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                 $transaction_id=$table['transaction_id'];
                                                                }
                                    
                                    $sql = "SELECT status FROM payement_statut WHERE transaction_id = '$transaction_id'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                  $status=$table['status'];
                                                            
                                                                }
                                    }
                                
                            // //   $dateNew = date_create_from_format("m-d-Y", "08-22-2022")->format("Y-m-d");
                                    
                                    
                            // //         $query = "SELECT round( DATEDIFF( :date_dem_ent, :dateNew)) as age";
                            // //         $sql = $db->prepare($query);
                            // //         $sql->bindParam(':date_dem_ent', $date_dem_ent);
                            // //         $sql->bindParam(':dateNew', $dateNew);
                            // //         $sql->execute();
                            // //         while ($row = $sql->fetch()) {
                            // //              $jours = $row["age"];
                                        
                            //         }
                                    

                                        $sql = "SELECT * from entreprise where id_entreprise = '$id_entreprise'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom_en=$table['nom_en'];
                                                                }

                                        $sql = "SELECT * from caisse where id_caisse = '$id_caisse'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $caisse=$table['caisse'];
                                                                }

                                        $sql = "SELECT * from mytable where id_ingenieur = '$id_ing'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                                                    $matricule=$table['matricule'];
                                                                }
                                        $sql = "SELECT * from personnel where id_personnel = '$id_person'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom=$table['nom'].' '.$table['prenom'];
                                                                }

                                        // $sql="SELECT YEAR('$date_dem_ent') as total  ";
                                        //                         $stmt = $db->prepare($sql);
                                        //                         $stmt->execute();

                                        //                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        //                         foreach($tables as $table)
                                        //                             {
                                        //                                 $annee=$table['total'];
                                        //                             }
                                                                    
                                        if(strcmp($status,"INITIATED") == 0){
                                          
                                           
                                    ?>

                                <tr>
                                    <td><a href="#"><?=$ref_dem_ent_cp?></a></td>
                                    <!--<td><a href="#"><?=$caisse?></a></td>-->
                                    <td><a href="#"><?=$date_dem_ent?></a></td>
                                    <td><a href="#"><?=$matricule?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom_ing?></a></td>
                                    <td><a href="#"><?=$nom_en?></a></td>
                                    <!--<td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"-->
                                    <!--         class="rounded-circle m-r-5"-->
                                    <!--         alt=""><?=$nom?></a></td>-->
                                    <!--<td><a href="#"><?=$objet?></a></td>-->
                                    <!--<td><a href="#"><?=$droit?></a></td>-->
                                    <td> <span class="custom-badge status-red"><?=$status?></span>
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-primary" href="valider_statut_initiated.php?id=<?=$ref_dem_ent_cp;?>" title="Valider"
                                            style="background-color: transparent" onclick="Supp(this.href); return(false);">
                                                <i style="color: green" class="fas fa-check"></i> 
                                        </a>
                                    </td> 
                                </tr>
                                <?php }
                                        
                                    } 
                                    
                                    
                                }
                                
                                    // $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
                                    // $sql1 = $db->prepare($query1);
                        
                                    //  // Bind parameters to statement
                                    // $sql1->bindParam(':payer', $sum);
                                    // $sql1->execute();
                        
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--                End Body              -->

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

            </div>
        </main>
    </div>
<script type="text/javascript">
   function Supp(link){
    if(confirm('Confirmer le changement de statut de l\'attestation ?')){
     document.location.href = link;
    }
   }
 </script>
<?php
if (isset($_GET['witness'])) {
    $witness = $_GET['witness'];

    switch ($witness) {
        case '1';
            ?>
            <script>
                Swal.fire(
                    'Succès',
                    'Opération effectuée avec succès !',
                    'success'
                )
            </script>
            <?php
            break;
        case '-1';
            ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Oops...', c
                    text: 'Une erreur s\'est produite !',
                    footer: 'Reéssayez encore'
                })
            </script>
            <?php
            break;

    }
}
?>


    <!--//Footer-->
<?php
include('foot.php');
?>