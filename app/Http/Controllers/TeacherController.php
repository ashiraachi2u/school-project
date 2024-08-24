<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of teachers for dropdown.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        // Fetch all teachers from the database
        $teachers = Teacher::all();

        // Return the teachers as JSON
        return response()->json(['teachers' => $teachers]);
    }
}