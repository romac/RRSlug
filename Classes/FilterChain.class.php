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
    protected $_key     = '';
    
    /**
     * Filters
     *
     * @var RRSlug_FilterInterface[]
     */
    protected $_filters = array();
    
    /**
     * RRSlug instance.
     *
     * @var RRSlug
     */
    protected $_slug    = NULL;
    
    /**
     * Create a new RRSlug_FilterChain object.
     *
     * @param string $key The chain's key.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function __construct( $key, RRSlug $slug )
    {
        $this->_key  = ( string )$key;
        $this->_slug = $slug;
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
     * Get the base RRSlug instance.
     *
     * @return RRSlug
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getSlug()
    {
        return $this->_slug;
    }
     
    /**
     * Set the base RRSlug instance.
     *
     * @param string $slug The base RRSlug instance.
     * @return RRSlug_FilterChain A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function setSlug( RRSlug $slug )
    {
        $this->_slug = $slug;
         
        return $this;
    }
    
    /**
     * Add a filter at the end of the chain.
     *
     * @param mixed $filter Either a filter key or a instance of RRSlug_FilterInterface.
     * @return RRSlug_FilterChain A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function push( $filter )
    {
        $filter           = $this->_slug->getFilterFromMixedValue( $filter );
        $this->_filters[] = $filter;
        
        return $this;
    }
    
    /**
     * Add a filter at the beginning of the chain
     *
     * @param mixed $filter Either a filter key or a instance of RRSlug_FilterInterface.
     * @return RRSlug_FilterChain A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function unshift( $filter )
    {
        $filter         = $this->_slug->getFilterFromMixedValue( $filter );
        $this->_filters = array( $filter ) + $this->_filters;
        
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
        foreach( $filters as $key => $filter ) {
            
            if( !( $filter instanceof RRSlug_FilterInterface ) ) {
                
                unset( $filters[ $key ] );
            }
        }
        
        $this->_filters = $filters;
        
        return $this;
    }
    
    /**
     * Get the filters.
     *
     * @return RRSlug_FilterInterface[]
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
