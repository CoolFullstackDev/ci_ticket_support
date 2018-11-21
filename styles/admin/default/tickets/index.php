
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
                <strong>Tickets</strong>
            </li>
        </ol>

    </div>

</div>

<!-- Admin Table-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Tickets</h3>
        <div class="panel-options">
        </div>
    </div>
    <div class="panel-body">

        <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">
            <table cellspacing="0" class="table table-small-font table-bordered table-striped" >
                <thead>
                    <tr>

                        <th>Ticket </th>
                        <th>Department </th>
                        <th>Sent By</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Last Reply</th>
                        <th>Operations</th>
                    </tr>
                </thead>

                <tbody class="middle-align">
                    <?php foreach ($items as $item): ?>
                        <tr id="<?php echo $item->ticket_id ?>">
                            <td>#<?php echo $item->ticket_id ?>: <?php echo $item->subject ?></td>
                            <td><?php echo $item->category ?></td>
                            <td><?php echo $item->username ?> </td>
                            <td><?php echo $item->status ?></td>
                            <td><?php echo $item->created ?></td>
                            <td><?php echo $item->last_reply ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/tickets/manage/' . $item->ticket_id); ?>" class="btn btn-orange btn-sm">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                    Reply
                                </a>
                                <a class="btn btn-danger btn-sm remove">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php echo $pagination ?>
    </div>
</div>

<script type="text/javascript">
    $(".remove").click(function () {
        var id = $(this).parents("tr").attr("id");
        if (confirm('Are you sure to remove this record'))
        {
            $.ajax({
                url: '<?php echo site_url() ?>admin/tickets/delete/' + id,
                type: 'DELETE',
                error: function () {
                    alert('Something is wrong');
                },
                success: function (data) {
                    $("#" + id).remove();
                    alert('Record removed successfully');
                }
            });
        }
    });
</script>