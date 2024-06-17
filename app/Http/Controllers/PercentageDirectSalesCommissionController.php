<?php

namespace App\Http\Controllers;

use App\Models\PercentageDirectSalesCommission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use PhpParser\Node\Expr\FuncCall;

class PercentageDirectSalesCommissionController extends Controller implements HasMiddleware
{
    public function __construct(
        private PercentageDirectSalesCommission $percentageDirectSalesCommission
    ) {
    }

    public static function middleware(): array
    {
        return [
            'userIsAuthenticate',
            new Middleware('checkPermission:read-percentageCommission', only: ['index']),
            new Middleware('checkPermission:create-percentageCommission', only: ['create', 'store']),
        ];
    }

    public function index()
    {
        $percentages = $this->percentageDirectSalesCommission
            ->orderBy('percent_to', 'asc')->get();
        return view('percentage-direct-sale-commission.index-percentage-direct-sale-commission', [
            'percentageDirectSalesCommission' => $percentages
        ]);
    }

    public function create()
    {
        $percentages = $this->percentageDirectSalesCommission
            ->orderBy('percent_to', 'asc')->get();
        return view('percentage-direct-sale-commission.create-percentage-direct-sale-commission', [
            'percentageDirectSalesCommission' => $percentages,
            'total_itens' => $percentages->count(),
        ]);
    }

    public function store(Request $request)
    {
        $this->percentageDirectSalesCommission->truncate();
        foreach ($request->all() as $field => $value) {
            preg_match('/percent_to_([0-9+])/', $field, $matches);
            if (!empty($matches)) {
                $insert = [];
                $percentTo = $request->input('percent_to_' . $matches[1]);
                $percentFrom = $request->input('percent_from_' . $matches[1]);
                $sellerPercent = $request->input('seller_percentage_' . $matches[1]);
                !empty($percentTo) ? $insert['percent_to'] = $percentTo : '';
                !empty($percentFrom) ? $insert['percent_from'] = $percentFrom : '';
                !empty($sellerPercent) ? $insert['seller_percentage'] = $sellerPercent : '';
                $this->percentageDirectSalesCommission->create($insert);
            }
        }

        return redirect()->route('percentCommission.index')->with('message', [
            'type' => 'success',
            'message' => 'Percentual cadastrado'
        ]);
    }
}
