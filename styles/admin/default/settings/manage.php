
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
                <strong>Setting and SEO </strong>
            </li>
        </ol>

    </div>

</div>

<div class="">
    <div class="panel-heading">
        <h3 class="panel-title"> Setting and SEO</h3>
    </div>
    <div class="panel-body">

        <div class="row">
            <?php echo form_open_multipart(false, 'class="form-horizontal" data-validate="parsley"') ?>
            <?php if (validation_errors()): ?>
                <div class="error"><?php echo validation_errors() ?></div>
            <?php endif ?> 

            <div class="col-md-12">

                <ul class="nav nav-tabs nav-tabs-justified">
                    <li class="active">
                        <a href="#setting" data-toggle="tab">
                            <span class="visible-xs"><i class="fa-home"></i></span>
                            <span class="hidden-xs">Setting</span>
                        </a>
                    </li>
                    <li>
                        <a href="#seo" data-toggle="tab">
                            <span class="visible-xs"><i class="fa-user"></i></span>
                            <span class="hidden-xs">SEO</span>
                        </a>
                    </li>
                    <li>
                        <a href="#contactinfo" data-toggle="tab">
                            <span class="visible-xs"><i class="fa-envelope-o"></i></span>
                            <span class="hidden-xs">Contact Info</span>
                        </a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="setting">

                        <div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo lang('settings_title') ?></label>
                                <div class="col-sm-10">
                                    <?php echo form_input('setting[title]', set_value('setting[title]', $item->title), 'class="bg-focus form-control" data-required="true" id="title"') ?>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Website Logo</label>
                                <div class="compose-message-editor col-sm-8">
                                    <input type="file" class="form-control" name="logo">
                                </div>

                                <div class="col-sm-2">
                                    <?php if (config('logo')): ?>
                                        <img src="<?php echo site_url() ?>/cdn/about/<?php echo config('logo') ?>" class="img-inline userpic-32" width="40"/>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Website Favicon </label>
                                <div class="compose-message-editor col-sm-8">
                                    <input type="file" class="form-control" name="favicon">
                                </div>
                                <div class="col-sm-2">
                                    <?php if (config('favicon')): ?>
                                        <img src="<?php echo site_url() ?>/cdn/about/<?php echo config('favicon') ?>" class="img-inline userpic-32" width="40"/>
                                    <?php endif ?>
                                </div>

                            </div>
                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Time Zone</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('setting[default_timezone]', set_value('setting[default_timezone]', $item->default_timezone), 'class="bg-focus form-control" data-required="true" id="default_timezone"') ?>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Copyright</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('setting[copyright]', set_value('setting[copyright]', $item->copyright), 'class="bg-focus form-control" data-required="true" id="copyright"') ?>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="compose-message-editor col-sm-10">
                                    <textarea style="height: 150px;" class="form-control" name="setting[description]"><?php echo set_value('setting[description]', $item->description) ?></textarea>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

                        </div>

                    </div>
                    <div class="tab-pane" id="seo">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Meta Keywords</label>
                            <div class="compose-message-editor col-sm-10">
                                <textarea style="height: 100px;" class="form-control" name="setting[meta_keywords]"><?php echo set_value('setting[meta_keywords]', $item->meta_keywords) ?></textarea>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Meta Description</label>
                            <div class="compose-message-editor col-sm-10">
                                <textarea style="height: 150px;" class="form-control" name="setting[meta_description]"><?php echo set_value('setting[meta_description]', $item->meta_description) ?></textarea>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>


                    </div>
                    <div class="tab-pane" id="contactinfo">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Webmaster Email</label>
                            <div class="col-sm-10">
                                <?php echo form_input('setting[webmaster_email]', set_value('setting[webmaster_email]', $item->webmaster_email), 'class="bg-focus form-control" data-required="true" id="webmaster_email"') ?>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <?php echo form_input('setting[phone]', set_value('setting[phone]', $item->phone), 'class="bg-focus form-control" data-required="true" id="phone"') ?>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Support Call</label>
                            <div class="col-sm-10">
                                <?php echo form_input('setting[support]', set_value('setting[support]', $item->support), 'class="bg-focus form-control" data-required="true" id="support"') ?>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-1"> Facebook Account</label>

                            <div class="col-sm-10">
                                <?php echo form_input('setting[facebook]', set_value('setting[facebook]', $item->facebook), 'class="bg-focus form-control" data-required="true" id="facebook"') ?>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-1"> Instagram Account</label>

                            <div class="col-sm-10">
                                <?php echo form_input('setting[instagram]', set_value('setting[instagram]', $item->instagram), 'class="bg-focus form-control" data-required="true" id="instagram"') ?>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-1"> Google Plus Account</label>

                            <div class="col-sm-10">
                                <?php echo form_input('setting[google_plus]', set_value('setting[google_plus]', $item->google_plus), 'class="bg-focus form-control" data-required="true" id="google_plus"') ?>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-1"> Twitter Account</label>

                            <div class="col-sm-10">
                                <?php echo form_input('setting[twitter]', set_value('setting[twitter]', $item->twitter), 'class="bg-focus form-control" data-required="true" id="twitter"') ?>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-secondary " name="submit" value="Submit">
                            <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

