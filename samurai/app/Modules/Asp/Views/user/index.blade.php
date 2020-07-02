@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="wr-admin">
        <p class="bg-danger heading-text">Asp Manager</p>
        <div class="text-right">
            <a href="{{ route('asp.users.create') }}" class="btn-add">
                <i class="fa fa-plus"></i><span>追加する</span>
            </a>
        </div>
        <table class="table table-bordered table-users">
            <thead>
                <tr>
                    <th>アカウント名</th>
                    <th>ログインID</th>
                    <th>通知用メールアドレス</th>
                    <th></th>
                </tr>                
            </thead>
            <tbody>
                @foreach ($mods as $ite)
                    <tr>
                        <td>{{ $ite->fullName }}</td>
                        <td>{{ $ite->account }}</td>
                        <td>{{ $ite->email }}</td>
                        <td>
                            <a href="{{ route('asp.users.edit',$ite) }}" class="lk_icon"><i class="far fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>    
        </table>
        {!! $mods->appends(request()->query())->links() !!}
    </div> 
</div>
@endsection