 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php");
?>

<?php

if($_POST)
{               


        /*--------------------------------- ETAT CIVILE -------------------------------------*/
        $id = $_POST['id_personnel'];
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
            // $id_quartier=$_POST['id_quartier'];
            $annee=$_POST['year'];
             $matricule=$_POST['matricule'];
            $id_ville=$_POST['id_ville'];

                        $sql="SELECT * FROM ville where id_ville='$id_ville' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $id_pays=$table['id_pays'];
                                        }

        // echo $nom.'</br>';
        // echo $prenom.'</br>';
        // echo $id_card_number.'</br>';
        // echo $id_card_validity.'</br>';
        // echo $tel.'</br>';
        // echo $email.'</br>';
        //  echo $nom_pere.'</br>';
        //  echo $nom_mere.'</br>';
        // echo $date_naissance.'</br>';
        // echo $lieu_naissance.'</br>';
        // echo $profession.'</br>';
        // echo $situation_matrimoniale.'</br>';
        // echo $nombre_enfants.'</br>';
        // echo $genre.'</br>';

       // if($date_naissance=="" and $id_card_validity!=""){
       
           if(empty($email)){
        
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
                        window.location.href='modifier_ingenieur.php?id=<?=$id?>&witness=-3';
            </script>
            <?php
        }

    }
       
       
       

                    $query1 = "UPDATE mytable SET nom_ing=:nom, prenom_ing=:prenom,  tel_ing=:tel, email_ing=:email,  genre=:genre, id_ville=:id_ville, id_pays=:id_pays, annee=:annee, matricule=:matricule where id_ingenieur = '$id' ";
  
        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':nom', $nom);
            $sql1->bindParam(':prenom', $prenom);
            // $sql1->bindParam(':id_card_number', $id_card_number);
            // $sql1->bindParam(':id_card_validity', $id_card_validity);
            $sql1->bindParam(':tel', $tel);
            $sql1->bindParam(':email', $email);
            // $sql1->bindParam(':lieu_naissance', $lieu_naissance);
            // $sql1->bindParam(':profession', $profession);
            // $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
            // $sql1->bindParam(':nombre_enfants', $nombre_enfants);
            $sql1->bindParam(':genre', $genre);
            // $sql1->bindParam(':id_quartier', $id_quartier);
            $sql1->bindParam(':id_ville', $id_ville);
            $sql1->bindParam(':id_pays', $id_pays);
            $sql1->bindParam(':annee', $annee);
            $sql1->bindParam(':matricule', $matricule);
            $sql1->execute();


      //  }

//         if($date_naissance!="" and $id_card_validity==""){

//                     $query1 = "UPDATE mytable SET nom_ing=:nom, prenom_ing=:prenom, id_card_number=:id_card_number,  tel_ing=:tel, email_ing=:email, date_naissance=:date_naissance, lieu_naissance=:lieu_naissance, profession=:profession, situation_matrimoniale=:situation_matrimoniale, nombre_enfants=:nombre_enfants, genre=:genre, id_quartier=:id_quartier, id_ville=:id_ville, id_pays=:id_pays, annee=:annee, matricule=:matricule where id_ingenieur = '$id' ";
  
//         $sql1 = $db->prepare($query1);

//              // Bind parameters to statement
//             $sql1->bindParam(':nom', $nom);
//             $sql1->bindParam(':prenom', $prenom);
//             $sql1->bindParam(':id_card_number', $id_card_number);
//             $sql1->bindParam(':tel', $tel);
//             $sql1->bindParam(':email', $email);
//             $sql1->bindParam(':date_naissance', $date_naissance);
//             $sql1->bindParam(':lieu_naissance', $lieu_naissance);
//             $sql1->bindParam(':profession', $profession);
//             $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
//             $sql1->bindParam(':nombre_enfants', $nombre_enfants);
//             $sql1->bindParam(':genre', $genre);
//             $sql1->bindParam(':id_quartier', $id_quartier);
//             $sql1->bindParam(':id_ville', $id_ville);
//             $sql1->bindParam(':id_pays', $id_pays);
//             $sql1->bindParam(':annee', $annee);
//             $sql1->bindParam(':matricule', $matricule);
//             $sql1->execute();

