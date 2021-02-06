<?php
/**
 * Copyright (c) 2020
 *  @file  CLParser.php
 *  @author  USPilot
 *  @date  2021/02/06
 *  @time  12:00
 *
 */
namespace USPilot;

class CLParser
{
    /**
     * Return associative array of command-line arguments
     *
     * @param array $argv Command line arguments
     * @return array associative array of command-line arguments
     *  [
     *    [input] - arguments (without '-')
     *    ['arg']=>'value' - parameters
     *  ]
     */
    public static function arguments(array $argv)
    {
        $_ARG = array();
        foreach ($argv as $arg)
        {
            if (preg_match('/^-{1,2}([a-zA-Z0-9\-_]*)=?(.*)$/', $arg, $matches))
            {
                $key = $matches[1];
                switch ($matches[2])
                {
                    case '':
                    case 'true':
                        $arg = true;
                        break;
                    case 'false':
                        $arg = false;
                        break;
                    default:
                        $arg = $matches[2];
                }
                $_ARG[$key] = $arg;
            }
            else
            {
                $_ARG['input'][] = $arg;
            }
        }
        return $_ARG;
    }

}