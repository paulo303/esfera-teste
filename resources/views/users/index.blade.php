<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('create', \App\Models\User::class)
                @include('partials.create-user-form')

                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700 my-8">
            @endcan

            <h4 class="text-2xl font-bold dark:text-white mb-4">
                Lista de usuários
            </h4>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            E-mail
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Tipo de usuário
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Telefones
                        </th>
                        <th class="px-6 py-3 text-center">
                            Ações
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->id }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $user->role->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {!! $user->phoneNumbers->implode('phone_number', '<br>') !!}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button id="deleteEditButton" title="Excluir usuário" data-modal-target="deleteUserModal" data-modal-toggle="deleteUserModal" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" colspan="6" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Nenhum registro encontrado
                            </th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>

    @can('create', \App\Models\User::class)
{{--        @include('partials.edit-user-modal')--}}
        @include('partials.delete-user-modal')
    @endcan

    @push('scripts')
        <script>
            $(function() {
                // $('.phone_numbers').inputmask('(999)-999-9999');

                $('.addPhoneButton').on('click', function() {
                    let newPhoneNumber = $(".phone_number").val();
                    let phoneFields = '<div class="flex items-center grid grid-cols-2 mt-4">' +
                        '<input type="text" readonly value="' + newPhoneNumber + '" name="phone_numbers[]" class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">' +
                        '<button type="button" class="removePhoneButton text-left ml-4">Remover</button>' +
                        '</div>';

                    $('.phone_number').val(''); 

                    $('#phone_numbers_container').append(phoneFields);
                });

                $(document).on('click', '.removePhoneButton', function() {
                    $(this).parent().remove();
                });
                
                {{--$(".editUserButton").on('click', function(event) {--}}
                {{--    event.preventDefault();--}}
                {{--    let id = $(this).data('id');--}}
                {{--    let url = '{{ route('users.edit', ['user' => '_id_']) }}'.replace('_id_', id);--}}

                {{--    $.ajax({--}}
                {{--        url: url,--}}
                {{--        beforeSend: function() {--}}
                {{--            $('#loader').show();--}}
                {{--        },--}}
                {{--        // return the result--}}
                {{--        success: function(result) {--}}
                {{--            $('#mediumModal').modal("show");--}}
                {{--            $('#mediumBody').html(result).show();--}}
                {{--        },--}}
                {{--        complete: function() {--}}
                {{--            $('#loader').hide();--}}
                {{--        },--}}
                {{--        error: function(jqXHR, testStatus, error) {--}}
                {{--            console.log(error);--}}
                {{--            alert("Page " + href + " cannot open. Error:" + error);--}}
                {{--            $('#loader').hide();--}}
                {{--        },--}}
                {{--        timeout: 8000--}}
                {{--    })--}}
                {{--    --}}
                {{--    --}}{{--let id = $(this).data('id');--}}
                {{--    --}}{{--let name = $(this).data('name');--}}
                {{--    --}}{{--let email = $(this).data('email');--}}
                {{--    --}}{{--let role_id = $(this).data('role_id');--}}
                {{--    --}}{{--let url = '{{ route('users.update', ['user' => '_id_']) }}'.replace('_id_', id);--}}
                {{--    --}}
                {{--    --}}{{--$("#editUserForm #name").val(name);--}}
                {{--    --}}{{--$("#editUserForm #email").val(email);--}}
                {{--    --}}{{--$("#editUserForm #role_id").val(role_id);--}}
                {{--    --}}{{--$("#editUserForm").attr('action', url);--}}
                {{--});--}}
            });
        </script>
    @endpush
</x-app-layout>
