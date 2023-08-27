<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //controlador para la lista de todos los usuarios, con el buscador, sortable para ordenar las columnas y la paginacion de 20 registros por pagina.
        $s = $request->input('s');

        $users = User::where('id', '!=', auth()->id())
            ->where(function ($query) use ($s) {
                if ($s) {
                    $query->orWhere('id', 'LIKE', '%' . $s . '%')
                        ->orWhere('name', 'LIKE', '%' . $s . '%')
                        ->orWhere('email', 'LIKE', '%' . $s . '%')
                        ->orWhere('identification_number', 'LIKE', '%' . $s . '%')
                        ->orWhere('phone', 'LIKE', '%' . $s . '%')
                        ->orWhere('city_code', 'LIKE', '%' . $s . '%');
                }
            })->sortable()->paginate(20, ['id', 'name', 'email', 'phone', 'identification_number', 'date_of_birth', 'city_code']);

        $users->appends(['s' => $s]);

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        //la vista de la edición de usuario
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        //las reglas de validación se encuentran en el archivo UserUpdateRequest
        $user->update($request->validated());

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        //destruir un registro de la tabla users
        $user->delete();

        return back();
    }
}
