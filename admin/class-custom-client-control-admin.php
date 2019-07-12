<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://robertochoa.com.ve/
 * @since      1.0.0
 *
 * @package    Custom_Client_Control
 * @subpackage Custom_Client_Control/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Client_Control
 * @subpackage Custom_Client_Control/admin
 * @author     Robert Ochoa <ochoa.robert1@gmail.com>
 */
class Custom_Client_Control_Admin {

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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
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

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-client-control-admin.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the admin area.
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

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-client-control-admin.js', array( 'jquery' ), $this->version, false );

    }

    public function add_admin_menu() {
        add_menu_page(
            'Client Control',
            'Client Control',
            'manage_options',
            $this->plugin_name,
            array($this, 'custom_client_control_dashboard'),
            plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
            120
        );
        add_submenu_page(
            $this->plugin_name,
            'Clientes',
            'Clientes',
            'manage_options',
            'edit.php?post_type=ccc_clients',
            null
        );
        add_submenu_page(
            $this->plugin_name,
            'Solicitudes',
            'Solicitudes',
            'manage_options',
            'edit.php?post_type=ccc_solicitudes',
            null
        );
        add_submenu_page(
            $this->plugin_name,
            'Presupuestos',
            'Presupuestos',
            'manage_options',
            'edit.php?post_type=ccc_presupuestos',
            null
        );
    }

    public function custom_client_control_dashboard() {
        include_once('partials/custom-client-control-admin-display.php');
    }

    // Register Custom Post Type
    public function add_custom_post_type() {

        $labels_clientes = array(
            'name'                  => _x( 'Clientes', 'Post Type General Name', 'custom-client-control' ),
            'singular_name'         => _x( 'Cliente', 'Post Type Singular Name', 'custom-client-control' ),
            'menu_name'             => __( 'Clientes', 'custom-client-control' ),
            'name_admin_bar'        => __( 'Clientes', 'custom-client-control' ),
            'archives'              => __( 'Archivo de Clientes', 'custom-client-control' ),
            'attributes'            => __( 'Atributo de Clientes', 'custom-client-control' ),
            'parent_item_colon'     => __( 'Cliente Padre:', 'custom-client-control' ),
            'all_items'             => __( 'Todos los Clientes', 'custom-client-control' ),
            'add_new_item'          => __( 'Agregar Nuevo Cliente', 'custom-client-control' ),
            'add_new'               => __( 'Agregar Nuevo', 'custom-client-control' ),
            'new_item'              => __( 'Nuevo Cliente', 'custom-client-control' ),
            'edit_item'             => __( 'Editar Cliente', 'custom-client-control' ),
            'update_item'           => __( 'Actualizar Cliente', 'custom-client-control' ),
            'view_item'             => __( 'Ver Cliente', 'custom-client-control' ),
            'view_items'            => __( 'Ver Clientes', 'custom-client-control' ),
            'search_items'          => __( 'Buscar Cliente', 'custom-client-control' ),
            'not_found'             => __( 'No hay resultados', 'custom-client-control' ),
            'not_found_in_trash'    => __( 'No hay resultados en Papelera', 'custom-client-control' ),
            'featured_image'        => __( 'Imagen del Cliente', 'custom-client-control' ),
            'set_featured_image'    => __( 'Colocar Imagen del Cliente', 'custom-client-control' ),
            'remove_featured_image' => __( 'Remover Imagen del Cliente', 'custom-client-control' ),
            'use_featured_image'    => __( 'Usar como Imagen del Cliente', 'custom-client-control' ),
            'insert_into_item'      => __( 'Insertar en Cliente', 'custom-client-control' ),
            'uploaded_to_this_item' => __( 'Cargado a este Cliente', 'custom-client-control' ),
            'items_list'            => __( 'Listado de Clientes', 'custom-client-control' ),
            'items_list_navigation' => __( 'Navegación del Listado de Clientes', 'custom-client-control' ),
            'filter_items_list'     => __( 'Filtro del Listado de Clientes', 'custom-client-control' ),
        );
        $args_clientes = array(
            'label'                 => __( 'Cliente', 'custom-client-control' ),
            'description'           => __( 'Clientes dentro del Sitio', 'custom-client-control' ),
            'labels'                => $labels_clientes,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );

        register_post_type( 'ccc_clients', $args_clientes );

        $labels = array(
            'name'                  => _x( 'Solicitudes', 'Post Type General Name', 'custom-client-control' ),
            'singular_name'         => _x( 'Solicitud', 'Post Type Singular Name', 'custom-client-control' ),
            'menu_name'             => __( 'Solicitudes', 'custom-client-control' ),
            'name_admin_bar'        => __( 'Solicitudes', 'custom-client-control' ),
            'archives'              => __( 'Archivo de Solicitudes', 'custom-client-control' ),
            'attributes'            => __( 'Atributo de Solicitudes', 'custom-client-control' ),
            'parent_item_colon'     => __( 'Solicitud Padre:', 'custom-client-control' ),
            'all_items'             => __( 'Todos las Solicitudes', 'custom-client-control' ),
            'add_new_item'          => __( 'Agregar Nueva Solicitud', 'custom-client-control' ),
            'add_new'               => __( 'Agregar Nuevo', 'custom-client-control' ),
            'new_item'              => __( 'Nueva Solicitud', 'custom-client-control' ),
            'edit_item'             => __( 'Editar Solicitud', 'custom-client-control' ),
            'update_item'           => __( 'Actualizar Solicitud', 'custom-client-control' ),
            'view_item'             => __( 'Ver Solicitud', 'custom-client-control' ),
            'view_items'            => __( 'Ver Solicitudes', 'custom-client-control' ),
            'search_items'          => __( 'Buscar Solicitud', 'custom-client-control' ),
            'not_found'             => __( 'No hay resultados', 'custom-client-control' ),
            'not_found_in_trash'    => __( 'No hay resultados en Papelera', 'custom-client-control' ),
            'featured_image'        => __( 'Imagen de Solicitud', 'custom-client-control' ),
            'set_featured_image'    => __( 'Colocar Imagen de Solicitud', 'custom-client-control' ),
            'remove_featured_image' => __( 'Remover Imagen de Solicitud', 'custom-client-control' ),
            'use_featured_image'    => __( 'Usar como Imagen de Solicitud', 'custom-client-control' ),
            'insert_into_item'      => __( 'Insertar en Solicitud', 'custom-client-control' ),
            'uploaded_to_this_item' => __( 'Cargado a esta Solicitud', 'custom-client-control' ),
            'items_list'            => __( 'Listado de Solicitudes', 'custom-client-control' ),
            'items_list_navigation' => __( 'Navegación del Listado de Solicitudes', 'custom-client-control' ),
            'filter_items_list'     => __( 'Filtro del Listado de Solicitudes', 'custom-client-control' ),
        );
        $args = array(
            'label'                 => __( 'Solicitud', 'custom-client-control' ),
            'description'           => __( 'Solicitudes', 'custom-client-control' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'            => array( 'status_solicitudes' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'ccc_solicitudes', $args );

        $labels = array(
            'name'                  => _x( 'Presupuestos', 'Post Type General Name', 'custom-client-control' ),
            'singular_name'         => _x( 'Presupuesto', 'Post Type Singular Name', 'custom-client-control' ),
            'menu_name'             => __( 'Presupuestos', 'custom-client-control' ),
            'name_admin_bar'        => __( 'Presupuestos', 'custom-client-control' ),
            'archives'              => __( 'Archivo de Presupuestos', 'custom-client-control' ),
            'attributes'            => __( 'Atributo de Presupuestos', 'custom-client-control' ),
            'parent_item_colon'     => __( 'Presupuesto Padre:', 'custom-client-control' ),
            'all_items'             => __( 'Todos los Presupuestos', 'custom-client-control' ),
            'add_new_item'          => __( 'Agregar Nuevo Presupuesto', 'custom-client-control' ),
            'add_new'               => __( 'Agregar Nuevo', 'custom-client-control' ),
            'new_item'              => __( 'Nuevo Presupuesto', 'custom-client-control' ),
            'edit_item'             => __( 'Editar Presupuesto', 'custom-client-control' ),
            'update_item'           => __( 'Actualizar Presupuesto', 'custom-client-control' ),
            'view_item'             => __( 'Ver Presupuesto', 'custom-client-control' ),
            'view_items'            => __( 'Ver Presupuestos', 'custom-client-control' ),
            'search_items'          => __( 'Buscar Presupuesto', 'custom-client-control' ),
            'not_found'             => __( 'No hay resultados', 'custom-client-control' ),
            'not_found_in_trash'    => __( 'No hay resultados en Papelera', 'custom-client-control' ),
            'featured_image'        => __( 'Imagen de Presupuesto', 'custom-client-control' ),
            'set_featured_image'    => __( 'Colocar Imagen de Presupuesto', 'custom-client-control' ),
            'remove_featured_image' => __( 'Remover Imagen de Presupuesto', 'custom-client-control' ),
            'use_featured_image'    => __( 'Usar como Imagen de Presupuesto', 'custom-client-control' ),
            'insert_into_item'      => __( 'Insertar en Presupuesto', 'custom-client-control' ),
            'uploaded_to_this_item' => __( 'Cargado a este Presupuesto', 'custom-client-control' ),
            'items_list'            => __( 'Listado de Presupuestos', 'custom-client-control' ),
            'items_list_navigation' => __( 'Navegación del Listado de Presupuestos', 'custom-client-control' ),
            'filter_items_list'     => __( 'Filtro del Listado de Presupuestos', 'custom-client-control' ),
        );
        $args = array(
            'label'                 => __( 'Presupuesto', 'custom-client-control' ),
            'description'           => __( 'Presupuestos', 'custom-client-control' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'taxonomies'            => array( 'status_presupuestos' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'ccc_presupuestos', $args );
    }

    public function custom_register_meta_boxes() {
        add_meta_box(
            'ccc_presupuestos_metabox',
            __( 'Elementos del Presupuesto', 'textdomain' ),
            array($this, 'custom_metabox_callback'),
            'ccc_presupuestos'
        );
    }

    public function custom_metabox_callback($post) {
        wp_nonce_field( 'ccc_presupuestos_nonce_action', 'ccc_presupuestos_nonce' );
        $nombre_cliente = get_post_meta( $post->ID, 'ccc_nombre_cliente', true );
        $offers = get_post_meta( $post->ID, 'ccc_offers', true );
        $currency = get_post_meta( $post->ID, 'ccc_currency', true );
        $elementos = get_post_meta( $post->ID, 'ccc_elementos', true );
        $precio_bolivares = get_post_meta( $post->ID, 'ccc_precio_bolivares', true );
        $precio_dolares = get_post_meta( $post->ID, 'ccc_precio_dolares', true );
        $tiempo_entrega = get_post_meta( $post->ID, 'ccc_tiempo_entrega', true );
?>
<div class="client-container">
    <h3><?php _e('Nombre del Cliente'); ?></h3>
    <input type="text" name="ccc_nombre_cliente" class="widefat" placeholder="<?php _e('Agregue aquí el nombre del cliente', 'custom-client-control'); ?>" value="<?php echo $nombre_cliente; ?>" />
</div>
<hr>
<div class="currency-container">
    <h3><?php _e('Moneda'); ?></h3>
    <label for="currency">
        <input type="radio" name="ccc_currency" value="0" class="thinfat" <?php if ($currency == '0') { echo 'checked="checked"'; } ?> />
        <?php _e('Bolívares'); ?>
    </label>
    <label for="currency">
        <input type="radio" name="ccc_currency" value="1" class="thinfat" <?php if ($currency == '1') { echo 'checked="checked"'; } ?> />
        <?php _e('Dólares'); ?>
    </label>
    <label for="currency">
        <input type="radio" name="ccc_currency" value="2" class="thinfat" <?php if ($currency == '2') { echo 'checked="checked"'; } ?> />
        <?php _e('Ambos'); ?>
    </label>
</div>
<hr>
<div class="offerings-container">
    <h3><?php _e('Elementos a Ofrecer'); ?></h3>
    <?php if ($offers == NULL) { ?>
    <div class="element-item">
        <input type="text" name="ccc_offers[]" class="widefat" value="" placeholder="<?php _e('Agregue aqui el elemento', 'custom-client-control'); ?>" />
    </div>
    <?php } else {  ?>
    <?php foreach ($offers as $item) { ?>
    <div class="element-item">
        <input type="text" name="ccc_offers[]" class="widefat" placeholder="<?php _e('Agregue aqui el elemento', 'custom-client-control'); ?>" value="<?php echo $item; ?>" />
    </div>
    <?php } ?>
    <?php } ?>
</div>
<button id="button_cloner_offers" class="button button-secondary button-large">+ <?php _e('Agregar más elementos', 'custom-client-control'); ?></button>
<hr>
<div class="element-container">
    <h3><?php _e('Elementos del Presupuesto'); ?></h3>
    <?php if ($elementos == NULL) { ?>
    <div class="element-item">
        <input type="text" name="ccc_elementos[]" class="widefat" value="" placeholder="<?php _e('Agregue aqui el elemento', 'custom-client-control'); ?>" />
    </div>
    <?php } else {  ?>
    <?php foreach ($elementos as $item) { ?>
    <div class="element-item">
        <input type="text" name="ccc_elementos[]" class="widefat" placeholder="<?php _e('Agregue aqui el elemento', 'custom-client-control'); ?>" value="<?php echo $item; ?>" />
    </div>
    <?php } ?>
    <?php } ?>
</div>
<button id="button_cloner" class="button button-secondary button-large">+ <?php _e('Agregar más elementos', 'custom-client-control'); ?></button>
<hr>
<div class="price-container">
    <h3><?php _e('Precios'); ?></h3>
    <input type="number" min="1" step="any" name="ccc_precio_bolivares" class="widefat" placeholder="<?php _e('Agregue aqui el precio en Bolívares', 'custom-client-control'); ?>" value="<?php echo $precio_bolivares; ?>" />
    <input type="number" min="1" step="any" name="ccc_precio_dolares" class="widefat" placeholder="<?php _e('Agregue aqui el precio en Dólares', 'custom-client-control'); ?>" value="<?php echo $precio_dolares; ?>" />
</div>
<div class="time-container">
    <h3><?php _e('Tiempos'); ?></h3>
    <input type="text" name="ccc_tiempo_entrega" class="widefat" placeholder="<?php _e('Agregue aqui el tiempo de entrega', 'custom-client-control'); ?>" value="<?php echo $tiempo_entrega; ?>" />
</div>
<?php

    }

    public function custom_save_meta_box( $post_id ) {
        $nonce_name   = isset( $_POST['ccc_presupuestos_nonce'] ) ? $_POST['ccc_presupuestos_nonce'] : '';
        $nonce_action = 'ccc_presupuestos_nonce_action';

        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }

        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        update_post_meta($post_id, "ccc_nombre_cliente", $_POST["ccc_nombre_cliente"]);
        update_post_meta($post_id, "ccc_offers", $_POST["ccc_offers"]);
        update_post_meta($post_id, "ccc_elementos", $_POST["ccc_elementos"]);
        update_post_meta($post_id, 'ccc_currency', $_POST['ccc_currency']);
        update_post_meta($post_id, 'ccc_precio_bolivares', $_POST['ccc_precio_bolivares']);
        update_post_meta($post_id, 'ccc_precio_dolares', $_POST['ccc_precio_dolares']);
        update_post_meta($post_id, 'ccc_tiempo_entrega', $_POST['ccc_tiempo_entrega']);
    }

}
