<?php
require ('./config/db.php');

if (isset($_GET['reg'])) {
  $res = query('SELECT * FROM users WHERE login = :l', [':l' => $_GET['login']]);
  if ($res) {
    echo "Error: This login is duplicate on db";
  } else {
    $res = query('INSERT INTO users (login, pass) VALUE (:login, :pass)', [':login' => $_GET['login'], ':pass' => $_GET['pass']]);
  }
  header('Location: /Site');
}

?>

<form>
  <input type="text" name=login placeholder="Login" /><br />
  <input type="password" name=pass placeholder="Password" /><br />
  <input type=hidden name=reg value="1" />
  <button>Submit</button>
</form>