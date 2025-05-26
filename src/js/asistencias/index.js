import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { data } from "jquery";

const FormAsistencias = document.getElementById('FormAsistencias');
const BtnGuardar = document.getElementById('BtnGuardar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const selectActividad = document.getElementById('asi_actividad');
const inputHoraEstablecida = document.getElementById('asi_horaestablecida');
const FechaInicio = document.getElementById('fecha_inicio');
const FechaFin = document.getElementById('fecha_fin');
const BtnFiltrarFecha = document.getElementById('btn_filtrar_fecha');


const cargarHorarioActividad = () => {
    const selectedOption = selectActividad.options[selectActividad.selectedIndex];
    const horarioEstablecido = selectedOption.getAttribute('data-horario');
    
    if (horarioEstablecido) {
        inputHoraEstablecida.value = horarioEstablecido;
        
    } else {
        inputHoraEstablecida.value = '';
    }
};

const limpiarTodo = () => {
    FormAsistencias.reset();
    BtnGuardar.classList.remove('d-none');
    BtnModificar.classList.add('d-none');
    
    
};

const GuardarAsistencia = async (event) => {
    event.preventDefault();
    BtnGuardar.disabled = true;

    if (!validarFormulario(FormAsistencias, ['asi_id'])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
        return;
    }

    const body = new FormData(FormAsistencias);
    const url = '/parcial1_amb/asistencias/guardarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje } = datos

        if (codigo == 1) {
            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodo();
            BuscarAsistencias();
        } else {
            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }
    } catch (error) {
        console.log(error)
    }
    BtnGuardar.disabled = false;
};

const BuscarAsistencias = async () => {
    const fecha_inicio = FechaInicio?.value || '';
    const fecha_fin = FechaFin?.value || '';
    const params = new URLSearchParams();

    if (fecha_inicio) params.append('fecha_inicio', fecha_inicio);
    if (fecha_fin) params.append('fecha_fin', fecha_fin);

    const url = `/parcial1_amb/asistencias/buscarAPI?${params.toString()}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos

        if (codigo == 1) {
            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            datatable.clear().draw();
            datatable.rows.add(data).draw();
        } else {
            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }
    } catch (error) {
        console.log(error)
    }
};

const datatable = new DataTable('#TablaAsistencias', {
    dom: `
        <"row mt-3 justify-content-between" 
            <"col" l> 
            <"col" B> 
            <"col-3" f>
        >
        t
        <"row mt-3 justify-content-between" 
            <"col-md-3 d-flex align-items-center" i> 
            <"col-md-8 d-flex justify-content-end" p>
        >
    `,
    language: lenguaje,
    data: [],
    columns: [
        {
            title: 'No.',
            data: 'asi_id',
            width: '%',
            render: (data, type, row, meta) => meta.row + 1
        },
        { title: 'Nombre', data: 'asi_actividad' },
        { title: 'Fecha Establecida', data: 'asi_horaestablecida' },
        { title: 'Fecha Llegada', data: 'asi_horallegada' },
        { 
            title: 'Puntualidad', 
            data: 'asi_puntualidad',
            render: (data, type, row, meta) => {
                if (data == 1) {
                    return 'Puntual';
                } else {
                    return 'Impuntual';
                }
            }
        },
        {
            title: 'Acciones',
            data: 'asi_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `
                 <div class='d-flex justify-content-center'>
                     <button class='btn btn-warning modificar mx-1' 
                         data-id="${data}" 
                         data-actividad="${row.asi_actividad}"
                         data-horaestablecida="${row.asi_horaestablecida}"
                         data-horallegada="${row.asi_horallegada}"
                         data-puntualidad="${row.asi_puntualidad}">   
                         <i class="bi bi-pencil-square"></i> Modificar
                     </button>
                     <button class='btn btn-danger eliminar mx-1' 
                         data-id="${data}">
                        <i class="bi bi-trash3 me-1"></i>Eliminar
                     </button>
                 </div>`;
            }
        }
    ]
});

const ModificarAsistencia = async (event) => {
    event.preventDefault();
    BtnModificar.disabled = true;

    if (!validarFormulario(FormAsistencias, [''])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnModificar.disabled = false;
        return;
    }

    const body = new FormData(FormAsistencias);
    const url = '/parcial1_amb/asistencias/modificarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje } = datos

        if (codigo == 1) {
            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodo();
            BuscarAsistencias();
        } else {
            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }
    } catch (error) {
        console.log(error)
    }
    BtnModificar.disabled = false;
};

const llenarFormulario = (event) => {
    const datos = event.currentTarget.dataset

    document.getElementById('asi_id').value = datos.id
    document.getElementById('asi_actividad').value = datos.actividad
    document.getElementById('asi_horaestablecida').value = datos.horaestablecida
    document.getElementById('asi_horallegada').value = datos.horallegada

    BtnGuardar.classList.add('d-none');
    BtnModificar.classList.remove('d-none');

    window.scrollTo({
        top: 0
    });
};

const EliminarAsistencias = async (e) => {
    const idAsi = e.currentTarget.dataset.id

    const AlertaConfirmarEliminar = await Swal.fire({
        position: "center",
        icon: "info",
        title: "¿Desea ejecutar esta acción?",
        text: 'Esta completamente seguro que desea eliminar este registro',
        showConfirmButton: true,
        confirmButtonText: 'Si, Eliminar',
        confirmButtonColor: 'red',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (AlertaConfirmarEliminar.isConfirmed) {
        const url = `/parcial1_amb/asistencias/eliminar?id=${idAsi}`;
        const config = {
            method: 'GET'
        }

        try {
            const consulta = await fetch(url, config);
            const respuesta = await consulta.json();
            const { codigo, mensaje } = respuesta;

            if (codigo == 1) {
                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito",
                    text: mensaje,
                    showConfirmButton: true,
                });
                
                BuscarAsistencias();
            } else {
                await Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: mensaje,
                    showConfirmButton: true,
                });
            }
        } catch (error) {
            console.log(error)
        }
    }
};

BuscarAsistencias();
FormAsistencias.addEventListener('submit', GuardarAsistencia);
BtnLimpiar.addEventListener('click', limpiarTodo);
BtnModificar.addEventListener('click', ModificarAsistencia);
selectActividad.addEventListener('change', cargarHorarioActividad);
datatable.on('click', '.modificar', llenarFormulario);
datatable.on('click', '.eliminar', EliminarAsistencias);
BtnFiltrarFecha.addEventListener('click', BuscarAsistencias);