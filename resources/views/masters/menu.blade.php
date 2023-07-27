@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4 p-2">
            <x-has-access name="table-order.index">
                <a class="text-primary lead fw-bold list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['table-order.index']) ? 'active' : '' }}"
                    href="{{ route('table-order.index') }}"><i class="bi bi-table text-warning bi bi-folder fa-2x me-2"></i> Table Order</a>
            </x-has-access>
        </div>
        <div class="col-md-4 p-2">
            <x-has-access :name="['master.item-description', 'master-settings']">
                <a class="text-primary lead fw-bold list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['master.item-description']) ? 'active' : '' }}"
                    href="{{ route('master.item-description') }}"><i class="bi bi-diagram-2-fill text-warning bi bi-folder fa-2x me-2"></i> Data
                    center
                </a>
        </div>
        </x-has-access>
        <div class="col-md-4 p-2">
            <x-has-access :name="['user.index', 'user.create', 'user.edit']">
                <a class="text-primary lead fw-bold list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['user.index', 'user.create', 'user.edit']) ? 'active' : '' }}"
                    href="{{ route('user.index') }}"><i class="bi bi-person-plus-fill text-warning bi bi-folder fa-2x me-2"></i>Users</a>
            </x-has-access>
        </div>
        <div class="col-md-4 p-2">
            <x-has-access :name="['role.index', 'role.create', 'role.edit']">
                <a class="text-primary lead fw-bold list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['role.index', 'role.create', 'role.edit']) ? 'active' : '' }}"
                    href="{{ route('role.index') }}"><i class="bi bi-person-rolodex text-warning bi bi-folder fa-2x me-2"></i>Roles</a>
            </x-has-access>
        </div>
        <div class="col-md-4 p-2">
            <x-has-access :name="['help.menu.index', 'help.menu.create', 'help.menu.edit']">
                <a class="text-primary lead fw-bold list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['help.menu.index', 'help.menu.create', 'help.menu.edit']) ? 'active' : '' }}"
                    href="{{ route('help.menu.index') }}"><i class="bi bi-question-circle-fill text-warning bi bi-folder fa-2x me-2"></i>Help
                    Menu</a>
            </x-has-access>
        </div>
        <div class="col-md-4 p-2">
            <x-has-access name="pictogram.index">
                <a class="text-primary lead fw-bold list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['pictogram.index']) ? 'active' : null }}"
                    href="{{ route('pictogram.index') }}"><i class="bi bi-boxes text-warning bi bi-folder fa-2x me-2"></i> Pictogram</a>
            </x-has-access>
        </div>
    </div>
@endsection
