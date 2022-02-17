
                <div class="table-responsive">
                    <table class="table table-striped table-borderless border-0 border-b-2">
                        <thead class="bg-none">
                            <tr class="text-white">
                                <th class="opacity-2"></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="text-95 text-secondary-d3">
                            <tr></tr>
                            <tr>
                                <td> <span class="text-sm text-grey-m2 align-middle">To: </span>
                                    <span class="text-600 text-110 text-blue align-middle">{{ $data['customer']->first_name . ' ' . $data['customer']->last_name }}</span>
                                    <br>
                                    <span class="text-sm text-grey-m2 align-middle">Email: </span>{{ $data['customer']->email }}
                                    <br>
                                    <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    <span class="text-600 text-90">
                                    Status:</span>
                                    @if($data['order_type'] == 'paid')
                                    <span class="badge badge-success badge-pill px-25">
                                    @else
                                    <span class="badge badge-warning badge-pill px-25">
                                    @endif
                                    {{ $data['order_type']}}</span>
                                </td>
                                <td>
                                    <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    <span class="text-600 text-90">Issue Date:</span> {{ $data['order']->created_at }}
                                    <br>
                                    <span class="text-sm text-grey-m2 align-middle">Billing Address: </span> {{ $data['order']->address['billing'] }}
                                    <br>
                                    <span class="text-sm text-grey-m2 align-middle">Shipping Address: </span>  {{ $data['order']->address['shipping'] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

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