//         }

//         if($date_naissance!="" and $id_card_validity!=""){

//                     $query1 = "UPDATE mytable SET nom_ing=:nom, prenom_ing=:prenom, id_card_number=:id_card_number, id_card_validity=:id_card_validity, tel_ing=:tel, email_ing=:email, date_naissance=:date_naissance, lieu_naissance=:lieu_naissance, profession=:profession, situation_matrimoniale=:situation_matrimoniale, nombre_enfants=:nombre_enfants, genre=:genre, id_quartier=:id_quartier, id_ville=:id_ville, id_pays=:id_pays, annee=:annee, matricule=:matricule where id_ingenieur = '$id' ";
  
//         $sql1 = $db->prepare($query1);

//              // Bind parameters to statement
//             $sql1->bindParam(':nom', $nom);
//             $sql1->bindParam(':prenom', $prenom);
//             $sql1->bindParam(':id_card_number', $id_card_number);
//             $sql1->bindParam(':id_card_validity', $id_card_validity);
//             $sql1->bindParam(':tel', $tel);
//             $sql1->bindParam(':email', $email);
//             $sql1->bindParam(':date_naissance', $date_naissance);
//             $sql1->bindParam(':lieu_naissance', $lieu_naissance);
//             $sql1->bindParam(':profession', $profession);
//             $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
//             $sql1->bindParam(':nombre_enfants', $nombre_enfants);
//             $sql1->bindParam(':genre', $genre);
//             $sql1->bindParam(':id_quartier', $id_quartier);
//             $sql1->bindParam(':id_ville', $id_ville);
//             $sql1->bindParam(':id_pays', $id_pays);
//             $sql1->bindParam(':annee', $annee);
//             $sql1->bindParam(':matricule', $matricule);
//             $sql1->execute();
//         }

// if($date_naissance=="" and $id_card_validity==""){

//                     $query1 = "UPDATE mytable SET nom_ing=:nom, prenom_ing=:prenom, id_card_number=:id_card_number,  tel_ing=:tel, email_ing=:email, lieu_naissance=:lieu_naissance, profession=:profession, situation_matrimoniale=:situation_matrimoniale, nombre_enfants=:nombre_enfants, genre=:genre, id_quartier=:id_quartier, id_ville=:id_ville, id_pays=:id_pays, annee=:annee, matricule=:matricule where id_ingenieur = '$id' ";
  
//         $sql1 = $db->prepare($query1);

//              // Bind parameters to statement
//             $sql1->bindParam(':nom', $nom);
//             $sql1->bindParam(':prenom', $prenom);
//             $sql1->bindParam(':id_card_number', $id_card_number);
//             $sql1->bindParam(':tel', $tel);
//             $sql1->bindParam(':email', $email);
//             $sql1->bindParam(':lieu_naissance', $lieu_naissance);
//             $sql1->bindParam(':profession', $profession);
//             $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
//             $sql1->bindParam(':nombre_enfants', $nombre_enfants);
//             $sql1->bindParam(':genre', $genre);
//             $sql1->bindParam(':id_quartier', $id_quartier);
//             $sql1->bindParam(':id_ville', $id_ville);
//             $sql1->bindParam(':id_pays', $id_pays);
//             $sql1->bindParam(':annee', $annee);
//             $sql1->bindParam(':matricule', $matricule);
//             $sql1->execute();
//         }

        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/





                                    if($sql1)
                                    {
                                          //-------------------Mis à jour de l'email du personnel dans la table users ----------------------//
                                            $sql = $conn->query("UPDATE users_members SET email = '$email' WHERE id_ingenieur='$id' and statut='A'");
                                        
                                        //------------------------------------------------------------------------------------------------//
                                        ?>
                                        <script>
                                            alert('Membre a été bien modifié.');
                                                    window.location.href='modifier_ingenieur.php?id=<?=$id?>';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Membre n\'a pas été modifié.');
                                            window.location.href='modifier_ingenieur.php?id=<?=$id?>';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
