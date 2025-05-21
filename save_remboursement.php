 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>
<?php

if($_POST)
 {  
     $user =$_SESSION['rainbo_name'];
     $lvl =$_SESSION['rainbo_lvl'] ;
     $email_user =$_SESSION['rainbo_email'] ;
     $id_session =$_SESSION['rainbo_id_perso'] ;
     
    $email_user1='jfkonde@syges.cm'; 
    $email_user_2='elodiemanga987@gmail.com';
    // $email_user_3='mboningandy43@gmail.com';
    $email_user_4='ndenguedanny@yahoo.fr';
                 
     $id_ing = $_POST['id_ing'];
     $montant = $_POST['montant'];
     $ref_dem_rem = $_POST['ref_dem_rem'];
    //  $ref_paie = $_POST['ref_paie'];
    $ref_paie='N/A';
     $ope = $_POST['ope'];
     $date_dem_rem = date('Y-m-d');
    //  $justif= $_POST['justif'];
     $id_caisse=3;
     
             $cnts=0;
        $sql="SELECT count(id_rem) as total FROM  remboursement where (ref_dem_rem='$ref_dem_rem' and etat = 0) or (ref_dem_rem='$ref_dem_rem' and etat = 1)  ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($tables as $table)
                    {
                      $cnts=$table['total'];
                    }

        if($cnts!=0){
            ?>
            <script>
                //alert('Personnel a été bien enregistrée.');
                      window.location.href='<?=$remboursement['option2_link']?>?witness=-2';
            </script>
            <?php
        }else{


    $heures=date("G:i");

            //-----------------------SAVE REMBOURSEMENT--------------------//
                           
                $sql = "INSERT INTO remboursement (id_ing, montant, ope, date_dem_rem,ref_dem_rem,ref_paie,id_caisse,heure)
                                VALUES(:id,:montant,:ope, :date_dem_rem,:ref_dem_rem,:ref_paie,:id_caisse,:heure)";
        $req = $db->prepare($sql);

        // Bind parameters to statement
        $req->bindParam(':id', $id_ing);
        $req->bindParam(':montant', $montant);
        $req->bindParam(':ope', $ope);
        $req->bindParam(':date_dem_rem', $date_dem_rem);
        $req->bindParam(':ref_dem_rem', $ref_dem_rem);
        $req->bindParam(':ref_paie', $ref_paie);
        $req->bindParam(':id_caisse', $id_caisse);
        $req->bindParam(':heure', $heures);
        $req->execute();
        
        
        $sql="SELECT matricule FROM  mytable where id_ingenieur='$id_ing'";
        $stmt = $db->prepare($sql);
        $stmt->execute();

         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($tables as $table)
                    {
                      $matricule=$table['matricule'];
                    }
                    

                    

                    
        
        $sql="SELECT Max(id_rem) as total   FROM  remboursement ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($tables as $table)
                    {
                     $id_rem=$table['total'];
                    }


            //--------------------- SAVE FILE -----------------------//
                  
    
        if (!empty(($_FILES))) {

            $file_count = count($_FILES['fichier']);
            $autorized_extensions = array('.DOCX', '.docx', '.DOC', '.doc', '.PPTX', '.pptx', '.XLSX', '.xlsx', '.CSV', '.csv', '.pdf', '.PDF', '.jpeg', '.JPEG', '.jpg', '.JPG','.png','.PNG');

             // echo 'counter : ' . $file_count . '<br/>';

                $file_name = $_FILES['fichier']['name'];
                // echo $file_name;
                $file_extension = strrchr($file_name, ".");
                $file_content = $_FILES['fichier']['tmp_name'];
                $file_size = $_FILES['fichier']['size'];
                $file_dest = 'filesRem/' . $file_name;

                // if ($i == 1 || $i == 4) {
                //     $date_signature = $_POST['date_signature_' . $i];
                //     $date_reception = date("Y-m-s");
                // }
                // if ($i == 2 || $i == 3) {
                //     $date_signature = date("Y-m-s");
                //     $date_reception = date("Y-m-s");
                // }
                // if ($i == 0) {
                //     $date_signature = $_POST['date_signature_' . $i];
                //     $date_reception = $_POST['date_reception_' . $i];
                // }

//            echo 'File '.$i.' : '.$file_name.'<br/>';
//            echo '-> : '.$file_extension.'<br/>';
//            echo '-> : '.$file_content.'<br/>';
//            echo '-> : '.$file_size.'<br/>';
//            echo '-> : '.$file_dest.'<br/>';
                $heures=date("G:i");

                if (in_array($file_extension, $autorized_extensions)) {
                    if ((move_uploaded_file($file_content, $file_dest) && ($_FILES['fichier']['error'] == 0))) {
                            // echo 'user: '.$id_ing.' id_rem: '.$id_rem.' nom_pj: '.$file_name.' lien: '.$file_dest.'date: '.$date_dem_rem;
                        // save dans la table pièce jointe 
                         $stmp = "INSERT INTO pj_rem(id_entite,id_rem, nom_pj, lien,date_save,heure)
                                                VALUES('$id_ing','$id_rem','$file_name', '$file_dest','$date_dem_rem','$heures')";
                        $sql = $db->query($stmp);
                        
                        // mis à jour de la table etat académique
                            
                        // $etat = "UPDATE etat_academique SET  nom_pj=:file_name, lien=:file_dest 
                        // where id_perso ='$id'  ";
                        // $req = $db->prepare($etat);
                        //         $req->bindParam(':file_name', $file_name);
                        //         $req->bindParam(':file_dest', $file_dest);
                        //          $req->execute();


        //                  $sql = "INSERT INTO etat_academique (id_perso, diplome, session, ecole, mention,nom_pj,lien)
        //                         VALUES(:id,:diplome,:session, :ecole, :mention, :file_name, :file_dest)";
        // $req = $db->prepare($sql);

        // // Bind parameters to statement
        // $req->bindParam(':id', $id);
        // $req->bindParam(':diplome', $diplome[$j]);
        // $req->bindParam(':session', $session[$j]);
        // $req->bindParam(':ecole', $ecole[$j]);
        // $req->bindParam(':mention', $mention[$j]);
        // $req->bindParam(':file_name', $file_name);
        // $req->bindParam(':file_dest', $file_dest);
        // $req->execute();

                        // $stmp = "INSERT INTO pj_etat_academique(id_personnel, nom_pj, lien)
                        //                         VALUES('$id','$file_name', '$file_dest')";
                        // $sql = $conn->query($stmp);

                        // echo "<div class='alert alert-success'>File " . $i . " have been saved !</div><br/>";
                    } else { 
                    }



                } else {
                    // echo "<div class='alert alert-danger'>Type de document N°" . $i . " pas autorisé ! (docx, xlsx, pptx, csv,jpeg, jpg et pdf). Vous devez choisir au moins un document autorisé sinon l'enregistrement ne se fera pas.</div>";
                }
            
         }
    }


     if(empty($matricule)){
         $matricule='Aucun';
     }

        
            if($req)
                                    {
                                        
                                        //-------------------------------------------------------------------//
                                        ///--------------------MAIL---------------------------///
                                                    $mailler = new mailsenderclass();
            
                                    $subject = "Demande d'activation d'attestation";
                                    $body = "Demande d'activation d'attestation effectuee par le membre de matricule : "
                                        .$matricule." le "
                                        .date("d/m/Y"). " A "
                                        .date("G:i")
                                        ." pour la l'attestation de reference".$ref_dem_rem." dont le montant est de ".$montant." FCFA<br/>
                                                                     <a href='closer.cm'>Voir les details</a>";
                                    $body2 = "Bonjour ".ucfirst(strtolower($user)).",<br/> Nous accusons reception de votre demande d'activation de l'attestation du : "
                                        .date("d/m/Y"). " A "
                                        .date("G:i")
                                        ." pour la l'attestation de reference ".$ref_dem_rem." dont le montant est de ".$montant." FCFA <br/>
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
                                    //  $mailler->mailsenderclass($email_user_3, $from, $from_name, $subject, $body);
                                      $mailler->mailsenderclass($email_user_4, $from, $from_name, $subject, $body);
                                     if($lvl == 1){
                                    $mailler->mailsenderclass($email_user, $from, $from_name, $subject, $body2);
                                     }
                                        //////////////////////////////////////////////////////////////////////
                                        
                                        ?>
                                        <script>
                                            //alert('Personnel a été bien enregistrée.');
                                                //   window.location.href='<?=$remboursement['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                           // alert('Personnel existe déjà.');
                                             window.location.href='<?=$remboursement['option2_link']?>?witness=-2';
                                        </script>
                                        <?php
                                       
                                    }

    






}
?>