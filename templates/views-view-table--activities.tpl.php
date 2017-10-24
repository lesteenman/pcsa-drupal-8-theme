<?php

/**
 * @file
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $caption: The caption for this table. May be empty.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $classes: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 * @ingroup views_templates
 */
?>

<script language='javascript'>
activity_set_presence = function(selector, original, present, absent, unknown) {
  if (selector.value == '') return;

  var url;
  if (selector.value == 'present') url = present;
  else if (selector.value == 'absent') url = absent;
  else if (selector.value == 'unknown') url = unknown;
  window.location = url;
}
</script>

<table class="<?php if ($classes) { print $classes; } ?> activities" <?php print $attributes; ?>>
   <?php if (!empty($title) || !empty($caption)) : ?>
     <caption><?php print $caption . $title; ?></caption>
  <?php endif; ?>
  <thead>
    <tr>
      <th class='header-date'>Datum</th>
      <th class='header-title'>Activiteit</th>
      <?php if ($view->current_display === 'activities_upcoming'): ?>
        <th class='header-presence'>Aanwezig?</th>
      <?php endif; ?>
      <th class='header-location'>Locatie</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row_count => $row): ?>
      <tr>
        <!-- Date/time -->
        <td class='column-date'><?=render($row['field_date'])?></td>

        <!-- Title -->
        <td class='column-title'><?php
          print render($row['title']);
          if ($row['comment_count']) {
            print ' (';
            $read = $row['comment_count'] - ($row['new_comment_count'] ?? 0);
            if ($read) print $read;
            if ($row['new_comment_count'] ?? false) {
                print '<b>';
                if ($read) print ' + ';
                print $row['new_comment_count'] . '</b>';
            }
            print ')';
          }
        ?></td>

        <?php if ($view->current_display === 'activities_upcoming'): ?>

          <?php
            preg_match('/href="(.+?)"/', $row['ops'], $present_match);
            preg_match('/href="(.+?)"/', $row['ops_1'], $absent_match);
            preg_match('/href="(.+?)"/', $row['ops_2'], $unknown_match);
            $flag_present = ($present_match[1] ?? null);
            $flag_absent = ($absent_match[1] ?? null);
            $flag_unknown = ($unknown_match[1] ?? null);

            $value = '';
            if ($row['flagged']) $value = 'present';
            else if ($row['flagged_1']) $value = 'absent';
            else if ($row['flagged_2']) $value = 'unknown';
          ?>

          <!-- Presence -->
          <td class='column-presence'>
            <select id="activity-presence-<?=$row_count?>" onchange="activity_set_presence(this, '<?=$value?>', '<?=$flag_present?>', '<?=$flag_absent?>', '<?=$flag_unknown?>');">
              <?php if ($value === ''): ?><option value="" selected></option><?php endif; ?>
              <option value="present" <?= $value == 'present' ? 'selected' : ''?>>Ja</option>
              <option value="absent"= <?= $value == 'absent' ? 'selected' : ''?>>Nee</option>
              <option value="unknown"= <?= $value == 'unknown' ? 'selected' : ''?>>Onbekend</option>
            </select>
          </td>

        <?php endif; ?>

        <!-- Location -->
	      <td class='column-location'><?php
          $location_heer = $row['field_location_user'];
          $location_addr = $row['field_activity_location_thoroughfare'];
		      if ($location_heer) {
			      print $location_heer;
		      }
		      else if ($location_addr) {
			      print $location_addr;
		      }
		      else {
    	      print 'Onbekend';
		      }
	      ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

