<?php
/**
 * Created by PhpStorm.
 * User: bkope
 * Date: 30.01.2017
 * Time: 23:51
 */

?>


<form action="" name="createnote" method="POST" id='createnote' class='notclicked'>
    <p><a class="exitbutton" href='javascript:void(0);' onclick='closepopup("createnote")'>
            <svg width="40" height="40">
                <g fill="none" stroke="#CCCCCC " stroke-width="4" stroke-linecap="round">
                    <path d="M7 7 L33 33"/>
                    <path d="M33 7 L7 33"/>
                </g>
            </svg>
        </a></p>
    <div class="row">
        <input type="hidden" name="form" value="createnote">
        <div class="six columns">
            <label for="noteHeader">Überschrift</label>
            <input class="u-full-width" type="text" name="noteheader" placeholder="Notizentitel" id="noteHeader"
                   required>
        </div>
    </div>
    <div class="row">
        <div class="twelve columns">
            <label for="noteText">Notiz</label>
            <textarea name="notetext" placeholder="Notizentext" class="u-full-width" id="noteText" required
                      style="resize:none"></textarea>
        </div>
    </div>
    <input class="button-primary" type="submit" value="senden">
</form>

