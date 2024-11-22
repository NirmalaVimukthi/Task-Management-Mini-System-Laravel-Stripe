<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
   
    public function getAllUsers()
    {
        try {
            // Fetch all users - Adjust the fields as necessary
            $users = User::select('id', 'name')->get();

            // Return users in JSON format
            return response()->json([
                'success' => true,
                'data' => $users,
                'message' => 'Users load successfully.',
            ], 200);

        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'Failed to load users.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
