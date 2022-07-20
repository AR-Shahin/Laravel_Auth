@extends('layouts.app')
@push('css')
    <style>
        .searchItem {
            cursor: pointer;
        }
    </style>
@endpush
@section('title', 'Auto Complete Search')
@section('project_title', 'User Check')

@section('content')
    <div id="auto_complete">
        <div class="d-flex">
            <h5 class="mt-1 px-5">Email</h5>
            <input type="text" class="form-control" id="emailField" placeholder="Enter email">
            <button class="btn btn-success">Submit</button>
        </div>
        <span id="alert"></span>

    </div>
@stop

@push('script')
    <script>
        const emailField = $$('#emailField');
        const alert = $$('#alert');

        emailField.addEventListener('focusout', async (e) => {
            let email = e.currentTarget.value;
            alert.innerText = "";
            if (email != "") {
                const response = await axios.post("{{ route('user-check.data') }}", {
                    email
                });

                if (response.data == 'EXISTS') {
                    alert.classList.remove('text-success');
                    alert.classList.add('text-danger');
                    alert.innerText = "User is Exists!";
                } else {
                    alert.classList.remove('text-danger');
                    alert.classList.add('text-success');
                    alert.innerText = "User is not Exists!";
                }
                console.log();
            }

        });
    </script>
@endpush
