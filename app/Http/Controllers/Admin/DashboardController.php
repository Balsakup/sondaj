<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Dashboard\SortRequest;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function home()
    {
        return view('admin::dashboard.home');
    }

    public function sort(SortRequest $request)
    {
        try {
            if (!class_exists($model = $request->get('model'))) {
                throw new \RuntimeException('Le modèle n\'existe pas');
            }

            if (!$from = $model::where('id', $request->get('from'))->first()) {
                throw new \RuntimeException('L\'ancienne donnée n\'existe pas');
            }

            if (!$to = $model::where('id', $request->get('to'))->first()) {
                throw new \RuntimeException('La nouvelle donnée n\'existe pas');
            }

            DB::beginTransaction();

            $tmp = $from->position;

            $from->position = $to->position;
            $from->saveOrFail();

            $to->position = $tmp;
            $to->saveOrFail();

            DB::commit();

            return response()->json([ 'success' => true ]);
        } catch (\Exception $e) {
            return response()->json([ 'success' => false, 'message' => $e->getMessage() ]);
        }
    }
}
