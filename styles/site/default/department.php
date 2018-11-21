<!-- Titlebar
================================================== -->
<section class="page-crumb">
    <div class="container">
        <div class="page-crumb-block">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h1>My Tickets</h1>
                </div>
                <div class="col-md-6 text-right">
                    <div class="bread">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url() ?>"><i class="pe-7s-home"></i> Home</a></li>
                            <li class="active"><?php echo $cat->title ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<section class="frequently_asked_question section_padding_100 clearfix cat-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-center">
                <!-- Heading Text  -->
                <div class="heading_text text-left">
                    <h2><?php echo $cat->title ?></h2>
                    <p><?php echo $cat->description ?></p>
                    <div class="line-shape"></div>
                </div>
            </div>
            <div class="col-md-4">
                <form class="search search-full" action="<?php echo site_url('home/search') ?>" method="get">
                    <input class="form-control" type="search" placeholder="ex.: Installation" name="question" value="<?php echo set_value('question') ?>">
                </form>
            </div>
            <?php foreach ($faqs as $faq): ?>
                <div class="col-md-6">
                    <a href="<?php echo site_url('topic/' . $faq->faq_id . '-' . permalink($faq->question)) ?>" class="single_faq">
                        <h5><i class="pe-7s-comment"></i><?php echo $faq->question ?></h5>
                    </a>
                </div>
            <?php endforeach; ?>


        </div>
        <div class="row">
            <div class="pagination-container">
                <ul class="pagination">
                    <?php echo $pagination ?>
                </ul>
            </div>
        </div>
    </diV>
</section>
<section class="still_have_a_question section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="ask_a_Question_icon">
                    <i class=" pe-7s-help2"></i>
                </div>
                <div class="still_hq_heading">
                    <h2>Still no luck? We can help!</h2>
                    <p>Boxplus is your business place. You can start any business with boxplus <br>easily &amp; get more profit</p>
                </div>
                <div class="ask_a_Question_button">
                    <?php if (!(user())): ?>
                        <a class="alert-login"><i class="fa fa-ticket"></i> Submit a Question</a>
                    <?php else: ?>
                        <a href="<?php echo site_url('dashboard/tickets') ?>"><i class="fa fa-ticket"></i> Submit a Question</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
