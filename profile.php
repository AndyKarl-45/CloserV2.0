<?php

include('first.php');
include('php/main_side_navbar.php');

$error = '';
if (isset($_POST['save_password'])) {

    $ancient_password = $_POST['oldpassword'];

    $nouveau_password = $_POST['newpassword'];

    $confirmpassword = $_POST['confirmpassword'];

    $cpt = 0;
    $query = "SELECT * from users WHERE pseudo='$user'";
    $q = $conn->query($query);

    while ($row = $q->fetch_assoc()) {
        $true_password = $row["password"];
        $cpt=1;

//        echo $lvl.'<br/>';
    }
    
    if ($cpt==0){
        $query = "SELECT * from users_members WHERE pseudo='$user'";
        $q = $conn->query($query);
    
        while ($row = $q->fetch_assoc()) {
            $true_password = $row["password"];
            $cpt=2;
    
    //        echo $lvl.'<br/>';
        }
    
    }

    if ($nouveau_password === $confirmpassword) {
        if ($nouveau_password !== $ancient_password) {
            $ancient_password = hash('sha256', $ancient_password);
//            echo 'old '.$ancient_password.'<br/>';
//            echo 'True '.$true_password.'<br/>';
            if ($true_password === $ancient_password) {

                $nouveau_password = hash('sha256', $nouveau_password);
                if ($true_password !== $nouveau_password) {
                    if($cpt == 1){
                        $sql = $conn->query("UPDATE users SET password='$nouveau_password' WHERE pseudo='$user'");
                    }else if($cpt == 2){
                        $sql = $conn->query("UPDATE users_members SET password='$nouveau_password' WHERE pseudo='$user'");
                    }
                    header('Location: profile.php?password_err=success');
                } else header('Location: profile.php?password_err=anotherpassword');
            } else header('Location: profile.php?password_err=not_oldpassword');
        } else header('Location: profile.php?password_err=samepassword_entered');
    } else header('Location: profile.php?password_err=passeword_retype');

}

if (isset($_POST['save_username'])) {

    $username = $_POST['newusername'];

    $password = $_POST['password'];

    $id = 0;
    $cpt=0;
    $query = "SELECT * from users WHERE pseudo='$user'";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $id = $row["id_users"];
        $true_password = $row["password"];
        $cpt=1;
    }
    
    if ($cpt==0){
        $query = "SELECT * from users_members WHERE pseudo='$user'";
        $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $id = $row["id_users"];
        $true_password = $row["password"];
        $cpt=2;
    }
    
    }
    

    $password = hash('sha256', $password);
    
            // echo '<div> id '.$id.'<br/>';
            // echo 'username '.$username.'<br/>';
            // echo '$true_password === $password => '.($true_password === $password).'<br/></div>';
    if ($user !== $username) {
        if ($true_password === $password) {
            $tmp = 0;
             if($cpt == 1){
                $sql = $conn->query("UPDATE users SET pseudo='$username' WHERE id_users=$id");
                $tmp = 0;
                $query = "SELECT * from users WHERE pseudo='$username'";
                $q = $conn->query($query);
                while ($row = $q->fetch_assoc()) {
                    $tmp ++;
                }
             }else if($cpt == 2){
                 $sql = $conn->query("UPDATE users_members SET pseudo='$username' WHERE id_users=$id");
                $tmp = 0;
                $query = "SELECT * from users_members WHERE pseudo='$username'";
                $q = $conn->query($query);
                while ($row = $q->fetch_assoc()) {
                    $tmp ++;
                }
             }
            if ($tmp != 0) {
                header('Location: profile.php?username_err=success');
            }else{
                header('Location: profile.php?username_err=syserror&id='.$id);
            }
        } else header('Location: profile.php?username_err=password');
    } else header('Location: profile.php?username_err=username');

}

