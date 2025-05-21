<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_REQUEST) {


    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $ref_dem_ent_cp = $_REQUEST['id'];
    $statut='SUCCESS';
    
    if(!empty($ref_dem_ent_cp)){
            $sql = "SELECT transaction_id FROM payement_init WHERE 	ref_ing_cost like '$ref_dem_ent_cp'";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();

                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($tables as $table)
                                        {
                                         $transaction_id=$table['transaction_id'];
                                        }
                                        
             $query1 = " UPDATE payement_statut SET status=:statut   WHERE transaction_id = '$transaction_id'";

                $sql1 = $db->prepare($query1);
    
                // Bind parameters to statement
                $sql1->bindParam(':statut', $statut);
                $sql1->execute();                            
            
            }



            if ($sql1) {
                ?>
                <script>
                   // alert('Postulant a été bien mis à jour.');
                    window.location.href = '<?=$demande_entreprise_statut_initied['option2_link']?>?witness=1';
                </script>
                <?php
            } else {
                ?>
                <script>
                    //alert('Postulant n\'a pas été mis à jour.');
                    window.location.href = '<?=$demande_entreprise_statut_initied['option2_link']?>?witness=-1';
                </script>
                <?php

            }

}
?>
