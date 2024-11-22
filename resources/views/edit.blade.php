@extends('layouts.app')

@section('content')
<div class="row">
    <h2>Edit Task</h2>
</div>




<form id="editTaskForm">
<div class="row">

    <div class="col-md-8 padding-2" >
        <div class="card bg-white" style="min-height:340px">
            <div class="card-body">

        <div id="responseMessage" class="alert d-none"></div>
        <input type="hidden" class="form-control" id="task_id" name="task_id" value=""  >
        <input type="hidden" class="form-control" id="_token" name="_token" value="{{ csrf_token() }}"  >

       
                    <div class="form-group">
                        <label for="title">Task Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter task description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select class="form-control" id="priority" name="priority" required>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_completed" name="is_completed">
                        <label class="form-check-label" for="is_completed">Completed</label>
                    </div>
          
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"  >
                    <hr>

                    <button type="submit" class="btn btn-primary">Update Task</button>
         

                </div>
            </div>
            

        </div>



      <div class="col-md-4 padding-2" >
        <div class="card bg-white" style="min-height:340px">
        <div class="card-header">
        <label for="create_user">Select Users For Task</label>
        </div>
            <div class="card-body">
            <div class="form-group">
             
                <select style="width:100%"  class="form-control select2" >
                    <!-- Options will be dynamically loaded via AJAX -->
                </select>


            </div>
            <hr>

            <table id="user_list" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                    <th style="width:70%">User</th>
                    <th>Action</th>
                    </tr>
                </thead> 
                <tbody >
                  

                </tbody>   
            </table>



            </div>
        </div>    
    </div>
 
</div>

</form>

<script>
    $(document).ready(function() {

        $('.select2').select2({
                placeholder: 'Select a user',
                allowClear: true,
                ajax: {
                    url: '/api/v1/users', // Endpoint to fetch users (adjust as needed)
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        console.log(data);
                        // Process the API response to fit the Select2 format
                        return {
                            results: data.data.map(function (user) {
                                return { id: user.id, text: user.name }; // Adjust 'user.name' to the correct field name
                            })
                        };
                    },
                    cache: true
                }
            });
   

        $('.select2').on('select2:select', function (e) {
        var selectedData = e.params.data;  // This contains the selected item

        // You can access selected item's properties here
        console.log('Selected ID: ' + selectedData.id);
        console.log('Selected Text: ' + selectedData.text);


       $('#user_list tbody').append('<tr> <td> '+selectedData.text+' <input type="hidden" name="users[]" value="'+selectedData.id+'"></td><td><button type="button" class="btn btn-secondary remove-row btn-sm">Remove </button> </td> </tr>');

  
    });


        // Get task ID from URL
        var taskId = window.location.pathname.split('/').pop();

        // Fetch the task data when the page loads
        $.ajax({
            url: '/api/v1/tasks/' + taskId,  // Endpoint to get task data by ID
            type: 'GET',
            success: function(response) {

                console.log(response);
                // Populate the form fields with the fetched data
                $('#task_id').val(response.id);
                $('#title').val(response.title);
                $('#description').val(response.description);
                $('#due_date').val(response.due_date);
                $('#priority').val(response.priority);
                $('#is_completed').prop('checked', response.is_completed);
                $('#is_paid').prop('checked', response.is_paid);



                $.each(response.users, function(index, user) {
                    $('#user_list tbody').append('<tr> <td> '+user.name+' <input type="hidden" name="users[]" value="'+user.id+'"></td><td><button type="button" class="btn btn-secondary remove-row btn-sm">Remove </button> </td> </tr>');

                    });
              //  $('#user_list tbody').append('<tr> <td> '+selectedData.text+' <input type="hidden" name="users[]" value="'+selectedData.id+'"></td><td><button type="button" class="btn btn-secondary remove-row btn-sm">Remove </button> </td> </tr>');



            },
            error: function(xhr, status, error) {
                console.error("Error fetching task:", error);
            }
        });

        // Handle form submission for updating the task
        $('#editTaskForm').on('submit', function(event) {
            event.preventDefault();


           

            // Get the form data
            var userIds = [];
                    $('input[name="users[]"]').each(function() {
                        userIds.push($(this).val()); // Push each value into the array
                    });
                var formData = {
                    _token: $('#_token').val(),
                    task_id: $('#task_id').val(),
                    title: $('#title').val(),
                    description: $('#description').val(),
                    due_date: $('#due_date').val(),
                    priority: $('#priority').val(),
                    is_completed: $('#is_completed').is(':checked') ? 1 : 0,
                    is_paid: $('#is_paid').is(':checked') ? 1 : 0,
                    create_user: $('#create_user').val(),
                    user_id: $('#user_id').val(),
                    userIds:userIds,
                };


            // Send the data to the server to update the task
            // $.ajax({
            //     url: '/api/v1/tasks/' + formData.task_id,  // Update task API endpoint
            //     type: 'post',
            //     data: JSON.stringify(formData),
            //     contentType: 'application/json',
            //     success: function(response) {
            //        // alert('Task updated successfully!');
            //        // window.location.href = '/tasks';  // Redirect to the tasks list after updating
            //     },
            //     error: function(xhr, status, error) {
            //         console.error("Error updating task:", error);
            //     }
            // });


            $.ajax({
                url: '/api/v1/tasks/' + formData.task_id, 
                    type: 'PUT',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    success: function(response) {
                        $('#responseMessage')
                            .removeClass('d-none alert-danger')
                            .addClass('alert-success')
                            .html('Task Update successfully!');
                     
                    },
                    error: function(xhr) {
                        $('#responseMessage')
                            .removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .html('Error: ' + xhr.responseText);
                    }
                });
            });

       // });
    });
</script>
@endsection
