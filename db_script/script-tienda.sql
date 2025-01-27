-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema tienda
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `tienda` ;

-- -----------------------------------------------------
-- Schema tienda
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tienda` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

USE `tienda` ;

-- -----------------------------------------------------
-- Table `tienda`.`categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tienda`.`categoria` ;

CREATE TABLE IF NOT EXISTS `tienda`.`categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tienda`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tienda`.`clientes` ;

CREATE TABLE IF NOT EXISTS `tienda`.`clientes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tienda`.`proveedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tienda`.`proveedores` ;

CREATE TABLE IF NOT EXISTS `tienda`.`proveedores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `web` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tienda`.`productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tienda`.`productos` ;

CREATE TABLE IF NOT EXISTS `tienda`.`productos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `precio` DECIMAL(6,2) NULL DEFAULT NULL,
  `stock` INT(11) NULL DEFAULT NULL,
  `categoria_id` INT(11) NOT NULL,
  `proveedores_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_productos_categoria1_idx` (`categoria_id` ASC),
  INDEX `fk_productos_proveedores1_idx` (`proveedores_id` ASC),
  CONSTRAINT `fk_productos_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `tienda`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_proveedores1`
    FOREIGN KEY (`proveedores_id`)
    REFERENCES `tienda`.`proveedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tienda`.`ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tienda`.`ventas` ;

CREATE TABLE IF NOT EXISTS `tienda`.`ventas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL DEFAULT NULL,
  `descuento` DECIMAL(3,2) NULL DEFAULT NULL,
  `clientes_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ventas_clientes1_idx` (`clientes_id` ASC),
  CONSTRAINT `fk_ventas_clientes1`
    FOREIGN KEY (`clientes_id`)
    REFERENCES `tienda`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tienda`.`detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tienda`.`detalle` ;

CREATE TABLE IF NOT EXISTS `tienda`.`detalle` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ventas_id` INT(11) NOT NULL,
  `productos_id` INT(11) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  `precio` DECIMAL(6,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_detalle_ventas1_idx` (`ventas_id` ASC),
  INDEX `fk_detalle_productos1_idx` (`productos_id` ASC),
  CONSTRAINT `fk_detalle_productos1`
    FOREIGN KEY (`productos_id`)
    REFERENCES `tienda`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_ventas1`
    FOREIGN KEY (`ventas_id`)
    REFERENCES `tienda`.`ventas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tienda`.`direcciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tienda`.`direcciones` ;

CREATE TABLE IF NOT EXISTS `tienda`.`direcciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `calle` VARCHAR(255) NULL DEFAULT NULL,
  `num` VARCHAR(5) NULL DEFAULT NULL,
  `comuna` VARCHAR(45) NULL DEFAULT NULL,
  `ciudad` VARCHAR(45) NULL DEFAULT NULL,
  `clientes_id` INT(11) NULL DEFAULT NULL,
  `proveedores_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_direcciones_clientes_idx` (`clientes_id` ASC),
  INDEX `fk_direcciones_proveedores1_idx` (`proveedores_id` ASC),
  CONSTRAINT `fk_direcciones_clientes`
    FOREIGN KEY (`clientes_id`)
    REFERENCES `tienda`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_direcciones_proveedores1`
    FOREIGN KEY (`proveedores_id`)
    REFERENCES `tienda`.`proveedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tienda`.`telefonos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tienda`.`telefonos` ;

CREATE TABLE IF NOT EXISTS `tienda`.`telefonos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `clientes_id` INT(11) NULL DEFAULT NULL,
  `proveedores_id` INT(11) NULL DEFAULT NULL,
  `numero` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_telefonos_clientes1_idx` (`clientes_id` ASC),
  INDEX `fk_telefonos_proveedores1_idx` (`proveedores_id` ASC),
  CONSTRAINT `fk_telefonos_clientes1`
    FOREIGN KEY (`clientes_id`)
    REFERENCES `tienda`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_telefonos_proveedores1`
    FOREIGN KEY (`proveedores_id`)
    REFERENCES `tienda`.`proveedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
