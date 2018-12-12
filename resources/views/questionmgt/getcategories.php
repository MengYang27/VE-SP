<?php

// *****************************
// ***** for deliver categories from Categories Column to Secondary Categories Column *****
// *****************************
include app_path().'/includes/categories.php';

// $cid = isset($_GET['cid']) ? intval($_GET['cid']) : '';

foreach ($categories_secondary[$cid] as $key => $category_secondary) {
    // Sample:
    // <li class="ui-state-default">Item 1</li>
    echo '<li class="ui-state-default"';
    echo 'value="'.$cid.'-'.$key.'"';
    echo '>';
    echo $category_secondary;
    echo '</li>';
}
