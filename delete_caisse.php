<?php
include ("php/dbconnect.php");


if (isset($_REQUEST['id'])) {
    $id_caisse = $_REQUEST['id'];
    

    $query = "DELETE FROM caisse WHERE id_caisse='$id_caisse'";
    $sql = $conn->query($query);

    $query = "DELETE FROM cotisation WHERE id_caisse='$id_caisse'";
    $sql = $conn->query($query);





    if ($sql)
    {
        echo "<script>
                window.location.href='liste_add_caisse.php?witness=1';
            </script>";
    }
    else
    {

        echo "<script>
                window.location.href='liste_add_caisse.php?witness=-1';
            </script>";
    }
}
