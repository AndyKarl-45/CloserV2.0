 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               
 

        /*--------------------------------- ETAT CIVILE -------------------------------------*/
        $id = $_POST['id_entreprise'];
        $nom_en = $_POST['nom_en'];
        $type_en = $_POST['type_en'];
        $contact_en = $_POST['contact_en'];
        $pers_en =  $_POST['pers_en'];
         $tel_en = $_POST['tel_en'];
         $email_en = $_POST['email_en'];
          $localisation = $_POST['localisation'];
           $nui = $_POST['nui'];
           
        $cnt=0;
        $sql="SELECT count(nui) as total from entreprise where nui='$nui'  ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($tables as $table)
                {
                    $cnt=$table['total'];
                    }
                
                
         
         if($cnt!=1){
                      ?>
                    <script>
                        // alert('fournisseur a été bien enregistrée.');
                            window.location.href='<?=$entreprise['option2_link']?>?witness=-2';
                    </script>
                    <?php
                }
            

        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

        $query1 = "UPDATE entreprise SET nom_en=:nom_en, type_en=:type_en, contact_en=:contact_en, pers_en=:pers_en, tel_en=:tel_en, email_en=:email_en, localisation=:localisation, nui=:nui where id_entreprise = '$id' ";
  
        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':nom_en', $nom_en);
            $sql1->bindParam(':type_en', $type_en);
            $sql1->bindParam(':contact_en', $contact_en);
            $sql1->bindParam(':pers_en', $pers_en);
            $sql1->bindParam(':tel_en', $tel_en);
            $sql1->bindParam(':email_en', $email_en);
            $sql1->bindParam(':localisation', $localisation);
            $sql1->bindParam(':nui', $nui);
            $sql1->execute();



                                    if($sql1)
                                    {
                                        ?>
                                        <script>
                                           // alert('Personnel a été bien modifié.');
                                                    window.location.href='modifier_entreprise.php?id=<?=$id?>&witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            //alert('Personnel n\'a pas été modifié.');
                                            window.location.href='modifier_entreprise.php?id=<?=$id?>&witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
