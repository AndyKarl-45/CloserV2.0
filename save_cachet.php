 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php")
?>

<?php

if($_POST)
{               
    
                 $user =$_SESSION['rainbo_name'];
                 $lvl =$_SESSION['rainbo_lvl'] ;
                 $email_user =$_SESSION['rainbo_email'] ;
                 $id_session =$_SESSION['rainbo_id_perso'] ;

         // $year = (new DateTime())->format("Y");
         // $month = (new DateTime())->format("m");
         // $day = (new DateTime())->format("d");

  $id_ing = $_POST['id_ing'];
   $tel= $_POST['tel'];
   $recu= $_POST['recu'];
   $ville= $_POST['ville'];
   $id_statut=$_POST['id_statut'];
    $date_cachet=date('Y-m-d');
       $annee=date('Y');
       
       $bn_user=0;
                
                $query1 = "SELECT * from personnel WHERE id_personnel= $id_session";
               $stmt = $db->prepare($query1);
                $stmt->execute();
                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($tables as $row1)
                {
                    $nom_us = $row1["nom"] . ' ' . $row1["prenom"];
                    $bn_user++;
                }
                
                if($bn_user == 0){
                    $query1 = "SELECT * from mytable WHERE id_ingenieur= $id_session";
                    $stmt = $db->prepare($query1);
                    $stmt->execute();
                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($tables as $row1)
                    {
                            $nom_us = $row1["nom_ing"] . ' ' . $row1["prenom_ing"];
                            $bn_user++;
                            
                    }
                }
                if($bn_user == 0 ){
                    ?>
                    <script>
                        alert('Error.');
                         window.location.href='liste_cachet.php?witness=-1';
                    </script>
                    <?php
                }
       
                $sql="SELECT matricule FROM  mytable where id_ingenieur='$id_ing'";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                          $matricule=$table['matricule'];
                                        }


        $cnt=0;
         $sql="SELECT matricule, count(id_ingenieur) as total FROM  demande_cachet where id_ingenieur='$id_ing' and annee='$annee' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                          $count=$table['total'];
                                        
                                           
                                       
if($count==0){


        
      
        
                                    $sql = "INSERT INTO demande_cachet (id_ingenieur,matricule,statut,tel,date_cachet,annee,recu,ville,id_auteur,auteur)
                                  VALUES (?,?,?,?,?,?,?,?,?,?)";
                                $req = $db->prepare($sql);
                                $req->execute(array($id_ing,$matricule,$id_statut,$tel,$date_cachet,$annee,$recu,$ville,$id_session,$nom_us));
                                
                                
                                if($req)
                                    {
                                        
                                                     ///--------------------MAIL---------------------------///
                                                    $mailler = new mailsenderclass();
            
                                    $subject = "Demande de Cachet";
                                    $body = "Demande de cachet effectuee par le membre de matricule : "
                                        .strtoupper($matricule)." le "
                                        .date("d/m/Y"). " A "
                                        .date("G:i")
                                        ."<br/>
                                                                     <a href='closer.cm'>Voir les details</a>";
                                    $body2 = "Bonjour ".$user.", Nous accusons reception de votre  demande de cachet du : "
                                        .date("d/m/Y"). " A "
                                        .date("G:i")
                                        ."<br/>
                                                                     <a href='closer.cm'>Voir les details</a>";
            
                                    $from= 'infomail@closer.cm';
                                    $from_name='ONIGC';
                                    // $sql = $db->query("select * from users where secteur = $id_secteur_user and (lvl = 4 or lvl = 3 or lvl = 8 or lvl = 7)");
                                    // while($row = $sql->fetch()){
                                    //     $to = $row['email'];
                                    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
                                    // }
            
                                    // $sql = $db->query("select * from users where (lvl = 5 or lvl = 6 )");
                                    // while($row = $sql->fetch()){
                                    //     $to = $row['email'];
                                    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
                                    // }
                                    //mail_elodie;
                                     $email_user1='jfkonde@syges.cm';
                                     $email_user2='ndenguedanny@yahoo.fr';
                                     $email_user_3='elodiemanga987@gmail.com';
                                   // $email_user_3='mboningandy43@gmail.com';
            
                                     $mailler->mailsenderclass($email_user1, $from, $from_name, $subject, $body);
                                     $mailler->mailsenderclass($email_user_2, $from, $from_name, $subject, $body);
                                     $mailler->mailsenderclass($email_user_3, $from, $from_name, $subject, $body);
                                     if($lvl == 1){
                                    $mailler->mailsenderclass($email_user, $from, $from_name, $subject, $body2);
                                     }
                                     
                                    
                                        
                                        
                                        ?>
                                        <script>
                                       // alert('Demandea été bien enregistrée.');
                                             window.location.href='<?=$demande_cachet['option2_link']?>?witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                             window.location.href='<?=$demande_cachet['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                       
                                    }

                                    



}else{

         ?>
                                        <script>
                                            alert('Demande exite Déjà !!! ');
                                              window.location.href='<?=$demande_cachet['option2_link']?>?witness=-1';
                                        </script>
                                        <?php
                                    }

     }



}
?>
