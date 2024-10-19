-- Crear tabla de Competencias
CREATE TABLE competencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    competencia VARCHAR(255) NOT NULL
);

-- Insertar datos en la tabla Competencias
    INSERT INTO competencias (competencia) VALUES
    ('Construye su identidad.'),
    ('Se desenvuelve de manera autónoma a través de su motricidad.'),
    ('Asume una vida saludable.'),
    ('Interactúa a través de sus habilidades socio motrices.'),
    ('Aprecia de manera crítica manifestaciones artístico-culturales.'),
    ('Crea proyectos desde los lenguajes artísticos.'),
    ('Se comunica oralmente en lengua materna.'),
    ('Lee diversos tipos de textos escritos en lengua materna.'),
    ('Escribe diversos tipos de textos en lengua materna.'),
    ('Se comunica oralmente en castellano como segunda lengua.'),
    ('Lee diversos tipos de textos escritos en castellano como segunda lengua.'),
    ('Escribe diversos tipos de textos en castellano como segunda lengua.'),
    ('Se comunica oralmente en inglés como lengua extranjera.'),
    ('Lee diversos tipos de textos escritos en inglés como lengua extranjera.'),
    ('Escribe diversos tipos de textos en inglés como lengua extranjera.'),
    ('Convive y participa democráticamente en la búsqueda del bien común.'),
    ('Construye interpretaciones históricas.'),
    ('Gestiona responsablemente el espacio y el ambiente.'),
    ('Gestiona responsablemente los recursos económicos.'),
    ('Indaga mediante métodos científicos para construir conocimientos.'),
    ('Explica el mundo físico basándose en conocimientos sobre los seres vivos; materia y energía; biodiversidad, Tierra y universo.'),
    ('Diseña y construye soluciones tecnológicas para resolver problemas de su entorno.'),
    ('Resuelve problemas de cantidad.'),
    ('Resuelve problemas de regularidad, equivalencia y cambio.'),
    ('Resuelve problemas de gestión de datos e incertidumbre.'),
    ('Resuelve problemas de forma, movimiento y localización.'),
    ('Gestiona proyectos de emprendimiento económico o social.'),
    ('Se desenvuelve en entornos virtuales generados por las TIC.'),
    ('Gestiona su aprendizaje de manera autónoma.'),
    ('Construye su identidad como persona humana, amada por Dios, digna, libre y trascendente, comprendiendo la doctrina de su propia religión, abierto al diálogo con las que le son cercanas.'),
    ('Asume la experiencia el encuentro personal y comunitario con Dios en su proyecto de vida en coherencia con su creencia religiosa.');



-- Crear tabla de Categoria_Cursos
CREATE TABLE categoria_cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(255) NOT NULL
);

-- Insertar datos en la tabla Categoria_Cursos
    INSERT INTO categoria_cursos (categoria) VALUES
    ('ARTE Y CULTURA'),
    ('CIENCIA Y TECNOLOGIA'),
    ('CIENCIAS SOCIALES'),
    ('COMPUTACION'),
    ('COMUNICACIÓN'),
    ('DESARROLLO PERSONAL, CIUDADANIA Y CIVICA '),
    ('EDUCACION FISICA'),
    ('EDUCACION PARA EL TRABAJO'),
    ('EDUCACION RELIGIOSA'),
    ('INGLES'),
    ('MATEMATICA'),
    ('PERSONAL SOCIAL'),
    ('PSICOMOTRIZ'),
    ('COMUNICACIÓN_INICIAL'),
    ('MATEMATICA_INICIAL'),
    ('PERSONAL_INICIAL'),
    ('CIENCIA_INICIAL'),
    ('INGLES_INICIAL'),
    ('NO APLICA');


===
===================================================<>===================================================
===


-- Crear tabla de Competencias_Categoria_Cursos
CREATE TABLE competencias_categoria_cursos (
    competencias_id INT,
    categoria_id INT,
    PRIMARY KEY (competencias_id, categoria_id),
    FOREIGN KEY (competencias_id) REFERENCES competencias(id),
    FOREIGN KEY (categoria_id) REFERENCES categoria_cursos(id)
);

