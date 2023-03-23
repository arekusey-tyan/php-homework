<?php

require ('../../config/db.php');

$f = $_FILES;


if (!empty($f['file']['tmp_name'])) {
    $file = $f['file'];

    $name = $file['name'];
    $filepath = 'images/' . $name;

    move_uploaded_file($file['tmp_name'], "../$filepath");

    $q = $dbh->prepare('INSERT INTO `pictures` (pic_name, size, imagepath) VALUE (:name, :size, :filepath);', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $q->execute([':name' => $name, ':size' => $file['size'], ':filepath' => $filepath]);

}

?>

<a href='/Site'>Home Pag</a>
<br>
<hr>

<form method='post' enctype="multipart/form-data">
    <input type='file' name='file' />
    <button>Submit</button>
</form>