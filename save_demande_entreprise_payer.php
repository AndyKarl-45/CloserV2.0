 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("api/Payment.php");
    include("api/OrangeMoney.php");
?>

<?php

if($_POST)
{               

         $year = (new DateTime())->format("Y");
         $month = (new DateTime())->format("m");
         $day = (new DateTime())->format("d");
         $years = (new DateTime())->format("y");

        $id_perso = $_POST['id_personnel'];
        $id_caisse= $_POST['id_caisse'];
        $date_dem_ent=date('Y-m-d');
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
      //  $droit=$_POST['droit'];
        $droit='En cours';


         $sql="SELECT count(id_dem_ent) as total FROM demande_entreprise where  id_ing='$id_ing' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                          $count=$table['total'];
                                    
                                        }
                                        
                                        
                                        $num=10;
      //  $sql="SELECT ref_dem_ent_cp FROM demande_entreprise where  id_ing='$id_ing' ";
        $sql="SELECT count(id_dem_ent) as totale FROM demande_entreprise  ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $num=$table['totale'];
                                            // $ref=$table['ref_dem_ent_cp'];
                                            //         $sql1="SELECT transaction_id FROM payement_init where  ref_ing_cost='$ref' ";
                                            //         $stmt1 = $db->prepare($sql1);
                                            //         $stmt1->execute();
                        
                                            //          $tables1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                        
                                            //                 foreach($tables1 as $table1)
                                            //                     {
                                            //                       $trans=$table1['transaction_id'];
                                            //                             $sql2="SELECT count(status) FROM payement_statut where  transaction_id='$trans' ";
                                            //                             $stmt2 = $db->prepare($sql);
                                            //                             $stmt2->execute();
                                            
                                            //                              $tables2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                                            
                                            //                                     foreach($tables2 as $table2)
                                            //                                         {
                                                                                      
                                            //                                           $num++;
                                                                                       
                                            //                                         }
                                                                                        
                                                                   
                                            //                     }
                                            
                                           
                                        }
// if($count==0){
                $num++;
                if(strlen($num)<=4){
                    //N°   0008  /  01  /Pdt/SG/ONIGC/22
                    $numeroref = substr_replace("0000",$num, -strlen($num));
                    $ref_dem_ent='N° '.$numeroref.' / '.$month.' /Pdt/SG/ONIGC/'.$years;
            
                }else{
                    //N°   00008  /  01  /Pdt/SG/ONIGC/22
                    $numeroref = substr_replace("00000",$num, -strlen($num));
                    $ref_dem_ent='N° '.$numeroref.' / '.$month.' /Pdt/SG/ONIGC/'.$years;
            
                }

          
         //   $ref_dem_ent='ATTE00000'.$id_ing.'/ONIGC/'.$annee;

        
                                   
        
                                    $sql = "INSERT INTO demande_entreprise (id_caisse,ref_dem_ent,id_ing,id_entreprise,objet,droit,date_dem_ent,id_perso,annee)
                                  VALUES (?,?,?,?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                               $req->execute(array($id_caisse,$ref_dem_ent,$id_ing,$id_entreprise,$objet,$droit,$date_dem_ent,$id_perso,$annee));
                                
                                
                                 $sql="SELECT Max(id_dem_ent) as total FROM demande_entreprise ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                          $last_id=$table['total'];
                                            
                                                                           
                                 $ref_dem_ent_cp='ATTE00000'.$id_ing.'_ONIGC_'.$last_id;
                                
                                             $query1 = " UPDATE demande_entreprise SET ref_dem_ent_cp=:ref_dem_ent_cp  WHERE id_dem_ent = '$last_id' ";


                                                $sql1 = $db->prepare($query1);
                                    
                                                // Bind parameters to statement
                                                $sql1->bindParam(':ref_dem_ent_cp', $ref_dem_ent_cp);
                                                $sql1->execute();
                                        }
                                        
                                 $id_persoss=$_SESSION['rainbo_id_perso'];
                                    $date_hist=date('Y-m-d');
                                    
                            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,id_perso,date_hist)
                                  VALUES (?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($id_caisse,$ref_dem_ent_cp,$id_ing,$payer,$id_persoss,$date_hist));

                                
                                
                                
//  ------------------------- START API PAYMENT --------------------------------------------------
                                    $link = "liste_demande_entreprise.php";
                                   
                                   if($lvl == 1){
                                        // $ref_dem_ent_cp = "CLOSERTEST055"; !!! ne pas effacer cette ligne
                                        $orangeMoney = new OrangeMoney($payer, $ref_dem_ent_cp);
                                        $link = $orangeMoney->getPaymentUrl("http://closer.cm/om_status_updater.php");
                                        setcookie('pay_token', $link->pay_token, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                                        setcookie('order_id', $ref_dem_ent_cp, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                                        setcookie('amount', $payer, time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                                        setcookie('redirection', "http://closer.cm/liste_demande_entreprise.php", time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                                        $today = date("Y-m-d");
                                    
                                         $sql = "INSERT INTO payement_init (pay_link, pay_token, transaction_id, ref_ing_cost, amount, operation_date, init_token)
                                                              VALUES (?,?,?,?,?, ?, ?)";
                                        $req = $db->prepare($sql);
                                        $req->execute(array($link->payment_url,$link->pay_token, $ref_dem_ent_cp,$ref_dem_ent_cp,$payer, $today, $orangeMoney->getToken()));
                                        setcookie('init_token', $orangeMoney->getToken(), time() + (60 * 10)); // 60 seconds * 10 = 10 mins
                                        
                                        $pay_checker = $orangeMoney->checkTransactionStatus($link->pay_token);
                                        
                                         $sql = "INSERT INTO payement_statut (transaction_id, amount, status, pay_token, operation_date, init_token)
                                                              VALUES (?,?,?,?, ?, ?)";
                                        $req = $db->prepare($sql);
                                        $req->execute(array($pay_checker->order_id,$payer, $pay_checker->status, $link->pay_token, $today, $orangeMoney->getToken()));
                                   }
//  ------------------------- END API PAYMENT --------------------------------------------------
                                


                                    if($req)
                                    {
                                        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                             window.location.href='<?=$link->payment_url?>';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                           // alert('Error.');
                                            window.location.href='<?=$demande_entreprise['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }



// }else{

//          ?>
//                                         <script>
//                                             alert('Existe Déjà !!! ');
//                                              window.location.href='<?=$demande_entreprise['option2_link']?>?witness=-1';
//                                         </script>
//                                         <?php
//                                     }



}

?>
