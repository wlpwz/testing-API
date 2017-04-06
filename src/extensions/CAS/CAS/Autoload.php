<?php

/**
 * Autoloader Class
 *
 *  PHP Version 5
 *
 * @file      CAS/Autoload.php
 * @category  Authentication
 * @package   SimpleCAS
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2008 Regents of the University of Nebraska
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://code.google.com/p/simplecas/
 **/

/**
 * Autoload a class
 *
 * @param string $class Classname to load
 *
 * @return bool
 */
function CAS_autoload($class)
{
    if (substr($class, 0, 4) !== 'CAS_') {
        return false;
    }
    //by joe, make path, and change following path
    $path=dirname(dirname(__FILE__)).'/'.str_replace('_', '/', $class) . '.php';
    $fp = @fopen($path, 'r', true);
    if ($fp) {
        fclose($fp);
        include $path;
        if (!class_exists($class, false) && !interface_exists($class, false)) {
            die(
                new Exception(
                    'Class ' . $class . ' was not present in ' .
                    str_replace('_', '/', $class) . '.php (include_path="' .
                    get_include_path() .'") [CAS_autoload]'.$path
                )
            );
        }
        return true;
    }
    $e = new Exception(
        'Class ' . $class . ' could not be loaded from ' .
        str_replace('_', '/', $class) . '.php, file does not exist (include_path="'
        . get_include_path() .'") [CAS_autoload]'
    );
    $trace = $e->getTrace();
    if (isset($trace[2]) && isset($trace[2]['function'])
        && in_array($trace[2]['function'], array('class_exists', 'interface_exists'))
    ) {
        return false;
    }
    if (isset($trace[1]) && isset($trace[1]['function'])
        && in_array($trace[1]['function'], array('class_exists', 'interface_exists'))
    ) {
        return false;
    }
    die ((string) $e);
}
/*
if (!(spl_autoload_functions()) || !in_array('CAS_autoload', spl_autoload_functions())) {
    spl_autoload_register('CAS_autoload');
}*/
?>
