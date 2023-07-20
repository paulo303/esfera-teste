<script>
    const handlePhone = (event) => {
        let input = event.target
        input.value = phoneMask(input.value)
    }


    const phoneMask = (value) => {
        if (!value) return ""
        value = value.replace(/\D/g,'')
        value = value.replace(/(\d{2})(\d)/,"($1) $2")
        value = value.replace(/(\d)(\d{4})$/,"$1-$2")
        return value
    }
</script>
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h4 class="text-2xl font-bold dark:text-white mb-4">
            Cadastrar usuário
        </h4>

        <form id="createUserForm" action="{{ route('users.store') }}" method="POST">
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
                    <x-form.input label="Telefone (apenas números)" name="phone_numbers[]" placeholder="(11) 99999-9999" class="phone_number" type="tel" maxlength="15" onkeyup="handlePhone(event)"/>
                    <x-secondary-button class="addPhoneButton text-left ml-4 mt-3" >Adicionar outro número</x-secondary-button>
                </div>
            </div>

            <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
                <div id="phone_numbers_container">
                </div>
            </div>

            <x-primary-button for="createUserForm" id="createUserSubmitButton" type="submit" class="mt-4">Salvar</x-primary-button>
        </form>

    </div>
</div>
