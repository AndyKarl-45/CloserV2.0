<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');
?>

<?php
$id=$_REQUEST['id'];

$query  = "SELECT * from demande_entreprise where id_dem_ent='".$id."'";
$q = $db->query($query);
while($row = $q->fetch())
{ 
    $id_dem_ent = $row['id_dem_ent'];
    $id_ing = $row['id_ing'];
    /*-------------------- ETAT CIVILE --------------------*/
    $ref_dem_ent = $row['ref_dem_ent'];
    $statut = $row['statut'];
    /*-------------------- INFOS RH --------------------*/
  
?>


<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Modifier Statut de la demande d'entreprise: <?=$ref_dem_ent?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    Hello M/Mme XXX, il est <?=date("G:i");?> en ce jour du <?=dateToFrench("now","l j F Y");?>.
                </li>
            </ol>

            <!--                Main Body-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">

                        <div class="card-header">
                         <ul class="nav nav-pills"   style="float: right;">
                                    <li class="nav-item">
                                       <a class="nav-link active" href="<?=$demande_entreprise['option2_link']?>">
                                        Annuler
                                        </a>
                                    </li>                                    
                                </ul>
                            <b>
                                <!-- Nav pills -->
                                <ul class="nav nav-pills">
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-cubes"></i>
                                            Etat Civile
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
                                    </li>  -->
<!--                                      <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu3">
                                            <i class="fas fa-user"></i>
                                            Information RH
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-plus"></i>
                                            Modifier son statut
                                        </a>
                                    </li>  
                                    
                                </ul>

                            </b>

                        </div>

                        <div class="card-body">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Etat Civile-->
                                

                                <!--ETAT ACADEMIQUE -->
                                

                                <!--                                    Courrier-->
                                
                                <!-- information RH -->
 


                                <!-- infos Paie -->
                                <div class="tab-pane container active" id="home">
                                    <!-- infos bulletin conge-->

                                   

                                    <div class="row">
                                        <hr/>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card mb-4">
                                                <form class="form-horizontal" action="update_statut_demande.php" method="POST">
                                                    <div class="card-header">
                                                       

                                                    </div>
                                                    <div class="card-body">
                                                        <fieldset>
                                                            <div class="table-responsive">
                                                                <table class="table  table-hover table-condensed" id="myTable">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <?php
                                                echo '<input name="id_dem_ent" type="hidden" value="'.$id_dem_ent.'">';
                                                ?>
                                                                             <span class="help-block small-font" >STATUT</span>
                                                                            
                                                                            <div class="col">
                                                                                <select name="statut" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" >
                                                                                    <option value="<?=$statut?>" selected=""><?=$statut?></option>
                                                                                    <option value="Approuver">Approuver</option>
                                                                                    <option value="Rejeter">Rejeter</option>
                                                                                    <option value="Envoyer">Envoyer</option>
                                                                                   
                                                                                    

                                                                                    
                                                                                </select>
                                                                                <!-- <button type="button" data-toggle="modal" data-target="#ajouterStatut"  style="background-color: transparent">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button> -->
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



    <!--//Footer-->
<?php
include('foot.php');
?>