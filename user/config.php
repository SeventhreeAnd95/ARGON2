<?php
define('MYSQL_HOST', 'localhost');
define('MYSQL_USERNAME', 'ambredm2_loanservices');
define('MYSQL_PASSWORD', '3WbpulWaqA}{');
define('DB_NAME', 'ambredm2_Ambrevia');

try {
    $conn = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, DB_NAME);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
} catch (mysqli_sql_exception $exception) {
    error_log('MySQL Connection Error: ' . $exception->getMessage());
}

?>
