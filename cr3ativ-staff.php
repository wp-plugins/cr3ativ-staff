<?php
/**
 * Plugin Name: Cr3ativ Staff Plugin
 * Plugin URI: http://cr3ativ.com/cr3ativportfolio/profiles
 * Description: Custom written plugin to easily add staff members to your WordPress site.
 * Author: Jonathan Atkinson
 * Author URI: http://cr3ativ.com/
 * Version: 1.0.3
 */

/* Place custom code below this line. */

/* Variables */
$ja_cr3ativ_staff_main_file = dirname(__FILE__).'/cr3ativ-staff.php';
$ja_cr3ativ_staff_directory = plugin_dir_url($ja_cr3ativ_staff_main_file);
$ja_cr3ativ_staff_path = dirname(__FILE__);

/* Add css file */
function creativ_staff_add_scripts() {
	global $ja_cr3ativ_staff_directory, $ja_cr3ativ_staff_path;
		wp_enqueue_style('creativ_staff', $ja_cr3ativ_staff_directory.'css/cr3ativstaff.css');
}
		
add_action('wp_enqueue_scripts', 'creativ_staff_add_scripts');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////       WP Default Functionality       ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 980, 999999, true );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////            Theme Options Metabox            /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'includes/meta_box.php' );

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Text Domain     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_plugin_textdomain('cr3atstaff', false, basename( dirname( __FILE__ ) ) . '/languages' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Staff post type     /////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function cr3_staffsettings_admin_menu_setup(){
add_submenu_page(
 'edit.php?post_type=cr3ativstaff',
 __('Cr3ativ Staff Options', 'cr3atstaff'),
 __('Staff Options', 'cr3atstaff'),
 'manage_options',
 'cr3_staffsettings',
 'cr3_staffsettings_admin_page_screen'
 );
}
add_action('admin_menu', 'cr3_staffsettings_admin_menu_setup'); //menu setup

/* display page content */
function cr3_staffsettings_admin_page_screen() {
 global $submenu;
// access page settings 
 $page_data = array();
 foreach($submenu['options-general.php'] as $i => $menu_item) {
 if($submenu['options-general.php'][$i][2] == 'cr3_staffsettings')
 $page_data = $submenu['options-general.php'][$i];
 }

// output 
?>
<div class="wrap">
    <style>
#cr3_staffsettings_options .form-table th, #cr3_staffsettings_options .form-wrap label {
display: none;
}
#cr3_staffsettings_options label {
    cursor: pointer;
    display: block;
    float: left;
    width: 25%;
}
</style>
       

<?php screen_icon();?>
<h2><?php _e('Cr3ativ Staff Settings', 'cr3atstaff');?></h2>
<form id="cr3_staffsettings_options" action="options.php" method="post">
<?php
settings_fields('cr3_staffsettings_options');
do_settings_sections('cr3_staffsettings'); 
submit_button('Save options', 'primary', 'cr3_staffsettings_options_submit');
?>
 </form>
</div>
<?php
}

add_action('admin_init', 'cr3_staffsettings_flush' );

function cr3_staffsettings_flush(){

		if ( isset( $_POST['cr3_staffsettings_options'] ) ) {


			flush_rewrite_rules();
		
		}

} 
function cr3_staffsettings_settings_init(){

register_setting(
 'cr3_staffsettings_options',
 'cr3_staffsettings_options',
 'cr3_staffsettings_options_validate'
 );

add_settings_section(
 'cr3_staffsettings_authorbox',
 '', 
 'cr3_staffsettings_authorbox_desc',
 'cr3_staffsettings'
 );

add_settings_field(
 'cr3_staffsettings_authorbox_template',
 '', 
 'cr3_staffsettings_authorbox_field',
 'cr3_staffsettings',
 'cr3_staffsettings_authorbox'
 );
}

add_action('admin_init', 'cr3_staffsettings_settings_init');

/* validate input */
function cr3_staffsettings_options_validate($input){
 global $allowedposttags, $allowedrichhtml;
if(isset($input['authorbox_template']))
 $input['authorbox_template'] = wp_kses_post($input['authorbox_template']);
 $input['authorbox_template2'] = wp_kses_post($input['authorbox_template2']);
return $input;
}

/* description text */
function cr3_staffsettings_authorbox_desc(){
_e('Please set the slug name below for your staff single pages.  Default url for single pages is /cr3ativstaff/.  If you leave this blank, the default staff slug name will be used.', 'cr3atstaff');
}

/* filed output */
function cr3_staffsettings_authorbox_field() {
 $options = get_option('cr3_staffsettings_options');
 $authorbox = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';
 $authorbox = strip_tags($authorbox); //sanitise output
?>
<p>
    <label><?php _e('Staff Single Page Slug Name', 'cr3atstaff');?></label>
 <input type="text" id="authorbox_template" name="cr3_staffsettings_options[authorbox_template]" value="<?php echo $authorbox; ?>" /></p>

<p>

<?php
}