-- Insertar datos en la tabla Competencias_Categoria_Cursos
    INSERT INTO competencias_categoria_cursos (competencias_id, categoria_id) VALUES
    (1,12),  -- Construye su identidad. <> Personal Social
    (1,6),  -- Construye su identidad. <> Desarrollo Personal, Ciudadania y civica 
    (1,16),  -- Construye su identidad. <> personal_inicial
    (2,7),  -- Se desenvuelve de manera autónoma a través de su motricidad. <> Educacion Fisica
    (3,7),  -- Asume una vida saludable. <> Educacion Fisica
    (4,7),  -- Interactúa a través de sus habilidades socio motrices. <> Educacion Fisica
    (5,1),  -- Aprecia de manera crítica manifestaciones artístico-culturales. <> arte y cultura
    (6,1),  -- Crea proyectos desde los lenguajes artísticos. <> arte y cultura
    (7,5),  -- Se comunica oralmente en lengua materna. <> Comunicación
    (8,5),  -- Lee diversos tipos de textos escritos en lengua materna. <> Comunicación
    (9,5),  -- Escribe diversos tipos de textos en lengua materna. <> Comunicación
    (13,10),  -- Se comunica oralmente en inglés como lengua extranjera. <> ingles
    (14,10),  -- Lee diversos tipos de textos escritos en inglés como lengua extranjera. <> ingles
    (15,10),  -- Escribe diversos tipos de textos en inglés como lengua extranjera. <> ingles
    (16,12),  -- Convive y participa democráticamente en la búsqueda del bien común. <> Personal Social
    (16,6),  -- Convive y participa democráticamente en la búsqueda del bien común. <> Desarrollo Personal, Ciudadania y civica 
    (16,16),  -- Convive y participa democráticamente en la búsqueda del bien común. <> personal_inicial
    (17,12),  -- Construye interpretaciones históricas. <> Personal Social
    (17,3),  -- Construye interpretaciones históricas. <> ciencias sociales
    (18,12),  -- Gestiona responsablemente el espacio y el ambiente. <> Personal Social
    (18,3),  -- Gestiona responsablemente el espacio y el ambiente. <> ciencias sociales
    (19,12),  -- Gestiona responsablemente los recursos económicos. <> Personal Social
    (19,3),  -- Gestiona responsablemente los recursos económicos. <> ciencias sociales
    (20,17),  -- Indaga mediante métodos científicos para construir conocimientos. <> ciencia_inicial
    (20,2),  -- Indaga mediante métodos científicos para construir conocimientos. <> Ciencia y Tecnologia
    (21,2),  -- Explica el mundo físico basándose en conocimientos sobre los seres vivos; materia y energía; biodiversidad, Tierra y universo. <> Ciencia y Tecnologia
    (22,2),  -- Diseña y construye soluciones tecnológicas para resolver problemas de su entorno. <> Ciencia y Tecnologia
    (23,11),  -- Resuelve problemas de cantidad. <> Matematica
    (24,11),  -- Resuelve problemas de regularidad, equivalencia y cambio. <> Matematica
    (25,11),  -- Resuelve problemas de gestión de datos e incertidumbre. <> Matematica
    (26,11),  -- Resuelve problemas de forma, movimiento y localización. <> Matematica
    (27,8),  -- Gestiona proyectos de emprendimiento económico o social. <> Educacion para el trabajo
    (28,4),  -- Se desenvuelve en entornos virtuales generados por las TIC. <> computacion
    (29,4),  -- Gestiona su aprendizaje de manera autónoma. <> computacion
    (30,16),  -- Construye su identidad como persona humana, amada por Dios, digna, libre y trascendente, comprendiendo la doctrina de su propia religión, abierto al diálogo con las que le son cercanas. <> personal_inicial
    (30,9),  -- Construye su identidad como persona humana, amada por Dios, digna, libre y trascendente, comprendiendo la doctrina de su propia religión, abierto al diálogo con las que le son cercanas. <> Educacion Religiosa
    (31,9),  -- Asume la experiencia el encuentro personal y comunitario con Dios en su proyecto de vida en coherencia con su creencia religiosa. <> Educacion Religiosa
    (2,13),  -- Se desenvuelve de manera autónoma a través de su motricidad. <> psicomotriz
    (7,14),  -- Se comunica oralmente en lengua materna. <> Comunicación_inicial
    (8,14),  -- Lee diversos tipos de textos escritos en lengua materna. <> Comunicación_inicial
    (6,14),  -- Crea proyectos desde los lenguajes artísticos. <> Comunicación_inicial
    (23,15),  -- Resuelve problemas de cantidad. <> matematica_inicial
    (26,15),  -- Resuelve problemas de forma, movimiento y localización. <> matematica_inicial
    (13,18),  -- Se comunica oralmente en inglés como lengua extranjera. <> ingles_inicial
    (14,18);  -- Lee diversos tipos de textos escritos en inglés como lengua extranjera. <> ingles_inicial


===
===================================================<>===================================================
===

-- Crear tabla de Capacidades
CREATE TABLE capacidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    capacidad VARCHAR(255) NOT NULL,
    competencias_id INT,
    FOREIGN KEY (competencias_id) REFERENCES competencias(id)
);

