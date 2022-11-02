@extends('masters.index')

@section('masters')
<div class="card">
    <div class="card-body">  
        {!! Form::open(['route' => 'role.store',"id" => "roleForm", "Method" => "POST"]) !!}
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">Role Name</label>
                <div class="col-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                </div>
            </div>
            <table class="table table-bordered table-centered  tr-sm table-hover">
                <thead class="bg-primary-2 text-white">
                    <tr>
                        <th rowspan="2" width="200px">Menus</th>
                        <th colspan="4"><input onclick="toggle(this);" type="checkbox" class="form-check-input me-2"> Permissions</th>
                    </tr> 
                </thead>
                <tbody>
                    @foreach (getRoutes() as $menu => $routes)
                        <tr>
                            <td>
                                {{ format_text($menu) }}
                            </td>
                            <td class="row m-0">
                                @foreach ($routes as $route) 
                                    <span class="col-3"> 
                                        <input type="hidden" readonly name="{{ $route }}[]" value="0">
                                        <input class="form-check-input " type="checkbox" name="{{ $route }}[]" value="1" id="{{ $route }}"> 
                                        <label class="form-check-label font-12" for="{{ $route }}">
                                            {{ format_text($route) }}
                                        </label>
                                    </span> 
                                @endforeach
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table> 
            <div class="text-end">
                <a href="{{ route('role.index') }}" class="btn btn-light me-2">Back</a>
                <button type="submit" class="btn btn-primary fw-bold">Save</button>
            </div> 
        {!! Form::close() !!}
    </div>
</div> 
@endsection 