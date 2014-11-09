<?php

function shadowpage_public_items_shadowpage_gallery($imageType = 'square_thumbnail', $filesShow = false, $item = null)
  {
    
    if (!$item) {
        $item = get_current_record('item');
    }

    $files = $item->Files;
    if (!$files) {
        return '';
    }

    $attrs = array(
        'wrapper' => array('id' => 'item-images'),
        'linkWrapper' => array('class'=>'shadowpage-thumb'),
        'link' => array('rel'=>'shadowbox[gal1]'),
        'image' => array()
    );
    

    $html = '';
    if ($attrs['wrapper'] !== null) {
        $html .= '<div ' . tag_attributes($attrs['wrapper']) . '>';
    }
    foreach ($files as $file) {
        if (($file['mime_type'] != 'text/plain' && 
            $file['mime_type'] !='application/epub+zip' && 
            $file['mime_type'] !='application/zip')){
            if ($attrs['linkWrapper'] !== null) {
                $html .= '<div ' . tag_attributes($attrs['linkWrapper']) . '>';
            }

            $image = file_image($imageType, $attrs['image'], $file);
            if ($filesShow) {
                $html .= link_to($file, 'show', $image, $attrs['link']);
            } else {
                if ($file['mime_type'] !='application/pdf' && $file['mime_type'] !='audio/mpeg' && $file['mime_type'] !='application/mpeg') {
                    $linkAttrs = array('rel'=>'shadowbox[gal1]', 'href' => $file->getWebPath('fullsize'));
                    } else {
                        $linkAttrs = array('href' => $file->getWebPath('original'));
                    }
                }

                $html .= '<a ' . tag_attributes($linkAttrs) . '>' . $image . '</a>';
            

            if ($attrs['linkWrapper'] !== null) {
                $html .= '</div>';
            }
        }
    }
    if ($attrs['wrapper'] !== null) {
        $html .= '</div>';
    }
    return $html;
}

/**p
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

