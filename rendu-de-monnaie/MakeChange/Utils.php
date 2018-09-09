<?php
namespace MakeChange;

class Utils
{
    /**
     * Parses $GLOBALS['argv'] for parameters and assigns them to an array.
     *
     * @param array $noopt List of parameters without values
     */
    public function parseParameters($noopt = array()) 
    {
        $result = array();
        $params = $GLOBALS['argv'];
        // could use getopt() here (since PHP 5.3.0), but it doesn't work relyingly
        reset($params);
        while (list($tmp, $p) = each($params)) {
            if ($p{0} == '-') {
                $pname = substr($p, 1);
                $value = true;
                if ($pname{0} == '-') {
                    // long-opt (--<param>)
                    $pname = substr($pname, 1);
                    if (strpos($p, '=') !== false) {
                        // value specified inline (--<param>=<value>)
                        list($pname, $value) = explode('=', substr($p, 2), 2);
                    }
                }
                // check if next parameter is a descriptor or a value
                $nextparm = current($params);
                if (!in_array($pname, $noopt) && $value === true && $nextparm !== false && $nextparm{0} != '-') list($tmp, $value) = each($params);
                $result[$pname] = $value;
            }
        }
        return $result;
    }
    
    /**
     * check if all required options.
     *
     * @param array $options  List of parameters
     * @param array $required List of required parameters
     *
     * return bool
     */
    public function requiredOptions($options, $required) 
    {
        if (!$options) {
            return true;
        } else {
            foreach ($required as $key => $option) {
                if (!isset($options[$option])) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * check if all required options.
     *
     * @param array $options  List of parameters
     * @param array $required List of required parameters
     *
     * return bool
     */
    public function checkRequiredOptions($options, $required) 
    {
        if ($this->requiredOptions($options, $required)) {
            die("\n" . $GLOBALS['argv'][0] . " needs the following options:\n\n\t- " . implode("\n\t- ", $required) . "\n\nTry php " . $GLOBALS['argv'][0] . " --help\n\n");
        }
    }
}