@extends('layouts.app')


@section('content')
<style>
    .check_icon , .wrong_icon {

    position: absolute;

    top:0px;

    right: 0;

    left: 0;

    bottom: 0;

    display: flex;

    

    align-items: center;

    justify-content: center;

    

}
	#stop_cam span {

    z-index: 9999999;

    opacity: 1 !important;

    position: absolute;

    right: 32px;

    width: 36px;

    

    height: 37px;

    padding: 0;

    color: #fff!important;

    background: rgba(0,0,0,.6)!important;

    border-radius: 30px;


}
</style>

<style>

    /*.modal_select {*/

    /*    display: none;*/

    /*}*/
    
    #qr-reader video{
         width: 338px !important;
    }

    svg {

  width: 100px;

  display: block;

}

.video_voucher {

    /*width: 339px !important;*/

    object-fit: cover;

    display: block;

    max-height: 250px;

    z-index: -999999999;

    height: 250px;

    /*transform: scaleX(-1);*/
    margin-bottom: 10px;

}

.wrong_icon  {

    background: #ff000047;

}

.check_icon , .wrong_icon {

    position: absolute;

    top: 0px;

    right: 0;

    /* border-radius: 10px; */

    left: 0;

    bottom: 0;

    display: flex;

    

    align-items: center;

    justify-content: center;

   

}

.check_icon {

    background: #aaddaa47;

}

.styling_rotate {

    position: absolute;

    bottom: 4px;

    z-index: 99999;

    right: 4px;

    font-size: 40px;

    color: #ffcc00;

    cursor: pointer;

   

}

.styling_rotate:hover {

        color: #ffcc00;

}/*.styling_rotate:hoverqr-reader {*/

/*        color: #ffcc00;*/

/*}*/oke-dasharray: 1000;

  stroke-dashoffset: 0;

}

.path.circle {

  -webkit-animation: dash 0.9s ease-in-out;

  animation: dash 0.9s ease-in-out;

}

.path.line {

  stroke-dashoffset: 1000;

  -webkit-animation: dash 0.9s 0.35s ease-in-out forwards;

  animation: dash 0.9s 0.35s ease-in-out forwards;

}

.path.check {

  stroke-dashoffset: -100;

  -webkit-animation: dash-check 0.9s 0.35s ease-in-out forwards;

  animation: dash-check 0.9s 0.35s ease-in-out forwards;

}

p {

  text-align: center;

  // margin: 20px 0 60px;

  // font-size: 1.25em;

}

p.success {

  color: #73AF55;

}


.reedem_modal_detail {

    margin-top: -64px;

}

#stop_cam {

    position: relative;

    opacity: 1 !important;

}

#stop_cam span {

  
    z-index: 99999;
    opacity: 1 !important;
    position: absolute;
    right: 3px;
    width: 36px;
    top: 4px;
    height: 37px;
    padding: 0;
    color: #fff!important;
    background: rgba(0,0,0,.6)!important;
    border-radius: 30px;
    display: flex;
    justify-content: center;

}

@media (min-width: 576px) {

.modal-dialog {

    max-width: 371px;

    margin: 1.75rem auto;

    }



}

@media screen and (min-width: 768px) {

.modal-body {

    padding-left: 15px;

    padding-right: 15px;

    padding-top: 0;

    } 
    


}
#reader canvas {

    width: 343px !important;
    height: 250px !important;
    display: inline-block !important;
    position: absolute !important;
    z-index: 999999 !important;
    top: 0px;
    object-fit: cover;

}

    

</style>

  
        <div class="container" >
    <h3 class="text-center mt-3 mb-5"> Fastech Attendance</h3>
<button class="btn btn-md float-right m-lg-5 m-2 btn-primary" data-toggle="modal" data-target="#new_video">Add Employee</button>
<div style="overflow-x:auto; width:100%;">
@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>SR</th>
              <th>User ID</th>
            <th class="th-sm">Name
            </th>
            <th class="th-sm">Email
            </th>
            <th class="th-sm">Number
            </th>
            <th class="th-sm">Qr Code
            </th>
            <th class="th-sm">Joining date
            </th>
             <th class="th-sm">Total Presents
            </th>
            <th class="th-sm">Action
            </th>
          </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            ?>
@foreach ($user as $userdata)

