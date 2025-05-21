<?php
include ("php/dbconnect.php");


if (isset($_REQUEST['id'])) {
    $id_ingenieur = $_REQUEST['id'];
    

    $query = "DELETE FROM mytable WHERE id_ingenieur='$id_ingenieur'";
    $sql = $conn->query($query);


    if ($sql)
    {
        echo "<script>
                window.location.href='liste_postulant.php?witness=1';
            </script>";
    }
    else
    {

        echo "<script>
                window.location.href='liste_postulant.php?witness=-1';
            </script>";
    }
}
