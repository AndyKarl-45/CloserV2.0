<?php
?>
<nav style="background-color: #28a745 !important;" class="sb-topnav navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
    <a class="navbar-brand" href="index.php">
        <?php
        $user = $_SESSION['rainbo_name'];
        $email_user = $_SESSION['rainbo_email'];
        echo $siteName;
        $lvl = $_SESSION['rainbo_lvl'];
        
        $chantier_user = $_SESSION['rainbo_chantier'];
        if ($chantier_user == 0)
            $chantier_user = "N/A";
        else {
            $query = "SELECT * from chantier where id_chantier = $chantier_user";
            $q = $db->query($query);
            while ($row = $q->fetch()) {
                $chantier_user = $row['nom_chantier'];
            }
        }
        ?>
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <!--            <div class="inner-text">-->
            <!--                <i class="fas fa-home"></i><sup><span class="badge badge-warning">-->
            <? //=$salle_user?><!--</span></sup>-->
            <!--            </div>-->
            <!--            &nbsp;&nbsp;&nbsp;-->
            <div class="inner-text">
                <a style="color: white;" href="https://support.winsoft.cm/connexion.php">SUPPORT</a>
            </div>
            &nbsp;&nbsp;&nbsp;
            <div class="inner-text">
                <i class="fas fa-map"></i><sup><span class="badge badge-warning"><?= $chantier_user ?></span></sup>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="inner-text">
                <?php
                $agreed=-1;
                $grade = "";
                $cpt=0;

                $iResult = $db->query('SELECT * FROM roles WHERE lvl = ' . $lvl);
                while ($data = $iResult->fetch()) {

                    $grade = $data['fonction'];
                }

                $id_perso = $_SESSION['rainbo_id_perso'];
                $nom_user = "";
                
                $id_caisse_user = 0;
                $query1 = "SELECT * FROM caisse WHERE id_perso= $id_perso";
                $q1 = $db->query($query1);
                while ($row1 = $q1->fetch()) {
                    $id_caisse_user = $row1["id_caisse"];
                }
               
                $query1 = "SELECT * from personnel WHERE id_personnel= $id_perso";
                $q1 = $db->query($query1);
                while ($row1 = $q1->fetch()) {
                    $nom_user = $row1["nom"] . ' ' . $row1["prenom"];
                    $cpt++;
                }
                
                if($cpt == 0){
                     $agreed=-1;
                    $query1 = "SELECT * from mytable WHERE id_ingenieur= $id_perso";
                    $q1 = $db->query($query1);
                    while ($row1 = $q1->fetch()) {
                        $nom_user = $row1["nom_ing"] . ' ' . $row1["prenom_ing"];
                        $cpt++;
                        
                    }
                    
                    //-----------------------------     frais de cotisation ok -----------------------//
                    // $cnt=0;
                    // $query1 = "SELECT * from cotisation WHERE id_ing= $id_perso and etat LIKE'P%' ";
                    // $stmt = $db->prepare($query1);
                    // $stmt->execute();
                    // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // foreach($tables as $table)
                    //     {
                    //         $cnt++;
                    //     }
                        
                    // if($cnt==0){
                    //     $agreed=0;
                    // }else{
                    //     $agreed=-1;
                    // }
                    
                    //--------------------------------------------------------------------------------
                    $etat_contisation_final='';
                            $year=date('Y');
                            $agreed=-1;
                            $query = "SELECT * from cotisation where id_ing =$id_perso and open_close!='1' and annee LIKE '$year%' ";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $ref_ing_cost = $row['ref_ing_cost'];
                                    $etat_contisation_final = $row['etat'];
                                    if(empty($etat_contisation_final)){ $etat_contisation_final='NO';  }
                                    
                                    if(!empty($ref_ing_cost)){
                                    $sql = "SELECT transaction_id FROM payement_init WHERE 	ref_ing_cost = '$ref_ing_cost'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $transaction_id=$table['transaction_id'];
                                                                }
                                    
                                    $sql = "SELECT status FROM payement_statut WHERE transaction_id = '$transaction_id'";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                   $statut_cost_ing=$table['status'];
                                                                }
                                    }
                                    if(strcmp($statut_cost_ing,"SUCCESS")==0){
                                        $agreed=0;
                                    }else{
                                        $agreed=-1;
                                    }
                                   
                         }
         
                }

                echo strtoupper($nom_user) . ' (' . $grade . ')';
                ?>
            </div>

        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php" title="<?=$email_user?>">Mon Profile</a>
                <div class="dropdown-divider"></div>
                <?php if($lvl > 12 && $lvl != 14  && $lvl != 15  && $lvl != 13){ ?>
                <a class="dropdown-item" href="liste_utilisateurs.php">Employés</a>
                <?php }
                if($lvl > 14 || $lvl == 10 || $lvl > 11){ ?>
                <a class="dropdown-item" href="liste_utilisateurs_membres.php">Membres</a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="deconnexion.php">Deconnexion</a>
            </div>
        </li>
    </ul>
</nav>