-- Insertar datos en la tabla Capacidades
    INSERT INTO capacidades (capacidad, competencias_id) VALUES
    ('Autorregula sus emociones.',1),
    ('Conoce, comprende y valora su sexualidad de manera integral de acuerdo a su desarrollo evolutivo.',1),
    ('Reflexiona y argumenta éticamente.',1),
    ('Comprende su cuerpo.',2),
    ('Se expresa corporalmente.',2),
    ('Comprende las relaciones entre la actividad física, alimentación, postura e higiene y la salud.',3),
    ('Incorpora prácticas que mejoran su calidad de vida.',3),
    ('Crea y aplica estrategias y tácticas de juego.',4),
    ('Se relaciona utilizando sus habilidades socio motrices.',4),
    ('Contextualiza las manifestaciones artístico-culturales.',5),
    ('Percibe manifestaciones artístico-culturales.',5),
    ('Reflexiona creativa y críticamente sobre las manifestaciones artístico- culturales.',5),
    ('Aplica procesos de creación.',6),
    ('Evalúa y comunica sus procesos y proyectos.',6),
    ('Explora y experimenta los lenguajes de las artes.',6),
    ('Adecua, organiza y desarrolla las ideas de forma coherente y cohesionada.',7),
    ('Infiere e interpreta información de textos orales.',7),
    ('Interactúa estratégicamente con distintos interlocutores.',7),
    ('Obtiene información de textos orales.',7),
    ('Reflexiona y evalúa la forma, el contenido y el contexto del texto oral.',7),
    ('Utiliza recursos no verbales y paraverbales de forma estratégica.',7),
    ('Infiere e interpreta información del texto.',8),
    ('Obtiene información del texto escrito.',8),
    ('Reflexiona y evalúa la forma, el contenido y el contexto del texto escrito.',8),
    ('Adecúa el texto a la situación comunicativa.',9),
    ('Organiza y desarrolla las ideas de forma coherente y cohesionada.',9),
    ('Reflexiona y evalúa la forma, el contenido y el contexto del texto escrito.',9),
    ('Utiliza convenciones del lenguaje escrito de forma pertinente.',9),
    ('Adecua, organiza y desarrolla las ideas de forma coherente y cohesionada.',10),
    ('Infiere e interpreta información de textos orales.',10),
    ('Interactúa estratégicamente con distintos interlocutores.',10),
    ('Obtiene información de textos orales.',10),
    ('Utiliza recursos no verbales y paraverbales de forma estratégica.',10),
    ('Infiere e interpreta información del texto.',11),
    ('Obtiene información del texto escrito.',11),
    ('Reflexiona y evalúa la forma, el contenido y el contexto del texto escrito.',11),
    ('Adecúa el texto a la situación comunicativa.',12),
    ('Organiza y desarrolla las ideas de forma coherente y cohesionada.',12),
    ('Reflexiona y evalúa la forma, el contenido y el contexto del texto escrito.',12),
    ('Utiliza convenciones del lenguaje escrito de forma pertinente.',12),
    ('Adecua, organiza y desarrolla las ideas de forma coherente y cohesionada.',13),
    ('Infiere e interpreta información de textos orales.',13),
    ('Interactúa estratégicamente con distintos interlocutores.',13),
    ('Obtiene información de textos orales.',13),
    ('Reflexiona y evalúa la forma, el contenido y el contexto del texto oral.',13),
    ('Utiliza recursos no verbales y paraverbales de forma estratégica.',13),
    ('Infiere e interpreta información del texto.',14),
    ('Obtiene información del texto escrito.',14),
    ('Reflexiona y evalúa la forma, el contenido y el contexto del texto escrito.',14),
    ('Adecúa el texto a la situación comunicativa.',15),
    ('Organiza y desarrolla las ideas de forma coherente y cohesionada.',15),
    ('Reflexiona y evalúa la forma, el contenido y el contexto del texto escrito.',15),
    ('Utiliza convenciones del lenguaje escrito de forma pertinente.',15),
    ('Construye y asume acuerdos y normas.',16),
    ('Delibera sobre asuntos públicos.',16),
    ('Interactúa con todas las personas.',16),
    ('Maneja conflictos de manera constructiva.',16),
    ('Participa en acciones que promueven el bienestar común.',16),
    ('Comprende el tiempo histórico.',17),
    ('Explica y argumenta procesos históricos.',17),
    ('Interpreta críticamente fuentes diversas.',17),
    ('Comprende las relaciones entre los elementos naturales y sociales.',18),
    ('Genera acciones para preservar el ambiente local y global.',18),
    ('Maneja fuentes de información para comprender el espacio geográfico y el ambiente.',18),
    ('Comprende las relaciones entre los elementos del sistema económico y financiero.',19),
    ('Toma decisiones económicas y financieras.',19),
    ('Analiza datos e información.',20),
    ('Diseña estrategias para hacer indagación.',20),
    ('Evalúa y comunica el proceso y los resultados de su indagación.',20),
    ('Genera y registra datos e información.',20),
    ('Problematiza situaciones.',20),
    ('Comprende y usa conocimientos sobre los seres vivos; materia y energía; biodiversidad, Tierra y universo.',21),
    ('Evalúa las implicancias del saber y del quehacer científico y tecnológico.',21),
    ('Determina una alternativa de solución tecnológica.',22),
    ('Diseña la alternativa de solución tecnológica.',22),
    ('Evalúa y comunica el funcionamiento y los impactos de su alternativa de solución tecnológica',22),
    ('Implementa y valida alternativas de solución tecnológica.',22),
    ('Argumenta afirmaciones sobre las relaciones numéricas y las operaciones.',23),
    ('Comunica su comprensión sobre los números y las operaciones.',23),
    ('Traduce cantidades a expresiones numéricas.',23),
    ('Usa estrategias y procedimientos de estimación y cálculo.',23),
    ('Argumenta afirmaciones sobre relaciones de cambio y equivalencia.',24),
    ('Comunica su comprensión sobre las relaciones algebraicas.',24),
    ('Traduce datos y condiciones a expresiones algebraicas.',24),
    ('Usa estrategias y procedimientos para encontrar reglas generales.',24),
    ('Comunica la comprensión de los conceptos estadísticos y probabilísticos.',25),
    ('Representa datos con gráficos y medidas estadísticas o probabilísticas.',25),
    ('Sustenta conclusiones o decisiones basado en información obtenida.',25),
    ('Usa estrategias y procedimientos para recopilar y procesar datos.',25),
    ('Argumenta afirmaciones sobre relaciones geométricas',26),
    ('Comunica su comprensión sobre las formas y relaciones geométricas',26),
    ('Modela objetos con formas geométricas y sus transformaciones',26),
    ('Usa estrategias y procedimientos para orientarse en el espacio',26),
    ('Aplica habilidades técnicas.',27),
    ('Crea propuestas de valor.',27),
    ('Evalúa los resultados del proyecto de emprendimiento.',27),
    ('Trabaja cooperativamente para lograr objetivos y metas.',27),
    ('Crea objetos virtuales en diversos formatos.',28),
    ('Gestiona información del entorno virtual.',28),
    ('Interactúa en entornos virtuales.',28),
    ('Personaliza entornos virtuales.',28),
    ('Define metas de aprendizaje.',29),
    ('Monitorea y ajusta su desempeño durante el proceso de aprendizaje.',29),
    ('Organiza acciones estratégicas para alcanzar sus metas de aprendizaje.',29),
    ('Conoce a Dios y asume su identidad religiosa como persona digna, libre y trascendente.',30),
    ('Cultiva y valora las manifestaciones religiosas de su entorno argumentando su fe de manera comprensible y respetuosa.',30),
    ('Actúa coherentemente en razón de su fe según los principios de su conciencia moral en situaciones concretas de la vida.',31),
    ('Transforma su entorno desde el encuentro personal y comunitario con Dios y desde la fe que profesa.',31);


===
===================================================<>===================================================
===


-- Crear tabla de Cursos
CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    moodle_course INT NOT NULL,
    nombre_curso VARCHAR(255) NOT NULL,
    docente_id INT NOT NULL,
    nivel_id INT NOT NULL,
    grado VARCHAR(50),
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categoria_cursos(id)
);

