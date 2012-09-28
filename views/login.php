<? include("header.php"); 
//echo ABSPATH;
include( ABSPATH.'wp-admin/includes/template.php' );
include( ABSPATH.'wp-admin/includes/post.php' );
include( ABSPATH.'wp-admin/includes/screen.php' );
// Add meta boxes
$post_type = "ims_gallery";
do_action('add_meta_boxes', $post_type, $post);
do_action('add_meta_boxes_' . $post_type, $post);
// Show Meta Boxes
do_meta_boxes( 'ims_import_box', 'normal', $post );
do_meta_boxes( 'ims_images_box', 'normal', $post );
//do_meta_boxes( $post_type, 'normal', $post );
//do_meta_boxes( $post_type, 'advanced', $post );
	define('IMSTORE_FILE_NAME', plugin_basename(ABSPATH . 'wp-content/plugins/image-store/ImStore.php'));
	define('IMSTORE_FOLDER', plugin_basename(dirname(ABSPATH . 'wp-content/plugins/image-store/ImStore.php')));
	define('IMSTORE_ABSPATH', str_replace("\\", "/", dirname(ABSPATH . 'wp-content/plugins/image-store/ImStore.php')));


		include( IMSTORE_ABSPATH . "/_inc/core.php" );
include( IMSTORE_ABSPATH . "/_inc/admin.php" );
include( IMSTORE_ABSPATH . "/_inc/galleries.php" );
global $pagenow, $ImStore;

		if (empty($pagenow))
			$pagenow = basename($_SERVER['SCRIPT_NAME']);

		$page = isset($_GET['page']) ? $_GET['page'] : false;
		$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : false;

		//load what is needed where is needed
		if (isset($_GET['taxonomy']) && isset($_GET['taxonomy']) == 'ims_album') {
			//taxonomy
			$ImStore = new ImStoreAdmin( );
		} elseif (( $pagenow == "post-new.php" && $post_type == 'ims_gallery' ) ||
		in_array($pagenow, array('post.php', 'upload-img.php'))) {
			//galleries
			include( IMSTORE_ABSPATH . "/_inc/galleries.php" );
			$ImStore = new ImStoreGallery( );
		} elseif ($post_type == 'ims_gallery' || $page == 'ims-settings') {
			//settings
			include( IMSTORE_ABSPATH . "/_inc/set.php" );
			$ImStore = new ImStoreSet( );
		} else {
			$ImStore = new ImStoreAdmin( );
		}
	
	

$ObjIM = new ImStoreGallery();

$ObjIM->gallery_init();

add_meta_box('ims_import_box', 'label', array(&$ObjIM, $key), "ims_gallery", "normal");
?>

<form action="submit.php" id="loginform">
			<fieldset>
				<section><label for="username">Username</label>
					<div><input type="text" id="username" name="username" autofocus></div>
				</section>
				<section><label for="password">Password <a href="#">lost password?</a></label>
					<div><input type="password" id="password" name="password"></div>
					<div><input type="checkbox" id="remember" name="remember"><label for="remember" class="checkbox">remember me</label></div>
				</section>
				<section>
					<div><button class="fr submit">Login</button></div>
				</section>
			</fieldset>
</form>


<? include("footer.php"); ?>