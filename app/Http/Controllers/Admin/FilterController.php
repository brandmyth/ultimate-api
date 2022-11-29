<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use App\Models\ProductsFiltersValue;

class FilterController extends Controller
{
    public function filters(){
        $filters = ProductsFilter::get()->toArray();
        return view('admin.filters.filters')->with(compact('filters'));
    }
    public function filterValues(){
        $filter_values = ProductsFiltersValue::get()->toArray();
        return view('admin.filters.filter_values')->with(compact('filter_values'));
    }
    public function updateFilterStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsFilter::where('id',$data['filter_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'filter_id'=>$data['filter_id']]);
        }
    }
    public function updateFilterValueStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsFiltersValue::where('id',$data['filter_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'filter_id'=>$data['filter_id']]);
        }
    }
}
