@extends('layouts.app')
@push('css')
    <style>
        .searchItem {
            cursor: pointer;
        }
    </style>
@endpush
@section('title', 'Multi Dependency Select')
@section('project_title', 'Multi Dependency Select')

@section('content')
    <div id="">
        <form action="">
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="mb-1">Division : </label>
                    <select name="" id="division_id" class="form-control">
                        <option value="">Select A Division</option>
                        @foreach ($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="" class="mb-1">District : </label>
                    <select name="" id="district_id" class="form-control">
                        <option value="">Select A District</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="" class="mb-1">Upazila : </label>
                    <select name="" id="upazila_id" class="form-control">
                        <option value="">Select A Upazila</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
@stop

@push('script')
    <script>
        const division_id = $$('#division_id');
        const district_id = $$('#district_id');
        const upazila_id = $$('#upazila_id');

        const appendData = (items,element,title) => {
            let html = `<option value="">Select A ${title}</option>`;

            items.forEach(item => {
                html += `<option value="${item.id}">${item.name}</option>`;
            });

            element.innerHTML = html;
        }


        division_id.addEventListener("change",async (e)=>{
            let id = e.currentTarget.value;

            let url = `${base_url}/multi-dependency/get-districts/${id}`;
            const response = await axios.get(url);

            appendData(response.data.districts, district_id,"District");

        });

        district_id.addEventListener("change",async (e)=>{
            let id = e.currentTarget.value;

            let url = `${base_url}/multi-dependency/get-upazilas/${id}`;
            const response = await axios.get(url);

            appendData(response.data.upazilas, upazila_id,"District");

        });

    </script>
@endpush
