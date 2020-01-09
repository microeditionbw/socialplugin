<?php

class Content_messenger {

/**
* A reference to the class for retrieving our option values.
*
* @access private
* @var Deserializer
*/
private $deserializer;

/**
* Initializes the class by setting a reference to the incoming deserializer.
*
* @param Deserializer $deserializer Retrieves a value from the database.
*/
public function __construct( $deserializer ) {
$this->deserializer = $deserializer;
}
/**
* Initializes the hook responsible for prepending the content with the
* option created on the options page.
*/
public $buttons_show_items="";
public function init() {
	$this->scripts();
	$this->stylesheet();
	add_filter( 'the_content', array( $this, 'display' ) );
}

public function display($content) {
	include MY_PLUGIN_PATH . '/params.php';
	$buttons_show=$this->deserializer->get_value( 'tutsplus-custom-data' );
	foreach ($buttons as $key => $button) { if($buttons_show{$key}==1) { $buttons_show_items .="{$button},"; } }
	if($buttons_show_items!=NULL)
	{
		$share = '<footer class="renym-content-footer"><hr/><p>Поделиться</p><div class="ya-share2" data-services="' . $buttons_show_items . '"></div></footer>';
	}
	return $content . $share;
}

public function scripts()
{
	add_action('wp_enqueue_scripts', function() {
	    wp_enqueue_script( 'v2b-es5-shims', "//yastatic.net/es5-shims/0.0.2/es5-shims.min.js", null, null, true);
	    wp_enqueue_script( 'v2b-share', "//yastatic.net/share2/share.js", null, null, true);
	    wp_enqueue_script( 'custom-social', plugins_url( '/js/custom-social.js', __FILE__ ), array( 'jquery'));
	});
	//admin too
	add_action('admin_enqueue_scripts', function() {
	    wp_enqueue_script( 'v2b-es5-shims', "//yastatic.net/es5-shims/0.0.2/es5-shims.min.js", null, null, true);
	    wp_enqueue_script( 'v2b-share', "//yastatic.net/share2/share.js", null, null, true);
	    wp_enqueue_script( 'custom-social', plugins_url( '/js/custom-social.js', __FILE__ ), array( 'jquery'));
	});
}

public function stylesheet()
{
	add_action('admin_head', function() { ?>
	<style type="text/css">
		div.social-buttons
		{
			padding: 5px;
		}
		div.social-buttons div
		{
			display: inline-block;
			margin: 2px;
			padding: 15px;
			border: 1px solid gray;
			border-radius: 5px;
		}
		div.social-buttons div:hover
		{
			cursor: pointer;
		}
		div.social-buttons .social-enabled
		{
			color: #fff; 
			text-decoration: none;
			user-select: none;
			background: rgb(212,75,56);
			outline: none; 
		}
		.ya-share2.ya-share2_inited 
		{
		    display: inline-block;
		}
	</style>
	<? });
}

}