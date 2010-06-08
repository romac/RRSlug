<?php

/*
 * Copyright (c) 2010 Romain Ruetschi <romain.ruetschi@gmail.com>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 * 
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * Source file containing class RRSlug_FilterAbstract.
 * 
 * @package    RRSlug
 * @license    http://opensource.org/licenses/mit-license.html MIT License
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
 * @license    http://opensource.org/licenses/mit-license.html MIT License
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