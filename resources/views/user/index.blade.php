@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customers Dashboard</div>

                <div class="card-body">
                    <form class="col-md-6 offset-md-6" action="{{ route('user') }}" method="get">
                        @csrf
                        <div class="form-group row ">
                            <input type="text" name="search" class="form-control col-md-8" placeholder="Search by Age" />
                            <button type="submit" class="btn btn-primary col-md-3"><i class="fa fa-search"> Search</i></button>
                        </div>
                    </form>
                    <div class="mytable">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Email</th> 
                                        <th>Age</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse($users as $index => $user)
                                        <tr>
                                            <td>{{ ($users->currentpage()-1) * $users->perpage() + $index + 1 }} </td>
                                            <td>{{$user->name}} </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->age}}</td>
                                            <td>{{$user->address}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No Registered Customer with age more than 50 years </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                             <div class="right">{{ $users->links() }} </div> 
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
