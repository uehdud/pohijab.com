<x-planet-layout>
    <div class="card-group">
        <div class="card">

            <div class="card-body">
                @livewire('gudang.retur-online')
            </div>
        </div>


        <div class="card">

            <div class="card-body">
                @livewire('gudang.cart-retur-online')
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            @livewire('gudang.list-retur-online')
        </div>
    </div>
</x-planet-layout>