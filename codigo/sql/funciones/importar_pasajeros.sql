CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
importar_pasajeros()

-- declaramos lo que retorna
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
tupla RECORD;
tupla_companias RECORD;
tupla_seed RECORD;
pasajero_current_name varchar;
pasajero_current_pas varchar;
contador integer;
valor_random integer;


-- definimos nuestra función
BEGIN
    FOR tupla_seed IN (select setseed(0.5))
    LOOP

    -- control de flujo
    contador := 0; -- listos los pasajeros, faltan las companias y el dgca
    FOR tupla IN (SELECT * FROM pasajeros)
    LOOP
        pasajero_current_name := tupla.nombre_pasajero;
        pasajero_current_pas := tupla.pasaporte_pasajero;
        valor_random := floor(random()*(10000-1000+1))+1000;
        contador := contador + 1;
        INSERT INTO usuarios values(contador,tupla.pasaporte_pasajero, REPLACE(CONCAT(pasajero_current_name, pasajero_current_pas, valor_random), ' ', ''), 'pasajero');
    END LOOP;
    FOR tupla_companias IN (SELECT * FROM companias_aereas)
    LOOP
        valor_random := floor(random()*(1000-100+1))+100;
        contador := contador + 1;
        INSERT INTO usuarios values(contador,tupla_companias.codigo_compania, CONCAT(valor_random, tupla_companias.codigo_compania), 'compania');
    END LOOP;
    contador := contador + 1;
    INSERT INTO usuarios values(contador,'DGAC', 'admin', 'Admin DGAC');
    END LOOP;



END
$$ language plpgsql