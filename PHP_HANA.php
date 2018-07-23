<?php
/**
 * Basic connection to SAP HANA from PHP


/ *
 * 1. ODBC extension needs to be enabled
 * 2. SAP HANA's HDBODBC driver needs to be installed on the host
 */

/**
 * 1. Enable the ODBC by changing the php.ini (enabling the odbc extensions)
 */

/*
In Windows (php.ini)
extension=php_pdo_odbc.dll
extension=php_odbc.dll

In Linux (php.ini)
extension=php_pdo_odbc.so
extension=php_odbc.so
*/


/**
 * 2. HANA ODBC Connection
 */

$driver = 'HDBODBC';

// Host
//
$host = "10.70.177.14:30015";

// Default name of your hana instance
$db_name = "CH1";

// Username
$username = 'SANYAM_K';

// Password
$password = "Welcome@123";

// Try to connect
$conn = odbc_connect("Driver=$driver;ServerNode=$host;Database=$db_name;", $username, $password, SQL_CUR_USE_ODBC);

if (!$conn)
{
    // Try to get a meaningful error if the connection fails
    echo "Connection failed.\n";
    echo "ODBC error code: " . odbc_error() . ". Message: " . odbc_errormsg();

    /*
     * Typical errors include
     *
     * Error code: S1000
     * General error;416 user is locked; try again later: lock time is 1440
     * Too many unsuccessful login attempts
     * Solution: wait and try again with other credentials
     *
     * Error code: 08S01
     * Communication link failure;-10709 Connection failed (RTE:[89006] Syste, SQL state 08S01 in SQLConnect
     * Solution: check your connection details, host, port.
     */
}
else
{
    // Do a basic select from DUMMY with is basically a synonym for SYS.DUMMY
    $sql = 'SELECT * FROM DUMMY';
    $result = odbc_exec($conn, $sql);
    if (!$result)
    {
        echo "Error while sending SQL statement to the database server.\n";
        echo "ODBC error code: " . odbc_error() . ". Message: " . odbc_errormsg();
    }
    else
    {
        while ($row = odbc_fetch_object($result))
        {
            // Should output one row containing the string 'X'
            var_dump($row);
        }
    }
    odbc_close($conn);
}
?>

