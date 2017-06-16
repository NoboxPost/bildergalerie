
DROP DATABASE IF EXISTS bilderdb_wa_gallati;

CREATE DATABASE IF NOT EXISTS bilderdb_wa_gallati;
USE bilderdb_wa_gallati;

CREATE TABLE IF NOT EXISTS Users (
  ID_User      INT           NOT NULL AUTO_INCREMENT,
  Username     VARCHAR(30)   NOT NULL,
  first        VARCHAR(255),
  last         VARCHAR(255),
  Emailaddress VARCHAR(30)   NOT NULL,
  Hash         VARCHAR(1000) NOT NULL,
  UserPiclink  VARCHAR(255),
  CONSTRAINT pk_users PRIMARY KEY (ID_User),
  CONSTRAINT uk_user_username UNIQUE KEY (Username),
  CONSTRAINT uk_user_email UNIQUE KEY (Emailaddress)
);
# -----------Vorerst nur Images
# create table if not exists Images(
# ID_Images int not null auto_increment,
# ImageLink varchar(255) not null,
# User_ID int not null,
# constraint pk_images primary key (ID_Images),
# constraint fk_images_users foreign key (User_Id) references Users(ID_User)
# );

# create table if not exists Gallery(
# ID_Gallery int not null auto_increment,
# User_ID int not null,
# constraint pk_gallery primary key (ID_Gallery),
# constraint fk_gallery_users foreign key (User_ID) references Users(ID_User)
# );
#
# create table if not exists Gallery_Images(
# ID_Gallery_Images int not null auto_increment,
# Gallery_ID int not null,
# Images_ID int not null,
# constraint pk_gallery_images primary key (ID_Gallery_Images),
# constraint fk_gallery_images_gallery foreign key (Gallery_ID) references Gallery(ID_Gallery),
# constraint fk_gallery_images_images foreign key (Images_ID) references Images(ID_Images)
# );

CREATE TABLE IF NOT EXISTS Image (
  ID_Image  INT          NOT NULL AUTO_INCREMENT,
  Imagetitle VARCHAR(255)NOT NULL,
  ImageLink VARCHAR(255) NOT NULL,
  User_ID   INT          NOT NULL,
  CONSTRAINT pk_image PRIMARY KEY (ID_Image),
  CONSTRAINT fk_image_user FOREIGN KEY (User_ID) REFERENCES Users (ID_User),
  CONSTRAINT uk_image_imagelink UNIQUE KEY (ImageLink)
);

CREATE TABLE IF NOT EXISTS Note (
  ID_Note  INT NOT NULL AUTO_INCREMENT,
  Notetitle VARCHAR(255) NOT NULL,
  Notetext TEXT,
  User_ID  INT NOT NULL,
  CONSTRAINT pk_note PRIMARY KEY (ID_Note),
  CONSTRAINT fk_note_users FOREIGN KEY (User_ID) REFERENCES Users (ID_User)
);

CREATE TABLE IF NOT EXISTS Collection (
  ID_Collection INT NOT NULL AUTO_INCREMENT,
  Collectiontitle VARCHAR(255) NOT NULL,
  User_ID       INT NOT NULL,
  CONSTRAINT pk_collection PRIMARY KEY (ID_Collection),
  CONSTRAINT fk_collection_users FOREIGN KEY (User_ID) REFERENCES Users (ID_User)
);

CREATE TABLE IF NOT EXISTS Box (
  ID_Box               INT          NOT NULL AUTO_INCREMENT,
#   Boxtitle             VARCHAR(255) NOT NULL,
  ParentBoxID          INT,
  Note_ID              INT,
  Image_ID              INT,
#   Gallery_ID           INT,
  Collection_ID        INT,
  Creation_Timestamp   TIMESTAMP             DEFAULT current_Timestamp,
  Change_Timestamp     TIMESTAMP ON UPDATE current_Timestamp,
  PositionInCollection TINYINT,
  CONSTRAINT pk_box PRIMARY KEY (ID_Box),
  CONSTRAINT uk_box UNIQUE KEY (Note_ID, Image_ID, Collection_ID),
#   CONSTRAINT uk_box UNIQUE KEY (Note_ID, Gallery_ID, Collection_ID),
  CONSTRAINT fk_box_note FOREIGN KEY (Note_ID) REFERENCES Note (ID_Note),
  CONSTRAINT fk_box_image FOREIGN KEY (Image_ID) REFERENCES Image (ID_Image),
#   CONSTRAINT fk_box_gallery FOREIGN KEY (Gallery_ID) REFERENCES Gallery (ID_Gallery),

  CONSTRAINT fk_box_collection FOREIGN KEY (Collection_Id) REFERENCES Collection (ID_Collection)
);

CREATE TABLE IF NOT EXISTS User_Box (
  ID_User_Box INT NOT NULL AUTO_INCREMENT,
  User_ID     INT NOT NULL,
  Box_ID      INT NOT NULL,
  CONSTRAINT pk_users_box PRIMARY KEY (ID_User_Box),
  CONSTRAINT fk_users_box_users FOREIGN KEY (User_ID) REFERENCES Users (ID_User),
  CONSTRAINT fk_user_box_box FOREIGN KEY (Box_ID) REFERENCES Box (ID_Box)
);

