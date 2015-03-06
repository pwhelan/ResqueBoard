<?php
/**
 * Core configuration file
 *
 * Use to configure the behavior of ResqueBoard
 *
 * PHP version 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @package    ResqueBoard
 * @subpackage ResqueBoard.Config
 * @author     Wan Qi Chen <kami@kamisama.me>
 * @copyright  2012-2013 Wan Qi Chen
 * @link       http://resqueboard.kamisama.me
 * @since      1.0.0
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 */



/**
 * General settings
 *
 * Uncomment to override the default settings.
 *
 * $resquePrefix is the prefix php-resque prepends to all its keys.
 *
 * @var array
 */
$settings = array(
    'cubePublic' => array(
        'host' => (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : 'http://localhost:1081/',
        'port' => 1081
    ),
    'readOnly' => true,
    'resqueConfig' => __DIR__ . '/../../../../click4time.current/fresque.ini'  // __DIR__ . DIRECTORY_SEPARATOR . './resque.ini',
    //'timezone' => 'America/Montreal'
);

$ini = parse_ini_file($settings['resqueConfig'], true);


function parse_mongo_target($log)
{
    // Use the Mongo Schema
    preg_match(
        '~mongodb\:\/\/([^\:\,]+)(\:|)([\d]+)\,([a-zA-Z0-9-_]+)\,([a-zA-Z0-9-_]+)~',
        $log['target'], 
        $m
    );
    if ($m)
    {
        return [
            'host'		=> $m[1],
            'port'		=> strlen($m[3]) && (int)$m[3] ? $m[3] : 27017,
            'database'	=> $m[4],
            'collection'	=> $m[5]
        ];
    }
}

function parse_settings_from_ini($ini)
{
    $ret= ['Redis'	=> [
        'host'		=> @$ini['Redis']['host'],
        'port'		=> @$ini['Redis']['port'],
        'database'	=> @$ini['Redis']['database'],
        'prefix'	=> @$ini['Redis']['namespace'],
        'password'	=> ''
    ]];
    
    if ($ini['Log']['handler'] == 'MongoDB')
    {
        $ret['Mongo'] = parse_mongo_target($ini['Log']);
    }
    else
    {
        //$ret['Mongo'] = 
    }
    // Much harder to keep Cube support
    //'Cube'	=> parse_log
    
    return $ret;

}

ResqueBoard\Lib\Service\Service::$settings = parse_settings_from_ini($ini);


/**
 * Service settings
 * All database connection settings
 *
 * @var array
 */
/*
ResqueBoard\Lib\Service\Service::$settings = array(
    'Redis' => array(
        'host' => '127.0.0.1',
        'port' => 6379,
        'database' => 0,
        'password' => '',
        'prefix' => 'resque'
    ),
    'Mongo' => array(
        'host' => 'localhost',
        'port' => 27017,
        'database' => 'cube_development'
    ),
    'Cube' => array(
        'host' => '127.0.0.1',
        'port' => 1081
    )
);
*/

/**
 * Default number of items to display for pagination
 *
 * @var int
 */
define('PAGINATION_LIMIT', 15);

/**
 * Debug mode
 *
 * @var  bool
 */
define('DEBUG', false);

/**
 * Path to the cache folder
 *
 * @var  string
 */
define('CACHE', dirname(__DIR__) . DS . 'cache');

/**
 * Default application name
 *
 * @used for the website title
 * @var string
 */
define('APPLICATION_NAME', 'ResqueBoard');

/**
 * Separator between the website name and other text, in the page title
 *
 * @var string
 */
define('TITLE_SEP', ' | ');
