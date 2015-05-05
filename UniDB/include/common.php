<?php
/**
 * Common functionality across web pages
 */

/// Redirect to login page if not logged in
function startValidSession() {
    session_start();
    if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true ) {
        redirectTo('login.php');
    }
}

// redirect to given page
function redirectTo($target) {
    // Pass on query parameters
    $qstring = http_build_query($_GET);
    if(!empty($qstring)) {
        $target = $target.'?'.$qstring;
    }
    header('Location:'.$target);
    exit;
}

/// Output top material common to each page
function htmlHead() {
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>University Client</title>
    <link rel="stylesheet" type="text/css" href="css/unidb.css" />
</head>
<body>
<div id="wrapper">
    <ul id="nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="listunits.php">listUnits</a></li>
        <li><a href="listtranscript.php">listTranscript</a></li>
        <li><a href="login.php">Quit</a></li>
    </ul>
    <div id="content">

<?php
}

/// Output bottom material common to each page
function htmlFoot() {
?>
    </div>
    <div id="push"></div>
</div>
<div id="footer">
</div>
</body>
</html>
<?php
}
?>