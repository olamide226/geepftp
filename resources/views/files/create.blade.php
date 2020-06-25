@extends('layouts.app')

<style>

#progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}

#progress-div {border:#0FA015 1px solid;padding: 5px 0px;margin:30px 0px;border-radius:4px;text-align:center;}
#targetLayer{width:100%;text-align:center;}

</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($lastDate[0]->ddate)<small>You Last Uploaded on {{ date('jS-M-yy h:i:s A', strtotime($lastDate[0]->ddate)) }}</small> @endif
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
            
            <div class="alert alert-danger" id="err1">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="alert alert-danger" id="err" style="display: none;">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul id="ul">
                    
                </ul>
            </div>
  


                    <form id="form" action="{{ route('files.store') }}" method="post" enctype="multipart/form-data" >
                        @csrf


<input id="uploadImage" class="form-control" type="file" accept=".csv,.xlsx,xls,.zip" name="file" required />
<br><br>
<select class="form-control" id="sel1" name="source" required>

                      <option value="">Select Source..</option>
                      <option value="Paydirect">Paydirect</option>
                      <option value="OneCard">OneCard</option>
                      <option value="Amplified">Amplified DB</option>
                    </select>
                    <hr/>
<input class="btn btn-success" type="submit" value="Upload" id="sub">
<div id="progress-div"><div id="progress-bar"></div></div>


</form>
    <div id="loader-icon" style="display:none;"><img src="LoaderIcon.gif" /></div>

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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jform.js') }}"></script>
    <!-- <script src="http://malsup.github.com/jquery.form.js"></script> -->

<script type="text/javascript">
    $(document).ready(function() { 
     $('#form').submit(function(e) {  
        if($('#uploadImage').val()) {
            e.preventDefault();
            $('#sub').attr('disabled',true);
            $('#loader-icon').show();
            $('#err').hide();
            $('#err1').hide();
            $('#ul').empty();
            $(this).ajaxSubmit({ 
                target:   '#app', 
                beforeSubmit: function() {
                  $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){ 
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                },
                success:function (data){
                    // $('#loader-icon').hide();
                    window.location = "{{ route('showSuccess') }}"


                },
                error: function(xhr, error){
                    $('#loader-icon').hide();
                    const values = Object.values(xhr.responseJSON.errors)
        // console.log(xhr.responseJSON.errors.source[0]); console.log(xhr.responseJSON.errors.file[0]);
        // console.log(values)
        for (const key of values) {
            // console.log(key[0]);
            $('#ul').append(`<li>${key[0]}</li>`)
        }
        $('#err').show();
             },
                resetForm: true 
            }); 
            return false; 
        }
    });
}); 

</script>
@endsection
