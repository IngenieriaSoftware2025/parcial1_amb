create database parcial_amb

create table actividades(
act_id serial primary key,
act_nombre varchar(100),
act_horario datetime year to minute,
act_situacion smallint default 1
)

create table asistencia(
asi_id serial primary key,
asi_actividad int,
asi_horaestablecida datetime year to minute,
asi_horallegada datetime year to minute,
asi_situacion smallint default 1
)

alter table asistencia add constraint (foreign key(asi_actividad)
references actividades(act_id) constraint fk_asi_actividades)