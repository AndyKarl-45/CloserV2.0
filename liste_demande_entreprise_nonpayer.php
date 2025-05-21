<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');
include("api/Payment.php");

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
                       <?php if($lvl != 10 && $lvl != 11 && $lvl != 12  ){ ?>
                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="<?=$demande_entreprise_nonpayer['option1_link']?>">
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
                                    <th>Ref_DE</th>
                                    <th>Date</th>
                                    <th>Matricule</th>
                                    <th>Nom ingénieur</th>
                                    <th>Entreprise</th>
                                    <th>Statut</th>
                                    <?php if($lvl >10){ ?><th>Auteur</th><?php }?>
                                    <th>Prévisualisation</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sum=0;
                                if($lvl==1){
                                    $query = "SELECT * from demande_entreprise where id_ing='$id_perso' and etat='0' and open_close!=1  order by date_dem_ent asc";
                                }else{
                                    $query = "SELECT * from demande_entreprise where etat='0'and open_close!=1   order by date_dem_ent asc";
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
                                    $auteur = $row['auteur'];

                                    $nom_en='N/A';
                                    $nom='N/A';
                                    
                                    if(!empty($ref_dem_ent_cp)){
                                    $sql = "SELECT transaction_id FROM payement_init WHERE 	ref_ing_cost = '$ref_dem_ent_cp'";

                                            $stmt = $db->prepare($sql);
                                            $stmt->execute();

                                            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            foreach($tables as $table)
                                            {
                                                     $transaction_id=$table['transaction_id'];
                                             
                                            }
                                            
                                            if(empty($transaction_id)){
                                                 $status='FAILED';
                                                      }else{
                                                          $sql = "SELECT status FROM payement_statut WHERE transaction_id = '$transaction_id'";

                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();

                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach($tables as $table)
                                                    {
                                                      $status=$table['status'];
                                                    }
                                    
                                                      }
                                            
                                            
                                    
                                    }
                                    
                                  
                                   
                                    
                                     if( $status=="SUCCESS" and $ref_dem_ent_cp!='N/A'){}else{
                                     
                                    
                                   
                                
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
                                    <td>
                                       
                                        <?php //echo'<a href="valide_demande_entreprise.php?id='.$id_dem_ent.'" target="_blank"><span class="custom-badge status-red"> ICI POUR PAYER</span></a>'; 
                                             echo'<a href="#" data-toggle="modal" data-target="#PopAlert'.$id_dem_ent.'" ><span class="custom-badge status-red"> ICI POUR PAYER</span></a>'; 
                                        ?>
                                        <!-----// DEBUT //------>
                                            <div class="modal fade" id="PopAlert<?=$id_dem_ent?>" role="dialog" >
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content" >
                                                        <div class="modal-header" style="padding:10px 13px;">
                                                            <h3 align="center"><i class="fas fa-bars"></i>   <b>Attention ! </b></h3>
                                                            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                                                        </div>
                                                        <div class="modal-body" style="padding:20px 25px;">
                                                            <form class="form-horizontal" action="#" name="form" method="post">
                                                             <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <div class="text-center">
                                                                       <b> <i><?php echo strtoupper('apres avoir <b class="text-danger">effectue le paiement</b>, il faut <b class="text-danger">obligatoirement </b> <br> 1. Imprimer votre facture à payer <br> 2. cliquer sur'); ?> </b></br> <b class="text-danger">"Pour revenir sur le site marchant"</b></i>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                   
                                                                    <div class="text-center">
                                                                        <img src="img/payment_back_pc.jpg" class="rounded" width="200" heigth="200" alt="Sur PC">
                                                                        <img src="img/payment_back_phone.jpg" class="rounded" width="200" heigth="200" alt="Sur Smartphone">
                                                                        <img src="img/payment_back_https.jpg" class="rounded" width="200" heigth="200" alt="Accepter sans certificat">
                                                                    </div>
                                                            </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <div class="text-center">
                                                                      <div class="panel-footer">---------------------</div>
                                                                     </div>
                                                                 </div>
                                                            </div>
                                                              <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <center>
                                                                    <a style=" width:75% "  class="btn btn-primary"  href="valide_demande_entreprise.php?id=<?=$id_dem_ent?>">Continuer le processus de paiement</a>
                                                                    
                                                                    </center>
                                                                </div>
                                                            </div>
                                                     
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-----// FIN //------>
                                    </td>
                                    <?php if($lvl >10){ ?>
                                    <td align="center">
                                            <?=$auteur?>
                                        </td>
                                    <?php }?>
                                    
                                     <td align="center">
                                            <a href="attestation_brouillion.php?id=<?=$id_dem_ent?>" target="_blank">
                                            <i class='fa fa-print'></i></a>
                                            
                                        </td>
                                         <td align="center" style="width:10%">
                                             <?php if($lvl !=  1){?>
                                            <a class="btn btn-warning" href="modifier_demande_entreprise.php?id=<?=$id_dem_ent;?>" title="Modifier"
                                                style="background-color: transparent">
                                                    <i style="color: orange" class="fas fa-pen"></i> 
                                                </a> 
                                                <?php if($lvl > 18){?>
                                                <a class="btn btn-danger"  href="delete_demande_entreprise.php?id=<?=$id_dem_ent;?>"   onclick="Supp(this.href); return(false);" style="background-color: transparent">
                                                    <i style="color: red" class="fas fa-trash"></i>
                                            </a>
                                             <?php }?>
                                            
                                            <?php }?>
                                                                    
                                          </td>
                                </tr>
                                <?php }
                                }
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