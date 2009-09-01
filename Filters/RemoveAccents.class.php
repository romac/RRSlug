<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_Filters_RemoveAccents.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_RemoveAccents
*/

/**
* Class RRSlug_Filters_RemoveAccents.
* 
* Description for class RRSlug_Filters_RemoveAccents.
*
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_RemoveAccents extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'removeAccents';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 90;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array(
        'decodeCharset' => 'UTF-8'
    );
    
    /**
     * Convert every accentuated characters to its ASCII equivalent.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        return @iconv(
            $this->_options[ 'decodeCharset' ],
            'ASCII//TRANSLIT',
            $text
        );
    }
    
    public function isAvailable()
    {
        return function_exists( 'iconv' );
    }
    
}