<?php

include('first.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i> Liste  des demandes d'attestations à usage personnel </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                        <?php if($lvl == 13 || $lvl == 11 || $lvl == 20 || $lvl == 19 ){ ?>
                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="<?=$demande_particulier['option1_link']?>">
                                        <i class="fas fa-plus-circle"></i>
                                        Nouvelle demande 
                                    </a>
                                </li>
                            </ul>
                        </b>
                        <?php } ?>
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
                                    <th>Ref_DP</th>
                                    <!--<th>Caisse</th> -->
                                    <th>Date</th>
                                    <th>Matricule</th>
                                    <th>Membre</th>
                                     <!--<th>Responsable</th>-->
                                    <!--<th>Droit</th>-->
                                    <th>Statut</th>
                                   <th>PDF</th>
                                   <?php if($lvl >10) {?><th>Auteur</th><?php }?>
                                    <!--  <th class="text-right"><i class="fas fa-bars"></i></th> -->
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $year = (new DateTime())->format("Y");
                                    if($lvl==1){
                                        $query = "SELECT * from demande_particulier where id_ing='$id_perso' and date_dem_part LIKE '$year%'   order by date_dem_part asc";
                                    }else{
                                        $query = "SELECT * from demande_particulier where date_dem_part LIKE '$year%'   order by date_dem_part asc";
                                    }

                                
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_dem_part = $row['id_dem_part'];
                                    $ref_dem_part = $row['ref_dem_part'];
                                    $id_caisse = $row['id_caisse'];
                                    $id_ing = $row['id_ing'];
                                     $droit = $row['droit'];
                                    $statut = $row['statut'];
                                    $date_dem_part = $row['date_dem_part'];
                                    $id_person = $row['id_auteur'];
                                    // $auteur = $row['auteur'];

                                    
                                    $nom='N/A';

                                        

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

                                        // $sql="SELECT YEAR('$date_dem_part') as total  ";
                                        //                         $stmt = $db->prepare($sql);
                                        //                         $stmt->execute();

                                        //                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        //                         foreach($tables as $table)
                                        //                             {
                                        //                                 $annee=$table['total'];
                                        //                             }

                                    ?>

                                <tr>
                                    <td><a href="#"><?=$ref_dem_part?></a></td>
                                    <!--<td><a href="#"><?php // echo $caisse?></a></td>-->
                                    <td><a href="#"><?=$date_dem_part?></a></td>
                                    <td><a href="#"><?=$matricule?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom_ing?></a></td>
                                    <!--<td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"-->
                                    <!--         class="rounded-circle m-r-5"-->
                                    <!--         alt=""><?php // echo $nom?></a></td>-->
                                    <!--<td><a href="#"><?= $droit?></a></td>-->
                                    <td>
                                        <?php if($lvl != 12){ ?>
                                         <?php if($lvl != 10 && $lvl !=1 && $lvl !=14 && $lvl != 15){ ?>
                                        <a href="modifier_statut_demande_part.php?id=<?=$id_dem_part?>"><?=$statut?></a>
                                        <?php }else{ ?>
                                        <?=$statut?>
                                        <?php } ?>
                                        <?php } ?>
                                        </td>
                                     <td align="center"><a href="attestation_part.php?id=<?=$id_dem_part?>" target="_blank">
                                            <i class='fa fa-print'></i>
                                        </a></td>
                                        <?php if($lvl >10) {?><td><?=$nom?></td><?php }?>
                                  <!--  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fas fa-random"></i>
                                                    Transférer</a>
                                                <a class="dropdown-item" href="edit-patient.html"><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td> -->
                                </tr>
                                <?php } ?>
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