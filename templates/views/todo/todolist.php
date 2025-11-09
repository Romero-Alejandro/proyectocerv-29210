<?php require_once INCLUDES . 'inc_header.php'; ?>

<!-- Mostrar notificaciones toast -->
<?= Toast::flash() ?>

<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><?= $data['page_title'] ?? 'Mi Lista de Tareas' ?></h1>
            <a href="<?= URL ?>todo/add" class="btn btn-primary">Nueva Tarea</a>
        </div>
        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <form method="GET" action="<?= URL ?>todo/search" class="d-flex">
                <input type="text" class="form-control me-2" name="q"
                    placeholder="Buscar tareas..." value="<?= $data['search_term'] ?? '' ?>">
                <button type="submit" class="btn btn-outline-secondary">Buscar</button>
            </form>
        </div>

        <!-- Lista de tareas -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tareas</h5>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($data['todos'])): ?>
                    <?php foreach ($data['todos'] as $todo): ?>
                        <div class="todo-item p-3 border-bottom <?= $todo['completed'] ? 'completed-task' : '' ?>" style="border-left: 4px solid <?= htmlspecialchars($todo['category_color'] ?? '#343a40') ?>;">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2 gap-2">
                                        <h6 class="mb-0 me-2 <?= $todo['completed'] ? 'text-decoration-line-through text-muted' : '' ?>">
                                            <?= htmlspecialchars($todo['task']) ?>
                                        </h6>
                                        <span class="badge priority-badge bg-<?= $todo['priority_color'] ?>">
                                            <?= $todo['priority_text'] ?>
                                        </span>
                                        <span class="badge" style="background-color: <?= htmlspecialchars($todo['category_color'] ?? '#6c757d') ?>; color: #fff;">
                                            <?= htmlspecialchars($todo['category_name'] ?? 'Sin categoría') ?>
                                        </span>
                                        <?php if ($todo['completed']): ?>
                                            <span class="badge completed-badge bg-<?= $todo['completed_color'] ?>">
                                                <?= $todo['completed_text'] ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($todo['favorite']): ?>
                                            <i class="fa-solid fa-star text-warning"></i>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($todo['description']): ?>
                                        <p class="text-muted mb-2 small">
                                            <?= htmlspecialchars($todo['description']) ?>
                                        </p>
                                    <?php endif; ?>

                                    <small class="text-muted">
                                        <?= $todo['formatted_date'] ?>
                                    </small>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="<?= URL ?>todo/edit?id=<?= $todo['id'] ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        Editar
                                    </a>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger delete-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmModal"
                                        data-delete-url="<?= URL ?>todo/delete?id=<?= $todo['id'] ?>">
                                        Eliminar
                                    </button>
                                    <a href="<?= URL ?>todo/toggle?id=<?= $todo['id'] ?>"
                                        class="btn btn-sm <?= $todo['completed'] ? 'btn-outline-success' : 'btn-success' ?>">
                                        <?= $todo['completed'] ? 'Completada' : 'Marcar Completada' ?>
                                        <?= $todo['completed'] ? '<i class="fa-solid fa-check"></i>' : "" ?>
                                    </a>
                                    <a href="<?= URL ?>todo/toggleFavorite?id=<?= $todo['id'] ?>"
                                        class="btn btn-sm <?= $todo['favorite'] ? 'btn-outline-warning' : 'btn-warning text-white' ?>">
                                        <?= $todo['favorite'] ? 'Favorita' : 'Marcar como favorita' ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                        <h5>No hay tareas</h5>
                        <p>
                            <?php if (isset($data['search_term'])): ?>
                                No se encontraron tareas para "<?= htmlspecialchars($data['search_term']) ?>"
                            <?php else: ?>
                                ¡Agrega tu primera tarea!
                            <?php endif; ?>
                        </p>
                        <a href="<?= URL ?>todo/add" class="btn btn-primary">
                            Nueva Tarea
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta tarea? Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Sí, eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel lateral -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Sistema de Tareas</h5>
                <p class="text-muted mb-4">
                    Organiza tus actividades diarias de forma simple.
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>