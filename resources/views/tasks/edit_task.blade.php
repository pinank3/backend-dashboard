 @extends('layouts.admin-master')

@section('title')
Edit Profile ({{ $user->name }})
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit Task</h1>
  </div>
  <div class="section-body">
      <form role="form" method="post" action="{{ route('update-task',['id'=>base64_encode($taskDetails->id)]) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="taskContent">Task</label>
                                        <input type="text" class="form-control" name="task" id="task" value="{{$taskDetails->task}}" placeholder="Enter task" >
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
  </div>
</section>
@endsection
