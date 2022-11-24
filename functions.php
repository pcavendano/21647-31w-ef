<?php
/**
 * underscore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package underscore
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
/* ///////////////////////////////////// Inclusion du customizer de background-color */
require_once("options/apparence.php");


//////////////////////////////////////////////////
function underscore_setup() {

    	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height' => 150,
		'width'  => 150,
	) );

	add_theme_support( 'post-thumbnails' );


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
}    
add_action( 'after_setup_theme', 'underscore_setup' );


/**
 * Enqueue scripts and styles.
 */
function underscore_scripts() {
	/*
	wp_enqueue_style( 'underscore-style',
					   get_stylesheet_uri(), 
					   array(),
					_S_VERSION );
	*/				

	wp_enqueue_style('underscore-style',
					 get_template_directory_uri() . '/style.css',
					 array(), 
					 filemtime(get_template_directory() . '/style.css'), false);
/*
					 wp_enqueue_style( 'google-fonts',
					  'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap',
					   false );	
*/					   			 
	
}
add_action( 'wp_enqueue_scripts', 'underscore_scripts' );


/* ----------------------------------------- Initialisation de la fonction de menu */

function mon_31w_register_nav_menu(){
	register_nav_menus( array(
		'menu_primaire' => __( 'Menu Primaire', 'text_domain' ),
	
	) );
}
add_action( 'after_setup_theme', 'mon_31w_register_nav_menu', 0 );


/**
 * filtre le menu «aside»
 * @arg  $obj_menu, $arg
 */
function igc31w_filtre_choix_menu($obj_menu, $arg){
    //echo "/////////////////  obj_menu";
    // var_dump($obj_menu);
    //  echo "/////////////////  arg";
    //  var_dump($arg);
 
    if ($arg->menu == "aside"){
    foreach($obj_menu as $cle => $value)
    {
      //  print_r($value);
	  /* retirer le sigle numérique du cours */
       $value->title = substr($value->title,7);
	   /* retirer la durée du cours ex: (75h) */
	   $value->title = substr($value->title,0,strpos($value->title, '('));
       $value->title = wp_trim_words($value->title,3," ... ");
        //echo $value->title . '<br>';
     } 
    }
    //die();
    return $obj_menu;
}

add_filter("wp_nav_menu_objects","igc31w_filtre_choix_menu", 10,2);

/* ----------------------------------------------------------- Ajout de la description dans menu */
/** filtre du menu evenement
 * @arg  string $item_output  string représentant l'élément du menu
 * @arg obj $item    element du menu
 */
function prefix_nav_description( $item_output, $item) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( '</a>',
        '<hr><span class="menu-item-description">' . $item->description . '</span><div class="menu__item__icone"></div></a>',
              $item_output );
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 2 );
// l'argument 10 : niveau de privilège
// l'argument 2 : le nombre d'argument dans la fonction de rappel: «prefix_nav_description»




/* -------------------------------------------------------- Initialisation des sidebar */

add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	/* Register the 'footer-1' sidebar. */
	register_sidebar(
		array(
			'id'            => 'footer-1',
			'name'          => __( 'Sidebar - footer-1' ),
			'description'   => __( 'Premier sidebar du footer' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'footer-2',
			'name'          => __( 'Sidebar - footer-2' ),
			'description'   => __( 'Deuxième sidebar du footer' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);


	register_sidebar(
		array(
			'id'            => 'footer-3',
			'name'          => __( 'Sidebar - footer-3' ),
			'description'   => __( 'Troisième sidebar du footer' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'footer-4',
			'name'          => __( 'Sidebar - footer-4' ),
			'description'   => __( 'Quatrième sidebar du footer' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

		register_sidebar(
		array(
			'id'            => 'aside-1',
			'name'          => __( 'Sidebar - aside-1' ),
			'description'   => __( 'Premier aside ' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);


			register_sidebar(
		array(
			'id'            => 'aside-2',
			'name'          => __( 'Sidebar - aside-2' ),
			'description'   => __( 'Deuxième aside ' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	/* Repeat register_sidebar() code for additional sidebars. */
}

register_sidebar(
	array(
		'id'            => 'header-1',
		'name'          => __( 'Sidebar - header-1' ),
		'description'   => __( 'Premier header aside ' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-recherche">',
		'after_title'   => '</h3>',
	)
);

register_sidebar(
	array(
		'id'            => 'header-2',
		'name'          => __( 'Sidebar - header-2' ),
		'description'   => __( 'Deuxième header aside ' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-medias-sociaux">',
		'after_title'   => '</h3>',
	)
);

/**
 *
 *	La fonction permettra de modifier la requête principale de wordpress « main query »
 *	Les artcle qui s'afficheront dans la page d'accueil seront les article de catégorie « accueil »
 *
 */
	function igc_31w_filtre_requete( $query ) {
		if ( $query->is_home() 
			&& $query->is_main_query() 
			&& ! is_admin() ) {
			$query->set( 'category_name', 'accueil' );
		}
	}
	add_action( 'pre_get_posts', 'igc_31w_filtre_requete' );
