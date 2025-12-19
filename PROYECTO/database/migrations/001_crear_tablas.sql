CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    contrasena VARCHAR(255),
    rol ENUM('admin','usuario') DEFAULT 'usuario',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE preguntas (
    id_pregunta INT AUTO_INCREMENT PRIMARY KEY,
    enunciado TEXT,
    tipo ENUM('opcion_multiple','verdadero_falso'),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE opciones (
    id_opcion INT AUTO_INCREMENT PRIMARY KEY,
    id_pregunta INT,
    texto_opcion VARCHAR(255),
    es_correcta BOOLEAN DEFAULT 0,
    FOREIGN KEY (id_pregunta) REFERENCES preguntas(id_pregunta)
        ON DELETE CASCADE
);

CREATE TABLE examenes (
    id_examen INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150),
    descripcion TEXT,
    tiempo_limite INT,
    activo BOOLEAN DEFAULT 1,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE examen_preguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_examen INT,
    id_pregunta INT,
    FOREIGN KEY (id_examen) REFERENCES examenes(id_examen)
        ON DELETE CASCADE,
    FOREIGN KEY (id_pregunta) REFERENCES preguntas(id_pregunta)
        ON DELETE CASCADE
);

CREATE TABLE resultados (
    id_resultado INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_examen INT,
    calificacion DECIMAL(5,2),
    fecha_realizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE respuestas (
    id_respuesta INT AUTO_INCREMENT PRIMARY KEY,
    id_resultado INT,
    id_pregunta INT,
    id_opcion INT
);
