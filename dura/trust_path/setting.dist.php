<?php

define('DURA_DEBUG', false);

/**
 * Admin
 */
define('DURA_ADMIN_NAME', 'admin');
define('DURA_ADMIN_PASS', 'admin');

// commet this line if u need set DURA_URL
define('DURA_URL', 'http' . ($_SERVER['HTTPS'] ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . (((!$_SERVER['HTTPS'] && $_SERVER['SERVER_PORT'] == 80) || ($_SERVER['HTTPS'] && $_SERVER['SERVER_PORT'] == 8080)) ? '' : ':' . $_SERVER['SERVER_PORT']) . dirname($_SERVER["PHP_SELF"]));

/**
 * URL & Path
 */
!defined('DURA_URL') && define('DURA_URL', 'http://www.example.com'); // DO NOT ADD SLASH TO END.
define('DURA_PATH', dirname(__file__) . '/../');

/**
 * Trust Path directory sould be put outside of Document Root.
 */
define('DURA_TRUST_PATH', DURA_PATH . '/trust_path');
define('DURA_PATH_DATA', DURA_TRUST_PATH . '/data');
define('DURA_XML_PATH', DURA_PATH_DATA . '/xml');
define('DURA_TEMPLATE_PATH', DURA_TRUST_PATH . '/template');

/**
 * If use mod_rewrite, set true.
 */
define('DURA_USE_REWRITE', false);

/**
 * Chat room settings
 */
define('DURA_LOG_LIMIT', 25);
define('DURA_TIMEOUT', 300); // 5 mins
define('DURA_USER_MIN', 3);
define('DURA_USER_MAX', 10);
define('DURA_ROOM_LIMIT', 10);
define('DURA_SITE_USER_CAPACITY', 100);
define('DURA_CHAT_ROOM_EXPIRE', 1800); // 30 mins
define('DURA_MESSAGE_MAX_LENGTH', 140);

// 1000 = 1 sec
!defined('DURA_ROOM_SYNC_TIME') && define('DURA_ROOM_SYNC_TIME', 1500);

define('DURA_MESSAGE_CRLF_REMOVE', false);

/**
 * Language setting
 */
define('DURA_LANGUAGE', 'ja-JP');

/**
 * Title settings
 */
define('DURA_TITLE', 'Durarara like chat room');
define('DURA_SUBTITLE', 'Durarara fan community');

/**
 * Session name
 */
define('DURA_SESSION_NAME', 'durarara-like-chat');

/**
 * Comet settings
 */
define('DURA_USE_COMET', 0);
define('DURA_SLEEP_LOOP', 300);
define('DURA_SLEEP_TIME', 1);

// bluelovers
/**
 * Output setting
 */
define('DURA_OB_HANDLER', 'ob_gzhandler');
// bluelovers



?>