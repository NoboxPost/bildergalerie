<?php
/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 18:15
 */
?>

<form action="" method="post">
    <input type="hidden" name="form" value="logout">
    <p id="welcome"><?php echo "Willkommen " . $_SESSION["username"];
    if ($_SESSION["username"]=="Rino") echo ", du bisch dr best!";
        if ($_SESSION["username"]=="Basil") echo ", du bisch no besser!"
        ?></p>
    <input type="submit" value="Logout">
</form>
