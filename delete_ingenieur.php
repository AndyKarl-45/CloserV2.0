<?php
include ("php/dbconnect.php");



if (isset($_REQUEST['id'])) {
    $id_ingenieur = $_REQUEST['id'];
    

    $query = "DELETE FROM mytable WHERE id_ingenieur='$id_ingenieur'";
    $sql = $conn->query($query);

    $id_ing=0;


    $sql = $conn->query("UPDATE cotisation SET id_ing = '$id_ing' WHERE id_ing=$id_ingenieur");


    if ($sql)
    {
        echo "<script>
                window.location.href='liste_ingenieur.php?witness=1';
            </script>";
    }
    else
    {

        echo "<script>
                window.location.href='liste_ingenieur.php?witness=-1';
            </script>";
    }
}
