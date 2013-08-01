<?php

$prefix = 'YOUR_PREFIX_';
global $meta_boxes;
$meta_boxes = array();

$meta_boxes[] = array(
    'id' => 'house',
    'title' => 'Home Info',
    'pages' => array('anim8slides'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'House Model',
            'id' => 'housemodel',
            'type' => 'text',
            ),
        ),    
    );

function YOUR_PREFIX_register_meta_boxes() {
    global $meta_boxes;
    if (class_exists('RW_Meta_Box')) {
        foreach ($meta_boxes as $meta_box) {
            new RW_Meta_Box($meta_box);
        }
    }
}
add_action('admin_init', 'YOUR_PREFIX_register_meta_boxes');