<!-- Titlebar
================================================== -->
<section class="page-crumb">
    <div class="container">
        <div class="page-crumb-block">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h1>Contact US</h1>
                </div>
                <div class="col-md-6 text-right">
                    <div class="bread">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url() ?>"><i class="pe-7s-home"></i> Home</a></li>
                            <li class="active">Contact Us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<section class="footer_contact_with_us_area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="heading_text">
                    <h2>Contact With Us</h2>
                    <div class="line-shape"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="about_box_plus_text">
                    <h2>About WeHelp</h2>
                    <p><?php echo config('description') ?></p>
                </div>
                <div class="email_us_text">
                    <h2>Email Us</h2>
                    <p><?php echo config('webmaster_email') ?></p>
                </div>
                <div class="office_1">
                    <h2>Phone</h2>
                    <p><?php echo config('phone') ?></p>
                </div>
                <div class="office_2">
                    <h2>Our Office</h2>
                    <p><?php echo config('address') ?></p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="leave_message_text">
                    <h2>LEAVE A MESSAGE</h2>
                </div>

                <div class="contact_from">
                    <form action="<?php echo site_url('home/contact') ?>" method="post" id="main_contact_form" autocomplete="off">
                        <div class="contact_input_area">
                            <div id="success_fail_info"></div>
                            <div class="row">
                                <?php if ($success) : ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-success">
                                            <i class="fa fa-check-circle" style="margin-left: 7px;"></i>  
                                            Your Message Sent Successfully.
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (validation_errors()) : ?>
                                    <div class="col-md-12">
                                        <div class="notification error closeable">
                                            <i class="fa fa-times-circle" style="margin-left: 7px;"></i> 
                                            <?php echo validation_errors() ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Your E-mail" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject *" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Your Message *" required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn submit-btn">Send Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
