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
                <h1 class="mt-4">Nouvelle demande d'attestation à usage personnel</h1>
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
                                            <form action="save_demande_particulier.php" method="POST">
                                                <div class="row">
                                                    
                                                                <?php

                                                                 $iResult = $db->query("SELECT * FROM caisse WHERE id_caisse =3");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_perso'];
                                                                    ?>
                                                                    <input type="hidden" name="id_personnel" value="<?=$i?>">

                                                              <?php  }
                                                                ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                        
                                                                <?php
                                                                if($lvl>9){
                                                                ?>
                                                                <!--<input type="date" class="form-control" name="date_dem_part">-->
                                                                <input type="date" class="form-control"  value="<?php echo date('Y-m-d'); ?>" disabled>
                                                                <input type="hidden" class="form-control" name="date_dem_part" value="<?php echo date('Y-m-d'); ?>">
                                                                <?php }else{ 
                                                                $date_dem=date("Y-m-d");
                                                                ?>
                                                                <input type="date" class="form-control" name="date_dem_part" value="<?=$date_dem?>" readonly>
                                                                <?php } ?>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Caisse</label>
                                                            <?php if($lvl > 9){ ?>
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
                                                            <?php }else{ ?>
                                                            <input type="text" class="form-control" value="E-Banking" readonly>
                                                            <input type="hidden" name="id_caisse" value="3">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Membre</label>
                                                             <?php if($lvl > 9){ ?>
                                                             <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxDems" >
                                                            <select id="countriesDems" class="form-control" name="id_ing">
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Objet</label>
                                                            <input class="form-control" type="text" name="objet" value="usage personnel" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            <div class="row">
                                                    
                                                   
                                                    
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Droit</label>
                                                            <select name="droit" class="form-control">
                                                                <option value="Payer" selected="">Payer</option>
                                                                <option value="Impayer">Impayer</option>
                                                             </select>
                                                        
                                                    </div>
                                                </div> -->
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
                                                
                                               

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">générez votre attestation</button>
                                                    <a href="liste_demande_particulier.php" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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
            <script>

        searchBoxI = document.querySelector("#searchBoxDems");
        countriesI = document.querySelector("#countriesDems");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxI.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesI.options; //select options
            for (var i = 0; i < options.length; i++) {
                var option = options[i]; //current option
                var optionText = option.text; //option text ("Somalia")
                var lowerOptionText = optionText.toLowerCase(); //option text lowercased for case insensitive testing
                var lowerText = text.toLowerCase(); //searchBox value lowercased for case insensitive testing
                var regex = new RegExp("^" + text, "i"); //regExp, explained in post
                var match = optionText.match(regex); //test if regExp is true
                var contains = lowerOptionText.indexOf(lowerText) != -1; //test if searchBox value is contained by the option text
                if (match || contains) { //if one or the other goes through
                    option.selected = true; //select that option
                    return; //prevent other code inside this event from executing
                }
                searchBoxI.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>


    <!--    Modal pour ajouter Categorie Contrat-->


    <!--//Footer-->
<?php
include('foot.php');
?>