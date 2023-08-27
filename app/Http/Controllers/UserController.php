<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $s = $request->input('s');

        $users = User::where('id', '!=', auth()->id())
            ->where(function ($query) use ($s) {
                if ($s) {
                    $query->orWhere('id', 'LIKE', '%' . $s . '%')
                        ->orWhere('name', 'LIKE', '%' . $s . '%')
                        ->orWhere('email', 'LIKE', '%' . $s . '%')
                        ->orWhere('identification_number', 'LIKE', '%' . $s . '%')
                        ->orWhere('phone', 'LIKE', '%' . $s . '%');
                }
            })->sortable()->paginate(20, ['id', 'name', 'email', 'phone', 'identification_number', 'date_of_birth', 'city_code']);

        $users->appends(['s' => $s]);

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone'  => ['numeric', 'digits:10'],
            'date_of_birth' => ['required', 'date', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'city_code' =>['required','numeric','digits:6'],
        ]);

        $user->update([
            'name' =>$request->name ,
            'phone'  =>$request->phone ,
            'date_of_birth' => $request->date_of_birth,
            'city_code' =>$request->city_code,
        ]);

        return redirect()->route('users.edit', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
