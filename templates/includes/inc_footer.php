</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        var deleteModal = document.getElementById('deleteConfirmModal');

        if (deleteModal) {

            const confirmDeleteBtn = deleteModal.querySelector('#confirmDeleteBtn');

            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const deleteUrl = button.getAttribute('data-delete-url');

                if (confirmDeleteBtn) {
                    confirmDeleteBtn.href = deleteUrl;
                }
            });
        }
    });
</script>
</body>

</html>