<?php

$finder = \PhpCsFixer\Finder::create()
  ->notPath('vendor')
  ->in('src')
  ->name('*.php')
  ->notName('*.blade.php');

$config = new \PhpCsFixer\Config();

return $config->setRules([
    '@PSR2' => true,
    'array_syntax' => ['syntax' => 'short'],
    'ordered_imports' => ['sort_algorithm' => 'length'],
    'no_spaces_around_offset' => true,
    'no_unused_imports' => true,
  ])
  ->setIndent("\t")
  ->setFinder($finder);
