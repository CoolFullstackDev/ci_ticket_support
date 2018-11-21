<div style="color: #333;">
    <div style="text-align:center; margin-bottom: 15px;">
        <a href="http://elmanawy.info">
            <img src="<?= STYLE_IMAGES ?>/logo.png">
        </a>
    </div>
    <br><br>

    <br>

    <div style="padding-bottom: 15px; border-bottom: 2px solid #fcb040; margin-bottom: 15px;">
        <p>
             <span style="font-weight: bold;"> Hi <?php echo $users->username ?>,</span><br>
             <span>Welcome to <?php echo config('title') ?>!</span>
            <br>

            <span>
                Please take a second to confirm <?php echo $users->email ?> as your email address by clicking the link below:
            </span> <br><br>

            <a href="<?= site_url('registration/verify/' . $users->user_id . '/' . $users->code) ?>">Verify</a>
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
        <p style="line-height: 30px;"> Copyright © 2017 </p>
    </div>
</div>


