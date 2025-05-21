<?php
//    session_start();
include 'php/dbconnect.php';
include 'php/db.php';
require 'MailSender/mailsenderclass.php';

if ( isset($_POST['email'])) {

 
    $email = $_POST['email'];


    $pos=0;
    
    $query = "SELECT count(*) as total from users WHERE email='$email' and statut !='D' ";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $total = $row["total"];
        $pos=1;
    }
    
    if($total == 0){
        $query = "SELECT count(id_users) as total, id_users  from users_members WHERE email='$email' and statut !='D'";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
            $total = $row["total"];
            $id_user = $row["id_users"];
            $pos=2;
        }
    }
    
    
    
    if ($total == 1) {
        $check_code=rand(1000, 9999);
///--------------------MAIL---------------------------///
                    $mailler = new mailsenderclass();

    $subject = "CODE DE VERIFICATION";
    $body = "Voici le code de verification : "
        .$check_code."";

    $from= 'infomail@closer.cm';
    $from_name='ONIGC';
    //----------utiliser-------------//
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
    //$email_user='mboningandy43@gmail.com'; 
    //$email_user_2='elodiemanga987@gmail.com';

   // $mailler->mailsenderclass($email_user, $from, $from_name, $subject, $body);
   //////////////////////////////////////////////////////////////////////////////
    $mailler->mailsenderclass($email, $from, $from_name, $subject, $body);
    
    $check_code = hash('sha256', $check_code);
    
    ?>
    <script>
       // alert('Error.');
         window.location.href='connexion_check_code.php?check=<?=$check_code?>&email=<?=$email?>';
    </script>
    <?php

        ////////////////////////////////////////////////////////

    }else header('Location: connexion_new_pwd.php?login_err=already');
} else header('Location: connexion.php');
?>
