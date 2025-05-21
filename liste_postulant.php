 <?php

include('first.php');
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class=" fas fa-id-card-alt" style="color: silver"></i> Liste des Postulants</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    Hello M/Mme, il est <?=date("G:i");?> en ce jour du <?=dateToFrench("now","l j F Y");?>.
                </li>
            </ol>
            <!--                Main Body-->
                            <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-scroll"></i>
                                <b>L'ensemble des postulants.</b>
                                 <b> 
                                
                                <!-- Nav pills -->
                                <ul class="nav nav-pills"   style="float: right;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="<?=$postulant['option1_link']?>">
                                            <i class="fas fa-plus-circle"></i>
                                            Nouveau postulant
                                        </a>
                                    </li>                                    
                                </ul>
                            </b>
                            </div>
                            <div class="card-body">
                                <div class="well bs-component">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="table-responsive">
                                                <form method="post" action="" >
                                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" >
                                                        <thead>
                                                        <tr align="center" style="background-color: #dde9dd">
                                                            <!-- <th><p align="center">Matricule </p></th> -->
                                                            <th>Nom</th>
                                                            <th>Profession </th>
                                                            <th>Quartier </th> 
                                                            <th>ville</th>
                                                            <th>Statut</th>
                                                            <th>Transfert</th> 
                                                            <th>Options</th> 
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php

                                                    $query = 'SELECT * from mytable where statut="POSTULANT" order by nom_ing, prenom_ing asc';
                                                        $q = $db->query($query);
                                                        while($row = $q->fetch())
                                                        {
                                                            $id_ingenieur = $row['id_ingenieur'];
                                                            $nom_ing = $row['nom_ing'];
                                                            $prenom_ing = $row['prenom_ing'];
                                                            $statut = $row['statut'];
                                                            $id_quartier = $row['id_quartier'];
                                                            $profession = $row['profession'];
                                                            $id_ville = $row['id_ville'];
                                                            $etat = $row['etat'];

                                                     ?>

            <tr>
                <input name="id" type="hidden" value="<?php echo $id_ingenieur?>" />
                <td align="center"><img width="28" height="28" src="assetss/img/user.jpg"
                                                 class="rounded-circle m-r-5" alt=""><a href="details_postulant.php?id=<?php echo $id_ingenieur; ?>" title="<?=$nom_ing; ?>" style="color: black"><?=$nom_ing.' '.$prenom_ing; ?></a>  </td>
                <td align="center"><a href="details_postulant.php?id=<?php echo $id_ingenieur; ?>" title="<?= $profession; ?>" style="color: black"><?=$profession; ?></a>   </td>
                 <input type="hidden" name="" value="<?=$profession; ?>">
                  <td align="center"><a href="details_postulant.php?id=<?php echo $id_ingenieur; ?>" title="<?=$id_quartier; ?>" style="color: black">
                     <?php

                                                                $sql = "SELECT DISTINCT * from quartier where id_quat = '$id_quartier'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                   echo $table['nom'];
                                                                }

                                                                ?>



                </a>   </td>
				    
                <td align="center"><a href="details_postulant.php?id=<?php echo $id_ingenieur; ?>" title="<?=$id_ville; ?>" style="color: black"><?php 
                $sql = "SELECT DISTINCT * from ville where id_ville = '$id_ville'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                   echo $table['nom'];
                                                                }


                 ?></a>   </td>
                 <td align="center">  <?php  
                                                     if($etat=='N'){
                                                         echo'
        <a href="#" style=" width:100px;" class="btn btn-warning" >En cours </a>
                                                        ';
                                                     }elseif($etat=='F'){

                                                        echo'
        <a href="modifier_post.php?id='.$id_ingenieur.'" style=" width:100px;" class="btn btn-danger" >Réjeté</a>
                                                        ';

                                                     }elseif($etat=='V'){

                                                        echo'
        <a href="modifier_post.php?id='.$id_ingenieur.'" style=" width:100px;" class="btn btn-success" >Reçue</a>
                                                        ';
                                                     }?>  </td>
                                                     
                 <td align="center">
                     <?php if($lvl > 14 || $lvl == 11){ ?>
                     <div class="btn-group mr-2" role="group" aria-label="First group">
                         <a class="btn btn-primary" href="modifier_statut_postulant.php?id=<?=$id_ingenieur;?>" title="Modifier"
                            style="background-color: transparent">
                            <i style="color: green" class="fas fa-random"></i>
                            </a>
                       </div>
                       <?php } ?>
                       </td>

                <td align="center" style="width: 18%">
                   
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                         <a class="btn btn-primary"  href="details_postulant.php?id=<?= $id_ingenieur; ?>" title="view"
                            style="background-color: transparent">
                                <i  style="color: green" class="fas fa-eye"></i> 
                            </a>
                        </div>
                        <?php if($lvl > 14 || $lvl == 11){ ?>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                         <a class="btn btn-warning" href="modifier_post.php?id=<?=$id_ingenieur;?>" title="Modifier"
                            style="background-color: transparent">
                                <i style="color: orange" class="fas fa-pen"></i> 
                            </a>
                       </div>
                       <?php } ?>
                       
                     <div class="btn-group mr-2" role="group" aria-label="First group">
                         <?php if($lvl > 14){ ?>
                             <a class="btn btn-danger"  href="delete_postulant.php?id=<?=$id_ingenieur?>"  onclick="Supp(this.href); return(false);" style="background-color: transparent">
                                  <i style="color: red" class="fas fa-trash"></i>
                            </a>
                            <?php } ?>
                        </div> 
                       
                    <!-- <?php 
                        // include("verifier_delete_post.php");
                            ?> -->
                                    
                            
                        
                 </td>          
              </tr>

<?php } ?>
            
                                                    </tbody>




                                                        <!-- <tfoot>
                                                            <tr class="bg-primary">
                                                            <th><p align="center">Nom</p></th>
                                                            <th><p align="center">Profession </p></th>
                                                            <th><p align="center">Quartier </p></th> 
                                                            <th><p align="center">ville</p></th>
                                                            <th><p align="center">Transfert</p></th> 
                                                            <th><p align="center">Options</p></th> 
                                                            </tr>
                                                        </tfoot> -->
                                                        <tbody></tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </fieldset>
                                    </form>
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

        </div>
    </main>
</div> 
<?php
if (isset($_GET['witness'])){
    $witness = $_GET['witness'];

    switch ($witness){
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

<script type="text/javascript">
   function Supp(link){
    if(confirm('Confirmer  la suppression du Postulant ?')){
     document.location.href = link;
    }
   }
  </script>




    <!--//Footer-->
<?php
include('foot.php');
?>