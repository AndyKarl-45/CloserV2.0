 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("api/Payment.php");
?>

<?php
// $total_apt = 0;
// $today = date("Y-m-d");
// $today = date("t", strtotime($today));

// $year = (new DateTime())->format("Y");
// $month = (new DateTime())->format("m");
// $day = (new DateTime())->format("d");
// $query  = "SELECT count(id_app) as total from appointment";
// $q = $conn->query($query);
// while($row = $q->fetch_assoc())
// {
//     $total_apt = $row["total"];
// }
// $id_app = $total_apt + 1;
// $ref_app = 'APT_'.$year.'_'.$month.'_'.$day.'_'.$id_app;
if($_POST)
{               


         $year = (new DateTime())->format("Y");
         $month = (new DateTime())->format("m");
         $day = (new DateTime())->format("d");

         $id_caisse = $_POST['id_caisse'];
         $id_user_perso = $_SESSION['rainbo_id_perso'];
         $date_dos=$_POST['date_dos'];
         $id_ing = $_POST['id_ing'];
         $id_perso = $_POST['id_perso'];
         $somme = $_POST['somme'];
         //$payer = abs($_POST['payer']);
         $payer=10000;
         $open_close=0;

         



                  $sql="SELECT count(id_etu_dos) as total FROM droit_etu_dos where id_caisse='$id_caisse' and id_ing='$id_ing' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                          echo  $count=$table['total'];
                                         }

if($count==0){

            

        

          $ref_post_dos='DED_'.$year.'_'.$month.'_'.$day.'_'.$id_ing;
             

        


        if($somme-$payer==0){
            
            $montant=$somme;
            $verse=$payer;
            $id_post=$id_ing;



            $sql = "INSERT INTO droit_etu_dos (id_caisse,date_dos,ref_post_dos,id_post,montant,verse,id_perso,open_close,id_auteur,auteur)
                                  VALUES (?,?,?,?,?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($id_caisse,$date_dos,$ref_post_dos,$id_post,$montant,$verse,$id_perso,$open_close,$id_user_perso,$nom_us));



//  ------------------------- START API PAYMENT --------------------------------------------------
$link = "liste_droit_etude_dossier.php";
                                   
                                   if($lvl == 1){
                                    $product = new stdClass();
                                    $products = new stdClass();
                                    
                                    $product->unit_price = 10000;
                                    $product->quantity = 1;
                                    $product->name = "Frais Droit attestation";
                                    $products->products = [$product];
                                     $payment = new Payment();
                                     $pay_statut = $payment->payInit($ref_ing_cost, $verse, $products, $link);
                                     $link = $pay_statut->pay_link;
                                     
                                    //  echo "Statut <br/>";
                                    //  echo "<pre>";
                                    //  print_r($pay_statut);
                                    //  echo " <br/>***************** ****************** ********************** <br/>";
                                    //  echo "pay link :" .$pay_statut->pay_link;
                                    //  die;
                                     
             $sql = "INSERT INTO payement_init (pay_link, pay_token, transaction_id, ref_ing_cost, amount,id_perso)
                                  VALUES (?,?,?,?,?,?)";
            $req = $db->prepare($sql);
            $req->execute(array($pay_statut->pay_link,$pay_statut->pay_token, $pay_statut->transaction_id,$ref_ing_cost,$pay_statut->amount));
            
            $pay_checker = $payment->payState($pay_statut->pay_token);
            // $pay_checker = $payment->payState("REF_2022_02_01_2481_gAe94BnTtHmOt2vCvQoQ_254");
            
             $sql = "INSERT INTO payement_statut (transaction_id, amount, status, pay_token,id_perso)
                                  VALUES (?,?,?,?,?)";
            $req = $db->prepare($sql);
            $req->execute(array($pay_checker->transaction_id,$pay_checker->amount, $pay_checker->status, $pay_checker->pay_token));
            
                    
                //  echo "<pre>";
                //  print_r($pay_checker);
                //  echo " ***************** ****************** ********************** <br/>";
                //  echo "pay link :" .$pay_statut->pay_link;
                //  die;
                
                                   }
//  ------------------------- END API PAYMENT --------------------------------------------------

                $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $solde=$table['total'];
                                            
                                        }

            $somme=$payer+$solde;

             $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
            $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':payer', $somme);
            $sql1->execute();

            $ref_caisse=$ref_post_dos;
            $id_beneficiaire=$id_post;
            $somme=$payer;
            $id_person=$id_perso;
            $date_hist=$date_dos;

            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,id_perso,date_hist,id_perso)
                                  VALUES (?,?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$somme,$id_perso,$date_hist,$id_user_perso));



            if($sql1)
                                    {
                                        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                              window.location.href='<?=$link?>';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                           // alert('Error.');
                                             window.location.href='<?=$etude_dossier['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


        }else{

           
                                    
                                        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                              window.location.href='<?=$etude_dossier['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    
                                   
        }

}elseif($count!=0 ){


    


                                         ?>
                                        <script>
                                            alert('Droit attestation déjà validé !!! ');
                                             window.location.href='<?=$etude_dossier['option2_link']?>?witness=-1';
                                        </script>
                                        <?php

}
        
       
        
                                    
                                    


}
?>
