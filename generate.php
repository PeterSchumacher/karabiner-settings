#!/usr/bin/env php
<?php

function generateRule($from_key, $from_modifiers, $to_key, $to_modifiers)
{

    $from = new stdClass();
    $from->key_code = $from_key;
    $from->modifiers = new stdClass();
    $from->modifiers->mandatory = $from_modifiers;

    $to_item = new stdClass();
    $to_item->key_code = $to_key;
    $to_item->modifiers = $to_modifiers;

    $to = [$to_item];

    $item = new stdClass();
    $item->type = "basic";
    $item->from = $from;
    $item->to = $to;

    return $item;

}

$manipulators[] = generateRule('keypad_7', ['left_shift'], '8', ['right_option', 'right_shift']);
$manipulators[] = generateRule('keypad_8', ['left_shift'], '9', ['right_option', 'right_shift']);

$manipulators[] = generateRule('keypad_4', ['left_shift'], '8', ['right_option']);
$manipulators[] = generateRule('keypad_5', ['left_shift'], '9', ['right_option']);

// Rule
$rule = new stdClass();
$rule->description = 'PS keys';
$rule->manipulators = $manipulators;


// Main document
$doc = new stdClass();
$doc->title = "PS settings";
$doc->rules = [$rule];

// Output
$data2 = json_encode($doc, JSON_PRETTY_PRINT);


if ($argc > 2) {
    exit('To many arguments!' . PHP_EOL);
}

if ($argc == 2) {
    $filename = $argv[1];
    file_put_contents($filename, $data2);
    exit;
}

print $data2;
