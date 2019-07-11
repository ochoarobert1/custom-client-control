<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://robertochoa.com.ve/
 * @since      1.0.0
 *
 * @package    Custom_Client_Control
 * @subpackage Custom_Client_Control/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Custom_Client_Control
 * @subpackage Custom_Client_Control/public
 * @author     Robert Ochoa <ochoa.robert1@gmail.com>
 */
class Custom_Client_Control_Public {

    /**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
    private $plugin_name;

    /**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
    private $version;

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
    public function enqueue_styles() {

        /**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Client_Control_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Client_Control_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        wp_enqueue_style( $this->plugin_name . '-front', plugin_dir_url( __FILE__ ) . 'css/custom-client-control-front.css', array(), $this->version, 'screen' );
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-client-control-public.css', array(), $this->version, 'print' );


    }

    /**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
    public function enqueue_scripts() {

        /**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Client_Control_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Client_Control_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-client-control-public.js', array( 'jquery' ), $this->version, false );

    }

    public function load_cpt_template($template) {
        global $post;

        // Is this a "my-custom-post-type" post?
        if ($post->post_type == "ccc_presupuestos"){

            //Your plugin path 
            $plugin_path = plugin_dir_path( __FILE__ ) . 'partials/' ;

            // The name of custom post type single template
            $template_name = 'single-ccc_presupuestos.php';

            // A specific single template for my custom post type exists in theme folder? Or it also doesn't exist in my plugin?
            if($template === get_stylesheet_directory() . '/' . $template_name || !file_exists($plugin_path . $template_name)) {
                //Then return "single.php" or "single-my-custom-post-type.php" from theme directory.
                return $template;
            }

            // If not, return my plugin custom post type template.
            return $plugin_path . $template_name;
        }

        //This is not my custom post type, do nothing with $template
        return $template;
    }

}
