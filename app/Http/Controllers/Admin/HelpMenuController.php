<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masters\HelpMenu;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class HelpMenuController extends Controller
{
    public function help_index(Request $request)
    {
        $data = HelpMenu::latest()->paginate(3);
        return view('crm.help.index',compact('data'));  
    }
    public function show_document(Request $request, $id)
    {
        $data = HelpMenu::findOrFail($id);
        return view('crm.help.show',compact('data'));  
    }
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = HelpMenu::select([
                'id',
                'title',
                'created_at',
                'updated_at',
            ]);
            return DataTables::eloquent($data)->addColumn('action', function ($data) {
                $action = '
                    <div class="btn-group border">
                        <a href="'.route('help.menu.edit', $data->id).'" class="btn btn-sm border-top-0  border-start-0 border-bottom-0 border" title="Edit"> <i class="bi bi-pencil-square"></i> </a>
                        <form method="post" action="'.route('help.menu.delete', $data->id).'"> 
                                '.csrf_field().'
                            <button id="confirmDelete" type="submit" class="btn btn-sm text-danger border-0" title="Delete"><i class="bi bi-trash"></i> </button>
                        </form>
                    </div>';
                return $action;
            })->addIndexColumn()->make(true);
        }
        return view('masters.help-menu.index');
    }
    public function create(Request $request)
    {
        return view('masters.help-menu.create');
    }
    public function store(Request $request)
    {
          
        if($request->has('attachments')) {
            $attachments = Storage::put('files/helps-attachments', $request->file('attachments'));
        } 

       
        HelpMenu::create([
            'title'         =>  $request->title,
            'description'   =>  $request->description,
            'attachments'   =>  $attachments ?? "",
            'status'        =>  1
        ]);

        Flash::success(__('global.inserted'));
        return redirect()->route('help.menu.index');
    }

    public function edit(Request $request, $id)
    {
        $data = HelpMenu::find($id);
        return view('masters.help-menu.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data = HelpMenu::find($id);
        if($request->has('attachments')) {
            if(Storage::exists($data->attachments)){
                Storage::delete($data->attachments);
            }
            $attachments = $request->file('attachments')->store('public/files/helps-attachments');
        }
        $data->update([
            'title'         =>  $request->title,
            'description'   =>  $request->description,
            'attachments'   =>  $attachments ?? $data->attachments,
            'status'        =>  1
        ]);

        Flash::success(__('global.updated'));
        return redirect()->route('help.menu.index');
    }

    public function delete(Request $request, $id)
    {
        $data = HelpMenu::find($id);
        if(Storage::exists($data->attachments)){
            Storage::delete($data->attachments);
        }
        $data->delete();
        Flash::success(__('global.deleted'));
        return redirect()->route('help.menu.index');
    }
}