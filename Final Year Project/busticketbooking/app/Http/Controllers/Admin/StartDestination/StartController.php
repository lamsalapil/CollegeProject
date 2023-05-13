<?php

namespace App\Http\Controllers\Admin\StartDestination;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StartDestination;
use Yajra\Datatables\Datatables;


class StartController extends Controller
{
    public function index(StartDestination $startdest)
    {
        return view('admin.map.startDestination.index');
    }

    public function getAllRowData()
    {
        $start_destination = StartDestination::all();
        return Datatables::of($start_destination)
            ->editColumn('name' , function($data) {
                return ' 
                    <a href="' . route('admin.startdestination.detail', $data->id) . '">' . $data->name . '</a>
                ';
            })
            ->editColumn('action', function($data) {
                return '
                    <a class="btn btn-warning btn-sm rounded-pill" href="'.route('admin.startdestination.edit',$data->id).'"><i class="fas fa-edit" title="Edit Start Destination"></i></a>
                    <form method="POST" action="' . route('admin.startdestination.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                    ' . method_field('DELETE') .
                        '' . csrf_field() .
                        '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this '.$data->name.' ?\')"><i class="fa fa-trash" title="Delete Start Destination"></i></button>
                    </form>
                ';
            })
            ->rawColumns(['action', 'name'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }

    public function create()
    {
        return view('admin.map.startDestination.create');
    }

    public function store(Request $request)
    {
        StartDestination::create([
            'name' => $request->name,
            'address'  => $request->address,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);
        return redirect()->route('admin.startdestination.index')->with('status', 'Start Destination Created Successfully');
    }

    // show Detail with map
    public function Detail($id)
    {
        $start_destination = StartDestination::findOrFail($id);
        return view('admin.map.startDestination.detail', [
            'start_destination' => $start_destination
        ]);
    }

    public function edit($id)
    {
        $start_destination = StartDestination::findOrFail($id);
        return view('admin.map.startDestination.edit', compact('start_destination'));
    }

    public function update(Request $request, $id)
    {
        $start_destination = StartDestination::findOrFail($id);
        $start_destination->update([
            'name' => $request->name,
            'address'=> $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/admin/start-dest')->with('status', 'Updated Location Successfully');
    }

    public function delete($id)
    {
        $start_destination = StartDestination::findOrFail($id);
        $start_destination->delete();
        return redirect()->back()->with('status', 'Deleted Start Destination Successfully');
    }
}