-- Insertar datos en la tabla Cursos
    INSERT INTO cursos (moodle_course, nombre_curso, docente_id, nivel_id, grado, categoria_id) VALUES
    (1,'SAN SEBASTIAN',320,5,0,19),
    (1,'SAN SEBASTIAN',317,5,0,19),
    (102,'CAPACITACION DOCENTE',2,5,0,19),
    (144,'ARTE Y CULTURA 3A INICIAL',317,1,3,1),
    (144,'ARTE Y CULTURA 3A INICIAL',328,1,3,1),
    (145,'ARTE Y CULTURA 4A INICIAL',318,1,4,1),
    (145,'ARTE Y CULTURA 4A INICIAL',328,1,4,1),
    (146,'ARTE Y CULTURA 5A INICIAL',319,1,5,1),
    (146,'ARTE Y CULTURA 5A INICIAL',328,1,5,1),
    (147,'CIENCIA Y TECNOLOGIA 3A INICIAL',317,1,3,17),
    (148,'CIENCIA Y TECNOLOGIA 4A INICIAL',318,1,4,17),
    (149,'CIENCIA Y TECNOLOGIA 5A INICIAL',319,1,5,17),
    (150,'COMUNICACION 3A INICIAL',317,1,3,14),
    (151,'COMUNICACION 4A INICIAL',318,1,4,14),
    (152,'COMUNICACION 5A INICIAL',319,1,5,14),
    (153,'EDUCACION RELIGIOSA 3A INICIAL',317,1,3,9),
    (154,'EDUCACION RELIGIOSA 4A INICIAL',318,1,4,9),
    (155,'EDUCACION RELIGIOSA 5A INICIAL',319,1,5,9),
    (156,'INGLES 3A INICIAL',337,1,3,18),
    (157,'INGLES 4A INICIAL',337,1,4,18),
    (158,'INGLES 5A INICIAL',337,1,5,18),
    (159,'MATEMATICA 3A INICIAL',317,1,3,15),
    (160,'MATEMATICA 4A INICIAL',318,1,4,15),
    (161,'MATEMATICA 5A INICIAL',319,1,5,15),
    (162,'PERSONAL SOCIAL 3A INICIAL',317,1,3,16),
    (163,'PERSONAL SOCIAL 4A INICIAL',318,1,4,16),
    (164,'PERSONAL SOCIAL 5A INICIAL',319,1,5,16),
    (165,'PSICOLOGIA 3A INICIAL',338,1,3,19),
    (166,'PSICOLOGIA 4A INICIAL',338,1,4,19),
    (167,'PSICOLOGIA 5A INICIAL',338,1,5,19),
    (168,'PSICOMOTRICIDAD 3A INICIAL',317,1,3,13),
    (169,'PSICOMOTRICIDAD 4A INICIAL',318,1,4,13),
    (170,'PSICOMOTRICIDAD 5A INICIAL',319,1,5,13),
    (171,'REUNION DE PADRES DE FAMILIA 3A INICIAL',317,1,3,19),
    (172,'REUNION DE PADRES DE FAMILIA 4A INICIAL',318,1,4,19),
    (173,'REUNION DE PADRES DE FAMILIA 5A INICIAL',319,1,5,19),
    (174,'TICS 3A INICIAL',331,1,3,4),
    (175,'TICS 4A INICIAL',331,1,4,4),
    (176,'TICS 5A INICIAL',331,1,5,4),
    (177,'TUTORIA 3A INICIAL',317,1,3,19),
    (178,'TUTORIA 4A INICIAL',318,1,4,19),
    (179,'TUTORIA 5A INICIAL',319,1,5,19),
    (180,'JUDO 3A INICIAL',335,1,3,13),
    (181,'JUDO 4A INICIAL',335,1,4,13),
    (182,'JUDO 5A INICIAL',335,1,5,13),
    (183,'ARTE Y CULTURA 1RO PRIMARIA',328,2,1,1),
    (184,'ARTE Y CULTURA 2DO PRIMARIA',328,2,2,1),
    (184,'ARTE Y CULTURA 2DO PRIMARIA',582,2,2,1),
    (185,'ARTE Y CULTURA 3RO PRIMARIA',328,2,3,1),
    (186,'ARTE Y CULTURA 4TO PRIMARIA',328,2,4,1),
    (187,'ARTE Y CULTURA 5TO PRIMARIA',328,2,5,1),
    (188,'ARTE Y CULTURA 6TO PRIMARIA',328,2,6,1),
    (189,'CIENCIA Y TECNOLOGIA 1RO PRIMARIA',320,2,1,2),
    (190,'CIENCIA Y TECNOLOGIA 2DO PRIMARIA',321,2,2,2),
    (190,'CIENCIA Y TECNOLOGIA 2DO PRIMARIA',582,2,2,2),
    (191,'CIENCIA Y TECNOLOGIA 3RO PRIMARIA',322,2,3,2),
    (191,'CIENCIA Y TECNOLOGIA 3RO PRIMARIA',326,2,3,2),
    (192,'CIENCIA Y TECNOLOGIA 4TO PRIMARIA',323,2,4,2),
    (193,'CIENCIA Y TECNOLOGIA 5TO PRIMARIA',325,2,5,2),
    (194,'CIENCIA Y TECNOLOGIA 6TO PRIMARIA',334,2,6,2),
    (194,'CIENCIA Y TECNOLOGIA 6TO PRIMARIA',325,2,6,2),
    (195,'COMUNICACION 1RO PRIMARIA',320,2,1,5),
    (196,'COMUNICACION 2DO PRIMARIA',321,2,2,5),
    (196,'COMUNICACION 2DO PRIMARIA',582,2,2,5),
    (197,'COMUNICACION 3RO PRIMARIA',322,2,3,5),
    (197,'COMUNICACION 3RO PRIMARIA',326,2,3,5),
    (198,'COMUNICACION 4TO PRIMARIA',323,2,4,5),
    (199,'COMUNICACION 5TO PRIMARIA',324,2,5,5),
    (200,'COMUNICACION 6TO PRIMARIA',324,2,6,5),
    (201,'EDUCACION FISICA 1RO PRIMARIA',336,2,1,7),
    (202,'EDUCACION FISICA 2DO PRIMARIA',336,2,2,7),
    (202,'EDUCACION FISICA 2DO PRIMARIA',582,2,2,7),
    (203,'EDUCACION FISICA 3RO PRIMARIA',336,2,3,7),
    (204,'EDUCACION FISICA 4TO PRIMARIA',336,2,4,7),
    (205,'EDUCACION FISICA 5TO PRIMARIA',336,2,5,7),
    (206,'EDUCACION FISICA 6TO PRIMARIA',336,2,6,7),
    (207,'EDUCACION RELIGIOSA 1RO PRIMARIA',320,2,1,9),
    (208,'EDUCACION RELIGIOSA 2DO PRIMARIA',321,2,2,9),
    (208,'EDUCACION RELIGIOSA 2DO PRIMARIA',582,2,2,9),
    (209,'EDUCACION RELIGIOSA 3RO PRIMARIA',322,2,3,9),
    (209,'EDUCACION RELIGIOSA 3RO PRIMARIA',326,2,3,9),
    (210,'EDUCACION RELIGIOSA 4TO PRIMARIA',323,2,4,9),
    (211,'EDUCACION RELIGIOSA 5TO PRIMARIA',325,2,5,9),
    (212,'EDUCACION RELIGIOSA 6TO PRIMARIA',324,2,6,9),
    (213,'INGLES 1RO PRIMARIA',329,2,1,10),
    (214,'INGLES 2DO PRIMARIA',329,2,2,10),
    (214,'INGLES 2DO PRIMARIA',582,2,2,10),
    (215,'INGLES 3RO PRIMARIA',329,2,3,10),
    (216,'INGLES 4TO PRIMARIA',329,2,4,10),
    (217,'INGLES 5TO PRIMARIA',329,2,5,10),
    (218,'INGLES 6TO PRIMARIA',329,2,6,10),
    (219,'MATEMATICA 1RO PRIMARIA',320,2,1,11),
    (220,'MATEMATICA 2DO PRIMARIA',321,2,2,11),
    (220,'MATEMATICA 2DO PRIMARIA',582,2,2,11),
    (221,'MATEMATICA 3RO PRIMARIA',322,2,3,11),
    (221,'MATEMATICA 3RO PRIMARIA',326,2,3,11),
    (222,'MATEMATICA 4TO PRIMARIA',323,2,4,11),
    (223,'MATEMATICA 5TO PRIMARIA',325,2,5,11),
    (224,'MATEMATICA 6TO PRIMARIA',325,2,6,11),
    (225,'PERSONAL SOCIAL 1RO PRIMARIA',320,2,1,12),
    (226,'PERSONAL SOCIAL 2DO PRIMARIA',321,2,2,12),
    (226,'PERSONAL SOCIAL 2DO PRIMARIA',582,2,2,12),
    (227,'PERSONAL SOCIAL 3RO PRIMARIA',322,2,3,12),
    (227,'PERSONAL SOCIAL 3RO PRIMARIA',326,2,3,12),
    (228,'PERSONAL SOCIAL 4TO PRIMARIA',323,2,4,12),
    (229,'PERSONAL SOCIAL 5TO PRIMARIA',324,2,5,12),
    (230,'PERSONAL SOCIAL 6TO PRIMARIA',324,2,6,12),
    (231,'PSICOLOGIA 1RO PRIMARIA',338,2,1,19),
    (232,'PSICOLOGIA 2DO PRIMARIA',338,2,2,19),
    (232,'PSICOLOGIA 2DO PRIMARIA',582,2,2,19),
    (233,'PSICOLOGIA 3RO PRIMARIA',338,2,3,19),
    (234,'PSICOLOGIA 4TO PRIMARIA',338,2,4,19),
    (235,'PSICOLOGIA 5TO PRIMARIA',338,2,5,19),
    (236,'PSICOLOGIA 6TO PRIMARIA',338,2,6,19),
    (237,'REUNION DE PADRES DE FAMILIA 1ERO PRIMARIA',320,2,1,19),
    (238,'REUNION DE PADRES DE FAMILIA 2DO PRIMARIA',582,2,2,19),
    (238,'REUNION DE PADRES DE FAMILIA 2DO PRIMARIA',321,2,2,19),
    (239,'REUNION DE PADRES DE FAMILIA 3RO PRIMARIA',322,2,3,19),
    (239,'REUNION DE PADRES DE FAMILIA 3RO PRIMARIA',326,2,3,19),
    (240,'REUNION DE PADRES DE FAMILIA 4TO PRIMARIA',323,2,4,19),
    (241,'REUNION DE PADRES DE FAMILIA 5TO PRIMARIA',325,2,5,19),
    (242,'REUNION DE PADRES DE FAMILIA 6TO PRIMARIA',324,2,6,19),
    (243,'TICS 1RO PRIMARIA',331,2,1,4),
    (244,'TICS 2DO PRIMARIA',331,2,2,4),
    (244,'TICS 2DO PRIMARIA',582,2,2,4),
    (245,'TICS 3RO PRIMARIA',331,2,3,4),
    (246,'TICS 4TO PRIMARIA',331,2,4,4),
    (247,'TICS 5TO PRIMARIA',331,2,5,4),
    (248,'TICS 6TO PRIMARIA',331,2,6,4),
    (249,'TUTORIA 1RO PRIMARIA',320,2,1,19),
    (250,'TUTORIA 2DO PRIMARIA',321,2,2,19),
    (251,'TUTORIA 3RO PRIMARIA',322,2,3,19),
    (252,'TUTORIA 4TO PRIMARIA',323,2,4,19),
    (253,'TUTORIA 5TO PRIMARIA',325,2,5,19),
    (254,'TUTORIA 6TO PRIMARIA',324,2,6,19),
    (255,'JUDO 1RO PRIMARIA',335,2,1,7),
    (256,'JUDO 2DO PRIMARIA',335,2,2,7),
    (256,'JUDO 2DO PRIMARIA',582,2,2,7),
    (257,'JUDO 3RO PRIMARIA',335,2,3,7),
    (258,'JUDO 4TO PRIMARIA',335,2,4,7),
    (259,'JUDO 5TO PRIMARIA',335,2,5,7),
    (260,'JUDO 6TO PRIMARIA',335,2,6,7),
    (286,'ARTE Y CULTURA 1RO SECUNDARIA',328,3,1,1),
    (287,'ARTE Y CULTURA 2DO SECUNDARIA',328,3,2,1),
    (288,'ARTE Y CULTURA 3RO SECUNDARIA',328,3,3,1),
    (289,'ARTE Y CULTURA 4TO SECUNDARIA',328,3,4,1),
    (290,'ARTE Y CULTURA 5TO SECUNDARIA',328,3,5,1),
    (296,'FISICA 1RO SECUNDARIA',614,3,1,2),
    (297,'FISICA 2DO SECUNDARIA',614,3,2,2),
    (298,'FISICA 3RO SECUNDARIA',332,3,3,2),
    (298,'FISICA 3RO SECUNDARIA',614,3,3,2),
    (299,'FISICA 4TO SECUNDARIA',614,3,4,2),
    (300,'FISICA 5TO SECUNDARIA',614,3,5,2),
    (301,'BIOLOGIA 1RO SECUNDARIA',609,3,1,2),
    (302,'BIOLOGIA 2DO SECUNDARIA',609,3,2,2),
    (303,'BIOLOGIA 3RO SECUNDARIA',609,3,3,2),
    (304,'BIOLOGIA 4TO SECUNDARIA',609,3,4,2),
    (305,'BIOLOGIA 5TO SECUNDARIA',609,3,5,2),
    (306,'QUIMICA 1RO SECUNDARIA',334,3,1,2),
    (307,'QUIMICA 2DO SECUNDARIA',334,3,2,2),
    (308,'QUIMICA 3RO SECUNDARIA',334,3,3,2),
    (309,'QUIMICA 4TO SECUNDARIA',334,3,4,2),
    (310,'QUIMICA 5TO SECUNDARIA',334,3,5,2),
    (311,'COMUNICACION 1RO SECUNDARIA',327,3,1,5),
    (312,'COMUNICACION 2DO SECUNDARIA',327,3,2,5),
    (313,'COMUNICACION 3RO SECUNDARIA',327,3,3,5),
    (314,'COMUNICACION 4TO SECUNDARIA',327,3,4,5),
    (315,'COMUNICACION 5TO SECUNDARIA',327,3,5,5),
    (316,'EDUCACION FISICA 1RO SECUNDARIA',336,3,1,7),
    (317,'EDUCACION FISICA 2DO SECUNDARIA',336,3,2,7),
    (318,'EDUCACION FISICA 3RO SECUNDARIA',336,3,3,7),
    (319,'EDUCACION FISICA 4TO SECUNDARIA',336,3,4,7),
    (320,'EDUCACION FISICA 5TO SECUNDARIA',336,3,5,7),
    (321,'EDUCACION RELIGIOSA 1RO SECUNDARIA',327,3,1,9),
    (322,'EDUCACION RELIGIOSA 2DO SECUNDARIA',327,3,2,9),
    (323,'EDUCACION RELIGIOSA 3RO SECUNDARIA',327,3,3,9),
    (324,'EDUCACION RELIGIOSA 4TO SECUNDARIA',327,3,4,9),
    (325,'EDUCACION RELIGIOSA 5TO SECUNDARIA',327,3,5,9),
    (326,'INGLES 1RO SECUNDARIA',329,3,1,10),
    (327,'INGLES 2DO SECUNDARIA',329,3,2,10),
    (328,'INGLES 3RO SECUNDARIA',329,3,3,10),
    (329,'INGLES 4TO SECUNDARIA',329,3,4,10),
    (330,'INGLES 5TO SECUNDARIA',329,3,5,10),
    (331,'TRIGONOMETRIA 1RO SECUNDARIA',332,3,1,11),
    (332,'TRIGONOMETRIA 2DO SECUNDARIA',332,3,2,11),
    (333,'TRIGONOMETRIA 3RO SECUNDARIA',332,3,3,11),
    (334,'TRIGONOMETRIA 4TO SECUNDARIA',332,3,4,11),
    (335,'TRIGONOMETRIA 5TO SECUNDARIA',332,3,5,11),
    (336,'RAZ. MATEMATICO 1RO SECUNDARIA',333,3,1,11),
    (337,'RAZ. MATEMATICO 2DO SECUNDARIA',333,3,2,11),
    (338,'RAZ. MATEMATICO 3RO SECUNDARIA',333,3,3,11),
    (339,'RAZ. MATEMATICO 4TO SECUNDARIA',333,3,4,11),
    (340,'RAZ. MATEMATICO 5TO SECUNDARIA',333,3,5,11),
    (341,'ARITMETICA 1RO SECUNDARIA',333,3,1,11),
    (342,'ARITMETICA 2DO SECUNDARIA',333,3,2,11),
    (343,'ARITMETICA 3RO SECUNDARIA',333,3,3,11),
    (344,'ARITMETICA 4TO SECUNDARIA',333,3,4,11),
    (345,'ARITMETICA 5TO SECUNDARIA',333,3,5,11),
    (346,'ALGEBRA 1RO SECUNDARIA',332,3,1,11),
    (347,'ALGEBRA 2DO SECUNDARIA',332,3,2,11),
    (348,'ALGEBRA 3RO SECUNDARIA',332,3,3,11),
    (349,'ALGEBRA 4TO SECUNDARIA',332,3,4,11),
    (350,'ALGEBRA 5TO SECUNDARIA',332,3,5,11),
    (351,'GEOMETRIA 1RO SECUNDARIA',332,3,1,11),
    (352,'GEOMETRIA 2DO SECUNDARIA',332,3,2,11),
    (353,'GEOMETRIA 3RO SECUNDARIA',332,3,3,11),
    (354,'GEOMETRIA 4TO SECUNDARIA',332,3,4,11),
    (355,'GEOMETRIA 5TO SECUNDARIA',332,3,5,11),
    (356,'CIENCIAS SOCIALES 1RO SECUNDARIA',330,3,1,2),
    (357,'CIENCIAS SOCIALES 2DO SECUNDARIA',330,3,2,2),
    (358,'CIENCIAS SOCIALES 3RO SECUNDARIA',330,3,3,2),
    (359,'CIENCIAS SOCIALES 4TO SECUNDARIA',330,3,4,2),
    (360,'CIENCIAS SOCIALES 5TO SECUNDARIA',330,3,5,2),
    (361,'DESARROLLO PERSONAL Y CIUDADANIA 1RO SECUNDARIA',330,3,1,6),
    (362,'DESARROLLO PERSONAL Y CIUDADANIA 2DO SECUNDARIA',330,3,2,6),
    (363,'DESARROLLO PERSONAL Y CIUDADANIA 3RO SECUNDARIA',330,3,3,6),
    (364,'DESARROLLO PERSONAL Y CIUDADANIA 4TO SECUNDARIA',330,3,4,6),
    (365,'DESARROLLO PERSONAL Y CIUDADANIA 5TO SECUNDARIA',330,3,5,6),
    (366,'PSICOLOGIA 1RO SECUNDARIA',338,3,1,19),
    (367,'PSICOLOGIA 2DO SECUNDARIA',338,3,2,19),
    (368,'PSICOLOGIA 3RO SECUNDARIA',338,3,3,19),
    (369,'PSICOLOGIA 4TO SECUNDARIA',338,3,4,19),
    (370,'PSICOLOGIA 5TO SECUNDARIA',338,3,5,19),
    (371,'REUNION DE PADRES DE FAMILIA 1RO SECUNDARIA',327,3,1,19),
    (372,'REUNION DE PADRES DE FAMILIA 2DO SECUNDARIA',328,3,2,19),
    (373,'REUNION DE PADRES DE FAMILIA 3RO SECUNDARIA',329,3,3,19),
    (374,'REUNION DE PADRES DE FAMILIA 4TO SECUNDARIA',330,3,4,19),
    (375,'REUNION DE PADRES DE FAMILIA 5TO SECUNDARIA',336,3,5,19),
    (376,'EDUCACION PARA EL TRABAJO 1RO SECUNDARIA',331,3,1,8),
    (377,'EDUCACION PARA EL TRABAJO 2DO SECUNDARIA',331,3,2,8),
    (378,'EDUCACION PARA EL TRABAJO 3RO SECUNDARIA',331,3,3,8),
    (379,'EDUCACION PARA EL TRABAJO 4TO SECUNDARIA',331,3,4,8),
    (380,'EDUCACION PARA EL TRABAJO 5TO SECUNDARIA',331,3,5,8),
    (381,'TUTORIA 1RO SECUNDARIA',327,3,1,19),
    (382,'TUTORIA 2DO SECUNDARIA',328,3,2,19),
    (383,'TUTORIA 3RO SECUNDARIA',329,3,3,19),
    (384,'TUTORIA 4TO SECUNDARIA',330,3,4,19),
    (385,'TUTORIA 5TO SECUNDARIA',336,3,5,19),
    (386,'JUDO 1RO SECUNDARIA',335,3,1,7),
    (387,'JUDO 2DO SECUNDARIA',335,3,2,7),
    (388,'JUDO 3RO SECUNDARIA',335,3,3,7),
    (389,'JUDO 4TO SECUNDARIA',335,3,4,7),
    (390,'JUDO 5TO SECUNDARIA',335,3,5,7),
    (391,'QUIMICA 6TO PRIMARIA',334,2,6,2),
    (392,'QUIMICA 5TO PRIMARIA',334,2,5,2);



