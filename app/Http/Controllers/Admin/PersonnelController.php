<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnels = User::where('role', 'personnel')->get();
        return view('admin.personnel.index', compact('personnels'));
    }

    public function create()
    {
        return view('admin.personnel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Générer un username automatiquement
        $username = strtolower(str_replace(' ', '.', $request->name));
        $originalUsername = $username;
        $counter = 1;
        
        // Vérifier l'unicité du username
        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }

        User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'personnel',
        ]);

        return redirect()->route('admin.personnel.index')
            ->with('success', 'Personnel créé avec succès. Username: ' . $username);
    }

    public function show(User $personnel)
    {
        return view('admin.personnel.show', compact('personnel'));
    }

    public function edit(User $personnel)
    {
        return view('admin.personnel.edit', compact('personnel'));
    }

    public function update(Request $request, User $personnel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $personnel->id,
        ]);

        $personnel->update($request->only(['name', 'email']));

        return redirect()->route('admin.personnel.index')->with('success', 'Personnel mis à jour');
    }

    public function destroy(User $personnel)
    {
        $personnel->delete();
        return redirect()->route('admin.personnel.index')->with('success', 'Personnel supprimé');
    }
}