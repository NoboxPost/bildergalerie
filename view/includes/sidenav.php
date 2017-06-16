<?php
/**
 * Created by PhpStorm.
 * User: gallatib
 * Date: 01.02.2017
 * Time: 09:37
 */

?>
<aside>
    <nav id="sidenav" class="snbnotclicked">

        <?php
        require_once ("./includes/createmaincollection.php");
        require_once ("../config.php");
        ?>

        <h5>Erstellte Maincollections:</h5>

        <ul>
            <?php
            $result = db::getmaincollections();

            if(isset($result["rowcount"]) && $result["rowcount"] !=0) {
                if(!isset($_SESSION["actualboxid"])){
                    $_SESSION["actualboxid"] = $result[0]["ID_Box"];
                }
                for ($i = 0; $i < $result["rowcount"]; $i++) {
                    $collectionid = $pathToRoot.'/collection/'.$result[$i]["ID_Box"];
                    $collectiontitle = $result[$i]["Collectiontitle"];
                    echo "<li><a href='$collectionid'>$collectiontitle</a></li>";
                }
            }else{
                echo"Bitte erstellen Sie eine neue Collection";
            }

            ?>
        </ul>
    </nav>
</aside>
