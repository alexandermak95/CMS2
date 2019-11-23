<?php
/*
Plugin Name: CMS2-Custon checkout field
Author: Alexander Maktabi
Version: 1.0.0
Description: A plugin to add a custon checkout field for gift bags and gift cards
*/

Class CustomCheckout {
  public function __construct() {
    add_action( 'woocommerce_after_order_notes', array($this, 'gift_bag') );
    add_action( 'woocommerce_checkout_update_order_meta', array($this,'my_custom_checkout_field_update_order_meta' ) );
    add_action( 'woocommerce_admin_order_data_after_billing_address', array($this,'my_custom_checkout_field_display_admin_order_meta' ), 10, 1 );
  }


  /**
   * Add the fields to the checkout
   */

  public function gift_bag($checkout) {
    echo '<div id="gift-bag"><p>' . __('Ska paketet slås in i presentpapper? ') . '</p>';

    woocommerce_form_field( 'gift-bag-check', array(
        'type'          => 'checkbox',
        'value'         => 'Ja',
        'class'         => array('gift-bag-check'),
        'label'         => __('Ja'),
      ), $checkout->get_value( 'gift-bag-check' ));


    woocommerce_form_field( 'gift-bag-check-card', array(
        'type'          => 'textarea',
        'class'         => array('gift-bag-check-card'),
        'label'         => __('Meddelande till mottagaren'),
      ), $checkout->get_value( 'gift-bag-check-card' ));

    echo '</div>';
    ?>
    <!-- Show textarea only if checkboxed is filled -->
    <script type="text/javascript">
      jQuery('#gift-bag-check-card').hide()
      jQuery('.gift-bag-check-card').hide()
      jQuery('#gift-bag-check').change(function(){
         if (this.checked) {
            jQuery('#gift-bag-check-card').fadeIn();
            jQuery('.gift-bag-check-card').fadeIn();
         } else {
            jQuery('#gift-bag-check-card').fadeOut();
            jQuery('.gift-bag-check-card').fadeOut();
         }
      });
   </script>
   <?php
  }
    /**
    * Update the order meta with field value
     */

    public function my_custom_checkout_field_update_order_meta( $order_id ) {
        if ( ! empty( $_POST['gift-bag-check'] ) ) {
            update_post_meta( $order_id, 'gift-bag',  $_POST['gift-bag-check'] ? 'Ja' : 'Nej'  );
        }
        if ( ! empty( $_POST['gift-bag-check-card'] ) ) {
            update_post_meta( $order_id, 'gift-bag-msg',  $_POST['gift-bag-check-card']  );
        }
    }

    /**
   * Display field value on the order edit page
   */

  public function my_custom_checkout_field_display_admin_order_meta($order){
      echo '<p><strong>'.__('Slå beställningen i paket').':</strong> ' . get_post_meta( $order->get_id(), 'gift-bag', true ) . '</p>';
      echo '<p><strong>'.__('Meddelande till mottagaren').':</strong> ' . get_post_meta( $order->get_id(), 'gift-bag-msg', true ) . '</p>';
  }
}

new CustomCheckout();
