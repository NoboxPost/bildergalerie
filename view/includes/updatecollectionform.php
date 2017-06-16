<?php
/**
 * Created by PhpStorm.
 * User: gallatib
 * Date: 01.02.2017
 * Time: 17:53
 */
$result = db::getcollection();
if(isset($result[0])) {

    $oldtitle = $result[0]['Collectiontitle'];
}
?>


<form action="" name="updatecollectionform" method="POST" id='updatecollection' class='notclicked'>
    <p><a class="exitbutton" href='javascript:void(0);' onclick='closepopup("updatecollection")'><svg width="40" height="40">
                <g fill="none" stroke="#CCCCCC " stroke-width="4" stroke-linecap="round">
                    <path d="M7 7 L33 33"/>
                    <path d="M33 7 L7 33"/>
                </g>
            </svg></a></p>
    <input type="hidden" name="form" value="updatecollection">
    <input type="text" name="newtitle" value="<?php echo $oldtitle ?>">
    <input class="button-primary" type="submit" value="Titel ändern">
</form>



<form action="" name="deletecollection" method="post" id="deletecollection" class="notclicked">
    <p><a class="exitbutton" href='javascript:void(0);' onclick='closepopup("deletecollection")'><svg width="40" height="40">
                <g fill="none" stroke="#CCCCCC " stroke-width="4" stroke-linecap="round">
                    <path d="M7 7 L33 33"/>
                    <path d="M33 7 L7 33"/>
                </g>
            </svg></a></p>
    <input type="hidden" name="form" value="deletecollection">
    <input class="button-primary" type="submit" name="deletecollection" value="Collection löschen">
</form>