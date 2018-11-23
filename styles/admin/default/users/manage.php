<div class="page-title">

    <div class="breadcrumb-env">
        <ul class="user-info-menu left-links list-inline list-unstyled">
            <li class="hidden-sm hidden-xs">
                <a href="#" data-toggle="sidebar">
                    <i class="fa-bars"></i>
                </a>
            </li>
        </ul>
        <ol class="breadcrumb bc-1" >
            <li>
                <a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa-home"></i> Home</a>
            </li>
            <li class="active">
                <strong>User </strong>
            </li>
        </ol>

    </div>

</div>
<!-- Admin Table-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">User</h3>
    </div>
    <div class="panel-body">
        <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <?php echo validation_errors() ?>
                </div>
            </div>
        <?php endif ?>
        <form role="form" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">User Group <span class="required">*</span></label>
                <div class="col-sm-10">
                    <?php echo form_dropdown('usergroup_id', dd2menu('usergroups', array('usergroup_id' => 'title')), set_value('usergroup_id', $item->usergroup_id ? $item->usergroup_id : '63'), 'class="form-control s2example-1"') ?>
                </div>
            </div>
            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-1">User Name <span class="required">*</span></label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="User Name" name="username"
                           value="<?php echo set_value('username', $item->username) ?>">
                </div>
            </div>
            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-1">First Name</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="First Name" name="firstname"
                           value="<?php echo set_value('firstname', $item->firstname) ?>">
                </div>
            </div>
            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-1">Last Name</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Last Name" name="lastname"
                           value="<?php echo set_value('lastname', $item->lastname) ?>">
                </div>
            </div>
            <div class="form-group-separator"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-1">Email <span class="required">*</span></label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Email" name="email"
                           value="<?php echo set_value('email', $item->email) ?>">
                </div>
            </div>
            <div class="form-group-separator"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Country <span class="required">*</span></label>
                <div class="col-sm-10">
                    <?php echo form_dropdown('country_id', dd2menu('countries', array('country_id' => 'name')), set_value('country_id', $item->country_id ? $item->country_id : '63'), 'class="form-control s2example-1"') ?>
                </div>
            </div>
            <div class="form-group-separator"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-1">Image <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input class="form-control" type="file" name="image" >
                </div>
                <div class="col-sm-2">
                    <?php if ($item->image): ?>
                        <img src="<?php echo site_url() ?>/cdn/users/<?php echo $item->image ?>" class="img-inline userpic-32" width="40"/>
                    <?php else: ?>
                        <img src="<?php echo base_url() ?>/cdn/users/default.png" class="img-inline userpic-32" width="40">
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group-separator"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-1">Password <span class="required">*</span></label>

                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Password" name="password"
                           value="<?php echo set_value('password') ?>">
                </div>
            </div>
            <div class="form-group-separator"></div>
           
            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-1"> Gender</label>

                <div class="compose-message-editor col-sm-10">
                    <input type="radio" value="male" name="gender"
                           <?php if (set_value('gender', $item->gender) == 'male'): ?>checked="checked"<?php endif; ?>>
                    Male<br/>
                    <input type="radio" value="female" name="gender"
                           <?php if (set_value('gender', $item->gender) == 'female'): ?>checked="checked"<?php endif; ?>> Female
                </div>
            </div>
            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-1"> User Status</label>

                <div class="compose-message-editor col-sm-10">
                    <input type="radio" value="active" name="status"
                           <?php if (set_value('status', $item->status) == 'active'): ?>checked="checked"<?php endif; ?>>
                    Active User<br/>
                    <input type="radio" value="inactive" name="status"
                           <?php if (set_value('status', $item->status) == 'inactive'): ?>checked="checked"<?php endif; ?>> in-active User
                </div>
            </div>
            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>

                <div class="col-sm-10">
                    <input type="submit" class="btn btn-secondary " name="submit" value="Submit">
                    <a href="<?php echo site_url('admin/users/admins'); ?>" class="btn btn-danger">Cancel</a>

                </div>
            </div>


        </form>

    </div>
</div>

