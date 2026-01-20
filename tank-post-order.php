<?php
$restabookorder = new RESTABOOK_Engine();

class RESTABOOK_Engine {

    function __construct() {
        if (!get_option('restabookorder_install'))
            $this->restabookorder_install();

        //$this->load_dependencies();

        add_action('admin_menu', array($this, 'admin_menu'));

        add_action('admin_init', array( $this, 'refresh' ) );

        add_action('admin_init', array($this, 'update_options'));
        add_action('admin_init', array($this, 'load_script_css'));

        add_action('wp_ajax_update-menu-order', array($this, 'update_menu_order'));
        add_action('wp_ajax_update-menu-order-tags', array($this, 'update_menu_order_tags'));

        add_action('pre_get_posts', array($this, 'restabookorder_pre_get_posts'));

        add_filter('get_previous_post_where', array($this, 'restabookorder_previous_post_where'));
        add_filter('get_previous_post_sort', array($this, 'restabookorder_previous_post_sort'));
        add_filter('get_next_post_where', array($this, 'restabookorder_next_post_where'));
        add_filter('get_next_post_sort', array($this, 'restabookorder_next_post_sort'));

        add_filter('get_terms_orderby', array($this, 'restabookorder_get_terms_orderby'), 10, 3);
        add_filter('wp_get_object_terms', array($this, 'restabookorder_get_object_terms'), 10, 3);
        add_filter('get_terms', array($this, 'restabookorder_get_object_terms'), 10, 3);
        
        add_action( 'admin_notices', array( $this, 'restabookorder_notice_not_checked' ) );
        add_action( 'wp_ajax_restabookorder_dismiss_notices', array( $this, 'dismiss_notices' ) );
		add_filter('restabook_order_post_types_args',array($this,'restabook_order_filter_post_types'),10,2);

        add_action('wp_ajax_restabook_order_reset_order', array($this, 'restabook_order_ajax_reset_order'));
    }

   
    public function restabook_order_filter_post_types($args,$options){

        if(isset($options['show_advanced_view']) && '1' == $options['show_advanced_view'] ){
            unset($args['show_in_menu']);
        }

        return $args;
    }

   

    public function dismiss_notices() {

        if ( ! check_admin_referer( 'restabookorder_dismiss_notice', 'restabookorder_nonce' ) ) {
            wp_die( 'nok' );
        }

        update_option( 'restabookorder_notice', '1' );

        wp_die( 'ok' );

    }

    public function restabookorder_notice_not_checked() {

        $settings = $this->get_restabookorder_options_objects();
        if ( ! empty( $settings ) ){
            return;
        }

        $screen = get_current_screen();

        if ( 'settings_page_restabookorder-settings' == $screen->id ) {
            return;
        }

        $dismessed = get_option( 'restabookorder_notice', false );

        if ( $dismessed ) {
            return;
        }

        ?>
        
        <?php
    }

    public function restabookorder_install() {
        global $wpdb;
        $result = $wpdb->query("DESCRIBE $wpdb->terms `term_order`");
        if (!$result) {
            $query = "ALTER TABLE $wpdb->terms ADD `term_order` INT( 4 ) NULL DEFAULT '0'";
            $result = $wpdb->query($query);
        }
        update_option('restabookorder_install', 1);
    }

    public function admin_menu() {
        add_options_page(__('Drag & Drop post order', 'restabook-plugin'), __('Post Order', 'restabook-plugin'), 'manage_options', 'restabook-settings', array($this, 'admin_page'));
    }

    public function admin_page() {
        require TANK_PLUGIN_PATH . 'settings.php';
    }

    public function _check_load_script_css() {
        $active = false;

        $objects = $this->get_restabookorder_options_objects();
        $tags = $this->get_restabookorder_options_tags();

        if (empty($objects) && empty($tags))
            return false;

        if (isset($_GET['orderby']) || strstr($_SERVER['REQUEST_URI'], 'action=edit') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php'))
            return false;

        if (!empty($objects)) {
            if (isset($_GET['post_type']) && !isset($_GET['taxonomy']) && in_array($_GET['post_type'], $objects)) { // if page or custom post types
                $active = true;
            }
            if (!isset($_GET['post_type']) && strstr($_SERVER['REQUEST_URI'], 'wp-admin/edit.php') && in_array('post', $objects)) { // if post
                $active = true;
            }
        }

        if (!empty($tags)) {
            if (isset($_GET['taxonomy']) && in_array($_GET['taxonomy'], $tags)) {
                $active = true;
            }
        }

        return $active;
    }

    public function load_script_css() {
        if ($this->_check_load_script_css()) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('restabookorderjs', TANK_URL . '/assets/restabookorder.js', array('jquery'), TANK_VERSION, true);

            wp_enqueue_style('restabookorder', TANK_URL . '/assets/restabookorder.css', array(), TANK_VERSION );
        }
    }

