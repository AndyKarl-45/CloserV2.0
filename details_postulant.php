<?php

include('first.php');
include('php/main_side_navbar.php');

?>
<?php
$id=$_REQUEST['id'];

$query  = "SELECT * from mytable where id_ingenieur='".$id."'";
$q = $db->query($query);
while($row = $q->fetch())
{ 
    $id_personnel = $row['id_ingenieur'];
    /*-------------------- ETAT CIVILE --------------------*/
    $matricule = $row['matricule'];
    $nom= $row['nom_ing'];
    $prenom = $row['prenom_ing'];
    $id_card_number = $row['id_card_number'];
    $id_card_validity = $row['id_card_validity'];
    $tel=$row['tel_ing'];
    $email=$row['email_ing'];
    $date_naissance=$row['date_naissance'];
    $lieu_naissance=$row['lieu_naissance'];
    $profession=$row['profession'];
    $situation_matrimoniale=$row['situation_matrimoniale'];
    $nombre_enfants=$row['nombre_enfants'];
    $genre=$row['genre'];
    $id_quartier=$row['id_quartier'];
    $id_ville=$row['id_ville'];
    $id_pays=$row['id_pays'];

    /*-------------------- INFOS RH --------------------*/

  

?>

<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class=" fas fa-id-card-alt" style="color: silver"></i> Détails du Postulant : <?= $nom.' '.$prenom ?> </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    Hello M/Mme, il est <?=date("G:i");?> en ce jour du <?=dateToFrench("now","l j F Y");?>.
                </li>
            </ol>
            <!--                Main Body-->
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
                                <?php if($lvl > 14 || $lvl == 11){ ?>
                                <ul class="nav nav-pills"   style="float: right; margin-right: 20px ;">
                                    <li class="nav-item">
                                        <a class="nav-link" href="modifier_post.php?id=<?=$id_personnel?>">
                                            <i class="fas fa-pen"></i>
                                           Edit Profil
                                        </a>
                                    </li>                                   
                                </ul>
                                <?php } ?>
                                <!-- Nav pills -->
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-cubes"></i>
                                            Civile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu1">
                                            <i class="fas fa-building"></i>
                                            Frais de Dossier
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu2">
                                            <i class="fas fa-building"></i>
                                            Academique
                                        </a>
                                    </li>
                             <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu3">
                                            <i class="fas fa-users"></i>
                                            Professionnel
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu5">
                                            <i class="fas fa-users"></i>
                                            Dossier du Postulant
                                        </a>
                                    </li> 
<!--                                  <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu3">
                                            <i class="fas fa-cubes"></i>
                                             Information RH
                                        </a>
                                    </li>  
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu4">
                                            <i class="fas fa-bars"></i>
                                            Infos Paie
                                        </a>
                                    </li>    -->                               
                                </ul>
                            </b>
                        </div>

                        <div class="card-body">
                            <!-- Tab panes -->
                            <div class="tab-content">
<!--******************************************** ETAT CIVILE************************************************* -->
                                <!-- Etat Civile-->
                                <div class="tab-pane container active" id="home">
                                    <!-- infos civile-->

                                    <!-- <h5><b><u>NB:</u></b> Aucune information ne peut être modifier.</h5> -->

                                    <div class="row">
                                        <hr/>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card mb-4">
                                                <form class="form-horizontal" action="#" method="POST">
                                                    <div class="card-header">
                                                       <!--  <i class="fas fa-scroll"></i>
                                <b>L'ensemble des salles de campresj.</b>
                                                             -->

                                                    </div>
                                                    <div class="card-body">
                                                        <fieldset>
                                                            <div class="table-responsive">
                                                               
                                                            <form method="post" action="" >
                                                                 <table class="table  table-hover table-condensed" >
                                                                    <tbody>

                                                                    <tr>

                                                                        <td>
                                                                            <span class="help-block small-font" >NOM</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;border-top: 0; 
                                                                                border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;"  value="<?=$nom?>" readonly>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >PRENOM</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;border-top: 0; 
                                                                                border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" value="<?=$prenom?>"  readonly>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >N° CNI ou PASSPORT</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0;
                                                                                 border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" value="<?=$id_card_number?>"  readonly>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >DATE D'EXPIRATION CNI</span>
                                                                            <div class="col">
                                                                                <input type="date" style="width:75%;border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" value="<?=$id_card_validity?>"  readonly>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >TEL</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" value="<?=$tel?>"  readonly>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >EMAIL</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" type="email" value="<?=$email?>" readonly>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >DATE DE NAISSANCE</span>
                                                                            <div class="col">
                                                                                <input type="date" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" value="<?=$date_naissance?>"  readonly>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >LIEU DE NAISSANCE</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" value="<?=$lieu_naissance?>"  readonly>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                
                                                                <tr>
                                                                         <td>
                                                                        <span class="help-block small-font" >VILLE</span>
                                                                            <div class="col">
                                                                                <select name="id_ville" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" readonly>
                                                                                    <option value="" selected>
                                                                 <?php

                                                                     $sql="SELECT * FROM ville where id_ville='$id_ville' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        echo $table['nom'];
                                                                                   }
                                                                          ?>
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                           <span class="help-block small-font" >QUARTIER</span>
                                                                            <div class="col">
                                                                                <select name="id_quartier" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" readonly>
                                                                                    <option value="" selected>
                                                             <?php

                                                                     $sql="SELECT * FROM quartier where id_quat='$id_quartier' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        echo $table['nom'];
                                                                                   }
                                                                          ?>                           

                                                                                    </option>
                                                                            </select>
                                                                            </div>
                                                                        </td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >PROFESSION</span>
                                                                            <div class="col">
                                                                                <select name="profession" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" readonly>
                                                                                    <option value="<?=$profession?>" ><?=$profession?></option>
                                                                                </select>
                                                                                
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >SITUATION MATRIMONIALE</span>
                                                                            
                                                                            <div class="col">
                                                                                <select name="situation_matrimoniale" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" readonly>>
                                                                                    <option value="<?=$situation_matrimoniale?>"><?=$situation_matrimoniale?></option>
                                                                                    
                                                                                </select>
                                                                               
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="help-block small-font" >NOMBRE D'ENFANTS</span>
                                                                            <div class="col">
                                                                                <input style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;"  value="<?=$nombre_enfants?>"  readonly>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="help-block small-font" >GENRE</span>
                                                                            <div class="col">
                                                                                <select name="genre" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" readonly>>
                                                                                    <option value="<?=$genre?>" selected><?=$genre?></option>
                                                                                    
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr> 
                                                                <td>
                                                                        <span class="help-block small-font" >PAYS</span>
                                                                            <div class="col">
                                                                                <select name="genre" style="width:75%;
                                                                                border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" readonly>
                                                                                    <option value="<?=$id_pays?>" selected>
                                                                 <?php
				
															  $sql="SELECT * FROM pays where id_pays='$id_pays' ";
                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                    {
                                                                                        echo $table['nom'];
																					}
                                                                                      ?>
                                                                                        
                                                                                    </option>
                                                                                    
                                                                                </select>
                                                                            </div>
                                                                        </td>


                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </form>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="card-footer">
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<!--******************************************** ETAT CIVILE************************************************* -->

 <div class="tab-pane container" id="menu1">
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
                                <b>L'ensemble des frais</b>
                               
                            </div>
                            <div class="card-body">
                                <div class="well bs-component">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="table-responsive">
                                                <form method="post" action="" >
                                                   <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Ref_etude_dossier</th>
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

                                $query = "SELECT * from droit_etu_dos where open_close!='1'and id_post='$id_personnel'  order by date_dos,ref_post_dos asc";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_etu_dos = $row['id_etu_dos'];
                                    $ref_post_dos = $row['ref_post_dos'];
                                    $id_caisse = $row['id_caisse'];
                                    $id_post = $row['id_post'];
                                    $id_perso = $row['id_perso'];
                                    $date_dos = $row['date_dos'];
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

                                        $sql = "SELECT * from mytable where id_ingenieur = '$id_post'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom_ing=$table['nom_ing'].' '.$table['prenom_ing'];
                                                                }

                                    ?>

                                <tr>
                                    <td><a href="#"><?=$ref_post_dos?></a></td>
                                    <td><a href="#"><?=$caisse?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$nom_ing?></a></td>
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                             class="rounded-circle m-r-5"
                                             alt=""><?=$montant?></a></td>
                                    <td><a href="#"><?= number_format($montant)?></a></td>
                                    <td><a href="#"><?=$date_dos?></a></td>
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
                                
                        <!-- < -->
