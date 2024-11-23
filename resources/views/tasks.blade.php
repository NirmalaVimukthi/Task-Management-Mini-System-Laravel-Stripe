@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTable JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<div class="row">
    <h2>All Tasks </h2>

</div>
<form id="newTaskForm">
<div class="row">

    <div class="col-md-12 padding-2" >
        <div class="card bg-white" style="min-height:740px">
            <div class="card-body">

            <table id="tasksTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                   
                        <th>Due Date</th>
                        <th>Priority</th>
                        <th>Creator</th>
                        <th>Users</th>
                        <th>Complete</th>
                        <th>Paid</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated dynamically via JavaScript -->
                </tbody>
            </table>

            

        </div>

    </div>
    </div>



 
</div>

</form>

   <script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#tasksTable').DataTable({
            processing: true,  // Show a processing indicator
            serverSide: true,  // Enable server-side processing
            ajax: {
                url: '/api/v1/tasks',  // Your endpoint
                method: 'GET',  // HTTP method
                dataSrc: function (json) {
                    // Process the data before sending it to DataTable
                    return json.map(function (task) {
                        return {
                            id: task.id,
                            title: task.title,
                            due_date: task.due_date,
                        priority: task.priority,
                        creator: task.creator.name,
                        users: task.users.map(user => user.name).join(", "),
                        is_completed: task.is_completed ? 'Yes' : 'No',  // Convert boolean to Yes/No
                        is_paid: task.is_paid ? 'Yes' : 'No',            // Convert boolean to Yes/No
                        action: `<span style="display:flex">
                           <a href="tasks/`+task.id+`"> <button class="btn btn-primary list-edit btn-sm view-btn" data-id="${task.id}" >View/Edit</button></a>
                            <button class="btn btn-danger btn-sm delete-btn"  onclick="confirmDelete(${task.id})" data-id="${task.id}">Delete</button>
                        </span>`,
                
                        };
                    });
                }
            },
            columns: [
            { data: 'id' },
            { data: 'title' },
            { data: 'due_date' },
            { data: 'priority' },
            { data: 'creator' },
            { data: 'users' },
            { data: 'is_completed' },
            { data: 'is_paid' },
            { data: 'action' },
        ],
        order: [[2, 'asc']] 
        });

    });

    
    $('#tasksTable').on('click', '.list-edit', function(event) {

        event.preventDefault();
            var dataid=$(this).attr('data-id');

            window.location.href = '/tasks/'+dataid;
      

    });



    $('#tasksTable').on('click', '.delete-btn', function(event) {

             event.preventDefault();
                var dataid=$(this).attr('data-id');
                confirmDelete(dataid);

              


});

</script>

@include('modals.deletetask')


@endsection
