<?php
$categories = array(
    "1"=>"Tense",
    "2"=>"Part of Speech",
    "3"=>"Grammar",
    "4"=>"Subject"
);
// value => key array
$categories_flip = array_flip($categories);

// tense secondary key value pairs.
$tense = array(
    "1" => 'Present Simple',
    "2" => 'Past Simple',
    "3" => 'Future Simple',
    "4" => 'Present Perfect',
    "5" => 'Past Perfect',
    "6" => 'Future Perfect',
    "7" => 'Present Continuous',
    "8" => 'Past Continuous',
    "9" => 'Future Continuous',
    "10" => 'Present Perfect Continuous',
    "11" => 'Past Perfect Continuous', 
    "12" => 'Future Perfect Continuous'
);

$categories_secondary = array(
    "1" => $tense
);

?>