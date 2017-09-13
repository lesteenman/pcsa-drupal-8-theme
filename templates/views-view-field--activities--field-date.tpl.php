<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>

<?php
$start = strtotime($row->field_field_date[0]['raw']['value'] . ' UTC');
$end = strtotime($row->field_field_date[0]['raw']['value2'] . ' UTC');

$format1 = 'D d M Y - H:i';
$format2 = false;

if ($start === $end) {
    // Only start date necessary
}
else if (date('Y-m-d', $start) === date('Y-m-d', $end)) {
    // Only tell diff in time
    $format2 = 'H:i';
}
else if (date('Y', $start) === date('Y', $end)) {
    // Tell month, day and time
    $format2 = 'D d M - H:i';
}
else {
    // Full date difference
    $format2 = $format1;
}

$replacements = [
    'Mon' => 'Ma',
    'Tue' => 'Di',
    'Wed' => 'Wo',
    'Thu' => 'Do',
    'Fri' => 'Vr',
    'Sat' => 'Za',
    'Sun' => 'Zo',

    'Mar' => 'Maa',
    'May' => 'Mei',
    'Oct' => 'Okt',
];

$date1 = format_date($start, 'custom', $format1);
$date2 = format_date($end, 'custom', $format2);

$date1 = str_replace(array_keys($replacements), array_values($replacements), $date1);
$date2 = str_replace(array_keys($replacements), array_values($replacements), $date2);

print $date1;
if ($format2) print '<br>tot<br>' . $date2;

?>
