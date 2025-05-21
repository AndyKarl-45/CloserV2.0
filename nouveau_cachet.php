<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');
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
                <h1 class="mt-4"><i class=" fas fa-user-graduate" style="color: silver"></i> Nouveau Cachet</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .
                    </li>
                </ol>


         <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                <ul class="nav nav-pills" style="float: right;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="liste_cachet.php">
                                            Retour
                                        </a>
                                    </li>                              
                                </ul>
                                <!-- Nav pills -->
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-cubes"></i>
                                        Nouveau <!-- <?=$id_personnel?> --> 
                                        </a>
                                    </li>                                    
                                </ul>
                            </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">

                <!--                Main Body-->
            <div class="tab-pane container active" id="home">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                 <b>
                                                               <!-- Nav pills -->
                                <!-- <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-cubes"></i>
                                            Nouveau 
                                        </a>
                                    </li>
                                 </ul> -->
                            </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->
                                    <!-- infos civile-->


                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <form action="save_cachet.php" method="POST">
                                                <div class="row">
                                                    <!-- <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label>Matricule<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="matricule">
                                                        </div>
                                                    </div> -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                        <label>Ingénieur</label>
                                                            <?php if($lvl > 9){ ?>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox" >
                                                            <select class="form-control" id="countries" name="id_ing">
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
                                                            <label>Téléphone</label>
                                                            <input class="form-control" type="text" name="tel" required>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Numéro de Recue:<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="" name="recu" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Ville: <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="" name="ville" required>
                                                        </div>
                                                    </div>
                                                   <div class="col-sm-6">
                                                        <div class="form-group">
                                                             <label>Statut</label>
                                                            <select class="form-control" name="id_statut" required>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM  statut_cachet where id_statut=1");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_statut'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                             <label>Année:</label>
                                                            <select class="form-control"  disabled="">
                                                               
                                                                <?php
                                                                    $date=date("Y");
                                                                    echo'<option  selected="">'.$date.'</option>';
                                                                 
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
                                               
                                                
                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Envoyer</button>
                                                    <a href="liste_cachet.php" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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
            </div>
                <!--****************************Etat acadaméique**************************-->
            <div class="tab-pane container" id="menu1">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                
                                <!-- Nav pills -->
                                <ul class="nav nav-pills">
                                    
                                <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#menu1">
                                            <i class="fas fa-university"></i>
                                            Etat Academique
                                        </a>
                                    </li>                                     
                                </ul>
                            </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->
                                    <!-- infos civile-->


                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <form action="save_ingenieur.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Nom2<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="nom"
                                                                   required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input class="form-control" type="text" name="prenom">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Username <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="username"
                                                                   required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Email <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="email" name="email">
                                                        </div>
                                                    </div>
                                                    <!--  <div class="col-sm-6">
                                                         <div class="form-group">
                                                             <label>Password</label>
                                                             <input class="form-control" type="password" name="password" required="required">
                                                         </div>
                                                     </div>
                                                     <div class="col-sm-6">
                                                         <div class="form-group">
                                                             <label>Confirm Password</label>
                                                             <input class="form-control" type="password" name="check_password" required="required">
                                                         </div>
                                                     </div> -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date de Naissance</label>
                                                            <div>
                                                                <input type="date" class="form-control"
                                                                       name="date_aniv">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group gender-select">
                                                            <label class="gen-label">Gendre:</label>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="radio" name="gender" value="M"
                                                                           class="form-check-input" required="required">Homme
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="radio" name="gender" value="F"
                                                                           class="form-check-input" required="">Femme
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Adresse</label>
                                                                    <input type="text" class="form-control"
                                                                           name="adresse">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>Pays</label>
                                                                    <select class="form-control" name="pays">
                                                                        <option value="Cameroun">Cameroun</option>
                                                                        <option value="USA">USA</option>
                                                                        <option value="United Kingdom">United Kingdom
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>Ville</label>
                                                                    <input type="text" class="form-control"
                                                                           name="ville">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>State/Province</label>
                                                                    <select class="form-control" name="region">
                                                                        <option value="California">California</option>
                                                                        <option value="Alaska">Alaska</option>
                                                                        <option value="Alabama">Alabama</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>Postal Code</label>
                                                                    <input type="text" class="form-control"
                                                                           name="code_postal">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Phone </label>
                                                            <input class="form-control" type="text" name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Avatar</label>
                                                            <div class="profile-upload">
                                                                <div class="upload-img">
                                                                    <img alt="" src="assetss/img/user.jpg">
                                                                </div>
                                                                <div class="upload-input">
                                                                    <input type="file" class="form-control"
                                                                           name="fichier">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Short Biography</label>
                                                    <textarea class="form-control" rows="3" cols="30"
                                                              name="biography"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="display-block">Status</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                               id="doctor_active" value="1" checked>
                                                        <label class="form-check-label" for="doctor_active">
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                               id="doctor_inactive" value="2">
                                                        <label class="form-check-label" for="doctor_inactive">
                                                            Inactive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="<?=$entreprise['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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
            </div>

                <!--                Etat professionnel-->
            <div class="tab-pane container" id="menu2">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                
                                <!-- Nav pills -->
                                <ul class="nav nav-pills">
                                   
                                     <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#menu2">
                                            <i class="fas fa-envelope"></i>
                                            Etat Professionnel
                                        </a>
                                    </li>                                     
                                </ul>
                            </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->
                                    <!-- infos civile-->


                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <form action="save_ingenieur.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Nom2<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="nom"
                                                                   required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input class="form-control" type="text" name="prenom">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Username <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="username"
                                                                   required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Email <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="email" name="email">
                                                        </div>
                                                    </div>
                                                    <!--  <div class="col-sm-6">
                                                         <div class="form-group">
                                                             <label>Password</label>
                                                             <input class="form-control" type="password" name="password" required="required">
                                                         </div>
                                                     </div>
                                                     <div class="col-sm-6">
                                                         <div class="form-group">
                                                             <label>Confirm Password</label>
                                                             <input class="form-control" type="password" name="check_password" required="required">
                                                         </div>
                                                     </div> -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date de Naissance</label>
                                                            <div>
                                                                <input type="date" class="form-control"
                                                                       name="date_aniv">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group gender-select">
                                                            <label class="gen-label">Gendre:</label>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="radio" name="gender" value="M"
                                                                           class="form-check-input" required="required">Homme
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="radio" name="gender" value="F"
                                                                           class="form-check-input" required="">Femme
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Adresse</label>
                                                                    <input type="text" class="form-control"
                                                                           name="adresse">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>Pays</label>
                                                                    <select class="form-control" name="pays">
                                                                        <option value="Cameroun">Cameroun</option>
                                                                        <option value="USA">USA</option>
                                                                        <option value="United Kingdom">United Kingdom
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>Ville</label>
                                                                    <input type="text" class="form-control"
                                                                           name="ville">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>State/Province</label>
                                                                    <select class="form-control" name="region">
                                                                        <option value="California">California</option>
                                                                        <option value="Alaska">Alaska</option>
                                                                        <option value="Alabama">Alabama</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>Postal Code</label>
                                                                    <input type="text" class="form-control"
                                                                           name="code_postal">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Phone </label>
                                                            <input class="form-control" type="text" name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Avatar</label>
                                                            <div class="profile-upload">
                                                                <div class="upload-img">
                                                                    <img alt="" src="assetss/img/user.jpg">
                                                                </div>
                                                                <div class="upload-input">
                                                                    <input type="file" class="form-control"
                                                                           name="fichier">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Short Biography</label>
                                                    <textarea class="form-control" rows="3" cols="30"
                                                              name="biography"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="display-block">Status</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                               id="doctor_active" value="1" checked>
                                                        <label class="form-check-label" for="doctor_active">
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                               id="doctor_inactive" value="2">
                                                        <label class="form-check-label" for="doctor_inactive">
                                                            Inactive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="<?=$entreprise['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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
            </div>

                <!--                Main Body-->





                


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
        function addRow(tableID) {


            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;

            for(var i=0; i<colCount; i++) {

                var newcell = row.insertCell(i);

                newcell.innerHTML = table.rows[1].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                        newcell.childNodes[0].value = "";
                        break;
                    case "checkbox":
                        newcell.childNodes[0].checked = false;
                        break;
                    case "select-one":
                        newcell.childNodes[0].selectedIndex = 0;
                        break;
                }
            }
        }

        function deleteRow(tableID) {
            try {
                var table = document.getElementById(tableID);
                var rowCount = table.rows.length;

                for(var i=0; i<rowCount; i++) {
                    var row = table.rows[i];
                    var chkbox = row.cells[0].childNodes[0];
                    if(null != chkbox && true == chkbox.checked) {
                        if(rowCount <= 2) {
                            addRow(tableID);
                            // alert("Attention la 1ère ligne n'est pas supprimable. La quantité est initialisée à 0");
                            //  break;
                        }
                        table.deleteRow(i);
                        rowCount--;
                        i--;
                    }


                }
            }catch(e) {
                alert(e);
            }
        }

        function testValue(selection) {
            if (selection.value == "Dawn") {
                // do something
            }
            else if (selection.value == "Noon") {
                // do something
            }
            else if (selection.value == "Dusk") {
                // do something
            }
            else {
                // do something
            }
        }

    </script>


    <!--//Footer-->
<?php
include('foot.php');
?>