#!/usr/bin/env php
<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$convertMap = [
    __DIR__ . '/../data/names.json' => __DIR__ . '/../third-party/gimei-original/lib/data/names.yml',
    __DIR__ . '/../data/addresses.json' => __DIR__ . '/../third-party/gimei-original/lib/data/addresses.yml',
];

foreach ($convertMap as $outputPath => $inputPath) {
    echo "Reading {$inputPath}... ";
    if (!file_exists($inputPath)) {
        echo "YAML file not found. Forgot `git submodule update --init` ?\n";
        exit(1);
    }
    echo "done.\n";
    $yml = file_get_contents($inputPath);
    echo "Parsing YAML... ";
    $data = \Symfony\Component\Yaml\Yaml::parse($yml);
    echo "done.\n";
    echo "Encoding JSON... ";
    $json = json_encode($data);
    echo "done.\n";
    echo "Writing {$outputPath}... ";
    file_put_contents($outputPath, $json);
    echo "done.\n";
    echo "\n";
}
