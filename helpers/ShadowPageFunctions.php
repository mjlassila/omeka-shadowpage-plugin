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
      if (metadata($item, 'has thumbnail')){
        echo '<div class="shadowpage-thumb">'.file_markup($file, array('linkAttributes'=>array('rel'=>'shadowbox[gal1]'))).'</div>';
        $fr_link_string[] = '<div class="download-full-res"><a href="'. $basePath . '/files/original/'.$file['filename'].'" title="Download ' . $file['original_filename'] . '">' . $file['original_filename'] . '</a></div>';
      }
    endforeach;
 
    echo '</div>';
    echo '<h3>&darr;'.__('File Download Links').'&darr;</h3>';
    foreach($fr_link_string as $links):
      echo $links;
    endforeach;
  
  
  
  }