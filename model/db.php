<?php

/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 11:00
 */
class db
{
//    private $servername = "127.0.0.1";
//    private $username = "root";
//    private $password = "";
//    private $datbasename = "nobox";
    private static $connectionvars = array("servername" => "127.0.0.1",
        "username" => "root",
        "password" => "",
        "databasename" => "nobox");


//    public function __construct($servername, $username, $password, $databasename)
//    {
//        $this->servername = $servername;
//        $this->username = $username;
//        $this->password = $password;
//        $this->datbasename = $databasename;
//        $this->conn = new mysqli("$this->servername", "$this->username", "$this->password", "$this->datbasename");
//        $this->message = $this->conn->error;
//    }
    public static function configconn($servername = null, $username = null, $password = null, $databasename = null)
    {
        if (isset($servername)) {
            self::$connectionvars["servername"] = $servername;
        }
        if (isset($username)) {
            self::$connectionvars["username"] = $username;
        }
        if (isset($password)) {
            self::$connectionvars["password"] = $password;
        }
        if (isset($databasename)) {
            self::$connectionvars["databasename"] = $databasename;
        }
    }

    private static function connect()
    {
        $conn = new mysqli(self::$connectionvars["servername"], self::$connectionvars["username"], self::$connectionvars["password"], self::$connectionvars["databasename"]);
        if ($conn->connect_error) {
            die("Connection Error" . $conn->connect_errno . ') ' . $conn->connect_error);
        }
        return $conn;
    }

    public static function createuser($data)
    {
        $conn = self::connect();
        $userinsert = $conn->prepare("INSERT INTO Users (Username,Emailaddress,Hash) VALUES (?,?,?)");
        $password = hash("sha256", $data["pwd"]);
        $userinsert->bind_param("sss", $data["username"], $data["email"], $password);
        $userinsert->execute();
        $returnarray["dbmessage"] = $userinsert->error;
        $defaultcollection = array();
        if (isset($returnarray["dbmessage"]) && $returnarray["dbmessage"] == "") {
            $returnarray["username"] = $data["username"];
            $returnarray["id"] = $userinsert->insert_id;
            $defaultcollection['collectionheader'] = "Beispiel Collection";
            $defaultcollection["newuserid"] = $returnarray["id"];
            $defaultcollection = db::createcollection($defaultcollection, 0);
            $returnarray["dbmessage"] .= $defaultcollection["dbmessage"];
        }
        $userinsert->close();
        $conn->close();

        return $returnarray;
    }


    public static function login($data)
    {
        $conn = self::connect();
        $returnarray["loginsuccess"] = false;
        $userlogin = $conn->prepare("SELECT ID_User,Username FROM Users WHERE Username=? AND Hash=?");
        $password = hash("sha256", $data["pwd"]);
        $userlogin->bind_param("ss", $data["username"], $password);
        $userlogin->execute();
        $userlogin->bind_result($id_user, $username);
        while ($userlogin->fetch()) {
            if (isset($id_user)) {
                $returnarray["id"] = htmlspecialchars($id_user);
            }
            if (isset($username)) {
                $returnarray["username"] = htmlspecialchars($username);
            }
            $returnarray["loginsuccess"] = true;
            $returnarray["dbmessage"] = "login successfull";
        }
        if (!$returnarray["loginsuccess"]) {
            $returnarray["dbmessage"] = "login failed";
        }
        $userlogin->close();
        $conn->close();
        return $returnarray;
    }


    public static function createcollection($data, $parentid = null)
    {
        if (isset($parentid)) $returnarray["parentid"] = $parentid;
        elseif (isset($_SESSION["actualboxid"])) $returnarray["parentid"] = intval($_SESSION["actualboxid"]);
        else $returnarray["parentid"] = 0;
        $conn = self::connect();
        $collectionheader = $conn->real_escape_string($data['collectionheader']);
        if (isset($data["newuserid"])) $id = $data["newuserid"];
        else $id = intval($_SESSION["id"]);
        $stmt = $conn->prepare("INSERT INTO Collection (Collectiontitle, User_ID) VALUE (?,?)");
        $stmt->bind_param("ss", $collectionheader, $id);
        $stmt->execute();
        $returnarray["userid"] = $id;
        $returnarray["newcollectionid"] = $stmt->insert_id;
        $returnarray["dbmessage"] = $conn->error;
        $returnarray = self::insertintoboxandboxuser($returnarray, $conn);
        return $returnarray;
    }

