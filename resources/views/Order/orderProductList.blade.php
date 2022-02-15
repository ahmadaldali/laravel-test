<div class="container px-0">
    <div class="row mt-4">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <span class="text-sm text-grey-m2 align-middle">To:</span>
                        <span class="text-600 text-110 text-blue align-middle">Alex Doe</span>
                    </div>
                    <div class="text-grey-m2">
                        <div class="my-1">
                            Street, City
                        </div>
                        <div class="my-1">
                            State, Country
                        </div>
                        <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">111-111-111</b></div>
                    </div>
                </div>

                <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                    <hr class="d-sm-none" />
                    <div class="text-grey-m2">
                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                            Invoice
                        </div>

                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #111-222</div>

                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> Oct 12, 2019</div>

                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">Unpaid</span></div>
                    </div>
                </div>
                
            </div>
            
            <div class="mt-4">
                <div class="row text-600 text-white bgc-default-tp1 py-25">
                    <div class="d-none d-sm-block col-1">#</div>
                    <div class="col-9 col-sm-5">Description</div>
                    <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                    <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                    <div class="col-2">Amount</div>
                </div>

                <div class="text-95 text-secondary-d3">
                    @foreach($order['products_details'] as $item)
                    <div class="row mb-2 mb-sm-0 py-25">
                        <div class="d-none d-sm-block col-1">{{ $item['index'] }}</div>
                        <div class="col-9 col-sm-5">{{ $item['description'] }}</div>
                        <div class="d-none d-sm-block col-2">{{ $item['Qty'] }}</div>
                        <div class="d-none d-sm-block col-2 text-95">{{ $item['price'] }}</div>
                        <div class="col-2 text-secondary-d2">{{ $item['amount'] }}</div>
                    </div>
                    @endforeach
                </div>

                <div class="row border-b-2 brc-default-l2"></div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                        Extra note such as company or payment information...
                    </div>

                    <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                        <div class="row my-2">
                            <div class="col-7 text-right">
                                SubTotal
                            </div>
                            <div class="col-5">
                                <span class="text-120 text-secondary-d1">$ {{ $order['sub_total'] }}</span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-7 text-right">
                                Delivery Fee
                            </div>
                            <div class="col-5">
                                <span class="text-110 text-secondary-d1">$ {{ $order['delivery_fee'] }}</span>
                            </div>
                        </div>

                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                            <div class="col-7 text-right">
                                Total Amount
                            </div>
                            <div class="col-5">
                                <span class="text-150 text-success-d3 opacity-2">$ {{ $order['total_amount'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>