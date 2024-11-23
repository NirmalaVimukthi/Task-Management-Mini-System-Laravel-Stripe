<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Task;

use App\Mail\CompleteMail;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['users', 'creator'])->get();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:High,Medium,Low',
            'is_completed' => 'sometimes|boolean',
            'is_paid' => 'sometimes|boolean',
         
        ]);

    
        
        $task = Task::create($validatedData);

        // If user_ids are provided, attach them to the task
        if ($request->has('userIds')) {
            $task->users()->attach($request->userIds);
        }

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    
    }

    // GET /tasks/{id} - Retrieve a specific task
    public function show($id)
    {
        $task = Task::with(['users', 'creator'])->find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
       // return response()->json(['message' => 'Task not found'], 404);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:High,Medium,Low',
            'is_completed' => 'sometimes|boolean',
            'is_paid' => 'sometimes|boolean',
         
        ]);

        $task->update($validatedData);

        // If user_ids are provided, sync them with the task
        if ($request->has('userIds')) {
            $task->users()->sync($request->userIds);
        }

        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }


            /**
     * Remove the specified resource from storage.
     */
    public function complete(string $id)
    {
        $task = Task::with(['users', 'creator'])->find($id);

      

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        //email notification send
        foreach( $task->users as $user){
            Mail::to($user->email)->send(new CompleteMail($task));

        }

        $task->update(['is_completed'=>true]);

        return response()->json(['message' => 'Task deleted successfully']);
    }




    public function pay(request $request, string $id)
    {
     
        $task = Task::with(['users', 'creator'])->find($id);

      

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
       
        $paymentMethod = $request->paymentMethod;

       
    
        $user_id = $request->user_id;
        $user = User::find($user_id);
           
          
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
   

            $paymentMethod = $request->paymentMethod;

            // Set your Stripe API key
            Stripe::setApiKey(config('services.stripe.secret'));
    
            try {
                // Create a PaymentIntent with automatic payment methods enabled and no redirects
                $paymentIntent = PaymentIntent::create([
                    'amount' => 1000, // Amount in cents (e.g., $10.00)
                    'currency' => 'usd',
                    'payment_method' => $paymentMethod,
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    'automatic_payment_methods' => [
                        'enabled' => true,
                        'allow_redirects' => 'never', // Disabling redirects
                    ],
                ]);


               
              
    
                // Check if the payment requires additional action
                if ($paymentIntent->status === 'requires_action' || $paymentIntent->status === 'requires_source_action') {
                 
                    return response()->json(['error' =>  'Payment requires further action','success'=>false]);
                }
           
                $task->update(['is_paid'=>true]);
            return response()->json(['message' => 'payment successfully','success'=>true]);
       
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage(),'success'=>false]);
           
        }

       
    }





}
