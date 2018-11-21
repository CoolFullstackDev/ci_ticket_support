<!-- Titlebar
================================================== -->
<section class="page-crumb">
    <div class="container">
        <div class="page-crumb-block">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h1>Settings</h1>
                </div>
                <div class="col-md-6 text-right">
                    <div class="bread">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url() ?>"><i class="pe-7s-home"></i> Home</a></li>
                            <li class="active">Settings</li>
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
                        <li class="col-md-6">
                            <a class="sub-menu-block active" href="<?php echo site_url('dashboard/settings') ?>">
                                <i class="fa fa-cogs"></i>
                                <span>Settings</span>
                            </a>
                        </li>

                        <li class="col-md-6">
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

            <form method="post" class="edit-profile" enctype="multipart/form-data">
                <h3> Update Your Profile</h3>
                <div class="row">
                    <?php if ($success) : ?>
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                Your profile Updated Successfully
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if (validation_errors()) : ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <?php echo validation_errors() ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="firstname">First Name</label>
                        <input class="form-control" type="text" name="firstname" value="<?php echo set_value('firstname', $item->firstname) ?>" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">Last Name</label>
                        <input class="form-control" type="text" name="lastname" value="<?php echo set_value('lastname', $item->lastname) ?>" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username">Username </label>
                        <input class="form-control" type="text" name="username" value="<?php echo set_value('username', $item->username) ?>" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email"> Email</label>
                        <input class="form-control" type="email" name="email" value="<?php echo set_value('email', $item->email) ?>" disabled="">
                    </div>
                    <div class="selectform-group col-md-6">
                        <label for="country">Select Country</label>
                        <?php echo form_dropdown('country_id', $countries, set_value('country_id', $item->country_id), 'data-placeholder="Choose Country" class="form-control"') ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password"> Password</label>
                        <input class="form-control" type="password" name="password" >
                    </div> 
                    <div class="form-group col-md-6">
                        <label  class="form-control upload-btn">
                            <i class="fa fa-upload"></i> Upload Profile Image
                            <input type="file" name="image">
                            <?php if ($item->image): ?>
                                <img src="<?php echo site_url() ?>/cdn/users/<?php echo $item->image ?>" class="img-upload"/>
                            <?php endif ?>
                        </label>
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="gender"> Gender</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="radio" value="male" name="gender"
                                       <?php if (set_value('gender', $item->gender) == 'male'): ?>checked="checked"<?php endif; ?>>Male
                            </div>
                            <div class="col-sm-6">
                                <input type="radio" value="female" name="gender"
                                       <?php if (set_value('female', $item->gender) == 'female'): ?>checked="checked"<?php endif; ?>>Female
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="submit" class="button" value="Save">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
