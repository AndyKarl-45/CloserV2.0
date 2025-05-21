<?php

include('first.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"> <i class=" fas fa-user-graduate" style="color: silver"></i> Liste des membres</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">


                        <?php if(($lvl == 11 || $lvl > 12) && $lvl!=14){ ?>
                        <b>
                            <ul class="nav nav-pills"   style="float: right;">
                            <li class="nav-item">
                                <a class="nav-link active" href="etat_excel_ingenieur.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"></i> Exporter
                                </a>
                            </li>
                        </ul>
                        
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="<?=$ingenieur['option1_link']?>" style="margin-right: 20px">
                                        <i class="fas fa-plus-circle"></i>
                                        Nouveau membre 
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
                                <tr align="center" style="background-color: #dde9dd">
                                     
                                   <th>Matricule</th>
                                     <th>Année</th>
                                    <th>Nom</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Montant Dette</th>
                                    <?php if($lvl >10) {?><th>Auteur</th><?php }?>
                                    <th ><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if($lvl < 10){
                                    $query = "SELECT * from mytable where id_ingenieur = $id_perso ";
                                }else{
                                    $query = "SELECT * from mytable where statut='N/A' ";
                                }
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
                                    $auteur = $row['auteur'];
                                    
                                    $reste=0;
                                    
                                    $sql = "SELECT DISTINCT somme, payer from dette where id_ing = '$id_ingenieur'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                    {
                                        $somme=$table['somme'];
                                        $payer=$table['payer'];
                                        $reste=$somme-$payer;
                                    }

                                    ?>
                                    <tr >
                                        <?php if($lvl != 12){ ?>
                                       <input name="id" type="hidden"
                                                                       value="<?php echo $id_ingenieur ?>"/>
                                                                <td align="center" style="width:15%"><a
                                                                            href="details_ingenieur.php?id=<?php echo $id_ingenieur; ?>"
                                                                            title="<?= $matricule; ?>"
                                                                            style="color: black"><?= $matricule ?> </a></td>
                                                                <td align="center" style="width:15%"><a
                                                                            href="details_ingenieur.php?id=<?php echo $id_ingenieur; ?>"
                                                                            title="<?= $annee; ?>"
                                                                            style="color: black"><?= $annee; ?></a></td>
                                                                <td style="width:25%"><img width="28" height="28" src="assetss/img/user.jpg"
                                                 class="rounded-circle m-r-5" alt=""><a
                                                                            href="details_ingenieur.php?id=<?php echo $id_ingenieur; ?>"
                                                                            title="<?= $nom_ing; ?>"
                                                                            style="color: black"><?= $nom_ing . ' ' . $prenom_ing; ?></a>
                                                                </td>
                                                                <td align="center"style="width:18%"><a
                                                                            href="details_ingenieur.php?id=<?php echo $id_ingenieur; ?>"
                                                                            title="<?= $tel_ing; ?>"
                                                                            style="color: black"><?= $tel_ing ?> </a></td>
                                                                <td align="center" style="width:22%"><a
                                                                            href="details_ingenieur.php?id=<?php echo $id_ingenieur; ?>"
                                                                            title="<?= $email_ing; ?>"
                                                                            style="color: black"><?= $email_ing; ?></a>
                                                                </td>
                                                                <td align="center">
                                                                    <?= number_format($reste); ?>
                                                                </td>
                                                       <?php }else{ ?>                     
                                                                <td align="center" style="width:15%"><?= $matricule ?></td>
                                                                <td align="center" style="width:15%"><?= $annee; ?></td>
                                                                <td style="width:25%"><img width="28" height="28" src="assetss/img/user.jpg"
                                                 class="rounded-circle m-r-5" alt=""><?= $nom_ing . ' ' . $prenom_ing; ?>
                                                                </td>
                                                                <td align="center"style="width:18%">
                                                                    <?= $tel_ing ?>
                                                                </td>
                                                                <td align="center" style="width:22%">
                                                                    <?= $email_ing; ?>
                                                                </td>
                                                                <td align="center">
                                                                    <?= number_format($reste); ?>
                                                                </td>
                                                                
                                                                            <?php } ?>
                                                             <?php if($lvl >10) {?><td><?=$auteur?></td><?php }?>
                                                                <td align="center"style="width:10%">
                                                                    <?php if($lvl != 12 ){ ?>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="modifier_ingenieur.php?id=<?=$id_ingenieur?>"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                                <?php if($lvl > 11){ ?>
                                                    <a class="dropdown-item" href="delete_ingenieur.php?id=<?=$id_ingenieur?>" onclick="Supp(this.href); return(false);"><i class="fas fa-trash">Delete</i></a>
                                                    <?php } ?>
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
                    title: 'Oops...',
                    text: 'Une erreur s\'est produite !',
                    footer: 'Reéssayez encore'
                })
            </script>
            <?php
            break;
        case '-3';
            ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Oops...',
                    text: 'Email existe déjà !',
                    footer: 'Reéssayez encore'
                })
            </script>
            <?php
            break;


    }
}
?>

<script type="text/javascript">
   function Supp(link){
    if(confirm('Confirmer  la suppression du Membre ?')){
     document.location.href = link;
    }
   }
  </script>
    <!--//Footer-->
<?php
include('foot.php');
?>