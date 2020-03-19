@extends('layouts.app')

@section('content')
<div class="container"  >
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" >
                <div class="card-header text-center" >FORM EDIT DATA</div>
                <hr>

                <div class="card-body">
                    <form method="POST" action="{{ route('forms.update', $forms->id) }}">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-12">
                            <input type="text" name="title" value="{{$forms->title}}"><br><br>
                            </div>
                            @if($errors->has('title'))
				                <p>{{ $errors->first('title')}}</p>
			                @endif
                            <br>
                            <div class="col-md-6">
                                <p>Description</P>
                                    <textarea name="description"  rows="8" cols="80">{{$forms->description}}</textarea> <br>
                                    @if($errors->has('description'))
                                        <p>{{ $errors->first('description')}}</p>
                                    @endif
                            </div>
                        </div>

                  
                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('UPDATE') }}
                                </button>
                                
                                <input type="hidden" name="_method" value="put">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection