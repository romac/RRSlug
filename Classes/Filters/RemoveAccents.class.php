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
* Source file containing class RRSlug_Filters_RemoveAccents.
* 
* @package    RRSlug
* @license    http://opensource.org/licenses/mit-license.html MIT License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_RemoveAccents
*/

/**
* Class RRSlug_Filters_RemoveAccents.
* 
* Description for class RRSlug_Filters_RemoveAccents.
*
* @package    RRSlug
* @license    http://opensource.org/licenses/mit-license.html MIT License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_RemoveAccents extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'removeAccents';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 90;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array(
        'decodeCharset' => 'UTF-8'
    );
    
    /**
     * Convert every accentuated characters to its ASCII equivalent.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        return @iconv(
            $this->_options[ 'decodeCharset' ],
            'ASCII//TRANSLIT',
            $text
        );
    }
    
    public function isAvailable()
    {
        return function_exists( 'iconv' );
    }
    
}