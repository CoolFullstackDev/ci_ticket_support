<?php

function ads($location = 0) {
    $ins = &get_instance();
    
    $item = $ins->db
            ->where('ad_location_id', $location)
            ->order_by('ad_id', 'random')
            ->get('ads', 1)
            ->row();
    
    if(! $item)
        return;
    
    if($item->type == 'code')
    {
        echo $item->code;
    }
    
    elseif($item->type == 'image')
    {
        echo "<a href='".$item->link."'><img src='". $item->image."' /></a>";
    }
}



























