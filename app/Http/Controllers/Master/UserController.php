<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
   public function index(Request $request)
{
    // Jika request berasal dari DataTables
    if ($request->ajax()) {

        $query = User::query();

        // ==============================
        // SEARCH DATATABLES
        // ==============================
        if ($request->filled('search.value')) {

            $search = $request->input('search.value');

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");

            });
        }

        // ==============================
        // TOTAL DATA SEBELUM FILTER
        // ==============================
        $recordsTotal = User::count();

        // ==============================
        // TOTAL DATA SETELAH FILTER
        // ==============================
        $recordsFiltered = $query->count();

        // ==============================
        // SORTING
        // ==============================
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'username',
            3 => 'email',
            4 => 'role',
            5 => 'is_active',
            6 => 'last_login_at',
        ];

        $orderColumnIndex = $request->input('order.0.column', 1);
        $orderDirection = $request->input('order.0.dir', 'asc');

        $orderColumn = $columns[$orderColumnIndex] ?? 'name';

        $query->orderBy($orderColumn, $orderDirection);

        // ==============================
        // PAGINATION
        // ==============================
        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $users = $query->get();

        // ==============================
        // FORMAT DATA
        // ==============================
        $data = [];

        foreach ($users as $index => $user) {

            // ROLE
            if ($user->role == 'admin') {

                $role = '<span class="badge bg-danger">Admin</span>';

            } elseif ($user->role == 'guru') {

                $role = '<span class="badge bg-success">Guru</span>';

            } elseif ($user->role == 'siswa') {

                $role = '<span class="badge bg-primary">Siswa</span>';

            } else {

                $role = '<span class="badge bg-secondary">'
                      . e(ucfirst($user->role))
                      . '</span>';
            }

            // STATUS
            if ($user->is_active) {

                $status = '<span class="badge bg-success">Aktif</span>';

            } else {

                $status = '<span class="badge bg-secondary">Nonaktif</span>';
            }

            // LOGIN TERAKHIR
            $lastLogin = $user->last_login_at
                ? $user->last_login_at->format('d-m-Y H:i')
                : '<span class="text-muted">Belum pernah login</span>';

            // AKSI
            $aksi = '';

            $aksi .= '
                <a href="' . route('users.edit', $user->id) . '"
                   class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
            ';

            $aksi .= '
                <button type="button"
                        class="btn btn-danger btn-sm btn-hapus-user"
                        data-id="' . $user->id . '"
                        data-nama="' . e($user->name) . '">
                    <i class="fas fa-trash"></i>
                    Hapus
                </button>
            ';

            $data[] = [
                'DT_RowIndex' => $start + $index + 1,
                'name' => e($user->name),
                'username' => e($user->username ?? '-'),
                'email' => e($user->email ?? '-'),
                'role' => $role,
                'status' => $status,
                'last_login' => $lastLogin,
                'aksi' => $aksi,
            ];
        }

        return response()->json([
            'draw' => (int) $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    // Jika dibuka secara normal
    return view('users.index');
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