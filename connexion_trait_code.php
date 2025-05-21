<?php
//    session_start();
include 'php/dbconnect.php';
include 'php/db.php';
require 'MailSender/mailsenderclass.php';

function password_generate($chars) 
    {
      $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
      return substr(str_shuffle($data), 0, $chars);
    }

if (isset($_POST['true_code']) && isset($_POST['check_code'])  && isset($_POST['email'])) {

    $true_code = $_POST['true_code'];
    $check_code = $_POST['check_code'];
    $check_code = hash('sha256', $check_code);
    $email = $_POST['email'];
    
    
    $query = "SELECT count(id_users) as total,id_users from users WHERE email='$email' and statut !='D'";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $total = $row["total"];
        $id_user = $row["id_users"];
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
        if ($true_code == $check_code) {
            $password = password_generate(8);
            $pwds = hash('sha256', $password);
                if($pos==1){
                    
                     $sql = $conn->query("UPDATE users SET password = '$pwds' WHERE id_users='$id_user' and statut !='D'");
                }else{
                    $sql = $conn->query("UPDATE users_members SET password = '$pwds' WHERE id_users='$id_user' and statut !='D'");
                }
        if($sql){
                        ///--------------------MAIL---------------------------///
                        $mailler = new mailsenderclass();
    
        $subject = "NOUVEAU MOT DE PASSE";
        $body = "Voici votre nouveau mot de passe : "
            .$password."";
    
        $from= 'infomail@closer.cm';
        $from_name='ONIGC';
        ///----- utiliser pour d'autres action ------------////
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
       //////////////////////////////////////////////////////////////////////
        $mailler->mailsenderclass($email, $from, $from_name, $subject, $body);
        ?>
        <script>
           // alert('Error.');
             window.location.href='connexion.php?login_err=newpass';
        </script>
        <?php
    
            
            }else{
             ?>
                <script>
                   // alert('Error.');
                     window.location.href='connexion.php?login_err=password';
                </script>
                <?php

            }

    
        }else header('Location: connexion_check_code.php?login_err=falsecode');
    } else header('Location: connexion_check_code.php?login_err=already');
} else header('Location: connexion.php');
?>
