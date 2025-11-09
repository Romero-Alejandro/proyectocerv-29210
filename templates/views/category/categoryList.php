<?php require_once INCLUDES . 'inc_header.php'; ?>

<?= Toast::flash() ?>

<div class="container py-4">
  <div class="row">

    <div class="col-md-7">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-folder me-2"></i> <?= $data['page_title'] ?? 'Gestión de Categorías' ?></h1>
      </div>

      <div class="card shadow-sm">
        <div class="card-header bg-light">
          <h5 class="mb-0">Tus Categorías Disponibles</h5>
        </div>

        <div class="list-group list-group-flush">

          <?php if (!empty($data['categories'])): ?>
            <?php foreach ($data['categories'] as $category): ?>
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <div class="fw-bold d-flex align-items-center">

                  <?php
                  $color = htmlspecialchars($category['color'] ?? '#343a40');
                  ?>
                  <span style="height: 10px; width: 10px; background-color: <?= $color ?>; border-radius: 50%; display: inline-block; margin-right: 10px;"></span>

                  <?= htmlspecialchars($category['name']) ?>
                </div>

                <div class="d-flex gap-2 align-items-center">

                  <?php if (isset($category['todo_count'])): ?>
                    <span class="badge bg-secondary rounded-pill me-2" title="Tareas asociadas">
                      <?= $category['todo_count'] ?> Tareas
                    </span>
                  <?php endif; ?>

                  <a href="<?= URL ?>category/edit?id=<?= $category['id'] ?>"
                    class="btn btn-sm btn-outline-primary"
                    title="Editar Categoría">
                    <i class="fas fa-edit"></i> Editar
                  </a>

                  <a href="<?= URL ?>category/delete?id=<?= $category['id'] ?>"
                    class="btn btn-sm btn-outline-danger"
                    title="Eliminar Categoría"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar la categoría <?= htmlspecialchars($category['name']) ?>?');">
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="p-4 text-center text-muted">
              <i class="fas fa-tag fa-2x mb-2"></i>
              <p class="mb-0">Aún no has añadido ninguna categoría.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="card shadow-sm sticky-top" style="top: 20px;">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">➕ Añadir Nueva Categoría</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="<?= URL ?>category/store">
            <div class="mb-3">
              <label for="category_name" class="form-label fw-bold">Nombre de la Categoría *</label>
              <input type="text" class="form-control" id="category_name" name="name"
                placeholder="Ej: Finanzas, Ideas" required>
            </div>

            <div class="mb-3">
              <label for="category_color" class="form-label fw-bold">Color (Opcional)</label>
              <input type="color" class="form-control form-control-color" id="category_color" name="color" value="#0d6efd">
            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">
                Guardar Categoría
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>


<?php require_once INCLUDES . 'inc_footer.php'; ?>