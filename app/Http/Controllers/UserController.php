<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\{Role, User};
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
            return to_route('users.index');
        }


        return to_route('users.index');
    }

    public function edit(User $user): View
    {
        $roles = Role::pluck('name', 'id');
        
        return view('partials.edit-user-modal', compact(['user', 'roles']));
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);
        
        $user->delete();
        
        return to_route('users.index');
    }
}
