@include('layout.header')
@include('layout.topmenu')
@include('layout.leftsidemenu')
<?php $breadcrumb = array("Home","Staff");
$breadcrumb_url = array("dashboard","staff");
$breadcrumbs = array_combine($breadcrumb, $breadcrumb_url);
$title = "Staff";
$data  = array('breadcrumbs' => $breadcrumbs, 'title' => $title ); ?>
@include('layout.breadcrumb',array('data'=>$data))

<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert alert-info display-show">
                <button class="close" data-close="alert"></button>
                <span> {{ Session::get('message') }} </span>
            </div>
        @endif
        @if(Session::has('error_message'))
            <div class="alert alert-warning display-show">
                <button class="close" data-close="alert"></button>
                <span> {{ Session::get('error_message') }} </span>
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer"></i>
                    <span class="caption-subject bold uppercase">Add Staff Member</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="staff" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-body">
                       
                        <div class="form-group">
                            <label class="col-md-3 control-label">First name</label>
                            <div class="col-md-4">
                                <input name="first_name" id="first_name" class="form-control" placeholder="First name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last name</label>
                            <div class="col-md-4">
                                <input name="last_name" id="last_name" class="form-control" placeholder="Last name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mobile</label>
                            <div class="col-md-4">
                                <input name="mobile" id="mobile" class="form-control" placeholder="Mobile" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">e-Mail</label>
                            <div class="col-md-4">
                                <input name="mail" id="mail" class="form-control" placeholder="e-Mail" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="_method" value="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <button type="submit" class="btn green">Submit</button>
                                <button type="reset" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="row">
                    <div class="col-md-6">
                        <div class="caption font-dark" style="margin-top: 10px;">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> Staff Members List</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group pull-right">
                            <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-print"></i> Print </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th> SNO.</th>
                            <th> First Name  </th>
                            <th> Last Name </th>
                            <th> Mobile Number </th>   
                            <th> e-Mail </th>      
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody><?php $i = 1; ?>
                        @foreach($allstaff as $staff)
                        <?php if($i%2==0){ $odd_even = "odd gradeX"; }else{ $odd_even = "even gradeX"; } $i++; ?>
                        <tr class="<?php echo $odd_even; ?>">
                            <td> </td>
                            <td> {{ $staff->f_name }} </td>
                            <td> {{ $staff->l_name }} </td>
                            <td> {{ $staff->mobile }} </td>
                            <td> {{ $staff->email }} </td>

                            <td>    <?php if($staff->status==1){ ?>
                                        <span class="label label-sm label-info"> Active </span>
                                    <?php }else if($staff->status==2){ ?>
                                        <span class="label label-sm label-warning"> Suspended </span>
                                    <?php }else if($staff->status==0){ ?>
                                        <span class="label label-sm label-danger"> Deleted </span>
                                    <?php } ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-left" role="menu">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="icon-docs"></i> View </a>
                                        </li>
                                        <li>
                                            <a data-toggle="modal" href="#responsive" data-id="{{ $staff->id }}" data-fname="{{ $staff->f_name }}" data-lname="{{ $staff->l_name }}" data-mobile="{{ $staff->mobile }}" data-mail="{{ $staff->email }}" class="edit-data">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <?php if($staff->status==1){ ?>
                                        <li>
                                            <a href="staff/{{ $staff->id }}/2">
                                                <i class="icon-flag"></i> Suspend  </a>
                                        </li>
                                        <li>
                                            <a href="staff/{{ $staff->id }}/0">
                                                <i class="icon-flag"></i> Delete  </a>
                                        </li>
                                        <?php }else if($staff->status==2){ ?>
                                        <li>
                                            <a href="staff/{{ $staff->id }}/1">
                                                <i class="icon-flag"></i> Activate  </a>
                                        </li>
                                        <li>
                                            <a href="staff/{{ $staff->id }}/0">
                                                <i class="icon-flag"></i> Delete  </a>
                                        </li>
                                       <?php  } ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>    
<div id="responsive" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-equalizer"></i>
                                    <span class="caption-subject bold uppercase">Edit Staff Members</span>
                                </div>
                                <div class="btn-group pull-right" style="margin-top: 15px;">
                                    <button type="button" class="close text-right" data-dismiss="modal" aria-hidden="true"></button>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="staff" class="form-horizontal" method="POST" enctype="multipart/form-data" id="edit_form">
                                   <div class="form-body">
                       
                                               
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">First name</label>
                                            <div class="col-md-4">
                                                <input name="edit_fname" id="edit_fname" class="form-control" placeholder="First name" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Last name</label>
                                            <div class="col-md-4">
                                                <input name="edit_lname" id="edit_lname" class="form-control" placeholder="Last name" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mobile</label>
                                            <div class="col-md-4">
                                                <input name="edit_mobile" id="edit_mobile" class="form-control" placeholder="Mobile" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">e-Mail</label>
                                            <div class="col-md-4">
                                                <input name="edit_mail" id="edit_mail" class="form-control" placeholder="e-Mail" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <input type="hidden" name="edit_id" id="edit_id">
                                                <input type="hidden" name="_method" value="put">
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <button type="submit" class="btn green">Update</button>
                                                <button type="reset" class="btn default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')
<script type="text/javascript">
$(document).ready(function(){
    $("#sample_1").on("click",".edit-data", function(){
        $("#edit_form")[0].reset();
        $("#edit_id").val( $(this).data("id") );
        $("#edit_fname").val( $(this).data("fname") );
        $("#edit_lname").val( $(this).data("lname") );
        $("#edit_mobile").val( $(this).data("mobile") );
        $("#edit_mail").val( $(this).data("mail") );

    });
});
</script>