<?php

include('first.php');
include('php/main_side_navbar.php');


//Count request
// Count projets
$total_patient = 0;
$total_ingenieur = 0;
$total_postulant = 0;
$total_Personnel = 0;
$total_fournisseur = 0;
$total_appointment = 0;
$total_chirugien = 0;
$today = date("Y-m-d");
$today = date("t", strtotime($today));

$query = "SELECT count(id_personnel) as total from personnel where open_close <> 1 and statut  LIKE   'E%' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_Personnel = $row["total"];
}

$query = "SELECT count(id_ingenieur) as totals from mytable where statut='N/A'  ";
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_ingenieur = $row["totals"];
}

$query = "SELECT count(id_ingenieur) as total from mytable WHERE statut LIKE 'P%' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_postulant = $row["total"];
}

$query = "SELECT count(id_entreprise) as total from entreprise";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_entreprise = $row["total"];
}



$query = "SELECT count(id_ingenieur) as total from mytable where etat ='V' and statut='POSTULANT' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_doc_post_true = $row["total"];
}

$query = "SELECT count(id_ingenieur) as total from mytable where etat ='F' and statut='POSTULANT' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_doc_post_false = $row["total"];
}

$query = "SELECT count(id_ingenieur) as total from mytable where etat ='N' and statut='POSTULANT' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_doc_post_wait = $row["total"];
}



$query = "SELECT count(id_ingenieur) as total from demande_cachet where statut=1 ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_cachet_recus = $row["total"];
}

$query = "SELECT count(id_ingenieur) as total from demande_cachet where statut=2 ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_cachet_cours = $row["total"];
}

$query = "SELECT count(id_ingenieur) as total from demande_cachet where statut=3 ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_cachet_livrer = $row["total"];
}



$query = "SELECT count(id_ing) as total from demande_entreprise  ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attest_ent = $row["total"];
}

$query = "SELECT count(id_ing) as total from demande_entreprise where statut='Envoyer' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attest_ent_cours = $row["total"];
}

$query = "SELECT count(id_ing) as total from demande_entreprise where droit='Payer' and statut='Approuver' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attest_ent_valider = $row["total"];
}

$query = "SELECT count(id_ing) as total from demande_entreprise where  statut='Rejeter' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attest_ent_false = $row["total"];
}



$query = "SELECT count(id_ing) as total from demande_particulier  ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attest_part = $row["total"];
}

$query = "SELECT count(id_ing) as total from demande_particulier where statut='Envoyer' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attest_part_cours = $row["total"];
}

$query = "SELECT count(id_ing) as total from demande_particulier where droit='Payer' and statut='Approuver' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attest_part_valider = $row["total"];
}

$query = "SELECT count(id_ing) as total from demande_particulier where  statut='Rejeter' ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attest_part_false = $row["total"];
}




$query = "SELECT SUM(somme) as total from cotisation ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_cotisation = $row["total"];
}


$query = "SELECT SUM(montant) as total from droit_attestation  ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_attestation = $row["total"];
}

$query = "SELECT SUM(montant) as total from droit_etu_dos  ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_etu_dos = $row["total"];
}

$total_dette=0;
$query = "SELECT SUM(somme) as total from dette ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_dette = $row["total"];
}

$total_dette_true=0;
$query = "SELECT SUM(payer) as total from dette  ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_dette_true = $row["total"];
}


$total_dette_false=$total_dette-$total_dette_true;

