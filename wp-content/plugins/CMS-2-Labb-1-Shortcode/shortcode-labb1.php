<?php
/* Plugin Name: CMS 2 Labb 1 Shortcode
   Author: Alexander Maktabi
   Version: 1.00
   Description: A plugin that prints out a linked button.
*/
 class Cms2Shortcode {
  public function __construct()
  {
    add_action('wp_enqueue_scripts', array($this, 'buttonStyle'));
    add_shortcode( 'button', array( $this, 'btnShortcode' ) );
  }

  // Callback function to register & enqueue style
  public function buttonStyle()
  {
    wp_register_style('defaultStyle', plugin_dir_url( __FILE__ ) . '/assets/style.css');
    wp_enqueue_style('defaultStyle');
  }

  // Callback function that handles the shortcode
  public function btnShortcode($atts)
  {
    // Return if no attribut is given
    if(empty($atts)) {
      return;
    }

    // Set default values
     $btnAtts = shortcode_atts( array(
  		'text' => 'Knapp',
  		'background' => '',
      'url' => '#',
      'width' => '',
      'style' => ''
	  ), $atts );

    // The HTML output
    ob_start(); ?>
    <form action="<?= $btnAtts['url'];?>">
      <button type="submit" id="cmsButton" style="<?= $btnAtts['width'] ? 'width:' . $btnAtts['width'] .'px;' : '' ?>">
        <?= $btnAtts['text'];?>
      </button>
    </form>
    <?php if($btnAtts['background']) :?>
      <style media="screen">
        #cmsButton {
          background-color: <?= $btnAtts['background']; ?>;
        }
      </style>
    <?php endif; ?>

    <?php if($btnAtts['style']) : ?>
      <style media="screen">
        #cmsButton {
          <?= $btnAtts['style']; ?>
        }
      </style>
    <?php endif; ?>

    <?php
    $output = ob_get_clean();
    return $output;
  }
 }

 new Cms2Shortcode();
