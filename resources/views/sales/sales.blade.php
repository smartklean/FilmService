@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sales Dashboard</div>

                <div class="card-body">
                   <div class="mytable">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Customer</th>
                                        <th>Film</th> 
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                   @forelse($sales as $index => $sale)
                                  
                                  
                                    
                                        <tr>
                                            <td>{{ ($sales->currentpage()-1) * $sales->perpage() + $index + 1 }} </td>
                                             @foreach($users as $user)
                                              @if($sale->user_id == $user->id)
                                                <td>{{$user->name}}</td>
                                             @endif
                                            @endforeach
                                             @foreach($films as $film)
                                              @if($sale->film_id == $film->id)
                                                <td>{{$film->title}}</td>
                                             @endif
                                            @endforeach
                                            <td>{{$sale->amount}}</td>
                                            <td>{{$sale->time}}</td>
                                        </tr>
                                        
                                       
                                    @empty
                                        <tr>
                                            <td colspan="4">No sale in your store </td>
                                        </tr>

                                        
                                    @endforelse
                                </tbody>
                            </table>
                             <div class="right">{{ $sales->links() }} </div> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
