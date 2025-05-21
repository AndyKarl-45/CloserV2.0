 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               
    if($lvl >= 13 || $lvl == 11){
     $user =$_SESSION['rainbo_name'];
     $lvl =$_SESSION['rainbo_lvl'] ;
     $email_user_perso =$_SESSION['rainbo_email'] ;
     $id_session =$_SESSION['rainbo_id_perso'] ;
    }
    
    $email_user1='jfkonde@syges.cm'; 
    $email_user_2='elodiemanga987@gmail.com';
    // $email_user_3='mboningandy43@gmail.com';
    $email_user_4='ndenguedanny@yahoo.fr';
                 

        /*--------------------------------- ETAT INFOS RH -------------------------------------*/
        $id = $_POST['id_rem'];
        $etats = $_POST['etat'];
        $date_val_rem = date('Y-m-d');
        $somme_rembourser = 1000;
        //date("d/m/Y")
        
            $sql="SELECT * from remboursement where id_rem='$id'  ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($tables as $table)
                {
                    $date_dem_rem=$table['date_dem_rem'];
                    $id_ing = $table['id_ing'];
                 $montant = $table['montant'];
                 $ref_dem_rem = $table['ref_dem_rem'];
                 $ope = $table['ope'];
                 $etat = $table['etat'];
                  $id_caisse = $table['id_caisse'];
                }
            $query = "SELECT * from users_members WHERE id_ingenieur='$id_ing'";
            $stmt = $db->prepare($query);
            $stmt->execute();
    
             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                foreach($tables as $table)
                    {
                      $email_user_ing=$table['email'];
                    }
                
                
                
        $sql="SELECT * FROM  mytable where id_ingenieur='$id_ing'";
        $stmt = $db->prepare($sql);
        $stmt->execute();

         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($tables as $table)
                    {
                      $matricule=$table['matricule'];
                      $nom_ing=strtoupper($table['nom_ing']).' '.strtolower($table['prenom_ing']);
                    }
                

        /*--------------------------------- SAVE DATA INFOS RH ---------------------------*/

     switch ($etats){
        case '0';
        
                            
                    /*------------------ Remboursment -----------------------*/
                /*-----recupère le solde de la caisse ---------*/
                $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                 $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach($tables as $table)
                            {
                                $solde=$table['total'];
                                
                            }
                /*------------------soustraction avec vérification si le remboursement a été d'abord effectuer(1) ou pas(0)--------------------*/
                      if($etat==1){
                          $somme=$solde+$somme_rembourser;
                          
                            $ref_caisse=$ref_dem_rem;
                    $id_beneficiaire=$id_ing;
                    $sommes=$somme_rembourser;
                    $date_hist=date('Y-m-d');
                    $statuts='E';
                    $service='remboursement';
            
            
                    $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,service)
                              VALUES (?,?,?,?,?,?,?)";
                            $req = $db->prepare($sql);
                            $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$sommes,$date_hist,$statuts,$service));
                            
                            
                      }else{
                          $somme=$solde;
                      }  
             
             
              /*------------------mise à jour--------------------*/
                        
                $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
                $sql1 = $db->prepare($query1);
        
                 // Bind parameters to statement
                $sql1->bindParam(':payer', $somme);
                $sql1->execute();
    
            //--------EN COURS-------//

                             $query1  = " UPDATE remboursement SET etat=:etat WHERE id_rem = '$id' ";

                        

                $sql1 = $db->prepare($query1);

                     // Bind parameters to statement
                    $sql1->bindParam(':etat', $etats);
                    $sql1->execute();

                                if($sql1)
                                            {
                                                ///--------------------MAIL---------------------------///
                                                    $mailler = new mailsenderclass();
            
                                    $subject = "Demande d'activation d'attestation";
                                    $body = "Demande d'activation d'attestation effectuee par le membre de matricule : "
                                        .strtoupper($matricule)." le "
                                        .$date_dem_rem. " <b> est en cours </b> pour la l'attestation de reference: <b>"
                                        .$ref_dem_rem."</b> dont le montant est de <b>"
                                        .$montant."</b> FCFA<br/>
                                                                     <a href='closer.cm'>Voir les details</a>";
                                    $body2 = "Bonjour ".ucfirst(strtolower($nom_ing)).",<br/> Nous accusons reception de votre  demande de remboursement du : "
                                        .$date_dem_rem. " <b> est en cours </b> pour la l'attestation de reference: <b>"
                                        .$ref_dem_rem." </b> dont le montant est de <b>"
                                        .$montant."</b> FCFA <br/>
                                                                     <a href='closer.cm'>Voir les details</a>";
            
                                    $from= 'infomail@closer.cm';
                                    $from_name='ONIGC';
                                    // $sql = $db->query("select * from users where secteur = $id_secteur_user and (lvl = 4 or lvl = 3 or lvl = 8 or lvl = 7)");
                                    // while($row = $sql->fetch()){
                                    //     $to = $row['email'];
                                    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
                                    // }
            
                                    // $sql = $db->query("select * from users where (lvl = 5 or lvl = 6 )");
                                    // while($row = $sql->fetch()){
                                    //     $to = $row['email'];
                                    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
                                    // }
                                    //mail_elodie;
            
                                     $mailler->mailsenderclass($email_user1, $from, $from_name, $subject, $body);
                                     $mailler->mailsenderclass($email_user_2, $from, $from_name, $subject, $body);
                                     $mailler->mailsenderclass($email_user_perso, $from, $from_name, $subject, $body);
                                     $mailler->mailsenderclass($email_user_4, $from, $from_name, $subject, $body);
                                    $mailler->mailsenderclass($email_user_ing, $from, $from_name, $subject, $body2);
                                     
                                        //////////////////////////////////////////////////////////////////////
                                        
                                                ?>
                                                <script>
                                                   // alert('Postulant a été bien mis à jour.');
                                                         window.location.href='<?=$remboursement['option2_link']?>?witness=1';
                                                </script>
                                                <?php
                                            }

                                            else
                                            {       
                                              ?>
                                                <script>
                                                    alert('Postulant n\'a pas été mis à jour.');
                                                    window.location.href='modifier_statut_remboursement.php?id=<?=$id?>&etat=<?=$etat?>;
                                                </script>
                                                <?php
                                               
                                            }

            //----------EN COURS-----//
            break;
        case '1';

           //--------SUCCESS-------//
             // echo'good';
                $query1  = " UPDATE remboursement SET etat=:etat, date_val_rem=:date, id_perso=:id_perso WHERE id_rem = '$id' ";
                $sql1 = $db->prepare($query1);

                     // Bind parameters to statement
                    $sql1->bindParam(':etat', $etats);
                    $sql1->bindParam(':date', $date_val_rem);
                    $sql1->bindParam(':id_perso', $id_session);
                    $sql1->execute();
                
                
                /*------------------ Remboursment -----------------------*/
                /*-----recupère le solde de la caisse ---------*/
                $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                 $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach($tables as $table)
                            {
                                $solde=$table['total'];
                                
                            }
                /*------------------soustraction--------------------*/
                        
             $somme=$solde-$somme_rembourser;
             
              /*------------------mise à jour--------------------*/
                        
                $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
                $sql1 = $db->prepare($query1);
        
                 // Bind parameters to statement
                $sql1->bindParam(':payer', $somme);
                $sql1->execute();
                
                   $ref_caisse=$ref_dem_rem;
                    $id_beneficiaire=$id_ing;
                    $somme=$somme_rembourser;
                    $date_hist=date('Y-m-d');
                    $statuts='S';
                    $service='remboursement';
            
            
                    $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_sortie,date_hist,statut,service)
                              VALUES (?,?,?,?,?,?,?)";
                            $req = $db->prepare($sql);
                            $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$somme,$date_hist,$statuts,$service));



    // $query = "DELETE FROM litige WHERE id_personnel='$id'";
    // $sql = $conn->query($query);

                                if($sql1)
                                            {
                                                 /*-----------------------------------MAIL-----------------------------------------*/

                                                                    $mailler = new mailsenderclass();
                                        
                                                    $subject = "Demande de Remboursement";
                                                    $body = "Demande de Remboursement effectuee par le membre de matricule : "
                                                        .strtoupper($matricule)." le "
                                                        .$date_dem_rem. " est <b style='color:green'>valide</b>  pour la l'attestation de reference: <b>"
                                                        .$ref_dem_rem." </b> dont le montant est de <b>"
                                                        .$montant."</b> FCFA<br/>
                                                                                     <a href='closer.cm'>Voir les details</a>";
                                                    $body2 = "Bonjour  ".ucwords($nom_ing).",<br/> Nous accusons reception de votre  demande de remboursement du : "
                                                        .$date_dem_rem. " est bien <b style='color:green'> valide</b> pour la l'attestation de reference: <b>"
                                                        .$ref_dem_rem."</b> dont le montant est de <b>"
                                                        .$montant."</b> FCFA <br/>
                                                                                     <a href='closer.cm'>Voir les details</a>";
                                        
                                                    $from= 'infomail@closer.cm';
                                                    $from_name='ONIGC';
                                                    // $sql = $db->query("select * from users where secteur = $id_secteur_user and (lvl = 4 or lvl = 3 or lvl = 8 or lvl = 7)");
                                                    // while($row = $sql->fetch()){
                                                    //     $to = $row['email'];
                                                    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
                                                    // }
                                        
                                                    // $sql = $db->query("select * from users where (lvl = 5 or lvl = 6 )");
                                                    // while($row = $sql->fetch()){
                                                    //     $to = $row['email'];
                                                    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
                                                    // }
                                                    //mail_elodie;
                                        
                                                      $mailler->mailsenderclass($email_user1, $from, $from_name, $subject, $body);
                                                      $mailler->mailsenderclass($email_user_2, $from, $from_name, $subject, $body);
                                                    $mailler->mailsenderclass($email_user_perso, $from, $from_name, $subject, $body);
                                                     $mailler->mailsenderclass($email_user_4, $from, $from_name, $subject, $body);
                                                     if($lvl == 1){
                                                    $mailler->mailsenderclass($email_user_ing, $from, $from_name, $subject, $body2);
                                                     }
                                                                          
                                                /*--------------------------------------------------------------------------------*/
                                                
                                                ?>
                                                <script>
                                                   // alert('Postulant est en formation.');
                                                            window.location.href='<?=$remboursement['option2_link']?>?witness=1';
                                                </script>
                                                <?php
                                            }

                                            else
                                            {       
                                              ?>
                                                <script>
                                                    alert('Error');
                                                     window.location.href='modifier_statut_remboursement.php?id=<?=$id?>&etat=<?=$etat?>;
                                                </script>
                                                <?php
                                               
                                            }
            //----------FIN SUCCESS-----//
            break;
        case '2';
          
                    
            
                         
                    
                    /*------------------ Remboursment -----------------------*/
                /*-----recupère le solde de la caisse ---------*/
                $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                 $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach($tables as $table)
                            {
                                $solde=$table['total'];
                                
                            }
                /*------------------soustraction avec vérification si le remboursement a été d'abord effectuer(1) ou pas(0)--------------------*/
                      if($etat==1){
                          $somme=$solde+$somme_rembourser;
                          
                            $ref_caisse=$ref_dem_rem;
                    $id_beneficiaire=$id_ing;
                    $sommes=$somme_rembourser;
                    $date_hist=date('Y-m-d');
                    $statuts='E';
                    $service='remboursement';
            
            
                    $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,service)
                              VALUES (?,?,?,?,?,?,?)";
                            $req = $db->prepare($sql);
                            $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$sommes,$date_hist,$statuts,$service));
                            
                            
                      }else{
                          $somme=$solde;
                      }  
             
             
              /*------------------mise à jour--------------------*/
                        
                $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
                $sql1 = $db->prepare($query1);
        
                 // Bind parameters to statement
                $sql1->bindParam(':payer', $somme);
                $sql1->execute();
                
                 
                            
                            
                /*-------------update-------------*/
                
                   $query1  = " UPDATE remboursement SET etat=:etat, date_val_rem=:date, id_perso=:id_perso WHERE id_rem = '$id' ";
                $sql1 = $db->prepare($query1);

                     // Bind parameters to statement
                    $sql1->bindParam(':etat', $etats);
                    $sql1->bindParam(':date', $date_val_rem);
                    $sql1->bindParam(':id_perso', $id_session);
                    $sql1->execute();
                            
                            




                                    if($sql1)
                                                {
                                                     /*-----------------------------------MAIL-----------------------------------------*/

                                                                    $mailler = new mailsenderclass();
                                        
                                                    $subject = "Demande de Remboursement";
                                                    $body = "Demande de Remboursement effectuee par le membre de matricule : "
                                                        .strtoupper($matricule)." le "
                                                        .$date_dem_rem. " <b style='color:red'>n'est pas valide</b>  pour la l'attestation de reference: <b>"
                                                        .$ref_dem_rem."</b> dont le montant est de <b>"
                                                        .$montant."</b>FCFA<br/>
                                                                                     <a href='closer.cm'>Voir les details</a>";
                                                    $body2 = "Bonjour ".ucwords($nom_ing).",<br/> Nous accusons reception de votre  demande de remboursement du : "
                                                        .$date_dem_rem. "  <b style='color:red'>n'est pas valide</b> pour la l'attestation de reference: <b>"
                                                        .$ref_dem_rem."</b> dont le montant est de <b>"
                                                        .$montant."</b> FCFA <br/>
                                                                                     <a href='closer.cm'>Voir les details</a>";
                                        
                                                    $from= 'infomail@closer.cm';
                                                    $from_name='ONIGC';
                                                    // $sql = $db->query("select * from users where secteur = $id_secteur_user and (lvl = 4 or lvl = 3 or lvl = 8 or lvl = 7)");
                                                    // while($row = $sql->fetch()){
                                                    //     $to = $row['email'];
                                                    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
                                                    // }
                                        
                                                    // $sql = $db->query("select * from users where (lvl = 5 or lvl = 6 )");
                                                    // while($row = $sql->fetch()){
                                                    //     $to = $row['email'];
                                                    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
                                                    // }
                                                    //mail_elodie;
                                        
                                                    //   $mailler->mailsenderclass($email_user1, $from, $from_name, $subject, $body);
                                                    //   $mailler->mailsenderclass($email_user_2, $from, $from_name, $subject, $body);
                                                    //  $mailler->mailsenderclass($email_user_perso, $from, $from_name, $subject, $body);
                                                    //  $mailler->mailsenderclass($email_user_4, $from, $from_name, $subject, $body);
                                                    // $mailler->mailsenderclass($email_user_ing, $from, $from_name, $subject, $body2);
                                                     
                                                                          
                                                /*--------------------------------------------------------------------------------*/
                                                    
                                                    
                                                    ?>
                                                    <script>
                                                      //  alert('Postulant est devenu stagiaire.');
                                                                window.location.href='<?=$remboursement['option2_link']?>?witness=1';
                                                    </script>
                                                    <?php
                                                }

                                                else
                                                {       
                                                  ?>
                                                    <script>
                                                       // alert('Error');
                                                        window.location.href='modifier_statut_remboursement.php?id=<?=$id?>&etat=<?=$etat?>;
                                                    </script>
                                                    <?php
                                                   
                                                }

            //----------FIN EMPLOYÉ-----//
            break;
    }

}
?>
