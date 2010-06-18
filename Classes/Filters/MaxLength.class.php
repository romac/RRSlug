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
* Source file containing class RRSlug_Filters_MaxLength.
* 
* @package    RRSlug
* @license    http://opensource.org/licenses/mit-license.html MIT License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
* @see        RRSlug_Filters_MaxLength
*/

/**
* Class RRSlug_Filters_MaxLength.
* 
* Description for class RRSlug_Filters_MaxLength.
*
* @package    RRSlug
* @license    http://opensource.org/licenses/mit-license.html MIT License
* @author     Romain Ruetschi <romain.ruetschi@gmail.com>
* @version    0.1
*/
class RRSlug_Filters_MaxLength extends RRSlug_FilterAbstract
{
    
    /**
     * Filter key.
     *
     * @var string
     */
    protected $_key      = 'maxLength';
    
    /**
     * Filter priority.
     *
     * @var integer
     */
    protected $_priority = 20;
    
    /**
     * Filter options.
     *
     * @var array
     */
    protected $_options  = array(
        'maxLength' => -1,
        'wholeWord' => true
    );
    
    /**
     * Crop the given text if it's longer than @maxLength@.
     * If @wholeWord@ is true, then only a text containing full words
     * will be returned.
     *
     * @param  string $text The text to filter.
     * @return string The filtered text.
     * @author Romain Ruetschi <romain.ruetschi@gmail.com>
     */
    public function filter( $text )
    {
        if( $this->_options[ 'maxLength' ] > 0 && strlen( $text ) > $this->_options[ 'maxLength' ] )
        {
            $text = substr( $text, 0, $this->_options[ 'maxLength' ] );
            
            if( $this->_options[ 'wholeWord' ] )
            {
                $text = explode( '-', $text );
                $text = implode( '-', array_diff( $text, array( array_pop( $text ) ) ) );
            }
        }
        
        return $text;
    }
    
}