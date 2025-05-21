 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               
 

        /*--------------------------------- ETAT CIVILE -------------------------------------*/
        $id_perso = $_POST['id_personnel'];
        $id_dem_ent = $_POST['id_dem_ent'];
        $id_caisse= $_POST['id_caisse'];
        $date_dem_ent=$_POST['date_dem_ent'];
        $payer=$_POST['payer'];
        
        $sql="SELECT YEAR('$date_dem_ent') as total  ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($tables as $table)
                {
                    $annee=$table['total'];
                }
         
        $id_ing=$_POST['id_ing'];
        $id_entreprise=$_POST['id_entreprise'];
        $nom1 = strtolower($_POST['objet']);
        $objet = ucwords($nom1);
        
        
        
                            

        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

        $query1 = "UPDATE demande_entreprise SET id_caisse=:id_caisse, id_ing=:id_ing, id_entreprise=:id_entreprise, objet=:objet, date_dem_ent=:date_dem_ent, id_perso=:id_perso, annee=:annee where id_dem_ent = '$id_dem_ent' ";
  
        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':id_caisse', $id_caisse);
            $sql1->bindParam(':id_ing', $id_ing);
            $sql1->bindParam(':id_entreprise', $id_entreprise);
            $sql1->bindParam(':objet', $objet);
            $sql1->bindParam(':date_dem_ent', $date_dem_ent);
            $sql1->bindParam(':id_perso', $id_perso);
            $sql1->bindParam(':annee', $annee);
            $sql1->execute();



                                    if($sql1)
                                    {
                                        ?>
                                        <script>
                                           // alert('Personnel a été bien modifié.');
                                                    window.location.href='liste_demande_entreprise_nonpayer.php?&witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            //alert('Personnel n\'a pas été modifié.');
                                            window.location.href='modifier_demande_entreprise.php?id=<?=$id?>?&witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
