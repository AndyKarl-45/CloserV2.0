<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

?>
<?php
$id_ingenieur = $_REQUEST['id'];

$query = "SELECT * from mytable where id_ingenieur='" . $id_ingenieur . "'";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_ingenieur = $row['id_ingenieur'];
    $id_personnel = $row['id_ingenieur'];

    /*-------------------- DETAILS INGENIEURS  --------------------*/
    $nom_ing = $row['nom_ing'];
    $prenom_ing = $row['prenom_ing'];
    $num_ordre = $row['num_ordre'];
    $tel_ing = $row['tel_ing'];
    $email_ing = $row['email_ing'];
    $matricule = $row['matricule'];
    $id_ville = $row['id_ville'];
    $genre= $row['genre'];
    $date_naissance=$row['date_naissance'];
    $lieu_naissance=$row['lieu_naissance'];
    $date_inscription=$row['date_inscription'];
    $annee=$row['annee'];



    ?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class=" fas fa-user-graduate" style="color: silver"></i> Détails des membres: </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .
                    </li>
                </ol>
                <!--                Main Body-->

                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">Profil</h4>
                    </div>

                    <?php if($lvl == 11 || $lvl > 13){ ?>
                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <a href="modifier_ingenieur.php?id=<?=$id_ingenieur?>" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i>
                            Editer Profil</a>
                    </div>
                    <?php } ?>
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="assets/img/doctor-03.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?= $nom_ing.' '.$prenom_ing ?></h3>
                                                <small class="text-muted"></small>
                                                <div class="staff-id">Matricule: <?= $matricule?></div>
                                                <div class="staff-id">Année d’inscription: <?php      if($annee!=""){
     
        echo $annee;
    }else{ echo 'N/A'; }?></div>
                                                <div class="staff-msg"><a href="#" class="btn btn-primary">Send
                                                        Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">N° Ordre:</span>
                                                    <span class="text"><?php if($num_ordre==""){echo 'N/A';}else{echo $num_ordre;} ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">tel:</span>
                                                    <span class="text"><a href="#"><?php if($tel_ing==""){echo 'N/A';}else{echo $tel_ing;} ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php if($email_ing==""){echo 'N/A';}else{echo $email_ing;}?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?php if($date_naissance==""){echo 'N/A';}else{echo $date_naissance;} ?>.</span>
                                                </li>
                                                <li>
                                                    <span class="title">Ville:</span>
                                                    <?php

                                                    if($id_ville==0){

                                                        $nom_ville='N/A';
                                                        echo'<span class="text">'.$nom_ville.'</span>';

                                                    }else{

                                                    $sql = "SELECT * FROM ville where id_ville='$id_ville' ";
                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();

                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($tables as $table) {
                                                        
                                                    $nom_ville=$table['nom'];
                                                    
                                                     echo'<span class="text">'.$nom_ville.'</span>';
                                                    
                                                     }  
                                                } 
                                                ?>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php if($genre==""){echo 'N/A';}else{echo $genre;} ?></span>
                                                </li>
                                                <!-- <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?= $date_aniv_p ?></span>
                                                </li> -->
                                                <!-- <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text"><?= $adresse_p ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?= $genre_p ?></span>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Profile</a>
                        </li>
                         <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Cotisation</a></li>
                       <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Frais d'attestation</a>
                        </li>
                         <li class="nav-item"><a class="nav-link" href="#bottom-tab4" data-toggle="tab">Attestation d'entreprise</a></li>
                       <li class="nav-item"><a class="nav-link" href="#bottom-tab5" data-toggle="tab">Attestation particulier</a>
                        </li>
                         <li class="nav-item"><a class="nav-link" href="#bottom-tab6" data-toggle="tab">Dossier de l'ingénieur </a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab7"
                                                data-toggle="tab"> Academique</a></li>
                       <li class="nav-item"><a class="nav-link" href="#bottom-tab8" data-toggle="tab">Professionnel</a>
                        </li> 
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab9" data-toggle="tab">Dettes</a>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="about-cont">
                           <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <form action="save_ingenieur.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label>Matricule<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="matricule" value="<?=$matricule?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Nom<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="nom_ing"
                                                                   value="<?=$nom_ing?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input class="form-control" type="text" value="<?=$prenom_ing?>" disabled>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Username <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="username"
                                                                   required="required">
                                                        </div>
                                                    </div> -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Email <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="email" value="<?=$email_ing?>" disabled>
                                                        </div>
                                                    </div>
                                                   <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>N° Ordre <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" value="<?=$num_ordre?>" disabled>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Phone </label>
                                                            <input class="form-control" type="text" value="<?=$tel_ing?>" disabled>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                               
                                            </form>
                                        </div>
                                    </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab2">
                            <div class="table-responsive">
                            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr style="background-color: #dde9dd">
                                    <th>Ref_cotisation</th>
                                    <!--<th>Caisse</th>-->
                                    <th>Année</th>
                                    <th>Ingénieur</th>
                                    <th>Somme</th>
                                    <th>Payer</th>
                                    <th>solde</th>
                                    <th>Etat</th>
                                    <th class="text-right"><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $query = "SELECT * from cotisation where open_close!='1' and id_ing='$id_ingenieur' order by annee,ref_ing_cost asc";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_cotisation = $row['id_cotisation'];
                                    $id_caisse = $row['id_caisse'];
                                    $annee = $row['annee'];
                                    $ref_ing_cost = $row['ref_ing_cost'];
                                    $id_ing = $row['id_ing'];
                                    $somme = $row['somme'];
                                    $payer = $row['payer'];
                                    $solde= $somme-$payer;
                                    $etat = $row['etat'];
                                    
                                    
                                    


                                                        //  $sql = "SELECT DISTINCT caisse from caisse where id_caisse = '$id_caisse'";

                                                        //         $stmt = $db->prepare($sql);
                                                        //         $stmt->execute();

                                                        //         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                        //         foreach($tables as $table)
                                                        //         {
                                                        //             $caisse=$table['caisse'];
                                                        //         }

                                                        $sql = "SELECT DISTINCT nom_ing from mytable where id_ingenieur = '$id_ing'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom_ing=$table['nom_ing'];
                                                                }

                                                                $sql="SELECT YEAR('$annee') as total  ";
                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                    {
                                                                        $annee=$table['total'];
                                                                    }

                                    
                                    
             
                                    ?>
                                    <tr>
                                       <input name="id" type="hidden"
                                                                       value="<?php echo $id_cotisation ?>"/>
                                                                <td><a
                                                                            href="#"
                                                                            title="<?= $ref_ing_cost; ?>"
                                                                            style="color: black"><?=$ref_ing_cost?></a>
                                                                </td>
                                                                <td ><a
                                                                            href="#"
                                                                            title="<?= $annee; ?>"
                                                                            style="color: black"><?= $annee; ?></a></td>
                                                                <td><a
                                                                            href="#"
                                                                            title="<?= $nom_ing; ?>"
                                                                            style="color: black"><?= $nom_ing; ?></a>
                                                                </td>
                                                                <td ><a
                                                                            href="#"
                                                                            title="<?= number_format($somme); ?>"
                                                                            style="color: black"><?= number_format($somme) ?> </a>
                                                                </td>
                                                                
                                                                
                                                                <td ><a
                                                                            href="#"
                                                                            title="<?= number_format($payer); ?>"
                                                                            style="color: black"><?= number_format($payer); ?></a></td>

                                                                <td ><a
                                                                            href="#"
                                                                            title=""
                                                                            style="color: black"><?= number_format($solde); ?></a></td>
                                                                <td ><a
                                                                            href="#"
                                                                            title=""
                                                                            style="color: black"><?= $etat ?></a></td>
                                                                <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab3">
                         <div class="table-responsive">
                             <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Ref_attestation</th>
                                    <th>Caisse</th> 
                                    <th>Bénéficiaire</th>
                                    <th>Responsable</th>
                                    <th>Solde</th>
                                    <th>Date</th>
                                    <th>PDF</th>
                                    <th class="text-right"><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php

                                $query = "SELECT * from droit_attestation where open_close!='1' and id_ing
                                ='$id_ingenieur' order by date_att, ref_ing_att asc";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_attestation = $row['id_attestation'];
                                    $ref_ing_att = $row['ref_ing_att'];
                                    $id_caisse = $row['id_caisse'];
                                    $id_ing = $row['id_ing'];
                                    $id_perso = $row['id_perso'];
                                    $date_att = $row['date_att'];
                                    $montant = $row['montant'];

                                        $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom=$table['nom'].' '.$table['prenom'];
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
                                                                }

                                    ?>

                                <tr>
                                    <td><a href="#"><?=$ref_ing_att?></a></td>
                                    <td><a href="#"><?=$caisse?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom_ing?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom?></a></td>
                                    <td><a href="#"><?= number_format($montant)?></a></td>
                                    <td><a href="#"><?=$date_att?></a></td>
                                    <td align="center"><a href="#" target="_blank">
                                            <i class='fa fa-print'></i>
                                        </a></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fas fa-random"></i>
                                                    Transférer</a>
                                                <a class="dropdown-item" href="edit-patient.html"><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab4">
                          <div class="table-responsive">
                            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Ref_DE</th> 
                                    <th>Annee</th>
                                    <th>Matricule</th>
                                    <th>Nom ingénieur</th>
                                    <th>Entreprise</th>
                                     <th>Responsable</th>
                                    <th>Objet</th>
                                    <th>PDF</th>
                                   <!--  <th class="text-right"><i class="fas fa-bars"></i></th> -->
                                </tr>
                                </thead>
                                <tbody>
                                    <?php

                                $query = "SELECT * from demande_entreprise where id_ing = '$id_ingenieur' order by date_dem_ent asc";
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
                                    $id_perso = $row['id_perso'];

                                    $nom_en='N/A';
                                    $nom='N/A';

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
                                        $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom=$table['nom'].' '.$table['prenom'];
                                                                }

                                        $sql="SELECT YEAR('$date_dem_ent') as total  ";
                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                    {
                                                                        $annee=$table['total'];
                                                                    }

                                    ?>

                                <tr>
                                    <td><a href="#"><?=$ref_dem_ent?></a></td>
                                    <td><a href="#"><?=$annee?></a></td>
                                    <td><a href="#"><?=$matricule?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom_ing?></a></td>
                                    <td><a href="#"><?=$nom_en?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom?></a></td>
                                    <td><a href="#"><?=$objet?></a></td>
                                     <td align="center">
                                         <?php 
                                            if($agreed==0){
                                         ?>
                                                <a href="attestation.php?id=<?=$id_dem_ent?>" target="_blank">
                                            <i class='fa fa-print'></i>
                                       
                                        <?php
                                            }else{
                                        ?>
                                                <a href="#" target="_blank">
                                            <i class='fa fa-print'></i>
                                        <?php
                                            }
                                        ?>
                                         
                                        </a></td>
                                   <!-- <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fas fa-random"></i>
                                                    Transférer</a>
                                                <a class="dropdown-item" href="edit-patient.html"><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td> -->
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab5">
                            <div class="table-responsive">
                            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Ref_DP</th> 
                                    <th>Annee</th>
                                    <th>Matricule</th>
                                    <th>Nom ingénieur</th>
                                     <th>Responsable</th>
                                   <th>PDF</th>
                                    <!--  <th class="text-right"><i class="fas fa-bars"></i></th> -->
                                </tr>
                                </thead>
                                <tbody>
                                    <?php

                                $query = "SELECT * from demande_particulier where id_ing = '$id_ingenieur'  order by date_dem_part asc";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_dem_part = $row['id_dem_part'];
                                    $ref_dem_part = $row['ref_dem_part'];
                                    $id_caisse = $row['id_caisse'];
                                    $id_ing = $row['id_ing'];
                                     $droit = $row['droit'];
                                    $statut = $row['statut'];
                                    $date_dem_part = $row['date_dem_part'];
                                    $id_perso = $row['id_perso'];

                                    
                                    $nom='N/A';

                                        

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
                                        $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom=$table['nom'].' '.$table['prenom'];
                                                                }

                                        $sql="SELECT YEAR('$date_dem_part') as total  ";
                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                    {
                                                                        $annee=$table['total'];
                                                                    }

                                    ?>

                                <tr>
                                    <td><a href="#"><?=$ref_dem_part?></a></td>
                                    <td><a href="#"><?=$annee?></a></td>
                                    <td><a href="#"><?=$matricule?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom_ing?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom?></a></td>
                                     <td align="center"><a href="attestation_part.php?id=<?=$id_dem_part?>" target="_blank">
                                            <i class='fa fa-print'></i>
                                        </a></td>
                                  <!--  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fas fa-random"></i>
                                                    Transférer</a>
                                                <a class="dropdown-item" href="edit-patient.html"><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td> -->
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab6">

                                        < <h5><b><u>NB:</u></b> Veillez saisir vos informations consernant votre dossier</h5>

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <form class="form-horizontal" action="file_folder_ing.php"
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
                                                                                       class="form-control" value="Demande d'inscritpion" readonly="">
                                                                            </td>
                                                                            
                                                                            <td>
                                                                                <?php 
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM pj_di where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        $nom='pj_di';
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[0]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="PCDD"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Photocopie certifiée du diplôme d’ingénieur" readonly="">
                                                                            </td>
                                                                            <td>
                                                                              <?php 

                                                                              $nom='pj_pcdd';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[1]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="APODI"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Attestation de présentation de l’original du diplôme d’ingénieur" readonly="">
                                                                            </td>
                                                                            <td>
                                                                               <?php 

                                                                              $nom='pj_apodi';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[2]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="PCB"
                                                                                       style="width:100%"
                                                                                       class="form-control"  value=" Photocopie certifiée du bacc" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <?php 

                                                                              $nom='pj_pcb';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[3]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="CCC"
                                                                                       style="width:100%"
                                                                                       class="form-control" value=" Copie certifié CNI" readonly="" >
                                                                            </td>
                                                                            <td>
                                                                                <?php 

                                                                              $nom='pj_ccc';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[4]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="CN"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Certificat de nationalité" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <?php 

                                                                              $nom='pj_cn';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[5]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="BN"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Bulletin N° 3" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <?php 

                                                                              $nom='pj_bn';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[6]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="CV"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Cv" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <?php 

                                                                              $nom='pj_cv';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[7]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="RA"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Rapport d’activité" readonly="">
                                                                            </td>
                                                                            <td>
                                                                                <?php 

                                                                              $nom='pj_ra';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[8]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="LP"
                                                                                       style="width:100%"
                                                                                       class="form-control" value="Rapport d’activité" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <?php 

                                                                              $nom='pj_lp';
                                                                                    $sql="SELECT count(id_entite) as total,lien,nom_pj FROM $nom where id_entite='$id_personnel' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        $count=$table['total'];
                                                                                        $lien=$table['lien'];
                                                                                        $nom_pj=$table['nom_pj'];
                                                                                        
                                                                                   }
                                                                                if($count==0){

                                                                                ?>

                                                                                <input type="file" name="fichier[9]"
                                                                                       style="width:100%"
                                                                                       class="form-control">
                                                                                <?php
                                                                                    }else{
                                                                                ?>
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                        
                                                        <tbody>

                                                            <tr>
                                                                
                                                                <td align="center"><a href="<?php echo  $lien; ?>"><?php echo $nom_pj; ?></a></td>
                                                                <td style="width:8%"><a class="btn btn-danger"  href="delete_pj_ing.php?id=<?=$id_personnel?>&pj=<?=$nom?>"  style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                        </td>
                                                            </tr>
                                                    </tbody>
                                                        
                                                    </table>
                                                                                <?php
                                                                                    }
                                                                               ?>
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
                                            <button type="submit" name="submit_etat_civil" class="btn btn-primary" >Enregistrer</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="Second group">
                                            
                                        </div>
                                    </div> 
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

            
                        </div>
                        <div class="tab-pane" id="bottom-tab7">
                                    <!-- infos civile-->

                                   <!--  <h5><b><u>NB:</u></b> Veillez saisir vos informations concernant le traitement de ressource humaine</h5> -->

            


                                    <div class="row">
                                        <hr/>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card mb-4">
                             <div class="card-header">
                                <i class="fas fa-scroll"></i>
                                <b>L'ensemble de mes etats academique .</b>
                                                            <b> 
                                
                                <!-- Nav pills -->
                                <ul class="nav nav-pills"   style="float: right;">
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="liste_pj_aca.php?id_personnel=<?=$id_ingenieur?>">
                                            <i class="fas fa-cubes"></i>
                                            Liste des Pièces jointes <!-- <?=$id_personnel?> -->
                                        </a>
                                    </li>                                    
                                </ul>
                            </b>
                            </div>
                            <div class="card-body">
                                <div class="well bs-component">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="table-responsive">
                                                <form method="post" action="" >
                                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                                                    <thead>
                                                                        <tr class="bg-primary">
                                                                            <th>Dilplôme</th>
                                                                            <th>Session</th>
                                                                            <th>École</th>
                                                                            <th>Mention</th>
                                                                            <!-- <th>PJ (scan du diplome)</th>  -->
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr class="bg-primary">
                                                                            <th>Dilplôme</th>
                                                                            <th>Session</th>
                                                                            <th>École</th>
                                                                            <th>Mention</th>
                                                                             <!-- <th>PJ (scan du diplome)</th> -->
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody>
<?php

                        $query = "SELECT  count(id_perso) as total from etat_academique where id_perso='".$id_ingenieur."' ";
                                                                $stmt = $db->prepare($query);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach($tables as $table)
                                                            {
                                                                $total=$table['total'];
                                                            // echo $total;
                                                        }
                if ($total>0){

                        $query = "SELECT* from etat_academique where id_perso='".$id_ingenieur."'";
                                             $q = $db->query($query);
                                             while($row = $q->fetch())
                                                {
                                                  
                                                            $diplome= $row['diplome'];
                                                            $session = $row['session'];
                                                            $ecole = $row['ecole'];
                                                            $mention = $row['mention'];
                                                            
                                                           
                                                        
                                                            


                                                                       echo '<tr>
                                                                           
                                                                            <td>
                                                                                <input name="diplome[]" style="width:100%" class="form-control" value="'.$diplome.'" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]" style="width:100%" class="form-control" value="'.$session.'" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%" class="form-control" value="'.$ecole.'" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]" style="width:100%" class="form-control" value="'.$mention.'" readonly>
                                                                            </td>
