<?php

include('first.php');
include('php/main_side_navbar.php');
include("api/Payment.php");


?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"> <i class=" fa fa-address-card" style="color: silver"></i> Liste des Cotisations</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        <!--Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>-->
                     Bien vouloir faire enregistrer  votre reçu de versement bancaire auprès du secrétariat  
                     de l'Ordre sis montee Elig essono, 2e étage au dessus d'élégance pressing. 
                     Contactez nous au 655010203.
                        .
                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
<?php if($lvl != 14  && $lvl != 15){ ?>

                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="<?=$cotisation['option1_link']?>">
                                        <i class="fas fa-plus-circle"></i>
                                        Nouvelle cotisation
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
                                <tr style="background-color: #dde9dd">
                                    <th>Ref_cotisation</th>
                                    <th>Caisse</th>
                                    <th>Année d'inscription</th>
                                    <th>Ingénieur</th>
                                    <th>Payer</th>
                                    <th>Reste</th>
                                    <th>Etat</th>
                                    <th class="text-right"><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
$_status="";
$_pay_link = "#";
$transaction_id = "0";
                                if($lvl > 9){
                                    $query = "SELECT * from cotisation where open_close!='1' order by annee,ref_ing_cost asc";
                                }else{
                                    $query = "SELECT * from cotisation where id_ing =$id_perso and open_close!='1' order by annee,ref_ing_cost asc";
                                }
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_cotisation = $row['id_cotisation'];
                                    $id_caisse = $row['id_caisse'];
                                    $annee = $row['annee'];
                                    $ref_ing_cost = $row['ref_ing_cost'];
                                    $id_ing = $row['id_ing'];
                                    $nom_ing = $row['nom_ing'];
                                    $somme = $row['somme'];
                                    $payer = $row['payer'];
                                    $solde= $somme-$payer;
                                    $etat = $row['etat'];
                                    $_status="";
                                    $_pay_link = "#";
                                    $transaction_id = "0";
                                   

                                                         $sql = "SELECT DISTINCT caisse from caisse where id_caisse = '$id_caisse'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $caisse=$table['caisse'];
                                                                }
                                                                
                                                                // $sql = "SELECT DISTINCT nom_ing, prenom_ing from mytable where id_ingenieur = '$id_ing'";

                                                                // $stmt = $db->prepare($sql);
                                                                // $stmt->execute();

                                                                // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                // foreach($tables as $table)
                                                                // {
                                                                //     $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                                                // }

                                                                // $sql="SELECT YEAR('$annee') as total  ";
                                                                // $stmt = $db->prepare($sql);
                                                                // $stmt->execute();

                                                                // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                // foreach($tables as $table)
                                                                //     {
                                                                //         $annee=$table['total'];
                                                                //     }

                                    
                                    
             
                                    ?>
                                    <tr>
                                       <input name="id" type="hidden"
                                                                       value="<?php echo $id_cotisation ?>"/>
                                                                <td><a
                                                                            href="#"
                                                                            title="<?= $ref_ing_cost; ?>"
                                                                            style="color: black"><?=$ref_ing_cost?></a>
                                                                </td>
                                                                <td><a
                                                                            href="#"
                                                                            title="<?= $caisse; ?>"
                                                                            style="color: black"><?= $caisse; ?></a>
                                                                </td>
                                                                <td align="center" ><a
                                                                            href="#"
                                                                            title="<?= $annee; ?>"
                                                                            style="color: black"><?= $annee; ?></a></td>
                                                                <td><a
                                                                            href="#"
                                                                            title="N/A"
                                                                            style="color: black">N/A</a>
                                                                </td>
                                                                <!--<td ><a-->
                                                                <!--            href="#"-->
                                                                <!--            title="<?php // echo number_format($somme); ?>"-->
                                                                <!--            style="color: black"><?php //echo number_format($somme) ?> </a>-->
                                                                <!--</td>-->
                                                                
                                                                
                                                                <td ><a
                                                                            href="#"
                                                                            title="<?= number_format($payer); ?>"
                                                                            style="color: black"><?= number_format($payer); ?></a></td>

                                                                <td ><a
                                                                            href="#"
                                                                            title=""
                                                                            style="color: black"><?= number_format($solde); ?></a>
                                                                            </td>
                                                                <td >
                                                            
                                                

                                                                        </td>
                                                                <td>
                                                                    <?php if($lvl> 9 && $lvl != 12 && $lvl != 14  && $lvl != 15){ ?>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="modifier_cotisation.php?id=<?=$id_cotisation?>"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_patient"><i class="fas fa-trash"></i>
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
                    title: 'Oops...',
                    text: 'Une erreur s\'est produite !',
                    footer: 'Reéssayez encore'
                })
            </script>
            <?php
            break;
        case '2';
            ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Oops...',
                    text: 'le versement est plus grand que le somme à versé',
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