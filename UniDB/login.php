<?php 
/**
 * Login page
 * Users visiting the site via index.php are redirected to this login page, where
 * they must enter their username and password. Successful login starts a new session and
 * redirection to main content in index.php.
 */
require_once('include/database.php');
require_once('include/common.php');

/**
 * Clean up after user logs out 
 */
function log_out() {
    $_SESSION['sid'] = '';
    $_SESSION['logged_in'] = false;
}

/**
 * Process a user's login details
 * @param string $name student ID
 * @return boolean true if login details are correct, else false 
 */
function log_in($sid) {
    $is_valid = checkLogin($sid);
    if ($is_valid) {
        $_SESSION['logged_in'] = true;
        $_SESSION['sid'] = $sid;
    }
    return $is_valid;
}

// Start session from scratch
session_start();
log_out();

// Messages to display to user if returning to page
$message='';

//
// Process login details (must be POST data) and redirect to main site if correct
//
if ( isset($_POST['sid']) ) {
    try {
        if ( log_in($_POST['sid']) ) {
            // Success so redirect to desired page
            redirectTo('index.php');
        } else {
            $message='Login details incorrect. Please try again.';
        }
    } catch (Exception $e) {
        $message=$e->getMessage();
    }
} 

//
// If user hasn't submitted login details, or if they are incorrect, they will see
// the following page.
//

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>University Client Login</title>
    <link rel="stylesheet" type="text/css" href="css/unidb.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div id="wrapper">
    <div id="content">
      <h1>University Client</h1>
      <div id="login">
        <form action="<?php echo 'login.php?',http_build_query($_GET); ?>" id="loginform" method="post">
            <label>Student ID: <input type=text name="sid" /></label><br />
            <input type=submit value="Log in"/>
        </form>
        <div id="message"><?php echo $message; ?></div>
      </div>
    </div>
    </div>
    <div id="footer"></div>
</body>
</html>