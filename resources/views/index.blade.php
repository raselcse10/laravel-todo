@extends('master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<span>Task List <span>
                	<span class="right">
	                	<a href="{{ URL::to('task/create') }}" class="btn btn-success" style="float:right;">
	                        Add Task
	                    </a>
                    <span>
                </div>

                <div class="panel-body">
                   	<table class="table table-bordered table-hover table-responsive">
						<thead>
							<tr class="success">
								<th>Title</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($tasks))
								@foreach ($tasks as $task)
								<tr>
									<td>{{ $task->title }}</td>
									<td>{{ $task->description }}</td>
									<td>
			                            <a href="{{ URL::to('task/' . $task->id . '/edit') }}" title="Edit Information"> Edit </a> |
			                            
			                            <form action="{{ url('task/'.$task->id) }}" method="POST">
	                                        {!! csrf_field() !!}
	                                        {!! method_field('DELETE') !!}

	                                        <input type="submit" value="Delete">
	                                    </form>
			                        </td>
								</tr>
								@endforeach
							@else 
							<tr>
								<td colspan="3">
									<center>No record found!</center>
								</td>
							</tr>
							@endif
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
