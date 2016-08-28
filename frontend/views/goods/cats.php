<?php
$categories = \common\service\CategoryService::factory()->getCategoriesMap();

if ($categories[$cid]) {
    foreach ($categories[$cid] as $cat) {
        echo "<a href=''>". $cat['name']. "</a>";
        echo '<br>';
    }
}
