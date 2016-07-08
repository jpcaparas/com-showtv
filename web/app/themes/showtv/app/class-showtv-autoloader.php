<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ShowTV Autoloader.
 *
 * @class        ST_Autoloader
 * @version        0.0.1
 * @package        ShowTV/Classes
 * @category    Class
 * @author        JP Caparas
 */
class ShowTV_Autoloader
{
    /**
     * Path to the includes directory.
     *
     * @var string
     */
    private $include_path = '';

    /**
     * The Constructor.
     */
    public function __construct()
    {
        if (function_exists("__autoload")) {
            spl_autoload_register("__autoload");
        }

        spl_autoload_register(array($this, 'autoload'));

        $this->include_path = trailingslashit(plugin_dir_path(__FILE__)) . 'includes/';
    }

    /**
     * Take a class name and turn it into a file name.
     *
     * @param  string $class
     * @return string
     */
    private function get_file_name_from_class($class)
    {
        return 'class-' . str_replace('_', '-', $class) . '.php';
    }

    /**
     * Include a class file.
     *
     * @param  string $path
     * @return bool successful or not
     */
    private function load_file($path)
    {
        if ($path && is_readable($path)) {
            include_once($path);
            return true;
        }
        return false;
    }

    /**
     * Auto-load WC classes on demand to reduce memory consumption.
     *
     * @param string $class
     */
    public function autoload($class)
    {
        $class = strtolower($class);
        $file = $this->get_file_name_from_class($class);
        $path = '';

        if (strpos($class, 'showtv_meta_box') === 0) {
            $path = $this->include_path . 'admin/meta-boxes/';
        }

        if (strpos($class, 'showtv_api') === 0) {
            $path = $this->include_path . 'api/';
        }

        if (strpos($class, 'showtv_hook') === 0) {
            $path = $this->include_path . 'hooks/';
        }

        if (strpos($class, 'showtv_virtual_page') === 0) {
            $path = $this->include_path . 'virtual-pages/';
        }

        if (empty($path) || (!$this->load_file($path . $file) && strpos($class, 'showtv_') === 0)) {
            $this->load_file($this->include_path . $file);
        }
    }
}

new ShowTV_Autoloader();