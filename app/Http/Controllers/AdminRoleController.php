<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{
    /**
     * Show students/users.
     */
    public function index()
    {
        $students = DB::table('students')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.users', compact('students'));
    }

    /**
     * Update student role.
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => [
                'required',
                'in:user,teacher,admin'
            ],
        ]);

        DB::table('students')
            ->where('id', $id)
            ->update([
                'role' => $request->role,
                'updated_at' => now(),
            ]);

        return back()->with(
            'success',
            'User role updated successfully.'
        );
    }
}