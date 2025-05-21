 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               


        
        $nom_en = $_POST['nom_en'];
        $type_en = $_POST['type_en'];
        $pays_en = 'N/A';
        $ville_en = 'N/A';
        $tel_en = $_POST['tel_en'];
        $email_en = $_POST['email_en'];
        $pers_en = $_POST['pers_en'];
        $contact_en = $_POST['contact_en'];
        $localisation = $_POST['localisation'];
        $nui = $_POST['nui'];
        
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
        
        $cnt=0;
        $sql="SELECT count(nui) as total from entreprise where nui='$nui'  ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($tables as $table)
                {
                    $cnt=$table['total'];
                    }
                
                if($cnt!=0){
                      ?>
                    <script>
                        // alert('fournisseur a été bien enregistrée.');
                            window.location.href='<?=$entreprise['option2_link']?>?witness=-2';
                    </script>
                    <?php
                }else{
//--------------------------------- insertion un fournisseur -----------------------------------------//
                   

         $query = " INSERT INTO entreprise (nom_en,type_en,pays_en,ville_en,tel_en,email_en,pers_en,contact_en,localisation,nui,id_auteur,auteur) 
                     VALUES (:nom_en,:type_en,:pays_en,:ville_en,:tel_en,:email_en,:pers_en,:contact_en,:localisation,:nui,:id_auteur,:auteur)";

                 $sql = $db->prepare($query);

     // Bind parameters to statement
            $sql->bindParam(':nom_en', $nom_en);
            $sql->bindParam(':type_en', $type_en);
            $sql->bindParam(':pays_en', $pays_en);
            $sql->bindParam(':ville_en', $ville_en);
            $sql->bindParam(':tel_en', $tel_en);
            $sql->bindParam(':email_en', $email_en);
            $sql->bindParam(':pers_en', $pers_en);
            $sql->bindParam(':contact_en', $contact_en);
            $sql->bindParam(':localisation', $localisation);
            $sql->bindParam(':nui', $nui);
            $sql->bindParam(':id_auteur', $id_user_perso);
            $sql->bindParam(':auteur', $nom_us);
            $sql->execute();



                                    if($sql)
                                    {
                                        ?>
                                        <script>
                                            // alert('fournisseur a été bien enregistrée.');
                                                window.location.href='<?=$entreprise['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                            window.location.href='<?=$entreprise['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }

}
       

                          

}
?>
