@extends('masters.index')

@section('masters')

<div class="card">
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="post" id="role_user_form" class="form-horizontal">
            @csrf
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">User ID / Login ID</label>
                <div class="col-10">
                    <input type="number" name="email" class="form-control" placeholder="Type here..">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">First Name</label>
                <div class="col-10">
                    <input type="text" name="first_name" class="form-control" placeholder="Type here..">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">Last Name</label>
                <div class="col-10">
                    <input type="text" name="last_name" class="form-control" placeholder="Type here..">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">Role</label>
                <div class="col-10">
                    <select name="role_id" id="" class="form-select">
                        <option value="">-- Select --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row ">
                <div class="col-10 offset-2">
                    <button type="reset" class="btn btn-light">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div> 
        </form>
    </div>
</div> 
@endsection 