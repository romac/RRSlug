<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_Filters_LowerCase.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_LowerCase
*/

/**
* Class RRSlug_Filters_LowerCase.
* 
* Description for class RRSlug_Filters_LowerCase.
*
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_LowerCase extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'lowerCase';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 80;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array(
        'encoding' => 'UTF-8'
    );
    
    /**
     * Make a string lowercase using mbstring if found.
     * 
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        if( function_exists( 'mb_strtolower' ) ) {
            
            return ( $this->_options[ 'encoding' ] )
                   ? mb_strtolower( $text, $this->_options[ 'encoding' ] )
                   : mb_strtolower( $text );
        }
        
        return strtolower( $text );
    }
    
}
