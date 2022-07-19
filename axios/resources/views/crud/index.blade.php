
@extends('layouts.app')
@section('project_title', 'Crud')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="text-info">Manage Crud</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                <tbody id="tbody"></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="text-info">Add Crud</h4>
            </div>
            <div class="card-body">
                <form id="addCrudForm">
                    <div class="form-group my-2">
                        <label for="">Title</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Category Name">
                        <span class="text-danger" id="nameError"></span>
                    </div>
                    <div class="form-group my-2">
                        <label for="">Image</label>
                        <input type="file" class="form-control" id="image">
                        <span class="text-danger" id="imageError"></span>
                    </div>
                    <div class="form-group my-2">
                        <button class="btn btn-success btn-block btn-sm">Add New Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <form action="" id="editForm">

                </form>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- View Modal -->
  <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewModalLabel">View Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="viewData">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')

<script>

    const getAllData = async () => {
        try{
            const {data} = await axios.get("{{ route('crud.get-all-data') }}");
            table_data_row(data);
        }catch(e){

        }
    }

    getAllData();

    const table_data_row = (items) => {
        let loop =  items.map((item,index) => {
            return `
            <tr>
                <td>${++index}</td>
                <td>${item.name}</td>
                <td><img src="{{ asset('${item.image}') }}" width="80px"></td>
                <td class="text-center">
                    <a href="" class="btn btn-sm btn-success" data-id="${item.slug}" data-bs-toggle="modal" data-bs-target="#viewModal" id="viewRow"><i class="fa fa-eye"></i></a>

                    <a href="" class="btn btn-sm btn-info" data-id="${item.slug}" data-bs-toggle="modal" data-bs-target="#editModal" id="editRow"><i class="fa fa-edit"></i></a>

                    <a href="" id="deleteRow" class="btn btn-sm btn-danger" data-id="${item.slug}"><i class="fa fa-trash-alt"></i></a>
                </td>
            </tr>
            `
        });
        loop = loop.join("")
        const tbody = $$('#tbody')
        tbody.innerHTML = loop
    }

 // store
    const addForm = $$('#addCrudForm');
    addForm.addEventListener("submit",async function(e){
    e.preventDefault();
    let name = $$('#name');
    let nameError = $$('#nameError');
    let image = $$('#image');
    let imageError = $$('#imageError');

    nameError.innerText = "";
    imageError.innerText = "";
    if(name.value === ''){
        nameError.innerText = "Field Must not be Empty!";
        return null;
    }

    const data = new FormData();
    data.append('name',name.value);
    data.append('image', document.getElementById('image').files[0]);
    const config = { headers: { 'Content-Type': 'multipart/form-data' } };

    try{
        await axios.post("{{ route('crud.store') }}",data);
        getAllData();
        setSuccessMessage();
        name.value = "";
        image.value = null;
    }catch(err){
        if(err.response.data.errors.name){
           nameError.innerText = err.response.data.errors.name[0];
       }
       if(err.response.data.errors.image){
           imageError.innerText = err.response.data.errors.image[0];
       }
    }

 })

//   delete
    document.addEventListener("click", (e)=> {
        if (e.target.matches('a[href], a[href] *')) {
            e.preventDefault();
        }
    const row = e.target.closest('#deleteRow');
    if (row) {
        const slug = row.getAttribute("data-id");
        const url = `${base_url}/crud/${slug}`;
        deleteDataWithAlert(url,getAllData);
    }
    });


 // view
 document.addEventListener("click", async (e)=> {
    if (e.target.matches('a[href], a[href] *')) {
            e.preventDefault();
        }
    const row = e.target.closest('#viewRow');
    if (row) {
        const slug = row.getAttribute("data-id");
        const url = `${base_url}/crud/${slug}`;
        console.log(url);

        try{
            const response = await axios.get(`${base_url}/crud/${slug}`);
            let {data:crud} = response
                let viewData = $$('#viewData');
                viewData.innerHTML = `
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>${crud.name}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td><img src="{{ asset('${crud.image}') }}" width="100px" alt=""></td>
                    </tr>
                </table>
                `
        }catch(err){
            log(err)
        }
    }
});

 // edit

$('body').on('click','#editRow',function(){
    let slug = $(this).data('id');
    let url = `${base_url}/crud/${slug}`;
    axios.get(url).then(res => {
        let {data} = res;
        let form = $$('#editForm');
        form.innerHTML = `<div class="form-group my-2">
                <label for="">Name</label>
                <input type="text" class="form-control" id="edit_name" value="${data.name}">
                <input type="hidden" id="edit_slug" value="${data.slug}">
                <span class="text-danger" id="editNameError"></span>
            </div>
            <div class="form-group my-2">
                <label for=""> Image</label>
                <input name="image" type="file" class="form-control" id="editImage">
                <span class="text-danger" id="imageEditError"></span> <br>
                <img src="{{ asset('${data.image}') }}" alt="" width="100px" class="mt-3">
            </div>
            <div class="form-group my-2">
                <button class="btn btn-success btn-block btn-sm">Update</button>
            </div>
            `
    }).catch(err => {
        console.log(err);
    })
})

// // update
$('body').on('submit','#editForm',function(e){
    e.preventDefault()
    let slug = $('#edit_slug').val();
    let url = `${base_url}/crud/${slug}`;
    let editImage = $('#editImage');
    let editName = $('#edit_name')

    let editNameError = $('#editNameError')
    let imageEditError = $('#imageEditError')
    editNameError.val("")
    imageEditError.val("")
    if(editImage.val()){
        const data = new FormData();
        data.append('name',editName.val());
        data.append('image', document.getElementById('editImage').files[0]);
        // log(data.get('image'))
        const config = { headers: { 'Content-Type': 'multipart/form-data' } };

        axios.post(url,data).then(res => {
            getAllData();
            let modal = $$('#editModal');
            modal.hide()
            setSuccessMessage('Data Update Successfully!')
        }).catch(err => {
            if(err.response.data.errors.image){
            imageEditError.text(err.response.data.errors.image[0])
       }
        })
    }else{
        sendUpdateAjaxRequest(url,{name: editName.val()}).then(res => {
            getAllData();
            let modal = $$('#editModal');
            modal.hide()
            setSuccessMessage('Data Update Successfully!')
        }).catch(err => {
            if(err.response.data.errors.name){
                editNameError.text(err.response.data.errors.name[0])
       }
        })
    }
})
const sendUpdateAjaxRequest = (url,data) => {

    return axios.post(url,data);
}
</script>
@endpush
