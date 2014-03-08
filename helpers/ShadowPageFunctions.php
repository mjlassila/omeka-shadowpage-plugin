<?php

function shadowpage_public_items_shadowpage_gallery()
  {
    
    $url = $_SERVER['HTTP_HOST'];
    $basePath = 'http://' . $url . PUBLIC_BASE_URL;
    $item = get_current_record('item');
    $item = get_record_by_id('item', $item->id);
    set_current_record('item', $item);
    $files = $item->Files;
    echo '<div id="itemfiles" class="element">';
    $fr_link_string = array();
    foreach($files as $file):
      if (metadata($item, 'has thumbnail') && ($file['mime_type'] != 'text/plain' && $file['mime_type'] !='application/epub+zip' && $file['mime_type'] !='application/zip')){
        echo '<div class="shadowpage-thumb">'.file_markup($file, array('linkAttributes'=>array('rel'=>'shadowbox[gal1]'))).'</div>';
        $fr_link_string[] = '<div class="download-full-res"><a href="'. $basePath . '/files/original/'.$file['filename'].'" title="Download ' . $file['original_filename'] . '">' . $file['original_filename'] . '</a></div>';
      }
    endforeach;
 
    echo '</div>';
  }

/**
 * Return HTML for all files assigned to an item.
 * 
 * @package Omeka\Function\View\Item
 * @uses file_markup()
 * @param array $options
 * @param array $wrapperAttributes
 * @param Item|null $item Check for this specific item record (current item if null).
 * @return string HTML
 */
function shadowpage_files_for_item($options = array(), $wrapperAttributes = array('class'=>'item-file'), $item = null)
{
    if (!$item) {
        $item = get_current_record('item');
    }
    return file_markup($item->Files, $options, $wrapperAttributes);
}

