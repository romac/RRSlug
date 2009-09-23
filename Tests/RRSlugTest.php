<?php

/*
 * Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
 * Code licensed under the BSD License:
 * See http://romac.github.com/files/BSD.txt
 */

/**
 * Source file containing class RRSlugTest.
 * 
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 * @see        RRSlugTest
 */

require_once( __DIR__ . '/BaseTestCase.class.php' );
require_once( dirname( __DIR__ ) . '/Classes/RRSlug.class.php' );

/**
 * Class RRSlugTest.
 * 
 * Description for class RRSlugTest.
 *
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 */
class RRSlugTest extends RRSlug_BaseTestCase
{
    
    /**
     * Register autoload
     *
     * @var boolean
     */
    protected $_registerAutoload = false;
    
    /**
     * Autoload callable.
     *
     * @var array
     */
    protected $_autoloadCallable = array( 'RRSlug', '_loadClass' );
    
    /**
     * @test
     */
    public function autoloadRegisterStaticMethodWorks()
    {
        spl_autoload_unregister( $this->_autoloadCallable );
        
        RRSlug::autoloadRegister();
        
        $this->assertContains(
            $this->_autoloadCallable,
            spl_autoload_functions()
        );
    }
    
    /**
     * @test
     * @depends autoloadRegisterStaticMethodWorks
     */
    public function constructorRegisterAutoloadFunction()
    {
        $slug = new RRSlug();
        
        $this->assertContains(
            $this->_autoloadCallable,
            spl_autoload_functions()
        );
    }
    
    /**
     * @test
     * @depends autoloadRegisterStaticMethodWorks
     */
    public function loadDefaultFiltersMethodsWorks()
    {
        RRSlug::autoloadRegister();
        
        $filters = array(
            'decodeHtmlEntities'      => new RRSlug_Filters_DecodeHtmlEntities(),
            'lowerCase'               => new RRSlug_Filters_LowerCase(),
            'maxLength'               => new RRSlug_Filters_MaxLength(),
            'removeAccents'           => new RRSlug_Filters_RemoveAccents(),
            'removeSpecialCharacters' => new RRSlug_Filters_RemoveSpecialCharacters(),
            'stripTags'               => new RRSlug_Filters_StripTags(),
            'trimBlank'               => new RRSlug_Filters_TrimBlank(),
            'trimDashes'              => new RRSlug_Filters_TrimDashes()
        );
        
        $slug = new RRSlug( true );
        
        $this->assertEquals( $filters, $slug->getAvailableFilters() );
    }
    
    /**
     * @test
     * @depends autoloadRegisterStaticMethodWorks
     */
    public function addFilterWithNoOptionsParameterWorks()
    {
        RRSlug::autoloadRegister();
        
        $slug = new RRSlug( false );
        
        $filterMock = $this->getMock( 'RRSlug_FilterInterface' );
        
        $slug->addFilter( $filterMock );
        
        $this->assertContains( $filterMock, $slug->getAvailableFilters() );
    }
    
    /**
     * @test
     */
    public function addFilterWithOptionsParameterWorks()
    {
        RRSlug::autoloadRegister();
        
        $slug = new RRSlug( false );
        
        $stub = $this->getMock( 'RRSlug_FilterInterface' );
        $stub->expects( $this->once() )->method( 'setOptions' );
        
        $slug->addFilter( $stub, array( 'option' => 'value' ) );
    }
    
}
