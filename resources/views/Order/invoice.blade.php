<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Order Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ public_path('resp/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ public_path('resp/css/invoice.css') }}" rel="stylesheet" />
</head>


<body>
        <div class="page-content container">
            <div class="page-header text-blue-d2">
                <h1 class="page-title text-secondary-d1">
                    Invoice:
                    <small class="page-info">
                        <i class="fa fa-angle-double-right text-40"></i>
                       {{ $data['order']->uuid }}
                    </small>
                </h1>
            </div>

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

            @include('Order.orderProductList', ['data' => $data])
        </div>
</body>

</html>
