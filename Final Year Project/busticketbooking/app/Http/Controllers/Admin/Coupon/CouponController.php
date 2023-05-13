<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CouponRequest;

use App\Models\Coupon;


class CouponController extends Controller
{
    public function index()
    {
        return view('admin.coupon.index');
    }

    // Show coupon
    public function getAllRowData(Request $request)
    {
        $coupon = Coupon::all();
        return Datatables::of($coupon)
            ->editColumn('coupon_limited_quantity', function($data) {
                if($data->coupon_limited_quantity == 0)
                {
                    return '<span class="badge badge-pill badge-danger">Out of Stock</span>';
                }
                else
                {
                    return $data->coupon_limited_quantity;
                }
            })
            ->editColumn('status', function($data) {
                $show = 1;
                $not_show = 0;
                if($data->status == $show)
                {
                    return '<div class="bg-success text-white rounded text-center font-weight-bold">Show</div>';
                }elseif($data->status == $not_show)
                {
                    return '<div class="bg-warning text-white rounded text-center font-weight-bold">Not Show</div>';
                }
            })
            ->editColumn('action', function ($data) {
                return '
                    <a class="btn btn-warning btn-sm rounded-pill" href="'.route("admin.coupon.edit",['id'=>$data->id]).'"><i class="fas fa-edit" title="Edit Coupon"></i></a>
                     <form method="POST" action="' . route('admin.coupon.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                    ' . method_field('DELETE') .
                        '' . csrf_field() .
                        '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this '.$data->name_coupon.' ?\')"><i class="fa fa-trash" title="Delete the Coupon"></i></button>
                    </form>    
                ';
            })
            ->rawColumns(['status','action', 'coupon_limited_quantity'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }

    public function create(CouponRequest $request)
    {
        $coupon = Coupon::create([
            'name_coupon' => $request->name_coupon,
            'coupon_code' => $this->autoRandomString(10),
            'coupon_limited_quantity' => $request->coupon_limited_quantity,
            'price_coupon' => $request->price_coupon,
            'valid_from' => $request->valid_from,
            'valid_until' => $request->valid_until,
            'status' => $request->status == TRUE?'1':'0',
        ]);
        return redirect('/admin/coupon')->with('status', 'Coupon Created Successfully');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', [
            'coupon' => $coupon
        ]);
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'name_coupon' => $request['name_coupon'],
            'coupon_limited_quantity' => $request['coupon_limited_quantity'],
            'price_coupon' => $request['price_coupon'],
            'valid_from' => $request['valid_from'],
            'valid_until'=> $request['valid_until'],
            'status' => $request['status'] == TRUE?'1':'0',
        ]);
        return redirect('/admin/coupon')->with('status', 'Coupon Updated Successfully');
    }

    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->back()->with('status', 'Deleted Successfully');
    }

    // Random string
    private function autoRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
