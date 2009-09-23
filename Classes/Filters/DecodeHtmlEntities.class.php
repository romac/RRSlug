<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_Filters_DecodeHtmlEntities.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_DecodeHtmlEntities
*/

/**
* Class RRSlug_Filters_DecodeHtmlEntities.
* 
* Description for class RRSlug_Filters_DecodeHtmlEntities.
*
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/

class RRSlug_Filters_DecodeHtmlEntities extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'decodeHtmlEntities';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 100;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array(
        'decodeCharset' => 'UTF-8'
    );
    
    /**
     * Convert all HTML entities to their applicable characters.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        return html_entity_decode(
            $text,
            ENT_QUOTES,
            $this->_options[ 'decodeCharset' ]
        );
    }
    
}