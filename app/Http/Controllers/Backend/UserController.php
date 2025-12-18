<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users.index');
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        // Handle user creation
        return redirect()->route('backend.users.index')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        return view('backend.users.show', compact('id'));
    }

    public function edit($id)
    {
        return view('backend.users.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Handle user update
        return redirect()->route('backend.users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        // Handle user deletion
        return redirect()->route('backend.users.index')->with('success', 'User deleted successfully');
    }
}

