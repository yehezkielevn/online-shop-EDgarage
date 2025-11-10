<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $transactions = $user->transactions()->with('product')->latest()->paginate(10);
        return view('admin.users.show', compact('user', 'transactions'));
    }
}
