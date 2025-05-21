 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               
 

        /*--------------------------------- ETAT CIVILE -------------------------------------*/
        $user =$_SESSION['rainbo_name'];
     $lvl =$_SESSION['rainbo_lvl'] ;
     $email_user =$_SESSION['rainbo_email'] ;
     $id_session =$_SESSION['rainbo_id_perso'] ;
                 
     $id_ing = $_POST['id_ing'];
     $id_rem = $_POST['id_rem'];
     $montant = $_POST['montant'];
     $ref_dem_rem = $_POST['ref_dem_rem'];
     $ope = $_POST['ope'];
     $ref_paie = $_POST['ref_paie'];
     $date_dem_rem = date('Y-m-d');
    
         
        // $id_ing=$_POST['id_ing'];
        // $id_entreprise=$_POST['id_entreprise'];
        // $nom1 = strtolower($_POST['objet']);
        // $objet = ucwords($nom1);
        
                $cnts=0;
        $sql="SELECT count(id_rem) as total FROM  remboursement where ref_dem_rem='$ref_dem_rem'";
        $stmt = $db->prepare($sql);
        $stmt->execute();

         $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($tables as $table)
                    {
                      $cntse=$table['total'];
                    }
                    
        if($cnts==1){
            ?>
            <script>
                //alert('Personnel a été bien enregistrée.');
                      window.location.href='<?=$remboursement['option2_link']?>?witness=-2';
            </script>
            <?php
        }
        

        
                            

        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

        $query1 = "UPDATE remboursement SET montant=:montant, ope=:ope, ref_dem_rem=:ref_dem_rem, date_dem_rem=:date_dem_rem, ref_paie=:ref_paie  where id_rem = '$id_rem' ";
  
        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':montant', $montant);
            $sql1->bindParam(':ope', $ope);
            $sql1->bindParam(':ref_dem_rem', $ref_dem_rem);
            $sql1->bindParam(':date_dem_rem', $date_dem_rem);
            $sql1->bindParam(':ref_paie', $ref_paie);
            $sql1->execute();
            
        
                    //--------------------- SAVE FILE -----------------------//
                  
    
        if (!empty(($_FILES))) {

            $file_count = count($_FILES['fichier']);
            $autorized_extensions = array('.DOCX', '.docx', '.DOC', '.doc', '.PPTX', '.pptx', '.XLSX', '.xlsx', '.CSV', '.csv', '.pdf', '.PDF', '.jpeg', '.JPEG', '.jpg', '.JPG');

             // echo 'counter : ' . $file_count . '<br/>';

                $file_name = $_FILES['fichier']['name'];
                // echo $file_name;
                $file_extension = strrchr($file_name, ".");
                $file_content = $_FILES['fichier']['tmp_name'];
                $file_size = $_FILES['fichier']['size'];
                $file_dest = 'files/' . $file_name;


                if (in_array($file_extension, $autorized_extensions)) {
                    if ((move_uploaded_file($file_content, $file_dest) && ($_FILES['fichier']['error'] == 0))) {

                        $etat = "UPDATE pj_rem SET  nom_pj=:file_name, lien=:file_dest 
                        where id_rem ='$id_rem'  ";
                        $req = $db->prepare($etat);
                                $req->bindParam(':file_name', $file_name);
                                $req->bindParam(':file_dest', $file_dest);
                                 $req->execute();

                    } else { 
                    }



                } else {
                    // echo "<div class='alert alert-danger'>Type de document N°" . $i . " pas autorisé ! (docx, xlsx, pptx, csv,jpeg, jpg et pdf). Vous devez choisir au moins un document autorisé sinon l'enregistrement ne se fera pas.</div>";
                }
            
         }



                                    if($sql1)
                                    {
                                        ?>
                                        <script>
                                            //alert('Personnel a été bien enregistrée.');
                                                  window.location.href='<?=$remboursement['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                           // alert('Personnel existe déjà.');
                                             window.location.href='<?=$remboursement['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
