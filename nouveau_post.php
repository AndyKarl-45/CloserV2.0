<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

$query = "SELECT id_ingenieur as total from mytable where statut='POSTULANT'";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) { 
    $total = $row["total"];
}
$id_personnel = $total;

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
                <h1 class="mt-4"><i class=" fas fa-user-graduate" style="color: silver"></i> Nouveau Postulant</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
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
                                        <a class="nav-link active" href="<?=$postulant['option2_link']?>">
                                            Retour
                                        </a>
                                    </li>                              
                                </ul>
                                <!-- Nav pills -->
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-cubes"></i>
                                            Etat Civile <!-- <?=$id_personnel?> --> 
                                        </a>
                                    </li>
                                <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu1">
                                            <i class="fas fa-university"></i>
                                            Etat Academique
                                        </a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu2">
                                            <i class="fas fa-envelope"></i>
                                            Etat Professionnel
                                        </a>
                                    </li>  
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu3">
                                            <i class="fas fa-envelope"></i>
                                            Dossiers du Postulant
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
                <!-- infos civile-->

                                    <h5><b><u>NB:</u></b> Veillez saisir vos informations d'état civil comme sur vos pièces d'identité</h5>

                                    <div class="row">
                                        <hr/>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card mb-4">
                                                <form class="form-horizontal" action="save_post.php" method="POST">
                                                    <div class="card-header">

                                                    </div>
                                                    <div class="card-body">
                                                        <fieldset>
                                                            <div class="table-responsive">
                                                                <table class="table  table-hover table-condensed" id="myTable">
                                                                    <tbody>
                                                                    <?php if($lvl>10){?>
                                                                    <tr>

                                                                        <td>
                                                                            <span class="help-block small-font" >Auteur:</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;border-top: 0; 
                                                                                border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;"  name="auteur"value="<?=$nom_user_perso?>" disabled >
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php }?>
                                                                    <tr>

                                                                        <td>
                                                                            <span class="help-block small-font" >Nom:</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;border-top: 0; 
                                                                                border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;"  name="nom" >
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >Prénom:</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;border-top: 0; 
                                                                                border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" name="prenom" >
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >N° CNI ou Passport</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0;
                                                                                 border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" name="id_card_number" >
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >Date D'expiration CNI</span>
                                                                            <div class="col">
                                                                                <input type="date" style="width:75%;border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" name="id_card_validity" >
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >Tel</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" name="tel" >
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >Email</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" type="email" name="email">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >Date de Naissance</span>
                                                                            <div class="col">
                                                                                <input type="date" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" name="date_naissance" >
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >LIEU DE NAISSANCE</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" name="lieu_naissance">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                         <td>
                                                                        <span class="help-block small-font" >Ville</span>
                                                                            <div class="col">
                                                                                <select name="id_ville" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" >
                                                                                    <option value="0" selected>...</option>
                                                                                    <?php

                                                $iResult = $db->query("SELECT * FROM ville where open_close!='1' ");

                                                                            while($data = $iResult->fetch()){

                                                                                $i = $data['id_ville'];
                                                                            echo '<option value ="'.$i.'">';
                                                                                echo $data['nom'];
                                                                                echo '</option>';
                                                        
                                                                            }
                                                    ?>

                                                                    
                                                                                </select>
                                                                               <button type="button" data-toggle="modal"  style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;"><a href="liste_ville.php"><i class="fas fa-plus"></i></a></button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                           <span class="help-block small-font" >Quartier</span>
                                                                            <div class="col">
                                                                                <select name="id_quartier" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" >
                                                                                    <option value="0" selected>...</option>
                                                                                    <?php

                                                $iResult = $db->query("SELECT * FROM quartier where open_close!='1' ");

                                                                            while($data = $iResult->fetch()){

                                                                                $i = $data['id_quat'];
                                                                            echo '<option value ="'.$i.'">';
                                                                                echo $data['nom'];
                                                                                echo '</option>';
                                                        
                                                                            }
                                                    ?>

                                                                    
                                                                                </select>
                                                                               <button type="button" data-toggle="modal"  style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;"><a href="liste_quartier.php"><i class="fas fa-plus"></i></a></button>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >Profession</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;"  name="profession" >
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >Situation matrimoniale</span>
                                                                            
                                                                            <div class="col">
                                                                                <select name="situation_matrimoniale" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" required>
                                                                                    <option value="" selected="">...</option>
                                                                                    <option value="CELIBATAIRE">CELIBATAIRE</option>
                                                                                    <option value="MARIÉ(E)">MARIÉ(E)</option>
                                                                                    <option value="VEUF(VE)">VEUF(VE)</option>
                                                                                </select>
                                                                               <!--  <button type="button" data-toggle="modal" data-target="#ajouterS_m"  style="background-color: transparent">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button> -->
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >Nombre D'enfants</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" value="0" name="nombre_enfants" >
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >Genre</span>
                                                                            <div class="col">
                                                                                <select name="genre" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" >
                                                                                    <option value="" selected="">...</option>
                                                                                    <option value="MASCULIN">MASCULIN</option>
                                                                                    <option value="FEMININ">FEMININ</option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >Année</span>
                                                                            <div class="col">

                                                                                
                                                                                <select name="year" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" disabled="">
                                                                            <?php
                                                                            $an_dernier = date("Y");
                                                                            $an_premier=1970;
                                                                            $annee=date("Y");
                                                                                for($i=$an_dernier;$i>=$an_premier;$i--)
                                                                            {
                                                                            if ($i==$annee) {
                                                                            echo '<option selected value="'.$i.'">'.$i.'</option>';

                                                                            }else {
                                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                                            }
                                                                            }
                                                                            ?>

                                                                            </select>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" style="float: right;">
                                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                                            <h5 class="bg-warning"><b><u>NB:</u></b> Veillez enregistrer avant de passer à l'étape suivante ! </h5>
                                                        </div>
                                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                                            <button type="submit" name="submit_etat_civil" class="btn btn-primary" >Enregistrer</button>
                                                        </div>
                                                        <div class="btn-group mr-2" role="group" aria-label="Second group">
