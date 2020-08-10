<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Film Sales Services</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Film Sales Services
                </div>
                <form class="col-md-6 offset-md-6" action="{{ route('welcome') }}" method="get">
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
                                            <a class="btn btn-primary fa fa-pencil-square-o" href="{{route('purchase', $film->id)}}">Purchase</a> 
                                        </td>
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No Registered film at the moment</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                         <div class="right">{{ $films->links() }} </div> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
