<?php
// Theming helper functions
if (!defined('SHADOWPAGE_PLUGIN_DIR')) {
    define('SHADOWPAGE_PLUGIN_DIR', dirname(__FILE__));
}

require_once SHADOWPAGE_PLUGIN_DIR . '/helpers/ShadowPageFunctions.php';


class ShadowPagePlugin extends Omeka_Plugin_AbstractPlugin
{ 
  

  protected $_hooks = array(
        'public_head',
        'initialize',
        'public_items_show'
    );
    
  public function hookPublicHead($args)
  {
    
    queue_js_file('shadowbox');
    $script = "Shadowbox.init();";
    queue_js_string($script);
    queue_css_file('shadowbox');
    queue_css_file('shadowpage');
    $css=".download-full-res{
    float: left;
    clear:left;
    }";
  
    queue_css_string($css);
  }

  /**
  * Add the translations.
  */
  public function hookInitialize()
  {
        add_translation_source(dirname(__FILE__) . '/languages');
  }

public function hookPublicItemsShow($args)
    {
        $item = $args['item'];
        $uri = absolute_url(array('controller'=>'items', 'action'=>'embed', 'id'=>$item->id), 'id');
        $files = $item->Files;
        $fr_link_string = array();
        foreach($files as $file):
          if ($file['mime_type'] == 'text/plain' || $file['mime_type'] =='application/epub+zip' || $file['mime_type'] =='application/zip'){
           $fr_link_string[] = '<p><a href="'. $basePath . '/files/original/'.$file['filename'].'" title="Lataa ' . $file['original_filename'] . '">' . $file['original_filename'] . '</a></p>';
        }
        endforeach;
        echo '<div id="download-files">';
        echo '<h3>'.__('Lataa').'</h3>';
        foreach($fr_link_string as $links):
          echo $links;
        endforeach;
        echo '</div>';
  
 
      
    }
    

}
?>