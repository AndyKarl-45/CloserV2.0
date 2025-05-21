 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("api/Payment.php");
    include("api/OrangeMoney.php");
?>
<?php

function generateNDigitRandomNumber($length){
   return mt_rand(pow(10,($length-1)),pow(10,$length)-1);
}

$ref_ing_cost='REF_'.generateNDigitRandomNumber(6);

if($_POST)
{      
        
        
            $year = (new DateTime())->format("Y");
            $month = (new DateTime())->format("m");
            $day = (new DateTime())->format("d");
    
            $id_caisse = $_POST['id_caisse'];
            $id_user_perso = $_SESSION['rainbo_id_perso'];
            $years=date('Y');
             
            $annee=date('Y-m-d');
            $id_ing = $_POST['id_ing'];
            $somme = $_POST['somme'];
            $payer = abs($_POST['payer']);
            $open_close=0;
            
            // echo $id_ing;
            // die;
    
            $sql="SELECT count(id_cotisation) as total, ref_ing_cost as ref, somme, payer FROM cotisation where id_caisse='$id_caisse' and id_ing='$id_ing' and annee LIKE '$year%' ";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($tables as $table)
                {
                  $count=$table['total'];
                    
                    $payer_i=$table['payer'];
                    // $ref_ing_cost=$table['ref'];
                }
            // echo $count;
            // die;
            
            if($count==0){
                // echo ($somme-$payer);
                if($somme-$payer==0){
                    
                    // echo ($somme-$payer);
                    // die;
                    $etat = 'OK';
                    
                $bn_user=0;
                
                if($lvl !== 1){
                    $query1 = "SELECT * from personnel WHERE id_personnel= $id_user_perso";
                   $stmt = $db->prepare($query1);
                    $stmt->execute();
                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($tables as $row1)
                    {
                        $nom_us = $row1["nom"] . ' ' . $row1["prenom"];
                        $bn_user++;
                    }
                }
                
                if($bn_user == 0){
                    $query1 = "SELECT * from mytable WHERE id_ingenieur= $id_user_perso";
                    $stmt = $db->prepare($query1);
                    $stmt->execute();
                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($tables as $row1)
                    {
                            $nom_us = $row1["nom_ing"] . ' ' . $row1["prenom_ing"];
                            $bn_user++;
                            
                    }
                }
                if($bn_user == 0 ){
                    ?>
                    <script>
                        alert('Error.');
                         window.location.href='<?=$cotisation['option2_link']?>?witness=-1';
                    </script>
                    <?php
                }
                    
                  
                        
                    
                    
                    $sql = "INSERT INTO cotisation (id_caisse,annee,id_ing,somme,payer,etat,open_close,ref_ing_cost,id_perso,id_auteur,auteur)
                          VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                    $req = $db->prepare($sql);
                    $req->execute(array($id_caisse,$annee,$id_ing,$somme,$payer,$etat,$open_close,$ref_ing_cost,$id_user_perso,$id_user_perso,$nom_us));
                    
                      
    //  ------------------------- START API PAYMENT --------------------------------------------------
                    $link = "liste_cotisation.php";
                    $today = date("Y-m-d");
                                   
                    if($lvl == 1){
                    
                        // $ref_ing_cost = "CLOSERCOTI-TEST008"; //!!! ne pas effacer cette ligne
                        $orangeMoney = new OrangeMoney($payer, $ref_ing_cost);
                        // echo "Ref return <br/>";
                        // echo "<br/>".$ref_ing_cost."<br/>";
                        // echo "PayInit return <br/>";
                        // echo "<pre>";
                        // print_r($orangeMoney);
                        // die;
                        $link = $orangeMoney->getPaymentUrl("http://closer.cm/om_status_updater.php");
                        // echo "<br/> Get Payment URL return <br/>";
                        // echo "<pre>";
                        // print_r($link);
                        // die;
                        setcookie('pay_token', $link->pay_token, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        setcookie('order_id', $ref_ing_cost, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        setcookie('amount', $payer, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        setcookie('redirection', "http://closer.cm/liste_demande_entreprise.php", time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        
                    
                        $sql = "INSERT INTO payement_init (pay_link, pay_token, transaction_id, ref_ing_cost, amount, operation_date, init_token,id_auteur,auteur)
                                              VALUES (?,?,?,?,?,?,?,?,?)";
                        $req = $db->prepare($sql);
                        $req->execute(array($link->payment_url,$link->pay_token, $ref_ing_cost,$ref_ing_cost,$payer, $today, $orangeMoney->getToken(),$id_user_perso,$nom_us));
                        setcookie('init_token', $orangeMoney->getToken(), time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        
                        $pay_checker = $orangeMoney->checkTransactionStatus($link->pay_token);
                        // echo "<br/> Pay checker return <br/>";
                        // echo "<pre>";
                        // print_r($pay_checker);
                        // die;
                        $sql = "INSERT INTO payement_statut (transaction_id, amount, status, pay_token, operation_date, init_token,id_auteur,auteur)
                                              VALUES (?,?,?,?,?,?,?,?)";
                        $req = $db->prepare($sql);
                        $req->execute(array($pay_checker->order_id,$payer, $pay_checker->status, $link->pay_token, $today, $orangeMoney->getToken(),$id_user_perso,$nom_us));
                        
                   } else {
                        $sql = "INSERT INTO payement_init (pay_link, pay_token, transaction_id, ref_ing_cost, amount, operation_date, init_token,id_auteur,auteur)
                                              VALUES (?,?,?,?,?,?,?,?,?)";
                        $req = $db->prepare($sql);
                        $req->execute(array("#","n/a", $ref_ing_cost, $ref_ing_cost, $payer, $today, "#",$id_user_perso,$nom_us));
                        
                        $sql = "INSERT INTO payement_statut (transaction_id, amount, status, pay_token, operation_date, init_token,id_auteur,auteur)
                                              VALUES (?,?,?,?,?,?,?,?)";
                        $req = $db->prepare($sql);
                        $req->execute(array($ref_ing_cost,$payer, "SUCCESS", "n/a", $today, "#",$id_user_perso,$nom_us));
                   }
    //  ------------------------- END API PAYMENT --------------------------------------------------
                        
                     //   if($somme==60000){
                 
                                    $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                                                $stmt = $db->prepare($sql);
                                                $stmt->execute();
                        
                                                 $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                                                        foreach($tables as $table)
                                                            {
                                                                $solde=$table['total'];
                                                                
                                                            }
                        
                                $somme=60000+$solde;
                        
                                $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
                                $sql1 = $db->prepare($query1);
                        
                                 // Bind parameters to statement
                                $sql1->bindParam(':payer', $somme);
                                $sql1->execute();
                                
                                   $ref_caisse=$ref_ing_cost;
                                    $id_beneficiaire=$id_ing;
                                    $somme=$payer;
                                    $date_hist=$annee;
                            
                            
                                    $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,id_perso)
                                              VALUES (?,?,?,?,?,?)";
                                            $req = $db->prepare($sql);
                                            $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$somme,$date_hist,$id_user_perso));
                        // }
    
    

    
    
            if($sql)
                                    {
                                        ?>
                                        <script>
                                            // alert('Cotisation a été enregistrée.');
                                             window.location.href='<?=$link->payment_url?>';
                                        </script>
                                        <?php
                                    }
    
                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                             window.location.href='<?=$cotisation['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }
    
        
                }
                
    
            
            } elseif ($count!=0){
            ?>
                <script>
                    alert('Cotisation déjà crée !!! vous devez la modifier !!! ');
                     window.location.href='<?=$cotisation['option2_link']?>?witness=-1';
                </script>
            <?php
            }
    }

?>