// $query = "SELECT count(id_app) as total from appointment";
// $q = $conn->query($query);
// while ($row = $q->fetch_assoc()) {
//     $total_appointment = $row["total"];
// }
// //
// $query = "SELECT count(id_chirugien) as total from chirugien ";
// $q = $conn->query($query);
// while ($row = $q->fetch_assoc()) {
//    $total_chirugien = $row["total"];
// }
//
//$query = "SELECT count(id_salles) as total from salles";
//$q = $conn->query($query);
//while ($row = $q->fetch_assoc()) {
//    $total_salles = $row["total"];
//}
//
//$query = "SELECT count(id_secteur) as total from secteur";
//$q = $conn->query($query);
//while ($row = $q->fetch_assoc()) {
//    $total_secteurs = $row["total"];
//}
//
//$total_entree = 0;
//$query = "SELECT montant from operations_compta WHERE type_oc = 'entree' AND auteur <> 'special'";
//$q = $db->query($query);
//while($row = $q->fetch())
//{
//    $total_entree += $row["montant"];
//}
//
//$total_dette = 0;
//$query = "SELECT montant from credit WHERE modalite <> statut ";
//$q = $db->query($query);
//while($row = $q->fetch())
//{
//    $total_dette += $row["montant"];
//}
//
//$total_sortie = 0;
//$query = "SELECT montant from operations_compta WHERE type_oc = 'sortie' AND auteur <> 'special'";
//$q = $db->query($query);
//while($row = $q->fetch())
//{
//    $total_sortie += $row["montant"];
//}


