CREATE TABLE `jjovero1_dmit2025`.`pop_girlies` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `stage_name` VARCHAR(200) NOT NULL , 
    `image_file_name` VARCHAR(500) NULL , 
    `artist_description` VARCHAR(1000) NOT NULL , 
    `current_label` VARCHAR(200) NOT NULL , 
    `debut_year` INT NOT NULL , 
    `num_of_albums` INT NOT NULL , 
    `latest_album_name` VARCHAR(200) NOT NULL ,
     `num_of_gramm_wins` INT NOT NULL , 
     `billboard_hot_100_count` INT NOT NULL , 
     `fandom_name` VARCHAR(200) NOT NULL AUTO_INCREMENT , 
     `instagram_link` VARCHAR(500) NOT NULL , 
     `total_ig_followers` INT NOT NULL , 
     
     PRIMARY KEY (`id`)) ENGINE = InnoDB;