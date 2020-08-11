@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Payment confirmation modals -->
            <div id="PaymentModal" class="modal fade text-primary" role="dialog">
               <div class="modal-dialog ">
                 <form action="" id="paymentForm" method="GET">
                     <div class="modal-content">
                         <div class="modal-header bg-primary">
                             <button type="button" class="close" data-dismiss="modal"> Payment</button>
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
                        <form action="{{ route('purchase', $film->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$film->title}}" readonly="true">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                              <input id="genre" type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{$film->genre}}" readonly="true">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$film->price}}" readonly="true" >

                            </div>
                        </div>  

                        <div class="form-group row" style="display: none">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="film_id" type="text" class="form-control @error('film_id') is-invalid @enderror" name="film_id" value="{{$film->id}}" readonly="true" >

                            </div>
                        </div>  
                         <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Purchase') }}
                                </button>

                            </div>
                        </div>                  
                    </form>

                   @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
