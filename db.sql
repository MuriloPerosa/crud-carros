CREATE TABLE IF NOT EXISTS `carro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(155) DEFAULT NULL,
  `marca` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `carro` (`id`, `nome`, `marca`) VALUES
	(1, 'Punto', 'Fiat'),
	(2, 'Focus', 'Ford'),
	(3, 'Jetta', 'Volkswagen '),
	(4, 'Uno', 'Fiat'),
	(5, 'Gol', 'Volkswagen '),
	(6, 'Chevet', 'marca');
