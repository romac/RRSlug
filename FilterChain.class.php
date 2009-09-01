<?php

/*
 * Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
 * Code licensed under the BSD License:
 * See http://romac.github.com/files/BSD.txt
 */

/**
 * Source file containing class RRSlug_FilterChain.
 * 
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 * @see        RRSlug_FilterChain
 */

/**
 * Class RRSlug_FilterChain.
 * 
 * Description for class RRSlug_FilterChain.
 *
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 */
class RRSlug_FilterChain
{
    
    /**
     * Key
     *
     * @var string
     */
    protected $_key = '';
    
    /**
     * Filters
     *
     * @var RRSlug_FilterInteface[]
     */
    protected $_filters = array();
    
    /**
     * Create a new RRSlug_FilterChain object.
     *
     * @param string $key The chain's key.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function __construct( $key )
    {
        $this->_key = $key;
    }
    
    /**
     * Get the chain's key.
     *
     * @return string The key.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getKey()
    {
        return $this->_key;
    }
    
    /**
     * Add a filter at the end of the chain.
     *
     * @param RRSlug_FilterInteface $filter The filter
     * @return RRSlug_FilterChain A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function push( RRSlug_FilterInteface $filter )
    {
        if( array_key_exists( $filter->getKey(), $this->_filters ) ) {
            
            throw new RRSlug_Exception_DuplicateFilter(
                'Filter "' . $filter->getKey() . '" is already presents in ' .
                'the filters list.'
            );
        }
        
        $this->_filters[ $filter->getKey() ] = $filter;
        
        return $this;
    }
    
    /**
     * Add a filter at the beginning of the chain
     *
     * @param RRSlug_FilterInteface $filter The filter.
     * @return RRSlug_FilterChain A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function unshift( RRSlug_FilterInteface $filter )
    {
        if( array_key_exists( $filter->getKey(), $this->_filters ) ) {
            
            throw new RRSlug_Exception_DuplicateFilter(
                'Filter "' . $filter->getKey() . '" is already presents in ' .
                'the filters list.'
            );
        }
        
        $this->_filters = array( $filter->getKey() => $filter ) + $this->_filters;
        
        return $this;
    }
    
    /**
     * Set the filters.
     *
     * @param array $filters The filters
     * @return RRSlug_FilterChain A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function setFilters( array $filters )
    {
        $this->_filters = $filters;
        
        return $this;
    }
    
    /**
     * Get the filters.
     *
     * @return RRSlug_FilterInteface[]
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getFilters()
    {
        return $this->_filters;
    }
    
    /**
     * Turns a text into a slug.
     *
     * @param  string $text The text to "sluggify".
     * @return string The slug.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        foreach( $this->_filters as $filter ) {
            
            $text = $filter->filter( $text );
        }
        
        return $text;
    }
    
}