<?php

/*
Plugin Name: VC menu position
Plugin URI: 
Description: A brief description of the Plugin.
Version: 1.0.0
Author: S. M. Shah Alam
Author URI:
License:  GPL2
*/
class vc_custom_menu
{

    function __construct()
    {
        global $wpdb;


        add_action( 'vc_before_init', array($this,'vc_custom_map' ));

        add_shortcode('the_content_block', array($this,'x_shortcode_content_block'));

    }




    public function vc_custom_map()
    {

        vc_map(array(
            "name" => __("Custom Menu Position Block", "__x__"),
            "base" => "the_content_block",
            'icon' => 'text-output',
            'description' => __('Place a Content Block in your content.', '__x__'),
            "wrapper_class" => "clearfix",
            "category" => __('Content', '__x__'),
            "params" => array(

                array(
                    "type" => "textfield",
                    "heading" => __("Class", "__x__"),
                    "param_name" => "class",
                    "value" => "",
                    "description" => __("Entering a title here will override the default item title. You also need to have the show title option checked.", "__x__")
                ),

                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Text color",  "__x__" ),
                    "param_name" => "color",
                    "value" => '#FFFFFF', //Default Red color
                    "description" => __( "Choose text color",  "__x__")
                ),

                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Background Color",  "__x__" ),
                    "param_name" => "bg_color",
                    "value" => '#222222', //Default Red color
                    "description" => __( "Choose text color",  "__x__")
                )
            )
        ));
    }


    function x_shortcode_content_block($atts)
    {
        extract(shortcode_atts(array(
            'class' => '',
            'color'=>'',
            'bg_color'=>''
        ), $atts));



        $output = "<div id=\"ennov_custom_menu_position\" class=\"{$class}\" style=\"; color:{$color};\">";
        $output .= "</div> <script>jQuery(document).ready(function(){ \n";
        if(!wp_is_mobile()){
            $output .="  var menu = jQuery('.header_inner').html(); \n
        jQuery('#ennov_custom_menu_position').html(menu); \n
        jQuery('.q_logo a').css('visibility','visible'); \n
        jQuery('nav.main_menu>ul>li>a').css('color','visible');";

         }
        $output .=" })
         </script>";

        $output.="<style>nav.main_menu>ul>li>a{ color:{$color}!important;}.#main-nav-wrapper{backgrond-color:{$bg_color} !important;}</style>";


        return $output;
    }


}

new vc_custom_menu();