<?php $i++; ?>
          <tr> 
              <td class="align-middle">{{ $i }}</td>
              <td class="align-middle">{{ $userdata->id }}</td>
            <td class="align-middle">{{$userdata->name }}</td>
            <td class="align-middle">@if(isset($userdata->email) && $userdata->email !=null){{$userdata->email }} @endif</td>
            <td class="align-middle">{{$userdata->number }}</td>
            <td class="align-middle">@if(isset($userdata->qr_code) && $userdata->qr_code !=null)  {!! QrCode::size(100)->generate($userdata->qr_code); !!} @endif </td>
            <td class="align-middle">{{$userdata->joining_date }}</td>
            <td class="align-middle"> {{DB::table('attendances')->where('Qr_code',$userdata->qr_code)->where('present',1)->count();}}</td>
            <td class="align-middle">  
            
            <a href="{{'attendancedetail/'.$userdata->id}}"><i class="fa fa-eye btn btn-primary mx-2" aria-hidden="true"></i>
                                 </a>
            <a href="javascript:void(0);" data-id="<?php echo $userdata->id; ?>" class="delete"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
                                           
        </td>
          </tr>
          @endforeach
        </tbody>

      </table>
      </div>

</div>
<div id="new_video" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="m-body">
                <span id="form_result"></span>
                <form id="btn-submit" method="post" action="/add_employee" enctype='multipart/form-data'>
                <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input style="width: 100% !important;;" type="text" class="form-control addName {{ $errors->has('title') ? 'is-invalid' : '' }}" required name="name"  aria-describedby="emailHelp" placeholder="Name">
                </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input style="width: 100% !important;" type="email" required class="form-control" name="email"  aria-describedby="emailHelp" required placeholder="Email">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Number</label>
                        <input style="width: 100% !important;" type="number" required class="form-control" name="number"  aria-describedby="emailHelp" placeholder="Number">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Joining Date</label>
                        <input style="width: 100% !important;" required type="date"  id="txtDate" class="form-control" name="joining_date"  aria-describedby="emailHelp">

                    </div>

