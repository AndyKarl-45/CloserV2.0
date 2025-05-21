<?php

include('first.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"> <i class=" fas fa-user-graduate" style="color: silver"></i> Liste des demandes d'activiation</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">


                        
                        <b>
                        <!--    <ul class="nav nav-pills"   style="float: right;">-->
                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link active" href="etat_excel_ingenieur.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"></i> Exporter-->
                        <!--        </a>-->
                        <!--    </li>-->
                        <!--</ul>-->
                        
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="<?=$remboursement['option1_link']?>" style="margin-right: 20px">
                                        <i class="fas fa-plus-circle"></i>
                                        Nouvelle demande 
                                    </a>
                                </li>
                            </ul>
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
                                    <th>Nom</th>
                                    <th>Attestation</th>
                                    <th>Montant</th>
                                    <th>Opérateur</th>
                                    <th>Date</th>
                                    <th>Justification</th>
                                    <th>PDF</th>
                                    <th>Statut</th>
                                    <?php if($lvl >10) {?><th>Auteur</th><?php }?>
                                    <th ><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $year = (new DateTime())->format("Y");

                                if($lvl < 10){
                                    $query = "SELECT * from remboursement where id_ing = $id_perso and open_close!='1' order by date_dem_rem desc";
                                }else{
                                    $query = "SELECT * from remboursement where open_close!='1'order by date_dem_rem desc ";
                                }
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_rem = $row['id_rem'];
                                    $id_ing = $row['id_ing'];
                                    $montant = $row['montant'];
                                    $etat = $row['etat'];
                                    $ope = $row['ope'];
                                    $ref_dem_rem = $row['ref_dem_rem'];
                                    $date_dem_rem = $row['date_dem_rem'];
                                    $date_val_rem = $row['date_val_rem'];
                                    $ref_paie = $row['ref_paie'];
                                    $auteur = $row['auteur'];
                                    
                                   $sql = "SELECT * from mytable where id_ingenieur = '$id_ing'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                    {
                                        $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                        $matricule = $table['matricule'];
                                        $num_ordre = $table['num_ordre'];
                                        $tel_ing = $table['tel_ing'];
                                        $annee = $table['annee'];
                                    }

                                    
                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM pj_rem where id_entite='$id_ing' and id_rem='$id_rem' ";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $count=$table['total'];
                                            $lien=$table['lien'];
                                            $nom_pj=$table['nom_pj'];
                                            $nom='pj_di';
                                            
                                       }

                                    ?>
                                    <tr >
                                        
                                                                <td align="center" style="width:10%"><a
                                                                            href="#"
                                                                            title="<?= $matricule; ?>"
                                                                            style="color: black"><?= $matricule ?> </a></td>
                                                                <td style="width:15%"><img width="28" height="28" src="assetss/img/user.jpg"
                                                 class="rounded-circle m-r-5" alt=""><a
                                                                            href="#"
                                                                            title="<?= $nom_ing; ?>"
                                                                            style="color: black"><?= $nom_ing ?></a>
                                                                </td>
                                                                <td align="center"style="width:15%"><a
                                                                            href="#"
                                                                            title="<?= $ref_dem_rem; ?>"
                                                                            style="color: black"><?= $ref_dem_rem ?> </a></td>
                                                                <td align="center" style="width:10%"><a
                                                                            href="#"
                                                                            title="<?= $montant; ?>"
                                                                            style="color: black"><?= number_format($montant); ?></a>
                                                                </td>
                                                                <td align="center" style="width:8%"><?=$ope?>
                                                                </td>
                                                                
                                                                <td align="center" style="width:8%"><?=$date_dem_rem?>
                                                                </td>
                                                                
                                                                <td align="center"  style="width:8%">
                                                                   <?php
                                                                    if($count != 0){
                                                                        ?>
                                                                        <a href="<?=$lien?>" target="_blank">
                                                                        <i class='fa fa-print'></i></a>
                                                                        <?php  }else{?>
                                                                       
                                                                        <?php  }?>
                                                                </td>
                                                                 <td align="center">
                                                                   <?php
                                                                    if($etat != 0 and $etat != 2){
                                                                        ?>
                                                                        <a href="att_remboursement.php?id=<?=$id_rem?>" target="_blank">
                                                                        <i class='fa fa-print'></i></a>
                                                                        <?php  }else{?>
                                                                       
                                                                        <?php  }?>
                                                                </td>
                                                                <td align="center" style="width:10%">
                                                                    <?php  
                                                                    if($lvl >= 13 || $lvl == 11){
                                                                                     if($etat==0){
                                                                                         echo'
                                                                                            <a href="modifier_statut_remboursement.php?id='.$id_rem.'&etat='.$etat.'" style=" width:120px;" class="btn btn-warning" >En cours</a>
                                                                                        ';
                                                                                     }elseif($etat==1){
                                
                                                                                        echo'
                                                                                            <a href="modifier_statut_remboursement.php?id='.$id_rem.'&etat='.$etat.'" style=" width:120px;" class="btn btn-success" >Valide</a>
                                                                                        ';
                                                                                     }else{
                                                                                         echo'
                                                                                            <a href="modifier_statut_remboursement.php?id='.$id_rem.'&etat='.$etat.'" style=" width:120px;" class="btn btn-danger" >Pas valide</a>
                                                                                        ';
                                                                                     }
                                                                    }else{
                                                                                    if($etat==0){
                                                                                         echo'
                                                                                            <a href="#" style=" width:120px;"  class="btn btn-warning" >En cours</a>
                                                                                        ';
                                                                                     }elseif($etat==1){
                                
                                                                                        echo'
                                                                                            <a href="#"  style=" width:120px;" class="btn btn-success" >Valide</a>
                                                                                        ';
                                                                                     }else{
                                                                                         echo'
                                                                                            <a href="#"  style=" width:120px;" class="btn btn-danger" >Pas valide</a>
                                                                                        ';
                                                                                     }
                                                                                            
                                                                         }?>
                                                                </td>
                                                                <?php if($lvl >10) {?><td><?=$auteur?></td><?php }?>
                                                                <td style="width:5%">
                                                                    <?php if($lvl != 12 && $lvl!=13){ ?>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if($etat == 0){ ?>
                                                    <a class="dropdown-item" href="modifier_remboursement.php?id_rem=<?=$id_rem?>"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                    <?php } ?>
                                                                <?php if($lvl > 11){ ?>
                                                    <a class="dropdown-item" href="delete_remboursement.php?id=<?=$id_rem?>" onclick="Supp(this.href); return(false);"><i class="fas fa-trash">Delete</i></a>
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
        case '-2';
            ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Oops...',
                    text: 'Il exite une demande remboursement à cette reference !',
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