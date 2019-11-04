<?php

  if (isset($_POST['redirectHome'])) {
    header('index.php');
    return true;
  };

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Under Maintenance</title>
  </head>
  <body>
    <div>
      The BBS website is currently under maintenance. Thank you for your patience!
    </div>
    <form method='POST'>
      <input type='submit' name='redirectHome' value='HOME PAGE' />
    </form>
  </body>
</html>
