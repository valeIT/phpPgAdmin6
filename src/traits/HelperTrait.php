<?php

/**
 * PHPPgAdmin v6.0.0-beta.43
 */

namespace PHPPgAdmin\Traits;

/**
 * @file
 * A trait with helpers methods to debug, halt the app and format text to html
 */

/**
 * A trait with helpers methods to debug, halt the app and format text to html.
 *
 * @package PHPPgAdmin
 */
trait HelperTrait
{
    /**
     * Halts the execution of the program. It's like calling exit() but using builtin Slim Exceptions.
     *
     * @param string $msg The message to show to the user
     *
     * @throws \Slim\Exception\SlimException (description)
     */
    public function halt($msg = 'An error has happened')
    {
        $body = $this->container->responseobj->getBody();
        $body->write($msg);

        throw new \Slim\Exception\SlimException($this->container->requestobj, $this->container->responseobj);
    }

    public function addFlash($key, $content)
    {

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        $btarray0 = ([
            'class2'    => $backtrace[1]['class'],
            'type2'     => $backtrace[1]['type'],
            'function2' => $backtrace[1]['function'],
            'spacer4'   => ' ',
            'line2'     => $backtrace[0]['line'],
        ]);

        $tag = implode('', $btarray0);

        $this->container->flash->addMessage($tag . ' ' . $key, $content);
    }

    /**
     * Receives N parameters and sends them to the console adding where was it called from.
     */
    public function prtrace()
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        $btarray0 = ([
            /*'class0'    => $backtrace[3]['class'],
            'type0'     => $backtrace[3]['type'],
            'function0' => $backtrace[3]['function'],
            'spacer0'   => ' ',
            'line0'     => $backtrace[2]['line'],

            'spacer1'   => "\n",

            'class1'    => $backtrace[2]['class'],
            'type1'     => $backtrace[2]['type'],
            'function1' => $backtrace[2]['function'],
            'spacer2'   => ' ',
            'line1'     => $backtrace[1]['line'],

            'spacer3'   => "\n",*/

            'class2'    => $backtrace[1]['class'],
            'type2'     => $backtrace[1]['type'],
            'function2' => $backtrace[1]['function'],
            'spacer4'   => ' ',
            'line2'     => $backtrace[0]['line'],
        ]);

        $tag = implode('', $btarray0);

        \PC::debug(func_get_args(), $tag);
    }

    /**
     * Receives N parameters and sends them to the console adding where was it
     * called from.
     */
    public static function statictrace()
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        $btarray0 = [
            'class'    => $backtrace[1]['class'],
            'type'     => $backtrace[1]['type'],
            'function' => $backtrace[1]['function'],
            'spacer'   => ' ',
            'line'     => $backtrace[0]['line'],
        ];

        $tag = implode('', $btarray0);

        \PC::debug(func_get_args(), $tag);
    }

    /**
     * Returns a string with html <br> variant replaced with a new line.
     *
     * @param string $msg message to parse (<br> separated)
     *
     * @return string parsed message (linebreak separated)
     */
    public static function br2ln($msg)
    {
        return str_replace(['<br>', '<br/>', '<br />'], "\n", $msg);
    }

    public function dump()
    {
        call_user_func_array('\Kint::dump', func_get_args());
    }

    public function dumpAndDie()
    {

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);

        $folder = dirname(dirname(__DIR__));
        $file   = str_replace($folder, '', $backtrace[0]['file']);
        $line   = $backtrace[0]['line'];

        call_user_func_array('\Kint::dump', func_get_args());
        $this->halt('stopped by user at ' . $file . ' line ' . $line);
    }
}