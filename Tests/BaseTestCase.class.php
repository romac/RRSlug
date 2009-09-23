<?php

/*
 * Copyright (c) 2009, Romain Ruetschi <romain.ruetschi@gmail.com>
 * Code licensed under the BSD License:
 * See http://romac.github.com/files/BSD.txt
 */

/**
 * Source file containing class RRSlug_BaseTestCase.
 * 
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 * @see        RRSlug_BaseTestCase
 */
 
require_once( dirname( __DIR__ ) . '/Classes/RRSlug.class.php' );

/**
 * Class RRSlug_BaseTestCase.
 * 
 * Description for class RRSlug_BaseTestCase.
 *
 * @package    RRSlug
 * @license    http://romac.github.com/files/BSD.txt New BSD License
 * @author     Romain Ruetschi <romain.ruetschi@gmail.com>
 * @version    0.1
 */
abstract class RRSlug_BaseTestCase extends PHPUnit_Framework_TestCase
{

    /**
     * Disable the backup and restoration of the $GLOBALS array.
     *
     * @var boolean
     */
    protected $backupGlobals          = false;
    
    /**
     * Disable the backup and restoration of static attributes.
     *
     * @var boolean
     */
    protected $backupStaticAttributes = false;
    
    /**
     * Register autoload.
     *
     * @var boolean
     */
    protected $_registerAutoload      = true;
    
    public function __construct()
    {
        if( $this->_registerAutoload ) {
            
            RRSlug::autoloadRegister();
        }
        
        parent::__construct();
    }
    
}