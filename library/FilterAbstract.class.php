<?php

/*
 * Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
 * Code licensed under the BSD License:
 * See http://romac.github.com/files/BSD.txt
 */

/**
 * Source file containing class RRSlug_FilterAbstract.
 * 
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 * @see        RRSlug_FilterAbstract
 */

/**
 * Class RRSlug_FilterAbstract.
 * 
 * Description for class RRSlug_FilterAbstract.
 *
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 */
abstract class RRSlug_FilterAbstract implements RRSlug_FilterInterface
{

    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = '';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 0;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array();
    
    /**
     * Return the key of this filter
     *
     * @return string The key of this filter.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getKey()
    {
        return $this->_key;
    }
    
    /**
     * Return this filter's priority.
     *
     * @return integer This filter's priority.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getPriority()
    {
        return $this->_priority;
    }
    
    /**
     * Return the options this filter is using.
     *
     * @return array The options this filter is using.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getOptions()
    {
        return $this->_options;
    }
    
    /**
     * Set the options of this filter.
     * The supplied array will be merged with the defaults options
     * that can be setted by overriding the default $_options instance property.
     *
     * @param  array $options The options to set.
     * @return RRSlug_FilterAbstract A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function setOptions( array $options )
    {
        $this->_options = array_merge( $this->_options, $options );
        
        return $this;
    }
    
    /**
     * Return the value of the specified option.
     *
     * @param  string The name of the option.
     * @return mixed The value of the specified option.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getOption( $option )
    {
        if( array_key_exists( $option, $this->_options ) ) {
            
            return $this->_options[ $option ];
        }
        
        return NULL;
    }
    
    /**
     * Is this filter available with the current server configuration ?
     *
     * @return boolean Whether this filter is available or not.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function isAvailable()
    {
        return true;
    }
    
}