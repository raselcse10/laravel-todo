@extends('master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<span>Create Task <span>
                </div>

                <div class="panel-body">
                	@if (count($errors) > 0)
					    
					    <div class="alert alert-danger">
					        <strong>Whoops! Something went wrong!</strong>

					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
                   	<form action="{{ route('task.update', $task->id) }}" method="post" class="form-horizontal">
	            		{!! csrf_field() !!}
	            		{!! method_field('PATCH') !!}
		            	<div class="form-group">
			                <label for="task" class="col-sm-3 control-label">Title</label>

			                <div class="col-sm-8">
			                    <input type="text" name="title" class="form-control" value="{{ $task->title }}">
			                </div>
			            </div>
			            <div class="form-group">
			                <label for="task" class="col-sm-3 control-label">Description</label>

			                <div class="col-sm-8">
			                    <textarea name="description" cols="30" rows="10" class="form-control">{{ trim($task->description) }}</textarea>
			                </div>
			            </div>
			            <div class="form-group">
			                <div class="col-sm-offset-3 col-sm-6">
			                    <button type="submit" class="btn btn-success">
			                        Update
			                    </button>
			                </div>
			            </div>
                   	</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
