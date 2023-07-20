<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\{Role, User};
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with(['phoneNumbers'])->paginate()->withQueryString();
        $roles = Role::pluck('name', 'id');

        return view('users.index', compact(['users', 'roles']));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        try {
            DB::beginTransaction();

            $user = User::create($request->validated());

            $phoneNumbers = array_filter($request->input('phone_numbers'));

            foreach ($phoneNumbers as $phoneNumber) {
                $user->phoneNumbers()->create(['phone_number' => $phoneNumber]);
            }

            DB::commit();

        } catch (Exception $e) {
            DB::Rollback();

            return to_route('users.index')->with('danger', 'Falha ao criar usuário!');
        }

        return to_route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return to_route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
