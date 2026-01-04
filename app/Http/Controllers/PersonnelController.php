<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnel = User::where('role', 'personnel')->orderBy('name')->paginate(15);
        return view('personnel.index', compact('personnel'));
    }

    public function create()
    {
        return view('personnel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'personnel'
        ]);

        return redirect()->route('personnel.index')
            ->with('success', 'Personnel ajouté avec succès');
    }

    public function edit(User $personnel)
    {
        return view('personnel.edit', compact('personnel'));
    }

    public function update(Request $request, User $personnel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $personnel->id,
        ]);

        $personnel->update($request->only(['name', 'email']));

        return redirect()->route('personnel.index')
            ->with('success', 'Personnel modifié avec succès');
    }

    public function destroy(User $personnel)
    {
        $personnel->delete();
        return redirect()->route('personnel.index')
            ->with('success', 'Personnel supprimé avec succès');
    }
}