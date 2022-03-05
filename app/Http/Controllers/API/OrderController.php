<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Order_Statuse;
use App\Models\User;
use App\Traits\ListsResult;
use App\Traits\OrderProductData;
use App\Traits\SaveJson;
use Exception;
use Illuminate\Support\Facades\Log;
use PDF;


class OrderController extends Controller
{
    use SaveJson;
    use orderProductData;
    use ListsResult;

    /**
     * @param OrderRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @todo: try to create an order record
     */
    public function create(OrderRequest $request)
    {
        try {
            // validation data
            $validatedData = $request->validated();
            //get uuid of the current user
            $validatedData['user_uuid'] = User::getLoggedUser()->uuid;
            //decode the json data
            $validatedData['products'] = $this->convertJsonToObject($validatedData['products']);
            $validatedData['address'] = $this->convertJsonToObject($validatedData['address']);
            //get the details of the order's products,
            //in the same time, validation for products
            //cuz, if we will pass each product,
            //so we can discover if there is a wrong product or not
            $order = $this->getDetails($validatedData['products']);
            //count = 0 mean, there is a fake product
            if (count($order) == 0) {
                return response([], 422);
            }
            //set the  delivery fee
            $validatedData['delivery_fee'] = $order['delivery_fee'];
            //calculate the sub total amount
            $validatedData['amount'] = $order['sub_total'];
            //add order_statuse_uuid to the data instead of order_status_uuid,
            //cuz, the column in my DB is order_statuse_uuid
            //of course, I can re-change the migration, or create a new migration to alter the name
            //but here I provide another solution
            $validatedData['order_statuse_uuid'] = $validatedData['order_status_id'];
            //the same thing for payment id, if exist
            $validatedData['payment_uuid'] = array_key_exists(
                'payment_id',
                $validatedData
            ) ? $validatedData['payment_id'] : null;
            unset($validatedData['order_status_id']);
            unset($validatedData['payment_id']);
            //save the order in the DB
            $order = Order::saveOrder($validatedData);
            //check no error during the save
            if ($order == null) {
                throw new Exception('error');
            }
            return response(['message' => 'Order created successfully'], 200);
        } catch (Exception $e) {
            Log::info('error in create/order controller: ' . $e->getMessage());
            return response([], 500);
        } //catch
    } //create

    /**
     * @param ListRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @todo: get all orders
     */
    public function getAll(ListRequest $request)
    {
        //first get all orders
        $model = Order::all();
        //fetch the results
        return $this->getTheResult($model, $request);
    } //getAll

    /**
     * @param ListRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @todo: get all shipped orders
     */
    public function getAllShipment(ListRequest $request)
    {
        //get the shipped orders
        $model = Order_Statuse::where('type', 'shipped')
            ->first()->orders;
        //apply filters
        return $this->getTheResult($model, $request);
    } //getAllShipment

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @todo: download the order invoice as pdf file
     */
    public function downloadInvoice($uuid)
    {
        try {
            //get the needed information
            $order = Order::find($uuid);
            $payment_type = $order->payment->type;
            $order_type = $order->order_statuse->type;
            $details = $this->getDetails($order->products);
            $customer = $order->user;
            //format the data array
            $data = [
                'order' => $order,
                'customer' => $customer,
                'payment_type' => $payment_type,
                'details' => $details,
                'order_type' => $order_type,
            ];
            //count = 0 mean, there is a fake product
            if (count($details) == 0) {
                return response([], 422);
            }
            $pdf = PDF::loadView('Order.invoice', ['data' => $data]);
            //name of the pdf is uuid
            return $pdf->download($uuid . '.pdf');
        } catch (Exception $e) {
            Log::info('error in download invoice' . $e->getMessage());
            return response([], 500);
        } //catch
    } //download pdf

}//class
