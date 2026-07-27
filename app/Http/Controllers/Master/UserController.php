<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
{
    $users = User::query();

    // Search
    if ($request->filled('search')) {

        $search = $request->search;

        $users->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('username', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");

        });
    }

    // Filter Role
    if ($request->filled('role')) {

        $users->where('role', $request->role);

    }

    // Filter Status
    if ($request->filled('status')) {

        $users->where('is_active', $request->status);

    }

    $users = $users
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();

    return view('users.index', compact('users'));
}

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required|string|max:255',

    'username' => 'required|string|max:100|unique:users,username',

    'email' => 'required|email|max:255|unique:users,email',

    'password' => 'required|string|min:8|confirmed',

    'role' => 'required|in:admin,guru,siswa',

    'is_active' => 'required|boolean',
]);

        User::create([
    'name' => $request->name,

    'username' => $request->username,

    'email' => $request->email,

    'password' => Hash::make($request->password),

    'role' => $request->role,

    'is_active' => $request->is_active,
]);

        return redirect('/users')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:100|unique:users,username,' . $id,
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|in:admin,guru,siswa',
        'is_active' => 'required|boolean',
    ]);

    $data = [
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'role' => $request->role,
        'is_active' => $request->is_active,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('users.index')
    ->with('success', 'User berhasil diupdate!');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cegah menghapus admin terakhir
        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('users.index')->with('error', 'Tidak bisa menghapus admin terakhir!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}