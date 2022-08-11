<?php
session_start();
include 'DBConn.php';
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();

header('location: admin-login.php');

?>

</body>
</html>