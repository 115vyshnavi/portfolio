<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  echo "Welcome, " . $name;
}
?>

<form method="post">
  <label>Name:</label><br>
  <input type="text" name="name"><br><br>
  <button type="submit">Submit</button>
</form>
