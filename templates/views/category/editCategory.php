<?php require_once INCLUDES . 'inc_header.php'; ?>

<!-- Mostrar notificaciones toast -->
<?= Toast::flash() ?>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="mb-0">
          <?= $data['page_title'] ?? 'Editar Categoría' ?>
        </h4>
      </div>
      <div class="card-body">
        <form method="POST" action="<?= URL ?>category/update">
          <input type="hidden" name="id" value="<?= $data['category']['id'] ?>">

          <div class="mb-3">
            <label for="name" class="form-label">Nombre *</label>
            <input type="text" class="form-control" id="name" name="name"
              placeholder="¿Qué necesitas hacer?" value="<?= htmlspecialchars($data['category']['name']) ?>" required>
          </div>

          <div class="mb-3">
            <label for="category_color" class="form-label fw-bold">Color (Opcional)</label>
            <input type="color" class="form-control form-control-color" id="category_color" name="color" value="<?= htmlspecialchars($data['category']['color']) ?>">
          </div>


          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="<?= URL ?>todo" class="btn btn-outline-secondary me-md-2">
              Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
              Actualizar Categoría
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>