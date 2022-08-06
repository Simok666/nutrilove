<link rel="stylesheet" href="{{ asset('admin_assets/dist/assets/vendors/simple-datatables/style.css') }}">
<form id="form" class="form-horizontal" enctype="multipart/form-data">
    @csrf 
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode</label>
        <div class="col-sm-9">
            <input type="text" class="form-control validasi" id="kode" name="kode">
        </div>

    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-9">
            <input type="text" class="form-control validasi" id="title" name="title">
        </div>

    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan</label>
        <div class="col-sm-9">
            <textarea class="form-control" id="desc_content" placeholder="Keterangan" name="desc_content"></textarea>
            <script>    
                var options = {
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
                };
                CKEDITOR.replace( 'desc_content', options );
            </script>
        </div>
    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">File</label>
        <div class="col-sm-9">
            <input type="text" class="base64" name="file" id="dwadwa">
            <input type="File" class="form-control validasi fileInput" id="file" name="file">
        </div>

    </div>
    
</form>

<div class="border-top p-2 m-1" style="border-width:2px !important;">
    <button type="button" id="save" class="btn btn-primary float-right" onClick="save()"><i class="fas fa-save"></i> Save</button>
    <button type="button" id="delete" class="btn btn-danger" onClick="deleteData()"><i class="fas fa-trash-alt"></i> Delete</button>
    <button type="button" onClick="initValue('name1')" class="btn btn-info float-right mr-1"><i class="fas fa-sync-alt"></i> Reset</button>
</div>
<div class="card-body border-top" id="table_data" style="border-width:2px !important;">
    <div class="row">
        <div class="col-12">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Title</th>
                        <th>Keterangan</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('admin_assets/dist/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
let table1 = document.querySelector('#table1');
let dataTable = new simpleDatatables.DataTable(table1);
table = new simpleDatatables.DataTable("#table1", {
    "data":@json($data),
    "order": [[ 0, "desc" ]],
    "scrollY":"130px",
    "scrollx":true,
    "ajax": "{{ route('contents.list') }}",
    "responsive": true,
    "searching": false,
    "info":false,
    "columns": [
        { "data": "kode" },
        { "data": "title" },
        { "data": "file" },
        { "data": "desc_content" }
    ]
});

setTimeout(function () {
    $(".overlay").addClass("d-none"); 
    
}, 500);

$('#table1 tbody').on('click', 'tr', function () {
  var table = new simpleDatatables.DataTable(table1);
  var data = table.row( this ).data();
  for (const [key, value] of Object.entries(data)) {
    $("#"+key).val(value);
  }
} )

function readFile() {
  
  if (!this.files || !this.files[0]) return;
    
  const FR = new FileReader();
    
  FR.addEventListener("load", function(evt) {
    document.querySelector("#file").src         = evt.target.result;
    document.querySelector("#dwadwa").value = evt.target.result;
    
  }); 
    
  FR.readAsDataURL(this.files[0]);
  
}

document.querySelector("#file").addEventListener("change", readFile);
</script>