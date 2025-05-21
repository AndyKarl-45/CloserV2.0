<?php

include('first.php');
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Nouveau Utilisateur</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme <?= strtoupper($nom_user) ?> il est <?= date("G:i"); ?> en ce jour
                        du <?= dateToFrench("now", "l j F Y"); ?>.
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <?php
                                if (isset($_GET['reg_err'])) {
                                    $err = $_GET['reg_err'];

                                    switch ($err) {
                                        case 'password';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> mot de passe différent
                                            </div>
                                            <?php
                                            break;
                                        case 'already';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> compte déjà existant
                                            </div>
                                            <?php
                                            break;
                                        case 'email';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> email non valide
                                            </div>
                                            <?php
                                            break;
                                        case 'pseudo_lenght';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> pseudo trop long
                                            </div>
                                            <?php
                                            break;
                                        case 'email_lenght';
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> email trop long
                                            </div>
                                            <?php
                                            break;
                                        case 'success';
                                            ?>
                                            <div class="alert alert-success">
                                                <strong>Succès : </strong> inscription réussie, vous pouvez vous
                                                connecter en cliquant sur "Connexion" !
                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                            </div>
                            <form class="form-horizontal" action="inscription_traitement.php" method="POST">
                                <div class="card-body">
                                    <fieldset>
                                        <div class="table-responsive">
                                            <table border="0" class="table  table-hover table-condensed" id="myTable">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="help-block small-font">NOM DU PERSONNEL</span>

                                                        <div class="col">
                                                             <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxUs" >
                                                            <select name="id_person" id="countriesUs" class="form-control" required>
                                                                <option value="" selected="">...</option>
                                                                <?php
                                                                $query = "SELECT * from personnel";
                                                                $q = $db->query($query);
                                                                while ($row = $q->fetch()) {
                                                                    $id_personnel = $row['id_personnel'];
                                                                    $matricule = $row['matricule'];
                                                                    $nom = $row['nom'];
                                                                    $prenom = $row['prenom'];

                                                                    echo '<option value="' . $id_personnel . '">';
                                                                    echo $nom . ' ' . $prenom . ' (' . $matricule . ')';
                                                                    echo '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="help-block small-font">PROFIL</span>
                                                        <div class="col">
                                                            <select name="lvl" class="form-control" required>
                                                                <option value="" selected="">...</option>
                                                                <?php

                                                                $iResult = $db->query('SELECT * FROM roles');
                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['lvl'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['fonction'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table border="0" class="table  table-hover table-condensed" id="myTable">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="help-block small-font">Pseudo</span>
                                                        <div class="col">
                                                            <input class="form-control"
                                                                   name="pseudo" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="help-block small-font">Mot de passe</span>
                                                        <div class="col">
                                                            <input type="password" class="form-control"
                                                                   name="password" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="help-block small-font">Email</span>
                                                        <div class="col">
                                                            <input type="email" class="form-control"
                                                                   name="email">
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </div>
                                <center>
                                    <button type="submit" style=" width:150px;" name="submit_user"
                                            class="btn btn-primary">Créer
                                    </button>
                                    <a href="liste_utilisateurs.php" style=" width:150px;"
                                       class="btn btn-primary"><font>Annuler</font></a>
                                </center>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
        <script>

        searchBoxI = document.querySelector("#searchBoxUs");
        countriesI = document.querySelector("#countriesUs");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxI.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesI.options; //select options
            for (var i = 0; i < options.length; i++) {
                var option = options[i]; //current option
                var optionText = option.text; //option text ("Somalia")
                var lowerOptionText = optionText.toLowerCase(); //option text lowercased for case insensitive testing
                var lowerText = text.toLowerCase(); //searchBox value lowercased for case insensitive testing
                var regex = new RegExp("^" + text, "i"); //regExp, explained in post
                var match = optionText.match(regex); //test if regExp is true
                var contains = lowerOptionText.indexOf(lowerText) != -1; //test if searchBox value is contained by the option text
                if (match || contains) { //if one or the other goes through
                    option.selected = true; //select that option
                    return; //prevent other code inside this event from executing
                }
                searchBoxI.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>

    <!--//Footer-->
<?php
include('foot.php');
?>