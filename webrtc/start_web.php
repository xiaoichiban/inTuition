<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 *
 * CREDITS TO :
 *  @author walkor<walkor@workerman.net>
 *  @copyright walkor<walkor@workerman.net>
 *  @link http://www.workerman.net/
 *  @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;

/**
 * WebServer can use nginx + php-fpm instead
 */
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

if (isset($SSL_CONTEXT)) {
    $web = new WebServer("http://0.0.0.0:9988", $SSL_CONTEXT);
    $web->transport = 'ssl';
} 
else {
    // WebServer
    $web = new WebServer("http://0.0.0.0:9988");
}


// WebServer - Number of processes
$web->count = 2;


// Sets the site root directory
$web->addRoot('www.your_domain.com', __DIR__.'/web');


// Run the runAll method if it 
// is not started in the root directory

if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

