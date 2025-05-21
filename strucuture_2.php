<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content"> 
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class=" fas fa-user-graduate" style="color: silver"></i> Nouveau Ingénieur</h1>
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
                                        <a class="nav-link active" href="<?=$ingenieur['option2_link']?>">
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
                                <ul class="nav nav-pills" style="float: right;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="<?=$ingenieur['option2_link']?>">
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
                                                            <label> Nom<span class="text-danger">*</span></label>
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
                <!--****************************Etat acadaméique**************************-->
            <div class="tab-pane container" id="menu1">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                               
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


    <!--//Footer-->
<?php
include('foot.php');
?>