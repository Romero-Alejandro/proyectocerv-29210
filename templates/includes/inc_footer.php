<!-- inc_footer.php -->
<!-- scripts -->

<!-- jQuery: Librería JavaScript esencial para manipulación del DOM, eventos y AJAX -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap JS: Funcionalidades interactivas de Bootstrap 5 (modals, carousels, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para manejar la eliminación -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteConfirmModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const deleteUrl = button.getAttribute('data-delete-url');
        confirmDeleteBtn.href = deleteUrl;
    });
});
</script>
</body>
</html>
