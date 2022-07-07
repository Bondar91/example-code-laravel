<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderUpdateOrCreateRequest;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\ShipmentMethodService;
use App\Services\UserService;
use App\Services\CountryService;
use App\Services\AllegroService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected $ordersService;
    protected $userService;
    protected $countryService;
    protected $productService;
    protected $shipmentMethodService;
    protected $allegroService;

    /**
     * OrderController constructor.
     *
     * @param OrderService $ordersService
     * @param UserService $userService
     * @param CountryService $countryService
     * @param ProductService $productService
     * @param AllegroService $allegroService
     */
    public function __construct(OrderService $ordersService, UserService $userService, CountryService $countryService, ProductService $productService, ShipmentMethodService $shipmentMethodService, AllegroService $allegroService)
    {
        $this->ordersService = $ordersService;
        $this->userService = $userService;
        $this->countryService = $countryService;
        $this->productService = $productService;
        $this->shipmentMethodService = $shipmentMethodService;
        $this->allegroService = $allegroService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|BinaryFileResponse
     */
    public function index(Request $request)
    {
        $orders = $this->ordersService->getOrders($request);
        $countries = $this->countryService->getCountries();
        $shipmentMethods = $this->shipmentMethodService->getShipmentMethods();
        $ipAddresses = $this->ordersService->getIpAddressesByOrders($orders);

        $order = new Order();
        $totalPricesWithCurrency = $order->getTotalPriceWithCurrency($orders);

        switch ($request->input('action')) {
            case null:
                if($request->get('code'))
                {
                   $addAllegroOrder = $this->allegroService->setOrders();
                }

                return view($this->returnView(), [
                    'orders' => $orders,
                    'countries' => $countries,
                    'total_prices' => $totalPricesWithCurrency,
                    'ip_addresses' => $ipAddresses,
                    'shipmentMethods' => $shipmentMethods,
                    'allegro' => isset($addAllegroOrder) ? $addAllegroOrder : 'brak'
                ]);

            case 'main-export':
                $orders = $this->ordersService->getOrdersToExport($request);
                return Excel::download(new OrdersExport($orders), 'Zamówienia-' . now() . '.xls');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fileImportView()
    {
        return view('admin.orders.import');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fileImport(Request $request)
    {
        return $this->ordersService->fileImport($request);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $users = $this->userService->getUsers();
        $products = $this->productService->getProducts();
        $countries = $this->countryService->getCountries();
        $shipmentMethods = $this->shipmentMethodService->getShipmentMethods();

        return view('admin.orders.create', ['users' => $users, 'products' => $products, 'countries' => $countries, 'shipmentMethods' => $shipmentMethods]);
    }



    /**
     * @param OrderUpdateOrCreateRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(OrderUpdateOrCreateRequest $request)
    {
        $this->ordersService->createByAdmin($request);

        return redirect('admin/orders?tab=complete&show_tests=false&sort=id&direction=desc')->with('success', 'Zamówienie dodane pomyślnie');
    }





    /**
     * @return string
     */
    private function returnView()
    {
        switch (Auth::user()->roles()->first()->name)
        {
            case 'shipment':
            case 'super admin':
            case 'admin':
                return 'admin.orders.index.admin';
        }

    }
}


