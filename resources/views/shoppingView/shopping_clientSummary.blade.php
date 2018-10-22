@extends('layouts.client')

@section('content')
    <div class="container">

        <form method="POST" action="{{route('overall_post')}}">
            {{csrf_field()}}
        <div class="row">

          

             <div class="col-12">
             	 @include ('layouts.basketcard')

            </div>
<div class="row ">
                        <div class="col-6">
                            @if(isset($btn_nav['back']))
                                <a href="{{$btn_nav['back']['url']}}"
                                   class="form-control col-4 btn btn_back">Backwards</a>
                            @endif
                        </div>
                        <div class="col-6">
                            <button type="submit" class="form-control col-4 float-right btn btn-success">
                                Complete order
                            </button>

                        </div>

        </div>
        </div>
                
        <br>
        </form>
    </div>

    <script src="{{ URL::asset('js/code/overallView.js') }}"></script>
@endsection