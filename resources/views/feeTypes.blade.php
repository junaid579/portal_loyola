@include('layout.header',array("pagetitle"=>"Fee Types"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Fee Types");
$breadcrumb_url   = array("dashboard", "feeTypes");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Fee Types";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Fee Type','action'=>'feetypes','fnid'=>'submit_feeType'))
@include('layout.forminputtext',array('ft'=>'Fee Name','fin'=>'fee_name','fph'=>'Fee Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Heading on the Bill','fin'=>'heading_on_bill','fph'=>'Heading on the Bill','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Fee Types List'))

<form action="feetypes" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Fee Type </th>
            <th> Heading on the Bill </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_fee_name" id="search_fee_name" value="<?php echo $search_fee_name;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_heading_on_bill" id="search_heading_on_bill" value="<?php echo $search_heading_on_bill;?>" class="form-control form-filter" /></th>
           
            {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'feetypes'])
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allfeeTypes as $feeTypes)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $feeTypes->fee_name }} </td>
                <td> {{ $feeTypes->heading_on_bill }} </td>
                <td>    <?php if ($feeTypes->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($feeTypes->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($feeTypes->status == 0) {?>
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
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $feeTypes->id }}" data-fee_name="{{ $feeTypes->fee_name }}" data-heading_on_bill="{{ $feeTypes->heading_on_bill }}" "  class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $feeTypes->id }}" data-fee_name="{{ $feeTypes->fee_name }}" data-heading_on_bill="{{ $feeTypes->heading_on_bill }}" " class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                            {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$feeTypes,'blade_name'=>'feetypes'))
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Fee Types','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Fee Name','fin'=>'view_fee_name'))
@include('layout.forminputvalue',array('ft'=>'Heading on the Bill ','fin'=>'view_heading_on_bill'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Fee Types','action'=>'feetypes','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Fee Name','fin'=>'edit_fee_name','fph'=>'Fee Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Heading on the Bill','fin'=>'edit_heading_on_bill','fph'=>'Heading on the Bill','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/feeTypes.js");?>
@include('layout.footer',array('js' =>$js))


