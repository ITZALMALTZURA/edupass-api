<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="bg-light">

    <div class="container py-5">

        <h1 class="mb-4 text-center">Lista de Tareas</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newTask"
            style="margin-bottom: 10px;">
            Agregar Nueva Tarea
        </button>
        <!-- Lista de tareas -->
        <div class="card">
            <div class="card-header">Tareas Pendientes</div>
            <table id="myTableC" border="1" class="display table table-hover text-center">
                <thead class="tbencabezado">
                    <tr>
                        <td><strong>
                                Titulo
                            </strong></td>
                        <td><strong>
                                Descripccion
                            </strong></td>
                        <td><strong>
                                Estatus
                            </strong></td>
                        <td><strong>
                                Fecha límite
                            </strong></td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                @forelse($tasks as $task)
                    <tr>
                        <td>
                            {{ $task->title }}
                        </td>
                        <td>
                            {{ $task->description }}
                        </td>
                        <td>
                            <span class="badge {{ $task->is_completed ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $task->is_completed ? 'Completada' : 'Pendiente' }}
                            </span>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            <button type="button" onclick="updateTask('{{ $task->id }}')"
                                class="btn btn-success btn-sm">
                                Terminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <li class="list-group-item text-center text-muted">No hay tareas registradas.</li>
                @endforelse
            </table>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="newTask" tabindex="-1" aria-labelledby="newTask" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Tarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="POST" name="formNewTask" action="/welcome">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Título</label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="due_date" class="form-label">Fecha Límite</label>
                                    <input type="datetime-local" class="form-control" name="due_date" id="due_date"
                                        required>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="Confirmar()" id="btn-new-task"
                            class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ajax-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- sweetalert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script language="JavaScript">
        function Confirmar() {
            document.formNewTask.submit()

            $('#btn-new-task').attr('disabled', true);
        }

        function updateTask(val) {
            $.ajax({
                type: "PUT",
                url: '/tasks/' + val,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        title: data.msg,
                        icon: "success",
                        //html: 'Redireccionando...',
                        timer: 5000, // Tiempo en milisegundos antes de la redirección
                        timerProgressBar: true,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                                const content = Swal.getContent()
                                if (content) {
                                    const b = content.querySelector('b')
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft()
                                    }
                                }
                            }, 100)
                        },
                        onClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            // Redireccionar después de que se complete el temporizador
                            window.location.reload();
                        }
                        // Redireccionar con boton o fuera del alert
                        window.location.reload();
                    });
                }
            });
        }
    </script>
</body>

</html>
