@extends('layouts.app')
@section('content')
    <div class="row">
        <x-has-access name="table-order.index">
            <div class="col-md-4 p-2">
                <a class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn p-3 fw-bold align-items-center d-flex flex-column {{ Route::is(['table-order.index']) ? 'active' : '' }}"
                    href="{{ route('table-order.index') }}"><i class="bi bi-table text-warning bi bi-folder fa-2x"></i> Table
                    order</a>
            </div>
        </x-has-access>
        <x-has-access :name="['master.item-description', 'master-settings']">
            <div class="col-md-4 p-2">
                <a class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn p-3 fw-bold align-items-center d-flex flex-column {{ Route::is(['master.item-description']) ? 'active' : '' }}"
                    href="{{ route('master.item-description') }}"><i
                        class="bi bi-diagram-2-fill text-warning bi bi-folder fa-2x"></i> Data
                    center
                </a>
            </div>
        </x-has-access>
        <x-has-access :name="['user.index', 'user.create', 'user.edit']">
            <div class="col-md-4 p-2">
                <a class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn p-3 fw-bold align-items-center d-flex flex-column {{ Route::is(['user.index', 'user.create', 'user.edit']) ? 'active' : '' }}"
                    href="{{ route('user.index') }}"><i
                        class="bi bi-person-plus-fill text-warning bi bi-folder fa-2x"></i>Users</a>
            </div>
        </x-has-access>
        <x-has-access :name="['role.index', 'role.create', 'role.edit']">
            <div class="col-md-4 p-2">
                <a class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn p-3 fw-bold align-items-center d-flex flex-column {{ Route::is(['role.index', 'role.create', 'role.edit']) ? 'active' : '' }}"
                    href="{{ route('role.index') }}"><i
                        class="bi bi-person-rolodex text-warning bi bi-folder fa-2x"></i>Roles</a>
            </div>
        </x-has-access>
        <x-has-access :name="['help.menu.index', 'help.menu.create', 'help.menu.edit']">
            <div class="col-md-4 p-2">
                <a class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn p-3 fw-bold align-items-center d-flex flex-column {{ Route::is(['help.menu.index', 'help.menu.create', 'help.menu.edit']) ? 'active' : '' }}"
                    href="{{ route('help.menu.index') }}"><i
                        class="bi bi-question-circle-fill text-warning bi bi-folder fa-2x"></i>Help
                    Menu</a>
            </div>
        </x-has-access>
        <x-has-access name="pictogram.index">
            <div class="col-md-4 p-2">
                <a class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn p-3 fw-bold align-items-center d-flex flex-column {{ Route::is(['pictogram.index']) ? 'active' : null }}"
                    href="{{ route('pictogram.index') }}"><i class="bi bi-boxes text-warning bi bi-folder fa-2x"></i>
                    Pictogram</a>
            </div>
        </x-has-access>
    </div>
@endsection
