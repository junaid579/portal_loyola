@include('layout.header',array("pagetitle"=>"Fee Adjustment Master"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Fee Adjustment Master");
$breadcrumb_url   = array("dashboard", "Fee Adjustment Master");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Fee Adjustment Master";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Fee Adjustment Master','action'=>'adjustmentmaster','fnid'=>'submit_adjustmentMaster'))
@include('layout.forminputtext',array('ft'=>'Fee Adjustment Name','fin'=>'adjustment_reason','fph'=>'Fee Adjustment Name','fiv'=>''))


@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Fee Adjustment Master List'))

<form action="adjustmentmaster" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Fee Adjustment Name </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_adjustment_reason" id="search_adjustment_reason" value="<?php echo $search_adjustment_reason;?>" class="form-control form-filter" /></th>
           
           
            {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'adjustmentmaster'])
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($alladjustmentMaster as $adjustmentMaster)
        <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
        ?>
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $adjustmentMaster->adjustment_reason }} </td>
            <td>    <?php if ($adjustmentMaster->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                <?php } else if ($adjustmentMaster->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                <?php } else if ($adjustmentMaster->status == 0) {?>
                    <span class="label label-sm label-danger"> Deleted </span>
                <?php }?>
            </td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu">
                        <li>
                            <a data-toggle="modal" href="#view-data-model" data-id="{{ $adjustmentMaster->id }}" data-adjustment_reason="{{ $adjustmentMaster->adjustment_reason }}"  class="view-data"><i class="icon-docs"></i> View </a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#responsive" data-id="{{ $adjustmentMaster->id }}" data-adjustment_reason="{{ $adjustmentMaster->adjustment_reason }}" class="edit-data"><i class="icon-tag"></i> Edit </a>
                        </li>{{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$adjustmentMaster,'blade_name'=>'adjustmentmaster'))
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Fee Adjustment Master','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Fee Adjustment Name','fin'=>'view_adjustment_reason'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Fee Adjustment Master member','action'=>'adjustmentmaster','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Fee Adjustment Name','fin'=>'edit_adjustment_reason','fph'=>'Fee Adjustment Name','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/adjustmentMaster.js");?>
@include('layout.footer',array('js' =>$js))