<!--                                                                <a href="liste_personnels.php" class="btn btn-primary" style="float: right; padding-top: 10px; padding-bottom: 10px; margin-right: 20px"><i class="fas fa-angle-double-down"></i> Annuler</a>-->
                                                        </div>
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
            </div>
                <!--****************************Etat acadaméique**************************-->
            <div class="tab-pane container" id="menu1">
                !-- infos civile-->

                                        <h5><b><u>NB:</u></b> Veillez saisir vos informations consernant vos 5 dernieres
                                            années d'études</h5>

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <form class="form-horizontal" action="save_personnel_school.php"
                                                          method="POST" enctype="multipart/form-data">
                                                        <div class="card-header">
                                                            <input type="hidden" name="id_personnel"
                                                                   value="<?= $id_personnel ?>">
                                                        </div>
                                                        <div class="card-body">
                                                            <fieldset>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" width="100%"
                                                                           cellspacing="0">
                                                                        <thead>
                                                                        <tr class="bg-primary">
                                                                            <th>Dilplôme</th>
                                                                            <th>Session</th>
                                                                            <th>École</th>
                                                                            <th>Mention</th>
                                                                            <th>PJ (scan du diplome)</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tfoot>
                                                                        <tr class="bg-primary">
                                                                            <th>Dilplôme</th>
                                                                            <th>Session</th>
                                                                            <th>École</th>
                                                                            <th>Mention</th>
                                                                            <th>PJ (scan du diplome)</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="btn-toolbar" role="toolbar"
                                                                 aria-label="Toolbar with button groups"
                                                                 style="float: right;">
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="First group">
                                                                    <h5 class="bg-warning"><i
                                                                                class="fas fa-warning"></i>
                                                                        <b><u>NB:</u></b> Veillez enregistrer avant de
                                                                        passer à l'étape suivante ! </h5>
                                                                </div>
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="First group">
                                                                    <button type="submit" name="submit_etat_scolaire"
                                                                            class="btn btn-primary">Enregistrer
                                                                    </button>
                                                                </div>
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="Second group">
                                                                    <!--                                                                <a href="liste_personnels.php" class="btn btn-primary" style="float: right; padding-top: 10px; padding-bottom: 10px; margin-right: 20px"><i class="fas fa-angle-double-down"></i> Annuler</a>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

            </div>

                <!--                Etat professionnel-->
            <div class="tab-pane container" id="menu2">
               <!-- infos civile-->

                                        <h5><b><u>NB:</u></b> Veillez saisir vos informations consernant vos 5 dernieres
                                            années profession </h5>

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <form class="form-horizontal" action="save_personnel_background.php"
                                                          method="POST" enctype="multipart/form-data">
                                                        <div class="card-header">
                                                            <input type="hidden" name="id_personnel"
                                                                   value="<?= $id_personnel ?>">
                                                        </div>
                                                        <div class="card-body">
                                                            <fieldset>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" width="100%"
                                                                           cellspacing="0">
                                                                        <thead>
                                                                        <tr class="bg-primary">
                                                                            <th>Entreprises</th>
                                                                            <th>Reférences <br/> "Nom (Téléphone) du
                                                                                responsable"
                                                                            </th>
                                                                            <th>Fonction</th>
                                                                            <th>Date d'arrivé</th>
                                                                            <th>Date de départ</th>
                                                                            <th>Attestation de travail ou Autres</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tfoot>
                                                                        <tr class="bg-primary">
                                                                            <th>Entreprises</th>
                                                                            <th>Reférences <br/> "Nom (Téléphone) du
                                                                                responsable"
                                                                            </th>
                                                                            <th>Fonction</th>
                                                                            <th>Date d'arrivé</th>
                                                                            <th>Date de départ</th>

                                                                            <th>Attestation de travail ou Autres</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]"
                                                                                       style="width:100%"
                                                                                       class="form-control"
                                                                                       placeholder="Nom (Numéro) d'un responsable">
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]"
                                                                                       style="width:100%"
                                                                                       class="form-control"
                                                                                       placeholder="Nom (Numéro) d'un responsable">
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]"
                                                                                       style="width:100%"
                                                                                       class="form-control"
                                                                                       placeholder="Nom (Numéro) d'un responsable">
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]"
                                                                                       style="width:100%"
                                                                                       class="form-control"
                                                                                       placeholder="Nom (Numéro) d'un responsable">
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]"
                                                                                       style="width:100%"
                                                                                       class="form-control"
                                                                                       placeholder="Nom (Numéro) d'un responsable">
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="btn-toolbar" role="toolbar"
                                                                 aria-label="Toolbar with button groups"
                                                                 style="float: right;">
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="First group">
                                                                    <h5 class="bg-warning"><i
                                                                                class="fas fa-warning"></i>
                                                                        <b><u>NB:</u></b> Veillez enregistrer avant de
                                                                        passer à l'étape suivante ! </h5>
                                                                </div>
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="First group">
                                                                    <button type="submit"
                                                                            name="submit_etat_professionnel"
                                                                            class="btn btn-primary">Enregistrer
                                                                    </button>
                                                                </div>
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="Second group">
                                                                    <!--                                                                <a href="liste_personnels.php" class="btn btn-primary" style="float: right; padding-top: 10px; padding-bottom: 10px; margin-right: 20px"><i class="fas fa-angle-double-down"></i> Annuler</a>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
            </div>
             <!--****************************Etat acadaméique**************************-->
            <div class="tab-pane container" id="menu3">
                !-- infos civile-->

                                        <h5><b><u>NB:</u></b> Veillez saisir vos informations consernant votre dossier</h5>

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <form class="form-horizontal" action="save_personnel_school.php"
                                                          method="POST" enctype="multipart/form-data">
                                                        <div class="card-header">
                                                            <input type="hidden" name="id_personnel"
                                                                   value="<?= $id_personnel ?>">
                                                        </div>
                                                        <div class="card-body">
                                                            <fieldset>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" width="100%"
                                                                           cellspacing="0">
                                                                        <thead>
                                                                        <tr class="bg-primary">
                                                                            <th>Informations</th>
                                                                            <th>Pièces jointes</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tfoot>
                                                                        <tr class="bg-primary">
                                                                            <th>Informations</th>
                                                                            <th>Pièces jointes</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="DI"
                                                                                       style="width:100%"
                                                                                       class="form-control" valeu="Demande d'inscritpion" readonly="">
                                                                            </td>
                                                                            
                                                                            <td>
                                                                                <input type="file" name="fichier[0]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="PCDD"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Photocopie certifiée du diplôme d’ingénieur" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[1]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="APODI"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Attestation de présentation de l’original du diplôme d’ingénieur" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[2]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="PCB"
                                                                                       style="width:100%"
                                                                                       class="form-control"  value=" Photocopie certifiée du bacc" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[3]"
                                                                                       style="width:100%"
                                                                                       class="form-control" >
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="CCC"
                                                                                       style="width:100%"
                                                                                       class="form-control" value=" Copie certifié CNI" readonly="" >
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[4]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="CN"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Certificat de nationalité" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[5]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="BN"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Bulletin N° 3" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[6]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="CV"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Cv" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[7]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="RA"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Rapport d’activité" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[8]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="LP"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Rapport d’activité" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="file" name="fichier[9]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="btn-toolbar" role="toolbar"
                                                                 aria-label="Toolbar with button groups"
                                                                 style="float: right;">
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="First group">
                                                                    <h5 class="bg-warning"><i
                                                                                class="fas fa-warning"></i>
                                                                        <b><u>NB:</u></b> Veillez enregistrer avant de
                                                                        passer à l'étape suivante ! </h5>
                                                                </div>
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="First group">
                                                                    <button type="submit" name="submit_etat_scolaire"
                                                                            class="btn btn-primary">Enregistrer
                                                                    </button>
                                                                </div>
                                                                <div class="btn-group mr-2" role="group"
                                                                     aria-label="Second group">
                                                                    <!--                                                                <a href="liste_personnels.php" class="btn btn-primary" style="float: right; padding-top: 10px; padding-bottom: 10px; margin-right: 20px"><i class="fas fa-angle-double-down"></i> Annuler</a>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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


    <!--//Footer-->
<?php
include('foot.php');
?>