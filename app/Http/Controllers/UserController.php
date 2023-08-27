<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Controlador para la lista de todos los usuarios, con el buscador, sortable para ordenar las columnas y la paginación de 20 registros por página.
        $s = $request->input('s');

        try {
            $users = User::where('id', '!=', auth()->id())
                ->where(function ($query) use ($s) {
                    if ($s) {
                        $query->orWhere('id', 'LIKE', '%'.$s.'%')
                            ->orWhere('name', 'LIKE', '%'.$s.'%')
                            ->orWhere('email', 'LIKE', '%'.$s.'%')
                            ->orWhere('identification_number', 'LIKE', '%'.$s.'%')
                            ->orWhere('phone', 'LIKE', '%'.$s.'%')
                            ->orWhere('city_code', 'LIKE', '%'.$s.'%');
                    }
                })->sortable()->paginate(20, ['id', 'name', 'email', 'phone', 'identification_number', 'date_of_birth', 'city_code']);

            $users->appends(['s' => $s]);

            Log::info('Consulta exitosa para la lista de usuarios.', ['search' => $s]);

            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error al obtener la lista de usuarios.', ['error' => $e->getMessage(), 'search' => $s]);
        }
    }

    public function edit(User $user)
    {
        // La vista de la edición de usuario
        Log::info('Acceso a la vista de edición de usuario.', ['user_id' => $user->id]);

        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        // Las reglas de validación se encuentran en el archivo UserUpdateRequest
        try {
            $user->update($request->validated());

            Log::info('Usuario actualizado exitosamente.', ['user_id' => $user->id]);

            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Log::error('Error al actualizar usuario.', ['user_id' => $user->id, 'error' => $e->getMessage()]);

            return back()->with('error', 'Error al actualizar usuario.');
        }
    }

    public function destroy(User $user)
    {
        // Destruir un registro de la tabla users
        try {
            $user->delete();

            Log::info('Usuario eliminado exitosamente.', ['user_id' => $user->id]);

            return back();
        } catch (\Exception $e) {
            Log::error('Error al eliminar usuario.', ['user_id' => $user->id, 'error' => $e->getMessage()]);

            return back()->with('error', 'Error al eliminar usuario.');
        }
    }
}
