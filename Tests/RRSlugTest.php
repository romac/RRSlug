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
 * Source file containing class RRSlugTest.
 * 
 * @package    RRSlug
 * @license    http://opensource.org/licenses/mit-license.html MIT License
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
 * @license    http://opensource.org/licenses/mit-license.html MIT License
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
