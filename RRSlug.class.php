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
     * The default filter chain key.
     */
    const DEFAULT_FILTERCHAIN = 'default';
    
    /**
     * An array of the available filters.
     *
     * @var RRSlug_FilterInterface[]
     */
    protected $_availableFilters   = array();
    
    /**
     * An array of the available filter chains.
     *
     * @var RRSlug_FilterChain[]
     */
    protected $_availableFilterChains = array();
    
    public function __construct( $loadDefaultFilters = true )
    {
        spl_autoload_register( array( $this, '_loadClass' ) );
        
        if( $loadDefaultFilters ) {
            
            $this->_loadDefaultFilters();
        }
        
        $this->_buildDefaultFilterChain();
    }
    
    /**
     * Turns a text into a slug.
     *
     * @param  string $text The text to "sluggify".
     * @return string The slug.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text, $filterChain = self::DEFAULT_FILTERCHAIN )
    {
        if( !( $filterChain instanceof RRSlug_FilterChain ) ) {
            
            if( is_string( $filterChain ) ) {
                
                if( !array_key_exists( $filterChain, $this->_availableFilterChains ) ) {
                    
                    $filterChain = self::DEFAULT_FILTERCHAIN;
                }
                
                $filterChain = $this->_availableFilterChains[ $filterChain ];
            
            } else {
                
                $filterChain = $this->_availableFilterChains[ self::DEFAULT_FILTERCHAIN ];
            }
        }
        
        return $filterChain->filter( $text );
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
        
        $this->_availableFilters[ $filter->getKey() ] = $filter;
        
        return $this;
    }
    
    /**
     * Remove a filter by its key-
     *
     * @param string $key The filter's key.
     * @return RRSlug A reference to this instance.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function removeFilter( $key )
    {
        if( !array_key_exists( $key, $this->_availableFilters ) ) {
            
            throw new RRSlug_Exception_NoSuchFilter(
                'No filter with key "' . $key . '" has been found.'
            );
        }
        
        unset( $this->_availableFilters[ $key ] );
        
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
        if( !array_key_exists( $key, $this->_availableFilters ) ) {
            
            throw new RRSlug_Exception_NoSuchFilter(
                'No filter with key "' . $key . '" has been found.'
            );
        }
        
        return $this->_availableFilters[ $key ];
    }
    
    /**
     * Return the available filters.
     *
     * @return RRSlug_FilterInterface[] An array of the available filters.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getAvailableFilters()
    {
        return $this->_availableFilters;
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
     * Get a chain object by its key.
     *
     * @param string $key The chain's key.
     * @return RRSlug_FilterChain The chain.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getChain( $key )
    {
        if( !array_key_exists( $key, $this->_availableFilterChains ) ) {
            
            throw new RRSlug_Exception_NoSuchFilterChain(
                'No chain with key "' . $key . '" has been found.'
            );
        }
        
        return $this->_availableFilterChains[ $key ];
    }
    
    /**
     * Return the available chains.
     *
     * @return RRSlug_FilterChain[] An array of the available chains.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function getAvailableFilterChains()
    {
        return $this->_availableFilterChains;
    }
    
    /**
     * Add a chain to the list of available chain.
     *
     * @param string $key The chain key.
     * @param mixed $chain NULL to create a new chain, or an existing RRSlug_FilterChain object.
     * @return RRSlug_FilterChain The chain object.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function addChain( $key, $chain = NULL )
    {
        if( !( $chain instanceof RRSlug_FilterChain ) ) {
            
            $chain = new RRSlug_FilterChain( $key, $this );
        }
        
        $chain->setSlug( $this );
        
        $this->_availableFilterChains[ $chain->getKey() ] = $chain;
        
        return $chain;
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
            
            $this->_availableFilters[ $filter->getKey() ] = $filter;
        }
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
    protected function _sortFilters( &$filters )
    {
        uasort( $filters, array( $this, '_compareFiltersPriority' ) );
    }
    
    /**
     * This methid is called by uasort to sort the filters by descending priority.
     *
     * @param string $filterA The filter A
     * @param string $filterB The filter B
     * @return integer -1 if A > B, 1 else.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    protected function _compareFiltersPriority( $filterA, $filterB )
    {
        return ( $filterA->getPriority() > $filterB->getPriority() ) ? -1 : 1;
    }
    
    /**
     * Build the default filter chain.
     *
     * @return void
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    protected function _buildDefaultFilterChain()
    {
        $filters = $this->_availableFilters;
        
        $this->_sortFilters( $filters );
        
        $this->addChain( self::DEFAULT_FILTERCHAIN )->setFilters( $filters );
    }
    
    /**
     * Load the file defining the given class.
     *
     * @param  string The class name.
     * @return boolean Whether the class has been successfully been loaded or not.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    protected function _loadClass( $className )
    {
        // Define statically the replacements to do on the class name.
        static $replacements = array(
            __CLASS__ => '',
            '_'       => DIRECTORY_SEPARATOR
        );
        
        // Build the file path and name.
        $filePathName  = __DIR__;
        $filePathName .= str_replace(
            array_keys( $replacements ),
            array_values( $replacements ),
            $className
        );
        
        $filePathName .= '.class.php';
        
        // Check if the file exists.
        if( !file_exists( $filePathName ) ) {
            
            return false;
        }
        
        // Include it.
        require_once( $filePathName );
        
        // Check if the given class or interface is now defined.
        if( !class_exists( $filePathName ) || !interface_exists( $filePathName ) ) {
            
            return false;
        }
        
        // The class has successfully been loaded.
        return true;
    }
    
    public function getFilterFromMixedValue( $filter )
    {
        if( !( $filter instanceof RRSlug_FilterInterface ) ) {
            
            if( is_string( $filter ) ) {
                
                if( !array_key_exists( $filter, $this->_availableFilters ) ) {
                    
                    throw new RRSlug_Exception_NoSuchFilter(
                        'Filter "' . $filter . '" not found.'
                    );
                }
                
                $filter = $this->_availableFilters[ $filter ];
            
            } else {
                
                $filter = $this->_availableFilters[ $filter ];
            }
        }
        
        return $filter;
    }
    
}
