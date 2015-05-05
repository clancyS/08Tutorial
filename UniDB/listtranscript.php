<?php 
/**
 * Web page to display student transcript
 */
require_once('include/common.php');
require_once('include/database.php');

startValidSession();
htmlHead();
?>

<h1>Student Transcript</h1>
<?php 
try {
    $transcript = getTranscript($_SESSION['sid']);
?>

<table>
<thead>
<tr><th>uosCode</th><th>uosName</th><th>credits</th><th>year</th><th>semester</th><th>grade</th></tr>
</thead>
<tbody>
<?php
foreach($transcript as $unit) {
    echo '<tr><td>',$unit['uoscode'],'</td><td>',$unit['uosname'],'</td>',
            '<td>',$unit['credits'],'</td><td>',$unit['year'],'</td>',
            '<td>',$unit['semester'],'</td><td>',$unit['grade'],'</td></tr>';
}
?>
</tbody>
</table>

<?php
} catch (Exception $e) {
        echo 'Cannot get transcript';
}
htmlFoot();
?>
