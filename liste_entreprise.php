<?php

include('first.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-building" style="color: silver"></i> Liste des Entreprises</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">


                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="<?=$entreprise['option1_link']?>">
                                        <i class="fas fa-plus-circle"></i>
                                        Nouvelle entreprise
                                    </a>
                                </li>
                            </ul>
                            <?php  if($lvl !=1 ){ ?>
                            <ul class="nav nav-pills"   style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="etat_liste_entreprise.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"></i> liste entreprise
                                    </a>
                                </li>
                            </ul>
                            <?php }?>
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
                                <tr align="center" style="background-color: #dde9dd">
                                     <th>Entreprises</th>
                                    <th>Type </th>
                                    <th>Tel </th>
                                    <th>NUI </th>
                                    <th>Localisation </th>
                                    <th>Point Focal</th>
                                    <th>Contact</th>
                                    <?php if($lvl >10) {?><th>Auteur</th><?php }?>
                                    <th ><i class="fas fa-bars"></i></th>
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
                                        $auteur = $row['auteur'];


                                    ?>
                                    <tr align="center">
                                      <td><a href="#"><?= $nom_en ?></a></td>
                                    <td><a href="#"><?= $type_en ?></a></td>
                                    <td><a href="#"><?= $tel_en ?></a></td>
                                    <td><a href="#"><?= $nui ?></a></td>
                                    <td><a href="#"><?= $localisation ?></a></td>
                                    <td><a href="#"><?= $pers_en ?></a></td>
                                    <td><a href="#"><?= $contact_en ?></a></td>
                                     <?php if($lvl >10) {?><td><?=$auteur?></td><?php }?>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if($lvl > 1 && $lvl != 13){ ?>
                                                    <a class="dropdown-item" href="modifier_entreprise.php?id=<?=$id_entreprise?>"><i
                                                                class="fas fa-pen"></i> Modifier</a>
                                                                
                                                                 <a class="dropdown-item" href="delete_entreprise.php?id=<?=$id_entreprise?>"><i
                                                                class="fas fa-trash"></i> Supprimer</a>
                                                        <?php } ?>
                                                </div>
                                            </div>
                                        
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
                    title: 'Oops...',
                    text: 'Une erreur s\'est produite !',
                    footer: 'Reéssayez encore'
                })
            </script>
            <?php
            break;
        case '-2';
            ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Oops...',
                    text: 'NUI existe déja dans les systèmes !',
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