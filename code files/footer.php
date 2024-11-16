<!-- Footer scripts -->

<!-- Scripts for functionality -->
<script>
    // When the delete button is clicked, set the delete link href dynamically
    const deleteButtons = document.querySelectorAll('.btn-danger[data-bs-toggle="modal"]');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const recordId = this.getAttribute('data-id');
            const deleteLink = document.getElementById('deleteRecordLink');
            deleteLink.setAttribute('href', 'delete.php?id=' + recordId);
        });
    });
</script>

<!-- JavaScript to close alert when clicking outside -->
<script>
    document.addEventListener('click', function(event) {
        const alertContainer = document.querySelector('.alert-container');
        if (alertContainer && !alertContainer.contains(event.target)) {
            const closeButton = alertContainer.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click(); 
            }
        }
    });
</script>

<!-- Include Bootstrap 5 JS (Ensure it's the same version used in header.php) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
