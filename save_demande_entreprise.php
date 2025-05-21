 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php");
    include("api/Payment.php");
    include("api/OrangeMoney.php");
?>

<?php

if($_POST)
{               
 

        /*--------------------------------- ETAT CIVILE -------------------------------------*/
        $id_perso = $_POST['id_personnel'];
        $id_dem_ent = $_POST['id_dem_ent'];
        if($lvl==1){$id_caisse=3;}else{$id_caisse= $_POST['id_caisse'];}
        $date_dem_ent=$_POST['date_dem_ent'];
        $payer=$_POST['payer'];
        
        $sql="SELECT YEAR('$date_dem_ent') as total  ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($tables as $table)
                {
                    $annee=$table['total'];
                }
         
        $id_ing=$_POST['id_ing'];
        $id_entreprise=$_POST['id_entreprise'];
        $nom1 = strtolower($_POST['objet']);
        $objet = ucwords($nom1);
        $etat=1;
        
        
        
                            

        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

        $query1 = "UPDATE demande_entreprise SET id_caisse=:id_caisse, id_ing=:id_ing, id_entreprise=:id_entreprise, objet=:objet, date_dem_ent=:date_dem_ent, id_perso=:id_perso, annee=:annee where id_dem_ent = '$id_dem_ent' ";
  
        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':id_caisse', $id_caisse);
            $sql1->bindParam(':id_ing', $id_ing);
            $sql1->bindParam(':id_entreprise', $id_entreprise);
            $sql1->bindParam(':objet', $objet);
            $sql1->bindParam(':date_dem_ent', $date_dem_ent);
            $sql1->bindParam(':id_perso', $id_perso);
            $sql1->bindParam(':annee', $annee);
            $sql1->execute();
            
            
            
            
            

                
                
                

                        
                // $sql="SELECT Max(id_dem_ent) as total FROM demande_entreprise ";
                // $stmt = $db->prepare($sql);
                // $stmt->execute();

                // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // foreach($tables as $table)
                //     {
                //       $last_id=$table['total'];
                        
                //     }     
                    
                $sql="SELECT Max(id) as total FROM payement_init ";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($tables as $table)
                    {
                      $last_id=$table['total'];
                        
                    } 
                        $ref_dem_ent_cp='ATTE00000'.$id_ing.'_ONIGC_'.$last_id;
                        
                         $query1 = " UPDATE demande_entreprise SET ref_dem_ent_cp=:ref_dem_ent_cp  WHERE id_dem_ent = '$id_dem_ent' ";


                            $sql1 = $db->prepare($query1);
                
                            // Bind parameters to statement
                            $sql1->bindParam(':ref_dem_ent_cp', $ref_dem_ent_cp);
                            $sql1->execute();
                            
                            
           $id_persoss=0;
           $date_hist=date('Y-m-d');
                                    
            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,id_perso,date_hist)
                  VALUES (?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_dem_ent_cp,$id_ing,$payer,$id_persoss,$date_hist));
                   
                
                
                //  ------------------------- START API PAYMENT --------------------------------------------------
                    $link = "liste_demande_entreprise.php";
                   
                   if($lvl == 1 || $lvl==20){
                        // $ref_dem_ent_cp = "CLOSERTEST055"; !!! ne pas effacer cette ligne
                        //echo $ref_dem_ent_cp;
                        //echo $payer;
                        // $payer = 100;
                        $orangeMoney = new OrangeMoney($payer, $ref_dem_ent_cp);
                        $link = $orangeMoney->getPaymentUrl("http://closer.cm/om_status_updater.php");
                        setcookie('pay_token', $link->pay_token, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        setcookie('order_id', $ref_dem_ent_cp, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        setcookie('amount', $payer, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        setcookie('redirection', "http://closer.cm/liste_demande_entreprise.php", time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        $today = date("Y-m-d");
                    
                         $sql = "INSERT INTO payement_init (pay_link, pay_token, transaction_id, ref_ing_cost, amount, operation_date, init_token)
                                              VALUES (?,?,?,?,?,?,?)";
                        $req = $db->prepare($sql);
                        $req->execute(array($link->payment_url,$link->pay_token, $ref_dem_ent_cp,$ref_dem_ent_cp,$payer, $today, $orangeMoney->getToken()));
                        setcookie('init_token', $orangeMoney->getToken(), time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                        
                        $pay_checker = $orangeMoney->checkTransactionStatus($link->pay_token);
                        
                        //  $sql = "INSERT INTO payement_statut (transaction_id, amount, status, pay_token, operation_date, init_token)
                        //                       VALUES (?,?,?,?,?,?)";
                        // $req = $db->prepare($sql);
                        // $req->execute(array($pay_checker->order_id,$payer, $pay_checker->status, $link->pay_token, $today, $orangeMoney->getToken()));
                        
                        $sql = "INSERT INTO payement_statut (transaction_id, amount, status, pay_token, operation_date, init_token)
                                              VALUES (?,?,?,?,?,?)";
                        $req = $db->prepare($sql);
                        $req->execute(array($pay_checker->order_id,$payer, $pay_checker->status, $link->pay_token, $today, $orangeMoney->getToken()));
                        
                   }
                //  ------------------------- END API PAYMENT --------------------------------------------------



                    if($req)
                    {
                        ?>
                        <script>
                        //alert('Profession a été bien enregistrée.');
                         window.location.href='<?=$link->payment_url?>';
                        </script>
                        <?php
                    }

                    else
                    {       
                      ?>
                        <script>
                            //alert('Personnel n\'a pas été modifié.');
                            window.location.href='modifier_demande_entreprise.php?id=<?=$id?>?&witness=-1';
                        </script>
                        <?php
                       
                    }


}
?>
