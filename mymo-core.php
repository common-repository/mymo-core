<?php
/**
 * Plugin Name: MyMo Core - TV Series & Movie Portal Unlimited
 * Plugin URI: https://mymotheme.juzaweb.com
 * Description: MyMo Core Plugin help you easily create movie website. It is a powerful, flexible and User friendly movie & Video Steaming Theme with advance video contents management system. It’s easy to use & install. It has been created to provide unique experience to movie lover & movie site owner. To observe of ISP needed we have made MYMO to use as multipurpose video website. It was created to run with MyMo Theme. 
 * Version: 1.0
 * Author: MyMo Team
 * Author URI: https://www.facebook.com/106246807865039/
 * License: GPLv2 or later
 */

define('MYMO_DIRECTORY', __DIR__);
define('MYMO_APP_DIRECTORY', MYMO_DIRECTORY . '/MyMo');
define('MYMO_VIEWS_DIRECTORY', MYMO_APP_DIRECTORY . '/Views');
define('MYMO_DIRECTORY_URI', plugins_url('mymo-core'));
define('MYMO_PREFIX', 'mymo_');
define('MYMO_VERSION', '1.0');

require_once (__DIR__ . '/MyMo/Databases/Database.php');
register_activation_hook(__FILE__, [new \MyMo\Databases\Database(), 'basic_table']);

require_once (__DIR__ . '/MyMo/init.php');

use MyMo\Core\MyMo;

$app = new MyMo();
$app->init();