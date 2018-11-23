<div style="color: #333; width: 60%; margin: auto; border: 1px solid #dedede; font-size: 16px;font-family: sans-serif;">
    <div style="text-align:center; margin-bottom: 15px; background-color: #f9f9f9; padding: 15px 0;">
        <a href="<?= site_url() ?>">
            <img src="<?php echo site_url() ?>/cdn/about/<?php echo config('logo') ?>" style="height: 80px;">
        </a>
    </div>
    <div style="padding-bottom: 15px; margin-bottom: 15px; padding: 20px;text-align: center;">
        <h3> Hi, <b><?php echo $kkk->username ?></b></h3>
        <p style="line-height: 28px;">
            There is a new reply from our support on your ticket  <a href="<?= site_url('dashboard/ticket/' . $kkk->ticket_id) ?>">#<?php echo $kkk->ticket_id ?>: <?php echo $kkk->subject ?></a><br>
            You can check your ticket any time from by clicking the link below
            <br><br>
            <b>Thanks You!</b>
            <br>
        </p>
        <a href="<?= site_url('dashboard/ticket/' . $kkk->ticket_id) ?>" style="text-decoration: none; background-color: #f2435a;padding: 10px;margin: 10px;display: inline-block;color: #fff; border-radius: 2px;">Check Your Ticket Now</a>
    </div>
    <div style="text-align: center; border-top: 2px solid #f2435a;padding: 25px 0;background-color: #f9f9f9;">
        <a style="display: inline-block;"><b>Email:</b> <?php echo config('webmaster_email') ?></a> | <span style="display: inline-block;"><b>Phone:</b> <?php echo config('phone') ?></span>
    </div>
    <div style="background-color:#f2435a; color: #fff; text-align: center;">
        <p style="margin: 0;padding: 10px 0;"> Copyright © <?php echo config('title') ?> <?php echo date('Y'); ?>  </p>
    </div>
</div>
