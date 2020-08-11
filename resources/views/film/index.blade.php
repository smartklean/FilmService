@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Films Dashboard</div>
                 <!-- Delete confirmation modals -->
            <div id="DeleteModal" class="modal fade text-danger" role="dialog">
               <div class="modal-dialog ">
                 <form action="" id="deleteForm" method="GET">
                     <div class="modal-content">
                         <div class="modal-header bg-danger">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
                         </div>
                         <div class="modal-body">
                             {{ csrf_field() }}
                             <!-- {{ method_field('DELETE') }} -->
                             <h4 class="text-center"> You're about to delete a Film ?</h4>
                         </div>
                         <div class="modal-footer">
                             <center>
                                 <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                 <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                             </center>
                         </div>
                     </div>
                 </form>
               </div>
            </div>
            <!-- Delete modal ends -->  

                <div class="card-body">
                    <a class="btn btn-success col-md-2 offset-md-10" href="{{route('addFilm')}}">Add Film <i class="fa fa-plus"></i></a>
                     <br><br>
                    <form class="col-md-6 offset-md-6" action="{{ route('film') }}" method="get">
                        @csrf
                        <div class="form-group row ">
                            <input type="text" name="search" class="form-control col-md-8" placeholder="Search by Category" />
                            <button type="submit" class="btn btn-primary col-md-3"><i class="fa fa-search"> Search</i></button>
                        </div>
                    </form>
                    <div class="mytable">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Category</th> 
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse($films as $index => $film)
                                        <tr>
                                            <td>{{ ($films->currentpage()-1) * $films->perpage() + $index + 1 }} </td>
                                            <td>{{$film->title}} </td>
                                            <td>{{$film->genre}}</td>
                                            <td>{{$film->price}}</td>
                                            <td>
                                                <a class="btn btn-primary fa fa-pencil-square-o" href="{{route('purchaseFilm', $film->id)}}">Edit</a> | 
                                                <a href="javascript:;" data-toggle="modal" onclick = "deleteData({{$film->id}})" data-target="#DeleteModal" class="btn btn-danger fa fa-trash"> Delete </a>
                                            </td>
                                            
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No Registered film </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                             <div class="right">{{ $films->links() }} </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-script')
    <script type="text/javascript">
         function deleteData(id)
         {
             var id = id;
             var url = '{{ route("deleteFilm", "id") }}';
             url = url.replace('id', id);
             $("#deleteForm").attr('action', url);
         }

         function formSubmit()
         {
             $("#deleteForm").submit();
         }
     </script>
    @endsection