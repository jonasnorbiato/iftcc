-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: IFTCC_BD
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*vavasdvasdvasdv*/;
--
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administradores` (
  `id_usuario_fk` int(11) NOT NULL,
  `email_administrador` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario_fk`),
  KEY `fk_administradores_usuarios1_idx` (`id_usuario_fk`),
  CONSTRAINT `fk_administradores_usuarios1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (33,'admin.if@gmail.com');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunos` (
  `nome_aluno` varchar(90) NOT NULL,
  `email_aluno` varchar(50) DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `id_curso_fk` int(11) NOT NULL,
  `id_projeto_fk` int(11) DEFAULT NULL,
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_aluno`),
  KEY `fk_Aluno_Usuario1_idx` (`id_usuario_fk`),
  KEY `fk_Aluno_Curso1_idx` (`id_curso_fk`),
  KEY `fk_Aluno_Banca1_idx` (`id_projeto_fk`),
  CONSTRAINT `fk_Aluno_Banca1` FOREIGN KEY (`id_projeto_fk`) REFERENCES `projetos` (`id_projeto`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aluno_Curso1` FOREIGN KEY (`id_curso_fk`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aluno_Usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alunos`
--

LOCK TABLES `alunos` WRITE;
/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` VALUES ('Highor de Souza Rizzi',NULL,35,1,2,1),('Kesse Jones',NULL,36,1,NULL,2),('Amanda Pinheiro',NULL,37,1,1,3),('Gustavo DX',NULL,38,1,NULL,4);
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancas`
--

DROP TABLE IF EXISTS `bancas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bancas` (
  `id_professor_fk` int(11) NOT NULL,
  `id_projeto_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_professor_fk`,`id_projeto_fk`),
  KEY `fk_professores_has_projetos_projetos1_idx` (`id_projeto_fk`),
  KEY `fk_professores_has_projetos_professores1_idx` (`id_professor_fk`),
  CONSTRAINT `fk_professores_has_projetos_professores1` FOREIGN KEY (`id_professor_fk`) REFERENCES `professores` (`id_professor`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_professores_has_projetos_projetos1` FOREIGN KEY (`id_projeto_fk`) REFERENCES `projetos` (`id_projeto`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancas`
--

LOCK TABLES `bancas` WRITE;
/*!40000 ALTER TABLE `bancas` DISABLE KEYS */;
INSERT INTO `bancas` VALUES (1,1),(2,1),(3,1);
/*!40000 ALTER TABLE `bancas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordenadores`
--

DROP TABLE IF EXISTS `coordenadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coordenadores` (
  `id_professor_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_curso_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_fk`,`id_professor_fk`),
  KEY `fk_Coordenador_Professor_idx` (`id_professor_fk`),
  KEY `fk_coordenadores_usuarios1_idx` (`id_usuario_fk`),
  KEY `fk_coordenadores_cursos1_idx` (`id_curso_fk`),
  CONSTRAINT `fk_Coordenador_Professor` FOREIGN KEY (`id_professor_fk`) REFERENCES `professores` (`id_professor`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_coordenadores_cursos1` FOREIGN KEY (`id_curso_fk`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_coordenadores_usuarios1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordenadores`
--

LOCK TABLES `coordenadores` WRITE;
/*!40000 ALTER TABLE `coordenadores` DISABLE KEYS */;
INSERT INTO `coordenadores` VALUES (1,34,1);
/*!40000 ALTER TABLE `coordenadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(120) NOT NULL,
  PRIMARY KEY (`id_curso`),
  UNIQUE KEY `id_curso_UNIQUE` (`id_curso`),
  UNIQUE KEY `nome_curso_UNIQUE` (`nome_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos_dataapresentacoes`
--

DROP TABLE IF EXISTS `cursos_dataapresentacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos_dataapresentacoes` (
  `id_curso_fk` int(11) NOT NULL,
  `id_data_apresentacao_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_curso_fk`,`id_data_apresentacao_fk`),
  KEY `fk_cursos_has_dataapresentacoes_dataapresentacoes1_idx` (`id_data_apresentacao_fk`),
  KEY `fk_cursos_has_dataapresentacoes_cursos1_idx` (`id_curso_fk`),
  CONSTRAINT `fk_cursos_has_dataapresentacoes_cursos1` FOREIGN KEY (`id_curso_fk`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cursos_has_dataapresentacoes_dataapresentacoes1` FOREIGN KEY (`id_data_apresentacao_fk`) REFERENCES `dataapresentacoes` (`id_data_apresentacao`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos_dataapresentacoes`
--

LOCK TABLES `cursos_dataapresentacoes` WRITE;
/*!40000 ALTER TABLE `cursos_dataapresentacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos_dataapresentacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos_professores`
--

DROP TABLE IF EXISTS `cursos_professores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos_professores` (
  `id_curso_fk` int(11) NOT NULL,
  `id_professor_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_curso_fk`,`id_professor_fk`),
  KEY `fk_Curso_has_Professor_Professor1_idx` (`id_professor_fk`),
  KEY `fk_Curso_has_Professor_Curso1_idx` (`id_curso_fk`),
  CONSTRAINT `fk_Curso_has_Professor_Curso1` FOREIGN KEY (`id_curso_fk`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Curso_has_Professor_Professor1` FOREIGN KEY (`id_professor_fk`) REFERENCES `professores` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos_professores`
--

LOCK TABLES `cursos_professores` WRITE;
/*!40000 ALTER TABLE `cursos_professores` DISABLE KEYS */;
INSERT INTO `cursos_professores` VALUES (1,1),(1,2),(1,3);
/*!40000 ALTER TABLE `cursos_professores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataapresentacoes`
--

DROP TABLE IF EXISTS `dataapresentacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataapresentacoes` (
  `id_data_apresentacao` int(11) NOT NULL AUTO_INCREMENT,
  `data_hora` datetime NOT NULL,
  PRIMARY KEY (`id_data_apresentacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataapresentacoes`
--

LOCK TABLES `dataapresentacoes` WRITE;
/*!40000 ALTER TABLE `dataapresentacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `dataapresentacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professores`
--

DROP TABLE IF EXISTS `professores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professores` (
  `id_professor` int(11) NOT NULL AUTO_INCREMENT,
  `nome_professor` varchar(35) NOT NULL,
  `sobrenome_professor` varchar(60) NOT NULL,
  `email_professor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_professor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professores`
--

LOCK TABLES `professores` WRITE;
/*!40000 ALTER TABLE `professores` DISABLE KEYS */;
INSERT INTO `professores` VALUES (1,'Pedro','DNS','jr.norbiato@hotmail.com'),(2,'João','Silva','jr.norbiato@gmail.com'),(3,'Danilo','Souza','jr.norbiato.bk@gmail.com');
/*!40000 ALTER TABLE `professores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projetos` (
  `id_projeto` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `id_data_apresentacao_fk` int(11) DEFAULT NULL,
  `id_curso_fk` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`id_projeto`),
  UNIQUE KEY `id_projeto_UNIQUE` (`id_projeto`),
  KEY `fk_projetos_dataapresentacoes1_idx` (`id_data_apresentacao_fk`),
  KEY `fk_projetos_cursos1_idx` (`id_curso_fk`),
  CONSTRAINT `fk_projetos_cursos1` FOREIGN KEY (`id_curso_fk`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_projetos_dataapresentacoes1` FOREIGN KEY (`id_data_apresentacao_fk`) REFERENCES `dataapresentacoes` (`id_data_apresentacao`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` VALUES (1,1,'Sistema de informação para Controlar a Qualidade do Solo',NULL,1,2017),(2,0,'Sistema de adubação ',NULL,1,2017);
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (33,'Administrador','$2y$10$VGK2k9rc2jxvlU.YIZa.b.t5XaM4X0.N5hz5A0fsslQboro03CU26'),(34,'pedrodns','$2y$10$zMtETAzxGVGwviNa2ZP6vu5N1jVX872VyQ7VBQySSrOwoA9WbEohu'),(35,' 20151stads0122','$2y$10$rFOPRG2NTWw9X3mjU5KWaeqpXUl1eFD8nFuaZJ4.UYcfCMrEUrix6'),(36,' 20151stads0133','$2y$10$PjjXHeDXs641qmPc16YfC.m8yBK4DZumzdSTjpfiC8wAKAIqLnRg6'),(37,'20141stads0333','$2y$10$kVdDJP.nLT0T0BzhX0Uhe.9NpL4cfPLmwGV2aYYgY1u7IHO5f7l0K'),(38,'20141stads3030','$2y$10$GkaDIi1lQC.jES3vf/woLuuErti/4SfkMdPL6OIH0o2pcaWaTGSvu');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-20  1:03:36
