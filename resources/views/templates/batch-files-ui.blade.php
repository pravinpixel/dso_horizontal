@if (!is_null($files))
    <div class="d-flex flex-wrap">
        @foreach ($files as $key => $file)
            @if ($file->column_name === $type)
                <div class="d-flex align-items-center border shadow-sm p-1 rounded me-1 mt-1">
                    <button onclick="download('{{ $file->id }}','{{ $type }}')"
                        class="badge bg-warning rounded-pill text-dark ms-1 border-0" type="button">
                        <i class="fa fa-download me-1"></i>
                        <i>{{ $file->original_name }}</i>
                    </button>
                    @if (is_null($removeBtn))
                        <i class="fa fa-times ms-1 text-danger bg-white rounded font-12"
                            onclick="deleteFile('{{ $file->id }}',this)" style="cursor: pointer"></i>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
@endif
