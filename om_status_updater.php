<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');
include("api/OrangeMoney.php");

$omStatus = new stdClass();
$omStatus->order_id = $_COOKIE['order_id'] ?? "0";
$omStatus->amount = $_COOKIE['amount'] ?? "0";
$omStatus->pay_token = $_COOKIE["pay_token"] ?? "N/A";
$omStatus->init_token = $_COOKIE["init_token"] ?? "N/A";
$omStatus->redirection = $_COOKIE["redirection"] ?? "http://closer.cm";


// echo "<br/> Orange Money class <br/>";
// print_r($orangeMoney);
// echo "<br/> Status <br/>";
// print_r($pay_checker);



$orangeMoney = new OrangeMoney($omStatus->amount, $omStatus->order_id);
//  print_r($orangeMoney);
$orangeMoney->setToken($omStatus->init_token);
//echo "<br/> Orange Money class <br/>";
//print_r($orangeMoney);
sleep(2);
$pay_checker = $orangeMoney->checkTransactionStatus($omStatus->pay_token);
//echo "<br/> Status <br/>";
//print_r($pay_checker);
$marks = array('INITIATED', 'PENDING', 'EXPIRED');
if(isset($pay_checker->status) > 0 && !in_array($pay_checker->status, $marks) && isset($pay_checker->txnid)){
    $query1 = "UPDATE payement_statut SET status = '$pay_checker->status', txnid = '$pay_checker->txnid' WHERE transaction_id = '$omStatus->order_id'";
    $sql1 = $db->prepare($query1);
    $sql1->execute();
    
    $payer = "Payer";
    if($pay_checker->status == "SUCCESS"){
        $query1 = " UPDATE demande_entreprise SET droit=:payer  WHERE 	ref_dem_ent_cp = '$omStatus->order_id' ";
        $sql1 = $db->prepare($query1);
        $sql1->bindParam(':payer', $payer);
        $sql1->execute();
    }
}
?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-cogs" style="color: silver"></i>
                Statut du paiement Orange Money </h1>
                
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>
                
                <?php
                    $markError = array('NOT FOUND', 'FAILED', '');
                    if(in_array($pay_checker->status, $markError)){
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                          <img src="img/payment_error.gif" class="rounded" width="200" heigth="200" alt="...">
                        </div>
                    </div>
                </div>
                <ol class="breadcrumb mb-4 bg-danger">
                    <li class="breadcrumb-item active text-white text-center">
                        Paiement échoué [<?=$pay_checker->status?>], si vous pensez qu'il s'agit d'une erreur, veuillez nous contacter svp!
                    </li>
                </ol>
                <a class="btn btn-primary" href="<?=$omStatus->redirection?>">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
                <?php
                    }elseif($pay_checker->status == "SUCCESS"){
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                          <img src="img/payment_success.gif" class="rounded" width="200" heigth="200" alt="...">
                        </div>
                    </div>
                </div>
                <ol class="breadcrumb mb-4 bg-success">
                    <li class="breadcrumb-item active text-white text-center">
                        Paiement effectué avec succès [<?=$pay_checker->status?>]
                    </li>
                </ol>
                <a class="btn btn-primary" href="<?=$omStatus->redirection?>">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
                <?php
                    }else{
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                          <img src="img/payment_loading.gif" class="rounded" width="200" heigth="200" alt="...">
                        </div>
                    </div>
                </div>
                <ol class="breadcrumb mb-4 bg-warning">
                    <li class="breadcrumb-item active text-white text-center">
                        Opération de paiement en cours ... [<?=$pay_checker->status?>]
                    </li>
                </ol>
                <a class="btn btn-primary" href="<?=$omStatus->redirection?>">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
                <?php
                    }
                ?>
            </div>
        </main>
    </div>
    <!--//Footer-->
<?php
include('foot.php');
?>