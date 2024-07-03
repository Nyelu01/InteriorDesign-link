<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-3">
                <h2><b>Frame of budget</b></h2>
                @if ($items->isNotEmpty())
                    <p>Designer's name: <b>{{ $items->first()->designer->name }}</b></p>
                    <p>Designer's phone: <b>{{ $items->first()->designer->phone }}</b></p>
                    <p>Client's Name: <b>{{ $items->first()->requirement->client->name }}</b></p>
                    <table class="table" style="border-collapse: collapse; width: 100%;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #4f5052; padding: 8px;">Name</th>
                                <th style="border: 1px solid #4f5052; padding: 8px;">Type</th>
                                <th style="border: 1px solid #4f5052; padding: 8px;">Description</th>
                                <th style="border: 1px solid #4f5052; padding: 8px;">Quantity</th>
                                <th style="border: 1px solid #4f5052; padding: 8px;">Unit Price</th>
                                <th style="border: 1px solid #4f5052; padding: 8px;">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td style="border: 1px solid #4f5052; padding: 8px;">{{ $item->name }}</td>
                                    <td style="border: 1px solid #4f5052; padding: 8px;">{{ $item->type }}</td>
                                    <td style="border: 1px solid #4f5052; padding: 8px;">{{ $item->description }}</td>
                                    <td style="border: 1px solid #4f5052; padding: 8px;">{{ $item->quantity }}</td>
                                    <td style="border: 1px solid #4f5052; padding: 8px;">{{ $item->unit_price }}</td>
                                    <td style="border: 1px solid #4f5052; padding: 8px;">{{ $item->total_price }}</td>
                                    <td>
                                        @include('designer.pages.BudgetItem.deleteItem')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">Estimated Budget: {{ $totalBudget }} <b>Tzs</b></th>
                            </tr>
                        </tfoot>
                    </table>
                @else
                    <p class="text-center">No items found</p>
                @endif
            </div>
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotalPrice() {
            const quantity = parseFloat(document.getElementById('quantity').value) || 0;
            const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
            const totalPrice = quantity * unitPrice;
            document.getElementById('total_price').value = totalPrice;
        }

        document.getElementById('quantity').addEventListener('input', calculateTotalPrice);
        document.getElementById('unit_price').addEventListener('input', calculateTotalPrice);
    });
</script>
