 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               
 

        /*--------------------------------- ETAT CIVILE -------------------------------------*/
        $id = $_POST['id_ingenieur'];
        $nom_ing = $_POST['nom_ing'];
        $prenom_ing = $_POST['prenom_ing'];
        $num_ordre = $_POST['num_ordre'];
        $matricule =  $_POST['matricule'];
         $tel_ing = $_POST['tel_ing'];
         $email_ing = $_POST['email_ing'];
         
            

        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

        $query1 = "UPDATE mytable SET nom_ing=:nom_ing, prenom_ing=:prenom_ing, num_ordre=:num_ordre, matricule=:matricule, tel_ing=:tel_ing, email_ing=:email_ing where id_ingenieur = '$id' ";
  
        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':nom_ing', $nom_ing);
            $sql1->bindParam(':prenom_ing', $prenom_ing);
            $sql1->bindParam(':num_ordre', $num_ordre);
            $sql1->bindParam(':matricule', $matricule);
            $sql1->bindParam(':tel_ing', $tel_ing);
            $sql1->bindParam(':email_ing', $email_ing);
            $sql1->execute();



                                    if($sql1)
                                    {
                                        ?>
                                        <script>
                                           // alert('Personnel a été bien modifié.');
                                                    window.location.href='modifier_ingenieur.php?id=<?=$id?>&witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            //alert('Personnel n\'a pas été modifié.');
                                            window.location.href='modifier_ingenieur.php?id=<?=$id?>&witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
