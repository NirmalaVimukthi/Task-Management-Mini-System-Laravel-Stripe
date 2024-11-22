<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" style="z-index:9999">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this task?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
    let deleteTaskId = null;

    // Show modal and set task ID
    function confirmDelete(id) {
        
        deleteTaskId = id;
        var deleteModal = $('#deleteModal').modal('show');
        deleteModal.show();
    }

    // Handle delete confirmation button click
    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        if (deleteTaskId) {
            $.ajax({
                url: `/api/v1/tasks/${deleteTaskId}`,  // Your delete API endpoint
                type: 'DELETE',
                success: function(response) {
                    // Close the modal
                    $('#deleteModal').modal('hide');

                    // Show success message (optional)
                    alert('Task deleted successfully!');


                    //table.ajax.reload();
                    
            window.location.href = '/tasks/';

                    // Remove the row from the table
                   
                },
                error: function(xhr) {
                    alert('Failed to delete the task. Please try again.');
                }
            });
        }
    });
</script>
