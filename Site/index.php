<?php

require ('../config/db.php');

$image_count = $dbh->query('SELECT COUNT(*) as img_count FROM `pictures`;')->fetch();

?>
<a href='/Site/pages/upload.php'>Upload image</a>
<br>
<hr>
Now upload file: <?= $image_count['img_count']; ?>

<img src="<?= 'Site/images/' + $filepath; ?>" />