<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $id = $_POST['id_dem_part'];
    $statut = $_POST['statut'];



 $query1 = " UPDATE demande_particulier SET statut=:statut   WHERE id_dem_part = '$id' ";


            $sql1 = $db->prepare($query1);

            // Bind parameters to statement
            $sql1->bindParam(':statut', $statut);
            $sql1->execute();





            if ($sql1) {
                ?>
                <script>
                   // alert('Postulant a été bien mis à jour.');
                    window.location.href = '<?=$demande_particulier['option2_link']?>?witness=1';
                </script>
                <?php
            } else {
                ?>
                <script>
                    //alert('Postulant n\'a pas été mis à jour.');
                    window.location.href = '<?=$demande_particulier['option2_link']?>?id=<?=$id?>&?witness=-1';
                </script>
                <?php

            }

}
?>
