@extends('layouts.app')

@section('content')

<div class="row">
    <h2>New Task </h2>

</div>

<form id="newTaskForm">
<div class="row">

    <div class="col-md-8 padding-2" >
        <div class="card bg-white" style="min-height:340px">
            <div class="card-body">

        <div id="responseMessage" class="alert d-none"></div>
            
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
               
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"  >
                    <hr>

                    <button type="submit" class="btn btn-primary">Create Task</button>
         

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
                <tbody  id="userset">
                  

                </tbody>   
            </table>



            </div>
        </div>    
    </div>
 
</div>

</form>
<script>
    $(document).ready(function() {
            // Initialize Select2 on the #create_user dropdown
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
        });

        $('.select2').on('select2:select', function (e) {
        var selectedData = e.params.data;  // This contains the selected item

        // You can access selected item's properties here
        console.log('Selected ID: ' + selectedData.id);
        console.log('Selected Text: ' + selectedData.text);


       $('#user_list tbody').append('<tr> <td> '+selectedData.text+' <input type="hidden" name="users[]" value="'+selectedData.id+'"></td><td><button type="button" class="btn btn-secondary remove-row btn-sm">Remove </button> </td> </tr>');

  
    });

   
 
    //remove selected 


    

    $('#user_list').on('click', '.remove-row', function() {
        // Remove the parent <tr> (table row) of the clicked "Remove" button
        $(this).closest('tr').remove();
    });



            // AJAX Task  Form Submission for api
            $('#newTaskForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                // Gather form data

                var userIds = [];
                    $('input[name="users[]"]').each(function() {
                        userIds.push($(this).val()); // Push each value into the array
                    });
                var formData = {
                    title: $('#title').val(),
                    description: $('#description').val(),
                    due_date: $('#due_date').val(),
                    priority: $('#priority').val(),
                    is_completed: 0,
                    is_paid:  0,
                    create_user: $('#create_user').val(),
                    user_id: $('#user_id').val(),
                    userIds:userIds,
                };

                console.log(formData);


    $.ajax({
                    url: '/api/v1/tasks',  // Your API endpoint to create a new task
                    type: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    success: function(response) {
                        $('#responseMessage')
                            .removeClass('d-none alert-danger')
                            .addClass('alert-success')
                            .html('Task created successfully!');
                        $('#newTaskForm')[0].reset(); // Reset the form fields
                        $('.select2').val(null).trigger('change'); // Reset the Select2 dropdown

                        $('#userset').html('');


                    },
                    error: function(xhr) {
                        $('#responseMessage')
                            .removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .html('Error: ' + xhr.responseText);
                    }
                });
            });
</script>
@endsection
