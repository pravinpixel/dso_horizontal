@extends('masters.index')

@section('masters')
<div class="card">
    <div class="card-body">  
        {!! Form::model($role, ['route' => ['role.update',$role->id],"id" => "roleForm", 'method'=> 'put']) !!}
            {{-- $role->permissions --}}
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">Role Name</label>
                <div class="col-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                </div>
            </div>
            <table class="table table-bordered table-centered table-sm">
                <thead class="bg-primary-2 text-white">
                    <tr>
                        <th rowspan="2" width="200px">Menus</th>
                        <th colspan="4"><input onclick="toggle(this);" type="checkbox" class="form-check-input me-2"> Permissions</th>
                    </tr> 
                </thead>
                <tbody>
                     
                    @if (true)
                        @foreach (getRoutes() as $menu => $routes)
                            <tr>
                                <td class="font-12">
                                    {{ format_text($menu) }}
                                </td>
                                <td class="row m-0">
                                    @foreach ($routes as $route)  
                                        <label class="col-3 btn btn-sm font-12 text-start" for="{{ key($route) }}">
                                            <input type="hidden" readonly name="{{ key($route) }}[]" value="{{ $role->permissions[key($route)]  == 0 ? 0 : '' }}"> 
                                            <input class="form-check-input me-1" type="checkbox" {{ $role->permissions[key($route)]  == 1 ? 'checked' : '' }} name="{{ key($route) }}[]" value="1" id="{{ key($route) }}"> 
                                            {{ format_text(key($route)) }}
                                        </label>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach 
                    @endif 
                </tbody>
            </table> 
            <div class="row ">
                <div class="col-10 offset-2">
                    <a href="{{ route('role.index') }}" class="btn btn-light">Back</a>
                    <button type="submit" class="btn btn-primary fw-bold">Update</button>
                </div>
            </div> 
        {!! Form::close() !!}
    </div>
</div>
@endsection 