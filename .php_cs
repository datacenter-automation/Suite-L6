<?php

$rules = [
    '@PSR2' => true,
    '@PHP73Migration' => true,
    'array_syntax' => ['syntax' => 'short'],
    'binary_operator_spaces' => ['align_double_arrow' => true],
    'linebreak_after_opening_tag' => true,
    'no_multiline_whitespace_before_semicolons' => true,
    'no_short_echo_tag' => true,
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
    'no_useless_else' => true,
    'ordered_imports' => [
        'sortAlgorithm' => 'length',
    ],
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_align' => true,
    'phpdoc_indent' => true,
    'phpdoc_no_package' => true,
    'phpdoc_order' => true,
    'phpdoc_separation' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_trim' => true,
    'phpdoc_var_without_name' => true,
    'no_superfluous_phpdoc_tags' => false,
    'phpdoc_to_comment' => true,
    'single_quote' => true,
    'single_trait_insert_per_statement' => false,
    'ternary_operator_spaces' => true,
    'trailing_comma_in_multiline_array' => true,
    'trim_array_spaces' => true,
    'ordered_class_elements' => [
        'sortAlgorithm' => 'alpha',
    ],
];

$excludes = [
    'bootstrap',
    'node_modules',
    'public',
    'resources',
    'storage',
    'vendor',
];

return PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
            ->exclude($excludes)
            ->notName('README.md')
            ->notName('*.xml')
            ->notName('*.yml')
            ->notName('_ide_helper.php')
    );
