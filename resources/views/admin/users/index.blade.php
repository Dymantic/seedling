@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center mv4">
        <h1 class="f1 normal ma0">Users</h1>
        <div class="flex justify-end items-center">
            <user-form url="/admin/users" button-text="Add User"></user-form>
        </div>
    </div>
    <user-list :initial-list='@json($users)'></user-list>
@endsection