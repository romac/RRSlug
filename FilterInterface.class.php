<?php

/*
* Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
* Code licensed under the BSD License:
* See http://romac.github.com/files/BSD.txt
*/

/**
* Source file containing class RRSlug_FilterInterface.
* 
* @package    RRSlug
* @license    http://romac.github.com/files/BSD.txt New BSD License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_FilterInterface
*/

/**
 * Class RRSlug_FilterInterface.
 * 
 * Description for class RRSlug_FilterInterface.
 *
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 */
 interface RRSlug_FilterInterface
{
    
    /**
     * Filter the given text.
     *
     * @param string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text );
    
    /**
     * Return the key of this filter
     *
     * @return string The key of this filter.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getKey();
    
    /**
     * Return this filter's priority.
     *
     * @return integer This filter's priority.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getPriority();
    
    /**
     * Return the options this filter is using.
     *
     * @return array The options this filter is using.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getOptions();
    
    /**
     * Set the options of this filter.
     * The supplied array will be merged with the defaults options
     * that can be setted by overriding the default $_options instance property.
     *
     * @param array $options The options to set.
     * @return RRSlug_FilterAbstract A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function setOptions( array $options );
    
    /**
     * Return the value of the specified option.
     *
     * @param  string The name of the option.
     * @return mixed The value of the specified option.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getOption( $option );
    
    /**
     * Is this filter available with the current server configuration ?
     *
     * @return boolean Whether this filter is available or not.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function isAvailable();
    
}