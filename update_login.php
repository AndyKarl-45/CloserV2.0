 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               
 

        /*--------------------------------- ETAT CIVILE -------------------------------------*/
        $id = $_POST['id_user'];
        $pseudo = $_POST['pseudo'];
        
        echo $id;
        echo $pseudo;
         
            

        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

        $query1 = "UPDATE users_members SET pseudo=:pseudo where id_users = '$id' ";
  
        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':pseudo', $pseudo);
            $sql1->execute();



                                    if($sql1)
                                    {
                                        ?>
                                        <script>
                                           // alert('Personnel a été bien modifié.');
                                                    window.location.href='liste_utilisateurs_membres.php?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            //alert('Personnel n\'a pas été modifié.');
                                            window.location.href='liste_utilisateurs_membres.php?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
