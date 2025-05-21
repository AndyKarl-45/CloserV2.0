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
                <h1 class="mt-4">Nouvelle demande d'attestation pour le compte des entreprises </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .
                    </li>
                </ol>
                <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                         
                        <!--<a data-toggle="collapse" href="#collapse1" class="text-warning">"ici"</a>-->
                         <i class="fa fa-warning"></i>Attention,  <b style="color: red">suite aux récentes mises à jour </b>: toutes les entreprises enregistrées dans le système doivent disposer d'un <b style="color: red">NIU</b>. <b style="color: green">Veuillez remplir ce nouveau champ dans la rubrique " Entreprises"</b> avant toute opération sur cette page.
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                      <div class="panel-body">
                            <i>après avoir effectué le paiement, il faut obligatoirement cliquer sur <b class="text-warning">"Pour revenir sur le site marchant"</b></i>
                            <div class="text-center">
                                <img src="img/payment_back_pc.jpg" class="rounded" width="200" heigth="200" alt="Sur PC">
                                <img src="img/payment_back_phone.jpg" class="rounded" width="200" heigth="200" alt="Sur Smartphone">
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
                                            <form action="save_demande_entreprise_nonpayer.php" method="POST">
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
                                                            <label>Versement</label>
                                                            <input type="hidden"  name="payer"
                                                                value="0" >
                                                                <input type="number" class="form-control" 
                                                                value="0" disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Caisse</label>
                                                           <?php if($lvl > 20){ ?>
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
                                                            <label>Année</label>
                                                            <?php
                                                                if($lvl>20){
                                                                ?>
                                                                <input type="date" class="form-control" name="date_dem_part">
                                                                <?php }else{ 
                                                                $date_dem=date("Y-m-d");
                                                                ?>
                                                                <input type="hidden" class="form-control" name="date_dem_part" value="<?=$date_dem?>" >
                                                                <input type="date" class="form-control"  value="<?=$date_dem?>" disabled>
                                                                <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Ingénieur</label>
                                                             <?php if($lvl > 9){ ?>
                                                             <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox" >
                                                            <select class="form-control" id="countries" name="id_ing">
                                                               <option value="0" selected="" id="searchBo"3>....</option>
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
                                                            <label>Objet</label>
                                                            <!--<textarea  rows="5" name="objet"-->
                                                            <!--                          cols="7" placeholder=""></textarea>-->
                                                            <textarea class="form-control" cols="7" rows="5"name="objet" onkeyup="javascript:MaxLengthTextarea(this, 180);" >écrivez votre texte en 180 caractères maximum
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Statut</label>
                                                            <select name="statut" class="form-control">
                                                                <option value="0" selected=""></option>
                                                                <option value="2">INGENIEUR</option>
                                                                <option value="2">I</option>
                                                             </select>
                                                        
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Entreprise</label>
                                                        <div class="form-group input-group" style="width: 100%">
                                                            <select class="form-control" name="id_entreprise">
                                                               <option value="0" selected="">....</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM  entreprise where nom_en!='' and nui!='N/A' order by nom_en asc");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_entreprise'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom_en'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                            
                                                                <button type="button" data-toggle="modal"  style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red; margin-top: 5px; margin-bottom:  5px; margin-left: 5px;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;"><a href="nouvelle_entreprise.php"><i class="fas fa-plus"></i></a></button>
                                                            
                                                        </div>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
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

                                              

                                               <!--   <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                           
                                                                             <span class="help-block small-font">.</span>
                                                        <div class="form-group input-group" style="width: 75%">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Montant</span>
                                                            </div>
                                                            <input type="number" class="form-control" name="montant" required="">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Fcfa</span>
                                                            </div>
                                                            <button type="button" data-toggle="modal"  style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;"><a href="liste_ville.php"><i class="fas fa-plus"></i></a></button>
                                                        </div>
                                                        <button type="button" data-toggle="modal"  style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;"><a href="liste_ville.php"><i class="fas fa-plus"></i></a></button>
                                                    
                                                        
                                                    </div>
                                                </div>
                                            </div> 
                                                 -->
                                               

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Valider</button>
                                                    <a href="liste_demande_entreprise.php" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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
    
    <script type="text/javascript">
         function MaxLengthTextarea(objettextarea,maxlength){
          if (objettextarea.value.length > maxlength) {
            objettextarea.value = objettextarea.value.substring(0, maxlength);
            alert('Votre texte ne doit pas dépasser '+maxlength+' caractères!');
           }
        }
    </script>;


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

    <!--//Footer-->
<?php
include('foot.php');
?>