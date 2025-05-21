<?php

include('first.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"> <i class=" fa fa-address-card" style="color: silver"></i> Liste des personnels</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">


                        <?php if(($lvl >12 && $lvl != 15 && $lvl != 13) || $lvl == 11  ){ ?>
                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="<?=$personnel['option1_link']?>">
                                        <i class="fas fa-plus-circle"></i>
                                        Nouveau personnel
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
                                    <th style="width: 25%;">Nom</th>
                                    <th style="width: 15%;">Poste</th>
                                    <th style="width: 20%;">Statut</th>
                                    <th style="width: 10%;">Phone</th>
                                    <th style="width: 20%;">Email</th>
                                    <?php if($lvl >10) {?><th>Auteur</th><?php }?>
                                    <th style="width: 10%; align-content: center;"><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

if($lvl > 9 ){
                                $query = "SELECT * from personnel where open_close!='1' and statut  LIKE 'E%' order by nom asc";
}else{
                                $query = "SELECT * from personnel where id_personnel = $id_perso AND open_close!='1' AND statut  LIKE 'E%' order by nom asc";
}
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_personnel = $row['id_personnel'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    $poste = $row['poste'];
                                    $tel = $row['tel'];
                                    $statut = $row['statut'];
                                    $id_quartier = $row['id_quartier'];
                                    $email = $row['email'];
                                    $auteur = $row['auteur'];

                                    ?>
                                    <tr>
                                        <?php if($lvl > 10 && $lvl != 12 && $lvl != 13 && $lvl != 14  && $lvl != 15){ ?>
                                       <input name="id" type="hidden"
                                                                       value="<?php echo $id_personnel ?>"/>
                                                                <td><img width="28" height="28" src="assetss/img/user.jpg"
                                                 class="rounded-circle m-r-5" alt=""><a
                                                                            href="details_personnel.php?id=<?php echo $id_personnel; ?>"
                                                                            title="<?= $nom; ?>"
                                                                            style="color: black"><?= $nom . ' ' . $prenom; ?></a>
                                                                </td>
                                                                <td align="center"><a
                                                                            href="details_personnel.php?id=<?php echo $id_personnel; ?>"
                                                                            title="<?= $poste; ?>"
                                                                            style="color: black"><?= $poste; ?></a></td>
                                                                <td align="center"><a
                                                                            href="details_personnel.php?id=<?php echo $id_personnel; ?>"
                                                                            title="<?= $statut; ?>"
                                                                            style="color: black"><?= $statut; ?></a>
                                                                </td>
                                                                <td align="center"><a
                                                                            href="details_personnel.php?id=<?php echo $id_personnel; ?>"
                                                                            title="<?= $tel; ?>"
                                                                            style="color: black"><?= $tel ?> </a>
                                                                </td>
                                                                
                                                                
                                                                <td align="center"><a
                                                                            href="details_personnel.php?id=<?php echo $id_personnel; ?>"
                                                                            title="<?= $email; ?>"
                                                                            style="color: black"><?= $email; ?></a></td>
                                            <?php if($lvl >10) {?><td><?=$auteur?></td><?php }?>
                                                                
                                                                <td align="center">
                                                                    
                                                                    
                                            <div class="dropdown dropdown-action">
                                                <?php if($lvl != 14  && $lvl != 15){ ?>
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="modifier_personnel.php?id=<?=$id_personnel?>"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                                
                                                    <a class="dropdown-item" href="delete_personnel.php?id=<?=$id_personnel?>" onclick="Supp(this.href); return(false);"><i class="fas fa-trash"></i>
                                                        Delete</a>
                                                        
                                                </div>
                                                <?php } ?>
                                            </div>
                                            
                                        </td>
                                                                    <?php }else{ ?>
                                                                    <td><img width="28" height="28" src="assetss/img/user.jpg"
                                                 class="rounded-circle m-r-5" alt=""><?= $nom . ' ' . $prenom; ?>
                                                                </td>
                                                                <td align="center"><?= $poste; ?></td>
                                                                <td align="center"<?= $statut; ?>
                                                                </td>
                                                                <td align="center"><?= $tel ?>
                                                                </td>
                                                                
                                                                
                                                                <td align="center">
                                                                    
                                                                </td>
                                                                <?php if($lvl >10) {?><td><?=$auteur?></td><?php }?>
                                                                <td align="center">
                                                                  
                                                                    
                                        </td>
                                    
                                <?php } } ?>
                                </tr>
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
    if(confirm('Confirmer  la suppression du personnel ?')){
     document.location.href = link;
    }
   }
  </script>
    <!--//Footer-->
<?php
include('foot.php');
?>