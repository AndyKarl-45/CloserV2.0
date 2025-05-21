<?php
include('navbar_links.php');

?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav style="background-color: #28a745 !important;" class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!--     <div class="sb-sidenav-menu-heading">Acceuil</div> -->
                    <a class="nav-link " href="index.php" style="color: white">
                        <div class="sb-nav-link-icon" style="color: white"><i class="fas fa-tachometer-alt"></i></div>
                        Tableau de Bord
                    </a>

                    <!--  <div class="sb-sidenav-menu-heading">Utilitaires</div> -->

                    <!--*******************************************MENU ENTITEES****************************************-->


                    <!--***************personnel***********************-->

                            
                            
                            <?php if($lvl > 9){ ?>

                           <a class="nav-link collapsed" href="<?= $personnel['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $personnel['icon'] ?>"></i></div>
                                <?= $personnel['title'] ?>
                            </a>
                    <?php } ?>
                    <?php if($lvl > 10){ ?>

                           <a class="nav-link collapsed" href="<?= $postulant['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $postulant['icon'] ?>"></i></div>
                                <?= $postulant['title'] ?>
                            </a>
                    <?php } ?>
                    
                    
                    <?php if($lvl > 0){ ?>
                             <a class="nav-link collapsed" href="<?= $ingenieur['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $ingenieur['icon'] ?>"></i></div>
                                <?= $ingenieur['title'] ?>
                            </a>
                    <?php } ?>
                    <?php if($lvl == 1 || $lvl > 9){ ?>
                            <a class="nav-link collapsed" href="<?= $entreprise['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $entreprise['icon'] ?>"></i></div>
                                <?= $entreprise['title'] ?>
                            </a>

                    <?php } ?>
                    <?php if($lvl > 10 && $lvl != 13  && $lvl != 14 && $lvl != 15){ ?>
                    
                           <a class="nav-link collapsed" href="<?= $tresorerie['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $tresorerie['icon'] ?>"></i></div>
                                <?= $tresorerie['title'] ?>
                            </a>
                    <?php } ?>
                    <?php if($lvl != 10){ ?>

                          

<?php if($lvl != 12){ ?>
<?php if($lvl != 19 ){   ?>
<?php if($lvl != 1 ){   ?>
                              <a class="nav-link collapsed" href="<?= $cotisation['option2_link'] ?>" aria-expanded="false"
                                     aria-controls="pagesCollapseError" style="color: white" >
                                      <div class="sb-nav-link-icon" style="color: white"><i class="<?= $cotisation['icon'] ?>"></i></div>
                                      <?= $cotisation['title'] ?>
                                 </a>
                                 <?php }?>
<?php } if($lvl == 19 || $lvl == 11 || $lvl == 13 || $lvl == 15){ ?>
                              <a class="nav-link collapsed" href="<?= $dette['option2_link'] ?>" aria-expanded="false"
                                     aria-controls="pagesCollapseError" style="color: white">
                                      <div class="sb-nav-link-icon" style="color: white"><i class="<?= $dette['icon'] ?>"></i></div>
                                      <?= $dette['title'] ?>
                                  </a>
<?php } }?>
                            <?php if($lvl > 10  && $lvl != 14 && $lvl != 15){ ?>
                              <!--<a class="nav-link collapsed" href="<?= $attestation['option2_link'] ?>" aria-expanded="false"-->
                              <!--       aria-controls="pagesCollapseError" style="color: white">-->
                              <!--        <div class="sb-nav-link-icon"style="color: white"><i class="<?= $attestation['icon'] ?>"></i></div>-->
                              <!--        <?= $attestation['title'] ?>-->
                              <!--   </a>-->
                            <?php } ?>
<?php if($lvl > 11 && $lvl!= 19  && $lvl != 14){ ?>
                              <a class="nav-link collapsed" href="<?= $etude_dossier['option2_link'] ?>" aria-expanded="false"
                                     aria-controls="pagesCollapseError" style="color: white">
                                      <div class="sb-nav-link-icon" style="color: white"><i class="<?= $etude_dossier['icon'] ?>"></i></div>
                                      <?= $etude_dossier['title'] ?>
                                  </a>
<?php } ?>

                                 
                         <?php } ?>
                         
                         
                    <?php if(($lvl > 10 && $lvl != 12) || $agreed==0 || $etat_contisation_final=='OK'){ 
                   
                    ?>
                      
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages6"
                             aria-expanded="false" aria-controls="collapsePages" style="color: white">
                              <div class="sb-nav-link-icon" style="color: white"><i class="<?= $demande_entreprise['icon'] ?>"></i></div>
                              <?= $demande_entreprise['title'] ?>
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                         
                          
                          <div class="collapse" id="collapsePages6" aria-labelledby="headingOne"
                               data-parent="#sidenavAccordion">
                              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                
                                 
                            <a class="nav-link collapsed" href="<?= $demande_entreprise_nonpayer['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $demande_entreprise_nonpayer['icon'] ?>"></i></div>
                                <?= $demande_entreprise_nonpayer['title'] ?>
                            </a>
                             
                           
                            
                            <a class="nav-link collapsed" href="<?= $demande_entreprise_payer['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $demande_entreprise_payer['icon'] ?>"></i></div>
                                <?= $demande_entreprise_payer['title'] ?>
                            </a>
                             <?php if( $lvl == 20 || $lvl == 13 || $lvl == 14 || $lvl == 15){ ?>
                            <a class="nav-link collapsed" href="<?= $demande_entreprise_statut_initied['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $demande_entreprise_statut_initied['icon'] ?>"></i></div>
                                <?= $demande_entreprise_statut_initied['title'] ?>
                            </a>
                             <?php } ?>
                            
                              </nav>
                         </div>
                        
                    <?php } ?>
                     <?php  
                     if($lvl!=15 && $lvl != 14){ 
                          if($lvl == 13 || $lvl == 11 || $lvl == 20 || $lvl == 19 || $agreed==0 || $etat_contisation_final=='OK'){ ?>
                            <a class="nav-link collapsed" href="<?= $demande_particulier['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $demande_particulier['icon'] ?>"></i></div>
                                <?= $demande_particulier['title'] ?>
                            </a>
                    <?php }
                    }?>
                    <?php if($lvl > 9 || $agreed==0 || $etat_contisation_final=='OK'){ ?>
                         
                             <a class="nav-link collapsed" href="<?= $demande_cachet['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError"style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $demande_cachet['icon'] ?>"></i></div>
                                <?= $demande_cachet['title'] ?>
                            </a>
                          
                            <a class="nav-link collapsed" href="<?= $remboursement['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $remboursement['icon'] ?>"></i></div>
                                <?= $remboursement['title'] ?>
                            </a>
                        
                    <?php } ?>



                    <!--***************Appointment***********************-->


                    <!--***************Ordonnance***********************-->

                    <!---------------********************* REGLEMENT ********************----------------->

                    <!-- <div class="sb-sidenav-menu-heading">Mon Espace</div> -->
                   
                           

                            <!--***************Produits***********************-->

                            

                    <!--  <div class="sb-sidenav-menu-heading">Tresoreries</div> -->

                    <!--*******************************************MENU TRESORERIE****************************************-->


                    <!-- <div class="sb-sidenav-menu-heading">Paramètre</div> -->

                    <!--**************************Config***************************-->
                    
                    
                    <?php if($lvl > 12  && $lvl != 14  && $lvl != 13 && $lvl != 15){ ?>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages7"
                       aria-expanded="false" aria-controls="collapsePages" style="color: white">
                        <div class="sb-nav-link-icon" style="color: white"><i class="<?= $conf['icon'] ?>"></i></div>
                        <?= $conf['title'] ?>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages7" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion" style="color: white">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link" href="<?= $utilisateur['option1_link'] ?>">
                                <div class="sb-nav-link-icon" style="color: white"><i class="fas fa-user"></i></div>
                                <?= $utilisateur['title'] ?>
                            </a>
                        </nav>
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse"
                               data-target="#pagesCollapseError1" aria-expanded="false"
                               aria-controls="pagesCollapseError" style="color: white">
                                <div class="sb-nav-link-icon" style="color: white"><i class="<?= $liste['icon'] ?>"></i></div>
                                <?= $liste['title'] ?>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError1" aria-labelledby="headingOne"
                                 data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                     <a href="<?= $liste['option0_link'] ?>"
                                       class="nav-link" style="color: white"><?= $liste['option0_name'] ?></a>
                                    <a href="<?= $liste['option1_link'] ?>"
                                       class="nav-link" style="color: white"><?= $liste['option1_name'] ?></a>
                                    <a href="<?= $liste['option2_link'] ?>"
                                       class="nav-link" style="color: white"><?= $liste['option2_name'] ?></a>
                                    <a href="<?= $liste['option3_link'] ?>"
                                       class="nav-link" style="color: white"><?= $liste['option3_name'] ?></a>
                                    <a href="<?= $liste['option4_link'] ?>"
                                       class="nav-link" style="color: white"><?= $liste['option4_name'] ?></a>
                                    <a href="<?= $liste['option5_link'] ?>"
                                       class="nav-link" style="color: white"><?= $liste['option5_name'] ?></a>
                                    
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <?php } ?>
                    
                    
                </div>
            </div>

            <div style="background-color: #28a745 !important;" class="sb-sidenav-footer">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-center">- Copyright &copy; 2021 - SYGES</div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
