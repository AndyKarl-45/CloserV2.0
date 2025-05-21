<?php
include ("php/dbconnect.php");
include("php/db.php");


if (isset($_REQUEST['id'])) {
    $id_ingenieur = $_REQUEST['id'];
    $nom = $_REQUEST['pj'];
    
    $query = "SELECT * from mytable where id_ingenieur='$id_ingenieur'";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $statut = $row['statut'];
}

    $query = "DELETE FROM $nom WHERE id_entite='$id_ingenieur'";
    $sql = $conn->query($query);


    if ($sql)
    {
        if($statut=='POSTULANT'){
            echo "<script>
                 window.location.href='details_postulant.php?id=$id_ingenieur&witness=1';
            </script>";
        }else{
        echo "<script>
                 window.location.href='details_ingenieur.php?id=$id_ingenieur&witness=1';
            </script>";
        }
    }
    else
    {

        if($statut=='POSTULANT'){
            echo "<script>
                 window.location.href='details_postulant.php?id=$id_ingenieur&witness=1';
            </script>";
        }else{
        echo "<script>
                 window.location.href='details_ingenieur.php?id=$id_ingenieur&witness=1';
            </script>";
        }
    }
}