<!--                                                                             <td>

                                                                                <input type="file" name="fichier_aca[]" style="width:100%" class="form-control" readonly>
                                                                            </td> -->  
                                                                        </tr>';
                                                }

                                                                    }else{

                                                                   echo' <tr>
                                                                           
                                                                            <td>
                                                                                <input name="diplome[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <!-- <td>
                                                                                <input type="file" name="fichier[0]"  value="0" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                          <!--   <td>
                                                                                <input type="file" name="fichier[1]" value="0" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                          <!--   <td>
                                                                                <input type="file" name="fichier[2]" value="0" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                         <!--    <td>
                                                                                <input type="file" name="fichier[3]" value="0" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="diplome[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="month" name="session[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="ecole[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="mention[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                           <!--  <td>
                                                                                <input type="file" name="fichier[4]" value="0" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>';






                                                                    
                                                                

                                                            }
                                                            ?>
                                            
                                                                    </tbody>
                                                                </table>
                                                </form>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                                                   
                        </div>
                    </div>
                </div>
            
                        </div>
                        <div class="tab-pane" id="bottom-tab8">
                                    <!-- infos civile-->

                                   <!--  <h5><b><u>NB:</u></b> Veillez saisir vos informations concernant le traitement de ressource humaine</h5> -->

            


                                    <div class="row">
                                        <hr/>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card mb-4">
                             <div class="card-header">
                                <i class="fas fa-scroll"></i>
                                <b>L'ensemble de mes etats professionnels</b>
                                                            <b> 
                                
                                <!-- Nav pills -->
                                <ul class="nav nav-pills"   style="float: right;">
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="liste_pj_prof.php?id_personnel=<?=$id_ingenieur?>">
                                            <i class="fas fa-cubes"></i>
                                            Liste des Pièces jointes <!-- <?=$id_personnel?> -->
                                        </a>
                                    </li>                                    
                                </ul>
                            </b>
                            </div>
                            <div class="card-body">
                                <div class="well bs-component">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="table-responsive">
                                                <form method="post" action="" >
                                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                                                    <thead>
                                                                    <tr class="bg-primary">
                                                                        <th>Entreprises</th>
                                                                        <th>Reférences <br/> "Nom (Téléphone) du responsable"</th>
                                                                        <th>Fonction</th>
                                                                        <th>Date d'arrivé</th>
                                                                        <th>Date de départ</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                    <tr class="bg-primary">
                                                                        <th>Entreprises</th>
                                                                        <th>Reférences <br/> "Nom (Téléphone) du responsable"</th>
                                                                        <th>Fonction</th>
                                                                        <th>Date d'arrivé</th>
                                                                        <th>Date de départ</th>
                                                                    </tr>
                                                                    </tfoot>
                                                                    <tbody>
<?php

                        $query = "SELECT  count(id_perso) as total from etat_professionnel where id_perso='".$id_ingenieur."' ";
                                                                $stmt = $db->prepare($query);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach($tables as $table)
                                                            {
                                                                $total=$table['total'];
                                                            // echo $total;
                                                        }
                if ($total>0){

                        $query = "SELECT* from etat_professionnel where id_perso='".$id_ingenieur."'";
                                             $q = $db->query($query);
                                             while($row = $q->fetch())
                                                {
                                                  
                                                            $id= $row['id_etat_professionnel'];
                                                            $entreprise= $row['entreprise'];
                                                            $reference = $row['reference'];
                                                            $fonction = $row['fonction'];
                                                            $date_arrive = $row['date_arrive'];
                                                            $date_depart = $row['date_depart'];
                                                            
                                                            
                                                                       echo '<tr>
                                                                           
                                                                            <td>
                                                                                <input name="entreprise[]" style="width:100%" class="form-control" value="'.$entreprise.'" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input  name="reference[]" style="width:100%" class="form-control" value="'.$reference.'" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]" style="width:100%" class="form-control" value="'.$fonction.'" readonly >
                                                                            </td>
                                                                            <td>
                                                                                <input type="date" name="date_arrive[]" style="width:100%" class="form-control" value="'.$date_arrive.'" readonly>
                                                                            </td>                                                                      <td>
                                                                                <input type="date" name="date_depart[]" style="width:100%" class="form-control" value="'.$date_depart.'" readonly>
                                                                            </td>                                                                    
<!--                                                                             <td>

                                                                                <input type="file" name="fichier_prof[]" style="width:100%" class="form-control">
                                                                            </td> --> 
                                                                        </tr>';
                                                }

                                                                    }else{

                                                                   echo' <tr>                                                                            

                                                                            <td style="width: 20%">
                                                                                <input name="entreprise[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td style="width: 20%">
                                                                                <input name="reference[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td style="width: 20%">
                                                                                <input name="fonction[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td style="width: 10%">
                                                                                <input name="date_arrive[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td style="width: 10%">
                                                                                <input name="date_depart[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                    <!--        <td style="width: 20%">
                                                                                <input type="file" name="fichier[]" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                       <!--     <td>
                                                                                <input type="file" name="fichier[]" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                         <!--   <td>
                                                                                <input type="file" name="fichier[]" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]" style="width:100%" class="form-control"readonly >
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                          <!--  <td>
                                                                                <input type="file" name="fichier[]" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input name="entreprise[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="reference[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="fonction[]" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_arrive[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input name="date_depart[]" type="date" style="width:100%" class="form-control" readonly>
                                                                            </td>
                                                                            <td>
                                                                               <!-- <input type="file" name="fichier[]" style="width:100%" class="form-control">
                                                                            </td> -->
                                                                        </tr>';
                                                        }
                                                            ?>
                                                                    </tbody>
                                                                </table>
                                                </form>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                                                   
                        </div>
                    </div>
                </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab9">
                            <div class="table-responsive">
                                <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                    <thead>
                                    <tr style="background-color: #dde9dd">
                                        <th>Ref_cotisation</th>
                                        <!--<th>Caisse</th>-->
                                        <th>Année</th>
                                        <th>Ingénieur</th>
                                        <th>Somme</th>
                                        <th>Payer</th>
                                        <th>Reste</th>
                                        <th>Etat</th>
                                        <th class="text-right"><i class="fas fa-bars"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $query = "SELECT * from dette where id_ing='$id_ingenieur' and open_close!='1' order by nom_ing asc";
                                    $q = $db->query($query);
                                    while ($row = $q->fetch()) {
                                        $id_dette = $row['id_dette'];
                                        $id_caisse = $row['id_caisse'];
                                        $annee = $row['annee'];
                                        $ref_ing_det = $row['ref_ing_det'];
                                        $id_ing = $row['id_ing'];
                                        $nom_ing = $row['nom_ing'];
                                        $somme = $row['somme'];
                                        $payer = $row['payer'];
                                        $solde= $somme-$payer;
                                        $etat = $row['etat'];





                                        // $sql = "SELECT DISTINCT caisse from caisse where id_caisse = '$id_caisse'";

                                        // $stmt = $db->prepare($sql);
                                        // $stmt->execute();

                                        // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        // foreach($tables as $table)
                                        // {
                                        //     $caisse=$table['caisse'];
                                        // }

                                        $sql = "SELECT DISTINCT nom_ing, prenom_ing from mytable where id_ingenieur = '$id_ing'";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();

                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($tables as $table)
                                        {
                                            $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                        }

//                                    $sql="SELECT YEAR('$annee') as total  ";
//                                    $stmt = $db->prepare($sql);
//                                    $stmt->execute();
//
//                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//                                    foreach($tables as $table)
//                                    {
//                                        $annee=$table['total'];
//                                    }




                                        ?>
                                        <tr>
                                            <input name="id" type="hidden"
                                                   value="<?php echo $id_dette ?>"/>
                                            <td><a
                                                        href="#"
                                                        title="<?= $ref_ing_det; ?>"
                                                        style="color: black"><?=$ref_ing_det?></a>
                                            </td>
                                            <td ><a
                                                        href="#"
                                                        title="<?= $annee; ?>"
                                                        style="color: black"><?= $annee; ?></a></td>
                                            <td><a
                                                        href="#"
                                                        title="<?= $nom_ing; ?>"
                                                        style="color: black"><?= $nom_ing; ?></a>
                                            </td>
                                            <td ><a
                                                        href="#"
                                                        title="<?= number_format($somme); ?>"
                                                        style="color: black"><?= number_format($somme) ?> </a>
                                            </td>


                                            <td ><a
                                                        href="#"
                                                        title="<?= number_format($payer); ?>"
                                                        style="color: black"><?= number_format($payer); ?></a></td>

                                            <td ><a
                                                        href="#"
                                                        title=""
                                                        style="color: black"><?= number_format($solde); ?></a></td>
                                            <td >
                                                <?php if($etat=='OK')
                                                    echo'<a
                                                                            href="#"
                                                                            title=""
                                                                            style="color: black"><span class="custom-badge status-green">Ok</span></a>';
                                                else
                                                    echo'<a
                                                                            href="#"
                                                                            title=""
                                                                            style="color: black"><span class="custom-badge status-red">Pas à Jour</span></a>';
                                                ?>

                                            </td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                       aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                    class="fas fa-pen"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" ><i class="fas fa-trash"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab10">
                            Tab content 8
                        </div>
                        <div class="tab-pane" id="bottom-tab11">
                            Tab content 8
                        </div>
                        <div class="tab-pane" id="bottom-tab12">
                            Tab content 8
                        </div>



                    </div>
                </div>
            </div>

            <!--                Main Body-->
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>

    </div>
    </main>
    </div>
    <?php
}
?>
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

    }
}
?>

    <!--//Footer-->
<?php
include('foot.php');
?>