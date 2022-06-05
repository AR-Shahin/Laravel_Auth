@extends('layouts.app')
@push('css')
    <style>
        .searchItem {
            cursor: pointer;
        }

    </style>
@endpush
@section('title', 'Auto Complete Search')
@section('project_title', 'Auto Complete Search')

@section('content')
    <div id="auto_complete">
        <div class="d-flex">
            <h5 class="mt-1 px-5">Search</h5>
            <input type="text" class="form-control" id="searchField" placeholder="Search Anything....">
            <button class="btn btn-success">Search</button>
            <button class="btn btn-warning" id="clearBtn">Clear</button>
        </div>
        <div id="searchingItems" style="margin-left: 145px;margin-top:10px">
            {{-- <ul>
                <li><a href="">Test</a></li>
            </ul> --}}
        </div>
    </div>
@stop

@push('script')
    <script>
        const searchingItems = $$('#searchingItems');
        const searchField = $$('#searchField');
        const clearBtn = $$('#clearBtn');

        searchingItems.style.display = 'none';
        searchField.addEventListener('keyup', async (e) => {

            let searchValue = e.currentTarget.value;
            if (searchValue) {
                searchingItems.style.display = 'block';
                try {
                    const response = await axios.post("{{ route('auto-complete-search.data') }}", {
                        searchValue
                    })
                    showDataInView(response.data);
                } catch (err) {
                    log(err.message)
                }
            } else {
                searchingItems.style.display = 'none';
            }

        });

        const showDataInView = (data) => {
            let html = "";
            if (data.length == 0) {
                html += `
                <ul>
                    <li><span>No Items Found!!</span></li>
                </ul>
            `
            } else {
                data.forEach(element => {
                    html += `
                <ul>
                    <li><span class="searchItem">${element.title}</span></li>
                </ul>
            `
                });
            }

            searchingItems.innerHTML = html;

            const searchItems = document.querySelectorAll('.searchItem');
            searchItems.forEach(element => {
                element.addEventListener('click', () => {
                    searchField.value = element.innerText;
                    searchingItems.style.display = 'none';
                });
            });
        }

        // Clear button

        clearBtn.addEventListener('click', function() {
            searchField.value = "";
            searchingItems.style.display = 'none';
        });
    </script>
@endpush
