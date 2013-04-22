<?php

/**
 * Usage:
 * php spec/parser.php path.to.spec.json:
 *   - php spec/parser.php amqp-rabbitmq-0.8.json
 *   - php spec/parser.php amqp-rabbitmq-0.9.1.json
 */

$spec = file_get_contents(__DIR__ . "/" . $argv[1]);

$json_spec = json_decode($spec, true);

function to_camel_case($amqp_method) {
    $words = explode('-', $amqp_method);
    $ret = array();
    foreach ($words as $w) {
        $ret[] = ucfirst($w);
    }
    return implode('', $ret);
}

function method_name($amqp_class, $amqp_method) {
    return $amqp_class . to_camel_case($amqp_method);
}

function to_snake_case($arg) {
    return str_replace('-', '_', $arg);
}

function argument_default_val($arg) {
    return isset($arg['default-value']) ? " = " . default_value_to_string($arg['default-value']) : "";
}

function default_value_to_string($value) {
    return var_export($value, true);
}

function add_method_arguments($arguments) {
    $ret = array();
    foreach ($arguments as $arg) {
        $ret[] = '$' . to_snake_case($arg['name']) . argument_default_val($arg);
    }
    return implode(", ", $ret);
}

function domain_to_type($domains, $domain) {
    foreach ($domains as $d) {
        if ($d[0] == $domain) {
            return $d[1];
        }
    }
    throw new \Exception("Invalid domain: " . $domain);
}

function argument_type($domains, $arg) {
    return isset($arg['type']) ? $arg['type'] : domain_to_type($domains, $arg['domain']);
}

function call_write_argument($domains, $arg) {
    return "\t\t\$args->write_" . argument_type($domains, $arg) . '($' . to_snake_case($arg['name']) . ");\n";
}

function call_read_argument($domains, $arg) {
    return "\$args->read_" . argument_type($domains, $arg) . "();\n";
}

function protocol_version($json_spec) {
    if (isset($json_spec['revision'])) {
        return $json_spec['major-version'] . $json_spec['minor-version'] . $json_spec['revision'];
    } else {
        return "0" . $json_spec['major-version'] . $json_spec['minor-version'];
    }
}

function protocol_header($json_spec) {
    if (isset($json_spec['revision'])) {
        return sprintf("AMQP\x%02x\x%02x\x%02x\x%02x", 0, $json_spec['major-version'], $json_spec['minor-version'], $json_spec['revision']);
    } else {
        return sprintf("AMQP\x%02x\x%02x\x%02x\x%02x", 1, 1, $json_spec['major-version'],$json_spec['minor-version']);
    }
}

$out = "<?php\n\n";
$out .= "/* This file was autogenerated by spec/parser.php - Do not modify */\n\n";
//$out .= "namespace PhpAmqpLib\Helper\Protocol;\n\n";
//$out .= "use PhpAmqpLib\Wire\AMQPWriter;\n\n";
$out .= "class PhpAmqpLib_Helper_Protocol_Protocol" . protocol_version($json_spec) . "\n";
$out .= "{\n";

foreach ($json_spec['classes'] as $c) {
    foreach ($c['methods'] as $m) {

        if ($m['id'] % 10 == 0) {
            $out .= "\n\tpublic function " . method_name($c['name'], $m['name']) . "(";
            $out .= add_method_arguments($m['arguments']);
            $out .= ") {\n";
            $out .= "\t\t\$args = new PhpAmqpLib_Wire_AMQPWriter();\n";
            foreach ($m['arguments'] as $arg) {
                $out .= call_write_argument($json_spec['domains'], $arg);
            }
            $out .= "\t\treturn array(" . $c['id'] . ", " . $m['id'] . ", \$args);\n";
            $out .= "\t}\n";
        } else {
            $out .= "\n\tpublic static function " . method_name($c['name'], $m['name']) . "(\$args) {\n";
            $out .= "\t\t\$ret = array();\n";
            foreach ($m['arguments'] as $arg) {
                $out .= "\t\t\$ret[] = " . call_read_argument($json_spec['domains'], $arg);
            }
            $out .= "\t\treturn \$ret;\n";
            $out .= "\t}\n";
        }
    }
}

$out .= "}\n";

file_put_contents(__DIR__ . '/../PhpAmqpLib/Helper/Protocol/Protocol' . protocol_version($json_spec) . '.php', $out);

function frame_types($json_spec) {
    $ret = array();
    foreach ($json_spec['constants'] as $c) {
        if (substr($c['name'], 0, 5) == "FRAME") {
            $ret[$c['value']] =  $c['name'];
        }
    }
    return var_export($ret, true);
}

