@include('layout.header')
@include('layout.topmenu')
@include('layout.leftsidemenu')
<?php $breadcrumb = array("Home","Fee Class Terms");
$breadcrumb_url = array("dashboard","feeClassTerms");
$breadcrumbs = array_combine($breadcrumb, $breadcrumb_url);
$title = "Fee Class Terms";
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
                    <span class="caption-subject bold uppercase">Add Fee Class Terms</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="feeClassTerms" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                            <label class="col-md-3 control-label">Terms</label>
                            <div class="col-md-4">
                                <input name="terms" id="terms" class="form-control" placeholder="Terms" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Amount</label>
                            <div class="col-md-4">
                                    <input name="amount" id="amount" class="form-control" placeholder="Amount" type="Text">
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
                            <span class="caption-subject bold uppercase"> Fee Class Terms</span>
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
                            <th> Terms </th>
                            <th> Amount </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody><?php $i = 1; ?>
                        @foreach($allterms as $terms)
                        <?php if($i%2==0){ $odd_even = "odd gradeX"; }else{ $odd_even = "even gradeX"; } $i++; ?>
                        <tr class="<?php echo $odd_even; ?>">
                            <td> </td>
                            <td> {{ $classnames[$terms->class_id] }} </td>
                            <td> {{ $feeTypes[$terms->fee_type_id] }} </td>
                            <td> {{ $terms->terms }} </td>
                            <td> {{ $terms->amount }} </td>
                            <td>    <?php if($terms->status==1){ ?>
                                        <span class="label label-sm label-info"> Active </span>
                                    <?php }else if($terms->status==2){ ?>
                                        <span class="label label-sm label-warning"> Suspended </span>
                                    <?php }else if($terms->status==0){ ?>
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
                                            <a data-toggle="modal" href="#responsive" data-id="{{ $terms->id }}" data-feeType="{{ $terms->fee_type_id }}" data-class="{{ $terms->class_id }}" data-terms="{{ $terms->terms }}" data-amount="{{ $terms->amount }}" class="edit-data">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <?php if($terms->status==1){ ?>
                                        <li>
                                            <a href="terms/{{ $terms->id }}/2">
                                                <i class="icon-flag"></i> Suspend  </a>
                                        </li>
                                        <li>
                                            <a href="terms/{{ $terms->id }}/0">
                                                <i class="icon-flag"></i> Delete  </a>
                                        </li>
                                        <?php }else if($terms->status==2){ ?>
                                        <li>
                                            <a href="terms/{{ $terms->id }}/1">
                                                <i class="icon-flag"></i> Activate  </a>
                                        </li>
                                        <li>
                                            <a href="terms/{{ $terms->id }}/0">
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
                                <form action="feeClassTerms" class="form-horizontal" method="POST" enctype="multipart/form-data" id="edit_form">
                                   <div class="form-body">
                       
                                        <div class="form-group">
                                                 <label class="col-md-3 control-label">Class</label>
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
                                            <label class="col-md-3 control-label">Terms</label>
                                            <div class="col-md-4">
                                                <input name="edit_terms" id="edit_terms" class="form-control" placeholder="Terms" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Amount</label>
                                        <div class="col-md-4">
                                                <input name="edit_amount" id="edit_amount" class="form-control" placeholder="Amount" type="Text">
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
        $("#edit_type").val( $(this).data("feeType") );
        $("#edit_terms").val( $(this).data("terms") );
        $("#edit_amount").val( $(this).data("amount") );            

    });
});
</script>