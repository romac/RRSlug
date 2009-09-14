<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_Filters_MaxLength.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_MaxLength
*/

/**
* Class RRSlug_Filters_MaxLength.
* 
* Description for class RRSlug_Filters_MaxLength.
*
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_MaxLength extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'maxLength';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 20;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array(
        'maxLength' => -1,
        'wholeWord' => true
    );
    
    /**
     * Crop the given text if it's longer than @maxLength@.
     * If @wholeWord@ is true, then only a text containing full words
     * will be returned.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        if( $this->_options[ 'maxLength' ] > 0 && strlen( $text ) > $this->_options[ 'maxLength' ] ) {
            
            $text = substr( $text, 0, $this->_options[ 'maxLength' ] );
            
            if( $this->_options[ 'wholeWord' ] ) {
                
                $text = explode( '-', $text );
                $text = implode( '-', array_diff( $text, array( array_pop( $text ) ) ) );
            }
        }
        
        return $text;
    }
    
}