<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

$sql = "SELECT * from mytable where id_ingenieur = '$id_perso'";

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
                <h1 class="mt-4"> <i class="fas fa-building" style="color: silver"></i>Nouveau </h1>
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
                                            <form action="save_remboursement.php" method="POST" enctype="multipart/form-data"> 
                                                <div class="row">
                                                    <?php if($lvl==1){?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Matricule<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="matricule" value="<?=$matricule?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                           <div class="form-group">
                                                            <label>Ingénieur</label>
                                                           <input type="text" class="form-control" value="<?=$nom_user?>" readonly>
                                                            <input type="hidden" name="id_ing" value="<?=$id_perso?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> Tel</label>
                                                            <input class="form-control" type="text" name="tel_ing" value="<?=$tel_ing?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                       <div class="form-group">
                                                           
                                                            <label>Référence de l'attestation :</label>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxI" >
                                                            <select class="form-control" id="countriesI" name="ref_dem_rem" required>
                                                               <option value="N/A" selected="" id="searchBoxI">....</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM demande_entreprise where id_ing='$id_perso'");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['ref_dem_ent_cp'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['ref_dem_ent_cp'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php }else{?>
                                                    <div class="col-sm-6">
                                                       <div class="form-group">
                                                            <label>Ingénieur</label>
                                                             <?php if($lvl > 9){ ?>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox" >
                                                            <select class="form-control" id="countries" name="id_ing" required>
                                                               <option value="0" selected="" id="searchBox">....</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM  mytable where statut='N/A'");

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
                                                    <div class="col-sm-6">
                                                       <div class="form-group">
                                                            <label>Référence de l'attestation :</label>
                                                             <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxS" >
                                                            <select class="form-control" id="countriesS" name="ref_dem_rem" required>
                                                               <option value="N/A" selected="" id="searchBoxS">....</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM demande_entreprise  ");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['ref_dem_ent_cp'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['ref_dem_ent_cp'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Montant</label>
                                                            <input class="form-control" type="hidden" name="montant" value="1000">
                                                            <input class="form-control" type="number" name="montant" value="1000" readonly>
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-6">-->
                                                    <!--    <div class="form-group">-->
                                                    <!--        <label> Reference de paiement:</label>-->
                                                    <!--        <input class="form-control" type="text" name="ref_paie"  required>-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Facture (1 fichier)</label>
                                                            <input   class="form-control" type="file" name="fichier" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Opérateur</label>
                                                            <select class="form-control" name="ope" required>
                                                                <option value="N/A" selected="">...</option>
                                                                <option value="Orange Money">Orange Money</option>
                                                                <option value="MTN Money">MTN Money</option>
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
                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="<?=$remboursement['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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
              <script>

        searchBox = document.querySelector("#searchBox");
        countries = document.querySelector("#countries");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBox.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countries.options; //select options
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
                searchBox.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    
    <script>

        searchBoxS = document.querySelector("#searchBoxS");
        countriesS = document.querySelector("#countriesS");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxS.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesS.options; //select options
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
                searchBoxS.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    
    
        <script>

        searchBoxI = document.querySelector("#searchBoxI");
        countriesI = document.querySelector("#countriesI");
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

    <!--//Footer-->
<?php
include('foot.php');
?>