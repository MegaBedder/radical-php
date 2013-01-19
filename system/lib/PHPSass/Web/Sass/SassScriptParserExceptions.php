<?php namespace Web\Sass;
/* SVN FILE: $Id$ */
/**
 * SassScript Parser exception class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.script
 */

/**
 * SassScriptParserException class.
 * @package      PHamlP
 * @subpackage  Sass.script
 */
class SassScriptParserException extends SassException {}

/**
 * SassScriptLexerException class.
 * @package      PHamlP
 * @subpackage  Sass.script
 */
class SassScriptLexerException extends SassScriptParserException {}

/**
 * SassScriptOperationException class.
 * @package      PHamlP
 * @subpackage  Sass.script
 */
class SassScriptOperationException extends SassScriptParserException {}

/**
 * SassScriptFunctionException class.
 * @package      PHamlP
 * @subpackage  Sass.script
 */
class SassScriptFunctionException extends SassScriptParserException {}