===
===================================================<>===================================================
===


-- Crear tabla de Nivel
CREATE TABLE nivel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nivel VARCHAR(50) NOT NULL
);
-- Insertar datos en la tabla Nivel
    INSERT INTO nivel (nivel) VALUES
    ('INICIAL'),
    ('PRIMARIA'),
    ('SECUNDARIA'),
    ('TALLER'),
    ('ADMINISTRATIVO');


===
===================================================<>===================================================
===

-- Crear tabla de Notas
CREATE TABLE notas_bimestre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nivel_id INT NOT NULL,
    moodle_course INT NOT NULL,
    competencia_id INT DEFAULT NULL,
    capacidad_id INT DEFAULT NULL,
    desempeno_id INT DEFAULT NULL,
    bimestre INT NOT NULL,
    course_id INT NOT NULL,
    sesion INT NOT NULL,
    nota VARCHAR(5),
    comentario TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha y hora de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha y hora de última actualización
    FOREIGN KEY (nivel_id) REFERENCES nivel(id)
);

-- Insertar datos en la tabla Notas
    INSERT INTO notas_bimestre (user_id, nivel_id, moodle_course, competencia_id, bimestre, nota, comentario) VALUES
    (1, 3, 101, 1, 1, 85.50, 'Excelente participación'),
    (2, 2, 102, 2, 1, 78.00, 'Mejorar la colaboración'),
    (3, 1, 103, 3, 1, 90.00, 'Muy buen desempeño en las presentaciones');

    

