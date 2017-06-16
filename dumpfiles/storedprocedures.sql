USE nobox;

DROP PROCEDURE IF EXISTS sp_createcollection;


DELIMITER $$
CREATE PROCEDURE sp_createcollection(IN newUser_ID INT(11), IN newboxtitle VARCHAR(255), IN newparentboxID INT(11))
MODIFIES SQL DATA
  COMMENT 'Inserts a Collection into Table Collection and a corresponding Box into Table Box'
  BEGIN
    INSERT INTO collection (User_ID) VALUE (newUser_ID);
    SELECT @newcollection := LAST_INSERT_ID();
    INSERT INTO box (Boxtitle, ParentBoxID, Collection_ID) VALUE (newboxtitle, newparentboxID, @newcollection);

  END $$
DELIMITER ;





# DELIMITER
# CREATE PROCEDURE sp_insertimage(Imagelink INT(255),Title INT(255),User_ID INT(11),Parrentbox_ID INT(11))
#d