if (isset($_POST['save_email'])) {

    $useremail = $_POST['newemail'];

    $password = $_POST['password'];

    $id = 0;
    $t=0;
    $cpt=0;
    $pseudo = $user;
    
    $query = "SELECT * from users WHERE pseudo='$user'";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $id = $row["id_users"];
        $true_password = $row["password"];
        $true_email = $row["email"];
        $cpt=1;
    }
    
    $query = "SELECT * from users WHERE email='$useremail'";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $t++;
        $pseudo = $row["pseudo"];
    }
    
    if ($cpt==0){
        $pseudo="";
        $query = "SELECT * from users_members WHERE pseudo='$user'";
        $q = $conn->query($query);
    
        while ($row = $q->fetch_assoc()) {
            $id = $row["id_users"];
            $true_password = $row["password"];
            $true_email = $row["email"];
            $cpt=2;
        }
        
        $t=0;
        $query = "SELECT * from users_members WHERE email='$useremail'";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
            $t++;
            $pseudo = $row["pseudo"];
        }
    
    }
    

    $password = hash('sha256', $password);
    
            // echo '<div> id '.$id.'<br/>';
            // echo 'username '.$username.'<br/>';
            // echo '$true_password === $password => '.($true_password === $password).'<br/></div>';
            
    // if($user != $pseudo ){
        // if ($useremail == $true_email) {
            if ($true_password === $password) {
                $tmp = 0;
                 if($cpt == 1){
                    $sql = $conn->query("UPDATE users SET email='$useremail' WHERE id_users=$id");
                    $tmp = 0;
                    $query = "SELECT * from users WHERE pseudo='$user' and email='$useremail'";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $tmp ++;
                    }
                 }else if($cpt == 2){
                     $sql = $conn->query("UPDATE users_members SET email='$useremail' WHERE id_users=$id");
                    $tmp = 0;
                    $query = "SELECT * from users_members WHERE pseudo='$user' and email='$useremail'";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $tmp ++;
                    }
                 }
                if ($tmp != 0) {
                    header('Location: profile.php?email_err=success');
                }else{
                    header('Location: profile.php?email_err=syserror&id='.$id);
                }
            } else header('Location: profile.php?email_err=password');
        // } else header('Location: profile.php?email_err=same_email');
    // } else header('Location: profile.php?email_err=exit_already');

}

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Mon Profile</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme <?= strtoupper($user); ?>, il est <?= date("G:i"); ?> en ce jour
                        du <?= dateToFrench("now", "l j F Y"); ?>.
                    </li>
                </ol>

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="mt-4">Mon identifiant</h1>

                                <?php
                                if (isset($_GET['username_err'])) {
                                    $err_username = $_GET['username_err'];

                                    switch ($err_username) {
                                        case 'username';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Vaillez saisir identifiant différent de
                                                l'ancien
                                            </div>
                                            <?php
                                            break;
                                        case 'password';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Mot de passe incorret
                                            </div>
                                            <?php
                                            break;
                                        case 'success';
                                            ?>
                                            <div class="alert alert-success">
                                                <script>
                                                    alert('Identifiant changé avec succès, vous allez être déconncté.e');
                                                    window.location.href= 'deconnexion.php';
                                                </script>
                                                <strong>Succès : </strong> Identifiant modifié avec succès, vous allez être redirigé automatiquement.
                                            </div>
                                            <?php
                                            break;
                                        case 'syserror';
                                            ?>
                                            <div class="alert alert-warning">
                                                <strong>Erreur : </strong> Erreur système, merci de re-essayer encore.
                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /. ROW  -->
                        <div class="row">

                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Veillez remplir ce formulaire pour changer votre identifiant, puis saississez votre mot de passe pour valider
                                    </div>
                                    <form action="profile.php" method="post" id="signupForm1" class="form-horizontal">
                                        <div class="panel-body">
                                            <br/>

                                            <div class="form-group">
                                                <label class="col-sm-12 control-label" for="Username"> Nouvel identifiant (identifiant actuel : <b><?=$user?> </b>)</label>
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="newusername" id="newusername"
                                                           type="text">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-12 control-label" for="Confirm">Confirmation
                                                    avec mot de passe</label>
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="password" type="password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-4">
                                                    <button type="submit" name="save_username" class="btn btn-primary">
                                                        Mettre à jour
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>


                        </div>
                        <!-- /. ROW  -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="mt-4">Mon adresse email</h1>

                                <?php
                                if (isset($_GET['email_err'])) {
                                    $err_username = $_GET['email_err'];

                                    switch ($err_username) {
                                        case 'same_email';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Vaillez saisir une adresse email différente de
                                                l'ancienne
                                            </div>
                                            <?php
                                            break;
                                        case 'exit_already';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Cette adresse email est deja utilisée par un autre utilisateur
                                            </div>
                                            <?php
                                            break;
                                            case 'password';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Mot de passe incorret
                                            </div>
                                            <?php
                                            break;
                                        case 'success';
                                            ?>
                                            <div class="alert alert-success">
                                                <script>
                                                    alert('Email changé avec succès, vous allez être déconncté.e');
                                                    window.location.href= 'deconnexion.php';
                                                </script>
                                                <strong>Succès : </strong> Email modifié avec succès, vous allez être redirigé automatiquement.
                                            </div>
                                            <?php
                                            break;
                                        case 'syserror';
                                            ?>
                                            <div class="alert alert-warning">
                                                <strong>Erreur : </strong> Erreur système, merci de re-essayer encore.
                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /. ROW  -->
                        <div class="row">

                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Veillez remplir ce formulaire pour changer votre adresse email, puis saississez votre mot de passe pour valider
                                    </div>
                                    <form action="profile.php" method="post" id="signupForm1" class="form-horizontal">
                                        <div class="panel-body">
                                            <br/>

                                            <div class="form-group">
                                                <label class="col-sm-12 control-label" for="Username"> Nouvelle adresse email (email actuel : <b><?=$email_user?> </b>)</label>
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="newemail" id="newemail"
                                                           type="email">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-12 control-label" for="Confirm">Confirmation
                                                    avec mot de passe</label>
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="password" type="password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-4">
                                                    <button type="submit" name="save_email" class="btn btn-primary">
                                                        Mettre à jour
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>


                        </div>
                        <!-- /. ROW  -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="mt-4">Modifier mon mot de passe</h1>

                                <?php
                                if (isset($_GET['password_err'])) {
                                    $err = $_GET['password_err'];

                                    switch ($err) {
                                        case 'passeword_retype';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Veillez resaisir vos mots de passe en faisant
                                                attention à la confirmation du nouveau mot de passe
                                            </div>
                                            <?php
                                            break;
                                        case 'samepassword_entered';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Vaillez saisir un mot de passe différent de
                                                l'ancien
                                            </div>
                                            <?php
                                            break;
                                        case 'not_oldpassword';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Mot de passe incorret
                                            </div>
                                            <?php
                                            break;
                                        case 'anotherpassword';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> Vaillez saisir un nouveau mot de passe
                                            </div>
                                            <?php
                                            break;
                                        case 'success';
                                            ?>
                                            <div class="alert alert-success">
                                                <strong>Succès : </strong> Mot de passe changé !
                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /. ROW  -->
                        <div class="row">

                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Veillez remplir ce formulaire pour changer votre ancien mot de passe
                                    </div>
                                    <form action="profile.php" method="post" id="signupForm1" class="form-horizontal">
                                        <div class="panel-body">
                                            <br/>

                                            <div class="form-group">
                                                <label class="col-sm-12 control-label" for="Old">Ancien mot de
                                                    passe</label>
                                                <div class="col-sm-12">
                                                    <input type="password" class="form-control" id="oldpassword"
                                                           name="oldpassword"/>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-12 control-label" for="Password"> Nouveau mot de
                                                    passe</label>
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="newpassword" id="newpassword"
                                                           type="password">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-12 control-label" for="Confirm">Confirmation
                                                    nouveau mot de passe</label>
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="confirmpassword" type="password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-4">
                                                    <button type="submit" name="save_password" class="btn btn-primary">
                                                        Mettre à jour
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>


                        </div>
                        <!-- /. ROW  -->
                    </div>
                </div>


            </div>
        </main>
    </div>

    <!--//Footer-->
<?php
include('foot.php');
?>