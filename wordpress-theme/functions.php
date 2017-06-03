    <?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 28-3-2017
 * Time: 23:27
 */

if ( ! class_exists( 'Timber' ) ) {
	
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="'. esc_url( admin_url( 'plugins.php#timber' ) ) .'">'. esc_url(admin_url( 'plugins.php' ) ) .' </a></p></div>';
	});
	
	add_filter( 'template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	
	return;
	
}

Timber::$dirname = array( 'templates', 'views' );

Class Svg extends TimberSite {
	
	function __construct() {
		
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'sidebar' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_filter( 'get_search_form', array( $this, 'll_search_form') );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'after_setup_theme', array( $this, 'register_my_menu' ) );
		add_action( 'widgets_init', array( $this, 'register_sidebar' ) );
		add_action( 'init', array( $this, 'create_custom_settings' ) );
		add_action('after_setup_theme', array( $this, 'theme_slug_setup') );
		add_action( 'init', array( $this, 'svg_get_participing_partys' ) );
		
		parent::__construct();
	
	}

// Enable WP4.4+ title support.
	function theme_slug_setup() {
		add_theme_support('title-tag');
	}

	
	function register_my_menu() {
		
		register_nav_menu( 'primary', 'Primary menu, top of page' );
		
	}
	
	function register_sidebar() {
		
		register_sidebar( array (
			'name' => 'primary',
			'id' =>     'primary',
			'before_widget' => '<div class="sidebar__item">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="title__sidebar">',
			'after_title' => '</h3>',
		) );
		
	}
	
	function register_post_types(){
	
	}
	
	function register_taxonomies(){
	
	}
	
	function ll_search_form($form) {
		$context = array('site' => new TimberSite());
		$form = Timber::compile('searchform.twig', $context);
		return $form;
	}
	
	function add_to_context( $context ) {
		
		$context['menu'] = new TimberMenu();
		$context['post'] = new TimberPost();
		$context['website_titel'] = get_field("website_titel", "option");
		$context['website_slogan'] = get_field( "website_slogan", "option");
		$context['contact_email_adres'] = get_field( "contact_email_adres", "option" );
		$context['aantal_partijen'] = get_field( "max_aantal_deelnemende_partijen", "option");
		$context['deelnemende_partijen'] = $this->svg_get_participing_partys( $context['aantal_partijen'] );
		$context['site'] = $this;
		return $context;
		
	}
	
	function svg_get_participing_partys( $number_of_partys ) {
	
		$args = [
			'name' => 'deelnemende_partijen',
		];
		
		$output = 'objects';
		
		$partys = get_post_types( $args, $output );
		
		print_r( $partys );
	
	}
	
	function add_to_twig( $twig ) {
		
		
		$twig->addExtension( new Twig_Extension_StringLoader() );
		
		return $twig;
		
	}
	
}

new Svg();