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
                            <li class="active">My Tickets</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success pull-right att-ticket" onclick="window.location = '<?php echo site_url('dashboard/ticket') ?>'">
                <i class="fa fa-plus"></i> New Ticket
            </button>
        </div>
        <section class="content">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-filter" data-filter="all">All</button>
                                <button type="button" class="btn btn-warning btn-filter" data-filter="important">Important</button>
                                <button type="button" class="btn btn-success btn-filter" data-filter="open">Open</button>
                                <button type="button" class="btn btn-danger btn-filter" data-filter="closed">Closed</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                    <tr class="filter <?php echo $item->status ?> <?php if ($item->important == '1'): ?>important<?php endif ?>">
                                            <td>
                                                <?php if ($item->important == '0'): ?>
                                                    <a href="<?php echo site_url('dashboard/important/' . $item->ticket_id); ?>">
                                                    <?php else: ?>
                                                        <a href="<?php echo site_url('dashboard/un_important/' . $item->ticket_id); ?>" class="star-ticket">
                                                        <?php endif ?>
                                                        <i class="fa fa-star"></i> #<?php echo $item->ticket_id ?>
                                                    </a>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <a href="<?php echo site_url('dashboard/ticket/' . $item->ticket_id) ?>" class="media-body">
                                                        <span class="media-meta pull-right"><?php echo $item->created ?></span>
                                                        <h4 class="title">
                                                            <?php echo $item->subject ?>
                                                            <span class="pull-right ticket_<?php echo $item->status ?>"><?php echo $item->status ?></span>
                                                            <span class="pull-right dep-title"><b>Department:</b> <?php echo $item->category ?></span>
                                                        </h4>
                                                        <p class="summary"><?php if (strlen($item->message) > 35): ?> <?php echo substr($item->message, 0, 50) . ".."; ?> <?php else: ?> <?php echo $item->message; ?> <?php endif ?></p>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    <?php if (!$items): ?>
                                        <tr>
                                            <td colspan="6" class="textcenter">No Records Found</td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
</div>