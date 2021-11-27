@extends('admin.layouts.layout')

@section('header', 'Список пользователей')

@section('admin-header-name', 'Список пользователей')

@section("admin-content")
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr class="align-middle">
                <th>ID</th>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Создан</th>
                <th>Изменен</th>
                <th>Удален</th>
                <th>Админ</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="align-middle">{{ $user->id }}</td>
                <td class="align-middle">{{ $user->name }}</td>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="align-middle">{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                <td class="align-middle">{{ $user->updated_at->format('d-m-Y H:i:s') }}</td>
                <td class="align-middle">
                    @if(!is_null($user->deleted_at))
                        <form action="{{ route('admin.users.restore', ['user' => $user]) }}" method="POST">
                            <button class="btn btn-primary" type="submit" title="{{ $user->deleted_at->format('d-m-Y H:i:s') }}">Восстановить</button>
                            @method('PUT')
                            @csrf
                        </form>
                    @elseif(!$user->is_admin)
                        <form action="{{ route("admin.users.delete", ['user' => $user]) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    @else -
                    @endif
                </td>
                <td class="align-middle">
                    @if($user->is_admin) Да
                    @elseif(!is_null($user->deleted_at))
                        -
                    @else
                        <form action="{{ route('admin.users.make.admin', ['user' => $user]) }}" method="POST">
                            <button class="btn btn-warning" type="submit">Сделать админом</button>
                            @method('PUT')
                            @csrf
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
