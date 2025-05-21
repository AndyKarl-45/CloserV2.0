 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php");

//strtolower(); ecrire en miniscule
//strtouppor(); ecrire en majiscule
?>

<?php

if($_POST)
{               


        
        $nom = strtoupper($_POST['nom_quat']);
        $id_ville = $_POST['id_ville'];
        $open_close=0;

        // echo $nom;
        // echo $id_ville;
        $query = "INSERT INTO quartier (nom,id_ville,open_close) VALUES (:nom,:id_ville,:open_close)";

                 $sql = $db->prepare($query);

     // Bind parameters to statement
            $sql->bindParam(':nom', $nom);
            $sql->bindParam(':id_ville', $id_ville);
            $sql->bindParam(':open_close', $open_close);
            $sql->execute();

                                    if($sql)
                                    {
                                        ?>
                                        <script>
                                            alert('Quartier a été bien enregistrée.');
                                           window.location.href='liste_quartier.php';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                            window.location.href='liste_quartier.php';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
