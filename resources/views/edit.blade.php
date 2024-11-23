@extends('layouts.app')

@section('content')
<style>

#payment-form {
            background-color: #e0f7fa; /* Light cyan */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        #card-element {
            background-color: #ffffff; /* White background for the card element */
            padding: 10px;
            border: 1px solid #b3e5fc; /* Light blue border */
            border-radius: 5px;
            margin-bottom: 15px;
        }

        #submit-button {
            background-color: #03a9f4; /* Light blue button */
            color: white;
            font-size: 16px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        #submit-button:hover {
            background-color: #0288d1; /* Darker blue on hover */
        }

        .form-heading {
            text-align: center;
            margin-bottom: 15px;
            color: #0277bd; /* Darker shade of blue */
            font-size: 1.2rem;
        }
    </style>

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
                
          
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"  >
                    <hr>

                    <button type="submit" class="btn btn-primary update-btn">Update Task</button>
         

                </div>
            </div>
            

        </div>



      <div class="col-md-4 padding-2" >
        <div class="card bg-white" style="min-height:340px">
        <div class="card-header">
        <label for="create_user">Select Users For Task</label>
        </div>
            <div class="card-body">
            <div class="form-group" id="user_select">
             
                <select style="width:100%"  class="form-control select2" >
                    <!-- Options will be dynamically loaded via AJAX -->
                </select>


            </div>
            <hr>

            <table id="user_list" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                    <th style="width:70%">User</th>
                    <th id="actions">Action</th>
                    </tr>
                </thead> 
                <tbody >
                  

                </tbody>   
            </table>



            </div>
        </div>    
    </div>
<br>

</div>
</form>


    <div class="row">
    <h3>Task Status</h3>
        </div>
 <div class="row">
    <div class="col-md-8 padding-2" >
        <div class="card bg-white" style="min-height:50px">
            <div class="card-body"  id="task_status">
                <h4>processing Task </h4> 
                <button type="button" class="btn btn-primary">Complete </button>

            </div>    
        </div>
    </div>

    <div class="col-md-4 padding-2" >
        <div class="card bg-white" style="min-height:50px">
        <div class="card-header">
        <label for="create_user">Task Payment</label>
        </div>
            <div class="card-body"  id="task_payment_card">

        <div id="payment-msg">
        <p style="color: green;"></p>



        <p style="color: red;"></p>
        </div>


    <form id="payment-form" action="" method="POST">
        @csrf
        <div id="card-element"></div>
        <input type="hidden" class="form-control" id="payment_task_id" name="payment_task_id" value=""  >
        <input type="hidden" name="paymentMethod" id="payment-method">
        <input type="hidden" class="form-control" id="payment_user_id" name="user_id" value="{{ auth()->user()->id }}"  >

        <button type="submit" id="submit-button">Pay $10.00</button>
    </form>

    

</div>    
        </div>
    </div>


    </div>

    <script src="https://js.stripe.com/v3/"></script>

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


       $('#user_list tbody').append('<tr> <td> '+selectedData.text+' <input type="hidden" name="users[]" value="'+selectedData.id+'"></td><td class="actions"><button type="button" class="btn btn-secondary remove-row btn-sm">Remove </button> </td> </tr>');

  
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
                $('#payment_task_id').val(response.id);
                $('#title').val(response.title);
                $('#description').val(response.description);
                $('#due_date').val(response.due_date);
                $('#priority').val(response.priority);
              //  $('#is_completed').prop('checked', response.is_completed);
               // $('#is_paid').prop('checked', response.is_paid);

               $.each(response.users, function(index, user) {
                    $('#user_list tbody').append('<tr> <td> '+user.name+' <input type="hidden" name="users[]" value="'+user.id+'"></td><td><button type="button" class="btn btn-secondary remove-row btn-sm">Remove </button> </td> </tr>');

                    });
                if(response.is_completed == true){

                    completeprocess();



                }
                else{

                    
                    $('#task_status').html('<h4>Task is Processing...  </h4> '+
                '<button type="button" class="btn btn-primary" onclick="confirmstatus('+response.id+')">Complete </button>');
                }



                if(response.is_paid == true){

                    completepayment();



                            }
              
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


       const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
   var  PayTaskId =  $('#payment_task_id').val();
   console.log('url to pay : /api/v1/tasks/'+PayTaskId+'/pay');

    const form = $('#payment-form');
    const submitButton = $('#submit-button');

    form.on('submit', async function (e) {
        e.preventDefault();
        PayTaskId =  $('#payment_task_id').val();
      
        submitButton.prop('disabled', true); // Disable the button

        // Create a Payment Method
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });

        if (error) {
            console.error(error);
            submitButton.prop('disabled', false); // Re-enable the button if there's an error
        } else {
            // If payment method creation is successful
            $('#payment-method').val(paymentMethod.id);

            // Use jQuery AJAX to submit the form
           
            $.ajax({
                url: '/api/v1/tasks/'+PayTaskId+'/pay', // Use the form's action attribute as the URL
                method: 'POST',
                data: form.serialize(), // Serialize the form data
                success: function (response) {
                    // Handle the success response here
                    console.log('Payment successful:', response);
                    if(response.success ==true){
                        completepayment();
                    }
                    else{
                        $('#payment-msg').html('<p style="color: red;">'+response.error+' </p>');  
                    }
                    submitButton.prop('disabled', false); // Re-enable the button if needed
                },
                error: function (xhr, status, error) {
                    // Handle any errors here
                    console.error('Payment error:', error);
                    $('#payment-msg').html('<p style="color: red;">'+error+' </p>');
                    submitButton.prop('disabled', false); // Re-enable the button if needed
                }
            });
        }
    });



    });




    function completeprocess(){
        $('#task_status').html('<img src="/icons/done.png" style="    width: 39px;"><h4>Task is Complete.  </h4> ');

$('#actions').hide();
$('.remove-row').hide();

$('#user_list').closest('button').hide();
$('#user_select').hide();
$('.update-btn').hide();
    }

    function completepayment(){
        $('#task_payment_card').html('<img src="/icons/done.png" style="    width: 39px;"><h4>Task Payment is Complete.  </h4> ');
    }
</script>



    <script>
        
    </script>


@include('modals.taskstatus')
@endsection
