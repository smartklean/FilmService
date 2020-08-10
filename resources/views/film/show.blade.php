@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Payment confirmation modals -->
            <div id="PaymentModal" class="modal fade text-primary" role="dialog">
               <div class="modal-dialog ">
                 <form action="" id="paymentForm" method="POST">
                     <div class="modal-content">
                         <div class="modal-header bg-primary">
                             <button type="button" class="close" data-dismiss="modal"> Payment</button>
                             <h4 class="modal-title text-center">PAYMENT CONFIRMATION</h4>
                         </div>
                         <div class="modal-body">
                             {{ csrf_field() }}
                             <!-- {{ method_field('DELETE') }} -->
                             <h4 class="text-center"> You're about to be charge N{{$film->price}} for a Film ?</h4>
                         </div>
                         <div class="modal-footer">
                             <center>
                                 <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                 <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Pay</button>
                             </center>
                         </div>
                     </div>
                 </form>
               </div>
            </div>
            <!-- Payment modal ends --> 

            <div class="card">
                <div class="card-header">Film {{$film->title}}</div>
                <div class="card-body">
                   @if(Auth::user()->role == 'admin')
                   <form action="{{ route('updateFilm', $film->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$film->title}}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                               <select class="form-control" name="genre" id="genre" required>
                                    <option value="{{$film->genre}}">{{$film->genre}}</option>
                                        @foreach($genres as $genre)
                                            <option value="{{$genre->name}}">{{$genre->name}}</option>
                                        @endforeach
                                </select>


                                @error('genre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$film->price}}" required >

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                         <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                           
                            </div>
                        </div>                  
                    </form>
                   @else
                        <table class="table table-profile">
                                        
                            <tbody>
                                
                                <tr>
                                    <td class="field">Film Title</td>
                                    <td>{{$film->title}}</td>
                                </tr>
                                <tr>
                                    <td class="field"> Film Category</td>
                                    <td>{{$film->genre}}</td>
                                </tr>
                                <tr>
                                    <td class="field">Amount</td>
                                    <td>{{$film->price}}</td>
                                </tr>
                                    <td class="field">&nbsp;&nbsp;</td>
                                    <td>
                                         <a href="javascript:;" data-toggle="modal" onclick = "paymentData({{$film->id}})" data-target="#PaymentModal" class="btn btn-primary fa fa-trash"> Purchase </a>

                                    </td>
                                    
                                </tr>

                            </tbody>
                        </table>

                   @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-script')
    <script type="text/javascript">
         function paymentData(id)
         {
             var id = id;
             var url = '{{ route("purchase", "id") }}';
             url = url.replace('id', id);
             $("#paymentForm").attr('action', url);
         }

         function formSubmit()
         {
             $("#paymentForm").submit();
         }
     </script>
@endsection
