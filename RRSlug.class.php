<?php
 
/*
 * Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
 * Code licensed under the BSD License:
 * See http://romac.github.com/files/BSD.txt
 */

/**
 * Source file containing class RRSlug.
 * 
 * @package    default
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 * @see        RRSlug
 */

require_once( 'FilterInterface.class.php' );
require_once( 'FilterAbstract.class.php' );
require_once( 'Exception.class.php' );
require_once( 'Exception/NoSuchFilter.class.php' );

/**
 * Class RRSlug.
 * 
 * This class is aimed to turn user-entered titles into URLs
 * that are keyword rich and human readable.
 * Eg. for use with Apache mod rewrite.
 *
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 */
class RRSlug
{
    
    /**
     * Filters to apply on the supplied string.
     *
     * @var array
     */
    protected $_filters = array();
    
    /**
     * Are filters sorted by priority ?
     *
     * @var boolean
     */
    protected $_filtersAreSorted = false;
    
    public function __construct( $loadDefaultFilters = true )
    {
        if( $loadDefaultFilters ) {
            
            $this->_loadDefaultFilters();
        }
    }
    
    /**
     * Turns a text into a safe url.
     *
     * @param  string $text The text to convert.
     * @return string The safe url.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     **/
    public function filter( $text )
    {
        if( !$this->_filtersAreSorted ) {
            
            $this->_sortFilters();
        }
        
        foreach( $this->_filters as $filter ) {
            
            print $filter->getKey();
            
            if( !$filter->isAvailable() ) {
                
                print ' - UNAVAILABLE' . "\n";
                
                continue;
            }
            
            $text = $filter->filter( $text );
            
            print ' => ' . $text . "\n";
        }
        
        return $text;
    }
    
    /**
     * Add a filter to the filters list.
     *
     * @param RRSlug_FilterInterface $filter The filter to add.
     * @param array $options The options to set on this filter.
     * @return RRSlug A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function addFilter( RRSlug_FilterInterface $filter, array $options = array() )
    {
        if( $options ) {
            
            $filter->setOptions( $options );
        }
        
        $this->_filters[ $filter->getKey() ] = $filter;
        $this->_filtersAreSorted             = false;
        
        return $this;
    }
    
    /**
     * Get a filter object by its key.
     *
     * @param string $key The filter key.
     * @return RRSlug_FilterInterface The filter.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getFilter( $key )
    {
        if( !array_key_exists( $key, $this->_filters ) ) {
            
            throw new RRSlug_Exception_NoSuchFilter(
                'No filter with key "' . $key . '" has been found.'
            );
        }
        
        return $this->_filters[ $key ];
    }
    
    /**
     * Set a filter options directly.
     *
     * @param string $key The filter key.
     * @param array $options The options to set.
     * @return RRSlug A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function setFilterOptions( $key, array $options )
    {
        $this->getFilter( $key )->setOptions( $options );
        
        return $this;
    }
    
    /**
     * Load the default filters.
     *
     * @return void
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    protected function _loadDefaultFilters()
    {
        // Get all the filters in ./Filters/
        $filtersList = glob( dirname( __FILE__ ) . '/Filters/*.class.php' );
        
        foreach( $filtersList as $filterFilePathName ) {
            
            // Guess the filter's class name from its file name.
            $filterClassName = $this->_getFilterClassNameFromFileName( $filterFilePathName );
            
            require_once( $filterFilePathName );
            
            if( !class_exists( $filterClassName ) ) {
                
                continue;
            }
            
            $filter = new $filterClassName();
            
            if( !( $filter instanceof RRSlug_FilterInterface ) ) {
                
                unset( $filter );
                
                continue;
            }
            
            $this->_filters[ $filter->getKey() ] = $filter;
        }
        
        $this->_filtersAreSorted = false;
    }
    
    /**
     * Get the filter class name from its filename.
     *
     * @param string $fileName The filename to guess the clas name from.
     * @return string The class name.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    protected function _getFilterClassNameFromFileName( $fileName )
    {
        $fileName = basename( $fileName );
        
        return __CLASS__ . '_Filters_' . str_replace( '.class.php', '', $fileName );
    }
    
    /**
     * Sort the filters by priority.
     *
     * @return void
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    protected function _sortFilters()
    {
        uasort( $this->_filters, array( $this, '_compareFiltersPriority' ) );
    }
    
    protected function _compareFiltersPriority( $filterA, $filterB )
    {
        return ( $filterA->getPriority() > $filterB->getPriority() ) ? -1 : 1;
    }
    
}
