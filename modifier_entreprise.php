<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

?>
<?php
$id=$_REQUEST['id'];

$query  = "SELECT * from entreprise where id_entreprise='".$id."'";
$q = $db->query($query);
while($row = $q->fetch())
{ 
    $id_entreprise = $row['id_entreprise'];
    /*-------------------- ETAT CIVILE --------------------*/
    $nom_en = $row['nom_en'];
    $type_en = $row['type_en'];
    $tel_en = $row['tel_en'];
    $pers_en = $row['pers_en'];
    $contact_en = $row['contact_en'];
    $email_en = $row['email_en'];
    $localisation = $row['localisation'];
    $nui = $row['nui'];
    

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"> <i class="fas fa-building" style="color: silver"></i>Modifier entreprise: <?=$nom_en?></h1>
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
                                            <form action="update_entreprise.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input  type="hidden" name="id_entreprise" value="<?=$id_entreprise?>">
                                                            <label>Nom Entreprise<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="nom_en" value="<?=$nom_en?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Type d'entreprise</label>
                                                            <select class="form-control" name="type_en">
                                                                <option value="<?=$type_en?>" selected=""><?=$type_en?></option>
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
                                                            <input class="form-control" type="email" name="email_en" value="<?=$email_en?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> Tel<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="tel_en" value="<?=$tel_en?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Personne à contacter<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="pers_en" value="<?=$pers_en?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Tel contact<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="contact_en" value="<?=$contact_en?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Localisation<span class="text-danger">*</span>:</label>
                                                            <input class="form-control" type="text" name="localisation" value="<?=$localisation?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> NUI<span class="text-danger">*</span>:</label>
                                                            <input class="form-control" type="text" name="nui" value="<?=$nui?>" required>
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


    <!--    Modal pour ajouter Categorie Contrat-->


    <!--//Footer-->
<?php
include('foot.php');
?>