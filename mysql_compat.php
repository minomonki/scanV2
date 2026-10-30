<?php
/**
 * MySQL Compatibility Polyfill Layer for PHP 7.x & PHP 8.x
 * Emulates legacy ext/mysql functions using ext/mysqli.
 */

require_once __DIR__ . '/db_config.php';

// Suppress notices and warnings for legacy PHP 5 array key accesses
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

// Disable mysqli default exception mode (PHP 8.1+) to match legacy mysql_* warning behavior
if (function_exists('mysqli_report')) {
    @mysqli_report(MYSQLI_REPORT_OFF);
}

// Fallback constant definitions for legacy PHP 5.4 code
if (!defined('MYSQL_ASSOC')) define('MYSQL_ASSOC', defined('MYSQLI_ASSOC') ? MYSQLI_ASSOC : 1);
if (!defined('MYSQL_NUM'))   define('MYSQL_NUM',   defined('MYSQLI_NUM')   ? MYSQLI_NUM   : 2);
if (!defined('MYSQL_BOTH'))  define('MYSQL_BOTH',  defined('MYSQLI_BOTH')  ? MYSQLI_BOTH  : 3);

if (!defined('CURRENT_TIMESTAMP')) define('CURRENT_TIMESTAMP', 'CURRENT_TIMESTAMP');
if (!defined('E')) define('E', 'E');

if (!function_exists('__mysql_get_link')) {
    function __mysql_get_link($link = null) {
        if ($link instanceof mysqli) {
            return $link;
        }
        if (isset($GLOBALS['__mysql_active_link']) && $GLOBALS['__mysql_active_link'] instanceof mysqli) {
            return $GLOBALS['__mysql_active_link'];
        }
        return false;
    }
}

if (!function_exists('mysql_connect')) {
    function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0) {
        if (!function_exists('mysqli_connect')) {
            die("PHP MySQL Compatibility Error: ext/mysqli is not enabled. Please enable or install php-mysqli.\n");
        }
        if ($server === null) $server = DB_HOST;
        if ($username === null) $username = DB_USER;
        if ($password === null) $password = DB_PASS;

        $port = 3306;
        $socket = null;
        if (strpos($server, ':') !== false) {
            $parts = explode(':', $server, 2);
            $server = $parts[0];
            if (is_numeric($parts[1])) {
                $port = (int)$parts[1];
            } else {
                $socket = $parts[1];
            }
        }

        $link = @mysqli_connect($server, $username, $password, '', $port, $socket);
        if ($link) {
            $GLOBALS['__mysql_active_link'] = $link;
            if (defined('DB_CHARSET') && DB_CHARSET) {
                @mysqli_set_charset($link, DB_CHARSET);
            }
            return $link;
        }
        return false;
    }
}

if (!function_exists('mysql_pconnect')) {
    function mysql_pconnect($server = null, $username = null, $password = null, $client_flags = 0) {
        if ($server === null) $server = DB_HOST;
        return mysql_connect('p:' . $server, $username, $password, false, $client_flags);
    }
}

if (!function_exists('mysql_select_db')) {
    function mysql_select_db($database_name, $link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return false;
        return mysqli_select_db($link, $database_name);
    }
}

if (!function_exists('mysql_query')) {
    function mysql_query($query, $link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return false;
        return mysqli_query($link, $query);
    }
}

if (!function_exists('mysql_db_query')) {
    function mysql_db_query($database, $query, $link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return false;
        if (!mysqli_select_db($link, $database)) {
            return false;
        }
        return mysqli_query($link, $query);
    }
}

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result, $result_type = MYSQL_BOTH) {
        if (!($result instanceof mysqli_result)) return false;
        return mysqli_fetch_array($result, $result_type);
    }
}

if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($result) {
        if (!($result instanceof mysqli_result)) return false;
        return mysqli_fetch_assoc($result);
    }
}

if (!function_exists('mysql_fetch_row')) {
    function mysql_fetch_row($result) {
        if (!($result instanceof mysqli_result)) return false;
        return mysqli_fetch_row($result);
    }
}

if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result) {
        if (!($result instanceof mysqli_result)) return 0;
        return mysqli_num_rows($result);
    }
}

if (!function_exists('mysql_affected_rows')) {
    function mysql_affected_rows($link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return -1;
        return mysqli_affected_rows($link);
    }
}

if (!function_exists('mysql_insert_id')) {
    function mysql_insert_id($link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return 0;
        return mysqli_insert_id($link);
    }
}

if (!function_exists('mysql_data_seek')) {
    function mysql_data_seek($result, $row_number) {
        if (!($result instanceof mysqli_result)) return false;
        return mysqli_data_seek($result, $row_number);
    }
}

if (!function_exists('mysql_free_result')) {
    function mysql_free_result($result) {
        if (!($result instanceof mysqli_result)) return false;
        return mysqli_free_result($result);
    }
}

if (!function_exists('mysql_close')) {
    function mysql_close($link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return false;
        $res = mysqli_close($link);
        if ($link === ($GLOBALS['__mysql_active_link'] ?? null)) {
            unset($GLOBALS['__mysql_active_link']);
        }
        return $res;
    }
}

if (!function_exists('mysql_error')) {
    function mysql_error($link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return mysqli_connect_error() ?: '';
        return mysqli_error($link);
    }
}

if (!function_exists('mysql_errno')) {
    function mysql_errno($link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return mysqli_connect_errno();
        return mysqli_errno($link);
    }
}

if (!function_exists('mysql_real_escape_string')) {
    function mysql_real_escape_string($unescaped_string, $link_identifier = null) {
        $link = __mysql_get_link($link_identifier);
        if (!$link) return addslashes((string)$unescaped_string);
        return mysqli_real_escape_string($link, (string)$unescaped_string);
    }
}

if (!function_exists('mysql_escape_string')) {
    function mysql_escape_string($unescaped_string) {
        return mysql_real_escape_string($unescaped_string);
    }
}
