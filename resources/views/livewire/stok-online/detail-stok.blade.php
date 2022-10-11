<div>
    @if($cekdatastok===1)
    <table class="table table-sm text-sm text-center mb-0" style="text-decoration: none;">
        <thead>
            <tr>
                <th colspan="6">Stok</th>
            </tr>
            <tr>
                <th>Allsize</th>
                <th>S</th>
                <th>M</th>
                <th>L</th>
                <th>XL</th>
                <th>XXL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $itemallsize }}</td>
                <td>{{ $items }}</td>
                <td>{{ $itemm }}</td>
                <td>{{ $iteml }}</td>
                <td>{{ $itemxl }}</td>
                <td>{{ $itemxxl }}</td>
            </tr>
        </tbody>
    </table>
    @else
    <h5>Stok Habis</h5>
    @endif
</div>