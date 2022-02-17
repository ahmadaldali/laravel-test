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
            @include('Order.orderProductList', ['data' => $data])
        </div>
</body>

</html>