-- Crear tabla de Notas
CREATE TABLE notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    moodle_course INT NOT NULL,
    competencia_id_1 INT NOT NULL,
    competencia_id_2 INT,
    competencia_id_3 INT,
    capacidad_id_1 INT NOT NULL,
    capacidad_id_2 INT,
    capacidad_id_3 INT,
    desempeno_id_1 VARCHAR(255) NOT NULL,
    desempeno_id_2 VARCHAR(255),
    desempeno_id_3 VARCHAR(255),
    alumno_id INT NOT NULL,
    docente_id INT NOT NULL,
    bimestre INT NOT NULL,
    sesion INT NOT NULL,
    nota VARCHAR(5),
    comentario VARCHAR(350),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha y hora de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha y hora de última actualización
);


===
===================================================<>===================================================
===


-- Crear tabla de Documentacion
CREATE TABLE documentacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bimestre INT NOT NULL,
    course_id INT NOT NULL, 
    user_id INT NOT NULL,
    sesion INT NOT NULL,
    nsesion INT NOT NULL,
    fecha_inicio_sesion DATETIME DEFAULT NULL,
    fecha_final_sesion DATETIME DEFAULT NULL,
    competencias_id_1 INT NOT NULL,
    competencias_id_2 INT,
    competencias_id_3 INT,
    capacidad_id_1 INT NOT NULL,
    capacidad_id_2 INT,
    capacidad_id_3 INT,
    desempeno_1 VARCHAR(500) DEFAULT NULL,
    desempeno_2 VARCHAR(500) DEFAULT NULL,
    desempeno_3 VARCHAR(500) DEFAULT NULL,
    enfoque_id INT NOT NULL,
    valor_id INT NOT NULL,
    accion_id INT NOT NULL,
    evidencia VARCHAR(500) DEFAULT NULL, 
    actitudes VARCHAR(500) DEFAULT NULL,
    proposito VARCHAR(500) DEFAULT NULL,
    creado_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha y hora de creación
    actualizado_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha y hora de última actualización
    FOREIGN KEY (enfoque_id) REFERENCES enfoque(id),
    FOREIGN KEY (valor_id) REFERENCES valores(id),
    FOREIGN KEY (accion_id) REFERENCES actitudes_acciones(id)
);

