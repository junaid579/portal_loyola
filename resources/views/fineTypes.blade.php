@include('layout.header')
@include('layout.topmenu')
@include('layout.leftsidemenu')
<?php $breadcrumb = array("Home","Fine Types");
$breadcrumb_url = array("dashboard","fineTypes");
$breadcrumbs = array_combine($breadcrumb, $breadcrumb_url);
$title = "Fine Types";
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
                    <span class="caption-subject bold uppercase">Add Fine Type</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="fineTypes" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-body">
                       
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fine Name</label>
                            <div class="col-md-4">
                                <input name="fine_name" id="fine_name" class="form-control" placeholder="Fine Name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Heading on the bill</label>
                            <div class="col-md-4">
                                <input name="heading" id="heading" class="form-control" placeholder="Heading on the bill" type="text">
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
                            <span class="caption-subject bold uppercase"> Fine Types List</span>
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
                            <th> Fine Types </th>
                            <th> Heading on bill </th>   
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody><?php $i = 1; ?>
                        @foreach($allfineTypes as $fineTypes)
                        <?php if($i%2==0){ $odd_even = "odd gradeX"; }else{ $odd_even = "even gradeX"; } $i++; ?>
                        <tr class="<?php echo $odd_even; ?>">
                            <td> </td>
                            <td> {{ $fineTypes->fine_name }} </td>
                            <td> {{ $fineTypes->heading_on_bill }} </td>

                            <td>    <?php if($fineTypes->status==1){ ?>
                                        <span class="label label-sm label-info"> Active </span>
                                    <?php }else if($fineTypes->status==2){ ?>
                                        <span class="label label-sm label-warning"> Suspended </span>
                                    <?php }else if($fineTypes->status==0){ ?>
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
                                            <a data-toggle="modal" href="#responsive" data-id="{{ $fineTypes->id }}" data-name="{{ $fineTypes->fine_name }}" data-heading="{{ $fineTypes->heading_on_bill }}" class="edit-data">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <?php if($fineTypes->status==1){ ?>
                                        <li>
                                            <a href="fineTypes/{{ $fineTypes->id }}/2">
                                                <i class="icon-flag"></i> Suspend  </a>
                                        </li>
                                        <li>
                                            <a href="fineTypes/{{ $fineTypes->id }}/0">
                                                <i class="icon-flag"></i> Delete  </a>
                                        </li>
                                        <?php }else if($fineTypes->status==2){ ?>
                                        <li>
                                            <a href="fineTypes/{{ $fineTypes->id }}/1">
                                                <i class="icon-flag"></i> Activate  </a>
                                        </li>
                                        <li>
                                            <a href="fineTypes/{{ $fineTypes->id }}/0">
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
                                    <span class="caption-subject bold uppercase">Edit Fine Type</span>
                                </div>
                                <div class="btn-group pull-right" style="margin-top: 15px;">
                                    <button type="button" class="close text-right" data-dismiss="modal" aria-hidden="true"></button>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="fineTypes" class="form-horizontal" method="POST" enctype="multipart/form-data" id="edit_form">
                                   <div class="form-body">
                       
                                       
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Fine Types</label>
                                            <div class="col-md-4">
                                                <input name="edit_fine_type" id = "edit_fine_type"  class="form-control" placeholder="Fine Type" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Heading on the Bill</label>
                                            <div class="col-md-4">
                                                <input name="edit_heading" id = "edit_heading"  class="form-control" placeholder="Heading on the Bill" type="text">
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
        $("#edit_fine_type").val( $(this).data("name") );
        $("#edit_heading").val( $(this).data("heading") );
    });
});
</script>