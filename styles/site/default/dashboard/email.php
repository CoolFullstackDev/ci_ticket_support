<div style="color: #333;">
    <div style="text-align:center; margin-bottom: 15px;">
        <a href="<?php echo site_url() ?>">
            <img src="<?php echo site_url() ?>/cdn/about/<?php echo config('logo') ?>">
        </a>
    </div>
    <br><br>
    <br>
    <div style="padding-bottom: 15px; border-bottom: 2px solid #fcb040; margin-bottom: 15px;">
        <p>
             <span style="font-weight: bold;"> Hi <?php echo $item->username ?>,</span><br>
             <span>Welcome to <?php echo config('title') ?>!</span>
            <br>

            <span>
               you can check your ticket any time from by clicking the link below:
            </span> <br><br>
            <a href="<?= site_url('dashboard/ticket/' . $item->ticket_id) ?>">#<?php echo $item->ticket_id ?>: <?php echo $item->subject ?></a>
        </p>
        <br>
        <p>Once you do, you'll be able to start buying, selling or writing some comments.</p>
    </div>
    <br>
    <div style="text-align: center; margin-bottom: 20px;">
        <a style="display: inline-block;"><?php echo config('webmaster_email') ?></a> | <span style="display: inline-block;">4303000</span>
    </div>
    <br>

    <div style="background-color:#fcb040; color: #fff; height: 30px; text-align: center;">
        <p style="line-height: 30px;"> Copyright © <?php echo date('Y'); ?> </p>
    </div>
</div>


