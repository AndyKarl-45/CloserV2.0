<?php
include ("php/dbconnect.php");



if (isset($_REQUEST['id'])) {
    $id_ent = $_REQUEST['id'];
    

    // $query = "DELETE FROM mytable WHERE id_ingenieur='$id_ingenieur'";
    // $sql = $conn->query($query);

    $open_close=1;


    $sql = $conn->query("UPDATE entreprise SET open_close = '$open_close' WHERE id_entreprise=$id_ent");


    if ($sql)
    {
       ?>
        <script>
            // alert('fournisseur a été bien enregistrée.');
                window.location.href='liste_entreprise.php?witness=1';
        </script>
        <?php
}
    else
    {

        ?>
        <script>
            // alert('fournisseur a été bien enregistrée.');
                window.location.href='liste_entreprise.php?witness=-1';
        </script>
        <?php
    }
}
