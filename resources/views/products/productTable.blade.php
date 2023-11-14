<table class="table">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="selectAll">
            </th>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    <input type="checkbox" class="productCheckbox" data-product-id="{{ $product->id }}">
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<button id="deleteSelected" class="btn btn-danger">Delete Selected</button>