-- INSERT DE SESION DE CLASE "DOCUMENTACION"

    INSERT INTO documentacion (bimestre, course_id, user_id, sesion, nsesion, fecha_inicio_sesion, fecha_final_sesion, competencias_id_1, competencias_id_2, competencias_id_3, capacidad_id_1, capacidad_id_2, capacidad_id_3, desempeno_1, desempeno_2, desempeno_3, enfoque_id, valor_id, accion_id, evidencia, actitudes, proposito) VALUES
    (3, 196, 2, 1, 3, "2024-08-30", "2024-08-31", 7, 8, 9, 16, 23, 26, "Desempeño 1", "Desempeño 2", "Desempeño 3", 1, 2, 4, "evidencia_1", "actitudes_1", "propostio_1");





-- Insertar datos en la tabla Notas
    INSERT INTO notas (user_id, nivel_id, moodle_course, competencia_id, bimestre, nota, comentario) VALUES
    (1, 3, 101, 1, 1, 85.50, 'Excelente participación'),
    (2, 2, 102, 2, 1, 78.00, 'Mejorar la colaboración'),
    (3, 1, 103, 3, 1, 90.00, 'Muy buen desempeño en las presentaciones');

===
===================================================<>===================================================
===

-- Crear tabla de Enfoque
CREATE TABLE  enfoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enfoque VARCHAR(100) NOT NULL
);
INSERT INTO enfoque (enfoque) VALUES
('DE DERECHOS'),
('INCLUSIVO O DE ATENCIÓN A LA DIVERSIDAD'),
('INTERCULTURAL'),
('IGUALDAD DE GÉNERO'),
('AMBIENTAL'),
('ORIENTACIÓN AL BIEN COMÚN'),
('BUSQUEDA DE LA EXCELENCIA');

