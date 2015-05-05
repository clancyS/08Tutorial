<?php
/**
 * Database functions. You need to modify each of these to interact with the database and return appropriate results. 
 */

function connect($file = 'config.ini') {
	// read database seetings from config file
    if ( !$settings = parse_ini_file($file, TRUE) ) 
        throw new exception('Unable to open ' . $file);
    
    // parse contents of config.ini
    $dns = $settings['database']['driver'] . ':' .
            'host=' . $settings['database']['host'] .
            ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
            ';dbname=' . $settings['database']['schema'];
    $user= $settings['db_user']['username'];
    $pw  = $settings['db_user']['password'];

	// create new database connection
    try {
        $dbh=new PDO($dns, $user, $pw);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print "Error Connecting to Database: " . $e->getMessage() . "<br/>";
        die();
    }
    return $dbh;
}

/**
 * Check login details
 * @param string $sid Login name
 * @return boolean True if sid is for a known student within the database
 */
function checkLogin($sid) {
    $db = connect();
    try {
	    $stmt = $db->prepare('SELECT COUNT(*) FROM UniDB.Student WHERE studid=:sid');
    	$stmt->bindValue(':sid', $sid, PDO::PARAM_INT);
    	$stmt->execute();
    	$result = $stmt->fetchColumn();
    	$stmt->closeCursor();
    } catch (PDOException $e) { 
     	print "Error checking login: " . $e->getMessage(); 
     	return FALSE;
    }
    return ($result==1);
}

/**
 * Get details of a student
 * @return  row (associate array) with the details of the given student
 */
function getStudentDetails($sid) {
    $db = connect();
    try {
		$stmt = $db->prepare('SELECT name, address FROM UniDB.Student WHERE studId=:sid');
    	$stmt->bindValue(':sid', $sid, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$stmt->closeCursor();
    } catch (PDOException $e) { 
     	print "Error getting student details: " . $e->getMessage(); 
     	die();
    }
    return $row;
}

/**
 * Get details of units
 * @return array Details of units
 */
function getUnits() {
    $db = connect();
    try {
        $stmt = $db->prepare('SELECT uosCode, uosName, credits, semester, year
                                FROM UniDB.UoSOffering JOIN UniDB.UnitOfStudy USING (uosCode)
                               ORDER BY uosCode,year,semester');
        $stmt->execute();
        $results = $stmt->fetchAll(); // we expect a small result here - so Ok to use fetchAll()
        $stmt->closeCursor();
    } catch (PDOException $e) { 
     	print "Error listing units: " . $e->getMessage(); 
     	die();
    }
    return $results;
}

/**
 * List transcript for a student
 * @param integer $sid Student ID
 * @return details of units taken by student
 */
function getTranscript($sid) {
    
}
