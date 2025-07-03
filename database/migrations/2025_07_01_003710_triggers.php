<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION actualizar_clases_desde_tipo_membresia()
            RETURNS TRIGGER AS $$
            BEGIN
                -- Actualizar clases_disponibles con el valor de no_clases del tipo de membresía
                NEW.clases_disponibles := (
                    SELECT no_clases
                    FROM tipo_membresia
                    WHERE id = NEW.id_tipo_membresia
                );

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER tr_actualizar_clases_desde_tipo_membresia
            BEFORE INSERT OR UPDATE OF id_tipo_membresia ON membresia
            FOR EACH ROW EXECUTE FUNCTION actualizar_clases_desde_tipo_membresia();
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION actualizar_clases_disponibles()
            RETURNS TRIGGER AS $$
            DECLARE
                v_id_alumno INTEGER;
                v_clases_restantes INTEGER;
            BEGIN
                -- Obtener el id_alumno de la clase
                SELECT id_alumno INTO v_id_alumno
                FROM clase
                WHERE id = NEW.id_clase;

                IF NOT FOUND THEN
                    RAISE EXCEPTION \'No se encontró la clase con id %\', NEW.id_clase;
                END IF;

                -- Verificar si existe una membresía activa para el alumno
                SELECT clases_disponibles INTO v_clases_restantes
                FROM membresia
                WHERE id_persona = v_id_alumno
                AND estatus = \'Activa\'
                AND fecha_fin >= CURRENT_DATE;

                IF NOT FOUND THEN
                    RAISE EXCEPTION \'El alumno no tiene una membresía activa válida\';
                END IF;

                IF v_clases_restantes <= 0 THEN
                    RAISE EXCEPTION \'El alumno no tiene clases disponibles en su membresía\';
                END IF;

                -- Actualizar las clases disponibles
                UPDATE membresia
                SET clases_disponibles = clases_disponibles - 1
                WHERE id_persona = v_id_alumno
                AND estatus = \'Activa\'
                AND fecha_fin >= CURRENT_DATE;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER tr_actualizar_clases_disponibles
            BEFORE INSERT ON asistencia
            FOR EACH ROW EXECUTE FUNCTION actualizar_clases_disponibles();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_actualizar_clases_desde_tipo_membresia ON membresias');
        DB::unprepared('DROP FUNCTION IF EXISTS actualizar_clases_desde_tipo_membresia()');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_actualizar_clases_disponibles ON asistencias');
        DB::unprepared('DROP FUNCTION IF EXISTS actualizar_clases_disponibles()');
    }
};
