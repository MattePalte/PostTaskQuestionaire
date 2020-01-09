<html>
<?php

    session_start(); // start up your PHP session!
    $_SESSION = null;
    session_unset();
    session_destroy() ; // destroy your PHP session!
    echo "Successfully logged out. <br>";
    echo "Go back to <a href='index.php'>home</a>";

?>
</html>