    public static function createimage($data, $files)
    {
        //benötigt images Ordner
        $returnarray["dbmessage"] = "";

        //FULLSIZE
        $imageFolderFullsize = "../images/fullsize/";
        $imageNameFullsize = date("YmdGis") . "_" . $files["filepath"]["name"];
        $imagePathFullsize = $imageFolderFullsize . $imageNameFullsize;

        //THUMBNAILS
        $imageFolderThumbnails = "../images/thumbnails/";
        $imageNameThumbnails = date("YmdGis") . "_" . $files["filepath"]["name"];
        $imagePathThumbnails = $imageFolderThumbnails . $imageNameThumbnails;




        $uploadWorked = 1;
        $imageFileType = pathinfo($imagePathFullsize, PATHINFO_EXTENSION);


        // VALIDATION: Ist dies ein Bild?
        if (isset($_POST["submit"]) && isset($files['filepath']['tmp_name'])) {
            $check = getimagesize($files["filepath"]["tmp_name"]);
            if ($check !== false) {
                $returnarray["dbmessage"] .= "Dies ist eine Bildatei.";
                $uploadWorked = 1;
            } else {
                $returnarray["dbmessage"] .= "Dies ist keine Bildatei.";
                $uploadWorked = 0;
            }
        }


        // VALIDATION: Ist das Bild zu gross?
        if(isset($files['filepath'])) {
            if($files['filepath']['size'] > 4194304) { //4 MB (size is also in bytes)
                // File too big
                $uploadWorked = 0;
            } else {
                // File within size restrictions
                $uploadWorked = 1;
            }
        }


        // VALIDATION: War der Upload erfolgreich?
        if ($uploadWorked == 0) {
            $returnarray["dbmessage"] .= " Der Upload hat nicht funktioniert.";
            $returnarray["imageuploadfailed"] =true;
        } else {

            if (move_uploaded_file($files["filepath"]["tmp_name"], $imagePathFullsize)) {

                self::createThumbnail($imagePathFullsize, $imagePathThumbnails);



                $returnarray["dbmessage"] .= " Das Bild " . basename($files["filepath"]["name"]) . " wurde hinzugefügt.";
                $returnarray["parentid"] = 0;

                if (isset($_SESSION["actualboxid"])) $returnarray["parentid"] = intval($_SESSION["actualboxid"]);
                $conn = self::connect();
                $imagetitle = $conn->real_escape_string($data['imagetitle']);
                $id = intval($_SESSION["id"]);
                $stmt = $conn->prepare("INSERT INTO Image (Imagetitle, ImageLink, User_ID) VALUE (?,?,?)");
                $stmt->bind_param("sss", $imagetitle, $imageNameFullsize, $id);
                $stmt->execute();
                $returnarray["newimageid"] = $stmt->insert_id;
                $returnarray["dbmessage"] .= $conn->error;
                $returnarray["imageuploadfailed"] = false;
                $returnarray = self::insertintoboxandboxuser($returnarray, $conn);

            } else {
                echo"movefilenotworked";
                $returnarray["dbmessage"] .= " Upload-Error.";

            }
        }


        return $returnarray;
    }

