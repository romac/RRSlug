<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_Filters_StripTags.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_StripTags
*/

/**
* Class RRSlug_Filters_StripTags.
* 
* Description for class RRSlug_Filters_StripTags.
*
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_StripTags extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'stripTags';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 70;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array();
    
    /**
     * Strip HTML and PHP tags from a string.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        return strip_tags( $text );
    }
    
}