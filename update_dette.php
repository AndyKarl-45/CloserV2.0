<?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{


        /*--------------------------------- ETAT CIVILE -------------------------------------*/
        $id = $_POST['id_dette'];
       $id_caisse = $_POST['id_caisse'];
        $annee=$_POST['annee'];
        $id_ing = $_POST['id_ing'];
        $somme =  $_POST['somme'];
        $payer = abs($_POST['payer']);
         $open_close = 0;
        // if($n==4){
        //         $annee = $_POST['annee'];
        // }else{
        //      $annee = $_POST['annee'];

        //  $sql="SELECT YEAR('$annee') as total  ";
        //                     $stmt = $db->prepare($sql);
        //                     $stmt->execute();

        //                      $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //                             foreach($tables as $table)
        //                                 {
        //                                    echo $annee=$table['total'];
        //                                 }
        // }

                 $sql="SELECT *  FROM dette where id_dette='$id' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $versement=$table['payer'];
                                            $somme=$table['somme'];
                                            $payer_i=$table['payer'];
                                            $ref_ing_det=$table['$ref_ing_det'];
                                        }

if($payer_i!=$somme){


$ver_payer=$versement+$payer;
        if($ver_payer==$somme){
            $etat = 'OK';
            $payer=$somme;

            $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $solde=$table['total'];

                                        }

            $pay_total=$payer+$solde;

            $query1 = "UPDATE dette SET id_caisse=:id_caisse, annee=:annee, id_ing=:id_ing, etat=:etat, somme=:somme, payer=:payer where id_dette = '$id' and id_caisse='$id_caisse' and id_ing='$id_ing' ";
            $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':id_caisse', $id_caisse);
            $sql1->bindParam(':annee', $annee);
            $sql1->bindParam(':id_ing', $id_ing);
            $sql1->bindParam(':somme', $somme);
            $sql1->bindParam(':payer', $payer);
            $sql1->bindParam(':etat', $etat);
            $sql1->execute();


            $ref_caisse=$ref_ing_det;
            $id_beneficiaire=$id_ing;
            $somme=$payer;
            $date_hist=$annee;


            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist)
                      VALUES (?,?,?,?,?)";
                    $req = $db->prepare($sql);
                    $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$somme,$date_hist));




            $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
            $sql2 = $db->prepare($query1);

             // Bind parameters to statement
            $sql2->bindParam(':payer', $payer);
            $sql2->execute();

            if($sql2)
                                    {
                                        ?>
                                        <script>
                                           // alert('Personnel a été bien modifié.');
                                                      window.location.href='<?=$dette['option2_link']?>?id=<?=$id?>&witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {
                                      ?>
                                        <script>
                                            //alert('Personnel n\'a pas été modifié.');
                                             window.location.href='<?=$dette['option2_link']?>?id=<?=$id?>&witness=-1';
                                        </script>
                                        <?php

                                    }




        }elseif($versement+$payer>$somme){

            ?>
                <script>
                   // alert('Personnel a été bien modifié.');
                               window.location.href='<?=$dette['option2_link']?>?id=<?=$id?>&witness=2';
                </script>
            <?php

        }else{
            echo $payer1=$versement+$payer;

             $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $solde=$table['total'];

                                        }

           echo $pay_total=$payer1+$solde;


        $query1 = "UPDATE dette SET id_caisse=:id_caisse, annee=:annee, id_ing=:id_ing, somme=:somme, payer=:payer1 where id_dette = '$id' and id_caisse='$id_caisse' and id_ing='$id_ing' ";
            $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':id_caisse', $id_caisse);
            $sql1->bindParam(':annee', $annee);
            $sql1->bindParam(':id_ing', $id_ing);
            $sql1->bindParam(':somme', $somme);
            $sql1->bindParam(':payer1', $payer1);
            $sql1->execute();

            $query2 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse'  ";
            $sql2 = $db->prepare($query2);

             // Bind parameters to statement
            $sql2->bindParam(':payer', $pay_total);
            $sql2->execute();


            $ref_caisse=$ref_ing_det;
            $id_beneficiaire=$id_ing;
            $somme=$payer;
            $date_hist=$annee;


            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist)
                      VALUES (?,?,?,?,?)";
                    $req = $db->prepare($sql);
                    $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$somme,$date_hist));

            if($sql2)
                                    {
                                        ?>
                                        <script>
                                           // alert('Personnel a été bien modifié.');
                                                      window.location.href='<?=$dette['option2_link']?>?id=<?=$id?>&witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {
                                      ?>
                                        <script>
                                            //alert('Personnel n\'a pas été modifié.');
                                             window.location.href='<?=$dette['option2_link']?>?id=<?=$id?>&witness=-1';
                                        </script>
                                        <?php

                                    }

        }

}else{
        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                             window.location.href='<?=$dette['option2_link']?>?witness=1';
                                        </script>
                                        <?php

}





        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/







}
?>
