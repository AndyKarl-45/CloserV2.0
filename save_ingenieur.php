 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               


        
        //  $nom_ing = $_POST['nom_ing'];
        // $prenom_ing = $_POST['prenom_ing'];
        // $matricule = $_POST['matricule'];
        // $num_ordre = $_POST['num_ordre'];
        // $tel_ing = $_POST['tel_ing'];
        // $email_ing = $_POST['email_ing'];

        $matricule = $_POST['matricule'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
       // $id_card_number = $_POST['id_card_number'];
       // $id_card_validity =  $_POST['id_card_validity'];
         $tel = $_POST['tel'];
         $email = $_POST['email'];
        //  $date_naissance = $_POST['date_naissance'];
        //  $lieu_naissance = $_POST['lieu_naissance'];
        //  $profession = $_POST['profession'];
        //  $situation_matrimoniale = $_POST['situation_matrimoniale'];
        //  $nombre_enfants = $_POST['nombre_enfants'];
         $genre = $_POST['genre'];
        //  $id_quartier = $_POST['id_quartier'];
         $id_ville = $_POST['id_ville'];
         $statut="N/A";
         
         $bn_user_dette=0;
         $id_user_perso = $_SESSION['rainbo_id_perso'];
        
        $query1 = "SELECT * from personnel WHERE id_personnel= $id_user_perso";
       $stmt = $db->prepare($query1);
        $stmt->execute();
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($tables as $row1)
        {
            $nom_us = $row1["nom"] . ' ' . $row1["prenom"];
            $bn_user_dette++;
        }
        
        if($bn_user_dette == 0){
            $query1 = "SELECT * from mytable WHERE id_ingenieur= $id_user_perso";
            $stmt = $db->prepare($query1);
            $stmt->execute();
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($tables as $row1)
            {
                    $nom_us = $row1["nom_ing"] . ' ' . $row1["prenom_ing"];
                    $bn_user_dette++;
                    
            }
        }
        if($bn_user_dette == 0 ){
           ?>
            <script>
               // alert('Error.');
                //  window.location.href='<?=$dette['option2_link']?>?witness=-1';
            </script>
            <?php
        }
        

         $date_inscription=date('Y-m-d');
         $sql="SELECT * FROM ville where id_ville='$id_ville' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $id_pays=$table['id_pays'];
                                        }
          $sql="SELECT YEAR('$date_inscription') as total  ";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach($tables as $table)
                        {
                            $annee=$table['total'];
                        }
        
       
        // SELECT label, SUBSTR(label, 6, length(label)-12 ) FROM `llxmh_actioncomm`
                          

//--------------------------------- insertion un fournisseur -----------------------------------------//
                   

     //     $query = " INSERT INTO mytable (matricule,nom_ing,prenom_ing,num_ordre,tel_ing,email_ing) 
     //                 VALUES (:matricule,:nom_ing,:prenom_ing,:num_ordre,:tel_ing,:email_ing)";

     //             $sql = $db->prepare($query);

     // // Bind parameters to statement
            
     //        $sql->bindParam(':matricule', $matricule);
     //        $sql->bindParam(':nom_ing', $nom_ing);
     //        $sql->bindParam(':prenom_ing', $prenom_ing);
     //        $sql->bindParam(':num_ordre', $num_ordre);
     //        $sql->bindParam(':tel_ing', $tel_ing);
     //        $sql->bindParam(':email_ing', $email_ing);
     //        $sql->execute();


           if(!empty($email)){
        
        $query = "SELECT count(email) as total  from mytable WHERE email='$email' and open_close!=1";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
          echo  $total = $row["total"];
        }
        
        if($total==0){
            //-------------------Mis à jour de l'email du personnel dans la table users ----------------------//
                    $sql = $conn->query("UPDATE users_members SET email = '$email' WHERE id_perso='$id' and statut='A'");
              //------------------------------------------------------------------------------------------------//
        }else{
            ?>
            <script>
                //alert('Personnel a été bien modifié.');
                        window.location.href='<?=$ingenieur['option2_link']?>?&witness=-3';
            </script>
            <?php
        }

    }




//if($date_naissance!="" and $id_card_validity!=""){

$query1 = " INSERT INTO mytable (matricule,nom_ing,prenom_ing,tel_ing,email_ing,genre,id_ville,id_pays,statut,date_inscription,annee,id_auteur,auteur) 
        VALUES 
        (:matricule,:nom,:prenom,:tel,:email,:genre,:id_ville,:id_pays,:statut,:date_inscription,:annee,:id_user_perso,:nom_us)";

                

        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':matricule', $matricule);
            $sql1->bindParam(':nom', $nom);
            $sql1->bindParam(':prenom', $prenom);
            $sql1->bindParam(':tel', $tel);
            $sql1->bindParam(':email', $email);
          //  $sql1->bindParam(':id_card_number', $id_card_number);
          //  $sql1->bindParam(':id_card_validity', $id_card_validity);
          //  $sql1->bindParam(':date_naissance', $date_naissance);
          //  $sql1->bindParam(':lieu_naissance', $lieu_naissance);
          //  $sql1->bindParam(':profession', $profession);
          //  $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
          //  $sql1->bindParam(':nombre_enfants', $nombre_enfants);
            $sql1->bindParam(':genre', $genre);
          //  $sql1->bindParam(':id_quartier', $id_quartier);
            $sql1->bindParam(':id_ville', $id_ville);
            $sql1->bindParam(':id_pays', $id_pays);
            $sql1->bindParam(':statut', $statut);
            $sql1->bindParam(':date_inscription', $date_inscription);
            $sql1->bindParam(':annee', $annee);
            $sql1->bindParam(':id_user_perso', $id_user_perso);
            $sql1->bindParam(':nom_us', $nom_us);
            $sql1->execute();

