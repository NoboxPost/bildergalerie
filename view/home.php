<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 21.01.2017
 * Time: 12:55
 */

require_once "./includes/head.php";
?>

<body>
<?php

require_once "./includes/header.php";

echo "<main>";
if (isset($_SESSION["id"])) {
    require_once "./includes/sidenav.php";
    require_once "./includes/loggedincontent.php";

} else {
    require_once "./includes/loggedoutcontent.php";
}

echo "</main>";
?>

<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/masonry.js"></script>
<script type="text/javascript" src="./js/imagesloaded.js"></script>
<script type="text/javascript" src="./js/imagesloadedcheck.js"></script>
<script type="text/javascript" src="./js/isotope.js"></script>
<script type="text/javascript" src="./js/sidenavigation.js"></script>
<script type="text/javascript" src="./js/popups.js"></script>
</body>
</html>