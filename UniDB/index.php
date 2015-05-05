<?php 
/**
 * Home page giving details of a specific user
 */
require_once('include/common.php');
require_once('include/database.php');

startValidSession();
$student = getStudentDetails($_SESSION['sid']);
htmlHead();
?>

<h1>Home</h1>
<p>Congratulations, you successfully connected to the database.</p>

<h2>Student Details</h2>

<strong>Name:</strong>    <?php echo $student['name'];    ?><br/>
<strong>Address:</strong> <?php echo $student['address']; ?>

<?php 
htmlFoot();
?>