-- phpMyAdmin SQL Dump
-- version 4.6.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 05, 2017 alle 23:43
-- Versione del server: 5.5.53-MariaDB
-- Versione PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `archisti_hb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `casaeditrice`
--

CREATE TABLE `casaeditrice` (
  `idcasaeditrice` int(11) NOT NULL,
  `casaeditrice` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `casaeditrice`
--

INSERT INTO `casaeditrice` (`idcasaeditrice`, `casaeditrice`) VALUES
(1, 'Elmi\'s World'),
(2, 'Le Brumaie'),
(4, 'Il Ciliegio'),
(5, 'Astragalo'),
(6, 'Onirica'),
(7, 'Dalla Costa'),
(8, 'Arterigere'),
(9, 'Runa'),
(10, 'Dielle'),
(12, 'Faligi'),
(13, 'Musumeci'),
(14, 'Le Chateau Edizioni'),
(15, 'Conti Editore'),
(16, 'Federighi Editore'),
(17, 'La Linea Edizioni'),
(18, 'Lineadaria');

-- --------------------------------------------------------

--
-- Struttura della tabella `collane`
--

CREATE TABLE `collane` (
  `idcollana` int(11) NOT NULL,
  `collana` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `collane`
--

INSERT INTO `collane` (`idcollana`, `collana`, `cancellato`) VALUES
(1, 'Saggi romanzati', 0),
(2, 'Parole in libertà', 0),
(3, 'Conoscere il mondo', 0),
(4, 'Racconti', 0),
(5, 'Arcobaleno', 0),
(6, 'Traduzioni', 0),
(7, 'Altri editori', 0),
(8, 'Saggi', 0),
(9, 'Boston40', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `contrattiedizione`
--

CREATE TABLE `contrattiedizione` (
  `idcontrattoedizione` int(11) NOT NULL,
  `fklibro` int(11) DEFAULT NULL,
  `fkautore` int(11) NOT NULL,
  `datainizio` date NOT NULL,
  `datafine` date NOT NULL,
  `percentualeiniziale` decimal(6,3) NOT NULL DEFAULT '0.000',
  `percentualefinale` decimal(6,3) NOT NULL DEFAULT '0.000',
  `copiesostegno` int(11) NOT NULL,
  `fklibroebook` int(11) DEFAULT NULL,
  `percentualeebook` decimal(6,3) NOT NULL DEFAULT '0.000',
  `note` text COLLATE utf8_unicode_ci,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `iva`
--

CREATE TABLE `iva` (
  `idiva` int(11) NOT NULL,
  `aliquota` double NOT NULL,
  `datainizio` date NOT NULL,
  `fktipologia` int(11) NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `iva`
--

INSERT INTO `iva` (`idiva`, `aliquota`, `datainizio`, `fktipologia`, `cancellato`) VALUES
(1, 4, '1997-10-01', 1, 0),
(2, 20, '1997-10-01', 2, 0),
(3, 21, '2011-09-17', 2, 0),
(4, 22, '2013-10-01', 2, 0),
(7, 20, '1997-10-01', 3, 0),
(8, 21, '2011-09-17', 3, 0),
(9, 22, '2013-10-01', 3, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE `libri` (
  `idlibro` int(11) NOT NULL,
  `fkcasaeditrice` int(11) NOT NULL,
  `titolo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sottotitolo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pagine` int(11) NOT NULL,
  `prezzo` double NOT NULL,
  `fkcollana` int(11) NOT NULL,
  `fktipologia` int(11) NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`idlibro`, `fkcasaeditrice`, `titolo`, `sottotitolo`, `isbn`, `pagine`, `prezzo`, `fkcollana`, `fktipologia`, `cancellato`) VALUES
(1, 1, 'Due non è il doppio di uno', 'La bisessualità come orientamento', '978-88-97192-00-8', 290, 18.4, 1, 1, 0),
(2, 1, 'I quattro re', '', '978-88-97192-01-5', 340, 18.8, 2, 1, 0),
(3, 1, 'Ossigeno', '', '978-88-97192-02-2', 172, 14.7, 3, 1, 0),
(4, 1, 'Emozioni veneziane', '', '978-88-97192-04-6', 102, 13, 2, 1, 0),
(5, 1, 'Di regine, di sante e di streghe', '', '978-88-97192-03-9', 130, 15, 1, 1, 0),
(6, 1, 'L\'occasione fa l\'uomo laico', '', '978-88-97192-05-3', 236, 16.5, 3, 1, 0),
(7, 1, 'Storia di un processo inquisitorio', 'Gostanza da Libbiano', '978-88-97192-07-7', 144, 15, 1, 1, 0),
(8, 1, 'Uova sbattute', '', '978-88-97192-06-0', 104, 12, 2, 1, 0),
(13, 1, 'Il lungo inverno di Spitak', '', '978-88-97192-08-4', 232, 16, 1, 1, 0),
(14, 1, 'Sogni inquinati', '', '978-88-97192-09-1', 104, 7, 2, 1, 0),
(15, 1, 'Due non è il doppio di uno', '', '978-88-97192-10-7', 0, 9.99, 1, 2, 0),
(16, 1, 'I quattro re', '', '978-88-97192-11-4', 0, 5.99, 2, 2, 0),
(17, 1, 'Ossigeno', '', '978-88-97192-12-1', 0, 6.49, 3, 2, 0),
(18, 1, 'Di regine, di sante e di streghe', '', '978-88-97192-14-1', 0, 8.99, 1, 2, 0),
(19, 1, 'Emozioni veneziane', '', '978-88-97192-15-2', 0, 4.49, 2, 2, 0),
(20, 1, 'L\'occasione fa l\'uomo laico', '', '978-88-97192-16-9', 0, 8.99, 3, 2, 0),
(21, 1, 'Uova sbattute', '', '978-88-97192-17-6', 0, 6.49, 2, 2, 0),
(22, 1, 'Storia di un processo inquisitorio', 'Gostanza da Libbiano', '978-88-97192-18-3', 0, 8.99, 1, 2, 0),
(23, 1, 'Il lungo inverno di Spitak', '', '978-88-97192-19-0', 0, 8.99, 1, 2, 0),
(24, 1, 'Sogni inquinati', '', '978-88-97192-20-6', 0, 1.49, 2, 2, 0),
(25, 1, 'Poi, ho smesso', '', '978-88-97192-21-3', 176, 12, 2, 1, 0),
(26, 1, 'Poi, ho smesso', '', '978-88-97192-22-0', 0, 6.49, 2, 2, 0),
(27, 1, 'Storie di fate, di dee e di eroi', '', '978-88-97192-13-8', 200, 16, 1, 1, 0),
(28, 1, 'Cripta', '', '978-88-97192-24-4', 0, 15, 2, 1, 0),
(29, 1, 'Domina Herbarum', 'Storia di una guaritrice nella Toscana dei Medici', '978-88-97192-23-7', 48, 10.5, 1, 1, 0),
(30, 1, 'Il custode di Izu', '', '978-88-97192-26-8', 72, 5, 2, 1, 0),
(31, 1, 'L\'origine delle parole', 'Vita e opere di Pompilio Sulbus tentato di pensare', '978-88-97192-40-4', 0, 0.99, 4, 2, 0),
(32, 1, 'Oxygen', '', '978-88-97192-25-1', 0, 4.99, 6, 2, 0),
(33, 2, 'Ninna Nanna', '', '978-88-96570-20-3', 0, 9, 7, 1, 0),
(34, 2, 'Totem et Manitou', '', '978-88-96570-28-9', 0, 9, 7, 1, 0),
(35, 2, 'Giovannino l\'asfodelo - francese', 'Quattro favole di beata innocenza', '978-88-96570-93-7', 56, 11, 7, 1, 0),
(36, 2, 'La prima vendemmia', 'Margherita. Favole fra gnomi e folletti. Vol. 1', '978-88-902599-7-5', 24, 9, 7, 1, 0),
(37, 2, 'Pippiolino', '', '978-88-96570-25-8', 0, 9, 7, 1, 0),
(38, 12, 'Al di là del fiume', '', '978-88-574-1694-6', 152, 16, 7, 1, 0),
(39, 2, 'Ricette senza pensieri', '', '978-88-902599-1-3', 0, 29, 7, 1, 0),
(40, 2, 'Le cucine dell\'anima', '', '978-88-96570-09-8', 0, 9, 7, 1, 0),
(41, 2, 'I mondi di Flic', '', '978-88-965701-2-8', 0, 16, 7, 1, 0),
(42, 2, 'Indaco e violetto', '', '978-88-965700-1-2', 0, 9, 7, 1, 0),
(43, 2, 'No gluten no problem', '', '978-88-96570-31-9', 0, 18, 7, 1, 0),
(44, 2, 'Canapa italiana', '', '978-88-96570-18-0', 0, 18, 7, 1, 0),
(45, 2, 'La città sul mare', '', '978-88-96570-23-4', 0, 12, 7, 1, 0),
(46, 2, 'Napi delle stelle', '', '978-88-96570-22-7', 0, 20, 7, 1, 0),
(47, 2, 'Ikhiwa', '', '978-88-902599-5-1', 0, 13, 7, 1, 0),
(48, 2, 'Le filastrocche di Gufobuffo', '', '978-88-96570-13-5', 0, 9, 7, 1, 0),
(49, 2, 'Il buffone millenario', '', '978-88-965700-4-3', 0, 9, 7, 1, 0),
(50, 2, 'Regina Dorotea', '', '978-88-902599-0-6', 0, 12, 7, 1, 0),
(51, 2, 'Pazza vacanza a Col Fiorito', '', '978-88-902599-2-0', 0, 12, 7, 1, 0),
(52, 2, 'Il fiore della verità', '', '978-88-96570-16-6', 0, 12, 7, 1, 0),
(53, 2, 'Evaristo', '', '978-88-XXXXX-XX-X', 0, 9, 7, 1, 0),
(54, 2, 'Ziggy la volpe', '', '978-88-96570-29-6', 0, 9, 7, 1, 0),
(56, 2, 'Il corvo Manitù', '', '978-88-96570-28-9', 0, 9, 7, 1, 0),
(57, 2, 'I cinghiali di Max', '', '978-88-96570-26-5', 0, 9, 7, 1, 0),
(58, 2, 'Max et le sanglier', '', '978-88-XXXXX-XX-X', 0, 9, 7, 1, 0),
(59, 2, 'Pupazzo pompiere', '', '978-88-XXXXX-XX-X', 0, 9, 7, 1, 0),
(60, 2, 'Lupo bianco', '', '978-88-96570-28-9', 0, 9, 7, 1, 0),
(61, 2, 'Maddy la medusa', '', '978-88-XXXXX-XX-X', 0, 9, 7, 1, 0),
(62, 2, 'Puzza di lupo', '', '978-88-96570-15-9', 0, 9, 7, 1, 0),
(63, 2, 'Olivia la talpa', '', '978-88-96570-27-2', 0, 9, 7, 1, 0),
(64, 2, 'Thermos', '', '978-88-XXXXX-XX-X', 0, 9, 7, 1, 0),
(65, 2, 'Amico lupo', '', '978-88-96570-38-8', 0, 9, 7, 1, 0),
(67, 2, 'Fior di terra', '', '978-88-96570-06-7', 0, 9, 7, 1, 0),
(68, 2, 'Fior di mare', '', '978-88-902599-9-9', 0, 9, 7, 1, 0),
(69, 2, 'Fior di vento', '', '978-88-902599-8-2', 0, 9, 7, 1, 0),
(70, 2, 'Fior di fuoco', '', '978-88-96570-08-1', 0, 9, 7, 1, 0),
(72, 2, 'Le colline viola', '', '978-88-902599-6-8', 0, 9, 7, 1, 0),
(73, 2, 'Orano lo scorfano', '', '978-88-96570-00-5', 0, 9, 7, 1, 0),
(74, 2, 'Giovannino l\'asfodelo', '', '978-88-96570-10-4', 0, 9, 7, 1, 0),
(75, 2, 'Gionni la renna', '', '978-88-96570-02-9', 0, 9, 7, 1, 0),
(76, 2, 'Gionni das rentier', '', '978-88-XXXXX-XX-X', 0, 9, 7, 1, 0),
(77, 2, 'Io sono il lupo', '', '978-88-96570-07-4', 0, 9, 7, 1, 0),
(78, 2, 'Il grande castagno', '', '978-88-96570-05-0', 0, 9, 7, 1, 0),
(79, 2, 'Pesce rosso Valentino', '', '978-88-96570-11-1', 0, 9, 7, 1, 0),
(80, 2, 'Lo scivolo', '', '978-88-96570-42-5', 0, 9, 7, 1, 0),
(81, 2, 'Guarda oltre', '', '978-88-96570-59-3', 0, 9, 7, 1, 0),
(82, 2, 'Chicco di sole', '', '978-88-96570-03-6', 0, 9, 7, 1, 0),
(83, 2, 'Maschere d\'Italia', '', '978-88-96570-35-7', 0, 9, 7, 1, 0),
(84, 2, 'Il signor Ombretta', '', '978-88-96570-32-6', 0, 9, 7, 1, 0),
(85, 2, 'L\'arcobaleno perduto', '', '978-88-96570-33-3', 0, 9, 7, 1, 0),
(86, 2, 'Le maschere magiche. Billi & Poppy', '', '978-88-96570-58-6', 0, 9, 7, 1, 0),
(87, 2, 'Gattotto', '', '978-88-96570-14-2', 0, 9, 7, 1, 0),
(88, 2, 'Dino', '', '978-88-96570-34-0', 0, 9, 7, 1, 0),
(89, 2, 'Oltre l\'armadio', '', '978-88-XXXXX-XX-X', 0, 9, 7, 1, 0),
(91, 13, 'Champorcher ieri e oggi', '', '978-88-7032-891-2', 0, 22, 7, 1, 0),
(92, 13, 'Riti e feste in Valle d\'Aosta', '', '978-88-7032-897-4', 0, 28, 7, 1, 0),
(93, 13, 'Rites et fêtes en Vallée d\'Aoste', '', '978-88-7032-898-1', 0, 28, 7, 1, 0),
(94, 13, 'Andar per strade: Aosta', '', '978-88-7032-896-7', 0, 22, 7, 1, 0),
(95, 13, 'Qui sàat-te', '', '978-88-7032-881-3', 0, 22, 7, 1, 0),
(96, 13, 'Aosta: dalle origini al terzo millennio', '', '978-88-7032-880-6', 0, 22, 7, 1, 0),
(97, 1, 'Il rumore del suo silenzio', '', '978-88-97192-33-6', 0, 12, 5, 1, 0),
(98, 1, 'La riunione di condominio', '', '978-88-97192-42-8', 0, 0.99, 4, 2, 0),
(99, 1, 'I consigli d\'amore', '', '978-88-97192-41-1', 0, 0.99, 4, 2, 0),
(100, 1, 'Al di là del fiume', '', '978-88-97192-35-0', 136, 13, 2, 1, 0),
(101, 1, 'Desideri sommersi', '', '978-88-97192-28-2', 144, 12, 5, 1, 0),
(102, 2, 'I due asinelli', '', '978-88-96570-23-4', 0, 9, 7, 1, 0),
(103, 2, 'Bisticcio di Natale', '', '978-88-96570-43-2', 0, 9, 7, 1, 0),
(105, 2, 'Il grande viaggio del piccolo poeta', '', '978-88-96570-40-1', 0, 14, 7, 1, 0),
(106, 2, '1 metro e 50 di zucchero', '', '978-88-965703-9-5', 0, 15, 7, 1, 0),
(107, 2, 'Cantico di Natale', '', '978-88-965703-7-1', 0, 10, 7, 1, 0),
(108, 2, 'L\'avventura di Juta', '', '978-88-96570-07-4', 0, 9, 7, 1, 0),
(109, 14, 'Terezín', '', '978-88-7637-143-1', 0, 15, 7, 1, 0),
(110, 15, 'Parigi nel XX secolo', '', '978-88-97940-20-3', 0, 15, 7, 1, 0),
(111, 15, 'Il KL, l\'incredibilità di un attimo', '', '978-88-97940-07-4', 0, 20, 7, 1, 0),
(112, 15, 'Quello strano berretto frigio', '', '978-88-97940-00-5', 0, 15, 7, 1, 0),
(113, 15, 'Il pittore di provincia', '', '978-88-97940-01-2', 0, 15, 7, 1, 0),
(114, 15, 'La casa degli orrori', '', '978-88-97940-03-6', 0, 15, 7, 1, 0),
(115, 15, 'Ricette vegetariane', '', '978-88-97940-10-4', 0, 12, 7, 1, 0),
(116, 15, 'Parallele Divergenti', '', '978-88-97940-02-9', 0, 15, 7, 1, 0),
(117, 15, 'I tuoi occhi dal passato', '', '978-88-97940-16-6', 0, 16, 7, 1, 0),
(118, 15, 'L\'uomo di soli ricordi', '', '978-88-97940-21-0', 0, 15, 7, 1, 0),
(119, 15, 'Il bambino blu', '', '978-88-97940-13-5', 0, 12, 7, 1, 0),
(120, 15, 'Catalogo ARTSITE', '', '978-88-97940-22-7', 0, 15, 7, 1, 0),
(121, 15, 'Vite di pittori straordinari', '', '978-88-97940-11-1', 0, 15, 7, 1, 0),
(122, 15, 'Catalogo Tesori d\'Arte a Valenza', '', '978-88-97940-26-5', 0, 24, 7, 1, 0),
(123, 15, 'Trattare una celebrità e altre storie', '', '978-88-97940-14-2', 0, 15, 7, 1, 0),
(124, 15, 'Al di là dell\'attimo', '', '978-88-97940-05-0', 0, 20, 7, 1, 0),
(125, 15, 'Il rovescio della coscienza', '', '978-88-97940-20-2', 0, 15, 7, 1, 0),
(126, 15, 'Con la coda dell\'occhio', '', '978-88-97940-25-8', 0, 15, 7, 1, 0),
(127, 15, 'Sbirro Morto Eroe Le verità giudiziarie', '', '978-88-97940-23-4', 0, 12, 7, 1, 0),
(128, 1, 'Marne Rosse', '', '978-88-97192-36-7', 0, 16, 1, 1, 0),
(129, 1, 'Le pagine strappate', '', '978-88-97192-38-1', 0, 12, 1, 1, 0),
(130, 5, 'Le rondini non si scontrano mai', '', '978-88-97347-15-6', 0, 10.2, 7, 1, 0),
(131, 5, 'Io e Nilde', '', '978-88-97347-10-1', 0, 12, 7, 1, 0),
(132, 5, 'Se ti scappa, falla... la risata', '', '978-88-97347-31-6', 0, 13.5, 7, 1, 0),
(133, 5, 'Operazione drago', '', '978-88-97347-34-7', 0, 5, 7, 1, 0),
(134, 5, 'La casa dei pasticcini in disordine', '', '978-88-97347-25-5', 0, 14, 7, 1, 0),
(135, 5, 'Il sogno di Awili', '', '978-88-97347-21-7', 0, 14, 7, 1, 0),
(136, 5, 'Amici tra due mondi', '', '978-88-97347-12-5', 0, 12, 7, 1, 0),
(137, 5, 'La talpa Giuditta presenta: Trattamento cretinetti per zittire i bulletti', '', '978-88-97347-14-9', 0, 13.5, 7, 1, 0),
(138, 5, 'Ambrogina zanzarina sottozero', '', '978-88-97347-29-3', 0, 8, 7, 1, 0),
(139, 5, 'Amelia la mela luccicante', '', '978-88-97347-30-9', 0, 8, 7, 1, 0),
(140, 5, 'Ciabattina coccinella al contrario', '', '978-88-97347-28-6', 0, 8, 7, 1, 0),
(141, 5, 'Adalgisa e la luna', '', '978-88-97347-11-8', 0, 12.5, 7, 1, 0),
(142, 5, 'Le avventure di Togo e Ringo', '', '978-88-97347-00-2', 0, 13.5, 7, 1, 0),
(143, 5, 'Ci sono anch\'io', '', '978-88-97347-02-6', 0, 13.5, 7, 1, 0),
(144, 5, 'Come l\'acqua', '', '978-88-97347-08-8', 0, 14, 7, 1, 0),
(145, 5, 'Linea di confine', '', '978-88-97347-05-7', 0, 10, 7, 1, 0),
(146, 5, 'Ma che bel castello', '', '978-88-97347-09-5', 0, 12, 7, 1, 0),
(147, 5, 'Ma in un libro cosa c\'è', '', '978-88-97347-22-4', 0, 12.5, 7, 1, 0),
(148, 5, 'Il mondo di Bagigio', '', '978-88-97347-04-0', 0, 15, 7, 1, 0),
(149, 8, 'Storie di confine e di contrabbando', '', '978-88-89666-82-1', 0, 12, 7, 1, 0),
(150, 7, 'Il contrabbasso', '', '978-88-89759-18-9', 0, 18.8, 7, 1, 0),
(151, 7, 'I ventidue canti di Doyel', '', '978-88-89759-05-9', 0, 10, 7, 1, 0),
(152, 7, 'Il maestro di setticlavio', '', '978-88-89759-20-2', 0, 7, 7, 1, 0),
(153, 7, 'Al sole di Maupassant', '', '978-88-89759-13-4', 0, 11, 7, 1, 0),
(154, 7, 'La rigenerazione', '', '978-88-89759-24-0', 0, 10, 7, 1, 0),
(155, 7, 'Gelusa', '', '978-88-89759-09-7', 0, 15, 7, 1, 0),
(156, 17, 'A gran giornate', '', '978-88-97462-20-0', 0, 14, 7, 1, 0),
(157, 10, 'L\'identità romana', '', '978-88-90593-47-5', 0, 21.9, 7, 1, 0),
(158, 14, 'Salvatori e salvati', '', '978-88-7637-174-5', 0, 15, 7, 1, 0),
(159, 14, 'Ad opus claustri ecclesiae augustensis', '', '978-88-7637-140-0', 0, 50, 7, 1, 0),
(160, 14, 'Alamans', '', '978-88-87214-83-2', 0, 18, 7, 1, 0),
(161, 14, 'Gli antichi Rû della Valle d\'Aosta', '', '978-88-7637-057-9', 0, 80, 7, 1, 0),
(162, 14, 'Il chiostro della cattedrale di Aosta', '', '978-88-7637-033-1', 0, 45, 7, 1, 0),
(163, 14, 'Il Castello di Cly', '', '978-88-8721-413-1', 0, 30, 7, 1, 0),
(164, 14, 'Châtillon in età moderna', '', '978-88-8721-480-8', 0, 30, 7, 1, 0),
(165, 14, 'Il mandement e il castello di Graines', '', '978-88-7637-168-0', 0, 22, 7, 1, 0),
(166, 14, 'Il miniatore di Giorgio di Challant', '', '978-88-8721-429-1', 0, 13, 7, 1, 0),
(167, 14, 'La visitation d\'Aoste', '', '--', 0, 12, 7, 1, 0),
(168, 14, 'Les saints', '', '--', 0, 12, 7, 1, 0),
(169, 14, 'Stefano Mossettaz', '', '--', 0, 35, 7, 1, 0),
(170, 15, 'I Sentieri lungo la Via Francigena in valle d\'Aosta', '', '978-88-97940-28-9', 0, 18, 7, 1, 0),
(171, 16, 'Sognando Leonardo', '', '978-88-89159-50-7', 0, 14, 7, 1, 0),
(172, 16, 'Dante per gioco - L\'inferno', '', '978-88-89159-29-3', 0, 12, 7, 1, 0),
(173, 16, 'Dante per gioco - Il Purgatorio', '', '978-88-89159-24-8', 0, 12, 7, 1, 0),
(174, 16, 'Dante per gioco - Il Paradiso', '', '978-88-89159-44-6', 0, 12, 7, 1, 0),
(175, 16, 'Boccaccio per Gioco - Frà Cipolla, Chichibio, Calandrino', '', '978-88-89159-61-3', 0, 13, 7, 1, 0),
(176, 16, 'Il Decameron di G. Boccaccio', 'Calandrino e il porco rubato - Costanza e Martuccio', '978-88-900705-7-0', 0, 13, 7, 1, 0),
(177, 16, 'Dante Alighieri - Una vita', '', '978-88-89159-86-6', 0, 14, 7, 1, 0),
(178, 14, 'Da Giovanni Paolo II a Benedetto XVI', '', '978-88-7637-020-5', 0, 15, 7, 1, 0),
(179, 14, 'Gino Olivetti : biografia dell\'altro Olivetti', '', '978-88-7637-179-0', 0, 18, 7, 1, 0),
(182, 16, 'Manzoni per gioco - I Promessi Sposi', '', '978-88-89159-31-6', 64, 13, 7, 1, 0),
(183, 16, 'Shakespeare per Gioco - Romeo e Giulietta', '', '978-88-89159-47-7', 0, 13, 7, 1, 0),
(184, 16, 'Le Leggende per Gioco - Re Artù', '', '978-88-89159-70-5', 0, 13, 7, 1, 0),
(185, 16, 'Omero per Gioco - L\'Odissea', '', '978-88-89159-26-2', 0, 13, 7, 1, 0),
(186, 16, 'L\'Illiade - Omero per Gioco', '', '978-88-98897-03-2', 0, 13, 7, 1, 0),
(187, 16, 'Ovidio per Gioco - Volume 1', '', '978-88-89159-54-5', 0, 13, 7, 1, 0),
(188, 16, 'Ovidio per Gioco - Volume 2', '', '978-88-89159-56-9', 0, 13, 7, 1, 0),
(189, 16, 'Gioca con Fedro - La cornacchia e la pecora', '', '978-88-89159-57-6', 0, 7, 7, 1, 0),
(190, 16, 'Gioca con Esopo - Il topo di campagna e il topo di città', '', '978-88-89159-60-6', 0, 7, 7, 1, 0),
(191, 16, 'Gioca con la favola - La cicala e la formica', '', '978-88-89159-81-1', 0, 7, 7, 1, 0),
(192, 16, 'Garibaldi si racconta', '', '978-88-89159-38-5', 0, 14, 7, 1, 0),
(193, 16, 'Dante Alighieri - Una vita', '', '978-88-89159-86-6', 0, 14, 7, 1, 0),
(194, 16, 'Leonardo Per Gioco - L\'Uomo Vitruviano', '', '978-88-89159-21-7', 0, 11, 7, 1, 0),
(195, 16, 'Leonardo Per Gioco - La Divina Proporzione', '', '978-88-89159-27-9', 0, 11, 7, 1, 0),
(196, 16, 'Piero della Francesca per Gioco', 'La geometria al Servizio delle Arti', '978-88-89159-51-4', 0, 11, 7, 1, 0),
(197, 16, 'Pierino e il default', 'La crisi economica rappata a mio figlio', '978-88-89159-67-5', 0, 12, 7, 1, 0),
(198, 16, 'La mitologia per gioco - Le fatiche di Ercole', '', '978-88-89159-93-4', 0, 13, 7, 1, 0),
(199, 14, 'Le Mont-Blanc', 'Un giornale indipendente sotto il fascismo', '978-88-7637-160-8', 0, 27, 7, 1, 0),
(200, 14, 'Dizionario del dialetto francoprovenzale di Hône', '', '978-88-7637-048-9', 0, 30, 7, 1, 0),
(201, 18, 'Seconda classe, lato finestrino', '', '978-88-97867-55-5', 140, 13, 7, 1, 0),
(202, 5, 'Maestre allo sbaraglio', '', '978-88-97347-32-3', 384, 16, 7, 1, 0),
(203, 5, 'Pronto in 10 mosse', '', '978-88-97347-27-9', 44, 12.5, 7, 1, 0),
(204, 5, 'Come diventare cacciatore di draghi', '', '978-88-97347-24-8', 128, 10, 7, 1, 0),
(205, 2, 'Le nuvole curiose', '', '978-88-9657-020-3', 0, 9, 7, 1, 0),
(206, 2, 'L\'ombra della lince', '', '978-88-9657-053-1', 0, 9, 7, 1, 0),
(207, 2, 'Fosca e la Luna', '', '978-88-9657-047-0', 0, 9, 7, 1, 0),
(208, 2, 'Antichi mestieri', '', '978-88-9657-049-4', 0, 9, 7, 1, 0),
(209, 2, 'La tela di Eugenio', '', '978-88-9657-050-0', 0, 9, 7, 1, 0),
(210, 2, 'L\'avventura di Juta - nuovo', '', '978-88-9657-045-6', 0, 9, 7, 1, 0),
(211, 2, 'Guen, Mad e Roc', '', '978-88-9657-051-7', 0, 9, 7, 1, 0),
(212, 2, 'Vanessa vanitosa', '', '978-88-9657-052-4', 0, 9, 7, 1, 0),
(213, 2, 'Il cammello stonato', '', '978-88-9657-036-4', 0, 9, 7, 1, 0),
(215, 15, 'Eva, acqua biellese', '', '978-88-9794-028-9', 0, 15, 7, 1, 0),
(216, 1, 'Cripta', '', '978-88-97192-30-5', 0, 5.49, 2, 2, 0),
(217, 1, 'Desideri sommersi', '', '978-88-97192-29-9', 0, 4.99, 5, 2, 0),
(218, 16, 'Omaggio a Dante Alighieri', '', '978-88-89159-75-0', 0, 12, 7, 1, 0),
(219, 16, 'Le Ricette di Mamma Toscana', '', '978-88-900705-0-1', 0, 8, 7, 1, 0),
(220, 1, 'Storie di spettri, demoni e altre paure', '', '978-88-97192-54-1', 0, 10, 2, 1, 0),
(221, 1, 'Paola per sempre', '', '978-88-97192-52-7', 0, 13, 2, 1, 0),
(222, 1, 'Oxygen', '', '978-88-97192-57-2', 0, 12, 6, 1, 0),
(223, 1, 'Seconda classe, lato finestrino', '', '978-88-97192-56-5', 0, 4.99, 2, 2, 0),
(224, 1, 'Le long Hivier de Spitak', '', '978-88-97192-58-9', 0, 8.99, 6, 2, 0),
(225, 1, 'L\'universo riflesso', '', '978-88-97192-43-5', 0, 0, 4, 2, 0),
(226, 1, 'I funerali del Pompi', '', '978-88-97192-44-2', 0, 0, 4, 2, 0),
(227, 1, 'La regola', '', '978-88-97192-45-9', 0, 0, 4, 2, 0),
(231, 14, 'Yaled Cuz Michal e Nur sui campi di cotone', '', '978-88-7637-065-6', 0, 12, 7, 1, 0),
(235, 16, 'Firenze per gioco', '', '978-88-89159-11-1', 0, 7, 7, 1, 0),
(236, 16, 'Chi ha paura di Colagrasso', '', '978-88-98897-05-6', 0, 5, 7, 1, 0),
(237, 16, 'Mi chiamavano Caravaggio', '', '978-88-98897-07-0', 0, 14, 7, 1, 0),
(238, 16, 'Gioca con Pinocchio', '', '978-88-98897-12-4', 0, 7, 7, 1, 0),
(239, 14, 'La guerra partigiana e la Valle d\'Aosta', '', '978-88-7637-182-0', 0, 10, 7, 1, 0),
(240, 14, 'Ottavio Bastrenta: lo notéro drolo', '', '978-88-7637-180-6', 0, 22, 7, 1, 0),
(241, 14, 'Federico Chabod: lo storico, il politico, l\'alpinista', '', '978-88-7637-178-3', 0, 35, 7, 1, 0),
(242, 1, 'Le long hiver de Spitak', '', '978-88-97192-59-6', 0, 16, 6, 1, 0),
(243, 1, 'Corto Circuito', '', '978-88-97192-60-2', 160, 13, 2, 1, 0),
(244, 1, 'Vita e opere di Pompilio Sùlbus - Vol. I', '', '978-88-97192-50-3', 240, 15, 4, 1, 0),
(247, 1, 'Il musicista', '', '978-88-97192-62-6', 168, 13, 2, 1, 0),
(248, 1, 'Il musicista', '', '978-88-97192-63-3', 0, 4, 2, 2, 0),
(249, 1, 'Storia elettorale della Valle d\'Aosta', 'Dal 1946 al 2015', '978-88-97192-64-0', 264, 22, 8, 1, 0),
(250, 13, 'Tesori di fede. Luoghi di culto a Champorcher', '', '978-88-7032-925-4', 0, 18, 7, 1, 0),
(252, 13, 'Liberi: il grande vecchio della Vallée si racconta', '', '978-88-7032-921-6', 0, 25, 7, 1, 0),
(253, 1, 'Libambos', '', '978-88-97192-77-0', 248, 16, 2, 1, 0),
(254, 1, 'Libambos', '', '978-88-97192-78-7', 0, 5, 2, 2, 0),
(255, 1, 'Over60 - Men', '', '978-88-97192-87-9', 224, 15, 9, 1, 0),
(256, 10, 'Audiolibro prova', '', '9788897192000', 0, 10, 7, 3, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `libritipologia`
--

CREATE TABLE `libritipologia` (
  `idlibrotipologia` int(11) NOT NULL,
  `librotipologia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `libritipologia`
