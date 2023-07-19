<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h4 class="text-2xl font-bold dark:text-white mb-4">
            Cadastrar usuário
        </h4>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="grid gap-4 grid-cols-1 md:grid-cols-3">
                <div>
                    <x-form.input label="Nome" name="name" required/>
                </div>
                <div>
                    <x-form.input label="E-mail" name="email" type="email" required/>
                </div>
                <div>
                    <x-form.select label="Tipo de usuário" name="role_id" :options="$roles" required/>
                </div>
                <div>
                    <x-form.input label="Senha" name="password" type="password" placeholder="No mínimo 8 caracteres" required/>
                </div>
                <div>
                    <x-form.input label="Confirmação de senha" name="password_confirmation" type="password" placeholder="Repita a senha" required/>
                </div>
            </div>

            <!-- Campos dos números de telefone -->
            <div class="grid gap-4 grid-cols-1 sd:grid-cols-3 mt-4">
                <div class="flex items-center" id="divAddNewPhoneNumber">
                    <x-form.input label="Digite o telefone e clique em adicionar" name="phone_numbers[]" class="phone_number"/>
                    <button type="button" class="addPhoneButton text-left ml-4 mt-3">Adicionar outro número</button>
                </div>
            </div>

            <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
                <div id="phone_numbers_container">
                </div>
            </div>
            
            <x-primary-button type="submit" class="mt-4">Salvar</x-primary-button>
        </form>

    </div>
</div>