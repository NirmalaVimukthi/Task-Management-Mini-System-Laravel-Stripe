<!-- Delete Confirmation Modal -->
<div class="modal fade" id="SatatusModel" tabindex="-1" aria-labelledby="SatatusModellabel" aria-hidden="true" style="z-index:9999">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SatatusModellabel">Complete Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Complete this task?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmstatusButton">Confirm</button>
            </div>
        </div>
    </div>
</div>


<script>
    let statusTaskId = null;

    // Show modal and set task ID
    function confirmstatus(id) {
        
        statusTaskId = id;
        $('#SatatusModel').modal('show');
        
    }

    // Handle delete confirmation button click
    document.getElementById('confirmstatusButton').addEventListener('click', function() {
        $('#confirmstatusButton').html(' <i class="fa-solid fa-circle-notch fa-spin"></i>');
        $('#confirmstatusButton').prop('disabled', true);
        if (statusTaskId) {
            $.ajax({
               url: `/api/v1/tasks/${statusTaskId}/complete`,  // Your delete API endpoint
                type: 'PUT',
                success: function(response) {
                    // Close the modal
                    $('#SatatusModel').modal('hide');

                    // Show success message (optional)
                    alert('Task Complete successfully!');


                    //table.ajax.reload();
                    $('#confirmstatusButton').prop('disabled', false);
                    $('#confirmstatusButton').html(' Confirm');
                    
                    completeprocess();
                   
                },
                error: function(xhr) {
                    $('#confirmstatusButton').prop('disabled', false);
                    $('#confirmstatusButton').html(' Confirm');
                  
                    alert('Failed to Confirm the task. Please try again.');
                }
            });
        }
    });
</script>