    public function refresh() {

        if ( restabookorder_doing_ajax() ) {
            return;
        }

        global $wpdb;
        $objects = $this->get_restabookorder_options_objects();
        $tags = $this->get_restabookorder_options_tags();

        if (!empty($objects)) {
            
            foreach ($objects as $object) {
                $result = $wpdb->get_results("
                    SELECT count(*) as cnt, max(menu_order) as max, min(menu_order) as min
                    FROM $wpdb->posts
                    WHERE post_type = '" . $object . "' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
                ");

                if ($result[0]->cnt == 0 || $result[0]->cnt == $result[0]->max)
                    continue;

                // Here's the optimization
                $wpdb->query("SET @row_number = 0;");
                $wpdb->query("UPDATE $wpdb->posts as pt JOIN (
                  SELECT ID, (@row_number:=@row_number + 1) AS `rank`
                  FROM $wpdb->posts
                  WHERE post_type = '$object' AND post_status IN ( 'publish', 'pending', 'draft', 'private', 'future' )
                  ORDER BY menu_order ASC
                ) as pt2
                ON pt.id = pt2.id
                SET pt.menu_order = pt2.`rank`;");

            }
        }

        if (!empty($tags)) {
            foreach ($tags as $taxonomy) {
                $result = $wpdb->get_results("
                    SELECT count(*) as cnt, max(term_order) as max, min(term_order) as min
                    FROM $wpdb->terms AS terms
                    INNER JOIN $wpdb->term_taxonomy AS term_taxonomy ON ( terms.term_id = term_taxonomy.term_id )
                    WHERE term_taxonomy.taxonomy = '" . $taxonomy . "'
                ");
                if ($result[0]->cnt == 0 || $result[0]->cnt == $result[0]->max)
                    continue;

                $results = $wpdb->get_results("
                    SELECT terms.term_id
                    FROM $wpdb->terms AS terms
                    INNER JOIN $wpdb->term_taxonomy AS term_taxonomy ON ( terms.term_id = term_taxonomy.term_id )
                    WHERE term_taxonomy.taxonomy = '" . $taxonomy . "'
                    ORDER BY term_order ASC
                ");
                foreach ($results as $key => $result) {
                    $wpdb->update($wpdb->terms, array('term_order' => $key + 1), array('term_id' => $result->term_id));
                }
            }
        }
    }

    public function update_menu_order() {
        global $wpdb;

        parse_str($_POST['order'], $data);

        if (!is_array($data))
            return false;

        $id_arr = array();
        foreach ($data as $key => $values) {
            foreach ($values as $position => $id) {
                $id_arr[] = $id;
            }
        }

        $menu_order_arr = array();
        foreach ($id_arr as $key => $id) {
            $results = $wpdb->get_results("SELECT menu_order FROM $wpdb->posts WHERE ID = " . intval($id));
            foreach ($results as $result) {
                $menu_order_arr[] = $result->menu_order;
            }
        }

        sort($menu_order_arr);

        foreach ($data as $key => $values) {
            foreach ($values as $position => $id) {
                $wpdb->update($wpdb->posts, array('menu_order' => $menu_order_arr[$position]), array('ID' => intval($id)));
            }
        }

        do_action('scp_update_menu_order');
    }

    public function update_menu_order_tags() {
        global $wpdb;

        parse_str($_POST['order'], $data);

        if (!is_array($data))
            return false;

        $id_arr = array();
        foreach ($data as $key => $values) {
            foreach ($values as $position => $id) {
                $id_arr[] = $id;
            }
        }

        $menu_order_arr = array();
        foreach ($id_arr as $key => $id) {
            $results = $wpdb->get_results("SELECT term_order FROM $wpdb->terms WHERE term_id = " . intval($id));
            foreach ($results as $result) {
                $menu_order_arr[] = $result->term_order;
            }
        }
        sort($menu_order_arr);

        foreach ($data as $key => $values) {
            foreach ($values as $position => $id) {
                $wpdb->update($wpdb->terms, array('term_order' => $menu_order_arr[$position]), array('term_id' => intval($id)));
            }
        }

        do_action('scp_update_menu_order_tags');
    }

    public function update_options() {
        global $wpdb;

        if (!isset($_POST['restabookorder_submit']))
            return false;

        check_admin_referer('nonce_restabookorder');

        $input_options = array();
        $input_options['objects'] = isset($_POST['objects']) ? $_POST['objects'] : '';
        $input_options['tags'] = isset($_POST['tags']) ? $_POST['tags'] : '';
        $input_options['show_advanced_view'] = isset($_POST['show_advanced_view']) ? $_POST['show_advanced_view'] : '';

        update_option('restabookorder_options', $input_options);

        $objects = $this->get_restabookorder_options_objects();
        $tags = $this->get_restabookorder_options_tags();

        if (!empty($objects)) {
            foreach ($objects as $object) {
                $result = $wpdb->get_results("
                    SELECT count(*) as cnt, max(menu_order) as max, min(menu_order) as min
                    FROM $wpdb->posts
                    WHERE post_type = '" . $object . "' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
                ");
                if ($result[0]->cnt == 0 || $result[0]->cnt == $result[0]->max)
                    continue;

                if ($object == 'page') {
                    $results = $wpdb->get_results("
                        SELECT ID
                        FROM $wpdb->posts
                        WHERE post_type = '" . $object . "' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
                        ORDER BY post_title ASC
                    ");
                } else {
                    $results = $wpdb->get_results("
                        SELECT ID
                        FROM $wpdb->posts
                        WHERE post_type = '" . $object . "' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
                        ORDER BY post_date DESC
                    ");
                }
                foreach ($results as $key => $result) {
                    $wpdb->update($wpdb->posts, array('menu_order' => $key + 1), array('ID' => $result->ID));
                }
            }
        }

        if (!empty($tags)) {
            foreach ($tags as $taxonomy) {
                $result = $wpdb->get_results("
                    SELECT count(*) as cnt, max(term_order) as max, min(term_order) as min
                    FROM $wpdb->terms AS terms
                    INNER JOIN $wpdb->term_taxonomy AS term_taxonomy ON ( terms.term_id = term_taxonomy.term_id )
                    WHERE term_taxonomy.taxonomy = '" . $taxonomy . "'
                ");
                if ($result[0]->cnt == 0 || $result[0]->cnt == $result[0]->max)
                    continue;

                $results = $wpdb->get_results("
                    SELECT terms.term_id
                    FROM $wpdb->terms AS terms
                    INNER JOIN $wpdb->term_taxonomy AS term_taxonomy ON ( terms.term_id = term_taxonomy.term_id )
                    WHERE term_taxonomy.taxonomy = '" . $taxonomy . "'
                    ORDER BY name ASC
                ");
                foreach ($results as $key => $result) {
                    $wpdb->update($wpdb->terms, array('term_order' => $key + 1), array('term_id' => $result->term_id));
                }
            }
        }

        wp_redirect('admin.php?page=restabook-settings&msg=update');
    }

    public function restabookorder_previous_post_where($where) {
        global $post;

        $objects = $this->get_restabookorder_options_objects();
        if (empty($objects))
            return $where;

        if (isset($post->post_type) && in_array($post->post_type, $objects)) {
            $where = preg_replace("/p.post_date < \'[0-9\-\s\:]+\'/i", "p.menu_order > '" . $post->menu_order . "'", $where);
        }
        return $where;
    }

    public function restabookorder_previous_post_sort($orderby) {
        global $post;

        $objects = $this->get_restabookorder_options_objects();
        if (empty($objects))
            return $orderby;

        if (isset($post->post_type) && in_array($post->post_type, $objects)) {
            $orderby = 'ORDER BY p.menu_order ASC LIMIT 1';
        }
        return $orderby;
    }

    public function restabookorder_next_post_where($where) {
        global $post;

        $objects = $this->get_restabookorder_options_objects();
        if (empty($objects))
            return $where;

        if (isset($post->post_type) && in_array($post->post_type, $objects)) {
            $where = preg_replace("/p.post_date > \'[0-9\-\s\:]+\'/i", "p.menu_order < '" . $post->menu_order . "'", $where);
        }
        return $where;
    }

    public function restabookorder_next_post_sort($orderby) {
        global $post;

        $objects = $this->get_restabookorder_options_objects();
        if (empty($objects))
            return $orderby;

        if (isset($post->post_type) && in_array($post->post_type, $objects)) {
            $orderby = 'ORDER BY p.menu_order DESC LIMIT 1';
        }
        return $orderby;
    }

    public function restabookorder_pre_get_posts($wp_query) {
        $objects = $this->get_restabookorder_options_objects();

        if (empty($objects))
            return false;
        if (is_admin()) {

            if (isset($wp_query->query['post_type']) && !isset($_GET['orderby'])) {
                if (in_array($wp_query->query['post_type'], $objects)) {
                    $wp_query->set('orderby', 'menu_order');
                    $wp_query->set('order', 'ASC');
                }
            }
        } else {

            $active = false;

            if (isset($wp_query->query['post_type'])) {
                if (!is_array($wp_query->query['post_type'])) {
                    if (in_array($wp_query->query['post_type'], $objects)) {
                        $active = true;
                    }
                }
            } else {
                if (in_array('post', $objects)) {
                    $active = true;
                }
            }

            if (!$active)
                return false;

            if (isset($wp_query->query['suppress_filters'])) {
                if ($wp_query->get('orderby') == 'date')
                    $wp_query->set('orderby', 'menu_order');
                if ($wp_query->get('order') == 'DESC')
                    $wp_query->set('order', 'ASC');
            } else {
                if (!$wp_query->get('orderby'))
                    $wp_query->set('orderby', 'menu_order');
                if (!$wp_query->get('order'))
                    $wp_query->set('order', 'ASC');
            }

        }
    }

    public function restabookorder_get_terms_orderby($orderby, $args) {
        if (is_admin())
            return $orderby;

        $tags = $this->get_restabookorder_options_tags();

        if (!isset($args['taxonomy']))
            return $orderby;

        if(is_array($args['taxonomy'])){
            if(isset($args['taxonomy'][0])){
                $taxonomy = $args['taxonomy'][0];
            } else {
                $taxonomy = false;
            }

        } else {
            $taxonomy = $args['taxonomy'];
        }

        if (!in_array($taxonomy, $tags))
            return $orderby;

        $orderby = 't.term_order';
        return $orderby;
    }

    public function restabookorder_get_object_terms($terms) {
        $tags = $this->get_restabookorder_options_tags();

        if (is_admin() && isset($_GET['orderby']))
            return $terms;

        foreach ($terms as $key => $term) {
            if (is_object($term) && isset($term->taxonomy)) {
                $taxonomy = $term->taxonomy;
                if (!in_array($taxonomy, $tags))
                    return $terms;
            } else {
                return $terms;
            }
        }

        usort($terms, array($this, 'taxcmp'));
        return $terms;
    }

    public function taxcmp($a, $b) {
        if ($a->term_order == $b->term_order)
            return 0;
        return ( $a->term_order < $b->term_order ) ? -1 : 1;
    }

    public function get_restabookorder_options_objects() {
        $restabookorder_options = get_option('restabookorder_options') ? get_option('restabookorder_options') : array();
        $objects = isset($restabookorder_options['objects']) && is_array($restabookorder_options['objects']) ? $restabookorder_options['objects'] : array();
        return $objects;
    }

    public function get_restabookorder_options_tags() {
        $restabookorder_options = get_option('restabookorder_options') ? get_option('restabookorder_options') : array();
        $tags = isset($restabookorder_options['tags']) && is_array($restabookorder_options['tags']) ? $restabookorder_options['tags'] : array();
        return $tags;
    }

    /**
     *  SCPO reset order for post types/taxonomies
     */
    public function restabook_order_ajax_reset_order() {

        global $wpdb;
        if ('restabook_order_reset_order' == $_POST['action']) {
            check_ajax_referer('scpo-reset-order', 'restabook_order_security');
            $items = $_POST['items'];

            $count   = 0;
            $in_list = "(";
            foreach ($items as $item) {

                if ($count != 0) {
                    $in_list .= ',';
                }
                $in_list .= '\'' . $item . '\'';
                $count++;
            }
            $in_list .= ")";

            $prep_posts_query = "UPDATE $wpdb->posts SET `menu_order` = 0 WHERE `post_type` IN $in_list";

            $result = $wpdb->query($prep_posts_query);

            if ($result) {
                echo 'Items have been reset';
            } else {
                echo false;
            }

            wp_die();
        }
    }

}

function restabookorder_doing_ajax(){

    if ( function_exists( 'wp_doing_ajax' ) ) {
        return wp_doing_ajax();
    }

    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        return true;
    }

    return false;

}

/**
 * SCP Order Uninstall hook
 */
register_uninstall_hook(__FILE__, 'restabookorder_uninstall');

function restabookorder_uninstall() {
    global $wpdb;
    if (function_exists('is_multisite') && is_multisite()) {
        $curr_blog = $wpdb->blogid;
        $blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
        foreach ($blogids as $blog_id) {
            switch_to_blog($blog_id);
            restabookorder_uninstall_db();
        }
        switch_to_blog($curr_blog);
    } else {
        restabookorder_uninstall_db();
    }
}

function restabookorder_uninstall_db() {
    global $wpdb;
    $result = $wpdb->query("DESCRIBE $wpdb->terms `term_order`");
    if ($result) {
        $query = "ALTER TABLE $wpdb->terms DROP `term_order`";
        $result = $wpdb->query($query);
    }
    delete_option('restabookorder_install');
}
