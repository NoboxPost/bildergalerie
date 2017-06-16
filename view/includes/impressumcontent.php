<?php
/**
 * Created by PhpStorm.
 * User: gallatib
 * Date: 03.02.2017
 * Time: 12:14
 */


?>

<article class="mainpages">
    <br><a class='button' href= '<?php echo ''.$pathToRoot.'/view/home.php'?>'>Back (Home) </a>
    <h3>Impressum</h3>
    <div class="impressum">
        <h4>Kontaktadresse</h4>
        <p>Rino Vanoni <br> Basil Gallati</p>
        <p>Engehaldenstrasse 26<br>3012 Bern<br>Schweiz</p>
        <p><a href="mailto:yolo@yolo.ch">yolo@yolo.ch</a></p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2723.271239139887!2d7.437753215241128!3d46.956360540662025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478e39944809c151%3A0x629b7abbbe537e3c!2sEngehaldenstrasse+26%2C+3012+Bern!5e0!3m2!1sde!2sch!4v1486121662033" width="1200" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
        <h4>Haftungsausschluss</h4>
        <p>Der Autor übernimmt keinerlei Gewähr hinsichtlich der  inhaltlichen Richtigkeit, Genauigkeit, Aktualität, Zuverlässigkeit und  Vollständigkeit der Informationen.</p>
        <p>Haftungsansprüche gegen den Autor wegen Schäden materieller  oder immaterieller Art, welche aus dem Zugriff oder der Nutzung bzw.  Nichtnutzung der veröffentlichten Informationen, durch Missbrauch der  Verbindung oder durch technische Störungen entstanden sind, werden  ausgeschlossen.</p>
        <p>Alle  Angebote sind unverbindlich. Der Autor behält es sich ausdrücklich vor, Teile  der Seiten oder das gesamte Angebot ohne gesonderte Ankündigung zu verändern,  zu ergänzen, zu löschen oder die Veröffentlichung zeitweise oder endgültig  einzustellen.</p>
        <h4>Haftung für Links</h4>
        <p>Verweise und Links auf Webseiten  Dritter liegen ausserhalb unseres Verantwortungsbereichs Es wird jegliche Verantwortung für solche Webseiten  abgelehnt.  Der Zugriff und die Nutzung solcher Webseiten erfolgen  auf eigene Gefahr des Nutzers oder der Nutzerin. </p>
        <h4>Urheberrechte</h4>
        <p>Die Urheber- und alle anderen Rechte an Inhalten, Bildern, Fotos oder anderen Dateien auf der Website gehören ausschliesslich <strong>Rino &amp; Basil Vanoni &amp; Gallati</strong> oder den speziell genannten  Rechtsinhabern. Für die Reproduktion jeglicher Elemente ist die schriftliche Zustimmung der Urheberrechtsträger im Voraus einzuholen.</p>
    </div>

<?php
    $collectiontitle = $result[$i]["Collectiontitle"];
    echo "<li><a href='$collectionid'>$collectiontitle</a></li>";
    ?>

</article>