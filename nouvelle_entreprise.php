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
                <h1 class="mt-4"> <i class="fas fa-building" style="color: silver"></i>Nouvelle entreprise</h1>
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
                                            <form action="save_entreprise.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Nom Entreprise<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="nom_en" required>
                                                        </div>
                                                    </div><?php if($lvl > 10){ ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Auteur<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="auteur" value="<?=$nom_user_perso?>" disabled>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Type d'entreprise <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="type_en">
                                                                <option value="N/A" selected="">...</option>
                                                                <option value="EI">Individuel</option>
                                                                <option value="EIRL">Individuel à responsabilité limitée</option>
                                                                <option value="EURL">Unipersonnel à responsabilité limitée</option>
                                                                <option value="SARL">Société à responsablité limitée</option>
                                                                <option value="SA">Société anonyme</option>
                                                                <option value="SNC">Société en nom colllectif</option>
                                                                <option value="SCS">Société en commandite simple</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Pays</label>
                                                            <select class="form-control" name="pays_en">
                                                                <option value="Cameroun" selected="">Cameroun</option>
                                                                <option value="USA">USA</option>
                                                                <option value="United Kingdom">United Kingdom
                                                                        </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Ville</label>
                                                            <select class="form-control" name="ville">
                                                                <option value="Yaounde" selected="">Yaoundé</option>
                                                                <option value="Douala">Douala</option>
                                                                <option value="Bamenda">Bamenda</option>
                                                            </select>
                                                        </div>
                                                    </div>  -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" type="email" name="email_en">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> Tel <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="tel_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Personne à contacter <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="pers_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Tel contact <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="contact_en" required >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Localisation<span class="text-danger">*</span>:</label>
                                                            <input class="form-control" type="text" name="localisation" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> NUI<span class="text-danger">*</span>: </label>
                                                            <input class="form-control" type="text" name="nui" required>
                                                        </div>
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