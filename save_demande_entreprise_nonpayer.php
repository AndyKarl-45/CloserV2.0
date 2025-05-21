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
         
         $id_user_perso = $_SESSION['rainbo_id_perso'];
         
         $bn_user_ter=0;
        if($lvl !==1){
            $query1 = "SELECT * from personnel WHERE id_personnel= $id_user_perso";
           $stmt = $db->prepare($query1);
            $stmt->execute();
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($tables as $row1)
            {
                $nom_us = $row1["nom"] . ' ' . $row1["prenom"];
                $bn_user_ter++;
            }
        }else{
            if($bn_user_dette == 0){
            $query1 = "SELECT * from mytable WHERE id_ingenieur= $id_user_perso";
            $stmt = $db->prepare($query1);
            $stmt->execute();
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($tables as $row1)
            {
                    $nom_us = $row1["nom_ing"] . ' ' . $row1["prenom_ing"];
                    $bn_user_ter++;
                    
            }
        }
        }
        
        
        if($bn_user_ter == 0 ){
           ?>
            <script>
               // alert('Error.');
                 window.location.href='<?=$demande_entreprise_nonpayer['option2_link']?>?witness=-1;
            </script>
            <?php
        }
        

        $id_perso = $_POST['id_personnel'];
        if($lvl==1){$id_caisse=3;}else{$id_caisse= $_POST['id_caisse'];}
        
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

        
                                   
                                    $etat=0;
                                    $sql = "INSERT INTO demande_entreprise (id_caisse,ref_dem_ent,id_ing,id_entreprise,objet,droit,date_dem_ent,id_perso,annee,id_auteur,auteur)
                                  VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                               $req->execute(array($id_caisse,$ref_dem_ent,$id_ing,$id_entreprise,$objet,$droit,$date_dem_ent,$id_perso,$annee,$id_user_perso,$nom_us));
                                
                                


                                    if($req)
                                    {
                                        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                             window.location.href='<?=$demande_entreprise_nonpayer['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                           // alert('Error.');
                                            window.location.href='<?=$demande_entreprise_nonpayer['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }



// }else{

//          ?>
//                                         <script>
//                                             alert('Existe Déjà !!! ');
//                                              window.location.href='<?=$demande_entreprise_nonpayer['option2_link']?>?witness=-1';
//                                         </script>
//                                         <?php
//                                     }



}

?>
