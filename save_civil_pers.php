<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {

     $nom_pere = "N/A";
    $nom_mere = "N/A";
    $date_naissance="N/A";
    $lieu_naissance="N/A";

    /*--------------------------------- ETAT CIVILE -------------------------------------*/
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id_card_number = $_POST['id_card_number'];
    $id_card_validity = $_POST['id_card_validity'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $nom_pere = $_POST['nom_pere'];
    $nom_mere = $_POST['nom_mere'];
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $profession = $_POST['profession'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $nombre_enfants = $_POST['nombre_enfants'];
    $genre = $_POST['genre'];
    $id_quartier = $_POST['id_quartier'];
    $id_ville = $_POST['id_ville'];
    $statut="EMPLOYE";
    $open_close = 0;
    
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


    $sql = "SELECT * FROM ville where id_ville='$id_ville' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $id_pays = $table['id_pays'];
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
    
    if(empty($email)){
        
        $query = "SELECT count(email) as total  from personnel WHERE email='$email' and open_close!=1";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
          echo  $total = $row["total"];
        }
        if($total==0){
            //-------------------Mis à jour de l'email du personnel dans la table users ----------------------//
                    $sql = $conn->query("UPDATE users SET email = '$email' WHERE id_perso='$id' and statut='A'");
              //------------------------------------------------------------------------------------------------//
        }else{
            ?>
            <script>
                //alert('Personnel a été bien modifié.');
                        window.location.href='modifier_personnel.php?witness=-3';
            </script>
            <?php
        }

    }
    


    /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

    $query1 = " INSERT INTO personnel (nom,prenom,id_card_number,id_card_validity,tel,email,nom_pere,nom_mere,date_naissance,lieu_naissance,profession,situation_matrimoniale,nombre_enfants,genre,id_quartier,id_ville,id_pays,open_close,statut,id_auteur,auteur) 
        VALUES 
        (:nom,:prenom,:id_card_number,:id_card_validity,:tel,:email,:nom_pere,:nom_mere,:date_naissance,:lieu_naissance,:profession,:situation_matrimoniale,:nombre_enfants,:genre,:id_quartier,:id_ville,:id_pays,:open_close,:statut,:id_auteur,:auteur)";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':nom', $nom);
    $sql1->bindParam(':prenom', $prenom);
    $sql1->bindParam(':id_card_number', $id_card_number);
    $sql1->bindParam(':id_card_validity', $id_card_validity);
    $sql1->bindParam(':tel', $tel);
    $sql1->bindParam(':email', $email);
    $sql1->bindParam(':nom_pere', $nom_pere);
    $sql1->bindParam(':nom_mere', $nom_mere);
    $sql1->bindParam(':date_naissance', $date_naissance);
    $sql1->bindParam(':lieu_naissance', $lieu_naissance);
    $sql1->bindParam(':profession', $profession);
    $sql1->bindParam(':situation_matrimoniale', $situation_matrimoniale);
    $sql1->bindParam(':nombre_enfants', $nombre_enfants);
    $sql1->bindParam(':genre', $genre);
    $sql1->bindParam(':id_quartier', $id_quartier);
    $sql1->bindParam(':id_ville', $id_ville);
    $sql1->bindParam(':id_pays', $id_pays);
    $sql1->bindParam(':open_close', $open_close);
    $sql1->bindParam(':statut', $statut);
    $sql1->bindParam(':id_auteur', $id_user_perso);
    $sql1->bindParam(':auteur', $nom_us);
    $sql1->execute();


    if ($sql1) {
        ?>
        <script>
           // alert('Personnel a été bien enregistrée.');
            window.location.href = '<?=$personnel['option2_link']?>?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Personnel existe déjà.');
            window.location.href = '<?=$personnel['option2_link']?>?witness=-1';
        </script>
        <?php

    }


}
?>