<script>
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
  
    $('#txtDate').attr('max', maxDate);
});
</script>
              



                    <div class="modal-footer">
                        <input type="submit" name="action_button"  class="btn btn-primary btn-block" value="Add" />
                        <span
                            className="close cursor-pointer"
                            data-dismiss="modal"
                            aria-label="Close"
                            id="myModalClose">
                        </span>
                        <input type="hidden" name="_token" value={{csrf_token()}}>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="attend" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Scan Your Card</h5>
                <button type="button" class="close" id="stop_cam" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="m-body">
                <span id="form_result"></span>
                <form id="btn-submit" method="post" action="submitattendance" enctype='multipart/form-data'>
              
	        {{ csrf_field() }}
                <div  class="check_position"  id="pop"> 

                    <i class="fa fa-refresh" aria-hidden="true"></i>

                    <!--<div >-->

                       <i class="fa fa-check-circle fa-2x" aria-hidden="true" style="display:none;" id="checkmark"></i>

                       <!--</div>   -->

                 </div>

                         <p id="vcode"></p>

                <div class="main_video">

                    <div style="height: 272px;">
                    <div id="qr-reader"></div>
                    </div>
                
                    <div id="reader" ></div>
                    
                    <div class="check_icon" style="display:none;"  id="checkmark2">

                              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2" >

                              <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>

                              <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>

                            </svg>

                         </div>
                    <div class="wrong_icon" style="display:none;"  id="cross2">

                               <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2" >

                                              <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>

                                              <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>

                                              <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>

                                            </svg>

                              </div>
                    <a class="styling_rotate" id="changecam"><i id="hide" class="fa fa-refresh"></i></a>

                 </div>

                 
                 <h3 class="text-center"  id="hideor">{{__('OR')}}</h3>

                 <a class="btn btn-primary" id="imageselect" style="display:block; margin-top: 60px; background: #ffcc00;color: #000;border: none;border-radius: 40px;padding: 11px;" onclick="document.getElementById('qr-input-file').click()">{{ __('Select or take photo')}}</a>

                    <input type="file" class="text-center btn-primary"  id="qr-input-file" accept="image/*" style="display:none">

                 <input type="hidden"  name="qr_code"  value="" id="qr_voucher_code"> 



                 
                   <a > 

                     <button type="submit" id="thebutton" class="btn yes_btn reedem_modal_btn d-none">{{ __('scan')}}</button>

                     </a>
                 
              



                    
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ----------------------------- -->




 <meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 <script type="text/javascript">
    var camera = "environment";
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    document.getElementById("attendance").addEventListener("click", function() {
        
    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(qrCodeMessage) 
        {
            // handle on success condition with the decoded message
            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }
        const config = { fps: 10, qrbox: 250 };
        const html5QrCode = new Html5Qrcode("qr-reader");
        const qrCodeSuccessCallback = message => { 
           $('#cross2').hide();
           $('#checkmark2').hide();

             var form_data = 
             {
                code: message
            };

          $.ajax( {
                        type: 'get',
                        headers: {
                            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
                        },
                        url: '<?php echo url("varify_qr_code"); ?>',
                        data: form_data,
                        success: function ( msg ) {
                            if(msg == 0)
                             {
                              $('#cross2').show();
                              
                    
                             }
                            else
                             {
                              document.getElementById('qr_voucher_code').value = message;
                                $('#cross2').hide();
                                $('#qr-reader').hide();
                                
                                $('#checkmark2').show();
                                html5QrCode.stop().then(ignore => {
                                    document.getElementById("thebutton").click();
                                   
                                }).catch(err => {
                        
                    });
                                  
                            }
                        }

                    } );
          
           }
       
        html5QrCode.start({ facingMode: camera }, config, qrCodeSuccessCallback).catch(err => {
                     $('#cross2').hide();
                       $('#hideor').hide();
                       error_mess();
                    });
            
            $('#changecam').click(function(){
                   $('#cross2').hide();
                    html5QrCode.stop().then(ignore => {
                        if(camera == 'environment'){
                            camera = 'user';
                        }
                        else{
                            camera = 'environment';
                        }
                        
                        html5QrCode.start({ facingMode: camera }, config, qrCodeSuccessCallback);
                    }).catch(err => {
                      error_mess();
                       $('#hideor').hide();
                    });
                
            });
            $('#stop_cam').click(function(){
                 $('#cross2').hide();
                    html5QrCode.stop().then(ignore => {
                       
                       
                    }).catch(err => {
                      // Stop failed, handle it.
                    });
                
            });
            $('#imageselect').click(function(){
                  $('#cross2').hide();
                  document.getElementById('hide').style.display = "none";
                 
                    html5QrCode.stop().then(ignore => {
                  
                    
                    }).catch(err => {
                      // Stop failed, handle it.
                    });
                
            });
                });
            });
            
            
                
            </script>
            
           <script>
                const html5QrCode = new Html5Qrcode(/* element id */ "qr-reader");
            // File based scanning
            const fileinput = document.getElementById('qr-input-file');
            fileinput.addEventListener('change', e => {
              if (e.target.files.length == 0) {
                // No file selected, ignore 
                return;
              }
            
              const imageFile = e.target.files[0];
             
              // Scan QR Code
              html5QrCode.scanFile(imageFile, true)
              .then(qrCodeMessage => {
                
                //console.log(qrCodeMessage);
                var form_data = {

                code: qrCodeMessage

            };
                $.ajax( {

                   

                        type: 'get',

                        headers: {

                            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )

                        },

                        url: '<?php echo url("varify_qr_code"); ?>',

                        data: form_data,

                        success: function ( msg ) {
                  

                                   if(msg == 0){
                                           
                                           $('#cross2').show();

                                           setTimeout(function(){
                                             $('#cross2').hide();

                                                  }, 2000);
                                   }

                                   else{

                                      document.getElementById('qr_voucher_code').value = qrCodeMessage;


                                               $('#cross2').hide();

                                               $('#checkmark2').show();

                                          setTimeout(function(){

                                                document.getElementById("thebutton").click();

                                          }, 2500);

                                   }
                        }

                    } );
                
                
              })
              .catch(err => {
                    $('#cross2').show();

                   setTimeout(function(){
                     $('#cross2').hide();

                          }, 2000);
              });
            });

</script>

<script type="text/javascript">

  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>

<script type="text/javascript">

    $("body").on( "click", ".delete", function () {

    var task_id = $( this ).attr( "data-id" );

    
     swal({
            title: "Are you sure?",
            text: "Do you want to delete this Employee?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
         function(isConfirm){
           if (isConfirm) {
            $.ajax({
                url: 'delete_user/'+task_id,
                type: "get",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {id: task_id},
                dataType: "html",
                success: function () {
                    swal("Done!","It was succesfully deleted!","success");
                   setInterval(function() {
                       location.reload();
                        }, 2000);
                    }
            });
          }else{
                swal("Cancelled", "Your imaginary file is safe :)", "error");
          } 
       });


    } );

  </script>
@endsection



