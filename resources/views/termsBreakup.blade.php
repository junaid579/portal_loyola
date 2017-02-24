@include('layout.header')
@include('layout.topmenu')
@include('layout.leftsidemenu')
<?php $breadcrumb = array("Home","Terms Break up");
$breadcrumb_url = array("dashboard","termsBreakup");
$breadcrumbs = array_combine($breadcrumb, $breadcrumb_url);
$title = "Terms Break up";
$data  = array('breadcrumbs' => $breadcrumbs, 'title' => $title ); ?>
@include('layout.breadcrumb',array('data'=>$data))
<?php $classnames = array(); 
foreach($classes as $class){
   $classnames[$class->id] =  $class->class_name; 
} ?> 
<?php $feeTypes = array(); 
foreach($types as $type){
   $feeTypes[$type->id] =  $type->fee_name; 
} ?> 
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
                    <span class="caption-subject bold uppercase">Add Fee  Terms to a class</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="termsBreakup" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-body">
                       
                        <div class="form-group">
                            <label class="col-md-3 control-label">Classes</label>
                                <div class="col-md-4">
                                    <select id="class_id" name="class_id" class="form-control input-large">

                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                        @endforeach
                                                         
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fee Type</label>
                                <div class="col-md-4">
                                    <select id="type" name="type" class="form-control input-large">

                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->fee_name }}</option>
                                        @endforeach
                                                         
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Term</label>
                            <div class="col-md-4">
                                <input name="term" id="term" class="form-control" placeholder="Term Number" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Term Month</label>
                            <div class="col-md-4">
                                    <input name="term_month" id="term_month" class="form-control" placeholder="Month" type="Text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Term Amount</label>
                            <div class="col-md-4">
                                    <input name="term_amount" id="term_amount" class="form-control" placeholder="Term Amount" type="Text">
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
                            <span class="caption-subject bold uppercase"> Fee Terms For Classes</span>
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
                            <th> Class </th>
                            <th> Fee Type </th>   
                            <th> Term </th>
                            <th> Month </th>
                            <th> Amount </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody><?php $i = 1; ?>
                        @foreach($allbreaks as $breaks)
                        <?php if($i%2==0){ $odd_even = "odd gradeX"; }else{ $odd_even = "even gradeX"; } $i++; ?>
                        <tr class="<?php echo $odd_even; ?>">
                            <td> </td>
                            <td> {{ $classnames[$breaks->class_id] }} </td>
                            <td> {{ $feeTypes[$breaks->fee_type_id] }} </td>
                            <td> {{ $breaks->term }} </td>
                            <td> {{ $breaks->term_month }} </td>

                            <td> {{ $breaks->term_amount }} </td>
                            <td>    <?php if($breaks->status==1){ ?>
                                        <span class="label label-sm label-info"> Active </span>
                                    <?php }else if($breaks->status==2){ ?>
                                        <span class="label label-sm label-warning"> Suspended </span>
                                    <?php }else if($breaks->status==0){ ?>
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
                                            <a data-toggle="modal" href="#responsive" data-id="{{ $breaks->id }}" data-fee_type_id="{{ $breaks->fee_type_id }}" data-class="{{ $breaks->class_id }}" data-term="{{ $breaks->term }}" data-term_amount="{{ $breaks->term_amount }}" data-term_month="{{ $breaks->term_month }}" class="edit-data">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <?php if($breaks->status==1){ ?>
                                        <li>
                                            <a href="termsBreakup/{{ $breaks->id }}/2">
                                                <i class="icon-flag"></i> Suspend  </a>
                                        </li>
                                        <li>
                                            <a href="termsBreakup/{{ $breaks->id }}/0">
                                                <i class="icon-flag"></i> Delete  </a>
                                        </li>
                                        <?php }else if($breaks->status==2){ ?>
                                        <li>
                                            <a href="termsBreakup/{{ $breaks->id }}/1">
                                                <i class="icon-flag"></i> Activate  </a>
                                        </li>
                                        <li>
                                            <a href="termsBreakup/{{ $breaks->id }}/0">
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
                                    <span class="caption-subject bold uppercase">Edit Fee Class Terms</span>
                                </div>
                                <div class="btn-group pull-right" style="margin-top: 15px;">
                                    <button type="button" class="close text-right" data-dismiss="modal" aria-hidden="true"></button>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="termsBreakup" class="form-horizontal" method="POST" enctype="multipart/form-data" id="edit_form">
                                   <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Classes</label>
                                                <div class="col-md-4">
                                                    <select id="edit_class_id" name="edit_class_id" class="form-control input-large">

                                                        @foreach($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                                        @endforeach
                                                                         
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Fee Type</label>
                                                <div class="col-md-4">
                                                    <select id="edit_type" name="edit_type" class="form-control input-large">

                                                        @foreach($types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->fee_name }}</option>
                                                        @endforeach
                                                                         
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Term</label>
                                            <div class="col-md-4">
                                                <input name="edit_term" id="edit_term" class="form-control" placeholder="Term" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Term Month</label>
                                            <div class="col-md-4">
                                                    <input name="edit_term_month" id="edit_term_month" class="form-control" placeholder="Term Month" type="Text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Term Amount</label>
                                            <div class="col-md-4">
                                                    <input name="edit_term_amount" id="edit_term_amount" class="form-control" placeholder="Term Amount" type="Text">
                                            </div>
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
        $("#edit_class_id").val( $(this).data("class") );
        $("#edit_type").val( $(this).data("fee_type_id") );
        $("#edit_term").val( $(this).data("term") );
        $("#edit_term_amount").val( $(this).data("term_amount") ); 
        $("#edit_term_month").val( $(this).data("term_month") );            
           

    });
});
</script>