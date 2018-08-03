<?php
/*
Plugin Name: Pathfinder Tools
Description: Resources for Pathfinder
Author: jWhite
Author URI: http://cheezoid.com
Version: 3.0.0
Requires at least: 4.1
Tested up to: 4.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// Plugin constants

define( 'PFT_URL', plugin_dir_url( __FILE__ ) );
define( 'PFT_DIR', plugin_dir_path( __FILE__ ) );
define( 'PFT_BASENAME', plugin_basename( __FILE__ ) );



// -----------------------------------------------------------------------------
// -- CREATE PFT PAGES ---------------------------------------------------------
// -----------------------------------------------------------------------------
function insert_pft_pages() {
	$dirs = scandir(plugin_dir_path( __FILE__ ));
	$ignore = array('.', '..', 'setup.php');
	foreach ( $dirs as $dir ) {
		if ( !in_array($dir, $ignore) ) {
			$page = get_page_by_path( $dir );
			if ( is_null( $page ) ) {
				$title = ucwords(str_replace("-", " ", $dir));
				$content = str_replace("-", "_", $dir);
				$new_page = array(
					'post_title'    => $title,
					'post_content'  => "[pft_".$content."]",
					'post_status'   => 'publish',
					'post_type'		=> 'page',
					'post_author'	=> 1,
					'post_name'		=> $dir,
				);
				wp_insert_post( $new_page );
			}
		}
	}
}
add_action('admin_init', 'insert_pft_pages');


// -----------------------------------------------------------------------------
// -- PFT LOAD FILE ------------------------------------------------------------
// -----------------------------------------------------------------------------
function pft_load_files() {
	$dirs = scandir(plugin_dir_path( __FILE__ ));
	$ignore = array('.', '..', 'setup.php');
	foreach ( $dirs as $dir ) {
		if ( !in_array($dir, $ignore) ) {
			$page = get_page_by_path($dir);
			if ( $page->ID == get_the_ID() ) {
				include(dirname(__FILE__).'/'.$dir.'/'.$dir.'.php');
				remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
				add_action( 'genesis_before_content', 'genesis_get_sidebar' );
				remove_action( 'genesis_sidebar', 'genesis_do_sidebar', 500 );
				add_action( 'genesis_sidebar', 'add_pft_sidebar' );
			}
		}
	}
}
add_action('wp', 'pft_load_files');


// -----------------------------------------------------------------------------
// -- PFT SIDEBAR --------------------------------------------------------------
// -----------------------------------------------------------------------------
function add_pft_sidebar() {	
	genesis_structural_wrap( 'sidebar' );
	do_action( 'genesis_before_sidebar_widget_area' );
?>
<section id="pft-widget-block" class="widget">
	<div class="widget-wrap">
		<?php render_pft_sidebar_content(); ?>
	</div>
</section>
<style>#nav_menu-3{display:none !important;}</style>
<?php
	do_action( 'genesis_after_sidebar_widget_area' );
	genesis_structural_wrap( 'sidebar', 'close' );
}



add_action( 'wp_ajax_pft_dice_roller', 'roll_the_dice' );
add_action( 'wp_ajax_nopriv_pft_dice_roller', 'roll_the_dice' );

function roll_the_dice() {

	$dice_qty = filter_input(INPUT_POST, 'dice_qty', FILTER_VALIDATE_INT);
	$dice_type = filter_input(INPUT_POST, 'dice_type', FILTER_VALIDATE_INT);
	$dice_keep = filter_input(INPUT_POST, 'dice_keep', FILTER_VALIDATE_INT);
	$dice_roll_qty = filter_input(INPUT_POST, 'dice_roll_qty', FILTER_VALIDATE_INT);
	$dice_type_other = filter_input(INPUT_POST, 'dice_type_other', FILTER_VALIDATE_INT);
	$tens_explode = filter_input(INPUT_POST, 'tens_explode', FILTER_VALIDATE_BOOLEAN);	
	$roll_type = filter_input(INPUT_POST, 'roll_type');
	

	if ( $dice_type == 0 && is_numeric($dice_type_other) && $dice_type_other > 0 ){
		$dice_type = $dice_type_other;
	}

	$output = '<ul class="result_set">';
	if ( $roll_type == 'tab_rollkeep' ) {
		$dice_rolled = array();
		$dice_kept = array();
		$dice_kept_raw = array();
		$ten_ct = 0;

		
		for ( $i = 0; $i < $dice_roll_qty; $i++ ) {
			$roll = mt_rand(1,10);
			$dice_rolled[] = $roll;

			$dice_kept_raw[] = $roll;
			if ( count($dice_kept_raw) > $dice_keep ) {
				$min = min($dice_kept_raw);
				$key = array_search($min, $dice_kept_raw);
				unset($dice_kept_raw[$key]);
			} 
		}

		foreach ( $dice_kept_raw as $key => $die ) {
			$dice_kept[] = $die;
			if ( $tens_explode && $die == 10 ) {
				$roll = mt_rand(1,10);
				$dice_kept[] = $roll;
				if ( $roll == 10 ) {
					$roll_2 = mt_rand(1,10);
					$dice_kept[] = $roll_2;
				}
			}
		}

		$output .= '<li><strong>'.array_sum($dice_kept).'</strong> | Rolled: ['.implode(', ', $dice_rolled).'] | Kept: ['.implode(', ', $dice_kept).']</li>';

	} else {

		for ( $i = 0; $i < $dice_qty; $i++ ) {
			$output .= '<li>'.rand(1,$dice_type).'</li>';
		}
		

	}

	$output .= '</ul>';


	$resul = array(
		'dice_kept' => $dice_kept,
		'dice_rolled' => $dice_rolled,
		'dice_total' => array_sum($dice_kept),
	);

	echo $output;

    wp_die();
}