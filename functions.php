<?php
/**
 * Underscores.me functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Underscores.me
 */

if ( ! defined( 'UNDERSCORESME_VERSION' ) ) {
	define( 'UNDERSCORESME_VERSION', '1.0.0' );
}

if ( ! function_exists( 'underscoresme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function underscoresme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Underscores.me, use a find and replace
		 * to change 'underscoresme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'underscoresme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'underscoresme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'underscoresme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'underscoresme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function underscoresme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'underscoresme_content_width', 640 );
}
add_action( 'after_setup_theme', 'underscoresme_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function underscoresme_scripts() {
	wp_enqueue_style( 'underscoresme-style', get_stylesheet_uri(), array(), UNDERSCORESME_VERSION );
	wp_enqueue_script( 'underscores-scripts', get_template_directory_uri() . '/js/underscores-scripts.js', array(), UNDERSCORESME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscoresme_scripts' );

/**
 * Returns an array of contributors from Github.
 */
function underscoresme_get_contributors() {

	$transient_key = 'underscoresme_contributors';
	$contributors  = get_transient( $transient_key );
	if ( false !== $contributors ) {
		return $contributors;
	}

	$response = wp_remote_get( 'https://api.github.com/repos/Automattic/_s/contributors?per_page=100' );
	if ( is_wp_error( $response ) ) {
		return array();
	}

	$contributors = json_decode( wp_remote_retrieve_body( $response ) );
	if ( ! is_array( $contributors ) ) {
		return array();
	}

	set_transient( $transient_key, $contributors, HOUR_IN_SECONDS );

	return (array) $contributors;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Underscores.me generator pseudo-plugin
 */
require get_template_directory() . '/plugins/underscoresme-generator/class-underscoresme-generator.php';
