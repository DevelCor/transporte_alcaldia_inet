SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema transporte_alcaldia
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema transporte_alcaldia
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `transporte_alcaldia` DEFAULT CHARACTER SET utf8 ;
USE `transporte_alcaldia` ;

-- -----------------------------------------------------
-- Table `transporte_alcaldia`.`company`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transporte_alcaldia`.`company` (
                                                            `id` INT NOT NULL AUTO_INCREMENT,
                                                            `name` VARCHAR(45) NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transporte_alcaldia`.`places`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transporte_alcaldia`.`places` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transporte_alcaldia`.`routes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transporte_alcaldia`.`routes` (
                                                          `id` INT NOT NULL AUTO_INCREMENT,
                                                          `name` VARCHAR(45) NULL,
    `price` DECIMAL NOT NULL,
    `company_id` INT NOT NULL,
    `start` INT NOT NULL,
    `middle` INT NOT NULL,
    `finish` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_routes_company_idx` (`company_id` ASC),
    INDEX `fk_routes_places1_idx` (`start` ASC),
    INDEX `fk_routes_places2_idx` (`finish` ASC),
    CONSTRAINT `fk_routes_company`
    FOREIGN KEY (`company_id`)
    REFERENCES `transporte_alcaldia`.`company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_routes_places1`
    FOREIGN KEY (`start`)
    REFERENCES `transporte_alcaldia`.`places` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_routes_places2`
    FOREIGN KEY (`finish`)
    REFERENCES `transporte_alcaldia`.`places` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transporte_alcaldia`.`review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transporte_alcaldia`.`review` (
                                                                `id` INT NOT NULL AUTO_INCREMENT,
                                                                `comment` VARCHAR(300) NOT NULL,
    `first_name` VARCHAR(45) NOT NULL,
    `last_name` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `phone` VARCHAR(11) NOT NULL,
    `company_id` INT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_review_company1_idx` (`company_id` ASC),
    CONSTRAINT `fk_review_company1`
    FOREIGN KEY (`company_id`)
    REFERENCES `transporte_alcaldia`.`company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `transporte_alcaldia`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transporte_alcaldia`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC))
    ENGINE = InnoDB;


