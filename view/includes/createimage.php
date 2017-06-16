<?php
/**
 * Created by PhpStorm.
 * User: bkope
 * Date: 30.01.2017
 * Time: 23:37
 */

?>

<form action="" method="POST" enctype="multipart/form-data" name="createimage" id='createimage' class='notclicked'>
    <p><a class="exitbutton" href='javascript:void(0);' onclick='closepopup("createimage")'>
            <svg width="40" height="40">
                <g fill="none" stroke="#CCCCCC " stroke-width="4" stroke-linecap="round">
                    <path d="M7 7 L33 33"/>
                    <path d="M33 7 L7 33"/>
                </g>
            </svg>
        </a></p>
    <div class="row">
        <input type="hidden" name="form" value="createimage">
        <div class="six columns">
            <label for="imageTitle">Bildname / Bildtitel</label>
            <input class="u-full-width" type="text" name="imagetitle" placeholder="Bildtitel" id="imageTitle" required>
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <!--            //TODO Bild hinzufügen stylen-->
            <label for="filepath">Bild hinzufügen</label>
            <input class="u-full-width" type="file" name="filepath" id="filepath" required>
        </div>
        <input type="hidden" name="path">
        <input type="hidden" name="userid">
    </div>
    <input class="button-primary" type="submit" value="Bild hochladen" name="submit">
</form>
