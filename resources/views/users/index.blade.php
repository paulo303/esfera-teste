<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Usuários
        </h2>
    </x-slot>

    <x-container-page>
        @can('create', \App\Models\User::class)
            @include('users.partials.create-user-form')

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700 my-8">
        @endcan

        <h4 class="text-2xl font-bold dark:text-white mb-4">
            Lista de usuários
        </h4>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Nome</x-table.th>
                    <x-table.th>E-mail</x-table.th>
                    <x-table.th>Tipo de usuário</x-table.th>
                    <x-table.th>Telefones</x-table.th>
                    <x-table.th>Ações</x-table.th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <x-table.tr>
                        <x-table.td>{{ $user->id }}</x-table.td>
                        <x-table.td>{{ $user->name }}</x-table.td>
                        <x-table.td>{{ $user->email }}</x-table.td>
                        <x-table.td>{{ $user->role->name }}</x-table.td>
                        <x-table.td class="whitespace-nowrap">{!! $user->phoneNumbers->implode('phone_number', '<br>') !!}</x-table.td>
                        <x-table.td>
                            @can('delete', $user)
                                <button id="deleteEditButton" title="Excluir usuário" data-modal-target="deleteUserModal" data-modal-toggle="deleteUserModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 7l16 0"/>
                                        <path d="M10 11l0 6"/>
                                        <path d="M14 11l0 6"/>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                    </svg>
                                </button>
                            @endcan
                        </x-table.td>
                    </x-table.tr>
                @empty
                    <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th colspan="6" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nenhum registro encontrado
                        </th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </x-container-page>

    @can('create', \App\Models\User::class)
        @include('users.partials.delete-user-modal')
    @endcan

    @push('scripts')
        <script>
            $(function () {
                function validatePhone() {
                    let newPhoneNumber = $(".phone_number").val();

                    if (newPhoneNumber.length < 14) {
                        return false;
                    }
                    return $(".phone_number").inputmask("isComplete");
                }

                $('.addPhoneButton').on('click', function () {
                    let newPhoneNumber = $(".phone_number").val();

                    if (!validatePhone()) {
                        alert("Telefone inválido! Preencha corretamente.");
                        return false;
                    }

                    let phoneFields = '<div class="flex items-center grid grid-cols-2 mt-4">' +
                        '<input type="text" readonly value="' + newPhoneNumber + '" name="phone_numbers[]" class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">' +
                        '<button type="button" class="removePhoneButton text-left ml-4">Remover</button>' +
                        '</div>';

                    $('.phone_number').val('');

                    $('#phone_numbers_container').append(phoneFields);
                });

                $(document).on('click', '.removePhoneButton', function () {
                    $(this).parent().remove();
                });

                $(document).on('submit', '#createUserForm', function (event) {
                    if (!validatePhone()) {
                        alert("Telefone inválido! Preencha corretamente.");
                        event.preventDefault();
                    }
                })

                $(document).on('click', '#deleteEditButton', function (event) {
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let url = '{{ route('users.destroy', ['user' => '_id_']) }}'.replace('_id_', id);

                    $("#deleteUserForm").attr('action', url);
                    $("#user-name").text(name);
                })
            });
        </script>
    @endpush
</x-app-layout>
