<?php

/*
 * Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
 * Code licensed under the BSD License:
 * See http://romac.github.com/files/BSD.txt
 */

/**
 * Source file containing class RRSlug_FilterChainTest.
 * 
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 * @see        RRSlug_FilterChainTest
 */

require_once( dirname( __DIR__ ) . '/BaseTestCase.class.php' );

/**
 * Class RRSlug_FilterChainTest.
 * 
 * Description for class RRSlug_FilterChainTest.
 *
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 */
class RRSlug_FilterChainTest extends RRSlug_BaseTestCase
{
    
    /**
     * RRSlug
     *
     * @var RRSlug
     */
    protected $_slug = NULL;
    
    public function setUp() 
    {
        $this->_slug = new RRSlug();
    }
    
    public function tearDown() 
    {
        unset( $this->_slug );
    }
    
    /**
     * @test
     */
    public function constructorSetKey()
    {
        $chain = new RRSlug_FilterChain( 'myChain', $this->_slug );
        
        $this->assertSame( 'myChain', $chain->getKey() );
    }
    
}