<!--********************************************ETAT ACADEMIQUE************************************************* -->
                                  <div class="tab-pane container" id="menu2">
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
                                        <a class="nav-link active"  href="liste_pj_aca.php?id_personnel=<?=$id_personnel?>">
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

                        $query = "SELECT  count(id_perso) as total from etat_academique where id_perso='".$id_personnel."' ";
                                                                $stmt = $db->prepare($query);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach($tables as $table)
                                                            {
                                                                $total=$table['total'];
                                                            // echo $total;
                                                        }
                if ($total>0){

                        $query = "SELECT* from etat_academique where id_perso='".$id_personnel."'";
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

<!--********************************************ETAT PROFESSIONNEL************************************************* -->
                                                           <div class="tab-pane container" id="menu3">
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
                                        <a class="nav-link active"  href="liste_pj_prof_ing.php?id_personnel=<?=$id_personnel?>">
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

                        $query = "SELECT  count(id_perso) as total from etat_professionnel where id_perso='".$id_personnel."' ";
                                                                $stmt = $db->prepare($query);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach($tables as $table)
                                                            {
                                                                $total=$table['total'];
                                                            // echo $total;
                                                        }
                if ($total>0){

                        $query = "SELECT* from etat_professionnel where id_perso='".$id_personnel."'";
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

<!--********************************************INFOS RH ************************************************* -->
                                <!--ETAT ACADEMIQUE -->
  
<!--********************************************PRIME************************************************ -->
                                
          

             <div class="tab-pane container" id="menu5">

              <h5><b><u>NB:</u></b> Veillez saisir vos informations consernant votre dossier</h5>

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <form class="form-horizontal" action="file_folder.php"
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
                



                              
                      
                                
<!--****************************************** ............************************************************ -->

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


    <!--//Footer-->
<?php
include('foot.php');
?>