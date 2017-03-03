@include('layout.header',array("pagetitle"=>"Stationery Master"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Stationery Master");
$breadcrumb_url   = array("dashboard", "Stationery Master");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Stationery Master";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Stationery Master','action'=>'stationerymaster','fnid'=>'submit_stationeryMaster'))
@include('layout.forminputtext',array('ft'=>'Stationery Name','fin'=>'stationery_name','fph'=>'Stationery Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Amount','fin'=>'amount','fph'=>'Amount','fiv'=>''))

@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Stationery Master List'))

<form action="stationerymaster" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Stationery Name </th>
            <th> Amount </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_stationery_name" id="search_stationery_name" value="<?php echo $search_stationery_name;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_amount" id="search_amount" value="<?php echo $search_amount;?>" class="form-control form-filter" /></th>
           
            {{-- For search buttons  --}} 
           @include('layout.search')
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allstationeryMaster as $stationeryMaster)
        <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
        ?>
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $stationeryMaster->stationery_name }} </td>
            <td> {{ $stationeryMaster->amount }} </td>
            <td>    <?php if ($stationeryMaster->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                <?php } else if ($stationeryMaster->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                <?php } else if ($stationeryMaster->status == 0) {?>
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
                            <a data-toggle="modal" href="#view-data-model" data-id="{{ $stationeryMaster->id }}" data-stationery_name="{{ $stationeryMaster->stationery_name }}" data-amount="{{ $stationeryMaster->amount }}"   class="view-data"><i class="icon-docs"></i> View </a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#responsive" data-id="{{ $stationeryMaster->id }}" data-stationery_name="{{ $stationeryMaster->stationery_name }}" data-amount="{{ $stationeryMaster->amount }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                        </li>{{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$stationeryMaster,'blade_name'=>'stationerymaster'))
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Stationery Master','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Stationery Name','fin'=>'view_stationery_name'))
@include('layout.forminputvalue',array('ft'=>'Amount','fin'=>'view_amount'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Stationery Master member','action'=>'stationerymaster','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Stationery Name','fin'=>'edit_stationery_name','fph'=>'Stationery Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Amount','fin'=>'edit_amount','fph'=>'Amount','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/stationeryMaster.js");?>
@include('layout.footer',array('js' =>$js))


