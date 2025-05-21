
<?php

include('first.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-building" style="color: silver"></i> Liste des Cachets</h1>
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
                                    <a class="btn btn-primary" href="<?=$demande_cachet['option1_link']?>">
                                        <i class="fas fa-plus-circle"></i>
                                        Nouveau cachet
                                    </a>
                                </li>
                            </ul>
                            <?php  if($lvl !=1 ){ ?>
                            <ul class="nav nav-pills"   style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="etat_cachet_livre.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"></i> Cachet Livré
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills"   style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="etat_cachet_disponible.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"></i> Cachet disponible
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills"   style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="etat_cachet_envoye.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"> </i> Demande envoyée
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills"   style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="etat_cachet_fabrication.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"></i> En cours de fabrication
                                    </a>
                                </li>
                            </ul>
                            <?php } ?>
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
                                     <th>Matricule</th>
                                    <th>Membre</th>
                                    <th>Tel </th>
                                    <th>N° Recue </th>
                                    <th>Ville </th>
                                    <th>Statut</th>
                                    <th>Année</th>
                                    <?php if($lvl >10) {?><th>Auteur</th><?php }?>
                                    <th ><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $year = (new DateTime())->format("Y");
                                if($lvl < 10){
                                    $query = "SELECT * from demande_cachet where id_ingenieur = $id_perso and date_cachet LIKE '$year%' order by date_cachet asc";
                                }else{
                                    $query = "SELECT * from demande_cachet where date_cachet LIKE '$year%' order by date_cachet asc";
                                }
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
                                        $auteur = $row['auteur'];
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
                                        <?php  
                                    if($lvl > 14 || $lvl == 11){
                                        ?>
                                      <td><a href="modifier_cachet.php?id=<?=$id_cachet?>" style="color: black"><?= $matricule ?></a></td>
                                    <td><a href="modifier_cachet.php?id=<?=$id_cachet?>" style="color: black"><?= $nom_ing ?></a></td>
                                    <td><a href="modifier_cachet.php?id=<?=$id_cachet?>" style="color: black"><?= $tel ?></a></td>
                                    <td><?= $recu ?></td>
                                    <td><?= $ville ?></td>
                                    <?php  
                                    }else{ ?>
                                     <td><?= $matricule ?></td>
                                    <td><?= $nom_ing ?></td>
                                    <td><?= $tel ?></td>
                                    <td><?= $recu ?></td>
                                    <td><?= $ville ?></td>
                                    <?php
                                    }?>
                                    
                                    <td style="width: 20%;"> <?php  
                                    if($lvl > 13 || $lvl == 11){
                                                     if($statut==1){
                                                         echo'
                                                            <a href="modifier_cachet.php?id='.$id_cachet.'" style=" width:200px;" class="btn btn-primary" >'.$nom.'</a>
                                                        ';
                                                     }elseif($statut==2){

                                                        echo'
                                                            <a href="modifier_cachet.php?id='.$id_cachet.'" style=" width:200px;" class="btn btn-warning" >'.$nom.'</a>
                                                        ';

                                                     }elseif($statut==3){

                                                        echo'
                                                            <a href="modifier_cachet.php?id='.$id_cachet.'" style=" width:200px;" class="btn btn-success" >'.$nom.'</a>
                                                        ';
                                                     }elseif($statut==4){

                                                        echo'
                                                            <a href="modifier_cachet.php?id='.$id_cachet.'" style=" width:200px;" class="btn btn-secondary" >'.$nom.'</a>
                                                        ';
                                                     }
                                     }else{
                                     if($statut==1){
                                                         echo'
                                                            <a href="#" style=" width:200px;" class="btn btn-primary" >'.$nom.'</a>
                                                        ';
                                                     }elseif($statut==2){

                                                        echo'
                                                            <a href="#" style=" width:200px;" class="btn btn-warning" >'.$nom.'</a>
                                                        ';

                                                     }elseif($statut==3){

                                                        echo'
                                                            <a href="#" style=" width:200px;" class="btn btn-success" >'.$nom.'</a>
                                                        ';
                                                     }elseif($statut==4){

                                                        echo'
        <a href="#" style=" width:200px;" class="btn btn-secondary" >'.$nom.'</a>
                                                        ';
                                                     }
                                                        
                                     }?></td>
                                     <?php  
                                    if($lvl > 14 || $lvl == 1){ ?>
                                    <td><a href="modifier_cachet.php?id=<?=$id_cachet?>" style="color: black"><?= $date_cachet ?></a></td>
                                    <?php  
                                    }else{ ?>
                                    <td><?= $date_cachet ?></td>
                                    <?php } ?>
                                    <?php if($lvl >10) {?><td><?=$auteur?></td><?php }?>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 <?php if($lvl > 14 || $lvl == 11){ ?>
                                                    <a class="dropdown-item" href="modifier_cachet.php?id=<?=$id_cachet?>"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                                <?php }else if($lvl > 14){ ?>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_patient"><i class="fas fa-trash"></i>
                                                        Delete</a>
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

    }
}
?>


    <!--//Footer-->
<?php
include('foot.php');
?>