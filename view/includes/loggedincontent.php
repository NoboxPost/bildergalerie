<?php
/**
 * Created by PhpStorm.
 * User: gallatib
 * Date: 01.02.2017
 * Time: 10:46
 */
echo '<article>';


if (isset($_SESSION["actualboxid"])) {
    $result = db::getcollection();

    if (isset($result["rowcount"]) && $result["rowcount"] == 1) {

        $collectiontitle = str_replace("\\r\\n",'', $result[0]['Collectiontitle']);
        echo "<div class='collection'>";
        echo "<h2>$collectiontitle</h2>";
        echo "<a class='button' href='javascript:void(0);' onclick='openpopup(\"updatecollection\")'>Edit</a> 
                <a class='button' href='javascript:void(0);' onclick='openpopup(\"createnote\")'>Notiz erstellen</a> 
                <a class='button' href='javascript:void(0);' onclick='openpopup(\"createimage\")'>Bild Hochladen</a> 
                <a class='button' href=javascript:void(0);' onclick='openpopup(\"deletecollection\")'>Löschen</a> ";
        if(isset($dbresult["imageuploadfailed"])){
            if($dbresult["imageuploadfailed"]){
                echo "<p>Upload fehlgeschlagen. Bitte stellen Sie sicher, dass Sie ein Bild ausgewählt haben und dass die Grösse nicht mehr als 4MB beträgt.</p>";
            }
        }
        echo "</div>";



        $result = db::getcollectioncontent();
        echo "<div class='grid'><div class='grid-sizer'></div>";
        for ($i = 0; $i < $result["rowcount"]; $i++) {

            echo "<div class='grid-item'>";
            if (isset($result[$i]["Note_ID"])) {
                $typeresult = db::gettypecontent('Note', $result[$i]['Note_ID']);
                $noteheader = str_replace("\\r\\n",'', $typeresult[0]["Notetitle"]);
                $notetext = str_replace("\\r\\n",'<br>', $typeresult[0]["Notetext"]);
                $boxid = $result[$i]["ID_Box"];
                echo"<h3>$noteheader</h3>
 <form action='' method='post'><input type=\"hidden\" name=\"form\" value=\"deleteimage\"><input type='hidden' name='boxid' value='$boxid'><input type='submit'value='Löschen'></form>";
                echo"<p>$notetext</p>";
            }
            elseif (isset($result[$i]["Image_ID"])) {
                $typeresult = db::gettypecontent('Image', $result[$i]['Image_ID']);
                $imgheader = str_replace("\\r\\n",'', $typeresult[0]["Imagetitle"]);
                $imglink = $typeresult[0]["ImageLink"];
                $boxid = $result[$i]["ID_Box"];
                echo"<h3>$imgheader</h3> <form action='' method='post'><input type=\"hidden\" name=\"form\" value=\"deleteimage\"><input type='hidden' name='boxid' value='$boxid'><input type='submit'value='Löschen'></form>";
                echo "<a href='../images/fullsize/$imglink'><img src='../images/thumbnails/$imglink' alt='Image uploaded by User'></a>";

            }
            echo "</div>";

        }
        echo "</div>";


    } else {
        echo "<h2>Fehler bei der Datenbankabfrage, bitte wenden Sie sich an den Administrator";
    }

} else {
    echo "<h2>Bitte wählen Sie eine Collection aus</h2>";
}

require_once "./includes/createimage.php";
require_once "./includes/createnote.php";
require_once "./includes/updatecollectionform.php";

echo '</article>';

