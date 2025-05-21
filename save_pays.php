 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php");
?>

<?php

if($_POST)
{               


        
        $nom = $_POST['nom'];
        
                                    $sql = "INSERT INTO pays (nom)
                                  VALUES (?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($nom));

                                    if($req)
                                    {
                                        ?>
                                        <script>
                                            alert('Pays a été bien enregistrée.');
                                             window.location.href='liste_pays.php';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Pays existe déjà.');
                                            window.location.href='liste_pays.php';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
