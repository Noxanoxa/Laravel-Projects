<?php

/*
 * Key is the Laravel locale code.
 * Index 0 of sub-array is the Carbon locale code.
 * Index 1 of sub-array is the PHP locale code for setlocale().
 * Index 2 of sub-array is true if the language is RTL.
 * Index 3 of sub-array is the language name in the original language.
 */


return [
    'status' => true,
    'languages' => [
        'en' => ['en', 'en_US', false, 'English'],
        'ar' => ['ar', 'ar_AR', true, 'Arabic'],
    ],
];


?>
