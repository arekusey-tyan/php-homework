<?php
require ('./config/db.php');
header('Content-type: text/html; charset=UTF-8');

$file = 'countries.json';
$dict_file = 'dictionary.json';
$dict = (json_decode(file_get_contents($dict_file)))->dictionary;

if (isset($_GET['countrie'])) {
  $content = json_decode(file_get_contents($file));
  if (in_array($_GET['countrie'], $dict)) {
    $content->countries[] = $_GET['countrie'];
    file_put_contents($file, json_encode($content));
  } else {
    echo "Error";
  }
}

$fContentCountries = json_decode(file_get_contents($file));
?>
<form>
  <input type="text" name="countrie" /><br />
  <button>Submit</button>
</form>

<select>
  <option selected disabled>Список стран</option>
  <?php for ($i = 0; $i < count($fContentCountries->countries); $i++) { ?>
  <option value="<?= $i; ?>"><?= $fContentCountries->countries[$i]; ?></option>
  <?php } ?>
</select>