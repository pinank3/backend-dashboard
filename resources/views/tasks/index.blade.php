@extends('layouts.admin-master')

@section('title')
Task List
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Task List
     <span style="margin-left: 20px;"><a href="{{ route('add-task') }}" class="btn btn-primary">Add <i class="fas fa-plus"></i></a></span></h1>
  </div>
  <div class="section-body">
     <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">            
                <div class="box-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-error alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('error') }}
                    </div>
                    @endif

                    <table id="newList" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Task</th>                                
                                <th >Updated at</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($tasks as $key => $task)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{!! ucwords($task->task) !!}</td>
                            <td>{{ $task->updated_at }}</td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach             
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th width="50px">Sr.No.</th>
                            <th width="150px">Name</th>
                            <th>Description</th>
                        </tr>2
                    </tfoot> -->
                    </table>
                </div><!-- /.box-body -->
                </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section>  
</div>
</section>
@endsection