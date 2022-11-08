CREATE TABLE recept (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NULL,
  `description` MEDIUMTEXT NULL,
  `stars` DECIMAL(2,2) NOT NULL DEFAULT 0,0,
  `port` INT NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_recept_User_idx` (`User_id` ASC) VISIBLE,
  FOREIGN KEY (`User_id`) REFERENCES User(id)
)

CREATE TABLE instructions (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` MEDIUMTEXT NULL,
  `timer` TINYINT NULL DEFAULT 0,
  `time` TIMESTAMP NULL,
  PRIMARY KEY (`id`)
)

CREATE TABLE Ingredients (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Ingredient` VARCHAR(90) NOT NULL,
  `amount` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`)
)

CREATE TABLE tags (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NULL,
  PRIMARY KEY (`id`)
)

CREATE TABLE instructionsTillRecept (
  `id` INT NOT NULL AUTO_INCREMENT,
  `instructions_id` INT NOT NULL,
  `recept_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_instructionsTillRecept_instructions1_idx` (`instructions_id` ASC) VISIBLE,
  INDEX `fk_instructionsTillRecept_recept1_idx` (`recept_id` ASC) VISIBLE,
  FOREIGN KEY (`instructions_id`) REFERENCES instructions (id)
  FOREIGN KEY (`recept_id`) REFERENCES recept (id)
)

CREATE TABLE IngredientsTillRecept (
  `id` INT NOT NULL AUTO_INCREMENT,
  `recept_id` INT NOT NULL,
  `Ingredients_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_IngredientsTillRecept_recept1_idx` (`recept_id` ASC) VISIBLE,
  INDEX `fk_IngredientsTillRecept_Ingredients1_idx` (`Ingredients_id` ASC) VISIBLE,
  FOREIGN KEY (`recept_id`) REFERENCES recept (id),
  FOREIGN KEY (`Ingredients_id`) REFERENCES Ingredients (id)
)

CREATE TABLE tagsTillRecept (
  `id` INT NOT NULL AUTO_INCREMENT,
  `recept_id` INT NOT NULL,
  `tags_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tagsTillRecept_recept1_idx` (`recept_id` ASC) VISIBLE,
  INDEX `fk_tagsTillRecept_tags1_idx` (`tags_id` ASC) VISIBLE,
  FOREIGN KEY (`recept_id`) REFERENCES recept (id),
  FOREIGN KEY (`tags_id`) REFERENCES tags (id)
)
