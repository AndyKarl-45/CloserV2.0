<?php

include("php/dbconnect.php");
include("php/mainlinks.php");

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SYGES - ONIGC</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

    <!--Favicon-->
    <link rel="apple-touch-icon" sizes="150x150" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <style>
        .myhead {
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: center;
        }

        .jumbotron {
            /*background-image: url("img/bg-01.jpg");*/
            background-color: #dde9dd; /* Carpa main color */
            color: #000;
        }

        /* Center the loader */
        #loader {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            width: 120px;
            height: 120px;
            margin: -76px 0 0 -76px;
            border: 16px solid #000;
            border-radius: 50%;
            border-top: 16px solid #176AB0;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Add animation to "page content" */
        .animate-bottom {
            position: relative;
            -webkit-animation-name: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }
            to {
                bottom: 0px;
                opacity: 1
            }
        }

        @keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }
            to {
                bottom: 0;
                opacity: 1
            }
        }

        #myDiv {
            display: none;
            text-align: center;
        }

        .btn-primary {
            color: #fff;
            background-color: #176AB0;
            border-color: #176AB0;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #176AB0;
            border-color: #176AB0;
        }
    </style>

</head>

<body onload="myFunction()" class="jumbotron">

<div id="loader"></div>


<div style="display:none;" id="myDiv" class="animate-bottom">

                <b style="size: 15px"> Bienvenue sur CLOSER, la plateforme qui vous rapproche des services de l'Ordre National des Ingénieurs de Génie Civil  </b>
    
            <div class="row">
                <br/>
            </div>
            
    <div class="container">
       
        <div class="row ">
             

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                
               

                <div class="panel-body" style="background-color: #ffffff; margin-top:50px; border:solid 3px #0e0e0e;">
                    

                    <div class="text-center">
                        <img src="img/logos.png" class="inmg-thumbail" style="width: 120px; height: 100px;" alt="Logo SYGES RH">
                    </div>
                    <br/>
                    <h3 class="myhead" style="font-size: 19px">Veuillez entrer votre login et votre mot de passe</h3>

                    <?php
                    if (isset($_GET['login_err'])) {
                        $err = $_GET['login_err'];

                        switch ($err) {
                            case 'password';
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur : </strong> login ou mot de passe incorrect
                                </div>
                                <?php
                                break;
                            case 'already';
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur : </strong> compte non existant
                                </div>
                                <?php
                                break;
                            case 'desactived';
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Alerte : </strong> Votre compte a été desactivé, veillez contacter votre
                                    supérieur s'il s'agit d'une erreur
                                </div>
                                <?php
                                break;
                            case 'newpass';
                                ?>
                                <div class="alert alert-success">
                                    <strong>Alerte : </strong> Votre nouveau mot de passe est envoyé à votre email.
                                </div>
                                <?php
                                break;
                        }
                    }
                    ?>
                    <form action="connexion_traitement.php" method="post">
                        <hr/>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Login: (matricule à 6 caractères)" name="username" required/>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="password" name="password"
                                   required/>
                        </div>
                        <div class="form-group input-group">
                            <a href="connexion_new_pwd.php">Mot de passe oublié ?</a>
                        </div>
                        
                        <button class="btn btn-primary" type="submit">Connexion</button>
                    </form>
                </div>
            </div>
            

        </div>
        
            <div class="row">
                <br/>
            </div>
            
            <div class="alert alert-success col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <strong>Nos contacts</strong>
                <br/>
                <a href="https://support.winsoft.cm/connexion.php" target="_blank">  Support </a> 
                ||
                <a href="https://www.onigc.cm" target="_blank">  ONIGC</a>
            </div>
    </div>
</div>

<script>
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 1500);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }
</script>
</body>
</html>
