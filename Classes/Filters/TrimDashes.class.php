<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_Filters_TrimDashes.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_TrimDashes
*/

/**
* Class RRSlug_Filters_TrimDashes.
* 
* Description for class RRSlug_Filters_TrimDashes.
*
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_TrimDashes extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'trimDashes';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 30;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array();
    
    /**
     * Trim dashes and replace multiple ones with a single one.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        return trim(
            preg_replace(
                '/-{2,}/',
                '-',
                $text
            ),
            '-'
        );
    }
    
}