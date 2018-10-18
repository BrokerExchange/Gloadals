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
    static private $available_formats = ['ini', 'php'];

    /**
     * @var string
     */
    static private $gloadal_file_path = __DIR__ . '/../.gload.ini';

    /**
     * wrapper function for loading files
     *
     * @param string $gloadal_file the file from which to load variables
     * @param string $format the file extension format
     */
    public static function load($gloadal_file = __DIR__ . '/../.gload.ini', $format = 'ini')
    {

        self::$gloadal_file_path = realpath($gloadal_file);

        if (empty(self::$gloadal_file_path)) {
            exit;
        }

        if (in_array($format, self::$available_formats) && $format === strtolower(pathinfo(self::$gloadal_file_path,
                PATHINFO_EXTENSION))) {
            self::{$format}();
        }

    }

    /**
     * load an "ini" file to $GLOBALS
     */
    private static function ini()
    {

        $ini = parse_ini_file(self::$gloadal_file_path, true);

        if(!empty($ini)){
            foreach ($ini as $name => $value) {

                $GLOBALS[$name] = $value;

            }
        }
    }

    /**
     * load a "php" file to $GLOBALS
     */
    private static function php()
    {

        require_once(self::$gloadal_file_path);

        if(!empty($associative_array)){
            foreach ($associative_array as $name => $value) {

                $GLOBALS[$name] = $value;

            }
        }

        if (!empty($numeric_array)) {
            foreach ($numeric_array as $name => $value) {

                if(is_array($value)) {

                    foreach ($value as $value1){

                        $GLOBALS[$name][] = $value1;

                    }

                } else{

                    $GLOBALS[$name][] = $value;

                }

            }
        }

        if(!empty($scalar)){
            foreach ($scalar as $name => $value){

                $GLOBALS[$name] = $value;

            }
        }

    }

}