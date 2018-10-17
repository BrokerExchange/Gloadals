<?php
/**
 * Created by PhpStorm.
 * User: swahlstrom
 * Date: 10/16/18
 * Time: 11:31 AM
 */

namespace BrokerExchange;

/**
 * Class Gloadals
 * @package BrokerExchange
 */
final class Gloadals
{

    /**
     * @var array
     */
    static private $available_formats = ['ini'];

    /**
     * @var string
     */
    static private $gloadal_file_path = __DIR__ . '/../.gload.ini';

    /**
     * wrapper function for loading files
     *
     * @param string $gloadal_file the file from which to load variables
     * @param string $format the file format
     */
    public static function load($gloadal_file = __DIR__ . '/../.gload.ini', $format = 'ini')
    {

        self::$gloadal_file_path = realpath($gloadal_file);

        if (empty(self::$gloadal_file_path)) {
            exit;
        }

        if (in_array($format, self::$available_formats)) {
            self::{$format}();
        }

    }

    /**
     * load and ini file to $GLOBALS
     */
    private static function ini()
    {

        $ini = parse_ini_file(self::$gloadal_file_path, true);

        foreach ($ini as $name => $value) {

            $GLOBALS[$name] = $value;

        }
    }
}
