<?php

function pcsa_drupal_theme_preprocess_html(&$variables) {
	// Bootstrap
	drupal_add_css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array('type' => 'external'));

	// Mobile viewport
	$viewport = array(
		'#tag' => 'meta', 
		'#attributes' => array(
			'name' => 'viewport', 
			'content' => 'width=device-width, initial-scale=1, maximum-scale=1',
		),
	);

	drupal_add_html_head($viewport, 'viewport');
}

/**
 * Override or insert variables into the page template.
 */
function pcsa_drupal_theme_preprocess_page(&$variables) {
	if($variables['page']['sidebar_first'] && $variables['page']['sidebar_second']){
		$variables['contentclass'] = 'col-sm-6 col-sm-push-3';
		$variables['firstsidebarpush'] = 'col-sm-pull-6';
	}
	elseif($variables['page']['sidebar_first'] || $variables['page']['sidebar_second']){
		if($variables['page']['sidebar_first']){
			$variables['contentclass'] = 'col-sm-9 col-sm-push-3';
			$variables['firstsidebarpush'] = 'col-sm-pull-9';		
		}
		if($variables['page']['sidebar_second']){
			$variables['contentclass'] = 'col-sm-9';
		}		
	}
	else{
		$variables['contentclass'] = 'col-sm-12';
	}
}

/*
 * Without any preprocess hook
 */
drupal_add_js('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(
	'type' => 'external',
	'scope' => 'header',
	'group' => JS_THEME,
	'every_page' => TRUE,
	'weight' => -1,
));