    public static function createThumbnail($srcPath, $dstPath){

        $imagefile = $srcPath;
        $imagesize = getimagesize($srcPath);
        $imagewidth = $imagesize[0];
        $imageheight = $imagesize[1];
        $imagetype = $imagesize[2];


        switch ($imagetype)
        {
            case 1:
                $image = imagecreatefromgif($imagefile);
                break;
            case 2:
                $image = imagecreatefromjpeg($imagefile);
                break;
            case 3:
                $image = imagecreatefrompng($imagefile);
                break;
            default:
                die('Unsupported image format');
        }

        $maxthumbwidth = 300;
        $maxthumbheight = 450;

        $thumbwidth = $imagewidth;
        $thumbheight = $imageheight;

        if ($thumbwidth > $maxthumbwidth)
        {
            $factor = $maxthumbwidth / $thumbwidth;
            $thumbwidth *= $factor;
            $thumbheight *= $factor;
        }

        if ($thumbheight > $maxthumbheight)
        {
            $factor = $maxthumbheight / $thumbheight;
            $thumbwidth *= $factor;
            $thumbheight *= $factor;
        }


        $thumbnail = imagecreatetruecolor($thumbwidth, $thumbheight);
        imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $thumbwidth, $thumbheight, $imagewidth, $imageheight);
        imagejpeg($thumbnail, $dstPath, 90);
        imagedestroy($thumbnail);
        imagedestroy($image);
    }



    public static function createnote($data)
    {
        $returnarray["parentid"] = 0;
        if (isset($_SESSION["actualboxid"])) $returnarray["parentid"] = intval($_SESSION["actualboxid"]);
        $conn = self::connect();
        $notetitle = $conn->real_escape_string($data['noteheader']);
        $notetext = $conn->real_escape_string($data['notetext']);
        $id = intval($_SESSION["id"]);
        $stmt = $conn->prepare("INSERT INTO Note (Notetitle, Notetext, User_ID) VALUE (?,?,?)");
        $stmt->bind_param("sss", $notetitle, $notetext, $id);
        $stmt->execute();
        $returnarray["newnoteid"] = $stmt->insert_id;
        $returnarray["dbmessage"] = $conn->error;
        $returnarray = self::insertintoboxandboxuser($returnarray, $conn);
        return $returnarray;
    }

