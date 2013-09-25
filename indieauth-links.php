<?php
/*
Plugin Name: indieAuth Links
Plugin URI: http://jihais.se
Description: indieAuth Links
Author: Jean-Sébastien Mansart
Author URI: http://jihais.se
Version: 0.1
License: GPL2++
*/

// Plugin uninstall: delete option
register_uninstall_hook( __FILE__, 'indieauth_links_uninstall' );
function indieauth_links_uninstall() {
	delete_option( 'indieauth_links' );
}

// Add a "Settings" link in the plugins list
add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), 'indieauth_links_settings_action_links', 10, 2 );
function indieauth_links_settings_action_links( $links, $file ) {
	$settings_link = '<a href="' . admin_url( 'options-general.php?page=indieauth_links_options' ) . '">' . __("Settings") . '</a>';
	array_unshift( $links, $settings_link );

	return $links;
}

//The add_action to add onto the WordPress menu.
add_action('admin_menu', 'indieauth_links_add_options');
function indieauth_links_add_options() {
	$page = add_submenu_page( 'options-general.php', 'indieAuth Links options', 'indieAuth Links', 'manage_options', 'indieauth_links_options', 'indieauth_links_options_page' );
	register_setting( 'indieauth-links', 'indieauth_links');
}

// Settings page
function indieauth_links_options_page() {
	$opts = indieauth_links_get_options();
	?>
	<h1>IndieAuth Links configuration</h1>
	<p>Add links to your profiles</p>
	<form id="indieauth-links-form" method="post" action="options.php">
		<?php settings_fields('indieauth-links'); ?>
		<p>
			<label for="github">GitHub :</label>
			<input id="github" type="text" name="indieauth_links[github]" class="regular-text" value="<?php echo htmlspecialchars($opts['github']); ?>" />
		</p>
		<p>
			<label for="google">Google :</label>
			<input id="google" type="text" name="indieauth_links[google]" class="regular-text" value="<?php echo htmlspecialchars($opts['google']); ?>" />
		</p>
		<p>
			<label for="appnet">App.net :</label>
			<input id="appnet" type="text" name="indieauth_links[appnet]" class="regular-text" value="<?php echo htmlspecialchars($opts['appnet']); ?>" />
		</p>
		<p>
			<label for="geoloqi">Geoloqi :</label>
			<input id="geoloqi" type="text" name="indieauth_links[geoloqi]" class="regular-text" value="<?php echo htmlspecialchars($opts['geoloqi']); ?>" />
		</p>
		<p>
			<label for="twitter">Twitter :</label>
			<input id="twitter" type="text" name="indieauth_links[twitter]" class="regular-text" value="<?php echo htmlspecialchars($opts['twitter']); ?>" />
		</p>
		<?php submit_button(null, 'primary', '_submit'); ?>
	</form>
	<?php
}

// function to add markup in head section of post types
if(!function_exists( 'add_indieauth_links' )) {

	function add_indieauth_links() {
		global $post;	
		/* get options */          		
		$opts = indieauth_links_get_options(); 	
		if ( is_front_page()||is_home()) {
			echo "\n".'<!-- indieAuth Links -->'."\n";
			
			if ( isset($opts['github']) && !empty($opts['github']))  	                   					
			echo '<link rel="me" href="'.htmlspecialchars($opts['github']).'" />'."\n";
			
			if ( isset($opts['google']) && !empty($opts['google']))
			echo '<link rel="me" href="'.htmlspecialchars($opts['google']).'" />'."\n";
			
			if ( isset($opts['appnet']) && !empty($opts['appnet']))
			echo '<link rel="me" href="'.htmlspecialchars($opts['appnet']).'" />'."\n";
			
			if ( isset($opts['geoloqi']) && !empty($opts['geoloqi']))
			echo '<link rel="me" href="'.htmlspecialchars($opts['geoloqi']).'" />'."\n";
			
			if ( isset($opts['twitter']) && !empty($opts['twitter']))
			echo '<link rel="me" href="'.htmlspecialchars($opts['twitter']).'" />'."\n";
			
			echo '<!-- /indieAuth Links -->'."\n\n"; 
		} 
	}
}
add_action( 'wp_head', 'add_indieauth_links', 99);


function indieauth_links_get_service_url($service){
	$services = array(
		"github" => "https://github.com",
		"google" => "https://plus.google.com",
		"appnet" => "https://app.net",
		"geoloqi" => "https://geoloqi.com",
		"twitter" => "https://twitter.com"
	);
	return $services[$service];
}

function indieauth_links_secureLink($url, $service){
	$url = str_replace('http://', 'https://', $url );
	if (preg_match("/".$service."?/", $url) === 0 && $url !== ''){
		$url = indieauth_links_get_service_url($service)."/".$url;
		if ($service === 'twitter'){
			$url = str_replace('@', '', $url);
		}
	}
	if (preg_match("/https?/", $url) === 0 && $url !== '') {
    	$url = 'https://'.$url;
	}
	return $url;
}

// Retrieve and sanitize options
function indieauth_links_get_options() {
	$options = get_option( 'indieauth_links' );
	return indieauth_links_sanitize_options($options);
}

// Sanitize options
function indieauth_links_sanitize_options($options) {
	$new = array();

	if ( !is_array($options) )
	return $new;

	if ( isset($options['github']) )
	$new['github'] = indieauth_links_secureLink($options['github'], 'github');
	
	if ( isset($options['google']) )
	$new['google'] = indieauth_links_secureLink($options['google'], 'google');
	
	if ( isset($options['appnet']) )
	$new['appnet'] = indieauth_links_secureLink($options['appnet'], 'appnet');
	
	if ( isset($options['geoloqi']) )
	$new['geoloqi'] = indieauth_links_secureLink($options['geoloqi'], 'geoloqi');
	
	if ( isset($options['twitter']) )
	$new['twitter'] = indieauth_links_secureLink($options['twitter'], 'twitter');
	
	return $new;
}
?>