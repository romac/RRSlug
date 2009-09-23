<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_Filters_TrimBlank.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_TrimBlank
*/

/**
* Class RRSlug_Filters_TrimBlank.
* 
* Description for class RRSlug_Filters_TrimBlank.
*
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_TrimBlank extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'trimBlank';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 10;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array(
        'blank' => ''
    );
    
    /**
     * Trim blank character around the text.
     * If the resulting text is empty, return @blank@ option.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        $text = trim( $text, ' ' );
        
        return ( !$text ) ? $this->_options[ 'blank' ] : $text;
    }
    
}