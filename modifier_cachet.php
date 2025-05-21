<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');


$id=$_REQUEST['id'];

$query  = "SELECT * from demande_cachet where id_cachet='".$id."'";
$q = $db->query($query);
while($row = $q->fetch())
{ 
    $id_cachet = $row['id_cachet'];
    /*-------------------- ETAT CIVILE --------------------*/
    $matricule = $row['matricule'];
    $id_ing = $row['id_ingenieur'];
    $statut = $row['statut'];
    $tel = $row['tel'];
    $recu = $row['recu'];
    $ville = $row['ville'];
    $date_cachet = $row['date_cachet'];
    $annee = $row['annee'];

    $sql = "SELECT * from mytable where id_ingenieur = '$id_ing'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                                                }
    $sql = "SELECT * from statut_cachet where id_statut = '$statut'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom=$table['nom'];
                                                                }
?> 

    <!--Content-->

    <div id="layoutSidenav_content"> 
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class=" fas fa-user-graduate" style="color: silver"></i> Modifier Cachet: <?php echo $nom_ing?></h1>
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
                                        <a class="nav-link active" href="<?=$demande_cachet['option2_link']?>">
                                            Retour
                                        </a>
                                    </li>                              
                                </ul>
                                <!-- Nav pills -->
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-plus"></i>
                                        Modifier <!-- <?=$id_personnel?> --> 
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
                                            <form action="update_cachet.php" method="POST">
                                                <div class="row">
                                                    <input  type="hidden" name="id_cachet"  value="<?=$id_cachet?>">
                                                    <!-- <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label>Matricule<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="matricule">
                                                        </div>
                                                    </div> -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                        <label>Ingénieur</label>
                                                            <select class="form-control" name="id_ing">
                                                               <option value="<?=$id_ing?>" selected=""><?=$nom_ing?></option>
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
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Téléphone</label>
                                                            <input class="form-control" type="text" name="tel" value="<?=$tel?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Numéro de Recue:<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$recu?>" name="recu" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Ville: <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$ville?>" name="ville" >
                                                        </div>
                                                    </div>
                                                   <div class="col-sm-6">
                                                        <div class="form-group">
                                                             <label>Statut</label>
                                                            <select class="form-control" name="id_statut">
                                                               <option value="<?=$statut?>" selected=""><?=$nom?></option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM  statut_cachet");

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
                                                             <label>Année</label>
                                                                    <select class="form-control" name="annee" >
                                                                    <?php
                                                                    $an_dernier = date("Y");
                                                                    $an_premier=1970;
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
                                                    </div>
                                                   
                                                    
                                                </div>
                                               
                                                
                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="<?=$demande_cachet['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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
<?php
    }
?>

    <!--//Footer-->
<?php
include('foot.php');
?>