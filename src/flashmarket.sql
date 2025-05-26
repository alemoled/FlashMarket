-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 06:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flashmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `monthly`
--

CREATE TABLE `monthly` (
  `ID` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`products`)),
  `day` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `status` enum('paid','inProgress','error','done') NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`products`)),
  `price` decimal(10,2) DEFAULT NULL,
  `orderDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `store` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `image`, `category`, `store`) VALUES
(377, 'Bacon en tiras Nuestra Alacena de Dia bandeja 2 x 100 g', 'Panceta de cerdo (95%), sal, conservadores (E326, E243, E250), estabilizantes (E451, E450), dextrosa, jarabe de glucosa, antioxidantes (E331, E301), aromas, extracto de especias.', '1,84 €', 'https://www.dia.es/product_images/273750/273750_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(378, 'Pechuga de pavo Nuestra Alacena de Dia sobre 2 x 200 g', 'Pechuga de pavo (70%), agua, sal, aromas, estabilizantes (E451, E407), antioxidantes (E316, E331), conservador (E250). Puede contener trazas de proteínas de la leche, soja', '4,09 €', 'https://www.dia.es/product_images/273810/273810_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(379, 'Jamón cocido extra 97% carne Nuestra Alacena de Dia sobre 150 g', 'Jamón de cerdo (97%), sal, dextrosa, jarabe de glucosa, aromas, antioxidantes (E331, E301), estabilizantes (E451, E450, E452), fibra vegetal, conservadores (E250, E243), extracto de especias.', '1,99 €', 'https://www.dia.es/product_images/273737/273737_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(380, 'Jamón de cebo ibérico 50% Nuestra Alacena de Dia bandeja 90 g', 'Jamón de cerdo ibérico 50% raza ibérica, sal, azúcar, conservador (E252, E250), dextrosa, antioxidante (E301). Puede contener trazas de leche.', '4,99 €', 'https://www.dia.es/product_images/274057/274057_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(381, 'Paleta de cebo ibérica 50% Nuestra Alacena de Dia bandeja 100 g', 'Paleta de cerdo ibérica 50% raza ibérica, sal, azúcar, conservador (E252, E250), dextrosa, antioxidante (E301). Puede contener trazas de leche.', '4,99 €', 'https://www.dia.es/product_images/274058/274058_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(382, 'Jamón Serrano reserva Nuestra Alacena de Dia bandeja 200 g', 'Jamón de cerdo (145 g de jamón de cerdo utilizados para elaborar 100 g de producto final), sal, antioxidante (E301), conservadores (E250, E252).', '3,69 €', 'https://www.dia.es/product_images/274051/274051_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(383, 'Chorizo extra Nuestra Alacena de Dia bandeja 2 x 100 g', 'Carne de cerdo (121 g de carne de cerdo utilizados para elaborar 100 g de producto final), sal, pimentón, leche en polvo, dextrosa de maíz, especias, estabilizante (E451), antioxidante (E301), conservadores (E250, E252), colorante (E120). Tratamiento de superficie. conservadores (E202, E235). Puede contener trazas de soja', '1,59 €', 'https://www.dia.es/product_images/273988/273988_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(384, 'Espetec extra Casa Tarradellas bolsa 180 g', 'Paleta, panceta, jamón y magro de cerdo, sal , lactosa (de leche), especias, antioxidante (ascorbato sódico), conservador (nitrato potásico). Tripa comestibe natural.', '2,49 €', 'https://www.dia.es/product_images/37114/37114_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(385, 'Salchichón extra Nuestra Alacena de Dia bandeja 2 x 100 g', 'Magro, paleta y panceta de cerdo (125 g utilizados para elaborar 100 g de producto final), sal, leche en polvo, dextrosa de maíz, especias, estabilizante (E451), antioxidante (E316), conservadores (E250, E252), colorante (E120). Tratamiento superficie: conservadores  (E202, E235). Puede contener trazas de soja.', '1,71 €', 'https://www.dia.es/product_images/274140/274140_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(386, 'Queso semicurado Mahón Quesería del Mundo 220 g', 'Leche pasteurizada de vaca,sal, cuajo y fermentos lácticos. Corteza no comestible. Origen de la leche: España.', '3,49 €', 'https://www.dia.es/product_images/300005/300005_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(387, 'Queso mozzarella rallado Dia Láctea bolsa 200 g', 'Leche pasteurizada de vaca, almidón de patata, sal, fermento láctico, coagulante microbiano.', '1,62 €', 'https://www.dia.es/product_images/13096/13096_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(388, 'Queso semicurado ibérico Quesería del Mundo 175 g', 'Leche pasteurizada de vaca (<50%), oveja (>15%), y cabra (>15%), estabilizante (cloruro cálcico), cuajo y fermentos lácticos. Corteza no comestible. Origen de la leche: España.', '2,99 €', 'https://www.dia.es/product_images/300006/300006_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(389, 'Queso fresco natural Dia Láctea tarrina 4 x 62.5 g', 'Leche de vaca pasteurizada, sal, conservador (sorbato potásico) y cuajo. Puede contener trazas de leche de cabra y oveja.', '1,09 €', 'https://www.dia.es/product_images/115669/115669_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(390, 'Queso fresco de vaca El Cencerro de Dia tarrina 250 g', 'Leche pasteurizada de vaca, sal, coagulante de leche microbiano, estabilizante (cloruro cálcico) y conservador (sorbato potásico).', '1,33 €', 'https://www.dia.es/product_images/115196/115196_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(391, 'Queso fresco 0% m.g Dia Láctea tarrina 4 x 62.5 g', 'Leche desnatada de vaca pasteurizada, sal, conservador (sorbato potásico) y cuajo. Puede contener trazas de leche de cabra y oveja.', '1,09 €', 'https://www.dia.es/product_images/73062/73062_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(392, 'Queso roquefort Selección Mundial de Dia bandeja 100 g', 'Leche cruda de oveja, sal, cuajo, fermentos lácticos, Penicillium roqueforti. Puede contener trazas de gluten.', '1,90 €', 'https://www.dia.es/product_images/222761/222761_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(393, 'Queso azul Dia Láctea bandeja 150 g', 'Leche de vaca termizada, sal, fermentos lácticos, coagulante de leche microbiano, cultivos de mohos.', '1,59 €', 'https://www.dia.es/product_images/44948/44948_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(394, 'Queso gorgonzola D.O.P. Selección Mundial de Dia bandeja 150 g', 'Leche pasteurizada, fermentos lácticos, sal, moho Penicillium.', '1,88 €', 'https://www.dia.es/product_images/303266/303266_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(395, 'Queso de untar natural Dia Láctea tarrina 250 g', 'Nata, leche desnatada pasteurizada de vaca, sal, y cultivos de ácido láctico.', '1,25 €', 'https://www.dia.es/product_images/263518/263518_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(396, 'Queso fundido sándwich Dia Láctea bolsa 200 g', 'Lactosuero rehidratado, queso, proteínas de la leche, mantequilla, almidón modificado de maíz, sales de fundido (E331, E452), leche desnatada en polvo, sal, lactosuero en polvo, corrector de acidez (E330), conservador (E202), estabilizante (E407).', '0,99 €', 'https://www.dia.es/product_images/302541/302541_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(397, 'Crema con queso camembert Dia Láctea tarrina 125 g', 'Queso Camembert (50% min), queso(s) de pasta(s) prensadas nata, proteínas de leche, sales de fundido (E331, E452), sal, consenadores E202, E234). Contiene lisozima de huevo.', '1,49 €', 'https://www.dia.es/product_images/120200/120200_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(398, 'Queso edam Selección Mundial de Dia sobre 240 g', 'Leche pasteurizada de vaca, sal, fermentos lácticos, cuajo', '1,88 €', 'https://www.dia.es/product_images/263217/263217_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(399, 'Queso Munster Quesería del Mundo 125 g', 'Leche pasteurizada de vaca, sal, fermentos lácticos, cuajo y flora de superficie: bacterias del frotis rojo', '2,49 €', 'https://www.dia.es/product_images/299580/299580_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(400, 'Queso gouda cominos Quesería del Mundo 175 g', 'Leche pasteurizada de vaca, sal, 1% comino, fermentos lácticos, coagulante microbiano y colorante (E160a). Corteza no comestible.', '2,49 €', 'https://www.dia.es/product_images/299583/299583_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(401, 'Salchichas frankfurt Funky Frank de Dia bolsa 2 x 160 g', 'Carne separada mecánicamente de pollo (78%), agua, grasa de cerdo (2,5%), dextrosa, sal, almidón, estabilizantes (E466, E451), especias, aromas, antioxidantes (E316), aroma de humo, conservador (E250), envoltura comestible de colágeno. Puede contener trazas de leche.', '0,99 €', 'https://www.dia.es/product_images/303819/303819_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(402, 'Salchichas viena con queso Funky Frank de Dia bolsa 200 g', 'Carne de cerdo (35%), carne de pavo (19%), carne separada mecánicamente de pavo y pollo (15%), queso fundido (8%) (contiene leche) (queso, agua, almidón, proteína de leche, nata, sales de fundido (E-452, E-331), sal, aromas, corrector de acidez (E-330), conservador (E-202), estabilizante (E-464) y colorante (E-160a)), agua, corteza de cerdo, fécula de patata, sal, proteína de soja, fibra vegetal, aromas, aroma de humo, estabilizantes (E-451 y E-407), antioxidante (E-316) y conservador (E-250). Puede contener trazas de huevo.', '0,60 €', 'https://www.dia.es/product_images/303887/303887_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(403, 'Salchichas cocidas frankfurt Campofrío bolsa 4 x 140 g', 'Carne separada mecánicamente de pollo, agua, carne separada mecánicamente de pavo, almidón, grasa y corteza de cerdo, sal, estabilizantes (E-412, E-415, E-451), azúcar, FIBRA DE SOJA, especias, aroma de humo, antioxidante (E-316). Conservador (E-250). Puede contener TRAZAS DE LECHE', '2,45 €', 'https://www.dia.es/product_images/125955/125955_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(404, 'Paté clásico La piara lata 2 x 75 g', 'Agua, hígado de cerdo, papada de cerdo, tocino, harina de arroz, cortezas de cerdo, carne de pollo, fibra vegetal, LECHE desnatada en polvo, sal, pimentón, aromas naturales.', '1,00 €', 'https://www.dia.es/product_images/306350/306350_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(405, 'Paté de atún  Nuestra Alacena de Dia pack 2 x 75 g', 'Atún (35%), agua, leche desnatada (a partir de leche desnatada en polvo), aceite de girasol, fécula de patata, fécula de tapioca, fibra vegetal, vinagre, sal, antioxidante (E301), estabilizante (carragenano), aromas naturales (contienen pescado)', '1,65 €', 'https://www.dia.es/product_images/293539/293539_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(406, 'Paté a la pimienta Nuestra Alacena de Dia frasco 125 g', 'Tocino de cerdo, agua, hígado de cerdo (21,7%), carne de cerdo, cebolla, proteína animal (proteína de cerdo, dextrosa), sal, proteína de soja, pimienta (0,6%), azúcar, aromas, antioxidante (E301), conservador (E250). Puede contener trazas de huevo.', '1,09 €', 'https://www.dia.es/product_images/39997/39997_ISO_0_ES.jpg?imwidth=176', 'Charcutería y quesos', 'Dia'),
(407, 'Pechugas enteras de pollo Selección de Dia bandeja 600 g aprox.', 'Pechugas de pollo.', '3,47 €', 'https://www.dia.es/product_images/17936/17936_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(408, 'Jamoncitos de pollo familiar Selección de Dia bandeja 950 g aprox.', 'Jamoncitos de pollo.', '3,79 €', 'https://www.dia.es/product_images/4211/4211_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(409, 'Alas partidas de pollo Selección de Dia bandeja 550 g aprox.', 'Alas de pollo.', '3,02 €', 'https://www.dia.es/product_images/261367/261367_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(410, 'Carne de vacuno en tacos añojo Selección de Dia bandeja 500 g aprox.', 'Piezas de ternera pulidas, troceadas en forma de dados para estofado y envasadas en atmósfera protectora', '7,80 €', 'https://www.dia.es/product_images/276318/276318_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(411, 'Escalopines de vacuno Selección de Dia bandeja 450 g aprox.', 'Pieza de ternera pulida, fileteadas y envasadas en atmósfera protectora', '8,10 €', 'https://www.dia.es/product_images/170629/170629_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(412, 'Filete 1º de vacuno Selección de Dia bandeja 450 g aprox.', 'Piezas de ternera pulidas, fileteadas y envasadas en atmósfera protectora', '8,10 €', 'https://www.dia.es/product_images/181288/181288_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(413, 'Estofado de cerdo Selección de Dia bandeja 600 g aprox.', 'Estofado de cerdo Selección de Dia bandeja 600 g aprox.', '3,59 €', 'https://www.dia.es/product_images/290996/290996_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(414, 'Lomo extra adobado Selección de Dia bandeja 300 g', 'Lomo de cerdo (88%), agua, sal, especias, pimentón, antioxidante (E301) y conservador (E250).', '2,05 €', 'https://www.dia.es/product_images/164337/164337_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(415, 'Filete de cinta de lomo marinado Selección de Dia bandeja 300 g', 'Lomo de cerdo 88%, agua, sal, dextrosa, conservador (E262i), estabilizantes (E407 y E412), azúcar, antioxidantes (E300, E301 y E331), aroma y aroma de humo, concentrado de remolacha y zanahoria y jarabe de glucosa.', '2,69 €', 'https://www.dia.es/product_images/166223/166223_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(416, 'Solomillo de pavo Selección de Dia bandeja 400 g aprox.', 'Pavo', '3,40 €', 'https://www.dia.es/product_images/261350/261350_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(417, 'Chuletas de pavo al ajillo Selección de Dia bandeja 600 g aprox.', 'Contramuslo de pavo (90%), agua, vino, sal, dextrosa de maíz, aromas, conservadores (E326, E261, E250), estabilizantes ( E451, E407), dextrina de maíz, antioxidantes (E300, E331). Recubrimiento (1%): ajo y perejil.', '4,49 €', 'https://www.dia.es/product_images/147147/147147_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(418, 'Filetes de pechuga de pavo Selección de Dia bandeja 600 g aprox.', 'Pavo', '5,39 €', 'https://www.dia.es/product_images/261349/261349_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(419, 'Medio conejo troceado Selección de Dia bandeja 650 g aprox.', 'Conejo.', '6,43 €', 'https://www.dia.es/product_images/7020/7020_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(420, 'Preparado de carne picada de cerdo y vacuno Selección de Dia bandeja 500 g', 'Carne de vacuno (50%), magro de cerdo (40%), preparado a base de cereales y hortalizas (mínimo 4%); [fibra vegetal (guisante), almidón (arroz y guisante), extracto de levadura, conservador (sulfito de sodio), antioxidante (ácido ascórbico), acidulante (E331)]. Puede contener trazas de mostaza y sésamo.', '3,99 €', 'https://www.dia.es/product_images/261241/261241_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(421, 'Burger meat de pollo Selección de Dia bandeja 540 g', 'Carne de pollo (90%), agua, conservadores (lactato potásico y sulfito sódico), harina de arroz, fibra vegetal, aromas (aromas y aroma de humo), sal, almidón, dextrosa, antioxidantes (ascorbato sódico y citrato trisódico) y colorante (ácido carmínico).', '3,99 €', 'https://www.dia.es/product_images/261374/261374_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(422, 'Preparado de carne picada de vacuno Selección de Dia bandeja 500 g', 'Carne de vacuno (90%), agua, cereales y/o hortalizas (4%), sal, aromas, especias, conservador (sulfito de sodio), antioxidante (E301) y colorante (E120). Puede contener trazas de proteínas de la leche y soja.', '5,49 €', 'https://www.dia.es/product_images/261239/261239_ISO_0_ES.jpg?imwidth=176', 'Carnicería', 'Dia'),
(423, 'Ajos malla 250 g', 'Ajos malla 250 g', '1,99 €', 'https://www.dia.es/product_images/17653/17653_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(424, 'Cebolla malla 750 g', 'Cebolla malla 750 g', '1,79 €', 'https://www.dia.es/product_images/191535/191535_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(425, 'Cebolla malla 1.5 Kg', 'Cebolla malla 1.5 Kg', '1,99 €', 'https://www.dia.es/product_images/193474/193474_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(426, 'Pimiento verde granel 500 g aprox.', 'Pimiento verde granel 500 g aprox.', '1,30 €', 'https://www.dia.es/product_images/116/116_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(427, 'Pepino granel 1 Kg aprox.', 'Pepino granel 1 Kg aprox.', '1,29 €', 'https://www.dia.es/product_images/272355/272355_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(428, 'Tomate en rama granel 1 Kg aprox.', 'Tomate en rama granel 1 Kg aprox.', '1,49 €', 'https://www.dia.es/product_images/109/109_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(429, 'Calabacín unidad aprox. 500 g', 'Calabacín unidad aprox. 500 g', '0,90 €', 'https://www.dia.es/product_images/93/93_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(430, 'Berenjena granel 800 g aprox.', 'Berenjena granel 800 g aprox.', '1,51 €', 'https://www.dia.es/product_images/42071/42071_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(431, 'Calabaza a dados bolsa 500 g', 'Calabaza a dados bolsa 500 g', '1,99 €', 'https://www.dia.es/product_images/278899/278899_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(432, 'Brócoli bolsa 500 g', 'Brócoli bolsa 500 g', '1,39 €', 'https://www.dia.es/product_images/20002/20002_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(433, 'Judía verde bolsa 500 g', 'Judía verde bolsa 500 g', '1,99 €', 'https://www.dia.es/product_images/11416/11416_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(434, 'Coliflor unidad aprox. 1.9 Kg', 'Coliflor unidad aprox. 1.9 Kg', '3,78 €', 'https://www.dia.es/product_images/278856/278856_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(435, 'Lechuga iceberg 1 unidad', 'Lechuga iceberg 1 unidad', '1,00 €', 'https://www.dia.es/product_images/11462/11462_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(436, 'Cogollos bandeja 3 unidades', 'Cogollos bandeja 3 unidades', '1,29 €', 'https://www.dia.es/product_images/11461/11461_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(437, 'Corazones de cogollos bandeja 6 unidades', 'Corazones de cogollos bandeja 6 unidades', '1,99 €', 'https://www.dia.es/product_images/25904/25904_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(438, 'Patata malla 4 Kg', 'Patata malla 4 Kg', '3,99 €', 'https://www.dia.es/product_images/296356/296356_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(439, 'Zanahoria bolsa 1 Kg', 'Zanahoria bolsa 1 Kg', '1,19 €', 'https://www.dia.es/product_images/11421/11421_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(440, 'Patata de guarnición malla 1 Kg', 'Patata de guarnición malla 1 Kg', '1,99 €', 'https://www.dia.es/product_images/20298/20298_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(441, 'Champiñón entero bandeja 250 g', 'Champiñón entero bandeja 250 g', '1,49 €', 'https://www.dia.es/product_images/271527/271527_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(442, 'Champiñón laminado bandeja 250 g', 'Champiñón laminado bandeja 250 g', '1,69 €', 'https://www.dia.es/product_images/25857/25857_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(443, 'Seta ostra bandeja 200 g', 'Seta ostra bandeja 200 g', '1,69 €', 'https://www.dia.es/product_images/13337/13337_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(444, 'Espinacas Vegecampo de Dia bolsa 300 g', 'Espinacas', '1,35 €', 'https://www.dia.es/product_images/105301/105301_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(445, 'Ensalada 4 estaciones Vegecampo de Dia bolsa 250 g', 'Hortalizas en proporción variable (lechuga iceberg, zanahoria, col lombarda).', '0,83 €', 'https://www.dia.es/product_images/105299/105299_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(446, 'Dúo canónigos y rúcula Vegecampo de Dia bolsa 100 g', 'Mezcla de canónigos y rúcula en proporciones variables.', '1,45 €', 'https://www.dia.es/product_images/272831/272831_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(447, 'Espárrago verde fino manojo aprox. 250 g', 'Espárrago verde fino manojo aprox. 250 g', '1,99 €', 'https://www.dia.es/product_images/181571/181571_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(448, 'Perejil manojo 50 g', 'Perejil manojo 50 g', '0,99 €', 'https://www.dia.es/product_images/191539/191539_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(449, 'Apio bolsa 500 g', 'Apio bolsa 500 g', '1,19 €', 'https://www.dia.es/product_images/21242/21242_ISO_0_ES.jpg?imwidth=176', 'Verduras', 'Dia'),
(450, 'Fresón bandeja 500 g', 'Fresón bandeja 500 g', '1,59 €', 'https://www.dia.es/product_images/12254/12254_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(451, 'Nectarina bandeja 750 g', 'Nectarina bandeja 750 g', '2,99 €', 'https://www.dia.es/product_images/190825/190825_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(452, 'Cereza bandeja 500 g', 'Cereza bandeja 500 g', '3,99 €', 'https://www.dia.es/product_images/47085/47085_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(453, 'Manzana golden bolsa 1 Kg', 'Manzana golden bolsa 1 Kg', '1,99 €', 'https://www.dia.es/product_images/171233/171233_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(454, 'Manzana roja bolsa 1 Kg', 'Manzana roja bolsa 1 Kg', '2,49 €', 'https://www.dia.es/product_images/11466/11466_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(455, 'Manzana golden granel 500 g aprox.', 'Manzana golden granel 500 g aprox.', '1,15 €', 'https://www.dia.es/product_images/97/97_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(456, 'Banana granel 900 g aprox.', 'Banana granel 900 g aprox.', '1,43 €', 'https://www.dia.es/product_images/42070/42070_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(457, 'Plátano de Canarias El afortunado 900 g aprox.', 'Plátano de Canarias El afortunado 900 g aprox.', '3,59 €', 'https://www.dia.es/product_images/142776/142776_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(458, 'Plátano de canarias bolsa 1.2 Kg aprox.', 'Plátano de canarias bolsa 1.2 Kg aprox.', '4,43 €', 'https://www.dia.es/product_images/11468/11468_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(459, 'Pera conferencia bandeja 1 Kg', 'Pera conferencia bandeja 1 Kg', '2,49 €', 'https://www.dia.es/product_images/64505/64505_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(460, 'Pera ercolini bandeja 500 g', 'Pera ercolini bandeja 500 g', '1,99 €', 'https://www.dia.es/product_images/278651/278651_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(461, 'Pera Rincón de Soto D.O.P. granel 500 g aprox.', 'Pera Rincón de Soto D.O.P. granel 500 g aprox.', '1,50 €', 'https://www.dia.es/product_images/32063/32063_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(462, 'Naranja especial para zumo malla 4 Kg', 'Naranja especial para zumo malla 4 Kg', '5,99 €', 'https://www.dia.es/product_images/13627/13627_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(463, 'Naranjas de mesa malla 2 Kg', 'Naranjas de mesa malla 2 Kg', '3,19 €', 'https://www.dia.es/product_images/11467/11467_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(464, 'Naranja premium malla 1.5 Kg', 'Naranja premium malla 1.5 Kg', '2,99 €', 'https://www.dia.es/product_images/257840/257840_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(465, 'Uva blanca sin semilla bandeja 500 g', 'Uva blanca sin semilla bandeja 500 g', '2,99 €', 'https://www.dia.es/product_images/2672/2672_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(466, 'Uva roja sin semilla bandeja 500 g', 'Uva roja sin semilla bandeja 500 g', '2,99 €', 'https://www.dia.es/product_images/265910/265910_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(467, 'Limones malla 750 g', 'Limones malla 750 g', '1,99 €', 'https://www.dia.es/product_images/11463/11463_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(468, 'Limón selección 1 unidad', 'Limón selección 1 unidad', '0,55 €', 'https://www.dia.es/product_images/302312/302312_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(469, 'Limón bio malla 500 g', 'Limón bio malla 500 g', '1,49 €', 'https://www.dia.es/product_images/32375/32375_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(470, 'Arándanos vaso 170 g', 'Arándanos vaso 170 g', '2,59 €', 'https://www.dia.es/product_images/190387/190387_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(471, 'Frambuesas bandeja 125 g', 'Frambuesas bandeja 125 g', '1,89 €', 'https://www.dia.es/product_images/133913/133913_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(472, 'Arándanos bandeja 300 g', 'Arándanos bandeja 300 g', '3,99 €', 'https://www.dia.es/product_images/285489/285489_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(473, 'Aguacate bandeja 450 g', 'Aguacate bandeja 450 g', '2,59 €', 'https://www.dia.es/product_images/220373/220373_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(474, 'Mango bandeja 650 g', 'Mango bandeja 650 g', '1,85 €', 'https://www.dia.es/product_images/166057/166057_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(475, 'Kiwi gold Zespri bandeja 500 g', 'Kiwi gold Zespri bandeja 500 g', '2,99 €', 'https://www.dia.es/product_images/237458/237458_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(476, 'Pasas sultanas sin pepitas Naturmundo de Dia bolsa 200 g', 'Uvas pasas sultanas sin semilla, aceite de girasol. Puede contener trazas de sulfitos, leche, soja, cacahuetes y frutos de cáscara.', '1,49 €', 'https://www.dia.es/product_images/14914/14914_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(477, 'Mango deshidratado Naturmundo de Dia bolsa 90 g', 'Mango y conservador (E220 (sulfitos)). Puede contener trazas de leche, soja, cacahuetes y frutos de cáscara.', '1,99 €', 'https://www.dia.es/product_images/303110/303110_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(478, 'Ciruelas sin hueso Naturmundo de Dia bolsa 200 g', 'Ciruelas deshidratadas sin hueso, aceite de girasol, conservadores (E200, E202). Puede contener trazas de sulfitos, leche, soja, cacahuetes y frutos secos', '1,71 €', 'https://www.dia.es/product_images/14923/14923_ISO_0_ES.jpg?imwidth=176', 'Frutas', 'Dia'),
(479, 'Leche semidesnatada Dia Láctea brik 6 x 1 l', 'Leche semidesnatada de vaca.', '5,28 €', 'https://www.dia.es/product_images/504P6/504P6_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(480, 'Leche entera Dia Láctea brik 6 x 1 l', 'Leche entera de vaca.', '5,82 €', 'https://www.dia.es/product_images/608P6/608P6_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(481, 'Leche semidesnatada sin lactosa Dia Láctea brik 6 x 1 l', 'Leche semidesnatada, lactasa, acetato de retinilo (vitamina A), colecalciferol (vitamina D), acetato de DL-alfa-tocoferilo (vitamina E), ácido pteroilmonoglutámico (ácido fólico).', '5,76 €', 'https://www.dia.es/product_images/130063P6/130063P6_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(482, 'Bebida de avena con calcio Vegedia brik 1 l', 'Agua, avena (16%), aceite de girasol alto oleico, carbonato cálcico, vitaminas (B12, B2 y D). Puede contener trazas de frutos de cáscara.', '0,99 €', 'https://www.dia.es/product_images/207399/207399_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(483, 'Bebida de avena Vegedia brik 1 l', 'Agua, avena (16%), vitaminas B2, B12 y D. Puede contener trazas de frutos de cáscara.', '0,95 €', 'https://www.dia.es/product_images/267682/267682_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(484, 'Bebida de almendras 0% azúcares Vegedia brik 1 l', 'Aagua, almendras (4,5%). emulgente (lecitinas de girasol), sal marina y aromas naturales. Puede contener trazas de frutos de cáscara.', '1,30 €', 'https://www.dia.es/product_images/267684/267684_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(485, 'Batido de chocolate Dia Láctea brik 6 x 200 ml', 'Leche parcialmente desnatada (0,8% materia grasa), permeato de leche reconstituido, azúcar, cacao desgrasado en polvo (1,2%), estabilizantes (carragenanos, E460, E466), acidulante (E331).', '1,45 €', 'https://www.dia.es/product_images/296458/296458_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(486, 'Batido de cacao 90% Dia lactea brik 6 x 200 ml', 'Leche 1,4% de grasa, azúcar, cacao en polvo (1,1%), sal, estabilizante (E407), aroma. Puede contener trazas de soja.', '1,70 €', 'https://www.dia.es/product_images/115833/115833_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(487, 'Horchata Dia brik 1 l', 'Agua, chufas (12,6%), azúcar, estabilizantes (E460, E466 y E 472c), corrector de acidez (E331), aromas naturales de limón y canela.', '1,29 €', 'https://www.dia.es/product_images/26053/26053_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(488, 'Huevos frescos categoría A clase M Dia bandeja 24 unidades', 'Huevos', '4,75 €', 'https://www.dia.es/product_images/274009/274009_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(489, 'Huevos frescos categoría A clase L Dia bandeja 12 unidades', 'Huevos', '2,80 €', 'https://www.dia.es/product_images/14635/14635_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(490, 'Huevos frescos categoría A clase M Dia bandeja 12 unidades', 'Huevos', '2,60 €', 'https://www.dia.es/product_images/14636/14636_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(491, 'Mantequilla sin sal Dia Láctea 250 g', 'Nata pasteurizada, fermentos lácticos y vitamina A (Betacaroteno)', '2,39 €', 'https://www.dia.es/product_images/268201/268201_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(492, 'Mantequilla con sal Dia Láctea 250 g', 'Nata pasteurizada, fermentos lácticos, sal (1%) y vitamina A (Betacaroteno)', '2,39 €', 'https://www.dia.es/product_images/268200/268200_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(493, 'Mantequilla tradicional Central Lechera Asturiana tarrina 250 g', 'Mantequilla de leche. Origen de la leche España.', '3,39 €', 'https://www.dia.es/product_images/53766/53766_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(494, 'Nata para cocinar culinaria Dia lactea brik 3 x 200 ml', 'Nata (18% materia grasa), emulgente (E471), estabilizantes (E407, E339).', '1,89 €', 'https://www.dia.es/product_images/145042/145042_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(495, 'Nata para cocinar 15% m.g Dia Láctea brik 500 ml', 'Nata ligera de vaca, almidón modificado, emulgentes (E472b, E471), estabilizante (carragenanos).', '1,45 €', 'https://www.dia.es/product_images/294393/294393_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(496, 'Nata para montar Dia lactea brik 3 x 200 ml', 'Nata (33% materia grasa), estabilizantes (E460, E466, E407).', '2,39 €', 'https://www.dia.es/product_images/145041/145041_ISO_0_ES.jpg?imwidth=176', 'Leche, huevos y mantequilla', 'Dia'),
(497, 'Aceite refinado de girasol Diasol botella 1 l', 'Aceite refinado de girasol.', '1,80 €', 'https://www.dia.es/product_images/101/101_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(498, 'Aceite de oliva virgen extra La Almazara del Olivar de Dia botella 1 l', 'Aceite de oliva virgen extra.', '5,25 €', 'https://www.dia.es/product_images/112529/112529_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(499, 'Aceite de oliva virgen La Almazara del Olivar de Dia botella 1 l', 'Aceite de oliva virgen.', '4,65 €', 'https://www.dia.es/product_images/216284/216284_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(500, 'Vinagre de vino blanco Aliña tu Dia botella 1 l', 'Vinagre de vino, antioxidante (dióxido de azufre).', '0,75 €', 'https://www.dia.es/product_images/422/422_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(501, 'Vinagre balsámico de módena Selección Mundial de Dia botella 500 ml', 'Vinagre de vino (contiene sulfitos), mosto de uva concentrado (contiene sulfitos), colorante (E150c)', '2,39 €', 'https://www.dia.es/product_images/106144/106144_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(502, 'Crema de vinagre de módena Aliña tu Dia botella 250 ml', 'Mosto de uva cocido (contiene sulfitos), \"Aceto Balsamico di Modena IGP (43%) (vinagre de vino, mosto de uva concentrado, colorante (caramelo E150d). Contiene sulfitos), almidón modificado de maíz.', '1,99 €', 'https://www.dia.es/product_images/107321/107321_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(503, 'Tomate frito Vegecampo de Dia brik 3 x 390 g', 'Tomate (25% tomate concentrado), aceite de girasol, azúcar, almidón modificado de maíz, sal y mezcla de especias.', '1,40 €', 'https://www.dia.es/product_images/128657/128657_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(504, 'Tomate triturado Vegecampo de Dia lata 780 g', 'Tomate triturado (99,3%), sal, acidulante (ácido cítrico).', '0,96 €', 'https://www.dia.es/product_images/13105/13105_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(505, 'Tomate frito Vegecampo de Dia brik 3 x 215 g', 'Tomate y concentrado de tomate (160 g para elaborar 100 g de producto), aceite de orujo de oliva, azúcar, almidón modificado de maíz, hortalizas (cebolla y ajo), sal y acidulante (ácido cítrico).', '0,95 €', 'https://www.dia.es/product_images/1221/1221_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(506, 'Ketchup Salseo de Dia bote 560 g', 'Doble concentrado de tomate (25%), azúcar, vinagre de alcohol, almidón modificado de maíz, sal, mezcla de especias.', '1,07 €', 'https://www.dia.es/product_images/4853/4853_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(507, 'Mayonesa Salseo de Dia frasco 450 ml', 'Aceite de girasol (65%), agua, yema de huevo de gallina campera (5%), azúcar, vinagre de vino, almidón modificado de maíz, sal, concentrado de zumo de limón, acidulante (E270), conservador (E200), extracto natural de pimentón, antioxidante (E385).', '1,29 €', 'https://www.dia.es/product_images/53720/53720_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(508, 'Mayonesa Salseo de Dia bote 500 ml', 'Aceite de girasol, agua, yema de huevo de gallina campera (5%), azúcar, vinagre de vino, almidón modificado de maíz, sal, concentrado de zumo de limón, acidulante (ácido láctico), conservador (ácido sórbico), extracto natural de pimentón, antioxidante (EDTA cálcico disódico).', '1,55 €', 'https://www.dia.es/product_images/209164/209164_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(509, 'Ajo en polvo Vegecampo de Dia frasco 85 g', 'Ajo molido. Puede contener trazas de sulfitos y cacahuetes.', '1,00 €', 'https://www.dia.es/product_images/299121/299121_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(510, 'Sal marina de mesa fina Dia paquete 1 Kg', 'Sal refinada marina (100%).', '0,40 €', 'https://www.dia.es/product_images/419/419_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(511, 'Orégano Vegecampo de Dia frasco 15 g', 'Orégano', '0,69 €', 'https://www.dia.es/product_images/1293/1293_ISO_0_ES.jpg?imwidth=176', 'Aceites, salsas y especias', 'Dia'),
(512, 'Suavizante concentrado azul Super Paco de Dia botella 75 lavados', 'Suavizante concentrado azul Super Paco de Dia botella 75 lavados', '1,99 €', 'https://www.dia.es/product_images/300986/300986_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(513, 'Detergente máquina líquido colonia botella Super Paco de Dia garrafa 46 lavados', 'Detergente máquina líquido colonia botella Super Paco de Dia garrafa 46 lavados', '4,25 €', 'https://www.dia.es/product_images/274003/274003_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(514, 'Suavizante concentrado floral Super Paco de Dia botella 75 lavados', 'Suavizante concentrado floral Super Paco de Dia botella 75 lavados', '1,99 €', 'https://www.dia.es/product_images/300985/300985_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(515, 'Lavavajillas concentrado ultra Super Paco de Dia botella 500 ml', 'Lavavajillas concentrado ultra Super Paco de Dia botella 500 ml', '0,96 €', 'https://www.dia.es/product_images/273987/273987_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(516, 'Lavavajillas Super Paco de Dia botella 1.5 l', 'Lavavajillas Super Paco de Dia botella 1.5 l', '1,44 €', 'https://www.dia.es/product_images/274543/274543_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(517, 'Lavavajillas máquina classic Super Paco de Dia caja 40 unidades', 'Lavavajillas máquina classic Super Paco de Dia caja 40 unidades', '3,45 €', 'https://www.dia.es/product_images/274026/274026_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(518, 'Papel higiénico  La Llama Dia bolsa 12 unidades', 'Papel higiénico  La Llama Dia bolsa 12 unidades', '2,49 €', 'https://www.dia.es/product_images/276676/276676_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(519, 'Papel higiénico compacto doble rollo La Llama Dia bolsa 12 unidades', 'Papel higiénico compacto doble rollo La Llama Dia bolsa 12 unidades', '4,70 €', 'https://www.dia.es/product_images/276678/276678_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(520, 'Papel de cocina compacto doble rollo La Llama Dia bolsa 3 unidades', 'Papel de cocina compacto doble rollo La Llama Dia bolsa 3 unidades', '2,35 €', 'https://www.dia.es/product_images/276683/276683_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(521, 'Estropajo suciedad resistente Super Paco de Dia 3 unidades', 'Estropajo suciedad resistente Super Paco de Dia 3 unidades', '0,90 €', 'https://www.dia.es/product_images/288585/288585_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(522, 'Fregona de microfibra suelos delicados Super Paco de Dia bolsa 1 unidad', 'Fregona de microfibra suelos delicados Super Paco de Dia bolsa 1 unidad', '1,50 €', 'https://www.dia.es/product_images/288591/288591_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(523, 'Estropajo salvauñas suciedad resistente Super Paco de Dia estuche 3 unidades', 'Estropajo salvauñas suciedad resistente Super Paco de Dia estuche 3 unidades', '0,75 €', 'https://www.dia.es/product_images/288582/288582_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(524, 'Bolsa de basura con autocierre azul 30 lt Super Paco de Dia 30 unidades', 'Bolsa de basura con autocierre azul 30 lt Super Paco de Dia 30 unidades', '1,55 €', 'https://www.dia.es/product_images/269319/269319_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(525, 'Bolsa de basura con autocierre 50 lt Super Paco de Dia 10 unidades', 'Bolsa de basura con autocierre 50 lt Super Paco de Dia 10 unidades', '1,10 €', 'https://www.dia.es/product_images/298194/298194_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(526, 'Bolsa de basura con autocierre perfumada 30 lt Super Paco de Dia 20 unidades', 'Bolsa de basura con autocierre perfumada 30 lt Super Paco de Dia 20 unidades', '1,45 €', 'https://www.dia.es/product_images/269322/269322_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(527, 'Lejía con detergente Dia garrafa 2 l', 'Lejía con detergente Dia garrafa 2 l', '1,15 €', 'https://www.dia.es/product_images/1662/1662_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(528, 'Lejía Dia garrafa 5 l', 'Lejía Dia garrafa 5 l', '1,85 €', 'https://www.dia.es/product_images/68802/68802_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(529, 'Lejía con detergente Cloromax garrafa 2 l', 'Lejía con detergente Cloromax garrafa 2 l', '1,65 €', 'https://www.dia.es/product_images/152111/152111_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(530, 'Friegasuelos aroma spa Super Paco de Dia botella 1.5 l', 'Friegasuelos aroma spa Super Paco de Dia botella 1.5 l', '0,95 €', 'https://www.dia.es/product_images/269405/269405_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(531, 'Friegasuelos aroma pino Super Paco de Dia botella 1.5 l', 'Friegasuelos aroma pino Super Paco de Dia botella 1.5 l', '0,95 €', 'https://www.dia.es/product_images/269404/269404_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(532, 'Limpiacristales Super Paco de Dia spray 1 l', 'Limpiacristales Super Paco de Dia spray 1 l', '1,00 €', 'https://www.dia.es/product_images/274782/274782_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(533, 'Vinagre de limpieza Super Paco de Dia botella 1 l', 'Vinagre de limpieza Super Paco de Dia botella 1 l', '0,95 €', 'https://www.dia.es/product_images/301698/301698_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(534, 'Limpiador multiusos Super Paco de Dia spray 1 l', 'Limpiador multiusos Super Paco de Dia spray 1 l', '1,30 €', 'https://www.dia.es/product_images/274788/274788_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(535, 'Limpiador desinfectante multiusos Sanytol spray 750 ml', 'Limpiador desinfectante multiusos Sanytol spray 750 ml', '2,99 €', 'https://www.dia.es/product_images/154785/154785_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(536, 'Gel limpiador wc lejía perfumada Super Paco de Dia botella 1 l', 'Gel limpiador wc lejía perfumada Super Paco de Dia botella 1 l', '0,95 €', 'https://www.dia.es/product_images/269409/269409_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(537, 'Gel limpiador wc azul marino Super Paco de Dia botella 1 l', 'Gel limpiador wc azul marino Super Paco de Dia botella 1 l', '1,15 €', 'https://www.dia.es/product_images/269407/269407_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(538, 'Gel limpiador wc pino Super Paco de Dia botella 1 l', 'Gel limpiador wc pino Super Paco de Dia botella 1 l', '1,15 €', 'https://www.dia.es/product_images/269408/269408_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(539, 'Limpiador potente Super Paco de Dia spray 1 l', 'Limpiador potente Super Paco de Dia spray 1 l', '1,85 €', 'https://www.dia.es/product_images/301082/301082_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(540, 'Desengrasante cítrico Super Paco de Dia spray 1 l', 'Desengrasante cítrico Super Paco de Dia spray 1 l', '1,85 €', 'https://www.dia.es/product_images/301081/301081_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(541, 'Limpiador de vitrocerámica Super Paco de Dia spray 500 ml', 'Limpiador de vitrocerámica Super Paco de Dia spray 500 ml', '1,75 €', 'https://www.dia.es/product_images/274781/274781_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(542, 'Papel de aluminio Super Paco de Dia caja 30 m', 'Papel de aluminio Super Paco de Dia caja 30 m', '2,25 €', 'https://www.dia.es/product_images/269324/269324_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(543, 'Papel de horno Super Paco de Dia caja 20 unidades', 'Papel de horno Super Paco de Dia caja 20 unidades', '1,13 €', 'https://www.dia.es/product_images/288355/288355_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(544, 'Film transparente Super Paco de Dia caja 80 m', 'Film transparente Super Paco de Dia caja 80 m', '1,60 €', 'https://www.dia.es/product_images/269325/269325_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(545, 'Insecticida moscas y mosquitos perfumado Aniquilax de Dia spray 750 ml', 'Insecticida moscas y mosquitos perfumado Aniquilax de Dia spray 750 ml', '2,25 €', 'https://www.dia.es/product_images/297947/297947_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(546, 'Insecticida cucarachas y hormigas Aniquilax de Dia spray 400 ml', 'Insecticida cucarachas y hormigas Aniquilax de Dia spray 400 ml', '2,70 €', 'https://www.dia.es/product_images/297941/297941_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(547, 'Insecticida moscas y mosquitos sin perfume Aniquilax de Dia spray 750 ml', 'Insecticida moscas y mosquitos sin perfume Aniquilax de Dia spray 750 ml', '2,25 €', 'https://www.dia.es/product_images/297949/297949_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(548, 'Ambientador ropa limpia Super Paco de Dia spray 300 ml', 'Ambientador ropa limpia Super Paco de Dia spray 300 ml', '1,15 €', 'https://www.dia.es/product_images/296705/296705_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(549, 'Sobre perfume white cotton Imaqe de Dia bolsa 2 unidades', 'Sobre perfume white cotton Imaqe de Dia bolsa 2 unidades', '1,99 €', 'https://www.dia.es/product_images/295284/295284_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(550, 'Ambientador automático ropa limpia Super Paco de Dia spray 250 ml', 'Ambientador automático ropa limpia Super Paco de Dia spray 250 ml', '1,80 €', 'https://www.dia.es/product_images/288612/288612_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(551, 'Desodorante desinfectante para calzado Sanytol spray 150 ml', 'Desodorante desinfectante para calzado Sanytol spray 150 ml', '3,89 €', 'https://www.dia.es/product_images/212817/212817_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(552, 'Esponja para calzado brillo inmediato incolora Yak caja 1 unidad', 'Esponja para calzado brillo inmediato incolora Yak caja 1 unidad', '1,75 €', 'https://www.dia.es/product_images/152698/152698_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(553, 'Cerillas Flam\'up caja 3 unidades', 'Cerillas Flam\'up caja 3 unidades', '0,99 €', 'https://www.dia.es/product_images/273674/273674_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(554, 'Pinzas de madera bolsa 24 unidades', 'Pinzas de madera bolsa 24 unidades', '1,49 €', 'https://www.dia.es/product_images/218031/218031_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia'),
(555, 'Mechero recargable Clipper blister 3 unidades', 'Mechero recargable Clipper blister 3 unidades', '2,50 €', 'https://www.dia.es/product_images/304888/304888_ISO_0_ES.jpg?imwidth=176', 'Limpieza y hogar', 'Dia');

-- --------------------------------------------------------

--
-- Table structure for table `semanal`
--

CREATE TABLE `semanal` (
  `ID` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`products`)),
  `day` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('user','admin','employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monthly`
--
ALTER TABLE `monthly`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semanal`
--
ALTER TABLE `semanal`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `monthly`
--
ALTER TABLE `monthly`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=556;

--
-- AUTO_INCREMENT for table `semanal`
--
ALTER TABLE `semanal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `monthly`
--
ALTER TABLE `monthly`
  ADD CONSTRAINT `monthly_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `semanal`
--
ALTER TABLE `semanal`
  ADD CONSTRAINT `semanal_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
