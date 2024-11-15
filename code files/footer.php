</div>

   

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
<!--  JavaScript to close alert when clicking outside -->
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
<!-- Include Bootstrap 5 CSS and JS (Ensure they match the version you're using) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</body>
</html>