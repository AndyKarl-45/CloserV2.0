<?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php
// $total_apt = 0;
// $today = date("Y-m-d");
// $today = date("t", strtotime($today));

// $year = (new DateTime())->format("Y");
// $month = (new DateTime())->format("m");
// $day = (new DateTime())->format("d");
// $query  = "SELECT count(id_app) as total from appointment";
// $q = $conn->query($query);
// while($row = $q->fetch_assoc())
// {
//     $total_apt = $row["total"];
// }
// $id_app = $total_apt + 1;
// $ref_app = 'APT_'.$year.'_'.$month.'_'.$day.'_'.$id_app;
if($_POST)
{


         $year = (new DateTime())->format("Y");
         $month = (new DateTime())->format("m");
         $day = (new DateTime())->format("d");

        $id_caisse = $_POST['id_caisse'];
        $id_user_perso = $_SESSION['rainbo_id_perso'];


         $annee=$_POST['annee'];
         $id_ing = $_POST['id_ing'];
        $somme = $_POST['somme'];
        $payer = abs($_POST['payer']);
         $open_close=0;
         
        $bn_user_dette=0;
        
        $query1 = "SELECT * from personnel WHERE id_personnel= $id_user_perso";
       $stmt = $db->prepare($query1);
        $stmt->execute();
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($tables as $row1)
        {
            $nom_us = $row1["nom"] . ' ' . $row1["prenom"];
            $bn_user_dette++;
        }
        
        if($bn_user_dette == 0){
            $query1 = "SELECT * from mytable WHERE id_ingenieur= $id_user_perso";
            $stmt = $db->prepare($query1);
            $stmt->execute();
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($tables as $row1)
            {
                    $nom_us = $row1["nom_ing"] . ' ' . $row1["prenom_ing"];
                    $bn_user_dette++;
                    
            }
        }
        if($bn_user_dette == 0 ){
           ?>
            <script>
               // alert('Error.');
                 window.location.href='<?=$dette['option2_link']?>?witness=-1';
            </script>
            <?php
        }





                  $sql="SELECT count(id_dette) as total, ref_ing_det as ref, somme, payer FROM dette where id_caisse='$id_caisse' and id_ing='$id_ing' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                          $count=$table['total'];

                                            $payer_i=$table['payer'];
                                            $ref_ing_det=$table['ref'];
                                        }
if($count==0){





          echo  $ref_ing_det='REF_2021'.$id_ing;





        if($somme-$payer==0){
            $etat = 'OK';

            $sql = "INSERT INTO dette (id_caisse,annee,ref_ing_det,id_ing,somme,payer,etat,open_close,id_auteur,auteur)
                                  VALUES (?,?,?,?,?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($id_caisse,$annee,$ref_ing_det,$id_ing,$somme,$payer,$etat,$open_close,$id_user_perso,$nom_us));




                $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $solde=$table['total'];

                                        }

            $somme=$payer+$solde;

             $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
            $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':payer', $somme);
            $sql1->execute();


            $ref_caisse=$ref_ing_det;
            $id_beneficiaire=$id_ing;
            $somme=$payer;
            $date_hist=date('Y-m-d');
            $sum_sortie=0;


            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,montant_sortie,date_hist,id_perso)
                      VALUES (?,?,?,?,?,?)";
                    $req = $db->prepare($sql);
                    $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$somme,$sum_sortie,$date_hist,$id_user_perso));


            if($sql1)
                                    {
                                        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                              window.location.href='<?=$dette['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {
                                      ?>
                                        <script>
                                           // alert('Error.');
                                             window.location.href='<?=$dette['option2_link']?>?witness=-1';
                                        </script>
                                        <?php

                                    }


        }elseif($somme-$payer<0){

            ?>
                <script>
                   // alert('Personnel a été bien modifié.');
                            window.location.href='<?=$dette['option2_link']?>?id=<?=$id?>&witness=2';
                </script>
            <?php


        }else{

            $sql = "INSERT INTO dette (id_caisse,annee,ref_ing_det,id_ing,somme,payer,open_close,id_auteur,auteur)
                                  VALUES (?,?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($id_caisse,$annee,$ref_ing_det,$id_ing,$somme,$payer,$open_close,$id_user_perso,$nom_us));

            $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse'  ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $solde=$table['total'];

                                        }

            $somme=$payer+$solde;

             $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse' ";
            $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':payer', $somme);
            $sql1->execute();

            $ref_caisse=$ref_ing_det;
            $id_beneficiaire=$id_ing;
            $somme=$payer;
            $date_hist=date('Y-m-d');
            $sum_sortie=0;


            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,montant_sortie,date_hist,id_perso)
                      VALUES (?,?,?,?,?,?)";
                    $req = $db->prepare($sql);
                    $req->execute(array($id_caisse,$ref_caisse,$id_beneficiaire,$somme,$sum_sortie,$date_hist,$id_user_perso));

            if($sql1)
                                    {
                                        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                              window.location.href='<?=$dette['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {
                                      ?>
                                        <script>
                                           // alert('Error.');
                                        /window.location.href='<?=$dette['option2_link']?>?witness=-1';
                                        </script>
                                        <?php

                                    }

        }
}elseif($count!=0 ){





        ?>
                                        <script>
                                            alert('Cotisation déjà crée !!! vous devez la modifier !!! ');
                                             window.location.href='<?=$dette['option2_link']?>?witness=-1';
                                        </script>
                                        <?php

}







}
?>
