<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Order Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--  	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />  --}}
    <link href="{{ asset('resp/css/invoice.css') }}" rel="stylesheet" />
</head>


<body>
        <div class="page-content container">
            <div class="page-header text-blue-d2">
                <h1 class="page-title text-secondary-d1">
                    Invoice
                    <small class="page-info">
                        <i class="fa fa-angle-double-right text-80"></i>
                        ID: #111-222
                    </small>
                </h1>
            </div>
            @include('Order.orderProductList', ['order' => $order])
        </div>
</body>

</html>