//}


// if($date_naissance=="" and $id_card_validity!=""){

// $query1 = " INSERT INTO mytable (matricule,nom_ing,prenom_ing,tel_ing,email_ing,id_card_number,id_card_validity,lieu_naissance,profession,situation_matrimoniale,nombre_enfants,genre,id_quartier,id_ville,id_pays,statut,date_inscription,annee) 
//         VALUES 
//         (:matricule,:nom,:prenom,:tel,:email,:id_card_number,:id_card_validity,:lieu_naissance,:profession,:situation_matrimoniale,:nombre_enfants,:genre,:id_quartier,:id_ville,:id_pays,:statut,:date_inscription,:annee)";

                

//         $sql1 = $db->prepare($query1);

//              // Bind parameters to statement
//             $sql1->bindParam(':matricule', $matricule);
//             $sql1->bindParam(':nom', $nom);
//             $sql1->bindParam(':prenom', $prenom);
//             $sql1->bindParam(':tel', $tel);
//             $sql1->bindParam(':email', $email);
//             $sql1->bindParam(':id_card_number', $id_card_number);
//             $sql1->bindParam(':id_card_validity', $id_card_validity);
//             $sql1->bindParam(':lieu_naissance', $lieu_naissance);
//             $sql1->bindParam(':profession', $profession);
//             $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
//             $sql1->bindParam(':nombre_enfants', $nombre_enfants);
//             $sql1->bindParam(':genre', $genre);
//             $sql1->bindParam(':id_quartier', $id_quartier);
//             $sql1->bindParam(':id_ville', $id_ville);
//             $sql1->bindParam(':id_pays', $id_pays);
//             $sql1->bindParam(':statut', $statut);
//             $sql1->bindParam(':date_inscription', $date_inscription);
//             $sql1->bindParam(':annee', $annee);
//             $sql1->execute();

// }


// if($date_naissance!="" and $id_card_validity==""){

// $query1 = " INSERT INTO mytable (matricule,nom_ing,prenom_ing,tel_ing,email_ing,id_card_number,date_naissance,lieu_naissance,profession,situation_matrimoniale,nombre_enfants,genre,id_quartier,id_ville,id_pays,statut,date_inscription,annee) 
//         VALUES 
//         (:matricule,:nom,:prenom,:tel,:email,:id_card_number,:date_naissance,:lieu_naissance,:profession,:situation_matrimoniale,:nombre_enfants,:genre,:id_quartier,:id_ville,:id_pays,:statut,:date_inscription,:annee)";

                

//         $sql1 = $db->prepare($query1);

//              // Bind parameters to statement
//             $sql1->bindParam(':matricule', $matricule);
//             $sql1->bindParam(':nom', $nom);
//             $sql1->bindParam(':prenom', $prenom);
//             $sql1->bindParam(':tel', $tel);
//             $sql1->bindParam(':email', $email);
//             $sql1->bindParam(':id_card_number', $id_card_number);
//             $sql1->bindParam(':date_naissance', $date_naissance);
//             $sql1->bindParam(':lieu_naissance', $lieu_naissance);
//             $sql1->bindParam(':profession', $profession);
//             $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
//             $sql1->bindParam(':nombre_enfants', $nombre_enfants);
//             $sql1->bindParam(':genre', $genre);
//             $sql1->bindParam(':id_quartier', $id_quartier);
//             $sql1->bindParam(':id_ville', $id_ville);
//             $sql1->bindParam(':id_pays', $id_pays);
//             $sql1->bindParam(':statut', $statut);
//             $sql1->bindParam(':date_inscription', $date_inscription);
//             $sql1->bindParam(':annee', $annee);
//             $sql1->execute();

// }






// if($date_naissance=="" and $id_card_validity==""){

//     $query1 = " INSERT INTO mytable (matricule,nom_ing,prenom_ing,tel_ing,email_ing,id_card_number,lieu_naissance,profession,situation_matrimoniale,nombre_enfants,genre,id_quartier,id_ville,id_pays,statut,date_inscription,annee) 
//         VALUES 
//         (:matricule,:nom,:prenom,:tel,:email,:id_card_number,:lieu_naissance,:profession,:situation_matrimoniale,:nombre_enfants,:genre,:id_quartier,:id_ville,:id_pays,:statut,:date_inscription,:annee)";

                

//         $sql1 = $db->prepare($query1);

//              // Bind parameters to statement
//             $sql1->bindParam(':matricule', $matricule);
//             $sql1->bindParam(':nom', $nom);
//             $sql1->bindParam(':prenom', $prenom);
//             $sql1->bindParam(':tel', $tel);
//             $sql1->bindParam(':email', $email);
//             $sql1->bindParam(':id_card_number', $id_card_number);
//             $sql1->bindParam(':lieu_naissance', $lieu_naissance);
//             $sql1->bindParam(':profession', $profession);
//             $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
//             $sql1->bindParam(':nombre_enfants', $nombre_enfants);
//             $sql1->bindParam(':genre', $genre);
//             $sql1->bindParam(':id_quartier', $id_quartier);
//             $sql1->bindParam(':id_ville', $id_ville);
//             $sql1->bindParam(':id_pays', $id_pays);
//             $sql1->bindParam(':statut', $statut);
//             $sql1->bindParam(':date_inscription', $date_inscription);
//             $sql1->bindParam(':annee', $annee);
//             $sql1->execute();

// }




                                    if($sql1)
                                    {
                                        ?>
                                        <script>
                                            // alert('fournisseur a été bien enregistrée.');
                                             window.location.href='<?=$ingenieur['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                            window.location.href='<?=$ingenieur['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
