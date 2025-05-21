<?php

include('first.php');
include('php/db.php');
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
$bn=0;
$id_user_perso = $_SESSION['rainbo_id_perso'];
$query1 = "SELECT * from personnel WHERE id_personnel= $id_user_perso";
   $stmt = $db->prepare($query1);
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($tables as $row1)
    {
        $nom_user_perso = $row1["nom"] . ' ' . $row1["prenom"];
        $bn++;
    }
     
?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Nouvelle dette</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
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
                                            <form action="save_dette.php" method="POST">
                                                <div class="row">
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Code (REF-AAAA-ID)</label>

                                                            <?php
                                                    // echo '<input class="form-control" name="ref_ing_cost" type="hidden" value="'.$ref_ing_cost.'">';
                                                    // echo '<input class="form-control"  class="form-control form-control-lg" value="'.$ref_ing_cost.'" disabled >';
                                                    ?>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Caisse</label>
                                                            <select class="form-control" name="id_caisse">
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM caisse where id_caisse=6");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_caisse'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['caisse'];
                                                                    echo '</option>';

                                                                }
                                                                ?>

                                                            </select>
                                                        
                                                    </div>
                                                    </div>
                                                    
                                                     <?php if($bn!=0){?>
                                                     <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Auteur</label>
                                                            <div>
                                                                <input type="text" class="form-control"  value="<?=$nom_user_perso?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <?php }?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Annee</label>
                                                             <select id="annees" name="annee" class="form-control">
                                                                
                                                                    <?php
                                                                    $year_actuel = (new DateTime())->format("Y");
                                                                    $year_last = 1900;
                                                                    $diff= ($year_actuel+10) - $year_last;
                                                                    // for($i=0 ; $i<=$diff; $i++){
                                                                    // $years = ($year_actuel+10)-$i;
                                                                    ?>
                                                                <option  value="<?=$year_actuel?>" <?php if($year_actuel == $year_actuel){ echo 'selected';}?>>
                                                                    <?=$year_actuel?>
                                                                </option>
                                                                     <?php //}?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Ingénieur</label>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Versement</label>
                                                            <input class="form-control" type="number" name="payer" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Somme</label>
                                                            <div>
                                                                <input type="number" class="form-control" name="somme"
                                                                       value="0">
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
                                                    <a href="<?=$dette['option2_link']?>" style=" width:150px;" class="btn btn-danger">Annuler</a>
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