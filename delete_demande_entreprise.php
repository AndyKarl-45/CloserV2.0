<?php
    include ("php/dbconnect.php");


if (isset($_REQUEST['id'])) {
    $id_dem_ent = $_REQUEST['id'];
    

    $open_close=1;


    $sql = $conn->query("UPDATE demande_entreprise SET open_close = '$open_close' WHERE id_dem_ent=$id_dem_ent");


    if ($sql)
    {
        echo "<script>
                window.location.href='liste_demande_entreprise_nonpayer.php?witness=1';
            </script>";
    }
    else
    {

        echo "<script>
                window.location.href='liste_demande_entreprise_nonpayer.php?witness=-1';
            </script>";
    }
}
?>