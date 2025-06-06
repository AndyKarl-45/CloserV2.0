<?php

include('first.php');
include('php/main_side_navbar.php');

?>
<?php

// $total_apt = 0;
// $today = date("Y-m-d");
// $today = date("t", strtotime($today));

// $year = (new DateTime())->format("Y");
// $month = (new DateTime())->format("m");
// $day = (new DateTime())->format("d");
// $query  = "SELECT count(id_app) as total from appointment";
// $q = $conn->query($query);
// while($row = $q->fetch_assoc())
// {
//     $total_apt = $row["total"];
// }
// $id_app = $total_apt + 1;
// $ref_app = 'APT_'.$year.'_'.$month.'_'.$day.'_'.$id_app;
?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Fraisd d'attestation</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">

                                    </ul>
                                </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->


                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <form action="save_droit_attestation.php" method="POST">
                                                <div class="row">
                                                     <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Responsable</label>
                                                            <select class="form-control" name="id_perso">
                                                                <option value="0" selected="">....</option>
                                                                <?php

                                                                 $iResult = $db->query("SELECT * FROM personnel");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_personnel'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom'].' '.$data['prenom'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            
                                                            </select>

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Caisse</label>
                                                            <?php if($lvl > 9 && $lvl != 13){ ?>
                                                            <select class="form-control" name="id_caisse">
                                                                <option value="0" selected="">....</option>
                                                                <?php
                                                                if($lvl>9){
                                                                    if($lvl == 12){
                                                                        $iResult = $db->query("SELECT * FROM caisse WHERE id_caisse !=3");
                                                                    }else{
                                                                 $iResult = $db->query("SELECT * FROM caisse");
                                                                    }
                                                                }else{
                                                                    $iResult = $db->query("SELECT * FROM caisse Where id_caisse =3");
                                                                }

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_caisse'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['caisse'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            
                                                            </select>
                                                            <?php }else if($lvl == 13){ 
                                                                        
                                                                        $iResult = $db->query("SELECT * FROM caisse WHERE id_caisse =$id_caisse_user");
                                                                        while ($data = $iResult->fetch()) {

                                                                            $caisse = $data['caisse'];
                                                                    
                                                                        }
                                                                        echo '<input type="text" class="form-control" value="'.$caisse.'" readonly>';
                                                                            echo '<input type="hidden" name="id_caisse" value="'.$id_caisse_user.'">';
                                                                    }else{ ?>
                                                            <input type="text" class="form-control" value="E-Banking" readonly>
                                                            <input type="hidden" name="id_caisse" value="3">
                                                            <?php } ?>

                                                        </div>
                                                         
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <div>
                                                                <input type="date" class="form-control" name="date_att">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Ingénieur</label>
                                                            <?php if($lvl > 9){ ?>
                                                            <select class="form-control" name="id_ing">
                                                               <option value="0" selected="">....</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM  mytable");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_ingenieur'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom_ing'].' '.$data['prenom_ing'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                            <?php }else{ ?>
                                                            <input type="text" class="form-control" value="<?=$nom_user?>" readonly>
                                                            <input type="hidden" name="id_ing" value="<?=$id_perso?>">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Versement</label>
                                                            <input class="form-control" type="number" name="payer">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Somme</label>
                                                            <div>
                                                                <input type="hidden"  name="somme"
                                                                value="1000" >
                                                                <input type="number" class="form-control" name="somme"
                                                                value="1000" disabled="">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label for="party">Sélectionner la meilleure date (entre le premier et le 20 avril) :</label>
                                                            <input type="date" id="party" name="party" min="2017-01-01" max="2018-04-20" required>
                                                            <span class="validity"></span>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                
                                               

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="<?=$attestation['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


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