<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 
 * Workerman-based webrtc signaling server
 */
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
use Workerman\Worker;

// Subscribe to the topic and connection correspondence
$subject_connnection_map = array();
if (isset($SSL_CONTEXT)) {
    // Websocket listening port 8877
    $worker = new Worker('websocket://0.0.0.0:8877', $SSL_CONTEXT);
    $worker->transport = 'ssl';
} else {
    // Websocket listening port 8877
    $worker = new Worker('websocket://0.0.0.0:8877');
}

// The number of processes can only be set to 1, 
//  avoiding multiple connections to different processes
// Don't worry about performance issues, as 
// Signaling Server, workerman
// ONE process is enough

$worker->count = 1;
// Process name
$worker->name = 'Signaling Server';


// Set a subjects property when connecting up to save the current connection
$worker->onConnect = function ($connection){
    $connection->subjects = array();
};


// When the client sends data out
$worker->onMessage = function($connection, $data)
{
    $data = json_decode($data, true);
    switch ($data['cmd']) {
		
        // Subscribe to topics
        case 'subscribe':
            $subject = $data['subject'];
            subscribe($subject, $connection);
            break;
			
        // Post a message to a topic
        case 'publish':
            $subject = $data['subject'];
            $event = $data['event'];
            $data = $data['data'];
            publish($subject, $event, $data, $connection);
            break;
    }
};

// Remove connection from topic map
// array when client connection is closed
$worker->onClose = function($connection){
    destry_connection($connection);
};

// subscription
function subscribe($subject, $connection) {
    global $subject_connnection_map;
    $connection->subjects[$subject] = $subject;
    $subject_connnection_map[$subject][$connection->id] = $connection;
}

// unsubscribe
function unsubscribe($subject, $connection) {
    global $subject_connnection_map;
    unset($subject_connnection_map[$subject][$connection->id]);
}

// Publish an event to a topic
function publish($subject, $event, $data, $exclude) {
    global $subject_connnection_map;
    if (empty($subject_connnection_map[$subject])) {
        return;
    }
    foreach ($subject_connnection_map[$subject] as $connection) {
        if ($exclude == $connection) {
            continue;
        }
        $connection->send(json_encode(array(
            'cmd'   => 'publish',
            'event' => $event,
            'data'  => $data
        )));
    }
}

// Clean up the topic map array
function destry_connection ($connection) {
    foreach ($connection->subjects as $subject) {
        unsubscribe($subject, $connection);
    }
}

// Run the runAll method if it is not started in the root directory
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}
