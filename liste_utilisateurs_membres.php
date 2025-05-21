<?php
include("first.php");
include('php/main_side_navbar.php');
?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Liste des Utilisateurs</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme <?= strtoupper($nom_user) ?>, il est <?= date("G:i"); ?> en ce jour
                        du <?= dateToFrench("now", "l j F Y"); ?>.
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">

                                <!-- Nav pills -->
                                <?php
                                if($lvl >1){
                                    ?>

                                <b>

                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills" style="float: right;">
                                        <li class="nav-item">
                                            <a class="btn btn-primary" href="nouveau_membre.php">
                                                <i class="fas fa-plus"></i>
                                                Nouveau Membre
                                            </a>
                                        </li>
                                    </ul>
                                </b>
                                
                                    <?php
                                } ?>
                            </div>
                            <div class="card-body">
                                <div class="well bs-component">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="table-responsive">
                                                <form method="post" action="">
                                                    <table class="table table-bordered table-hover" id="dataTable"
                                                           width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr class="bg-primary">
                                                            <th><p align="center">Pseudo</p></th>
                                                            <th><p align="center">Matricule</p></th>
                                                            <th><p align="center">Ingénieur</p></th>
                                                            <th><p align="center">Email</p></th>
                                                            <th><p align="center">Date d'inscription</p></th>
                                                            <th><p align="center">Modifier</p></th>
                                                            <th><p align="center">Statut</p></th>
                                                            <?php
                                                            if ($lvl > 10) {
                                                                ?>
                                                                <th><p align="center">Action</p></th>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr class="bg-primary">
                                                            <th><p align="center">pseudo</p></th>
                                                            <th><p align="center">Matricule</p></th>
                                                            <th><p align="center">Ingénieur</p></th>
                                                            <th><p align="center">Email</p></th>
                                                            <th><p align="center">Date d'inscription</p></th>
                                                            <th><p align="center">Modifier</p></th>
                                                            <th><p align="center">Statut</p></th>
                                                            <?php
                                                            if ($lvl > 10) {
                                                                ?>
                                                                <th><p align="center">Action</p></th>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody>
                                                        <?php

                                                        $query = "SELECT * from users_members";
                                                        $q = $db->query($query);
                                                        while ($row = $q->fetch()) {
                                                            $id_user = $row['id_users'];
                                                            $id_ingenieur = $row['id_ingenieur'];
                                                            $pseudo = $row['pseudo'];
                                                            $lvl_user = $row['lvl'];
                                                            $date = $row['date'];
                                                            $email = $row['email'];

                                                            $query1 = "SELECT * from roles WHERE lvl=$lvl_user";
                                                            $q1 = $db->query($query1);
                                                            while ($row1 = $q1->fetch()) {
                                                                $lvl_user = $row1['fonction'];
                                                            }
                                                            
                                                           
                                                            
                                                            $sql = "SELECT * from mytable where  id_ingenieur='$id_ingenieur'";

                                                            $stmt = $db->prepare($sql);
                                                            $stmt->execute();
                        
                                                            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                                                            foreach($tables as $table)
                                                            {
                                                                 $id_ingenieur = $table['id_ingenieur'];
                                                                $matricule = $table['matricule'];
                                                                $nom = $table['nom_ing'];
                                                                $prenom = $table['prenom_ing'];
                                                                $num_ordre = $table['num_ordre'];
                                                            }


                                                            $statut = $row['statut'];
                                                            if ($statut == "D") {
                                                                $statut = "Innactif(ve)";
                                                                $togle = 'fas fa-toggle-off';
                                                            } else {
                                                                $statut = "Actif(ve)";
                                                                $togle = 'fas fa-toggle-on';
                                                            }

                                                            ?>

                                                            <tr>
                                                                <td align="center"><b><a
                                                                                href="modifier_users_members.php?id_user=<?= $id_user ?>"><?= $pseudo; ?></a></b>
                                                                </td>
                                                                <td align="center"><b><?= $matricule; ?></b></td>
                                                                <td align="center"><b><?php echo $nom.' '.$prenom; ?></b></td>
                                                                
                                                                <td align="center"><b><?= $email; ?></b></td>
                                                                <td align="center"><b><?= date("d/m/Y à G:i", strtotime($date)); ?></b></td>
                                                                <td align="center"><?= $statut ?></td>
                                                                <td align="center"><a class="btn btn-warning" data-toggle="modal" data-target="#ModifierUsers<?=$id_user?>" href="#home" title="Modifier"
                                                style="background-color: transparent">
                                                    <i style="color: orange" class="fas fa-pen"></i> 
                                                </a>
                                                <div class="modal fade" id="ModifierUsers<?=$id_user?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="padding:20px 50px;">
                                                            <h3 align="center"><i class="fas fa-map"></i>  <b>Modifier le Login</b></h3>
                                                            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                                                        </div>
                                                        <div class="modal-body" style="padding:40px 50px;">
                                                            <form class="form-horizontal" action="update_login.php" name="form" method="post">
                                                                <div class="form-group">
                                                                    <label>Ancien Login:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" name="nom" class="form-control" value="<?=$pseudo?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nouveau Login:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="hidden" name="id_user" class="form-control" value="<?=$id_user?>">
                                                                        <input type="text" name="pseudo" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                        <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary" value="valider">
                                                                         <a href="liste_pays.php"><input type="text" style=" width:25% " name="" class="btn btn-danger" value="Annuler"/></a></center>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                
                                                </td>
                                                                <?php
                                                                if ($lvl > 10) {
                                                                    ?>
                                                                    <td align="center"><a
                                                                                href="statut_users_members.php?id_user=<?= $id_user ?>"><i
                                                                                    class="<?= $togle ?>"></a></i></td>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tr>

                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

            </div>
        </main>
    </div>
    
            <!--    Modal pour ajouter Categorie Contrat-->


    <!--//Footer-->
<?php
include('foot.php');
?>