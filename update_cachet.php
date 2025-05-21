<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $id = $_POST['id_cachet'];
    $id_ing = $_POST['id_ing'];
    $statut = $_POST['id_statut'];
    $tel = $_POST['tel'];
    $recu = $_POST['tel'];
    $ville = $_POST['ville'];
    $annee = $_POST['annee'];
    $email_user =$_SESSION['rainbo_email'] ;

            $sql="SELECT *  FROM mytable where id_ingenieur='$id_ing' ";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();

                             $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                        {
                                            $matricule=$table['matricule'];
                                        }
                                        
            $iResult = $db->query("SELECT * FROM  statut_cachet where id_statut='$statut'");

                    while ($data = $iResult->fetch()) {

                        $nom_statut = $data['nom'];

                    }
                    
            $iResult = $db->query("SELECT * FROM  demande_cachet where id_ingenieur='$id_ing'");

                    while ($data = $iResult->fetch()) {

                        $date_cachet = $data['date_cachet'];

                    }
             

        /*--------------------------------- SAVE DATA CIVIL STATE ---------------------------*/

        $query1 = "UPDATE demande_cachet SET id_ingenieur=:id_ing, matricule=:matricule, statut=:statut, tel=:tel,  annee=:annee, recu=:recu, ville=:ville where id_cachet = '$id' ";
  
        $sql1 = $db->prepare($query1);

             // Bind parameters to statement
            $sql1->bindParam(':id_ing', $id_ing);
            $sql1->bindParam(':matricule', $matricule);
            $sql1->bindParam(':statut', $statut);
            $sql1->bindParam(':tel', $tel);
            $sql1->bindParam(':annee', $annee);
            $sql1->bindParam(':recu', $recu);
            $sql1->bindParam(':ville', $ville);
            $sql1->execute();



                                    if($sql1)
                                    {
                                         ///--------------------MAIL---------------------------///
                                                    $mailler = new mailsenderclass();
                                                    if($statut==1){
                                                        $nom_statut='Demande envoyee';
                                                    }elseif($statut==4){
                                                        $nom_statut='Cachet Livre';
                                                    }
            
                                    $subject = "Demande de Cachet";
                                    $body = "La demande de cachet effectuee par le membre de matricule : "
                                        .strtoupper($matricule)." le "
                                        .$date_cachet. " est passe à l\'etape suivante: "
                                        .$nom_statut
                                        ."<br/>
                                                                     <a href='closer.cm'>Voir les details</a>";
                                    $body2 = "Bonjour ".$user.", Votre  demande de cachet du : "
                                        .$date_cachet. " est passe à l\'etape suivante:  "
                                        .$nom_statut
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
                                   
                                    $mailler->mailsenderclass($email_user, $from, $from_name, $subject, $body2);
                                     
                                     
                                        ?>
                                        <script>
                                           // alert('Personnel a été bien modifié.');
                                                  window.location.href='liste_cachet.php?&witness=1';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Demande n\'a pas été modifié.');
                                            window.location.href='modifier_cachet.php?id=<?=$id?>';
                                        </script>
                                        <?php
                                       
                                    }


   

}
?>
