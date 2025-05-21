<?php

include('first.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i> Liste des frais de Dossiers </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                        <?php if($lvl != 15){ ?>
                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="<?=$etude_dossier['option1_link']?>">
                                        <i class="fas fa-plus-circle"></i>
                                        Nouvelle étude
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
                                    <th>Ref_etude_dossier</th>
                                    <th>Caisse</th> 
                                    <th>Bénéficiaire</th>
                                    <th>Responsable</th>
                                    <th>Solde</th>
                                    <?php if($lvl >10) {?><th>Auteur</th><?php }?>
                                    <th>Date</th>
                                    <th>PDF</th>
                                    <th class="text-right"><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php

                                // if($lvl != 1){
                                // $query = "SELECT * from droit_etu_dos where open_close!='1'  order by date_dos,ref_post_dos asc";
                                // }else{
                                //     $query = "SELECT * from droit_etu_dos where id_perso = $id_perso and open_close!='1'  order by date_dos,ref_post_dos asc";
                                // }
                                $query = "SELECT * from droit_etu_dos where open_close!='1'  order by date_dos,ref_post_dos asc";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_etu_dos = $row['id_etu_dos'];
                                    $ref_post_dos = $row['ref_post_dos'];
                                    $id_caisse = $row['id_caisse'];
                                    $id_post = $row['id_post'];
                                    $id_perso = $row['id_perso'];
                                    $date_dos = $row['date_dos'];
                                    $montant = $row['montant'];
                                    $auteur = $row['auteur'];

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

                                        $sql = "SELECT * from mytable where id_ingenieur = '$id_post'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                                                }

                                    ?>

                                <tr>
                                    <td><a href="#"><?=$ref_post_dos?></a></td>
                                    <td><a href="#"><?=$caisse?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom_ing?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$montant?></a></td>
                                    <td><a href="#"><?= number_format($montant)?></a></td>
                                    <?php if($lvl >10) {?><td><?=$auteur?></td><?php }?>
                                    <td><a href="#"><?=$date_dos?></a></td>
                                    <td align="center"><a href="#" target="_blank">
                                            <i class='fa fa-print'></i>
                                        </a></td>
                                    <td class="text-right">
                                        <?php if($lvl > 12 && $lvl != 15){ ?>
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