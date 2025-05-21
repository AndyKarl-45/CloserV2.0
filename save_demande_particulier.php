 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               

         $year = (new DateTime())->format("Y");
         $month = (new DateTime())->format("m");
         $day = (new DateTime())->format("d");
         $years = (new DateTime())->format("y");

         $id_perso= $_POST['id_personnel'];
        $id_caisse= $_POST['id_caisse'];
        $date_dem_part=$_POST['date_dem_part'];
        $id_user_perso = $_SESSION['rainbo_id_perso'];
        
        $bn_user_dem=0;
        if($lvl !==1){
                 $query1 = "SELECT * from personnel WHERE id_personnel= '$id_user_perso' ";
           $stmt = $db->prepare($query1);
            $stmt->execute();
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($tables as $row1)
            {
                $nom_us = $row1["nom"];
                $bn_user_dem++;
            }
        }else{
                if($bn_user_dem == 0){
                $query1 = "SELECT * from mytable WHERE id_ingenieur= $id_user_perso";
                $stmt = $db->prepare($query1);
                $stmt->execute();
                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($tables as $row1)
                {
                        $nom_us = $row1["nom_ing"];
                        $bn_user_dem++;
                        
                }
            }
        }
       
        
        if($bn_user_dem == 0 ){
           ?>
            <script>
               // alert('Error.');
                 window.location.href='liste_demande_particulier.php?witness=-1';
            </script>
            <?php
        }
      
        $sql="SELECT YEAR('$date_dem_part') as total  ";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();

                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach($tables as $table)
                            {
                               $annee=$table['total'];
                            }
       
        
        
        
      $id_ing=$_POST['id_ing'];
         // $droit=$_POST['droit'];
         $droit='Payer';

         $sql="SELECT count(id_dem_part) as total FROM demande_particulier where id_caisse='$id_caisse' and id_ing='$id_ing' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                          $count=$table['total'];
                                            
                                           
                                        }
                                        
        $sql="SELECT count(id_dem_part) as totale FROM demande_particulier ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                          $num=$table['totale'];
                                            
                                           
                                        }
//if($count==0){
                $num++;
                if(strlen($num)<=4){
                    //N°   0008  /  01  /Pdt/SG/ONIGC/22
                    $numeroref = substr_replace("0000",$num, -strlen($num));
                    $ref_dem_part='N° '.$numeroref.' / '.$month.' /Pdt/SG/ONIGC/'.$years;
            
                }else{
                    //N°   00008  /  01  /Pdt/SG/ONIGC/22
                    $numeroref = substr_replace("00000",$num, -strlen($num));
                    $ref_dem_part='N° '.$numeroref.' / '.$month.' /Pdt/SG/ONIGC/'.$years;
            
                }
          
       // $ref_dem_part='ATTP00000'.$id_ing.'/ONIGC/'.$annee;
       
        
      
        
                                    $sql = "INSERT INTO demande_particulier (id_caisse,ref_dem_part,id_ing,droit,date_dem_part,id_perso,id_auteur)
                                  VALUES (?,?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($id_caisse,$ref_dem_part,$id_ing,$droit,$date_dem_part,$id_perso,$id_user_perso));

                                    if($sql)
                                    {
                                        ?>
                                        <script>
                                           // alert('Profession a été bien enregistrée.');
                                          window.location.href='<?=$demande_particulier['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                           // alert('Error.');
                                            window.location.href='<?=$demande_particulier['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }


//}else{

                                     ?>
                                        <script>
                                            // alert('Existe Déjà !!! ');
                                            //  window.location.href='<?=$demande_particulier['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
//}

}
?>
