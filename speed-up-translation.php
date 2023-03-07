<?php
/*
 Plugin Name: Speed Up - Translation Cache
 Plugin URI: http://wordpress.org/plugins/speed-up-translation/
 Description: The translations reduces speed of Wordpress. This plugin offers a caching solution that reduces this effects on performance.
 Version: 1.2.0
 Author: Simone Nigro + Thomas Weyn
 Author URI: https://profiles.wordpress.org/nigrosimone
 License: GPLv2 or later
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( !defined('ABSPATH') ) exit;


class SpeedUp_Translation {

    private $transientKey = 'sut';

    /**
     * Instance of the object.
     * 
     * @since  1.0.0
     * @static
     * @access public
     * @var null|object
     */
    public static $instance = null;

    /**
     * Access the single instance of this class.
     *
     * @since  1.0.0
     * @return SpeedUp_Translation
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     * 
     * @since  1.0.0
     * @return SpeedUp_Translation
     */
    private function __construct(){

        if( !is_admin() ){
            add_filter('override_load_textdomain', array($this, 'cache_textdomain' ), PHP_INT_MAX, 3);
        }
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_action_speed_up_translation_delete_transients', array( $this, 'delete_transients') );
    }


    function admin_menu() {
        $hook = add_management_page( 'Speed Up Translation', 'Speed Up Translation', 'install_plugins', 'speed_up_translation', array( $this, 'admin_page' ), '' );
        add_action( "load-$hook", array( $this, 'admin_page_load' ) );
    }


    function admin_page_load() {
        // ...
    }

    function admin_page() {
        include __DIR__.'/admin.php';
    }

    function delete_transients() {
        global $wpdb;
        $query = $wpdb->get_col($wpdb->prepare("
                SELECT option_name
                FROM $wpdb->options
                WHERE option_name LIKE %s
                   OR option_name LIKE %s
            ",
            $wpdb->esc_like( '_transient_'.$this->transientKey.':' ) . '%',
            $wpdb->esc_like( '_site_transient_'.$this->transientKey.':' ) . '%'
        ));
        if ( $query ) {
            foreach ( $query as $transient ) {
                echo "<p>Deleting $transient</p>"; flush();
                if ( strpos( $transient, '_site_transient_' ) === 0 ) {
                    delete_site_transient( substr($transient, 16 ) );
                } else {
                    delete_transient( substr($transient, 11 ) );
                }
            }
        }
        wp_redirect( $_SERVER['HTTP_REFERER'].'&success=1' );
    }
    
    /**
     * Cache the textdomain.
     * 
     * @param boolean $override
     * @param  string  $domain
     * @param string $mofile
     * @return boolean
     *@since  1.0.0
     */
    public function cache_textdomain(bool $override, string $domain, string $mofile): bool
    {
    
        global $l10n;
        
        // Creates a unique key for cache
        $key = $this->transientKey.':'.$domain.':'.$mofile;
    
        // Try to retrive data from cache
        $data = get_transient($key);
    
        // Retrieve the last modified date of the translation files
        $mtime = @filemtime($mofile);
    
        $mo = new \MO();
    
        // if cache not return data or data it's old
        if ( $mtime && (!$data || (isset($data['mtime']) && $mtime > $data['mtime']) )) {
            // retrive data from MO file
            if ( $mo->import_from_file( $mofile ) ){
    
                $data = array(
                    'mtime'   => $mtime,
                    'entries' => $mo->entries,
                    'headers' => $mo->headers
                );
    
                // save data in cache
                set_transient($key, $data);
    
            } else {
                return false;
            }
    
        } else if($data) {
            $mo->entries = $data['entries'];
            $mo->headers = $data['headers'];
        }
    
        if ( isset( $l10n[$domain] ) ) {
            $mo->merge_with( $l10n[$domain] );
        }
    
        $l10n[$domain] = &$mo;
    
        return true;
    }
}

// Init
SpeedUp_Translation::get_instance();
