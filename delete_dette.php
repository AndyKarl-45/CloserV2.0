<?php
include ("php/dbconnect.php");


if (isset($_REQUEST['id'])) {
    $id_dette = $_REQUEST['id'];


    $query = "DELETE FROM dette WHERE id_dette='$id_dette'";
    $sql = $conn->query($query);


    if ($sql)
    {
        echo "<script>
                window.location.href='liste_dette.php?witness=1';
            </script>";
    }
    else
    {

        echo "<script>
                window.location.href='liste_dette.php?witness=-1';
            </script>";
    }
}
