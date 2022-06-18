-- Este es el esquema que utiliza el proyecto de ejemplo
-- No lo incluyas en tu proyecto!
-- la idea es crear una tabla de usuarios, para lo cual decimos:
-- cada usuario tiene un id, un nombre y un password, además yo creo que debería tener el tipo de usuario que es.

CREATE TABLE IF NOT EXISTS usuarios (
    id         serial PRIMARY KEY,
    name       varchar(100),
    password   varchar(100),
    tipo       varchar(100)
);