function content_methods($json_spec) {
    $ret = array();
    foreach ($json_spec['classes'] as $c) {
        foreach ($c['methods'] as $m) {
            if (isset($m['content']) && $m['content']) {
                $ret[] = $c['id'] . "," . $m['id'];
            }
        }
    }
    return var_export($ret, true);
}

function close_methods($json_spec) {
    $ret = array();
    foreach ($json_spec['classes'] as $c) {
        foreach ($c['methods'] as $m) {
            if ($m['name'] == 'close') {
                $ret[] = $c['id'] . "," . $m['id'];
            }
        }
    }
    return var_export($ret, true);
}

function global_method_names($json_spec) {
    $ret = array();
    foreach ($json_spec['classes'] as $c) {
        foreach ($c['methods'] as $m) {
            $ret[$c['id'] . "," . $m['id']] = ucfirst($c['name']) . '.' . to_snake_case($m['name']);
        }
    }
    return var_export($ret, true);
}


$out = "<?php\n\n";
$out .= "/* This file was autogenerated by spec/parser.php - Do not modify */\n\n";
//$out .= "namespace PhpAmqpLib\Wire;\n\n";
//$out .= "class Constants" . protocol_version($json_spec) . "\n";
$out .= "class PhpAmqpLib_Wire_Constants" . protocol_version($json_spec) . "\n";
$out .= "{\n";
$out .= "\tpublic static \$AMQP_PROTOCOL_HEADER = \"" . protocol_header($json_spec) . "\";\n\n";
$out .= "\tpublic static \$FRAME_TYPES = " . frame_types($json_spec) . ";\n\n";
$out .= "\tpublic static \$CONTENT_METHODS = " . content_methods($json_spec) . ";\n\n";
$out .= "\tpublic static \$CLOSE_METHODS = " . close_methods($json_spec) . ";\n\n";
$out .= "\tpublic static \$GLOBAL_METHOD_NAMES = " . global_method_names($json_spec) . ";\n";
$out .= "}\n";

file_put_contents(__DIR__ . '/../PhpAmqpLib/Wire/Constants' . protocol_version($json_spec) . '.php', $out);

function method_waits($json_spec) {
    $ret  = array();
    foreach ($json_spec['classes'] as $c) {
        foreach($c['methods'] as $m) {
            $ret[$c['name'] . '.' . to_snake_case($m['name'])] = $c['id'] . "," . $m['id'];
        }
    }
    return var_export($ret, true);
}

$out = "<?php\n\n";
$out .= "/* This file was autogenerated by spec/parser.php - Do not modify */\n\n";
//$out .= "namespace PhpAmqpLib\Helper\Protocol;\n\n";
//$out .= "class Wait" . protocol_version($json_spec) . "\n";
$out .= "class PhpAmqpLib_Helper_Protocol_Wait" . protocol_version($json_spec) . "\n";
$out .= "{\n";
$out .= "\tprotected \$wait = " . method_waits($json_spec) . ";\n\n";
$out .= "\tpublic function get_wait(\$method) {\n";
$out .= "\t\t return \$this->wait[\$method];\n";
$out .= "\t}\n";
$out .= "}\n";

file_put_contents(__DIR__ . '/../PhpAmqpLib/Helper/Protocol/Wait' . protocol_version($json_spec) . '.php', $out);

function method_map($json_spec) {
    $ret  = array();
    foreach ($json_spec['classes'] as $c) {
        foreach($c['methods'] as $m) {
            $ret[$c['id'] . "," . $m['id']] = $c['name'] . '_' . to_snake_case($m['name']);
        }
    }
    return var_export($ret, true);
}

$out = "<?php\n\n";
$out .= "/* This file was autogenerated by spec/parser.php - Do not modify */\n\n";
//$out .= "namespace PhpAmqpLib\Helper\Protocol;\n\n";
//$out .= "class MethodMap" . protocol_version($json_spec) . "\n";
$out .= "class PhpAmqpLib_Helper_Protocol_MethodMap" . protocol_version($json_spec) . "\n";
$out .= "{\n";
$out .= "\tprotected \$method_map = " . method_map($json_spec) . ";\n\n";
$out .= "\tpublic function get_method(\$method_sig) {\n";
$out .= "\t\t return \$this->method_map[\$method_sig];\n";
$out .= "\t}\n";
$out .= "\tpublic function valid_method(\$method_sig) {\n";
$out .= "\t\treturn array_key_exists(\$method_sig, \$this->method_map);\n";
$out .= "\t}\n";
$out .= "}\n";

file_put_contents(__DIR__ . '/../PhpAmqpLib/Helper/Protocol/MethodMap' . protocol_version($json_spec) . '.php', $out);