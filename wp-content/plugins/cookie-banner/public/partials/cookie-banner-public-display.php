<?php

/*
		Use acf to display settings
*/

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Cookie banner',
		'menu_title'	=> 'Cookie banner',
		'menu_slug' 	=> 'cookie_banner',
		'capability'	=> 'edit_posts',
        'redirect'		=> false,
        'post_id' => 'cookie_banner',
	));


}

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'content',
        'title' => 'Cookie banner content',
        'fields' => array (
            array (
                'key' => 'Text',
                'label' => 'Text',
                'name' => 'text',
                'type' => 'wysiwyg',
                'media_upload' => 0,
                'tabs' => 'all',
                'toolbar' => 'full',
            ),
            array (
                'key' => 'link',
                'label' => 'Länk',
                'name' => 'link',
                'type' => 'link',
            ),
            array (
                'key' => 'expires',
                'label' => 'Antal dagar',
                'name' => 'expires',
                'type' => 'number',
            )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'cookie_banner',
                ),
            ),
        ),
    ));

    endif;

    function cookie_banner_data(){
        $text = get_field('text', 'cookie_banner');
        $link = get_field('link', 'cookie_banner');
        $expires = get_field('expires', 'cookie_banner');
        $link_title = $link['title'];
        $link_url   = $link['url'];

        $data = array(
            'text'  => $text,
						'days'	=> $expires,
            'link'  => array(
                'link_title'    => $link_title,
                'link_url'      => $link_url,

            )
        );
        echo " <script type='text/javascript'>initBanner(" .json_encode($data).");</script>";

    }

    if(! is_admin()){
        add_action( 'wp_footer', 'cookie_banner_data' );
    }


?>