-- Crear tabla de Valores
CREATE TABLE  valores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enfoque_id INT NOT NULL, 
    valor VARCHAR(80) NOT NULL,
    FOREIGN KEY (enfoque_id) REFERENCES enfoque(id)
);
INSERT INTO valores (enfoque_id,valor) VALUES
(1,"Conciencia de derechos"),
(1,"Libertad y responsabilidad"),
(1,"Diálogo y concertación"),
(2,"Respeto por las diferencias"),
(2,"Equidad en la enseñanza"),
(2,"Confianza en la persona"),
(3,"Respeto a la identidad cultural"),
(3,"Justicia"),
(3,"Dialogo Intercultural"),
(4,"Igualdad y Dignidad"),
(4,"Justicia"),
(4,"Empatia"),
(5,"Solidaridad planetaria y equidad intergeneracional"),
(5,"Justicia y solidaridad"),
(5,"Respeto a toda forma de vida"),
(6,"Equidad y justicia"),
(6,"Solidaridad"),
(6,"Empatia"),
(6,"Responsabilidad"),
(7,"Flexibilidad y apertura"),
(7,"Superación personal");


-- Crear tabla de Actitudes y acciones
CREATE TABLE  actitudes_acciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valores_id INT NOT NULL, 
    accion VARCHAR(255) NOT NULL,
    FOREIGN KEY (valores_id) REFERENCES valores(id)
);

INSERT INTO actitudes_acciones (valores_id,accion) VALUES
(1,"Disposición a conocer y reconocer y valorar los derechos individuales y colectivos que tenemos las personas en el ámbito privado y publico"),
(1,"Conocimiento de los derechos Humanos derechos del niño Generar espacios de reflexión y crítica"),
(2,"Disposición a elegir de manera voluntaria y responsable la propia forma de actuar dentro de la sociedad"),
(2,"Promover oportunidades para que los estudiantes ejerzan sus derechos (familia y comunidad)"),
(3,"Disposición a conversar con otras personas intercambiando ideas o afectos de modo alternativo para construir juntos una postura común"),
(3,"Los estudiantes dialoguen y elaboren sus normas u otros"),
(4,"Reconocimiento al valor inherente de cada persona y de sus derechos, por encima de cualquier diferencia"),
(4,"Docente y estudiantes demuestran tolerancia y respeto evitando cualquier forma de discriminación"),
(5,"Disposición a enseñar ofreciendo a los estudiantes las condiciones y oportunidades que cada uno necesita para lograr los mismos resultados"),
(5,"Los docente programan y enseñan de acuerdo a las características y demandas del estudiante"),
(6,"Disposición a depositar expectativas en una persona, creyendo sinceramente en su capacidad de superación y crecimiento por sobre cualquier circunstancia"),
(6,"Los docentes convocan a las familias a reforzar la autonomía, autoconfianza y autoestimas de sus hijos antes de cuestionarlos o sancionarlos"),
(7,"Reconocimiento al valor de las diversas identidades culturales y relaciones de pertenencia de los estudiantes"),
(7,"Los docente respetan las variantes del castellano en distintas regiones del país"),
(8,"Disposición a actuar de manera justa, respetando el derecho de todos, exigiendo sus propios derechos y reconociendo derechos a quienes les corresponde"),
(8,"Los docentes previenen y afrontan las distintas forma de discriminación"),
(9,"Fomento de una interacción equitativa entre diversas culturas, mediante el diálogo y el respeto mutuo"),
(9,"Docentes y directivos propician un dialogo sobre el saber cientifico"),
(10,"Reconocimiento al valor inherente de cada persona, por encima de cualquier diferencia de género"),
(10,"Estudiantes varones y mujeres tiene las mismas responsabilidades "),
(11,"Disposición a actuar de modo que se dé a cada quien lo que le corresponde, en especial a quienes se ven perjudicados por las desigualdades de género"),
(11,"Docentes y directivos fomentan una valoración  sana y respetuosa del cuerpo e integridad de las personas"),
(12,"Transformar las diferentes situaciones de desigualdad de género, evitando el reforzamiento de estereotipos"),
(12,"Docente y estudiantes analicen prejuicios entre géneros(hombre y mujer)"),
(13,"Disposición para colaborar con el bienestar y la calidad de vida de las generaciones presentes y futuras, así como con la naturaleza asumiendo el cuidado del planeta"),
(13,"Docente y estudiantes desarrollen acciones de conciencia sobre el medio ambiente de su comunidad"),
(14,"Disposición a evaluar los impactos y costos ambientales de las acciones y actividades cotidianas, y a actuar en beneficio de todas las personas, así como de los sistemas, instituciones y medios compartidos de los que todos dependemos"),
(14,"Docentes y estudiantes realizan acciones como el cuidado del medio ambiente, del agua,preservación de entornos saludables ,hábitos de higiene y alimentación saludable"),
(15,"Aprecio, valoración y disposición para el cuidado a toda forma de vida sobre la Tierra desde una mirada sistémica y global, revalorando los saberes ancestrales"),
(15,"Promover la preservación y conservación de la flora y fauna nacional, las áreas naturales y los beneficios que le brindan"),
(16,"Disposición a reconocer a que ante situaciones de inicio diferentes, se requieren compensaciones a aquellos con mayores dificultades"),
(16,"Los estudiantes comparten espacios educativos, materiales y recurso"),
(17,"Disposición a reconocer a que ante situaciones de inicio diferentes, se requieren compensaciones a aquellos con mayores dificultades"),
(17,"Cuando el estudiante demuestra apoyo a su compañero en alguna dificultad que no pueda afrontar"),
(18,"Identificación afectiva con los sentimientos del otro y disposición para apoyar y comprender sus circunstancias"),
(18,"El docente valora actos espontáneos de los estudiantes en beneficio de otros"),
(19,"Disposición a valorar y proteger los bienes comunes y compartidos de un colectivo"),
(19,"Los docentes promueven oportunidades para que os estudiantes asuman responsabilidades"),
(20,"Disposición para adaptarse a los cambios, modificando si fuera necesario la propia conducta para alcanzar determinados objetivos cuando surgen dificultades, información no conocida o situaciones"),
(20,"Docentes y estudiantes demuestran flexibilidad para el cambio y la adaptación de las circunstancias diversas orientadas a objetivos a lograr"),
(21,"Disposición a adquirir cualidades que mejorarán el propio desempeño y aumentarán el estado de satisfacción consigo mismo y con las circunstancias"),
(21,"Docentes y estudiantes se esfuerzan por superarse en determinados ámbitos");
