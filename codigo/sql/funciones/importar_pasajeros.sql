CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
importar_pasajeros()

-- declaramos lo que retorna
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
tupla RECORD;
tupla_companias;
pasajero_current_name varchar;
pasajero_current_pas varchar;
contador integer;


-- definimos nuestra función
BEGIN

    -- control de flujo
    contador := 0; -- listos los pasajeros, faltan las companias y el dgca
    FOR tupla IN (SELECT * FROM pasajeros)
    LOOP
        pasajero_current_name := tupla.nombre_pasajero;
        pasajero_current_pas := tupla.pasaporte_pasajero;
        --CONCAT(pasajero_current_name, pasajero_current_pas);
        --current_password := pasajero_current_name + pasajero_current_pas;
        contador := contador + 1;
        INSERT INTO usuarios values(contador,tupla.pasaporte_pasajero, REPLACE(CONCAT(pasajero_current_name, pasajero_current_pas), ' ', ''), 'pasajero');
    END LOOP;
    FOR tupla_companias IN (SELECT * FROM companias_aereas)
    LOOP
        pasajero_current_name := tupla.nombre_pasajero;
        pasajero_current_pas := tupla.pasaporte_pasajero;
        --CONCAT(pasajero_current_name, pasajero_current_pas);
        --current_password := pasajero_current_name + pasajero_current_pas;
        contador := contador + 1;
        INSERT INTO usuarios values(contador,tupla_companias.codigo_compania, REPLACE(CONCAT(pasajero_current_name, pasajero_current_pas), ' ', ''), 'pasajero');
    END LOOP;
    



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql