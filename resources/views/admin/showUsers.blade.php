@extends('layouts.dashboard')
@section('title', 'Users')

@section('nav', 'User')
@section('content')

<div class="ui segment">
    <form class="ui form" action="{{url('admin/users/RegisterForm')}}" method="GET">
        <div class="ui left icon input">
            <i class="user plus icon"></i>
            <input class="ui fluid teal button" type="submit" value="Add Bidan">
        </div>
    </form>

    <table id="users" class="ui celled table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Puskesmas</th>
                <th>Desa</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="user{{$user->id}}">
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->puskesmas['nama']}}</td>
                <td>{{$user->desa['nama']}}</td>
                <td>
                    <a onclick="event.preventDefault();showEditForm({{$user->id}})" href="#">
                        <i class="pencil alternate icon"></i>
                    </a>
                    <a onclick="event.preventDefault();showDeleteForm({{$user->id}});" href="#">
                        <i class="trash icon"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Puskesmas</th>
                <th>Desa</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>


@include('admin.deleteBidan')
@include('admin.editBidan')

<style>
    .ui.segment {
        padding: 2em;
    }

    .ui.form {
        margin-bottom: 20px;
    }
</style>
<script>
    $(document).ready(function(){
        $('#users').DataTable();

    });

    $(document).on('click', '#btn_delete', function(){
        console.log('YES');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: '/admin/users/' + $('#delete_user_id').val(),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('.user' + $('#delete_user_id').val()).remove();
                // window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });


    });

    $(document).on('click', '#btn_edit', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'PUT',
            url: '/admin/users/' + $('#edit_user_id').val(),
            data: {
                name: $("#form_edit input[name=name]").val(),
                email: $("#form_edit input[name=email]").val(),
                // password: $("#form_edit input[name=password]").val(),
                // password_confirmation: $("#form_edit input[name=password_confirmation]").val(),
                id_puskesmas: $("#puskesmas").val(),
                id_desa: $("#desa").val(),
            },
            dataType : 'json',
            success: function(data) {
                console.log(data);

                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });


    });

    function showDeleteForm(id){
        $.ajax({
            type: 'GET',
            url : '/admin/users/' + id,
            success : function(data){
                console.log(data.user.id);
                $('#delete_user_id').val(data.user.id);
                $('#delete_modal').modal('show');
            }
        })
    };

    function showEditForm(id){
        $.ajax({
            type: 'GET',
            url : '/admin/users/EditForm/' + id,
            success : function(data){
                console.log(data.user.puskesmas.nama);
                $('#edit_user_id').val(data.user.id);
                $('#nama').val(data.user.name);
                $('#email').val(data.user.email);
                $('#puskesmas').text(data.user.puskesmas.nama);
                $('#puskesmas').val(data.user.puskesmas.id);

                console.log(data.user.id_puskesmas);

                $.each(data.list_desa, function(key, value){
                    if(value.id == data.user.desa.id){
                        $('#desa')
                            .append($("<option></option>")
                                .attr("value", value.id)
                                .attr("selected", "selected")
                                .text(value.nama));
                    }
                    else{
                        $('#desa')
                            .append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.nama));
                    }
                });

                $('.ui.dropdown').dropdown();
                $('#edit_modal').modal('show');
            }
        })
    };


</script>
@endsection
