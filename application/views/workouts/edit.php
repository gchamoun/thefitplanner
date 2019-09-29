
<?php

    echo form_open(isset($item)?'inventory/edit/'.$item->id:'inventory/add');
    echo form_input(array('type'=>'hidden','name' => 'item_id', 'value' => isset($item)?$item->id:set_value('item_id')));
    echo form_error('category_id');
    echo form_label('Serial (click to edit item)', 'serial') .'<br />';
    echo form_input(array('name' => 'serial', 'value' => isset($item)?$item->serial:set_value('serial'))) .'<br />';
    echo form_error('serial');
    echo form_label('Item Title', 'description') .'<br />';
    echo form_input(array('name' => 'description', 'value'=>isset($item)?$item->description:set_value('description'))) .'<br /><br />';
    echo form_label('Accessories (one accessory per line, blank lines will be ignored)', 'accessories') .'<br />';
    for ($i=0;$i<9;$i++) {
        echo form_input(array('name' => 'accessories[]','value'=>(isset($item) && $item->accessories && $i<count($item->accessories))?$item->accessories[$i]:""));
        echo form_input(array('name' => 'accessories[]','value'=>(isset($item) && $item->accessories && $i<count($item->accessories))?$item->accessories[$i]:"")) .'<br />';
    }
    echo form_submit(array('type' => 'submit', 'value' => isset($item)?'Save':'Add'));
    echo '<br /><br />';
    echo form_submit(array('type' => 'button', 'value' => 'Back to Dashboard', 'onClick' => "window.location.href='http://localhost:8080/jmcinventory/users/dashboard'"));
    echo form_close();
