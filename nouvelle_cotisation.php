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
                <h1 class="mt-4">Nouvelle cotisation </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        
                     Bien vouloir faire enregistrer  votre reçu de versement bancaire auprès du secrétariat  
                     de l'Ordre sis montee Elig essono, 2e étage au dessus d'élégance pressing. 
                     Contactez nous au 655010203.
                     
                    </li>
                </ol>
                <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                          <i class="fa fa-warning"></i> Attention, suite à la mise à jour lire attentivement cette instruction en cliquant
                        <a data-toggle="collapse" href="#collapse1" class="text-warning">"ici"</a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                      <div class="panel-body">
                            <i>après avoir effectué le paiement, il faut obligatoirement cliquer sur <b class="text-warning">"Pour revenir sur le site marchant"</b></i>
                            <div class="text-center">
                                <img src="img/payment_back_pc.jpg" class="rounded" width="200" heigth="200" alt="Sur PC">
                                <img src="img/payment_back_phone.jpg" class="rounded" width="200" heigth="200" alt="Sur Smartphone">
                                <img src="img/payment_back_https.jpg" class="rounded" width="200" heigth="200" alt="Accepter sans certificat">
                            </div>
                      </div>
                      <div class="panel-footer">Merci pour votre compréhension</div>
                    </div>
                  </div>
                </div>
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
                                            <form action="save_cotisation.php" method="POST">
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
                                                            <div>
                                                                <!--<input type="date" class="form-control" name="annee">-->
                                                                <?php
                                                                 
                                                                $date_dem=date("Y");
                                                                ?>
                                                                <input type="text" class="form-control"  value="<?=$date_dem?>" readonly>
                                                                

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Ingénieur</label>
                                                            <?php if($lvl > 9){ ?>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxCos" >
                                                            <select  id="countriesCos" class="form-control" name="id_ing">
                                                               <option value="0" selected="">....</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM  mytable ORDER BY nom_ing ASC");

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
                                                        <?php if($lvl==1){ ?>
                                                        <div class="form-group">
                                                            <label>Versement</label>
                                                            <input type="hidden"  name="payer"
                                                                value="61000" >
                                                                <input type="number" class="form-control" 
                                                                value="61000" disabled="">
                                                                
                                                                <!--<input type="number" class="form-control" name="payer">-->
                                                        </div>
                                                        <?php }else{?>
                                                        <div class="form-group">
                                                            <label>Versement</label>
                                                            <input type="hidden"  name="payer"
                                                                value="60000" >
                                                                <input type="number" class="form-control" 
                                                                value="60000" disabled="">
                                                                
                                                                <!--<input type="number" class="form-control" name="payer">-->
                                                        </div>
                                                        
                                                         <?php }?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Somme</label>
                                                             <?php if($lvl==1){ ?>
                                                            <div>
                                                                <input type="hidden"  name="somme" value="61000" >
                                                                <input type="number" class="form-control" name="somme"
                                                                value="61000" disabled="">
                                                            </div>
                                                            <?php }else{?>
                                                            <div>
                                                                <input type="hidden"  name="somme" value="60000" >
                                                                <input type="number" class="form-control" name="somme"
                                                                value="60000" disabled="">
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label for="party">Sélectionner la meilleure date (entre le premier et le 20 avril) :</label>
                                                            <input type="date" id="party" name="party" min="2017-01-01" max="2018-04-20" required>
                                                            <span class="validity"></span>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                
                                               

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Valider</button>
                                                    <a href="<?=$cotisation['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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

        searchBoxI = document.querySelector("#searchBoxCos");
        countriesI = document.querySelector("#countriesCos");
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