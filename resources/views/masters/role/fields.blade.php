<table class="table table-bordered table-centered table-sm table-hover">
    <thead class="bg-primary-2 text-white">
        <tr>
            <th rowspan="2" width="200px">Menu</th>
            <th colspan="4" class="px-3">Permissions <label for="all" class="float-end"><input id="all"
                        onclick="toggle(this);" type="checkbox" class="form-check-input me-2">Select all</label> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="bg-light text-dark px-2">
                <b>Role as Admin</b>
            </td>
            <td class="m-0 text-dark px-3"> 
                <div class="d-flex">
                    <label for="yesone" class="me-2"><input class="form-check-input" {{ ($role->permissions['is_admin'] ?? false) ? 'checked' : '' }} value="1" type="radio" name="is_admin[]" id="yesone"> Yes</label>
                    <label for="notwo"><input class="form-check-input" type="radio" {{ ($role->permissions['is_admin'] ?? false) === false ? 'checked' : '' }} value="0" name="is_admin[]" id="notwo"> No</label>
                </div>
            </td>
        </tr>
        @foreach (getRoutes() as $menu => $routes)
            <tr>
                <td class="bg-light text-dark px-2">
                    <b>{{ format_text($menu) }}</b>
                </td>
                <td class="row m-0">
                    @foreach ($routes as $page)
                        <label class="col-3 btn btn-sm text-start" for="{{ $page['name'] }}">
                           
                            @if (isset($role->permissions[$page['name']]))
                                <input type="hidden" name="{{ $page['name'] }}[]"  value="{{ $role->permissions[$page['name']] == 0 ? 0 : '' }}">
                                <input class="form-check-input me-1" type="checkbox"  {{ $menu === 'dashboard' ? 'checked' : '' }}  {{ $role->permissions[$page['name']] == 1 ? 'checked' : '' }}
                                    name="{{ $page['name'] }}[]" value="1" id="{{ $page['name'] }}">
                            @else
                                <input type="hidden" name="{{ $page['name'] }}[]" value="0">
                                <input class="form-check-input me-1" readonly type="checkbox" {{ $menu === 'dashboard' ? 'checked' : '' }}  name="{{ $page['name'] }}[]"
                                    value="1" id="{{ $page['name'] }}">
                            @endif
                            <small>{{ format_text($page['slug']) }}</small>
                        </label>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