add_action('init', 'create_cr3ativstaff');

function create_cr3ativstaff() {
 $options = get_option('cr3_staffsettings_options');
 $authorbox = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';
 $authorbox = strip_tags($authorbox); //sanitise output	
	
	$labels = array(
		'name' => __('Staff', 'post type general name', 'cr3atstaff'),
		'singular_name' => __('Staff', 'post type singular name', 'cr3atstaff'),
		'add_new' => __('Add New', 'staff member', 'cr3atstaff'),
		'add_new_item' => __('Add New Staff Member', 'cr3atstaff'),
		'edit_item' => __('Edit Staff Member', 'cr3atstaff'),
		'new_item' => __('New Staff Member', 'cr3atstaff'),
		'view_item' => __('View Staff Member', 'cr3atstaff'),
		'search_items' => __('Search Staff', 'cr3atstaff'),
		'not_found' =>  __('Nothing found', 'cr3atstaff'),
		'not_found_in_trash' => __('Nothing found in Trash', 'cr3atstaff'),
		'parent_item_colon' => 'Staff'
	);
	
    	$cr3ativstaff_args = array(
        	'labels' => $labels,
        	'public' => true,
            'menu_icon' => 'dashicons-id-alt',
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => $authorbox), 
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail','comments')
        );
    	register_post_type('cr3ativstaff',$cr3ativstaff_args);
	}

$cr3ativstaff_fields = array(
	array(
		'label'	=> __('Staff Title', 'cr3atstaff'),
		'desc'	=> __('Enter the professional title of this staff member.', 'cr3atstaff'),
		'id'	=> 'stafftitle',
		'type'	=> 'text'
	),
	array(
		'label'	=> __('Staff Head Shot Image', 'cr3atstaff'),
		'desc'	=> __('Upload your employees head shot image here.  You should make sure your image size for these head shots are all the same height or it may cause stacking issues.', 'cr3atstaff'),
		'id'	=> 'staffheadshot',
		'type'	=> 'image'
	),
	array(
		'label'	=> __('Staff Single Page Full Width Image', 'cr3atstaff'),
		'desc'	=> __('Upload the full width image that will display on the staff single page.  Recommended size would be the full width of your inner wrapper, CSS supplied has the width at 980px.', 'cr3atstaff'),
		'id'	=> 'stafffullwidthimage',
		'type'	=> 'image'
	),
	array( // Repeatable & Sortable Text inputs
		'label'	=> __('Social Follow', 'cr3atstaff'), // <label>
		'desc'	=> __('Add as many social follows as you would like.', 'cr3atstaff'), // description
		'id'	=> 'repeatable', // field id and name
		'type'	=> 'repeatable', // type of field
		'sanitizer' => array( // array of sanitizers with matching kets to next array
			'url' => 'sanitize_text_field'
		),
		'repeatable_fields' => array ( // array of fields to be repeated
			array( // Image ID field
				'label'	=> __('Image', 'cr3atstaff'), // <label>
				'id'	=> 'repeatable_socailimage', // field id and name
				'type'	=> 'image' // type of field
			),
			'url' => array(
				'label' => __('URL', 'cr3atstaff'),
				'id' => 'repeatable_socailurl',
				'type' => 'url'
			)

		)
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$cr3ativstaff_box = new cr3ativstaff_add_meta_box( 'cr3ativstaff_box', __('Staff Data', 'cr3atstaff'), $cr3ativstaff_fields, 'cr3ativstaff', true );

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////              Staff widget                   /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'includes/staff-widget.php' );





add_filter( 'manage_edit-cr3ativstaff_columns', 'my_edit_cr3ativstaff_columns' ) ;

function my_edit_cr3ativstaff_columns( $columns ) {     

	$columns = array(
		'cb' => '<input type="checkbox" />',
        'date' => __( 'Date Created', 'cr3atstaff' ),
        'staffimage' => __( 'Head Shot' , 'cr3atstaff'),
		'title' => __( 'Name', 'cr3atstaff' ),
        'stafftitle' => __( 'Staff Title' , 'cr3atstaff'),
        'staffcontent' => __( 'Details' , 'cr3atstaff')
	);

	return $columns;
}

add_action( 'manage_cr3ativstaff_posts_custom_column', 'my_manage_cr3ativstaff_columns', 10, 2 );

function my_manage_cr3ativstaff_columns( $column, $post_id ) {
	global $post;
    $stafftitle = get_post_meta($post->ID, 'stafftitle', $single = true);
    $staffheadshot = get_post_meta($post->ID, 'staffheadshot', $single = true);
	switch( $column ) {
        
		case 'staffimage' :

			 echo wp_get_attachment_image($staffheadshot, '');
			break;
        
		case 'stafftitle' :

			printf( $stafftitle ); 

			break;
        
        case 'staffcontent' :

			 echo get_the_content();
			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

?>