// benötigt returnarray mit parametern "newimageid" und "newnoteid"
    private static function insertintoboxandboxuser($returnarray, $conn)
    {
        $returnarray["dbmessage"] = $returnarray["dbmessage"];
        if (isset($returnarray["newimageid"])) {
            $typecollumn = 'Image_ID';
            $newcontentid = $returnarray["newimageid"];
        } elseif (isset($returnarray["newnoteid"])) {
            $typecollumn = 'Note_ID';
            $newcontentid = $returnarray["newnoteid"];
        } elseif (isset($returnarray["newcollectionid"])) {
            $typecollumn = 'Collection_ID';
            $newcontentid = $returnarray["newcollectionid"];
        } else $returnarray["dbmessage"] .= ". No conntenttype recieved. ";

        $parentid = $returnarray["parentid"];
        $stmt = $conn->query("INSERT INTO Box (ParentBoxID, $typecollumn)VALUE ($parentid , $newcontentid)");
        $newboxid = $conn->insert_id;
        $returnarray["newboxid"] = $newboxid;
        if ($stmt) {
            $returnarray["dbmessage"] .= " Box insert sucessfull.";
        } else {
            $returnarray["dbmessage"] .= " Box insert failed.";
        }
        if (isset($returnarray["userid"])) $id = $returnarray["userid"];
        else $id = $_SESSION["id"];
        $stmt = $conn->query("INSERT INTO User_Box(User_ID, Box_ID)VALUE ($id,$newboxid)");
        if ($stmt) {
            $returnarray["dbmessage"] .= " User_Box insert sucessfull.";
        } else {
            $returnarray["dbmessage"] .= " User_Box insert failed.";
        }

        return $returnarray;
    }

    public static function getmaincollections()
    {
        $userid = $_SESSION["id"];
        $conn = self::connect();
        $result = $conn->query("SELECT Collectiontitle, ID_Box, ID_Collection FROM User_Box JOIN Box on User_Box.Box_ID = Box.ID_Box JOIN Collection ON Box.Collection_ID = Collection.ID_Collection WHERE User_Box.User_ID = $userid AND Box.ParentBoxID = 0");
        $returnarray["dbmessage"] = $conn->error;


        if ($result) {
            $returnarray["rowcount"] = $result->num_rows;
            while ($row = $result->fetch_assoc()) {
                array_push($returnarray, $row);

                $returnarray["dbmessage"] .= "select maincollection sucessfull";
            }
        } else {
            $returnarray["dbmessage"] .= "select maincollection failed";
        }
        return $returnarray;
    }

    public static function getcollection()
    {
        if (isset($_SESSION["actualboxid"])) {
            $boxid = $_SESSION["actualboxid"];
            $userid = $_SESSION["id"];
            $conn = db::connect();
            $result = $conn->query("SELECT Collectiontitle, ID_Box FROM User_Box JOIN Box on User_Box.Box_ID = Box.ID_Box JOIN Collection ON Box.Collection_ID = Collection.ID_Collection WHERE User_Box.User_ID = $userid AND Box.ID_Box = $boxid");
            $returnarray["dbmessage"] = $conn->error;

            if ($result) {
                $returnarray["rowcount"] = $result->num_rows;
                $returnarray["dbmessage"] .= "select collection successfull";
                while ($row = $result->fetch_assoc()) {
                    array_push($returnarray, $row);
                }
            } else {
                $returnarray["dbmessage"] .= "select collection failed";
            }
            return $returnarray;
        }
    }

    public static function getcollectioncontent()
    {
        $parrentid = $_SESSION["actualboxid"];
        $userid = $_SESSION["id"];
        $conn = db::connect();
        $result = $conn->query("SELECT Note_ID, Image_ID, ID_Box, Collection_ID FROM Box JOIN User_Box ON Box.ID_Box = User_Box.Box_ID WHERE ParentBoxID = $parrentid AND User_ID= $userid");
        $returnarray["dbmessage"] = $conn->error;
        if ($result) {
            $returnarray["dbmessage"] = "Select Box Content successfull";
            $returnarray["rowcount"] = $result->num_rows;
            while ($row = $result->fetch_assoc()) {
                array_push($returnarray, $row);
            }
        } else {
            $returnarray["dbmessage"] .= "Select Box Content failed";
        }
        return $returnarray;
    }

    public static function gettypecontent($type, $typeid)
    {

        $conn = db::connect();
        $result = $conn->query("SELECT * FROM $type WHERE ID_$type = $typeid");
        $returnarray["dbmessage"] = $conn->error;
        if ($result) {
            $returnarray["dbmessage"] = "Select $type successfull";
            $returnarray["rowcount"] = $result->num_rows;
            while ($row = $result->fetch_assoc()) {
                array_push($returnarray, $row);
            }
        } else {
            $returnarray["dbmessage"] .= "Select $type failed";
        }
        return $returnarray;
    }

    public static function updatecollection($data)
    {
        $boxid = $_SESSION["actualboxid"];
        $conn = db::connect();
        $newcollectiontitle = $conn->real_escape_string($data["newtitle"]);
        $stmt = $conn->prepare("UPDATE Collection SET Collection.Collectiontitle = ? WHERE ID_Collection = (SELECT Collection_ID FROM Box WHERE ID_Box = ?)");
        $stmt->bind_param("ss", $newcollectiontitle, $boxid);
        $stmt->execute();
        $returnarray["dbmessage"] = $stmt->error;
        $returnarray["dbmessage"] .= "update";
        $stmt->close();
        $conn->close();
        return $returnarray;
    }

    public static function deletecollection()
    {
        $boxid = $boxid = $_SESSION["actualboxid"];
        $userid = $_SESSION["id"];
        $conn = db::connect();
        $conn->query("DELETE FROM User_Box WHERE Box_ID = $boxid AND User_ID = $userid");
        $conn->query("DELETE FROM Box WHERE ID_Box = $boxid");
        $returnarray["dbmessage"] = $conn->error;
        return $returnarray;
    }

    public static function deletetypecontent($data)
    {
        $boxid = $data["boxid"];
        $userid = $_SESSION["id"];
        $conn = db::connect();
        $conn->query("DELETE FROM User_Box WHERE Box_ID = $boxid AND User_ID = $userid");
        $conn->query("DELETE FROM Box WHERE ID_Box = $boxid");
    }

//TODO: delete if not needed
    public static function select($table, $userid = null)
    {
        $conn = self::connect();
        if (empty($userid)) {
            $result = $conn->query("SELECT * FROM $table");
        } elseif (isset($userid)) {
            $result = $conn->query("SELECT * FROM $table WHERE ID_User like $userid");
        }
        if ($result) {
            $returnarray["dbmessage"] = "successfull";
            while ($row = $result->fetch_assoc()) {
                array_push($returnarray, $row);
            }
            $result->free();
        } else {
            $returnarray["dbmessage"] = "failed";
        }
        $conn->close();
        return $returnarray;
    }

}
