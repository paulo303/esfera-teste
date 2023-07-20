@if (session('success'))
    <x-alerts.success>
        {{ session('success') }}
    </x-alerts.success>
@endif

@if (session('danger'))
    <x-alerts.danger>
        {{ session('danger') }}
    </x-alerts.danger>
@endif

@if (session('warning'))
    <x-alerts.warning>
        {{ session('warning') }}
    </x-alerts.warning>
@endif

@if (session('info'))
    <x-alerts.info>
        {{ session('info') }}
    </x-alerts.info>
@endif
