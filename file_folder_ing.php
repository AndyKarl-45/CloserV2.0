 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>
<?php

if($_POST)
 {  $id= $_POST['id_personnel'];
    $date=date('Y-m-d');

    $fichier=['pj_di','pj_pcdd','pj_apodi','pj_pcb','pj_ccc','pj_cn','pj_bn','pj_cv','pj_ra','pj_lp'];

    $max=10;



    for ($j = 0; $j <$max; $j++) {
     $fichier[$j].'</br>';      
              ;

         
    
        if (!empty(($_FILES))) {

            $file_count = count($_FILES['fichier']);
            $autorized_extensions = array('.DOCX', '.docx', '.DOC', '.doc', '.PPTX', '.pptx', '.XLSX', '.xlsx', '.CSV', '.csv', '.pdf', '.PDF', '.jpeg', '.JPEG', '.jpg', '.JPG', '.png');

             // echo 'counter : ' . $file_count . '<br/>';

                $file_name = $_FILES['fichier']['name'][$j];
                // echo $file_name;
                $file_extension = strrchr($file_name, ".");
                $file_content = $_FILES['fichier']['tmp_name'][$j];
                $file_size = $_FILES['fichier']['size'][$j];
                $file_dest = 'fichiersDocIng/' . $file_name;

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

                if (in_array($file_extension, $autorized_extensions)) {
                    if ((move_uploaded_file($file_content, $file_dest) && ($_FILES['fichier']['error'][$j] == 0))) {
        
                        // save dans la table pièce jointe 
                         $stmp = "INSERT INTO $fichier[$j] (id_entite, nom_pj, lien, date_save)
                                                VALUES('$id','$file_name', '$file_dest','$date')";
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

        if($max)
                                    {
                                        ?>
                                        <script>
                                            alert('Fichier a été bien enregistrée.');
                                                  window.location.href='details_ingenieur.php?id=<?=$id?>&witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                             window.location.href='details_ingenieur.php?id=<?=$id?>&witness=1';
                                        </script>
                                        <?php
                                       
                                    }


    






}
?>