--

INSERT INTO `libritipologia` (`idlibrotipologia`, `librotipologia`, `cancellato`) VALUES
(1, 'Carta', 0),
(2, 'Ebook', 0),
(3, 'Altro', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `movimenti`
--

CREATE TABLE `movimenti` (
  `idmovimento` int(11) NOT NULL,
  `fktipologia` int(11) NOT NULL,
  `fkcausale` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `riferimento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fksoggetto` int(11) NOT NULL,
  `movimentodata` date NOT NULL,
  `pagamentoentro` date NOT NULL,
  `pagata` tinyint(1) NOT NULL,
  `fkpagamentotipologia` int(11) NOT NULL,
  `datapagamento` date DEFAULT NULL,
  `spedizionecosto` double NOT NULL,
  `spedizionesconto` double NOT NULL,
  `fkaspetto` int(11) NOT NULL,
  `fktrasporto` int(11) NOT NULL,
  `fkmagazzino` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `chiuso` tinyint(1) NOT NULL DEFAULT '0',
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `movimentiaspetto`
--

CREATE TABLE `movimentiaspetto` (
  `idmovimentoaspetto` int(11) NOT NULL,
  `movimentoaspetto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `movimentiaspetto`
--

INSERT INTO `movimentiaspetto` (`idmovimentoaspetto`, `movimentoaspetto`, `cancellato`) VALUES
(1, 'Sfuso', 0),
(2, 'Busta', 0),
(3, 'Pacco', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `movimenticausale`
--

CREATE TABLE `movimenticausale` (
  `idmovimentocausale` int(11) NOT NULL,
  `movimentocausale` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `movimenticausale`
--

INSERT INTO `movimenticausale` (`idmovimentocausale`, `movimentocausale`, `cancellato`) VALUES
(1, 'Vendita', 0),
(2, 'Tentata vendita', 0),
(3, 'Conto deposito', 0),
(4, 'Conto vendita', 0),
(5, 'Omaggio', 0),
(6, 'Reso', 0),
(7, 'Distr. deposito', 0),
(8, 'Distr. reso', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `movimentidettaglio`
--

CREATE TABLE `movimentidettaglio` (
  `idmovimentodettaglio` int(11) NOT NULL,
  `fkmovimento` int(11) NOT NULL,
  `fklibro` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  `sconto` double NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `movimentitipologia`
--

CREATE TABLE `movimentitipologia` (
  `idmovimentotipologia` int(11) NOT NULL,
  `movimentotipologia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `codice` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `movimentitipologia`
--

INSERT INTO `movimentitipologia` (`idmovimentotipologia`, `movimentotipologia`, `codice`, `cancellato`) VALUES
(1, 'DDT', 'DT', 0),
(2, 'Fattura immediata', 'FI', 0),
(3, 'Fattura differita', 'FD', 0),
(4, 'Fattura accompagnatoria', 'FA', 0),
(5, 'Ricevuta', 'RI', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `movimentitrasporto`
--

CREATE TABLE `movimentitrasporto` (
  `idmovimentotrasporto` int(11) NOT NULL,
  `movimentotrasporto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `movimentitrasporto`
--

INSERT INTO `movimentitrasporto` (`idmovimentotrasporto`, `movimentotrasporto`, `cancellato`) VALUES
(1, 'Mittente', 0),
(2, 'Destinatario', 0),
(3, 'Poste Italiane', 0),
(4, 'Corriere', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamentitipologia`
--

CREATE TABLE `pagamentitipologia` (
  `idpagamentotipologia` int(11) NOT NULL,
  `pagamentotipologia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `pagamentitipologia`
--

INSERT INTO `pagamentitipologia` (`idpagamentotipologia`, `pagamentotipologia`, `cancellato`) VALUES
(1, 'Assegno', 0),
(2, 'Carta di credito', 0),
(3, 'Bonifico', 0),
(4, 'Vaglia', 0),
(5, 'PayPal', 0),
(6, 'Contanti', 0),
(7, 'Ricarica PostePay', 0),
(8, 'Da pagare', 0),
(9, 'Non applicabile', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `soggetti`
--

CREATE TABLE `soggetti` (
  `idsoggetto` int(11) NOT NULL,
  `fktipologia` int(11) NOT NULL,
  `denominazione` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cellulare` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `piva` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `codicefiscale` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indirizzo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cap` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comune` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `soggetti`
--

INSERT INTO `soggetti` (`idsoggetto`, `fktipologia`, `denominazione`, `telefono`, `cellulare`, `piva`, `codicefiscale`, `email`, `indirizzo`, `cap`, `comune`, `provincia`, `note`, `cancellato`) VALUES
(2, 1, 'Rollandin Emilie', '', '3457054951', '', 'RLLMLE77S65E379', 'emilie.rollandin@gmail.com', 'via Guillet 6', '11027', 'Saint Vincent', 'Ao', '', 0),
(3, 5, 'Groppo Elettra', '', '3473058275', '', 'GRPLTR82P47Z126I', 'passionhunter@live.it', 'Via Guillet, 6', '11027', 'Saint Vincent', 'Ao', '', 0),
(4, 5, 'Galletti Giancarlo', '', '', '', 'GLLGCR74E24G273U', '', 'Piazza della Vittoria, 8', '24042', 'Capriate San Gervasio', 'Bg', '', 0),
(6, 5, 'Berti Franceschi Susanna', '', '', '', 'BRSSNN52E71E625P', '', 'Loc. Fichino, 82', '56034', 'Cascina Terme', 'PI', '', 0),
(7, 5, 'Berti Gian Ugo', '', '', '', 'BRTGNG47L18A944H', '', 'Loc. Fichino, 82', '56034', 'Cascina Terme', 'PI', '', 0),
(8, 6, 'ADB Digital Print S.r.l.', '0499501417', '3487233996', '03435770288', '', 'info@adbdigitalprint.it', 'via Terrassa 27/d', '35026', 'Conselve', 'Pd', 'Referente Dario', 0),
(9, 6, 'Universal book', '0984408929', '3298633035', '02985380787', '', 'amministrazione@universalbooksrl.com', 'via S. Botticelli 22', '87036', 'Rende', 'Cs', '', 0),
(10, 2, 'Centro Libri Brescia s.r.l.', '0303539292', '', '02956630178', '', 'info@centrolibri.it', 'via Galvani 6c/d', '25010', 'San Zeno Naviglio', 'Bs', '', 0),
(11, 11, 'Mandrino Gian Stefano', '', '', '', '', '', '', '', '', '', '', 0),
(12, 5, 'Cerasola Christiano', '', '3383093133', '', 'CRSCST68M19F205X', 'christiano.cerasola@gmail.com', 'Viale Ungheria 19/E', '20138', 'Milano', 'Mi', '', 0),
(13, 5, 'Belais Francesco', '', '', '', '', '', 'Via Venini 90', '20127', 'Milano', 'MI', '', 0),
(14, 5, 'Castelli Anna', '', '', '', '', '', '', '', '', '', '', 0),
(19, 2, 'Guida Merliani', '0815560170', '', '07061731217', '', 'librinonsolo@gmail.com', 'via Merliani 118/120', '80129', 'Napoli', 'Na', 'Falliti', 0),
(20, 2, 'Rinascita di Iadeciccio Massimiliano (Roma)', '0664829728', '', '09681131000', '', 'info@rinascitaonline.it', 'Viale Agosta, 36', '00171', 'Roma', 'RM', '', 0),
(21, 2, 'Libreria Fahrenheit 451', '066875930', '', '09032081003', 'GBRCTA62M49T888Y', 'libreriafahrenheit451@yahoo.com', 'Piazza Campo de Fiori 44', '00186', 'Roma', 'Rm', 'Sconto 50%', 0),
(22, 2, 'N\'importe quoi', '0697273516', '', '10535611004', '', 'librerianpq@gmail.com', 'Via Beatrice Cenci,10', '00189', 'Roma', 'Rm', '', 0),
(23, 2, 'Peak Book Enoteca', '0664760087', '', '08767831004', '', 'info@peakbook.it', 'Via Arco dei Banchi 3/a', '00186', 'Roma', 'Rm', '', 0),
(24, 2, 'Libreria Odradek', '066833451', '', '05536271009', '', 'odradek@tiscali.it', 'Via dei Banchi Vecchi, 57', '00186', 'Roma', 'Rm', 'Davide', 0),
(25, 2, 'Eman Libri di Emanuele Pagani', '035330555', '', '03671930166', '', 'emanlibri@yahoo.it', 'Via Zanica 2', '24126', 'Bergamo', 'Bg', 'Emanuele Pagani', 0),
(26, 2, 'Libreria Resola', '03042476', '', '01462690171', '', '', 'Corso Giuseppe Garibaldi, 39/b', '25122', 'Brescia', 'Bs', '', 0),
(28, 2, 'Libreria di Quartiere', '0245497966', '', '13215150155', '', 'info@libreriadiquartiere.it', 'Viale Piceno, 1', '', 'Milano', 'Mi', 'Fatturazione a Denadai', 0),
(29, 2, 'Pier Open Space', '0289075230', '', '11376220155', '', 'info@pierpourhom.it', 'Via Mortara, 4', '20144', 'Milano', 'Mi', 'fatturare a 6x6 Advertising S.a.s.', 0),
(30, 2, 'La Babele', '0236561408', '', '06538800969', '', 'lababele@email.it', 'Viale Regina Giovanna 24/b', '20129', 'Milano', 'Mi', '', 0),
(31, 2, 'Libreria Popolare di via Tadino', '0229513268', '', '01838890158', '', 'libreriatadino@yahoo.it', 'Via Tadino, 18', '20124', 'Milano', 'Mi', '', 0),
(32, 2, 'Libreria Odradek', '02314948', '', '13252410157', 'RCCNMR59M47C518F', 'odradekmilano@teletu.it', 'Via Principe Eugenio, 28', '20155', 'Milano', 'Mi', '', 0),
(33, 2, 'Cartografica Lombarda', '023311378', '', '07712470152', '', 'cartolombarda@yahoo.it', 'Via Canonica 72', '20154', 'Milano', 'Mi', '', 0),
(34, 2, 'Gogol and Company', '0245470449', '', '06981950864', '', 'libreria@gogolandcompany.com', 'Via Savona, 101', '20144', 'Milano', 'Mi', '', 0),
(35, 2, 'Libreria di Brera s.a.s.', '0272002206', '', '10646990159', '', 'amministrazione@libreriadibrera.it', 'Via delle Erbe, 2', '20121', 'Milano', 'Mi', '', 0),
(36, 2, 'Bistro del tempo ritrovato', '0236503146', '3463971419', '05686790964', 'LLDLCU67A05F205N', 'info@bistrodeltemporitrovato.it', 'via Foppa 4', '20144', 'Milano', 'Mi', 'Bianca - Luca Allodi', 0),
(38, 2, 'Libreria Scalda Pensieri', '0256816807', '', '05886230969', '', 'info@nuovascaldapensieri.it', 'Via Breno, 1', '20139', 'Milano', 'Mi', 'Via don Bosco Davanti al numero civico 39', 0),
(39, 2, 'L\'altra libreria', '0294969983', '', '05105260151', '', 'altralibreria@abbiategrasso.com', 'Via Annoni, 32', '20081', 'Abbiategrasso', 'Mi', '', 0),
(40, 2, 'Libreria Incontri', '0536802494', '', '02983980364', '', 'libreriaincontri@tin.it', 'Piazza Libertà, 29', '41049', 'Sassuolo', 'Mo', '', 0),
(41, 2, 'Libreria Golconda', '0519917996', '', '03053811208', 'TTNGCM83D15A345N', 'info@golconda.it', 'Via Nosadella 23/a', '40123', 'Bologna', 'Bo', '', 0),
(42, 2, 'La Ghibellina', '050580277', '', '01644580506', '', 'libreriaghibellina@gmail.com', 'Via Borgo Stretto, 37', '56127', 'Pisa', 'Pi', '', 0),
(43, 2, 'La Mongolfiera', '050970599', '', '01301380505', '', 'info@lamongolfiera.it', 'Via San Francesco 8/c', '56127', 'Pisa', 'Pi', 'Patrizia Colombini', 0),
(44, 2, 'Libreria Roma', '058752446', '', '01503910505', '', 'info@libreriaroma.com', 'Via della Misericorda 18', '56025', 'Pontedera', 'Pi', '', 0),
(45, 2, 'Libriamo Store', '058757997', '', '01977670502', '', 'libriamostore@libero.it', 'Via dell\'Indipendenza', '56025', 'Pontedera', 'Pi', 'Presso centro commerciale Panorama', 0),
(46, 2, 'Libreria Il quadrato magico', '0587731617', '', '01879150504', '', 'info@ilquadratomagico.it', 'Via N. Sauro, 39', '56038', 'Ponsacco', 'Pi', '', 0),
(47, 2, 'Libreria Fahrenheit 451', '', '3347186313', '01324540473', '', 'libreriaf451@gmail.com', 'Piazza Risorgimento, 16', '51039', 'Quarrata', 'Pt', 'Preseidente Daniele Guidotti', 0),
(48, 2, 'Libreria delle Donne - Milano', '0270006265', '', '02227280159', '', 'info@libreriadelledonne.it', 'Via Pietro Calvi, 29', '20129', 'Milano', 'Mi', '', 0),
(49, 2, 'Edison Book Store', '0583492447', '', '02078650468', '', 'donatella@edisonlucca.it', 'Via Cenami / Angolo via Roma', '55100', 'Lucca', 'Lu', 'Libreria Cenami', 0),
(50, 2, 'Libreria Lucca Libri', '0583469627', '', '02166310462', '', 'luccalibri@gmail.com', 'V.le Regina Margherita, 113', '55100', 'Lucca', 'Lu', '', 0),
(51, 2, 'Gaia Scienza', '0586829325', '', '01029770490', '', '', 'Via di Franco 12', '', 'Livorno', 'Li', 'Fallita', 0),
(52, 2, 'Don s.r.l - Lovat', '040637399', '', '01162670325', '', 'trieste@librerielovat.com', 'Viale XX settembre 20', '34125', 'Trieste', 'Ts', 'c/o stabile Oviesse - info@librerielovat.com - eventi@librerielovat.com', 0),
(53, 2, 'La Galleria del Libro', '0125641212', '', '03870980012', '', 'info@lagalleriadellibro.it', 'Via Palestro 70', '', 'Ivrea', 'To', '', 0),
(54, 2, 'Libreria Cossavella', '0125634273', '', '006714010011', '', '', 'Corso Cavour 9', '10015', 'Ivrea', 'To', '', 0),
(55, 2, 'Libreria Stampatori', '011836778', '', '00623070018', '', 'stampa.univ@tiscalinet.it', 'Via San Ottavio, 15', '10124', 'Torino', 'To', 'F. Raineri', 0),
(56, 2, 'Libreria Essai', '011353020', '', '06766090010', 'CLLGPR53A01L219X', 'amm@libreriaessai.com', 'Via Filadelfia, 229', '10137', 'Torino', 'To', '', 0),
(57, 2, 'Legolibri', '011888975', '', '06978400015', '', 'info@legolibri.it', 'Via Maria Vittoria, 31', '10123', 'Torino', 'To', '', 0),
(58, 2, 'Moodcaffé', '0115660809', '', '01715510010', '', 'libreria@moodlibri.it', 'Via Cesare Battisti 3/e', '', 'Torino', 'To', 'Da fatturare a Scriptorium s.r.l.', 0),
(59, 2, 'Trebisonda', '0117900088', '', '0117900088', '', 'trebisondalibri@gmail.com', 'Via Sant\'Anselmo 22', '10125', 'Torino', 'To', '', 0),
(60, 2, 'Linea 451', '0118136739', '', '09837150011', '', 'info@linea451.net', 'Via Santa Giulia, 40', '10124', 'Torino', 'To', 'sconto 35%', 0),
(61, 2, 'Lupo Rosso', '0110770162', '', '10177881009', '', '', 'Via A. Volta 1/h', '', 'Torino', 'To', '', 0),
(62, 2, 'Cartolibreria Rigoli', '0125929034', '', '01022990079', 'MCHFRC81558A326C', 'federica@rigoli.info', 'Via Duca d\'Aosta, 34', '11029', 'Verres', 'Ao', 'Federica Michelini', 0),
(63, 2, 'Les Bouquins s.r.l.', '0125307688', '', '00632940078', '', '', 'Rue Chemin Varasc', '11020', 'Ayas', 'Ao', 'Livres et Musique', 0),
(64, 2, 'Evoluzione di R. Gatto & C. Snc', '0166512512', '', '00600560072', '', '', 'Viale Piemonte 1', '11027', 'Saint Vincent', 'Ao', '', 0),
(65, 2, '5Rue Maillet s.a.s.', '0165548851', '', '01130300070', '', 'info@alapage.vda.it', 'Via Porte Praetoriane n. 14', '11100', 'Aosta', 'Ao', 'Carlotta - A la Page', 0),
(66, 2, 'Libreria Aubert Di Pollicini L.&C. snc', '0165262587', '', '00118100072', '', 'libreriaubert@libero.it', 'Via Aubert Edouard 46', '11100', 'Aosta', 'Ao', '', 0),
(67, 2, 'Libreria Feltrinelli - Padova', '0498754630', '', '04628790968', '', '', 'Via San Francesco 7', '', 'Padova', 'Pd', 'Fatturare a Libreria Feltrinelli Srl - Via Tucidide,56 torre 3 - 20134 Milano', 0),
(68, 2, 'La forma del libro', '0499817459', '', '04460550280', '', 'info@laformadelibro.it', 'Via XX settembre 63', '35122', 'Padova', 'Pd', 'Lucia Stellato', 0),
(69, 2, 'Al capitello', '0415222314', '', '03664140278', '', '', 'Sestiere Cannaregio 3762', '30121', 'Venezia', 'Ve', '', 0),
(70, 2, 'Libreria Acqua Alta', '0412960841', '', '02653130274', 'FRZLQU41P27L433F', '', 'Sestiere Castello 5167', '30123', 'Venezia', 'Ve', '', 0),
(71, 2, 'Libreria Riviera', '041423231', '', '03313550273', '', 'ugoscorte@yahoo.it - libreriariviera@virgilio.it', 'Via Gramsci 57', '', 'Mira', 'Ve', '', 0),
(72, 2, 'Libreria Gheduzzi', '0458002234', '', '02927370235', '', '', 'Corso Sant\'Anastasia 7', '', 'Verona', 'Vr', '', 0),
(73, 2, 'Libreria Re Baldoria', '0444020254', '', '03375900242', '', 'rebaldoria@rebaldoria.com', 'Contrà San Faustino, 3', '36100', 'Vicenza', 'Vi', 'Luca', 0),
(74, 2, 'Libreria Galla 1880', '0444225252', '', '01692010240', '', 'info@galla1880.com', 'Corso Palladio, 11', '36100', 'Vicenza', 'Vi', '', 0),
(75, 2, 'Libreria G. Traverso s.a.s di Valentina Traverso', '0444324389', '', '02651490241', '', 'traversolibri@libero.it', 'Corso Palladio 173', '36100', 'Vicenza', 'Vi', '', 0),
(76, 2, 'Il segnalibro', '0444321706', '', '03195250240', '', 'ilsegnalibro@gmail.com', 'Piazzale Stazione 31', '', 'Vicenza', 'Vi', 'Mondadori - Roberta', 0),
(77, 2, 'CENTRO BIBLIOTECHE LOVAT SRL', '042292697', '', '03641630268', '', 'villorba@librerielovat.com', 'Via Newton 32', '31020', 'Villorba', 'Tv', 'info@centrobiblioteche.it', 0),
(78, 2, 'Torre di Libri', '0423496938', '', '04406750267', '', 'torredilibri@gmail.com', 'via F. M. Preti, 67', '31033', 'Castelfranco Veneto', 'Tv', 'Mondadori', 0),
(79, 2, 'Libreria Bonardi', '+31206239844', '', '', '', '', 'Entrepotdock 26', '', 'Amsterdam', 'NL', '', 0),
(80, 2, 'D.E.A. spa', '', '', '00901181008', '', '', 'Via Pietro Boccanelli 27', '00138', 'Roma', '', '', 0),
(81, 2, 'Agorà Soc. cons. a.r.l.', '', '', '01142650074', '', '', 'Piazza della Repubblica 7', '11100', 'Aosta', 'Ao', '', 0),
(82, 2, 'Internet Book Shop Italia s.r.l.', '0291435000', '', '12252360156', '', 'amministrazione.libri@ibs.it', 'Via Verdi 8', '20090', 'Assago', 'Mi', '', 0),
(83, 2, 'Webster s.r.l.', '', '', '03556440281', '', '', 'Via Stefano Breda, 26', '35010', 'Limena', 'Pd', '', 0),
(85, 2, 'Libri d\'Amare di Bianchi Adriano', '', '3384227198', '01285320428', '', 'biadri59@tiscali.it', 'Via Pinocchio, 9', '60127', 'Ancona', 'An', 'Libreria ambulante', 0),
(87, 5, 'Simonelli Mario Massimo', '', '3392697867', '', 'SMNMRA56E17H501A', 'maxmonelli@yahoo.it', 'Via Riccardo Forster, 87', '00143', 'Roma', 'Rm', '', 0),
(88, 5, 'Green Sofia', '', '', '', '', '', '', '', '', '', '', 0),
(90, 2, 'Scriptorium s.r.l', '0115660809', '', '10422410018', '', '', 'C.so Vinzaglio, 24', '10121', 'Torino', 'To', '', 0),
(91, 2, 'Belgravia s.a.s.', '0113852921', '', '05773230015', '', 'libreria.belgravia@gmail.com', 'Via Monginevro, 44 Bis', '10141', 'Torino', 'To', 'Sede operativa in  Via Vicoforte, 14/D 10139 To - Luca', 0),
(92, 2, 'Libreria Tra le righe s.a.s di Giovacchini Leonardo &C.', '050830177', '', '02002000509', '', 'libreriatlr@yahoo.it', 'Via Corsica, 8', '56126', 'Pisa', 'Pi', '', 0),
(93, 2, 'Libreria Guida 2', '0815560170', '', '05660010637', '', '', 'Via Merliani, 118/120', '80129', 'Napoli', 'Na', 'Falliti', 0),
(94, 3, 'Stand Valle d\'Aosta', '', '3346816559', '', '', '', '', '11100', 'Aosta', 'Ao', 'Longo Massimo', 0),
(95, 2, 'Denadai s.n.c.', '0245497966', '', '13215150155', '', '', 'Corso XXII Marzo, 39', '20129', 'Milano', 'Mi', '', 0),
(96, 2, 'La galleria del libro s.n.c.', '0125641212', '', '03870980012', '', 'info@lagalleriadellibro.it', 'Via Palestro, 70', '10015', 'Ivrea', 'To', '', 0),
(97, 2, 'Libreria Commissionaria Internazionale', '051229466', '', '00683830376', '', 'libreria.comnit@libero.it', 'Via San Petronio Vecchio, 3', '40125', 'Bologna', 'Bo', 'Igor', 0),
(98, 2, 'Bardamu s.r.l.', '0574448224', '', '02004170979', '', 'libreriamondadoripo@gmail.com', 'Via Guizzelmi, 13/15', '59100', 'Prato', 'Po', 'Mondadori', 0),
(99, 2, 'Libreria Editrice Goriziana', '048133776', '', '00351720313', '', 'leg@leg.it', 'Corso Verdi, 67', '34170', 'Gorizia', 'Go', '', 0),
(100, 1, 'Celant Giancarla', '', '', '', '', 'giancarla.b.celant@aexp.com', 'c/o American Express 6° piano, corpo D Largo Caduti El Alamain, 9', '00173', 'Roma', 'Rm', '', 0),
(101, 2, 'Libreria Nuova Tarantola', '', '', '02540130362', '', 'milenapelloni@libreriatarantola.it', 'via Canalino, 35', '41121', 'Modena', '', 'Contatto: Milena', 0),
(102, 1, 'Cecchini Lorena', '06 50072307', '3394532591', '', '', 'lorena.cecchini@isprambiente.it', 'Via Vitaliano Brancati, 48', '00144', 'Roma', '', 'Resp. Redazione ISPRA TV', 0),
(103, 2, 'Cartoleria Le Nuvole di Bettolini Ermanna', '0290076296', '', '01159760188', 'BTTRMN52D68E026Q', '', 'Via Gramsci, 9', '20084', 'Lachiarella', 'Mi', '', 0),
(104, 9, 'Unione degli Armeni d\'Italia', '', '', '', '', 'rupen@comunitaarmena.it', 'Piazza Velasca, 4', '20122', 'Milano', 'Mi', '', 0),
(105, 1, 'Scalera Maddalena', '', '', '', '', '', 'Via Camillo Rosalba, 44', '70124', 'Bari', 'BA', '', 0),
(106, 1, 'Pitzus Maria Dolores', '', '', '', '', '', 'via Emilio Macro n. 28', '00169', 'Roma', 'Rm', '', 0),
(107, 8, 'Capitani Sandro', '', '335.1331120', '', '', 's.capitani@rai.it', 'Radio 1 Rai Saxsa Rubra, Largo Villy de Luca, 5', '00188', 'Roma', 'Rm', '', 0),
(108, 2, 'Licosa Libreria Commissionaria Sansoni S.p.a.', '05564831', '', '00431920487', '', 'licosa@licosa.com', 'Via Duca di Calabria 1/1', '50125', 'Firenze', 'Fi', '', 0),
(111, 1, 'Barile Francesca', '', '', '', '', '', 'Via Martin Luther King, 19', '70124', 'Bari', '', '', 0),
(112, 1, 'Manzur c/o IFAD All\'attenzione di Elizabeth', '0654592556', '', '', '', 'e.manzur@ifad.org', 'Via Paolo di Dono, 44', '00142', 'Roma', '', '', 0),
(113, 1, 'Somma Rodolfo', '', '3335877479', '', '', '', 'Via Niccolò Tommaseo, 38', '26041', 'Casalmaggiore', 'Cr', '', 0),
(114, 2, 'Libreria Rinascita (Empoli)', '057172746', '', '01416220489', '', 'info@libreriarinascita.it', 'Via Ridolfi, 53', '50053', 'Empoli', 'Fi', 'Alessia Martini', 0),
(115, 9, 'Biblioteca Italiana per i Ciechi Regina Margherita', '039283271', '', '', '', 'bic@bibciechi.it', 'Via G. Ferrari 5/A', '20900', 'Monza', 'MB', '', 0),
(116, 10, 'A.Car edizioni s.r.l.', '0293218990', '', '05938260964', '', 'info@edizioniacar.it', 'V.le Rimembranze 43/B', '20020', 'Lainate', 'Mi', '', 0),
(117, 9, 'Assessorato Istruzione e Cultura, Attività espositive Regione autonoma Valle d\'Aosta', '0165274419', '', '', '80002270074', 'g.gilli@regione.vda.it', 'C.so Battaglione, 24', '11100', 'Aosta', 'Ao', '', 0),
(118, 12, 'Elmi\'s World Casa Editrice di Elettra Groppo', '', '', '01146370075', '', 'info@elmisworld.it', 'Via Guillet, 6', '11027', 'Saint Vincent', 'Ao', '', 0),
(119, 10, 'Le Brumaie Editore', '0121354428', '', '09176740018', 'BRZLLB56C22I138N', 'direct@lebrumaieeditore.it', 'Via Roma, 70/10', '10060', 'Cantalupa', 'To', '', 0),
(120, 2, 'Libreria Arion Porta di Roma', '0687074344', '', '04936621004', '', 'portadiroma@libreriearion.it', 'Via Alberto Lionello 201 loc. Bufalotta', '00138', 'Roma', '', 'c/o Centro Commerciale Porta di Roma', 0),
(121, 3, 'Casalini Libri s.p.a.', '05550181', '', '03106600483', '', 'gen@casalini.it', 'via Benedetto da Maiano, 3', '50014', 'Fiesole', 'FI', 'Invio merce a Via Faentina, 169/15 - 50010 Caldine, FI', 0),
(122, 2, 'Viaggiante Violino', '', '', '', '', 'maurisan@hotmail.it', 'Via Vittori, 2/B', '26100', 'Cremona', 'CR', 'Se ne occupa Marisa Pacilio', 0),
(123, 1, 'Lorenzon Gloria', '', '', '', '', '', 'Via Monte Pasubio, 47', '30024', 'Musile di Piave', 'Ve', '', 0),
(124, 4, 'Sistema Bibliotecario Sud Ovest Bresciano', '', '', '', '', '', 'Via Ospedale Vecchio, 8', '25032', 'Chiari', 'Bs', '', 0),
(126, 4, 'Vercelli Caludio', '', '', '', '', '', 'Via Leopardi, 43', '10093', 'Collegno', 'To', '', 0),
(127, 1, 'Giannì Carmelo', '', '', '', '', 'cgianni3@gmail.com', 'Via Pimo Acciaresi, 15', '00157', 'Roma', 'Rm', '', 0),
(128, 1, 'Tabaccheria Campanini', '0375209841', '', '00866870199', '', 'marenca@alice.it', 'Via Manzoni, 39 b', '26040', 'Vicomoscano', 'Cr', 'Titolare: Enrica', 0),
(129, 1, 'Pisacane Mariarosaria', '', '', '', '', '', 'Via Casale dei Cicerali, 4', '84010', 'Maiori', 'Sa', '', 0),
(130, 1, 'Ristorante Al piccolo paradiso', '', '', '', '', '', 'Via Molossi, 46', '26041', 'Vicobellignano - Casalmaggiore', 'Cr', '', 0),
(132, 1, 'Petkova Teodora', '', '', '', '', 'teodorapetkova@alice.it', 'Via dei Gelsi, 186 - Loc. lido dei pini', '00042', 'Anzio', 'Rm', '', 0),
(133, 1, 'Lanning Cornelia', '', '', '', 'LNNCNL49P63Z126Q', '', 'Via Compagno, 7', '35124', 'Padova', 'Pd', '', 0),
(134, 2, 'Il Viaggiatore Curioso Libreria', '0373/256617', '', '01353890195', 'ZCCGLJ70T02Z404Y', 'viaggiatorecuriosolib@tin.it', 'Via XX Settembre, 88', '26013', 'Crema', 'Cr', '', 0),
(135, 2, 'Libreria del sole di Mecca M. Assunta', '037156211', '', '07340180142', '', 'lalibreriadelsole@tiscali.it', 'Via XX Settembre, 26', '26900', 'Lodi', 'Lo', '', 0),
(136, 5, 'Pacilio Marisa', '', '', '', 'PCLMRS69C53L736E', '', 'Wattenberg, 62 B', '6113', 'Wattenberg - Austria', '', '', 0),
(137, 2, 'Prospettive Libreria', '0481280550', '', '01121910317', '', 'prospettive.libreria@gmail.com', 'Viale XX Settembre, 88', '34170', 'Gorizia', '', 'Pia Raffaella Labianca e Paolo', 0),
(138, 3, 'Simplicissimus Book Farm Srl', '0247957996', '', '05338720963', '', 'info@simplicissimus.it', 'C.so Venezia, 10', '20121', 'Milano', 'Mi', '', 0),
(139, 1, 'Pizzeria - Ristorante Accademia dei Dissonanti', '', '', '', '', '', 'Viale Berengario Jacopo, 112', '41121', 'Modena', 'Mo', 'Da fatturare a Marisa Pacilio', 0),
(140, 2, 'Colorado s.r.l.', '0672901323', '', '', '', 'amministrazione@colorado1.it', 'Viale Antonio Ciamarra, 259', '00173', 'Roma', '', '', 0),
(141, 5, 'Gerbore Ezio', '', '', '', 'GRBZEI52S21C282T', '', 'Frazione Messigné, 16', '11020', 'Nus', 'AO', '', 0),
(142, 1, 'Mori Federica', '', '', '', 'MROFRC88E45I726A', 'federica23@alice.it', 'Via del Mandorlo 32', '53011', 'Castellina in Chianti', 'SI', '', 0),
(143, 5, 'Raineri Alberto', '', '328.00.81.54', '', 'RNRLRT58C28F205H', 'alberto.rainerio@gmail.com', 'Via Mazzini, 15', '56034', 'Chianni', 'PI', '', 0),
(144, 1, 'Pantano Rosa', '', '', '', '', 'rossanapantano@gmail.com', 'via Thaon de Revel 18/20', '90142', 'Palermo', 'PA', '', 0),
(145, 1, 'Ricci Franco', '', '', '', '', '', 'via Alfredo Oriani 35', '48121', 'Ravenna', 'RA', '', 0),
(146, 1, 'La Rocca Salvatore', '', '', '', '', 'salvatore.larocca@mail.wind.it', 'via Cesare Giulio Viola 48', '00148', 'Roma', 'RM', '', 0),
(147, 2, 'Cartolibreria Montegrappa di Longo Sergio', '011740412', '', '05169790010', 'LNGSRG52T14H501T', '', 'Corso Monte Grappa, 64', '10146', 'Torino', 'TO', '', 0),
(148, 2, 'Baba Jaga Snc Grimorio Libri', '0573 25865', '', '01478480476', '', 'grimoriolibri@gmail.com', 'Via S. Anastasio, 13', '51100', 'Pistoia', 'Pt', '', 0),
(149, 2, 'Blu Book sas di C. Tozzi & C.', '050 23341', '', '02066740503', '', 'l.baldini@blubook.it - libreriablubook@gmail.com', 'Via Toselli, 23/b', '56125', 'Pisa', 'Pi', 'Carla', 0),
(150, 2, 'Equilibri libreria di Fiaschi e Cantini sas', '0574 400485', '', '02057120970', '', 'info@equilibri-libreria.it', 'Via Magnolfi, 67/69', '59100', 'Prato', 'Po', '', 0),
(151, 2, 'Lo Spazio di M. Pompei e A. Trippis.n.c.', '057321744', '', '01562040475', '', 'lo-spazio@libero.it', 'Via dell\'ospizio, 26/28', '51100', 'Pistoia', 'Pt', '', 0),
(152, 1, 'Tabaccheria - Cartoleria Bancod Eralda', '0166546112', '', '05506370071', 'BNCRDM47A56C595Y', '', 'Fraz, Arlier, 30', '11023', 'Chambave', 'Ao', 'Sede in via Chanoux, 43 Chambave', 0),
(153, 1, 'Tabacchi e giornali di Brunet Patrik', '0165767494', '', '01053040075', 'BRNPRC75E21A326P', '', 'Via Aosta, 5', '11020', 'Nus', 'Ao', '', 0),
(155, 2, 'Livres et Musique Les Bouquins s.r..l', '0125307688', '', '00632940078', '', '', 'Route Ramey, 48', '11020', 'Champoluc', 'Ao', '', 0),
(156, 2, 'Libreria delle donne', '055240384', '', '01645310481', '', '', 'Via Fiesolana, 28', '50122', 'Firenze', 'Fi', '', 0),
(161, 2, 'Libreria Trame', '051233333', '', '02571921200', '', 'info@libreriatrame.com', 'Via Goito, 3/c', '40126', 'Bologna', 'Bo', '', 0),
(162, 2, 'Libreria Rinascita Società Cooperativa', '0303755394', '', '03057410171', '', 'rinascita@libero.it', 'Via Calzavellia, 26', '25122', 'Brescia', 'Bs', '', 0),
(163, 4, 'Travelmark di Nadia Pasqual', '0412000081', '3492131565', '', '', '', 'Via Monte S. Michele, 18/B', '30171', 'Mestre', 'Ve', '', 0),
(164, 1, 'Laurent Marisa', '0166511415', '', '', 'LRNMRS55P63A326H', '', 'Via Guillet, 6', '11027', 'Saint Vincent', 'Ao', '', 0),
(165, 10, 'Onirica Edizioni Gabellone Adriano', '', '3892707252', '01556950093', 'GBLDRN75H26A122D', 'redazione@oniricaedizioni.it', 'Via Cesare Pavese, 3', '20060', 'Trezzano Rosa', 'Mi', '', 0),
(166, 2, 'Il mondo di Alice di Borgioli Morena', '0574675066', '', '01782590473', 'BRGMRN52D63G999B', 'libreriailmondodialice@virgilio.it', 'Via Roma, 15', '51031', 'Agliana', 'PT', '', 0),
(167, 1, 'Biagi Francesco', '', '', '', '', 'biagi66@gmail.com', 'Via Volta 2/A', '55049', 'Viareggio', 'Lu', '', 0),
(168, 1, 'Varotto Elena', '', '', '', '', '', 'Via Verdi, 30', '35024', 'Bovolenta', 'Pd', '', 0),
(169, 1, 'Angelucci Nicola', '', '', '', '', 'nicolangelucci@libero.it', 'Località Sferracavallo 19/a', '05018', 'Orvieto', 'TR', 'c/o Marcello Lucchi-Electrosys srl', 0),
(170, 3, 'DigitPub s.r.l.', '0289692377', '', '06514320966', '', 'info@bookrepublic.it', 'Via Degli Olivetani 12', '20123', 'Milano', 'Mi', '', 0),
(171, 6, 'Digital Print Service s.r.l.', '022134935', '', '03847870965', '', 'contabilita@dp-service.it', 'Via dell\'Annunciata 27', '20121', 'Milano', 'Mi', 'Sede operativa : Via Torricelli 9, 20090 Segrate Mi', 0),
(172, 6, 'Legatoria Monti', '0113852563', '', '09488630014', '', '', 'Via Perotti 44', '', 'Grugliasco', 'To', '', 0),
(173, 6, 'MacMedia s.n.c.', '0121397763', '', '07357550016', '', 'macmedia@mac-media.it', 'Via Bignone, 83/M', '10064', 'Pinerolo', 'To', '', 0),
(174, 1, 'Peretto Agnese', '', '', '', '', '', 'C/da Soldà, 14', '36078', 'Piana di Valdagno', 'Vi', '', 0),
(175, 5, 'Landrini Cesare', '', '3387895738', '', 'LNDCSR39B06I921N', 'cesare.landrini@fastwebnet.it', 'Via Satrico 11', '00183', 'Roma', '', '', 0),
(176, 1, 'Ceolin Nicoletta', '', '', '', '', 'nicolettaceolin@gmail.com', 'Loc.Vaccairi n.10 fraz.Trinita', '18039', 'Ventimiglia', 'Im', '', 0),
(177, 5, 'Mantovani Luigi', '', '', '', '', '', '', '', '', '', '', 0),
(178, 5, 'Marsi Cristina', '', '', '', '', '', '', '', '', '', '', 0),
(179, 5, 'Grasso Paolo Edoardo', '', '', '', '', '', '', '', '', '', '', 0),
(180, 2, 'Libreria L\'Argonauta', '068543443', '', '07264561007', '', 'info@librerialargonauta.com', 'Via Reggio Emilia, 89', '00198', 'Roma', 'Rm', '', 0),
(181, 2, 'Libreria Virgy', '0312070840', '3771896201', '06725150962', '', 'info.virgy@libero.it', 'Via E. D\'Adda, 1', '22066', 'Mariano Comense', 'Co', '', 0),
(182, 2, 'Libreria Fratelli Morelli s.n.c.', '041411314', '', '00251540274', '', 'ordini@fratellimorelli.it', 'Via Matteotti, 27', '30031', 'Dolo', 'Ve', '', 0),
(183, 2, 'Aforisma - Libreria Tanabata', '025463980', '', '13154220159', '', 'info@tanabata.it', 'Via Adige, 7', '20135', 'Milano', 'Mi', '', 0),
(184, 10, 'Edizioni Astragalo di Alessandra Perotti', '', '3475360034', '02083410031', 'PRTLSN67H54D872B', 'redazione@edizioniastragalo.it', 'Via Verbano, 146', '28100', 'Novara', 'No', '', 0),
(185, 2, 'Waste of time - Carresta s.n.c.', '0249756000', '', '07933670965', '', 'info@wasteoftime.it', 'V.le E. Martini, 9', '20139', 'Milano', 'Mi', '', 0),
(186, 2, 'Libreria Lazzarelli s.r.l.', '0321629188', '', '02120110032', '', 'https://www.facebook.com/lazzarelli.libreria', 'Via Rosselli, 45', '28100', 'Novara', 'No', '', 0),
(187, 2, 'Cartoleria Arcobaleno di Lisa Rampazzo', '0444905943', '', '03829370240', 'RMPLSI79B66L840G', 'info@arcobaleno-vi.com', 'Via del Risorgimento, 126', '36030', 'Caldogno', 'Vi', '', 0),
(188, 3, 'Fabiolibri di Fabio Douglas Scotti', '031511069', '3356749412', '02726890136', 'DGLFBA39T04D612H', 'info@fabiolibri.it', 'Via Burgo, 2/a', '22026', 'Maslianico', 'Co', 'www.fabiolibri.it', 0),
(189, 2, 'Pangea s.a.s. di Giandomenico Tono & C.', '0498764022', '', '02635140284', '', 'libreria@libreriapangea.com', 'Via S. Martino e Solferino, 106', '35122', 'Padova', 'Pd', '', 0),
(190, 1, 'AA vendita diretta', '', '', '', '', '', '', '', 'IT', '', '', 0),
(191, 4, 'AA promozione', '', '', '', '', '', '', '', 'IT', '', '', 0),
(192, 2, 'Tetto Manuela', '', '', '', '', '', '', '', '', '', '', 0),
(193, 2, 'Libreria Agorà Editrice', '043983487', '', '00942950254', '', 'libreria.agora@libero.it', 'Via Garibaldi, 8', '32032', 'Feltre', 'BL', 'Denis', 0),
(194, 1, 'Martis Maicol', '', '', '', 'MRTMCL82C02A326C', 'maicol.m@hotmail.it', 'Viale Conti Crotti, 42', '11100', 'Aosta', 'Ao', '', 0),
(195, 3, 'Libro Co. Italia', '0558229414', '', '00527630479', '', 'alessandro@libroco.it', 'Via Borromeo, 48', '50026', 'San Casciano V.P.', 'FI', 'Alessandro Neri - Attenzione magazzino altro indirizzo', 0),
(196, 3, 'Libro Co. Italia Magazzino Distribuzione', '', '', '', '', '', 'Via di Lucciano, 35', '50026', 'San Casciano V.P.', 'FI', '', 0),
(198, 1, 'Castro Maria Lucia', '', '', '', '', 'elelucy@gmail.com', 'Loc. Cenaia, Via V. Veneto, 1', '56040', 'Crespina Lorenzana', 'PI', '', 0),
(199, 2, 'Libreria al Segno', '0434520506', '', '00221340938', '', 'alsegno@libero.it', 'Vicolo del Forno, 2', '33170', 'Pordenone', 'Pn', 'Elisa', 0),
(200, 2, 'Biblioteca regionale di Aosta', '0165274800', '', '', '', '', 'Via Torre del Lebbroso, 2', '11100', 'Aosta', 'Ao', '', 0),
(201, 5, 'Borriello Elvira', '', '', '', 'BRRLVR55T48L259E', '', 'Via Chatelard, 9', '11100', 'Aosta', 'Ao', '', 0),
(202, 1, 'Cavazzoni Anna Lisa', '', '', '', '', '', 'Via Tesserete, 37', '6900', 'Massagno (Svizzera)', 'CH', '', 0),
(203, 5, 'Ferri Barbara', '00201064409766', '', '', 'FRRBBR72C42E625T', 'barbaratferri@hotmail.com', 'via Topazio, 13', '00042', 'Anzio', 'Rm', '', 0),
(204, 2, 'Libreria la memoria del mondo', '0297295105', '', '12081670155', '', 'info@memoriadelmondo.it', 'Galleria Portici, 5', '20013', 'Magenta', 'Mi', '', 0),
(205, 1, 'Faligi editore', '', '', '01124850072', '', '', 'Corso Saint Martin de Corleans, 95', '11100', 'Aosta', 'Ao', '', 0),
(206, 5, 'Groppo Paolo', '069994512', '3347344869', '', 'GRPPLA60T01L840O', 'paolo.groppo@gmail.com', 'Via Comunale di Cesano', '00061', 'Anguillara Sabazia', 'Rm', '', 0),
(207, 1, 'Friends', '025516812', '3314659166', '07587770962', '', 'info@friendsmilano.com', 'Via L. Muratori, 10', '20135', 'Milano', 'Mi', '', 0),
(208, 12, 'Musumeci Editore S.R.L.', '01651825571', '', '01179830078', '', 'info@musumecieditore.it', 'Loc. Amérique, 99', '11020', 'Quart', 'Ao', '', 0),
(209, 2, 'Fiera Les Mots', '', '', '00000000000', '', '', 'Piazza Chanoux', '11100', 'Aosta', 'Ao', '', 0),
(210, 12, 'Conti Editore di Paola Marchese', '', '', '02448360186', 'MRCPLA63A45B885G', 'paola.marchese@conti-editore.it', 'Rue des Condemines, 39', '11017', 'Morgex', 'Ao', '', 0),
(211, 2, 'Libreria Terza Pagina di Busti Massimiliano', '0452223407', '', '04189650239', 'BSTMSM73P01L949S', 'info.terzapagina@libero.it', 'C.so Garibaldi, 16/G', '37069', 'Villafranca di Verona', 'Vr', '', 0),
(212, 2, 'Pagina Dodici (Società Cooperativa)', '0458005750', '', '03631900234', '', '', 'Corte Sgarzerie, 6/A', '37121', 'Verona', 'Vr', '', 0),
(214, 4, 'Festival Letteratura Milano', '', '', '97620700159', '', 'organizzazione@festivaletteraturamilano.it', 'Via Col di Lana, 4', '20136', 'Milano', 'Mi', '', 0),
(215, 5, 'Ratto Pietro', '0141901306', '', '', 'RTTPTR6511D969K', 'pietroratto@teletu.it', 'Via Nigiotto, 69', '14014', 'Montafia', 'At', '', 0),
(216, 2, 'Libreria Garbolino di Garbolino Giandomenico', '0119207949', '', '02890520014', 'GRBGDM53B12C722B', 'info@libreriagarbolino.it', 'Via Nino Costa, 17', '10073', 'Ciriè', 'To', '', 0),
(217, 1, 'Comitato Fumane Futura', '', '', '', '93206820230', 'mimmo@arci-passepartout.org', 'Via Cà Cornocchio, 1', '37022', 'Fumane', 'Vr', '', 0),
(218, 1, 'Gillone Massimo', '', '', '', '', 'massimo.gillone.ma53@gmail.com', 'Via Martiri d\'Italia, 25', '10014', 'Caluso', 'To', '', 0),
(219, 1, 'Marischi Micaela', '', '', '', '', 'micaela.marischi@qualical.com', 'Via Giuseppe Verdi, 3', '24121', 'Bergamo', 'Bg', '', 0),
(220, 2, 'Libreria della Torre s.n.c.', '', '', '09069220011', '', 'info@libreriadellatorre.it', 'Via Vittorio Emanuele II, 34', '10023', 'Chieri', 'To', '', 0),
(222, 2, 'Cartolibreria Saint Etienne di Rolland Charlène', '016541049', '', '01152260079', 'RLLCRL90M63A326Q', 'info@libreriasaintetienne.it', 'Fraz. Oveillan, 88', '11010', 'Sarre', 'Ao', '', 0),
(223, 1, 'Caramori Lisa', '', '', '', '', 'dshmf@hotmail.it', 'Via Piero Gobetti', '44027', 'Migliarino', 'Fe', '', 0),
(224, 2, 'Biblioteca Nazionale Centrale Di Firenze Ufficio Deposito Legale', '', '', '', '', '', 'Via Tripoli, 36', '50122', 'Firenze', 'Fi', '', 0),
(225, 2, 'Biblioteca Nazionale Centrale Di Roma Ufficio Deposito Legale', '', '', '', '', '', 'Viale Castro Pretorio, 105', '00185', 'Roma', 'Rm', '', 0),
(226, 1, 'Spagnuolo Silvia', '', '', '', '', 'vortexxsurfer@gmail.com', 'Via scandone, 161', '83100', 'Avellino', 'Av', '', 0),
(227, 1, 'Buzzini Stefano', '', '', '', '', 'stefano.buzzini@fastwebnet.it', 'Via rondoni, 11', '20146', 'Milano', 'Mi', '', 0),
(228, 1, 'Brugiotti Cristina', '', '', '', 'BRGCST72E66H501E', 'brugy72@hotmail.com', 'Circ.ne Ostiense, 114', '00154', 'Roma', 'Rm', '', 0),
(229, 1, 'Pasotti Raffaella', '', '', '', '', 'raffaella.pasotti@gmail.com', 'Via Conselvana, 2', '35020', 'Maserà di Padova', 'Pd', '', 0),
(230, 1, 'Maragno Vittorina', '', '', '', '', 'maragnovittorina@libero.it', 'Vicolo Roberto Rossellini, 16/a', '45030', 'S. Maria Maddalena Occhiobello', 'Ro', '', 0),
(231, 1, 'Coselli Denise', '', '', '', '', 'dennybatik@yahoo.it', 'Corso Alessandria, 471', '14100', 'ASTI', 'At', '', 0),
(232, 1, 'Mangherini Adele', '', '', '', '', 'adelemanghe@hotmail.it', 'Via San Carlo, 47', '10070', 'S. Francesco al Campo', 'To', '', 0),
(233, 1, 'Guidi Stefania', '', '', '', '', 'essediver@yahoo.it', 'Via Beati, 172', '28053', 'Castelletto Sopra Ticino', 'No', '', 0),
(234, 1, 'Brigaglia Mara', '', '', '', '', 'margarethpessina@libero.it', 'Via Monte Grappa, 64', '00015', 'Monterotondo', 'Rm', '', 0),
(235, 2, 'Minimarket del libro di Pastori Emilio', '065681430', '', '08628311006', '', 'info@minilibro.it', 'Via Cesare Laurenti, 54', '00122', 'Ostia Lido Roma', 'Rm', '', 0),
(236, 12, 'Dielle Edizioni di Cinzia Rosati', '0456311659', '', '', '', 'info@dielleditore.com', '', '', '', '', '', 0),
(237, 1, 'Martoriati Mauro', '', '', '', '', '', '', '', '', '', '', 0),
(238, 1, 'Cianci Gian Biagio', '', '', '', '', 'gino.cian@libero.it', 'Via Erminia Frezzolini, 37', '00139', 'Roma', 'Rm', '', 0),
(239, 1, 'Paris Lorena', '', '', '', '', '', 'Via Valle Cupa, 26', '01100', 'Viterbo', 'Vt', '', 0),
(240, 10, 'Le Chateau s.n.c.', '0165363067', '', '00563230077', '', 'info@lechateau.it', 'Via Trottechien, 51', '11100', 'Aosta', 'Ao', '', 0),
(241, 4, 'Consulta Torinese per la Laicità delle Istituzioni', '', '', '', '', 'tulliomonti@torinolaica.it', 'Via Vassalli Eandi, 28', '10138', 'Torino', 'To', '', 0),
(242, 12, 'Federighi Editore di Pampaloni Gloria', '0571 664016', '', '06054740482', 'PMPGLR55E55E463M', 'info@federighieditore.it', 'Via Torino, 18 Zona ind. Bassetto', '50052', 'Certaldo', 'Fi', '', 0),
(243, 12, 'Tempo Libro srl', '0220520585', '3384758951', '10998000151', '', 'info@lavitafelice.it', 'Via Lazzaro Palazzi, 15', '20124', 'Milano', 'Mi', '', 0),
(244, 1, 'Russo Costanza', '', '', '', '', 'crusso@wlgore.com', 'Via Quattro Rusteghi, 16', '37135', 'Verona', 'Vr', '', 0),
(245, 1, 'Celtica', '', '3297379068', '', '', 'tatinani@libero.it', 'Bosco del Peuterey', '', 'Courmayeur', 'Ao', 'Fiera Celtica', 0),
(246, 2, 'Buona stampa di Franzoso Ivana', '0165846771', '', '00156390072', 'FRNVNI49A59D3375', 'buonastampo@yeur.net', 'Via Roma, 4', '11013', 'Courmayeur', 'Ao', '', 0),
(247, 2, 'Libreria Pergamon snc di Piera d\'Annunzio', '', '', '07447331005', '', '', 'Via Filippo Nicolai, 84/86', '00136', 'Roma', 'Rm', '', 0),
(248, 1, 'Tolu Carla', '', '', '', 'CRLTLO51A41Z326V', 'carlatolu@alice.it', 'Via Val di Non, 39', '00141', 'Roma', 'Rm', '', 0),
(249, 1, 'c/o Questura di Lecco Stefano Maraner', '', '', '', '', 'level1966@libero.it', 'Corso Promessi Sposi, 40', '23900', 'Lecco', 'Lc', '', 0),
(250, 1, 'Mazzucato Nicola', '', '', '', '', 'nicolamazzucato@alice.it', 'Via Gustavo Levorin, 17', '35127', 'Padova', 'Pd', '', 0),
(251, 1, 'Circolo ARCI Ombriano', '037330007', '', '', '', '', 'Via Lodi, 15', '26013', 'Crema', 'Cr', '', 0),
(252, 1, 'Bini Mirella', '', '', '', 'BNIMLL46S53E837L', '', 'Via Meotto, 1/A', '10098', 'Rivoli', 'To', '', 0),
(253, 10, 'Edizioni Il Cigliegio sas di Giovanna Mancini & C.', '031696284', '3466253623', '02735810133', '', 'info@edizioniilcigliegio.com', 'Via A. Diaz, 14/E', '22040', 'Lurago d\'Erba', 'Co', '', 0),
(254, 10, 'Zephyro Edizioni srl', '03631901071', '', '12929740152', '', 'zephyro@iol.it', 'Piazza Vallicella, 6', '24047', 'Treviglio', 'Bg', '', 0),
(255, 10, 'Ink Line di Corni Elisabetta', '0125637137', '3386991485', '10828910017', 'CRNLBT83S67A326X', 'inklineeditrice@gmail.com', 'Corso Torino, 42', '10019', 'Strambino', 'To', '', 0),
(256, 10, 'Araba Fenice Sas', '0171389814', '3480072584', '02205250042', '', 'info@arabafenicelibri.it', 'Via Re Benvenuto, 33', '12012', 'Boves', 'Cn', '', 0),
(257, 10, 'Edizioni Vida', '0165250462', '3284723806', '01026000073', 'QNDLDE50B49E165F', 'edizioni.vida@email.it', 'La Cure de Chevrot, 24', '11020', 'Gressan', 'Ao', '', 0),
(258, 10, 'Sogno Edizioni di Stefano Bossotto', '', '3934286492', '01922320997', 'BSSSFN75R03D969G', 'sognoedizioni@gmail.com', 'Via Borgoratti, 41/9', '16132', 'Genova', 'Ge', '', 0),
(259, 10, 'Albalibri Editore', '0586794393', '3488862181', '04660980964', '', 'info@albalibri.com', 'Piazza Monte alla Rena, 49', '57016', 'Rosignano Marittimo', 'Li', '', 0),
(260, 10, 'Chiarotto Mario D.I.', '0332223217', '3494189788', '02676900125', 'CHRMRA60M18L682C', 'info@arterigere.it', 'Via Piemonte, 61', '21100', 'Varese', 'Va', '', 0),
(262, 10, 'End snc', '0165256742', '3470909185', '05499610482', '', 'end@corpo12.it', 'Fraz. Tercindod, 14/b', '11010', 'Gignod', 'Ao', '', 0),
(263, 10, 'LiberFaber sarl', '+37793300464', '+377680867352', 'FR0400009260', '', 'carlo@liberfaber.com', 'Boulevard des Moulins, 23', '', 'Principato di Monaco', '', '', 0),
(264, 2, 'Libreria delle donne Bologna', '051271754', '', '04285900371', '92045530372', 'libreriadelledonne@women.it', 'San Felice, 16/A', '40122', 'Bologna', 'Bo', '', 0),
(265, 5, 'Arci Ombriano', '', '', '', '', '', 'Via lodi, 15', '26013', 'Crema', 'Cr', '', 0),
(266, 5, 'Bigazzi Cinzia', '', '', '', '', '', '', '', '', '', 'Federighi ed.', 0),
(267, 5, 'Orlando Valentina', '', '', '', '', '', '', '', '', '', 'Federighi ed.', 0),
(268, 5, 'Gigli Alessandro', '', '', '', '', '', '', '', '', '', 'Federighi ed.', 0),
(269, 5, 'Elmi Celina', '', '', '', '', '', '', '', '', '', 'Federighi ed.', 0),
(270, 5, 'Sinisgalli Rocco', '', '', '', '', '', '', '', '', '', 'Federighi ed.', 0),
(271, 1, 'Attanasio Giampiero', '', '', '', '', '', '', '', '', '', '', 0),
(272, 1, 'Laurentu Apostu', '', '', '', '', 'lautenzi1408@yahoo.com', 'Via Martiri della libertà, 10', '10023', 'Chieri', 'To', '', 0),
(273, 1, 'Fauda Alessandro', '', '', '', '', 'alessandro.fauda@virgilio.it', 'Strada vicinale delle sabbione, 5', '26010', 'Offanengo', 'Cr', '', 0),
(274, 1, 'Notari Marilena', '', '', '', '', 'hmiami50@hotmail.com', 'Strada Privata Peiranze, 12', '18038', 'San Remo', 'Im', '', 0),
(275, 1, 'Associazione Insaintvincent', '0166522460', '', '01114030073', '', 'segreteria@insaintvincent.it', 'Via Roma, 62', '11027', 'Saint-Vincent', 'Ao', '', 0),
(276, 2, 'Libreria Claudiana di Torre Pellice', '012191422', '', '09931640016', '', 'libreria.torrepellice@gmail.com', 'Piazza Libertà, 7', '10066', 'Torre Pellice', 'To', '', 0),
(277, 1, 'Dammacco Luca', '', '', '', '', 'dammaccoluca@gmail.com', 'Via Cordova, 20', '10020', 'Baldissero torinese', 'To', '', 0),
(278, 1, 'Contini Daria', '', '', '', '', 'daria.contini@hotmail.it', 'Via Regina Margherita, 19', '09017', 'Sant\'Antioco - Carbonia-Iglesias', 'CI', 'C/o CATERINA ESPA CREAZIONI', 0),
(279, 4, 'Amici Emiliano', '', '', '', '', 'emilianoamici@hotmail.com', 'Via Alessandra Macinghi Strozzi, 40', '00145', 'Roma', 'Rm', 'Blog Sguardo sul Medioevo', 0),
(280, 2, 'DOM S.N.C. di Giuseppe Brodetto & Roberto Briatta', '0114362689', '', '10567630016', '', 'info@fenicetorino.it', 'Corso Enrico Gamba 23/3', '10144', 'Torino', 'To', 'Libreria Fenice - Via Porta Palatina 2 - 10122 Torino', 0),
(281, 2, 'Leggendo s.n.c. di Casagrande Valeria e Lorenzetti V.', '', '', '02774790246', '', 'info@leggendo.eu', 'Via Magrini, 42', '36100', 'Vicenza', 'Vi', 'Via Verdi, 2 35013 Cittadella (Pd)', 0),
(282, 1, 'Gangemi Salvatore', '', '', '', '', 'archsalgan@libero.it', 'VI^ Retta Levante, 46', '95032', 'Belpasso', 'CT', '', 0),
(283, 1, 'Pabis Rita', '', '', '', '', 'rita.pabis@gmail.com', 'Via Serpieri 11', '00197', 'Roma', 'Rm', '', 0),
(284, 1, 'Gioria Federica', '', '', '', '', 'gioria@cheapnet.it', 'Via Torino, 117', '28060', 'Cureggio', 'No', 'Da spedire a Vittorio Gioria', 0),
(285, 1, 'Forti Francesco', '', '', '', '', 'francesco.forti@pi.infn.it', 'P.zza Caduti di El Alamein, 3', '56124', 'Pisa', 'Pi', '', 0),
(286, 1, 'Cannucciari Stefania', '', '', '', '', 'stefania.cannucciari23@gmail.com', 'Loc. Sferracavallo, 1', '05019', 'Orvieto', 'Tr', '', 0),
(287, 2, 'Ancora SRL', '', '', '11964770157', '', '', 'via G.B. Niccolini, 8', '20154', 'Milano', 'Mi', 'Libreria Ancora via Santa Croce, 35 38100 Trento telefono 0461-274444 fax 0461-983630', 0),
(288, 2, 'Libreria Claudiana Torino', '0116692458', '', '09005860011', '', 'libreria.torino@claudiana.it', 'Via Principe Tommaso 1', '10125', 'Torino', 'To', '', 0),
(289, 2, 'Libreria 55 di Elisa Caldara s.n.c.', '0119066326', '', '10426750013', '', 'libreria55@gmail.com', 'Via Palestro, 55', '10045', 'Piossasco', 'To', '', 0),
(290, 1, 'Gianandrea Rosina', '', '', '', '', 'nancy-66@libero.it', 'Via Arrigo Davila, 61', '00179', 'Roma', 'Rm', 'Acquirente Nunzia Sciuto', 0),
(291, 8, 'Schisi Brunella', '0649823128', '', '', '', 'segreteria_venerdì@repubblica.it', 'Via Cristoforo Colombo, 90', '00147', 'Roma', 'Rm', 'Redazione Venerdì', 0),
(292, 1, 'Oberto Simona', '', '', '', '', 'simona.oberto@email.it', 'Via Chivasso, 56', '14022', 'Castelnuovo Don Bosco', 'At', '', 0),
(293, 11, 'Biblioteca Comunale \'Arturo Colizzi\'', '0872607743', '', '', '', 'premioraccontamilastoria@gmail.com', 'Via Occidentale, 1', '66020', 'Rocca San Giovanni', 'Ch', 'Premio Raccontami la Storia', 0),
(294, 4, 'Barbieri Daniele', '', '', '', '', '', 'Via Appia, 38', '40026', 'Imola', 'Bo', '', 0),
(295, 3, 'Giorgetti Carlo', '', '3312746128', '', 'GRGCRL73A23L833I', '05841855386@eutelia.com', 'Via Mameli, 122', '55049', 'Viareggio', 'Lu', '', 0),
(296, 2, 'Libreria I Granai srl', '0651955770', '', '08271311006', '', 'granai@librerianuovaeuropa.com', 'Via Mario Rigamonti, 100', '00142', 'Roma', 'Rm', '', 0),
(297, 2, 'Nina di Linda Griva & C. snc', '058470060', '', '02110930464', '', 'info@ninalibreria.it', 'Via Mazzini, 54', '54045', 'Pietrasanta', 'Lu', 'Valentina', 0),
(298, 4, 'CIRCOLO CULTURALE GIORDANO BRUNO', '', '', '', '', 'pierinogiovannimarazzani@gmail.com', 'Via Garibaldi, 52', '20021', 'Bollate', 'Mi', 'PRESSO DOTT. PIERINO MARAZZANI', 0),
(299, 3, 'CSI', '', '', '80209570581', '', 'press@granloggia.it', 'Via San Nicola de Cesarini, 3', '00186', 'Roma', 'Rm', 'Fiera del libro To', 0),
(300, 10, 'Betelgeuse Editore', '045519879', '', '04109810236', '', 'info@betelgeuseeditore.it', 'Via Stella 16', '37121', 'Verona', 'Vr', '', 0),
(301, 2, 'L\'INFORMAZIONE DI A&B snc di Barbieri V. e Andreani E.', '0376809483', '', '02376320202', '', 'andreani.elena@alice.it', 'Piazza Tito Zaniboni, 13', '46040', 'Monzambano', 'Mn', '', 0),
(302, 2, 'Coop. Cult. Libreria Rinascita', '057172746', '', '01416220489', '', 'interno@libreriarinascita.it', 'Via C. Ridolfi, 53', '50053', 'Empoli', 'Fi', '', 0),
(303, 2, 'Cartolibreria Monte Emilius di Lavy Gerard ecsnc', '0165262280', '', '00063010078', '', 'monte.emilius@libero.it', 'Av. Conseil des Commis, 28', '11100', 'Aosta', 'Ao', '', 0),
(304, 2, 'Le Storie Libreria Bistrot', '0664420211', '', '10017021006', '', 'info@lestorie.it', 'Via Giulio Rocco, 37-39', '00154', 'Roma', 'Rm', '', 0),
(305, 9, 'Biblioteca Chiesa Rossa', '0288465991', '', '', '', 'c.bibliochiesarossa@comune.milano.it', 'Via San Domenico Savio, 3', '20142', 'Milano', 'Mi', '', 0),
(306, 8, 'Cecchini Daniela', '', '', '', '', '', 'Via Berardelli, 11/b', '02046', 'Magliano Sabina', 'Ri', '', 0),
(307, 2, 'Libreria Palomar di Porta Valentina', '', '', '03003810169', 'PRTVNT74S61I628V', 'libreria.palomar@tiscali.it', 'Via A. Maj 10 I', '24121', 'Bergamo', 'Bg', '', 0),
(308, 1, 'Rosolen Chiara', '', '', '', '', 'chiara.rosolen@hotmail.it', 'Via teresa poggio 7', '15020', 'Castelletto Merli', 'Al', '', 0),
(309, 1, 'Barocci Isabella', '', '', '', '', '', '', '', 'Jesi', 'An', '', 0),
(310, 9, 'Bellofatto Pericle', '', '', '', '', '', 'Largo Beltramelli 1/c', '00157', 'Roma', 'Rm', 'Per Associazione culturale Gabriella Ferri - Roma', 0),
(311, 1, 'Geroli Giacomo', '', '3471561227', '', 'GRLGCM71D12F205J', 'giacomogeroli@gmail.com', 'Via Francesco Nullo, 14', '20129', 'Milano', 'Mi', 'CITOFONARE SGS ARCHITETTI ASSOCIATI', 0),
(312, 1, 'Lyse Mette', '', '', '', '', 'mettelyse@hotmail.com', 'Via Solari, 40', '20144', 'Milano', 'Mi', 'Presso Luigi Agosti', 0),
(313, 1, 'Tosi Alessandro', '', '', '', '', 'aleversilia@libero.it', 'Via Vaiana, 12', '55045', 'Pietrasanta', 'Lu', '', 0),
(314, 5, 'Manfrin Andrea', '', '3462449466', '', 'MNFNRF83R16A326K', 'andrea.manfrin@yahoo.it', 'Localit  Bret, 27', '11020', 'Saint Christophe', 'Ao', '', 0),
(315, 2, 'Libreria Cultora', '', '3476708013', '04217570409', '', 'libreria@cultora.it', 'Via Ferdinando Ughelli, 39', '00179', 'Roma', 'Rm', '', 0),
(316, 2, 'G&G Merchandising di Guiderdone Christian', '', '3403185192', '11088940017', 'GDRCRS93P22E882W', '', 'Via Antonio Vacca, 6', '10032', 'Brandizzo', 'To', '', 0),
(317, 9, 'Biblioteca G. Carducci', '0743218801', '', '', '', 'biblioteca.comunale@comunespoleto.gov.it', 'Via Filippo Brignonr, 14', '06049', 'Spoleto', 'Pg', '', 0),
(318, 1, 'Borghesani Giuliana', '', '', '', 'BRGGLN53R49L781K', '', '', '', 'Verona', 'Vr', '', 0),
(319, 1, 'Stoto Mattia', '', '', '', '', 'mattia.stoto@tin.it', 'Via Stefano Ceca Vico Bellezza, 6', '81030', 'Nocelleto di Carinola', 'Ce', '', 0),
(320, 2, 'Libreria Bettini sas', '054721634', '', '01537450403', '', 'info@libreriabettini.it', 'Piazza del Popolo, 25/26', '47521', 'Cesena', 'Fc', 'Referente Daniela', 0),
(321, 1, 'Marinozzi Gabrio', '', '', '', 'MRNGBR68A11L117C', 'gabrio.marinozzi@gmail.com', '', '', '', '', '', 0),
(322, 1, 'Polastri Gianluca', '', '', '', 'PLSGLC72D29L219V', 'gianluca_polastri@hotmail.com', 'Corso Bramante, 27', '', 'Torino', 'To', '', 0),
(323, 3, 'Tessore Cristina', '', '', '', 'TSSCST60M52A166L', '', 'Via Boston, 40', '', 'Torino', 'To', '', 0),
(324, 2, 'Libreria internazionale Luxemburg', '0115613896', '', '01427170012', '', 'bookslux@libero.it', 'Via Cesare Battisti, 7', '10123', 'Torino', 'To', '', 0),
(325, 6, 'ETABETA PS di AlessandroSgueglia', '0399633934', '', '03497340137', 'SGGLSN92L01H834E', '', 'Via A. Grandi, 80', '20862', 'Arcore', 'Mb', '', 0),
(326, 4, 'Bianchi Matteo B.', '', '', '', '', 'matteo@matteobb.com', 'Viale Monza, 93', '20125', 'Milano', 'Mi', 'c/o Portineria', 0),
(327, 4, 'PRIDE', '', '', '', '', 'segreteria@prideonline.it', 'Via Antonio da Recanate, 7', '20124', 'Milano', 'Mi', 'c/o Studio Know How', 0),
(328, 2, 'Cartolibreria Spazzali snc di Giuseppe Spazzali &C.', '0462342393', '', '01383460225', '', 'spazzalisnc@gmail.com', 'Piazza Scopoli, 13', '38033', 'Cavalese', 'Tn', '', 0),
(329, 1, 'Giussani Stefano', '', '', '', '', '', 'Via Manara, 48', '20900', 'Monza', 'Mb', '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `soggettitipologia`
--

CREATE TABLE `soggettitipologia` (
  `idsoggettotipologia` int(11) NOT NULL,
  `soggettotipologia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `soggettitipologia`
--

INSERT INTO `soggettitipologia` (`idsoggettotipologia`, `soggettotipologia`, `cancellato`) VALUES
(1, 'Privato', 0),
(2, 'Libreria', 0),
(3, 'Distributore', 0),
(4, 'Recensore', 0),
(5, 'Autore', 0),
(6, 'Tipografia', 0),
(7, 'Corriere', 0),
(8, 'Giornalista', 0),
(9, 'Contatto', 0),
(10, 'Editore', 0),
(11, 'Collaboratore', 0),
(12, 'Casa editrice', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `spese`
--

CREATE TABLE `spese` (
  `idspesa` int(11) NOT NULL,
  `fksoggetto` int(11) NOT NULL,
  `fktipologia` int(11) NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `importoconiva` double NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `spesetipologia`
--

CREATE TABLE `spesetipologia` (
  `idspesatipologia` int(11) NOT NULL,
  `spesatipologia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `spesetipologia`
--

INSERT INTO `spesetipologia` (`idspesatipologia`, `spesatipologia`, `cancellato`) VALUES
(1, 'Cartoleria', 0),
(2, 'Corriere', 0),
(3, 'Collaborazioni', 0),
(4, 'Software', 0),
(5, 'Hardware', 0),
(6, 'Fiere', 0),
(7, 'Presentazioni', 0),
(8, 'Promozione', 0),
(9, 'Formazione', 0),
(10, 'Organizzazione', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `stampe`
--

CREATE TABLE `stampe` (
  `idstampa` int(11) NOT NULL,
  `fklibro` int(11) NOT NULL,
  `stampadata` date NOT NULL,
  `stampaquantita` int(11) NOT NULL,
  `stampacosto` double NOT NULL,
  `stampaspedizione` double NOT NULL,
  `stampaiva` double NOT NULL,
  `fktipografia` int(11) NOT NULL,
  `stampadocumento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tentativilogin`
--

CREATE TABLE `tentativilogin` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `tentativilogin`
--

INSERT INTO `tentativilogin` (`user_id`, `time`) VALUES
(222, '1486325472'),
(222, '1486325472');

-- --------------------------------------------------------

--
-- Struttura della tabella `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `stampatempo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `test`
--

INSERT INTO `test` (`id`, `stampatempo`) VALUES
(5, '2016-06-04 19:35:17'),
(6, '2016-06-04 19:35:17');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `idutente` int(11) NOT NULL,
  `fksoggetto` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `password` char(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(128) COLLATE utf8_unicode_ci NOT NULL,
  `ruolo` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`idutente`, `fksoggetto`, `username`, `email`, `password`, `salt`, `ruolo`) VALUES
(1, 1, 'emilie', 'emilie.rollandin@gmail.com', 'bde813f492821771db820b50fc93d2a520660c8faad9f6f380e5abeb6978eb4760a863424e4f105da64aec24dd92bf9efabe55dc7217d3caa8832137805a07c4', '5d86f4188a0109efef7f0f09d6ca7e303508f375dfa2cb2b44cbdbd0570110e22d9828029c099bda822b77bf4c85c1264c7e68accfd151f6a3ae349b7b28eae4', '-');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `casaeditrice`
--
ALTER TABLE `casaeditrice`
  ADD PRIMARY KEY (`idcasaeditrice`);

--
-- Indici per le tabelle `collane`
--
ALTER TABLE `collane`
  ADD PRIMARY KEY (`idcollana`);

--
-- Indici per le tabelle `contrattiedizione`
--
ALTER TABLE `contrattiedizione`
  ADD PRIMARY KEY (`idcontrattoedizione`),
  ADD KEY `idlibro` (`fklibro`);

--
-- Indici per le tabelle `iva`
--
ALTER TABLE `iva`
  ADD PRIMARY KEY (`idiva`),
  ADD KEY `idlibrotipologia` (`fktipologia`);

--
-- Indici per le tabelle `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`idlibro`),
  ADD KEY `idcasaeditrice` (`fkcasaeditrice`),
  ADD KEY `idcollana` (`fkcollana`),
  ADD KEY `idlibrotipologia` (`fktipologia`);

--
-- Indici per le tabelle `libritipologia`
--
ALTER TABLE `libritipologia`
  ADD PRIMARY KEY (`idlibrotipologia`);

--
-- Indici per le tabelle `movimenti`
--
ALTER TABLE `movimenti`
  ADD PRIMARY KEY (`idmovimento`),
  ADD KEY `idmovimentotipologia` (`fktipologia`),
  ADD KEY `idsoggetto` (`fksoggetto`),
  ADD KEY `idpagamentotipologia` (`fkpagamentotipologia`),
  ADD KEY `idmovimentoaspetto` (`fkaspetto`),
  ADD KEY `idmovimentotrasporto` (`fktrasporto`);

--
-- Indici per le tabelle `movimentiaspetto`
--
ALTER TABLE `movimentiaspetto`
  ADD PRIMARY KEY (`idmovimentoaspetto`);

--
-- Indici per le tabelle `movimenticausale`
--
ALTER TABLE `movimenticausale`
  ADD PRIMARY KEY (`idmovimentocausale`);

--
-- Indici per le tabelle `movimentidettaglio`
--
ALTER TABLE `movimentidettaglio`
  ADD PRIMARY KEY (`idmovimentodettaglio`),
  ADD KEY `idmovimento` (`fkmovimento`),
  ADD KEY `idlibro` (`fklibro`);

--
-- Indici per le tabelle `movimentitipologia`
--
ALTER TABLE `movimentitipologia`
  ADD PRIMARY KEY (`idmovimentotipologia`);

--
-- Indici per le tabelle `movimentitrasporto`
--
ALTER TABLE `movimentitrasporto`
  ADD PRIMARY KEY (`idmovimentotrasporto`);

--
-- Indici per le tabelle `pagamentitipologia`
--
ALTER TABLE `pagamentitipologia`
  ADD PRIMARY KEY (`idpagamentotipologia`);

--
-- Indici per le tabelle `soggetti`
--
ALTER TABLE `soggetti`
  ADD PRIMARY KEY (`idsoggetto`),
  ADD KEY `idsoggettotipologia` (`fktipologia`);

--
-- Indici per le tabelle `soggettitipologia`
--
ALTER TABLE `soggettitipologia`
  ADD PRIMARY KEY (`idsoggettotipologia`);

--
-- Indici per le tabelle `spese`
--
ALTER TABLE `spese`
  ADD PRIMARY KEY (`idspesa`),
  ADD KEY `idsoggetto` (`fksoggetto`),
  ADD KEY `idspesatipologia` (`fktipologia`);

--
-- Indici per le tabelle `spesetipologia`
--
ALTER TABLE `spesetipologia`
  ADD PRIMARY KEY (`idspesatipologia`);

--
-- Indici per le tabelle `stampe`
--
ALTER TABLE `stampe`
  ADD PRIMARY KEY (`idstampa`),
  ADD KEY `idlibro` (`fklibro`),
  ADD KEY `idtipografia` (`fktipografia`);

--
-- Indici per le tabelle `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`idutente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `casaeditrice`
--
ALTER TABLE `casaeditrice`
  MODIFY `idcasaeditrice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT per la tabella `collane`
--
ALTER TABLE `collane`
  MODIFY `idcollana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `contrattiedizione`
--
ALTER TABLE `contrattiedizione`
  MODIFY `idcontrattoedizione` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `iva`
--
ALTER TABLE `iva`
  MODIFY `idiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `libri`
--
ALTER TABLE `libri`
  MODIFY `idlibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT per la tabella `libritipologia`
--
ALTER TABLE `libritipologia`
  MODIFY `idlibrotipologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `movimenti`
--
ALTER TABLE `movimenti`
  MODIFY `idmovimento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `movimentiaspetto`
--
ALTER TABLE `movimentiaspetto`
  MODIFY `idmovimentoaspetto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `movimenticausale`
--
ALTER TABLE `movimenticausale`
  MODIFY `idmovimentocausale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la tabella `movimentidettaglio`
--
ALTER TABLE `movimentidettaglio`
  MODIFY `idmovimentodettaglio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `movimentitipologia`
--
ALTER TABLE `movimentitipologia`
  MODIFY `idmovimentotipologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `movimentitrasporto`
--
ALTER TABLE `movimentitrasporto`
  MODIFY `idmovimentotrasporto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `pagamentitipologia`
--
ALTER TABLE `pagamentitipologia`
  MODIFY `idpagamentotipologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `soggetti`
--
ALTER TABLE `soggetti`
  MODIFY `idsoggetto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;
--
-- AUTO_INCREMENT per la tabella `soggettitipologia`
--
ALTER TABLE `soggettitipologia`
  MODIFY `idsoggettotipologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT per la tabella `spese`
--
ALTER TABLE `spese`
  MODIFY `idspesa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `spesetipologia`
--
ALTER TABLE `spesetipologia`
  MODIFY `idspesatipologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `stampe`
--
ALTER TABLE `stampe`
  MODIFY `idstampa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
