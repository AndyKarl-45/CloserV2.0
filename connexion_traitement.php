<?php
//    session_start();
include 'php/dbconnect.php';
include 'php/db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {

    $pseudo = $_POST['username'];
    $password = $_POST['password'];

//        echo $pseudo.'<br/>';
//        echo $password.'<br/>';


//-----------------update les emails de tout le personnel------------------------//
    // $query = "SELECT * from personnel WHERE open_close!='1' ";
    // $q = $conn->query($query);
    // while ($row = $q->fetch_assoc()) {
    //     $email_persos = $row["email"];
    //     $id_persoss = $row["id_personnel"];
    
    //         $sql = $conn->query("UPDATE users SET email = '$email_persos' WHERE id_perso=$id_persoss and statut='A'");
        
        
    // }
////////////////////////////////////////////


        $total = 0;
    
    $query = "SELECT count(*) as total from users WHERE pseudo='$pseudo' and statut !='D' ";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $total = $row["total"];
    }

//        echo $total;
    $statut = "D";
    $cpt =0;
    
    $chantier_user = 0;
    if ($total == 0) {
        
        $query = "SELECT count(*) as total from users_members WHERE pseudo='$pseudo' and statut !='D'";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
            $total = $row["total"];
        
        }
        $cpt++;
    }
    if ($total == 1) {
        
        if ($cpt == 0){
            $query = "SELECT * from users WHERE pseudo='$pseudo' and statut !='D'";
            $q = $conn->query($query);
            while ($row = $q->fetch_assoc()) {
                $true_password = $row["password"];
                $lvl = $row['lvl'];
                $email = $row['email'];
                $id_perso = $row['id_perso'];
                $statut = $row['statut'];
    //                echo $lvl.'<br/>';
            }
        }else{
            $query = "SELECT * from users_members WHERE pseudo='$pseudo' and statut !='D'";
            $q = $conn->query($query);
            while ($row = $q->fetch_assoc()) {
                $true_password = $row["password"];
                $lvl = $row['lvl'];
                $email = $row['email'];
                $id_perso = $row['id_ingenieur'];
                $statut = $row['statut'];
    //                echo $lvl.'<br/>';
            }
            
        }
//            global $lvl;
        $password = hash('sha256', $password);
//            echo 'True PW :'.$true_password.'<br/>';
//            echo 'PW :'.$password.'<br/>';

        if ($true_password === $password) {
            if ($statut === "A") {

                $_SESSION['rainbo_name'] = $pseudo;
                $_SESSION['rainbo_lvl'] = $lvl;
                $_SESSION['rainbo_email'] = $email;
                $_SESSION['rainbo_id_perso'] = $id_perso;
                $_SESSION['rainbo_chantier'] = $chantier_user;

                //                $_SESSION['msg'] = 'bienvenue '.$pseudo.' !';
                //                echo $lvl;
                header('Location: index.php');
            } else header('Location: connexion.php?login_err=desactived');
        } else header('Location: connexion.php?login_err=password');
    } else header('Location: connexion.php?login_err=already');
} else header('Location: connexion.php');
?>
