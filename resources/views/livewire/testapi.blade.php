<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="">
                    <div class="px-6 py-6">
                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('NO PO') }}" />
                            <x-jet-input wire:model="noPO" id="text" class="block mt-1 w-full" required autocomplete="current-password" />
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('KB') }}" />
                            <x-jet-input wire:model="kodebarang" id="text" class="block mt-1 w-full" required autocomplete="current-password" />
                        </div>
                    </div>
                    <div class="py-6">
                        <x-jet-button wire:click.prevent="store" class=" ml-4">
                            {{ __('Submit') }}
                        </x-jet-button>
                    </div>

                </form>
                <div class="m-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">BAHAN</th>
                                <th scope="col">KB</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($data as $item)
                            <tr>
                                <td>{{ $item->product_id }}</td>
                                <td>{{ $item->bahan }}</td>
                                <td>{{ $item->KB }}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger" wire:click.prevent="delete({{ $item['id'] }})">-</button>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>


                    {{ $noPO }}

                </div>

            </div>
        </div>
    </div>
</div>