<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

// $total_apt = 0;
// $today = date("Y-m-d");
// $today = date("t", strtotime($today));

$year = (new DateTime())->format("Y");
$month = (new DateTime())->format("m");
$day = (new DateTime())->format("d");
$query  = "SELECT count(id_transfert) as total from transfert_caisse";
$q = $conn->query($query);
while($row = $q->fetch_assoc())
{
    $total_apt = $row["total"];
}
$id_app = $total_apt + 1;
$ref_app = 'TRC_'.$year.'_'.$month.'_'.$day.'_'.$id_app;

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"> <i class="fas fa-random" style="color: silver"></i> Nouveau Transfert</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">

                                    </ul>
                                </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->


                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <form action="save_transfert_caisse.php" method="POST">
                                                <div class="row">
                                                       <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> Code Transfert</label>
                                                             <input type="hidden" name="code" value="<?=$ref_app?>">
                                                            <input class="form-control" type="text" value="<?=$ref_app?>" disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Caisse Source</label>
                                                            <select class="form-control" name="id_caisse_src" required="">
                                                                <option value="0" selected="">...</option>
                                                               <?php

                                                                 $iResult = $db->query("SELECT * FROM caisse");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_caisse'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['caisse'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Caisse Destination</label>
                                                            <select class="form-control" name="id_caisse_dest" required="">
                                                                <option value="0" selected="">...</option>
                                                               <?php

                                                                 $iResult = $db->query("SELECT * FROM caisse");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_caisse'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['caisse'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Somme:</label>
                                                            <input class="form-control" type="number" name="solde_total"  required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> Date:</label>
                                                            <input class="form-control" type="date" name="date_transfert" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="<?=$tresorerie['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">

                                    </ul>
                                </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->


<div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr align="center" style="background-color: #dde9dd">

                                    <th>Code</th>
                                     <th>Caisse Source</th>
                                     <th>Responsable</th>
                                    <th>Caisse Destination </th>
                                    <th>Somme </th>
                                    <th>Date</th>
                                    <th>Etat</th>
                                    <th ><i class="fas fa-bars"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $query = "SELECT * from transfert_caisse order by date_transfert asc";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_transfert = $row['id_transfert'];
                                        $id_caisse_src = $row['id_caisse_src'];
                                        $id_caisse_dest = $row['id_caisse_dest'];
                                        $solde_total = $row['solde_total'];;
                                        $etat = $row['etat'];;
                                        $code = $row['code'];
                                        $date_transfert = $row['date_transfert'];

                                        $sql = "SELECT * from caisse where id_caisse = '$id_caisse_src'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $caisse_src=$table['caisse'];
                                                                    $id_perso=$table['id_perso'];
                                                                }

                                        $sql = "SELECT * from caisse where id_caisse = '$id_caisse_dest'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $caisse_dest=$table['caisse'];
                                                                }

                                        $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $nom=$table['nom'].' '.$table['prenom'];
                                                                }


                                    ?>
                                    <tr align="center">
                                      <td><a href="#"><?= $code ?></a></td>
                                    <td><a href="#"><?= $caisse_src ?></a></td>
                                    <td><a href="#"><?= $nom ?></a></td>
                                    <td><a href="#"><?= $caisse_dest ?></a></td>
                                    <td><a href="#"><?= $solde_total ?></a></td>
                                    <td><a href="#"><?= $date_transfert ?></a></td>
                                    <td><a href="#"><?= $etat ?></a></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_patient"><i class="fas fa-trash"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        
                                    </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

<?php
if (isset($_GET['witness'])) {
    $witness = $_GET['witness'];

    switch ($witness) {
        case '1';
            ?>
            <script>
                Swal.fire(
                    'Succès',
                    'Opération effectuée avec succès !',
                    'success'
                )
            </script>
            <?php
            break;
        case '-1';
            ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Oops...',
                    text: 'Une erreur s\'est produite !',
                    footer: 'Reéssayez encore'
                })
            </script>
            <?php
            break;

    }
}
?>
    <!--    Modal pour ajouter Categorie Contrat-->


    <!--//Footer-->
<?php
include('foot.php');
?>