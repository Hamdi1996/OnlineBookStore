<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">

                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">LMS</div>
                            <a class="nav-link" href="../index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                          <div class="sb-sidenav-menu-heading">MODULES</div>
                          
                          <?php
                             $classes =["fas fa-users-cog","fas fa-users-cog","fas fa-user-plus","fas fa-book-reader"]  ; 
                            $modules = ['AdminRoles','Admins','Books','Category','Authors','UsersOrders','Contactus'];
                            $i = 0;

                          foreach ($modules as $key => $value) {
                            if($i == 4){
                                $i = 0;
                              }
                          ?>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts<?php echo $key;?>" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="<?php echo $classes[$i];?>"></i></div>
                                <?php echo $value;?>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseLayouts<?php echo $key;?>" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <?php if($modules[$key]=="Contactus" || $modules[$key]=="UsersOrders") {echo "";}else {?>
                                    <a class="nav-link" href="<?php echo url($value.'/create.php');?>"><i class="fas fa-user-plus"></i> Add </a><?php }?>
                                    <a class="nav-link" href="<?php echo url($value.'/');?>"><i class="fab fa-gg-circle nav-icon"></i>Display</a>
                                </nav>
                            </div>
                            <?php $i++;}?>

                        </div>

                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        
                    </div>
                </nav>
            </div>