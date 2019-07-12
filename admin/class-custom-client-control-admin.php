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

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-client-control-admin.css', array(), $this->version, 'screen' );
        wp_enqueue_style( $this->plugin_name . '-print', plugin_dir_url( __FILE__ ) . 'css/custom-client-control-admin-print.css', array(), $this->version, 'print' );

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
        wp_localize_script( $this->plugin_name, 'admin_url', array( 'ajax_url' => admin_url('admin-ajax.php')));

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

        add_meta_box(
            'ccc_presupuestos_print_metabox',
            __( 'Imprimir Presupuesto', 'textdomain' ),
            array($this, 'print_metabox_callback'),
            'ccc_presupuestos',
            'side',
            'high'
        );
    }

    public function print_metabox_callback($post) {
?>
<input type="hidden" name="post_hidden_ID" value="<?php echo $post->ID; ?>">
<button id="print_budget" class="button button-secondary button-large"><?php _e('Imprimir Presupuesto'); ?></button>
<?php
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

    public function print_custom_budget_callback () {
        $post_id = $_POST['post_id'];
        ob_start();
?>
<div id="printArea">
    <div class="ccc-main-container ccc-first-page">
        <div class="page-middle-inner">
            <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/logo-white.png'; ?>" alt="" class="img-center img-logo">
            <div class="main-title">
                <h1>Presupuesto Web</h1>
                <h5>Julio 2019</h5>
            </div>
        </div>
    </div>
    <div class="ccc-main-container ccc-second-page">
        <div class="page-inner">
            <div class="section-0">
                <p>PRESUPUESTO <strong>WEB</strong> <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/logo.png'; ?>" alt="" class="img-title" /></p>
            </div>
            <div class="section-1">
                <div><img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/001-conversation.png'; ?>" alt="" class="img-center"></div>
                <div>
                    <p>La capacidad de respuesta a las necesidades del mercado viene determinada por la adecuación y accesibilidad de la comunicación de la empresa.</p>
                </div>
            </div>
            <div class="section-2">
                <div><img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/002-stopwatch.png'; ?>" alt="" class="img-center"></div>
                <div>
                    <h2>¡Las Oportunidades no esperan!</h2>
                    <p>Estar siempre disponible en cualquier lugar con el contenido adecuado siempre es el modelo a seguir. Comunicar la filosofía de la empresa, valores, posicionamiento y productos requiere cada vez más de herramientas flexibles, donde el contenido se adapte a los intereses del Mercado, oportunidades de negocio y, sobre todo, a las necesidades del cliente.</p>
                </div>
            </div>
            <div class="section-3">
                <p>Esta capacidad de adecuación no serviría de nada sin herramientas que posibilitan un control sobre el contenido, emitido de forma centralizada y “viva”. Poder controlar y actualizar en cualquier momento y desde cualquier lugar el contenido que estamosofreciendo es clave para mantener la información actualizada al minuto, dando respuesta a posibles oportunidades, acciones de la competencia, ferias, eventos.</p>
            </div>
            <div class="section-4">
                <h2>Una versión única del contenido actualizable en cualquier momento desde cualquier lugar.</h2>
            </div>
            <div class="section-5">
                <p>Por último, la capacidad de recoger datos sobre las preferencias de los visitantes
                    permitirá conocer mejor que tipo de productos son los preferidos y más consultados, cuales generan más visitas desde buscadores, que países nos están visitando, etc. Esta ventaja natural de internet se convierte en una herramienta de mucho valor si el diseño de la web facilita la recogida e interpretación de estos datos.</p>
            </div>
            <div class="section-6">
                <div><img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/003-startup.png'; ?>" alt="" class="img-center"></div>
                <div>
                    <p>Conocer las preferencias reales de los usuarios</p>
                    <p>+ Capacidad de adaptar el contenido</p>
                    <p>= Mayor sintonía entre mensaje y espectador.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ccc-main-container ccc-third-page">
        <div class="page-inner">
            <div class="section-0">
                <p>PRESUPUESTO <strong>WEB</strong> <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/logo.png'; ?>" alt="" class="img-title" /></p>
            </div>
            <div class="section-1">
                <h2><strong>Datos</strong> del Proyecto</h2>
                <div><img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/icon-avatar.png'; ?>" alt="" class="img-inline" /> <strong>Nombre del Cliente:</strong> <?php echo get_post_meta($post_id, 'ccc_nombre_cliente', true); ?></div>
                <div><img src="<?php echo plugin_dir_url( __FILE__ ) .'img/icon-data.png'; ?>" alt="" class="img-inline" /> <strong>Tipo de Proyecto:</strong> <?php the_title(); ?></div>
                <div><img src="<?php echo plugin_dir_url( __FILE__ ) .'img/icon-calendar.png'; ?>" alt="" class="img-inline" /> <strong>Fecha del Presupuesto:</strong> <?php echo date('d-m-Y'); ?></div>
            </div>
            <div class="section-2">
                <div>
                    <h2><strong>Desarrollo</strong> del Proyecto</h2>
                    <br />
                    <?php /* the_content(); */ ?>
                </div>
                <div>
                    <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/004-website.png'; ?>" alt="" class="img-center">
                </div>
            </div>
            <div class="section-3">
                <h2>Te ofrezco lo siguiente:</h2>
                <?php $elementos = get_post_meta($post_id, 'ccc_offers', true); ?>
                <ul>
                    <?php foreach ($elementos as $item) { ?>
                    <li><?php echo $item; ?></li>
                    <?php } ?>
                </ul>
                <h4><strong>Y por último pero no menos importante:</strong> estoy entregándote un sitio con un diseño que se mantendrá actualizado que tendrá todas las cualidades necesarias para que tu marca / empresa tenga una grandiosa presencia en la Internet.</h4>
            </div>
        </div>
    </div>
    <div class="ccc-main-container ccc-fourth-page">
        <div class="page-inner">
            <div class="section-0">
                <p>PRESUPUESTO <strong>WEB</strong> <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/logo.png'; ?>" alt="" class="img-title" /></p>
            </div>
            <div class="section-1">
                <h2><strong>Costo</strong> del Proyecto</h2>
                <?php $currency = get_post_meta($post_id, 'ccc_currency', true); ?>
                <?php if ($currency != 2) { ?>
                <?php if ($currency === 0) { $currency_text = 'Bolívares.'; $currency_symbol = 'Bs.'; } else { $currency_text = 'Dólares.'; $currency_symbol = '$'; }?>
                <h4>(Valuado en <?php echo $currency_text; ?>)</h4>
                <div>
                    <table>
                        <tr>
                            <th>Etapa</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                        </tr>

                        <?php $elementos = get_post_meta($post_id, 'ccc_elementos', true); ?>
                        <?php $i = 1; ?>
                        <?php foreach ($elementos as $item) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $item; ?></td>
                            <td></td>
                        </tr>
                        <?php $i++; } ?>
                        <tr>
                            <td colspan=2>TOTAL</td>
                            <td><?php echo $currency_symbol; ?> <?php echo number_format(get_post_meta($post_id, 'ccc_precio_dolares', true), 2, ',', '.' ); ?></td>
                        </tr>
                    </table>
                </div>
                <?php } else { ?>
                <?php $currency_text = 'Bolívares.'; $currency_symbol = 'Bs.'; ?>
                <h4>(Valuado en <?php echo $currency_text; ?>)</h4>
                <div>
                    <table>
                        <tr>
                            <th>Etapa</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                        </tr>

                        <?php $elementos = get_post_meta($post_id, 'ccc_elementos', true); ?>
                        <?php $i = 1; ?>
                        <?php foreach ($elementos as $item) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $item; ?></td>
                            <td></td>
                        </tr>
                        <?php $i++; } ?>
                        <tr>
                            <td colspan=2>TOTAL</td>
                            <td><?php echo $currency_symbol; ?> <?php echo number_format(get_post_meta($post_id, 'ccc_precio_bolivares', true), 2, ',', '.' ); ?></td>
                        </tr>
                    </table>
                </div>
                <?php $currency_text = 'Dólares.'; $currency_symbol = '$ '; ?>
                <h4>(Valuado en <?php echo $currency_text; ?>)</h4>
                <div>
                    <table>
                        <tr>
                            <th>Etapa</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                        </tr>

                        <?php $elementos = get_post_meta($post_id, 'ccc_elementos', true); ?>
                        <?php $i = 1; ?>
                        <?php foreach ($elementos as $item) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $item; ?></td>
                            <td></td>
                        </tr>
                        <?php $i++; } ?>
                        <tr>
                            <td colspan=2>TOTAL</td>
                            <td><?php echo $currency_symbol; ?> <?php echo number_format(get_post_meta($post_id, 'ccc_precio_dolares', true), 2, ',', '.' ); ?></td>
                        </tr>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="ccc-main-container ccc-fifth-page">
        <div class="page-inner">
            <div class="section-0">
                <p>PRESUPUESTO <strong>WEB</strong> <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/logo.png'; ?>" alt="" class="img-title" /></p>
            </div>
            <div class="section-1">
                <h2><strong>Condiciones</strong> del Proyecto</h2>
                <p>El tiempo de entrega para el proyecto es de <strong><?php echo get_post_meta($post_id, 'ccc_tiempo_entrega', true); ?></strong>, y comienzan a contar desde la entrega de los accesos necesarios para llevar a cabo la propuesta, (en caso de tenerlos, hosting, ftp, entre otros) y demás información relevante.</p>
                <p>La información y los accesos deben ser enviados con la confirmación de la cancelación del 50% inicial y la firma de este documento en señal de aceptación de las condiciones.</p>
                <p>El pago (si es en Bolívares) se hará en dos (2) partes: 50% adelantado, con la entrega firmada de este documento en señal de aceptación formal de la propuesta y las condiciones que en él se establecen. El 50% restante se cancelara al momento de la entrega final.</p>
                <p>El Pago (si es en dólares) se hará al finalizar el proyecto. El cliente asumirá la comisión de PayPal.</p>
                <p>Una vez cancelada la segunda parte, se hará entrega formal en un documento de todos los accesos, usuarios, claves y contraseñas que se hayan generado durante el proyecto.</p>
                <p>El Cliente asumirá cualquier responsabilidad en cuanto a los retrasos generados para la aprobación de artes, Wireframes o cambios en la programación y demás estructuras que requieran de su revisión.</p>
                <p>Si el cliente declina a medio trabajo de continuar la relación de trabajo y ha tomado la opción de pago en Bolívares, el pago por haber iniciado el trabajo no será devuelto, se tomará como parte del trabajo que ya empezó a realizarse.</p>
                <p>Si el cliente declina a medio trabajo de continuar la relación de trabajo y había decidido tomar la opción de pago en dólares, será sujeto a penalización y deberá pagar el 25% de lo acordado vía PayPal por el trabajo que ya empezó a realizarse.</p>
                <p>Si el cliente declina de continuar la relación de trabajo antes de la fecha acordada, el contenido desarrollado y el código será removido del servidor de prueba y no podrá ser usada la interfaz que se ha desarrollado.</p>
                <p>El proyecto estará considerado a ser expuesto en la página de Robert Ochoa, como parte de su portafolio y casos de éxito (teniendo en cuenta la data sensible que el cliente pueda tener en su página web).</p>
                <p>El código del proyecto estará considerado a ser expuesto en los perfiles de trabajo de Robert Ochoa (entiéndase perfiles de trabajo como Github / Linkedin / Behance y otros sitios de resentación de trabajos), los cuales el proyecto aplique.</p>
            </div>
        </div>
    </div>
</div>
<?php
        $output = ob_get_contents();
        ob_get_clean();
        echo $output;
        die();
    }



}
