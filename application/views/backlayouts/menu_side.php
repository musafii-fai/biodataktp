<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="white">
    
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <!-- <div class="avatar-sm float-left mr-2">
                    <img src="<?php echo base_url();?>assets/theme/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div> -->
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php echo $this->userData->full_name; ?>
                            <span class="user-level"><?php echo $this->userData->level; ?></span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="<?php echo site_url("admin/users"); ?>">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                
                            </li>
                            <li>
                                <a href="<?php echo site_url("admin/login/logout");?>">
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php 
                $className = $this->router->fetch_class();
            ?>
            <ul class="nav nav-primary">
                <li class="nav-item <?php echo $className == "dashboard" ? "active" : "";?>">
                    <a href="<?php echo site_url('admin'); ?>">
                        <i class="fab fa-flipboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item <?php echo $className == "ktp" ? "active" : "";?>">
                    <a href="<?php echo site_url("admin/ktp");?>">
                        <i class="fas fa-users"></i>
                        <p>Data KTP</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Laporan</h4>
                </li>
                <li class="nav-item <?php echo $className == "laporan" ? "active" : "";?>">
                    <a href="<?php echo site_url("admin/laporan"); ?>">
                        <i class="fas fa-file"></i>
                        <p>Laporan Data KTP</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Settings</h4>
                </li>
                <li class="nav-item <?php echo $className == "users" ? "active" : "";?>">
                    <a href="<?php echo site_url("admin/users"); ?>">
                        <i class="fas fa-users-cog"></i>
                        <p>Pengguna Admin</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>