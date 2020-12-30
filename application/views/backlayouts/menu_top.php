<nav class="navbar navbar-header navbar-expand-lg" data-background-color="white">  
    <div class="container-fluid">
        
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            
         
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <!-- <div class="avatar-sm">
                        <img src="<?php echo base_url();?>assets/theme/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                    </div> -->
                    <h4><?php echo $this->userData->full_name; ?></h4>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <!-- <div class="avatar-lg"><img src="<?php echo base_url();?>assets/theme/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div> -->
                                <div class="u-text">
                                    <h4><?php echo $this->userData->full_name; ?></h4>
                                    <p class="text-muted"><?php echo $this->userData->level; ?></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo site_url("admin/users") ?>">My Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo site_url("admin/login/logout");?>">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>