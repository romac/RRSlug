<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_Filters_RemoveSpecialCharacters.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_RemoveSpecialCharacters
*/

/**
* Class RRSlug_Filters_RemoveSpecialCharacters.
* 
* Description for class RRSlug_Filters_RemoveSpecialCharacters.
*
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_RemoveSpecialCharacters extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'removeSpecialCharacters';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 60;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array(
        'and' => 'and'
    );
    
    /**
     * Remove any special characters in the supplied text.
     * So everything which is not alphanumeric nor a space, underscore or dash
     * is removed.
     * & is replaced by @and@.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        $text = preg_replace( '/[^&a-z0-9_-\s\']/i','', $text );
        $text = str_replace(
            array( '&',    ' ', '\'' ),
            array( ' ' . $this->_options[ 'and' ] . ' ', '-', '' ),
            $text
        );
        
        return $text;
    }    
}