<?php
include 'first.php';
    // echo $_POST['username'].'<br/>';
//echo $_POST['email'].'<br/>';
//echo $_POST['password'].'<br/>';
//echo $_POST['password_retype'].'<br/>';

if (isset($_POST['id_person']) && isset($_POST['password'])) {

    $id_person = $_POST['id_person'];
    $pseudo = $_POST['pseudo'];
    // $secteur = $_POST['secteur'];
    $email = $_POST['email'];
    $password = $_POST['password'];
//            $password_retype = $_POST['password_retype'];
    $lvl = $_POST['lvl'];


    $query = "SELECT COUNT(pseudo) AS total FROM users_members WHERE pseudo = '$pseudo' and statut != 'D' ";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $total = $row["total"];
    }
    

    if ($total == 0) {
            $query = "SELECT COUNT(pseudo) AS total FROM users_members WHERE id_ingenieur = '$id_person' and statut != 'A' ";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
            $total_accounts = $row["total"];
        }
        
        if ($total_accounts == 0) {
            
            if (strlen($pseudo) <= 100) {
                // echo "pseudo: ".$pseudo.'<br/>';
                $password = hash('sha256', $password);
                $ip = $_SERVER['REMOTE_ADDR'];
                // $date_inscription = datetime("Y-m-d");
                // echo "Pass: ". $password.'<br/>';
                $sql = $conn->query("INSERT INTO users_members (id_ingenieur, pseudo, password, lvl, email, ip, date)
                                                    VALUES($id_person,'$pseudo', '$password', $lvl, '$email','$ip', SYSDATE())");
    
                // echo 'sql: '.$sql.'<br/>';
                // echo 'sql1: '.$sql1.'<br/>';
                if ($sql) {
                    // echo 'temoin <br/>';
                    header('Location: nouveau_membre.php?reg_err=success');
                }
            } else header('Location: nouveau_membre.php?reg_err=pseudo_lenght');
        } else header('Location: nouveau_membre.php?reg_err=many_account');
    } else header('Location: nouveau_membre.php?reg_err=already');
} else header('Location: nouveau_membre.php');
?>