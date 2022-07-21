@extends('layouts.app')
@push('css')

@endpush
@section('title', 'Attribute')
@section('project_title', 'Attribute')

@section('content')
    <div id="">
        <div class="row">
            <div class="col-md-4">
                <table class="table table-bordered" id="dynamic_degree">
                    <input type="hidden" id="counter" value="">
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm key_list" placeholder="Degree" id="key" name="education[][key]">
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm value_list" placeholder="Institution" id="value" name="education[][value]">
                        </td>
                        <td>
                            <button type="button" id="degree_add" class="btn btn-success"> <i class="fa fa-plus-circle"></i>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <form action="{{ route('file') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2 d-flex dynamic_filed">
                        <input type="file" name="images[]">
                        <div>
                            <button class="btn btn-sm btn-success" id="addMoreFile">+</button>
                        </div>
                    </div>

                    <div class="my-2">
                        <button class="btn btn-success btn-sm">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@push('script')
    <script>
    let counter = $('#counter').val();
    $('#degree_add').click(function () {
        var key = $('#key').val();
        var value = $('#value').val();
        key = '';
        value = '';
        counter ++;
        var html = '<tr class="dynamic-added" id="row'+counter+'">';
        html+= '<td><input type="text" class="form-control form-control-sm key_list" placeholder="Degree" id="key" name="education['+counter+'][key]" value="'+key+'"></td>';
        html+= '<td><input type="text" class="form-control form-control-sm value_list" placeholder="Institution" id="value" name="education['+counter+'][value]" value="'+value+'"></td>';
        html += '<td><button type="button" name="remove" id="'+counter+'" class="btn btn-danger fa fa-window-close btn_remove_degree"></button></td></tr>';

        $('#dynamic_degree').append(html);
    });

    //remove dynamic degree row
    $('body').on('click','.btn_remove_degree',function () {
        var id = $(this).attr('id');
        $('#row'+id).remove();
    });

    // Add more file
    $('body').on('click',"#addMoreFile",function(e){
        e.preventDefault();

        let html = ` <div class="form-group my-2 d-flex">
                        <input type="file" name="images[]">
                        <div>
                            <button class="btn btn-sm btn-danger deleteItem">-</button>
                        </div>
                    </div>`
        $('.dynamic_filed').after(html);
    });

    // Delete file
    $("body").on("click",".deleteItem",function(e){
        e.preventDefault();
        $(this).parents(".form-group").remove();
    });
    </script>
@endpush
