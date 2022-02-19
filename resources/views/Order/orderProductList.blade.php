

            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        @foreach($data['details']['products_details'] as $item)
                        <tr>
                            <td>{{ $item['index'] }}</td>
                            <td>{{ $item['description'] }}</td>
                            <td>{{ $item['Qty'] }}</td>
                            <td class="text-95">{{ $item['price'] }}</td>
                            <td class="text-secondary-d2">{{ $item['amount'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none">
                        <tr class="text-white">
                            <th class="opacity-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <tr>
                            <td>
                            <div class="text-right">
                                <span class="text-600 text-90">
                                    SubTotal: </span>
                                <span class="text-100 text-secondary-d1">$ {{ $data['details']['sub_total'] }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-600 text-90">
                                    Delivery Fee: </span>
                                <span class="text-100 text-secondary-d1">$ {{ $data['details']['delivery_fee'] }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-600 text-90">
                                    Total Amount: </span>
                                <span class="text-100 text-secondary-d1">$ {{ $data['details']['total_amount'] }}</span>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


