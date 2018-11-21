<!-- Titlebar
================================================== -->
<section class="page-crumb">
    <div class="container">
        <div class="page-crumb-block">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-md-6 text-right">
                    <div class="bread">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url() ?>"><i class="pe-7s-home"></i> Home</a></li>
                            <li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Content
================================================== -->
<div class="container">
    <!-- Sidebar
   ================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="user-box">
                <div class="user-avatar">
                    <figure>
                        <?php if ($item->image): ?>
                            <img src="<?php echo base_url() ?>/cdn/users/<?php echo $item->image ?>" alt="<?php echo $item->username ?>">
                        <?php else: ?>
                            <img src="<?php echo base_url() ?>/cdn/users/default.png" alt="<?php echo $item->username ?>">
                        <?php endif ?>
                    </figure>
                    <div class="usercontent">
                        <h3><?php echo $item->username ?></h3>
                    </div>
                </div>
                <nav class="navdashboard">
                    <ul class="row">
                        <li class="col-md-4">
                            <a class="sub-menu-block active" href="<?php echo site_url('dashboard') ?>">
                                <i class="fa fa-dashboard"></i>
                                <span> Dashboard</span>
                            </a>
                        </li>
                        <li class="col-md-4">
                            <a class="sub-menu-block" href="<?php echo site_url('dashboard/settings') ?>">
                                <i class="fa fa-cogs"></i>
                                <span>Settings</span>
                            </a>
                        </li>

                        <li class="col-md-4">
                            <a class="sub-menu-block" href="<?php echo site_url('dashboard/tickets') ?>">
                                <i class="fa fa-ticket"></i>
                                <span>My Tickets</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-12">

          here!!!!

        </div>
    </div>
</div>
