<?php

/**
 * Plugin Name: CMS2 custom shipping method
 * Description: Custom Shipping Method for WooCommerce
 * Version: 1.0.0
 * Author: Alexander Maktabi
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

/*
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    function cms2_shipping_method() {
        if ( ! class_exists( 'Cms2_Shipping_Method' ) ) {
            class Cms2_Shipping_Method extends WC_Shipping_Method {
                public function __construct() {
                    $this->id                 = 'CMS2';
                    $this->method_title       = 'CMS2 Shipping Method';
                    $this->method_description = 'Custom Shipping Method';

                    // Availability & Countries
                    $this->availability = 'including';
                    $this->countries = array(
                        'SE', // Sweden
                        'US', // Unites States of America
                        'CA', // Canada
                        'DE', // Germany
                        'GB', // United Kingdom
                        'IT',   // Italy
                        'ES', // Spain
                        'HR', // Croatia
                        );

                    $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
                    $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : 'CMS2 Shipping';
                }

                public function calculate_shipping( $package = [] ) {
                    $weight = 0;
                    $cost = 0;
                    $country = $package["destination"]["country"];

                    foreach ( $package['contents'] as $item_id => $values )
                    {
                        $_product = $values['data'];
                        $weight = $weight + $_product->get_weight() * $values['quantity'];
                    }

                    $weight = wc_get_weight( $weight, 'kg' );

                    if( $weight < 1 ) {

                        $cost = 30;

                    } elseif( $weight < 5 ) {

                        $cost = 60;

                    } elseif( $weight < 10 ) {

                        $cost = 100;

                    } elseif( $weight < 20 ) {
                        $cost = 200;
                    } else {
                        $cost = $weight * 10;
                    }

                    $rate = array(
                        'id' => $this->id,
                        'label' => $this->title,
                        'cost' => $cost
                    );

                    $this->add_rate( $rate );

                }
            }
        }
    }

    add_action( 'woocommerce_shipping_init', 'cms2_shipping_method' );

    function add_cms2_shipping_method( $methods ) {
        $methods[] = 'Cms2_Shipping_Method';
        return $methods;
    }

    add_filter( 'woocommerce_shipping_methods', 'add_cms2_shipping_method' );
}
