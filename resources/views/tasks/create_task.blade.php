@extends('layouts.admin-master')

@section('title')
Create Task
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Add Task</h1>
  </div>
  <div class="section-body">
     <form role="form" method="post" action="{{ route('post-task') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">                         
                                    <div class="form-group">
                                        <label for="patnerDescription">Task</label>
                                        <input type="text" class="form-control" name="task" id="task" value="{{old('task')}}" placeholder="Enter Task" required>
                                    </div>
                                    <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
  </div>
</section>
@endsection