?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Tableau de Bord</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme <?= strtoupper($nom_user); ?>, il est <?= date("G:i"); ?> en ce jour
                        du <?= dateToFrench("now", "l j F Y"); ?>.
                    </li>
                </ol>


                <!------------------------------------------------------------Spécialistes------------------------------------------------------------------->

                <label>
                    <i class="far fa-newspaper"></i>
                    Personnels/Entreprises
                </label>
                <div class="row">


                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $personnel['option2_link'] ?>" style="text-decoration: none; "> 
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_Personnel?></h3>
                                    <span class="widget-title1">Personnels<i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $entreprise['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF; padding-bottom: 57px;" >
                               <span class="dash-widget-bg4">
            <i class="fas fa-building" aria-hidden="true"></i></span> <sup class="badge badge-warning">0</sup>
                                    <div class="dash-widget-info text-right" style="float:right;"  >  
                                    <h3><?=$total_entreprise?></h3>
                                    <span class="widget-title4">Entrepises <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>

                            </div>
                        </a>
                    </div>

                </div>
 <!------------------------------------------------------------Spécialistes------------------------------------------------------------------->

                <label>
                    <i class="far fa-newspaper"></i>
                    Membres
                </label>
                <div class="row">


                    
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $ingenieur['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-user-graduate" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_ingenieur?></h3>
                                    <span class="widget-title3">Membres Inscrits <i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $personnel['option2_link'] ?>" style="text-decoration: none; "> 
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title1">Membres Actifs<i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $postulant['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg5"><i class="fas fa-users"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title5">Membres échus<i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                <!------------------------------------------------------------Postulants------------------------------------------------------------------->
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <label>
                    <i class="far fa-newspaper"></i>
                    Dossiers - Postulants
                </label>
                <div class="row">


                    
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $ingenieur['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="far fa-folder-open" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_doc_post_true?></h3>
                                    <span class="widget-title3">Dossiers reçus  <i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $personnel['option2_link'] ?>" style="text-decoration: none; "> 
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="far fa-folder" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_doc_post_false?></h3>
                                    <span class="widget-title1">Dossiers en cours <i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $postulant['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg6"><i class="far fa-file-excel"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_doc_post_wait?></h3>
                                    <span class="widget-title6">Dossiers rejetés <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    

                </div>


                <!------------------------------------------------------------Demande de Cachets------------------------------------------------------------------->
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <label>
                    <i class="far fa-newspaper"></i>
                    Demande de cachets
                </label>
                <div class="row">


                    
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $ingenieur['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="far fa-folder-open" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_cachet_recus?></h3>
                                    <span class="widget-title3">Demandes reçus  <i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $personnel['option2_link'] ?>" style="text-decoration: none; "> 
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg5"><i class="fas fa-folder" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_cachet_cours?></h3>
                                    <span class="widget-title5">En cours <i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $postulant['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="far fa-handshake"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_cachet_livrer?></h3>
                                    <span class="widget-title2">Cachets livrés <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>


 <!------------------------------------------------------------Attestations d'entreprises------------------------------------------------------------------->
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <label>
                    <i class="far fa-newspaper"></i>
                    Attestations d'entreprises
                </label>
                <div class="row">


                    
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $ingenieur['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-inbox" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_attest_ent?></h3>
                                    <span class="widget-title3">Demandes totales  <i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $postulant['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-tasks"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_attest_ent_valider?></h3>
                                    <span class="widget-title2">Attestations générées<i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $ingenieur['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg6"><i class="fas fa-window-close" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_attest_ent_false?></h3>
                                    <span class="widget-title6">Demandes rejetées<i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>


 <!------------------------------------------------------------Attestations particlier------------------------------------------------------------------->
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <label>
                    <i class="far fa-newspaper"></i>
                    Attestations particuliers
                </label>
                <div class="row">


                    
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $ingenieur['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-inbox" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_attest_part?></h3>
                                    <span class="widget-title3">Demandes totales  <i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $postulant['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class=" "
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_attest_part_valider?></h3>
                                    <span class="widget-title2">Attestations générées<i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="<?= $ingenieur['option2_link'] ?>" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg6"><i class="far fa-window-close" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_attest_part_false?></h3>
                                    <span class="widget-title6">Demandes rejetées<i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <!------------------------------------------------------------Services------------------------------------------------------------------->
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <label>
                    <i class="far fa-newspaper"></i>
                    Sercices Vendus
                </label>
                <div class="row">


                    
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="#" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-donate" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_cotisation?></h3>
                                    <span class="widget-title3">Frais cotisations<i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="#" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg5"><i class="fas fa-file-invoice-dollar" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_attestation?></h3>
                                    <span class="widget-title5">Frais attestations<i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="#" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fas fa-comment-dollar"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_etu_dos?></h3>
                                    <span class="widget-title1">Frais études dossiers<i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>

                <!------------------------------------------------------------Dettes------------------------------------------------------------------->
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <label>
                    <i class="far fa-newspaper"></i>
                    Dettes-Ingénieurs-2021
                </label>
                <div class="row">



                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="#" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-donate" aria-hidden="true"></i>
                                    </span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=number_format($total_dette)?></h3>
                                    <span class="widget-title3">Dettes Totales<i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="#" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg5"><i class="fas fa-file-invoice-dollar" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=number_format($total_dette_true)?></h3>
                                    <span class="widget-title5">Dettes acquises<i class="fa fa-check"
                                                                                     aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="#" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg4"><i class="fas fa-comment-dollar"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=number_format($total_dette_false)?></h3>
                                    <span class="widget-title4">Dettes en cours <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>

                <!------------------------------------------------------------Services------------------------------------------------------------------->
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <label>
                    <i class="far fa-newspaper"></i>
                    Etats trésorerie
                </label>
                <div class="row">
                    
                <?php

                        $query = "SELECT * from caisse  order by date_caisse desc limit 8";
                        $q = $db->query($query);
                        while ($row = $q->fetch()) {
                        $id_caisse = $row['id_caisse'];
                                    $code = $row['code'];
                                    $caisse = $row['caisse'];
                                    $id_perso = $row['id_perso'];
                                    $date_caisse = $row['date_caisse'];
                                    $solde = $row['solde'];

                            // $profession = $row['profession'];

                            ?>
                <div class="col-md-4 col-sm-4  col-lg-3">
                    <div style="background-color: #EFF3F5;" class="profile-widget">
                        <div class="doctor-img">
                            <a class="avatar" href="liste_add_caisse.php"><i class="fas fa-donate"></i></a>
                        </div>
                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false"><i
                                        class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="modifier_add_caisse.php?id=<?=$id_caisse;?>"><i class="fas fa-pen"></i> Edit</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i
                                            class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                        <h4 class="doctor-name text-ellipsis"><a href="liste_add_caisse.php"><?=$caisse?></a></h4>
                        <div class="doc-prof">Responsable:<br><?php

                                                                        $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

                                                                        $stmt = $db->prepare($sql);
                                                                        $stmt->execute();

                                                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                        foreach ($tables as $table) {
                                                                            echo $table['nom'].' '.$table['prenom'] ;
                                                                        }

                                                                        ?></div>
                        <div class="user-country">
                            <i class="fas fa-donate"></i> <?= number_format($solde);?>
                        </div>
                    </div>
                </div>
            <?php }

            ?>
        

                    



                </div>

                <!------------------------------------------------------------Pateints----------------------------------------------------------------------->

                <!-- <label>
                    <i class="far fa-newspaper"></i>
                    Patients/Produits/Fournisseurs
                </label>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_patient.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-user-injured"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_patient ?></h3>
                                    <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_prod.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fa fa-cubes"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>1</h3>
                                    <span class="widget-title3">Produits <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_four.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg4"><i class="fas fa-shipping-fast"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_fournisseur ?></h3>
                                    <span class="widget-title4">Fournisseurs <i class="fa fa-check"
                                                                                aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                </div> -->

                <!------------------------------------------------------------Services----------------------------------------------------------------------->

                <!-- <label>
                    <i class="far fa-newspaper"></i>
                    Services
                </label>
                <div class="row">

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_consultation.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg4"><i class="fas fa-heartbeat" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title4">Consultations<i class="fa fa-check"
                                                                                aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_examen.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fas fa-file-medical-alt" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title1">Examens<i class="fa fa-check"
                                                                          aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                        <a href="liste_hospitalisation.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-procedures"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title2">Hospitalisations<i class="fa fa-check"
                                                                                   aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_operation.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-check" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title3">Opérations <i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                        <a href="liste_ordonnance.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-tasks"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>1</h3>
                                    <span class="widget-title2">Ordonnances<i class="fa fa-check"
                                                                                   aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                        <a href="liste_ordonnance.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fas fa-calendar-alt"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>1</h3>
                                    <span class="widget-title1">Rendez-vous<i class="fa fa-check"
                                                                                   aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
 -->
                <!------------------------------------------------------------Agenda------------------------------------------------------------------------>

                <!-- <label>
                    <i class="far fa-newspaper"></i>
                    Agenda
                </label>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_appointment.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF">
                                <span class="dash-widget-bg1"><i class="fa fa-stethoscope"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_appointment?> </h3>
                                    <span class="widget-title1">Rendez-vous <i class="fa fa-check"
                                                                               aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> -->

                <!------------------------------------------------------------N/A------------------------------------------------------------------->
                <!-- <label>
                    <i class="far fa-newspaper"></i>
                    Salles/Blocs
                </label>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_bloc_operation.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg4"><i class="fas fa-x-ray" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title4">Blocs Opératoire <i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_salle_malade.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-diagnoses" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title3">Salle des Malades <i class="fa fa-check"
                                                                                     aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_salle_soin.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-clinic-medical"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title2">Salle des soins <i class="fa fa-check"
                                                                                   aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> -->


                <!------------------------------------------------------------OTHER------------------------------------------------------------------->

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <!--               Etat-->
                <!-- <label>
                    <i class="far fa-newspaper"></i>
                    Quelques états
                </label>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_lit.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fas fa-bed" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title1">Lits <i class="fa fa-check"
                                                                        aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_chambres.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-home"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title2">Chambres <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_departement.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-paste" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3>0</h3>
                                    <span class="widget-title3">Départements <i class="fa fa-check"
                                                                                aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                </div> -->

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <!--               Etat-->
                <!--                 <label>
                    <i class="far fa-newspaper"></i>
                    Les Chantiers
                </label>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <h1>
                                        <?= $total_chantier ?>
                                    </h1>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="liste_chantier.php">Chantiers</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <h1>
                                        <?= $total_chantier_fini ?>
                                    </h1>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="liste_chantier.php">Chantiers terminés</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <h1>
                                        <?= $total_chantier_cours ?>
                                    </h1>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="liste_chantier.php">Chantiers en cours</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
    </div>
    </main>
    </div>

    <!--//Footer-->
<?php
include('foot.php');
?>