<div id="ImportFromExcel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-sm">
        <form action="{{ route('import_data') }}" method="POST" enctype="multipart/form-data" class="modal-content rounded-0 border-bottom shadow">
            @csrf
            <div class="modal-header rounded-0 bg-primary text-white ">
                <h4 class="modal-title" id="topModalLabel">Import Data From Excel</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <input type="file" accept="application/csv" name="select_file" class="form-control mb-2"> 
                <a download="import-format.csv" href="import-format.csv"><i class="bi bi-download"></i> Download sample format</a>
            </div>
            <div class="modal-footer border-top">
                <button type="submit" class="btn btn-primary rounded-pill w-100"><i class="bi bi-box-arrow-in-down-left me-1"></i>Import</button>
            </div>
        </form> 
    </div> 
</div>