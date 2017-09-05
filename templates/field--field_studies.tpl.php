<?php

/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used by Drupal core, which uses theme functions instead for
 * performance reasons. The markup is the same, though, so if you want to use
 * template files rather than functions to extend field theming, copy this to
 * your custom theme. See theme_field() for a discussion of performance.
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 */
?>
<!--
This file is not used by Drupal core, which uses theme functions instead.
See http://api.drupal.org/api/function/theme_field/7 for details.
After copying this file to your theme's folder and customizing it, remove this
HTML comment.
-->

<?php if (count($items) > 0): ?>

	<div class="field-studies <?php print $classes; ?>"<?php print $attributes; ?>>

	<?php foreach ($items as $item): ?>
		<?php
			$study = $item['entity']['field_collection_item'];
			$key = array_keys($study)[0];
			$study = $study[$key];

			$entity = $study['#entity'];
			$name = $entity->field_study_name['und'][0]['value'];
			$start = $end = false;
			if (property_exists($entity, 'field_study_start')) $start = $entity->field_study_start['und'][0]['value'];
			if (property_exists($entity, 'field_study_end')) $end = $entity->field_study_end['und'][0]['value'];
		?>
		<div class='field-studies-study'>
			<?=$name?><br>
			<?php if ($start || $end):?>
				<i>
				<?php if ($start):?>
					Begonnen: <?=date('m-Y', strtotime($start))?><br>
				<?php endif ?>
				<?php if ($end):?>
					Afgestudeerd: <?=date('m-Y', strtotime($end))?><br>
				<?php endif ?>
				</i>
			<?php endif ?>
		</div>
	<?php endforeach; ?>
	</div>

<?php endif ?>

