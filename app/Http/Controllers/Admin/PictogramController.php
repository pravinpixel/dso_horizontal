<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pictogram;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class PictogramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Pictogram::select('*');
            return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                    <div class="btn-group border">
                        <a href="'.route('pictogram.edit', $data->id).'" class="btn btn-sm border-top-0  border-start-0 border-bottom-0 border" title="Edit"> <i class="bi bi-pencil-square"></i> </a>
                        <form method="post" action="'.route('pictogram.delete', $data->id).'"> 
                                '.csrf_field().'
                            <button id="confirmDelete" type="submit" class="btn btn-sm text-danger border-0" title="Delete"><i class="bi bi-trash"></i> </button>
                        </form>
                    </div>';
                return $action;
            })
            ->addColumn('image', function ($data) {
                return  '<img src="'.storageGet($data->image).'" class="img-png" width="50px">';
            })
            ->rawColumns(['action','image'])
            ->addIndexColumn()->make(true);
        }
        return view('masters.pictograms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.pictograms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if($request->has('image')) {
            $image = Storage::put('public/files/pictograms/', $request->file('image'));
        } 

       
        Pictogram::create([
            'name'      =>  $request->name,
            'image'     =>  $image,
        ]);

        Flash::success(__('global.inserted'));
        return redirect()->route('pictogram.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pictogram::findOrFail($id);
        return view('masters.pictograms.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Pictogram::find($id);

        if($request->has('image')) {
            if(Storage::exists($data->image)){
                Storage::delete($data->image);
            }
            $image = $request->file('image')->store('public/files/pictograms');
        }
         
        $data->update([
            'name'         =>  $request->name,
            'image'        =>  $image
        ]);

        Flash::success(__('global.updated'));
        return redirect()->route('pictogram.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pictogram::findOrFail($id);
        if(Storage::exists($data->attachments)){
            Storage::delete($data->attachments);
        }
        $data->delete();
        Flash::success(__('global.deleted'));
        return redirect()->route('pictogram.index');
    }
}