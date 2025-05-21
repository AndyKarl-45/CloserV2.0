 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php");
?>

<?php

if($_POST)
{               


        
        $nom = strtoupper($_POST['nom']);
        $id_pays = $_POST['id_pays'];
         $open_close=0;

        // echo $nom;
        // echo $id_pays;
        $query = "INSERT INTO ville (nom,id_pays,open_close) VALUES (:nom,:id_pays,:open_close)";

                 $sql = $db->prepare($query);

     // Bind parameters to statement
            $sql->bindParam(':nom', $nom);
            $sql->bindParam(':id_pays', $id_pays);
             $sql->bindParam(':open_close', $open_close);
            $sql->execute();

                                    if($sql)
                                    {
                                        ?>
                                        <script>
                                            alert('Ville a été bien enregistrée.');
                                          window.location.href='liste_ville.php';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                            window.location.href='liste_ville.php';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
