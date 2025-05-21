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

             
         $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
         $id_card_number = $_POST['id_card_number'];
        $id_card_validity =  $_POST['id_card_validity'];
         $tel = $_POST['tel'];
         $email = $_POST['email'];
         $date_naissance = $_POST['date_naissance'];
         $lieu_naissance = $_POST['lieu_naissance'];
         $profession = $_POST['profession'];
         $situation_matrimoniale = $_POST['situation_matrimoniale'];
         $nombre_enfants = $_POST['nombre_enfants'];
         $genre = $_POST['genre'];
         $id_quartier = $_POST['id_quartier'];
         $id_ville = $_POST['id_ville'];
         $statut="POSTULANT";
         $open_close=0;
         $year=date("Y-m-d");

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
                 window.location.href='<?=$dette['option2_link']?>?witness=-1';
            </script>
            <?php
        }
        
          $sql="SELECT * FROM ville where id_ville='$id_ville' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $id_pays=$table['id_pays'];
                                        }
            $sql="SELECT YEAR('$year') as total  ";
                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                    {
                                                                       echo $annee=$table['total'];
                                                                    }
        echo $annee;
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

/*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

        //     $query1 = " INSERT INTO mytable (matricule,nom
        // _ing,prenom_ing,tel_ing,email_ing,id_card_number,id_card_validity,date_naissance) 
        // VALUES 
        // (:matricule,:nom,:prenom,:tel,:email,:id_card_number,:id_card_validity,:date_naissance)";

$query1 = " INSERT INTO mytable (matricule,nom_ing,prenom_ing,tel_ing,email_ing,id_card_number,id_card_validity,date_naissance,lieu_naissance,profession,situation_matrimoniale,nombre_enfants,genre,id_quartier,id_ville,id_pays,statut,date_inscription,annee,id_auteur,auteur) 
        VALUES 
        (:matricule,:nom,:prenom,:tel,:email,:id_card_number,:id_card_validity,:date_naissance,:lieu_naissance,:profession,:situation_matrimoniale,:nombre_enfants,:genre,:id_quartier,:id_ville,:id_pays,:statut,:date_inscription,:annee,:id_auteur,:auteur)";

                

        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':matricule', $matricule);
            $sql1->bindParam(':nom', $nom);
            $sql1->bindParam(':prenom', $prenom);
            $sql1->bindParam(':tel', $tel);
            $sql1->bindParam(':email', $email);
            $sql1->bindParam(':id_card_number', $id_card_number);
            $sql1->bindParam(':id_card_validity', $id_card_validity);
            $sql1->bindParam(':date_naissance', $date_naissance);
            $sql1->bindParam(':lieu_naissance', $lieu_naissance);
            $sql1->bindParam(':profession', $profession);
            $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
            $sql1->bindParam(':nombre_enfants', $nombre_enfants);
            $sql1->bindParam(':genre', $genre);
            $sql1->bindParam(':id_quartier', $id_quartier);
            $sql1->bindParam(':id_ville', $id_ville);
            $sql1->bindParam(':id_pays', $id_pays);
            $sql1->bindParam(':statut', $statut);
            $sql1->bindParam(':date_inscription', $year);
            $sql1->bindParam(':annee', $annee);
            $sql1->bindParam(':id_auteur', $id_user_perso);
            $sql1->bindParam(':auteur', $nom_us);
            $sql1->execute();


                                    if($sql)
                                    {
                                        ?>
                                        <script>
                                             alert('Postulant a été bien enregistrée.');
                                                  window.location.href='liste_postulant.php?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                            window.location.href='liste_postulant.php?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
