<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Models\Bus;
use App\Models\User;
use App\Models\ImageBus;
use App\Models\Role;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use File;

class BusController extends Controller
{
    public function index()
    {
        // Get user with role driver
        $user = User::where('role_id', '3')->get();
        return view('admin.bus.index',[
            'user' => $user,
        ]);
    }

    // Display all bus
    public function getAllRowData(Request $request)
    {
        if(auth()->user()->hasRole(Role::ROLE_ADMIN))
        {
        $bus = Bus::all();
        }
        else if(auth()->user()->hasRole(Role::ROLE_DRIVER))
        {
        $bus = Bus::where('driver_id', Auth::user()->id)->get();
        }
        return Datatables::of($bus)
            ->editColumn('images', function ($data) {
                    return '
                        <a class="btn btn-primary btn-sm rounded-pill" href="'.route('admin.account.viewImage',$data->id).'"><i class="fas fa-eye" title="See the image bus"> View Image of Bus</i></a>
                    ';
                })
            ->editColumn('driver_id', function($data) {
                if($data->driver_id)
                {
                    if($data->users->role_id == '3')
                    {
                        return $data->users->name;
                    }
                    else
                    {
                        return 'Not Available';
                    }
                }
            })
            ->editColumn('bus_status', function($data){
                $show = 1;
                $not_show = 0;
                if($data->bus_status == $not_show)
                {
                    return '
                        <div class="badge badge-pill badge-warning">Not Shown</div>
                    ';
                }
                else if($data->bus_status == $show)
                {
                    return '
                        <div class="badge badge-pill badge-success">Shown</div>
                    ';
                }
            })
            ->editColumn('action', function ($data) {
                if(auth()->user()->hasRole(Role::ROLE_ADMIN))
                return '
                    <a class="btn btn-warning btn-sm rounded-pill" href="'.route('admin.bus.edit',$data->id).'"><i class="fas fa-edit" title="Edit Bus"></i></a>
                    <form method="POST" action="' . route('admin.bus.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                    ' . method_field('DELETE') .
                        '' . csrf_field() .
                        '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this '.$data->bus_name.' ?\')"><i class="fa fa-trash" title="Delete the Bus"></i></button>
                    </form>
                ';
                else
                return '';
            })
            ->rawColumns(['images', 'action', 'bus_status'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }

    public function create(BusRequest $request)
    {
        $bus = Bus::create([
            "bus_name" => $request->input('bus_name'),
            "bus_number" => $request->input('bus_number'),
            "bus_status" => $request->input('bus_status') == TRUE?'1':'0',
            "number_of_seats" => $request->input('number_of_seats'),
            "driver_id"=> $request->input('driver_id'),
        ]);

        // Handle multiple image bus
        if($request->hasFile('image_bus'))
        {
            $count = 1;
            $path = 'admin/upload/img-bus/';
            foreach($request->file('image_bus') as $imgBusfile)
            {
                $ext = $imgBusfile->getClientOriginalExtension(); //get tên đuôi ảnh
                $filename = time().$count++.'.'.$ext;
                $imgBusfile->move($path, $filename);
                $finalImagePath = $path.$filename;
                $bus->imageBus()->create([
                    'bus_id' => $bus->id,
                    'image_bus' => $finalImagePath
                ]);
            }
        }
        // $bus->save();

        return redirect()->back()->with('status', 'New Bus Created Successfully');
    }

    // View Image Bus
    public function showImage($id)
    {   
        $bus = Bus::findOrFail($id); //Query to get name
        $images_bus = ImageBus::where('bus_id', $id)->pluck('image_bus'); //Get all id and give to array
        $check = ImageBus::where('bus_id', $id)->exists(); //Check bus có ảnh hay không
        return view('admin.bus.viewImageBus', compact('images_bus', 'bus','check'));
    }

    public function edit($id)
    {
        $bus = Bus::findOrfail($id);
        if(!$bus)
        {
            abort(404);
        }
        $driver_id = User::where('role_id', '3')->get();
        return view('admin.bus.edit', compact('bus', 'driver_id'));
    }

    public function update(UpdateBusRequest $request, $id)
    {
        $bus = Bus::findOrFail($id);
        $bus->update([
            "bus_name" => $request['bus_name'],
            "bus_number" => $request['bus_number'],
            "bus_status" => $request['bus_status'] == TRUE?'1':'0',
            "number_of_seats" => $request['number_of_seats'],
            "driver_id"=> $request['driver_id'],
        ]);

        // Handle image
         if($request->hasFile('image_bus'))
        {
            $count = 1;
            $path = 'admin/upload/img-bus/';
            foreach($request->file('image_bus') as $imgBusfile)
            {
                $ext = $imgBusfile->getClientOriginalExtension(); //get tên đuôi ảnh png, jpg
                $filename = time().$count++.'.'.$ext;
                $imgBusfile->move($path, $filename);
                $finalImagePath = $path.$filename;
                $bus->imageBus()->create([
                    'bus_id' => $bus->id,
                    'image_bus' => $finalImagePath
                ]);
            }
        }
        return redirect('/admin/bus')->with('status', 'Updated Bus Successfully');
    }

    // Delete bus
    public function delete($id)
    {
        $bus = Bus::findOrFail($id);
        if($bus->imageBus()){
            foreach($bus->imageBus() as $image)
            {
                if(File::exists($image->image_bus)) //get image exist to delete
                {
                    File::delete($image->image_bus);
                }
            }
        }
        $bus->delete();
        return redirect()->back()->with('status', 'Deleted Successfully');
    }

    // Xóa từng ảnh
    public function deleteImage($bus_image_id)
    {
        $image_bus = ImageBus::findOrFail($bus_image_id);
        // check image exist
        if(File::exists($image_bus->image_bus))
        {
            File::delete($image_bus->image_bus);
        }
        $image_bus->delete();
        return redirect()->back()->with('status', 'Deleted Bus Image Success');        
    }
}
