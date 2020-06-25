@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($lastDate[0]->ddate)<small>You Last Uploaded on {{ date('d-M-y', strtotime($lastDate[0]->ddate)) }}</small> @endif
            <div class="card">
                <div class="card-header">Upload Files</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="uploads/{{ Session::get('file') }}">
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
  


                    <form id="form" action="{{ route('files.store') }}" method="post" enctype="multipart/form-data" >
                        @csrf


<input id="uploadImage" class="form-control" type="file" accept=".csv,.xlsx,xls,.zip" name="file" />
<br><br>
<select class="form-control" id="sel1" name="source">

                      <option value="">Select Category..</option>
                      <option value="Paydirect">Paydirect</option>
                      <option value="OneCard">OneCard</option>
                      <option value="Amplified">Amplified DB</option>
                    </select>
                    <hr/>
<input class="btn btn-success" type="submit" value="Upload">
</form>
                

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var uploadField = document.getElementById("uploadImage");

uploadField.onchange = function() {
    if(this.files[0].size > 1000000048){
       alert("File is too big! \nMust not be more than 1GB");
       this.value = "";
    };
};
</script>
@endsection
