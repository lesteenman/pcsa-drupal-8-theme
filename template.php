<?php

function pcsa_drupal_theme_preprocess_html(&$variables) {
	// Add bootstrap css to HTML
	drupal_add_css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array('type' => 'external'));

	// Add mobile viewport meta tag
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
	drupal_add_js('https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAWBp751VogsaCKYseOoHTEuTcTqSRsJEg', 'external');

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

function pcsa_drupal_theme_preprocess_node(&$variables) {
	// Remove 'add new comment' link from nodes.
	if (in_array($variables['type'], ['activity', 'news'])) {
		unset($variables['elements']['links']['comment']['#links']['comment-add']);
		unset($variables['content']['links']['comment']['#links']['comment-add']);
	}

	// Add regions so we can display the presence views in a node.
	if ($variables['type'] === 'activity' && !$variables['teaser']) {
		// echo("<pre>"); var_dump($variables); echo("</pre>");
		foreach (system_region_list($GLOBALS['theme']) as $region_key => $region_name) {
			// Get the content for each region and add it to the $region variable
			if ($blocks = block_get_blocks_by_region($region_key)) {
				$variables['region'][$region_key] = $blocks;
			}
			else {
				$variables['region'][$region_key] = array();
			}
		}
	}

}

/*
 *  Remove labels and add HTML5 placeholder attribute to login form
 */
function pcsa_drupal_theme_form_alter(&$form, &$form_state, $form_id) {
  if ( TRUE === in_array( $form_id, array( 'user_login', 'user_login_block') ) )
    $form['name']['#attributes']['placeholder'] = t( 'Gebruikersnaam' );
    $form['pass']['#attributes']['placeholder'] = t( 'Wachtwoord' );
    $form['name']['#title_display'] = "invisible";
    $form['pass']['#title_display'] = "invisible";
}

/*
 *  Remove login form descriptions
 */
function pcsa_drupal_theme_form_user_login_alter(&$form, &$form_state) {
    $form['name']['#description'] = t('');
    $form['pass']['#description'] = t('');
}

function pcsa_drupal_theme_theme() {
  $items = array();
  // create custom user-login.tpl.php
  $items['user_login'] = array(
  'render element' => 'form',
  'path' => drupal_get_path('theme', 'pcsa_drupal_theme') . '/templates',
  'template' => 'user-login',
  'preprocess functions' => array(
    'pcsa_drupal_theme_preprocess_user_login'
  ),
 );
return $items;
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
