<?php 
/**
 * Web page to display available units of study
 */
require_once('include/common.php');
require_once('include/database.php');
startValidSession();
htmlHead();
?>
<h1>List Units</h1>
<?php 
try {
    $units = getUnits();
?>
<form action="listunits.php" method="get">
<label>Lecturer<input type=text value="<?php echo $_GET['lecturer'];?>"name="lecturer" /></label><br />
<input type=submit value="Search"/>
</form>
<table>
<thead>
<tr><th>uosCode</th><th>uosName</th><th>credits</th><th>year</th><th>semester</th></tr>
</thead>
<tbody>
<?php
foreach($units as $unit) {
    echo '<tr><td>',$unit['uoscode'],'</td><td>',$unit['uosname'],'</td>',
            '<td>',$unit['credits'],'</td><td>',$unit['year'],'</td>',
            '<td>',$unit['semester'],'</td></tr>';
}
?>
</tbody>
</table>
<?php
} catch (Exception $e) {
        echo 'Cannot get available units';
}
htmlFoot();
?>
