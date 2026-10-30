<?php
/**
 * Database Configuration for Hospital Document Scan System
 * Centralized settings for MySQL / MariaDB connection and character set.
 */

defined('DB_HOST')    or define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
defined('DB_USER')    or define('DB_USER', getenv('DB_USER') ?: 'root');
defined('DB_PASS')    or define('DB_PASS', getenv('DB_PASS') ?: 'authen');
defined('DB_NAME')    or define('DB_NAME', getenv('DB_NAME') ?: 'hdbms');

/**
 * DB_CHARSET:
 * - 'tis620' : สำหรับเชื่อมต่อฐานข้อมูล MySQL 5 เดิมที่เป็น TIS-620
 * - 'utf8mb4' : สำหรับเมื่อย้ายฐานข้อมูลไประบบใหม่ (MariaDB 11.4 / AlmaLinux 9)
 */
defined('DB_CHARSET') or define('DB_CHARSET', getenv('DB_CHARSET') ?: 'tis620');
