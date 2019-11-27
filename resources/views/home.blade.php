@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Doctors list
                    <button data-toggle="modal" data-target="#addModal" class="btn btn-info btn-sm" style="float: right;">Add New</button></div>

                <div class="card-body">
                    @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                    @endif

                    <table class="table table-bordered table-hover">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Reg. No</th>
                        <th>Education</th>
                        <th>Status</th>
                        <th>Modify</th>
                      </tr>
                      @foreach($doctors as $key=> $doctor)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->reg }}</td>
                        <td>{{ $doctor->education }}</td>
                        <td>{{ $doctor->is_active }}</td>
                        <td></td>
                      </tr>
                      @endforeach
                    </table>
                    <div class="row">
                      {{ $doctors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal to add doctors-->
    <div id="addModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Create New Doctor</h4>
          </div> 
          <form class="form-horizontal" action="{{ route('doctor.save') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label col-sm-12" for="name">Doctors name:</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="name" placeholder="Enter name" required="">
                      <span class="text-danger">{{ $errors->first('name')}}</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-12" for="reg">Doctors Reg. No:</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="reg" required="">
                       <span class="text-danger">{{ $errors->first('reg')}}</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-12" for="reg">Education details</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" rows="3" name="education" required=""></textarea> <span class="text-danger">{{ $errors->first('education')}}</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="control-label col-sm-12" for="reg">Visibity</label>
                            <div class="col-sm-12">
                                <label class="radio-inline">
                                  <input type="radio" name="is_active" value="1" checked required=""> Publish Now</label>
                                <label class="radio-inline">
                                  <input type="radio" value="0" name="is_active" required=""> Publish later</label>

                                 <span class="text-danger">{{ $errors->first('is_active')}}</span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label class="control-label col-sm-12" for="reg">Doctors photo (optinal)</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" name="photo">
                                 <span class="text-danger">{{ $errors->first('photo')}}</span>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-info">Submit Doctor</button>
              </div>
          </form>
        </div>

      </div>
    </div>
</div>
@endsection
