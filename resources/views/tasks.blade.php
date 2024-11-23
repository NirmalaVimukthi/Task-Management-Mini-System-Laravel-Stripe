@extends('layouts.app')

@section('content')











<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

<!-- Include DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

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


 



        // create a datatable
        var table = $('#tasksTable').DataTable({
         
            processing: true,
            serverSide: true,
            ajax: {
                url: '/api/v1/tasks',  // Your endpoint
                method: 'GET', 
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
        order: [[2, 'asc']],
        dom: 'Bfrtip',  // Define the position of buttons
        buttons: [
            'csv' // Export to CSV
        ],
      
    
              
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

});

</script>

@include('modals.deletetask')


@endsection
