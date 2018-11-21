<!-- Titlebar
================================================== -->
<section class="page-crumb">
    <div class="container">
        <div class="page-crumb-block">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h1>Knowledge Base</h1>
                </div>
                <div class="col-md-6 text-right">
                    <div class="bread">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url() ?>"><i class="pe-7s-home"></i> Home</a></li>
                            <li class="active">Knowledge Base</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="home-search clearfix hero">
    <div class="container">
        <div class="hero-inner">
            <h1 class="help-center-name">How can we help?</h1>
            <form class="search search-full" action="<?php echo site_url('home/search') ?>" method="get">
                <input class="form-control" type="search" placeholder="ex.: Installation" name="question" value="<?php echo set_value('question') ?>">
            </form>
        </div>
    </div>
</section>
<section class="frequently_asked_question section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <!-- Heading Text  -->
                <div class="heading_text">
                    <h2>Select a Department</h2>
                    <p>Do You Want to Know</p>
                    <div class="line-shape"></div>
                </div>
            </div>
        </div>

        <div class="faqs-categories">
            <div class="row">
                <?php foreach ($categories as $item): ?>
                    <div class="col-md-4 text-center">
                        <a href="<?php echo site_url('department/' . $item->category_id . '-' . permalink($item->title)) ?>" class="category-block">
                            <img src="<?php echo base_url() ?>/cdn/icons/<?php echo $item->icon ?>" alt="<?php echo $item->title ?>">
                            <h3><?php echo $item->title ?></h3>
                            <p><?php echo $item->description ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="random-faqs">
            <div class="row">
                <div class="col-12 text-center">
                    <!-- Heading Text  -->
                    <div class="heading_text">
                        <h2>Frequently Asked Question</h2>
                        <p>Do You Want to Know</p>
                        <div class="line-shape"></div>
                    </div>
                </div>

                <?php foreach ($faqs as $item): ?>
                    <div class="col-md-6">
                        <a href="<?php echo site_url('topic/' . $item->faq_id . '-' . permalink($item->question)) ?>" class="single_faq">
                            <h5><i class="pe-7s-comment"></i><?php echo $item->question ?></h5>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        </diV>

    </div>
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
