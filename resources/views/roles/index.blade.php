@extends('layouts.app')

<style>
:root {
        --primary-burgundy: #800020;
        --light-burgundy: #98304b;
        --pastel-pink: #ffd6e0;
        --pastel-blue: #d6e5ff;
        --pastel-purple: #e5d6ff;
        --hover-pink: #ffecf1;
        --gradient-start: #800020;
        --gradient-end: #b31b41;
    }

    /* Estilos generales y contenedor principal */
    body {
        background: linear-gradient(135deg, #f8f9fa, #fff5f7);
        min-height: 100vh;
    }

    .section {
        padding: 2rem;
    }

    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 30px;
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
    }

    /* Encabezado mejorado */
    .section-header {
        margin-bottom: 2.5rem;
        position: relative;
        padding: 20px 0;
    }

    .page__heading {
        color: var(--primary-burgundy);
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }

    .page__heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--pastel-pink), var(--primary-burgundy));
        border-radius: 2px;
    }

    /* Contenedor de acciones superior */
    .actions-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding: 15px;
        background: linear-gradient(to right, #fff, var(--pastel-pink));
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    /* Estilos mejorados de la tabla */
    .table-container {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin: 20px 0;
        animation: fadeIn 0.5s ease-out;
    }

    #miTabla2 {
        font-family: 'Open Sans', sans-serif;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
        font-size: 14px;
        margin: 0;
    }

    #miTabla2 thead {
        background: linear-gradient(135deg, var(--primary-burgundy), var(--light-burgundy));
        position: relative;
    }

    #miTabla2 thead::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #fff, transparent);
    }

    #miTabla2 thead th {
        padding: 18px 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: white;
        font-size: 0.85rem;
        position: relative;
    }

    #miTabla2 thead th::after {
        content: '';
        position: absolute;
        right: 0;
        top: 25%;
        height: 50%;
        width: 1px;
        background: rgba(255, 255, 255, 0.1);
    }

    #miTabla2 tbody tr {
        transition: all 0.3s ease;
    }

    #miTabla2 tbody tr:nth-child(even) {
        background-color: rgba(var(--pastel-pink), 0.05);
    }

    #miTabla2 tbody tr:hover {
        background-color: var(--hover-pink);
        transform: scale(1.01);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    #miTabla2 tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #eee;
        transition: all 0.3s ease;
        text-align: center;
    }

    /* Botones mejorados */
    .btn {
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .btn-new {
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        color: white;
        box-shadow: 0 4px 15px #ebe8e833;
        position: relative;
        overflow: hidden;
    }

    .btn-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(128, 0, 32, 0.3);
        background: linear-gradient(135deg, var(--gradient-end), var(--gradient-start));
    }

    .btn-new i {
        color: white;
        background: #494949;
        padding: 8px;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .btn-new:hover i {
        transform: translateX(5px);
    }

    .btn-edit {
        background: linear-gradient(45deg, #4a90e2, #357abd);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(45deg, #ff6b6b, #ee5253);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    /* Estilos del DataTable */
    .dataTables_wrapper {
        padding: 20px 0;
    }

    .dataTables_filter input {
        border: 2px solid #eee;
        border-radius: 10px;
        padding: 8px 15px;
        transition: all 0.3s ease;
        width: 250px;
    }

    .dataTables_filter input:focus {
        border-color: var(--primary-burgundy);
        box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
        outline: none;
    }

    /* Paginación mejorada */
    .pagination {
        margin-top: 2rem;
        gap: 5px;
    }

    .page-link {
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        color: var(--primary-burgundy);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background-color: var(--pastel-pink);
        color: var(--primary-burgundy);
        transform: translateY(-2px);
    }

    .page-item.active .page-link {
        background: linear-gradient(45deg, var(--primary-burgundy), var(--light-burgundy));
        border: none;
        box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
    }

    /* Animaciones de carga */
    .table-container {
        animation: fadeIn 0.5s ease-out;
    }

    /* Efecto Ripple al hacer clic */
    .btn-new::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        background: rgb(253, 0, 0);
        border-radius: 50%;
        transform: scale(0);
        opacity: 0;
        pointer-events: none;
        transition: transform 0.5s ease, opacity 1s ease;
    }

    .btn-new:active::after {
        transform: scale(4);
        opacity: 1;
        transition: 0s;
    }

    /* Asegura que el texto dentro del span herede el color blanco */
    .btn-new span {
        color: white;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    :root {
    --primary-burgundy: #800020;
    --light-burgundy: #98304b;
    --pastel-pink: #ffd6e0;
    --pastel-blue: #d6e5ff;
    --pastel-purple: #e5d6ff;
    --hover-pink: #ffecf1;
    --gradient-start: #800020;
    --gradient-end: #b31b41;
}

/* ... Tus estilos existentes ... */

/* Agregar figuras decorativas al fondo del contenedor .card */
.card {
    position: relative;
    overflow: hidden;
}

.card::before,
.card::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    z-index: 0;
}

.card::before {
    width: 300px;
    height: 300px;
    background: var(--primary-burgundy);
    top: -100px;
    left: -100px;
    transform: rotate(45deg);
}

.card::after {
    width: 200px;
    height: 200px;
    background: var(--pastel-pink);
    bottom: -50px;
    right: -50px;
    transform: rotate(-30deg);
}

/* Agregar figuras decorativas al fondo del contenedor .table-container */
.table-container {
    position: relative;
    overflow: hidden;
}

.table-container::before,
.table-container::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    opacity: 0.05;
    z-index: 0;
}

.table-container::before {
    width: 150px;
    height: 150px;
    background: var(--pastel-blue);
    top: -50px;
    right: -50px;
    transform: rotate(60deg);
}

.table-container::after {
    width: 100px;
    height: 100px;
    background: var(--pastel-purple);
    bottom: -30px;
    left: -30px;
    transform: rotate(-45deg);
}

/* Asegurar que el contenido esté por encima de las figuras */
.table-container > .table-responsive,
.card > .actions-container,
.card > .table-container,
.card > .pagination,
.section,
.section-header,
.section-body {
    position: relative;
    z-index: 1;
}

/* Agregar figuras abstractas al fondo del body */
body {
    position: relative;
    background: linear-gradient(135deg, #f8f9fa, #fff5f7);
    min-height: 100vh;
    overflow: hidden; /* Previene barras de desplazamiento por las figuras */
}

body::before,
body::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    opacity: 0.02;
    z-index: 0;
}

body::before {
    width: 500px;
    height: 500px;
    background: var(--gradient-start);
    top: -200px;
    left: -200px;
    transform: rotate(0deg);
}

body::after {
    width: 400px;
    height: 400px;
    background: var(--gradient-end);
    bottom: -150px;
    right: -150px;
    transform: rotate(90deg);
}

/* Opcional: Añadir una capa oscura sutil sobre el fondo para resaltar los contenedores */
.section, .section-header, .section-body, .card, .table-container, .pagination {
    position: relative;
    z-index: 1;
}

    
</style>

@section('content')
<div class="main-container">
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Gestión de Roles</h3>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="actions-container">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-new" href="{{ route('roles.create') }}">
                            <i class="fas fa-plus"></i>
                            <span>Nuevo Rol</span>
                        </a>
                    </div>
                </div>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table" id="miTabla2">
                            <thead>
                                <tr>
                                    <th class="text-center">Rol</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <button type="button" class="btn btn-delete" onclick="confirmarEliminacion({{ $role->id }})">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                            <form id="eliminar-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pagination justify-content-end">
                    {!! $roles->links() !!}
                </div>
            </div>
        </div>
    </section>
</div>



<script>
    new DataTable('#miTabla2', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        }
    });

    function confirmarEliminacion(roleId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#800020',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('eliminar-form-' + roleId).submit();
            }
        });
    }
</script>
@endsection
