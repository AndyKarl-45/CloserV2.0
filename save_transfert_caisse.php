 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               


        
        $id_caisse_src = $_POST['id_caisse_src'];
        $id_caisse_dest = $_POST['id_caisse_dest'];
        $code = $_POST['code'];
        $solde_total = abs($_POST['solde_total']);
        $date_transfert = $_POST['date_transfert'];
        $open_close=0;
        
        if($id_caisse_src!=$id_caisse_dest){

                            $sql = "INSERT INTO transfert_caisse (code,id_caisse_src,id_caisse_dest,solde_total,date_transfert,open_close)
                                  VALUES (?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($code,$id_caisse_src,$id_caisse_dest,$solde_total,$date_transfert,$open_close));




        // $etat = 'Valider';

            $sql="SELECT solde as total FROM caisse where id_caisse='$id_caisse_src'  ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $solde_src=$table['total'];
                                            
                                        }
$pay_total_src=$solde_src-$solde_total;
           
if($pay_total_src>=0){

            $sql="SELECT solde as total, id_perso FROM caisse where id_caisse='$id_caisse_dest'  ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $solde_dest=$table['total'];
                                            $id_perso=$table['id_perso'];
                                            
                                        }

            $pay_total_dest=$solde_total+$solde_dest;
             

    
            $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse_dest' ";
            $sql2 = $db->prepare($query1);

             // Bind parameters to statement
            $sql2->bindParam(':payer', $pay_total_dest);
            $sql2->execute();


            $query1 = "UPDATE caisse SET  solde=:payer where id_caisse = '$id_caisse_src' ";
            $sql2 = $db->prepare($query1);

             // Bind parameters to statement
            $sql2->bindParam(':payer', $pay_total_src);
            $sql2->execute();

            $ref_caisse=$code;
            $id_beneficiaire=$id_caisse_dest;
            $id_perso=$id_perso;
            $somme=$solde_total;
            $date_hist=$date_transfert;
            $statut='E';


            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut)
                      VALUES (?,?,?,?,?,?)";
                    $req = $db->prepare($sql);
                    $req->execute(array($id_caisse_dest,$ref_caisse,$id_caisse_dest,$somme,$date_hist,$statut));


            $statut='S';

            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,id_perso,montant_sortie,date_hist,statut)
                      VALUES (?,?,?,?,?,?,?)";
                    $req = $db->prepare($sql);
                    $req->execute(array($id_caisse_src,$ref_caisse,$id_beneficiaire,$id_perso,$somme,$date_hist,$statut));



                                    if($req)
                                    {
                                        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                             window.location.href='<?=$tresorerie['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                             window.location.href='<?=$tresorerie['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }
            }else{

                 ?>
                                        <script>
                                                 alert('Montant Insuffisant !!! ');
                                             window.location.href='<?=$tresorerie['option2_link']?>?witness=-1';
                                        </script>
                                        <?php

            }

        }else{
                    ?>
                                        <script>
                                            alert('Transfert du même caisse impossible !!! ');
                                             window.location.href='<?=$tresorerie['option2_link']?>?witness=-1';
                                        </script>
                                        <?php

        }


}
?>
