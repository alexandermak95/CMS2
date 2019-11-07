<?php
class Cookie_Banner {
	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {
		if (defined('COOKIE_BANNER_VERSION')) {
			$this->version = COOKIE_BANNER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'cookie-banner';

		$this->load_dependencies();
		$this->define_public_hooks();

	}

	private function load_dependencies() {

		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-cookie-banner-loader.php';

		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-cookie-banner-public.php';

		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/cookie-banner-public-display.php';

		$this->loader = new Cookie_Banner_Loader();

	}

	private function define_public_hooks() {

		$plugin_public = new Cookie_Banner_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
