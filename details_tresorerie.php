<?php

include('first.php');
include('php/main_side_navbar.php');

?>
<?php
$id_caisse=$_REQUEST['id'];
?>
    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i> Details_caisses: </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme , il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                        <b>
                            <!-- Nav pills -->
                           
                        </b>
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
                                    <!--<th>Réference</th>-->
                                    <th>Entitée</th>                                    
                                    <th>Entre</th>
                                    <th>Sortie</th>
                                    <th>Date</th>
                                    <th>type</th>
                                    <th class="text-right"><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php

                                $query = "SELECT * from historique_caisse where id_caisse='$id_caisse'  order by id_hist_caisse desc";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_hist_caisse = $row['id_hist_caisse'];
                                    $ref_caisse = $row['ref_caisse'];
                                    $id_caisse = $row['id_caisse'];
                                    $id_beneficiaire = $row['id_beneficiaire'];
                                    $id_perso = $row['id_perso'];
                                    $statut = $row['statut'];
                                    $date_hist = $row['date_hist'];
                                    $montant_entre = $row['montant_entre'];
                                    $montant_sortie = $row['montant_sortie'];

                                        $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom=$table['nom'].' '.$table['prenom'];
                                                                }

                                        $sql = "SELECT * from caisse where id_caisse = '$id_caisse'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $caisse=$table['caisse'];
                                                                }
                                                                if(empty($ref_caisse)){$ref_caisse='N/A';}
                                                               $n=SUBSTR($ref_caisse,0,3);

                                                        if(($statut=='E' AND $n=='DA_') or ($statut=='E' AND $n=='DED') or ($statut=='E' AND $n=='REF') ){

                                                            $sql = "SELECT * from mytable where id_ingenieur = '$id_beneficiaire'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                  $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                                                }
                                                        }else{
                                                            
                                                            $sql = "SELECT * from mytable where id_ingenieur = '$id_beneficiaire'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                  $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                                                }
                                                                
                                                                if(empty($nom_ing)){
                                                                    
                                                            $sql = "SELECT * from caisse where id_caisse = '$id_beneficiaire'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom_ing=$table['caisse'];
                                                                }
                                                                }
                                                            


                                                        }

                                        

                                    ?>

                                <tr>
                                    <!--<td><a href="#"><?=$ref_caisse?></a></td>-->
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom_ing?></a></td>
                                   <td><a href="#"><?= number_format($montant_entre)?></a></td>
                                   <td><a href="#"><?= number_format($montant_sortie)?></a></td>
                                    <td><a href="#"><?=$date_hist?></a></td>
                                    <td><a href="#"><?=$statut?></a></td>
                                    
                                    <td class="text-right">
                                        <?php if($lvl > 12){ ?>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                
                                                <a class="dropdown-item" href="#"><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </td>
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