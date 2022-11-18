@extends('admin.panel')
@section('title','User')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                            <h4><strong>Data</strong> <strong class="text-warning">User</strong></h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped shadow" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Register</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $i)
                                        <tr>
                                            <td>{{$i->id}}</td>
                                            <td>{{$i->name}}</td>
                                            <td>{{$i->email}}</td>
                                            <td>{{Carbon\Carbon::parse($i->created_at)->isoFormat('dddd, D MMMM Y H:m:d') }}</td>
                                            <td>
                                                @if($i->role==1)
                                                <span class="badge badge-primary">
                                                    {{($i->role==1) ? 'Admin':''}}
                                                </span>
                                                @else
                                                <span class="badge badge-secondary">
                                                    {{($i->role==1) ? '':'User'}}
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($i->status==1)
                                                <span class="badge badge-success">
                                                    {{($i->status==1) ? 'Online':''}}
                                                </span>
                                                @else
                                                <span class="badge badge-secondary">
                                                    {{($i->status==1) ? '':'Offline'}}
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url ('admin/user/'.$i->id)}}" class="btn btn-sm btn-primary shadow">Edit</a>
                                                |
                                                <a href="{{url ('admin/user/delete/'.$i->id)}}" class="btn btn-sm btn-danger shadow" onclick="return confirm('Yakin Hapus Data?')">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>


@endsection
