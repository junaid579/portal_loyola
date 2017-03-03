@include('layout.header',array("pagetitle"=>"Stationery Inventory Master"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Stationery Inventory Master");
$breadcrumb_url   = array("dashboard", "stationeryinventorymaster");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Stationery Inventory Master";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Stationery Inventory Master','action'=>'stationeryinventorymaster','fnid'=>'submit_stationeryinventorymaster'))
@include('layout.forminputtext',array('ft'=>'Stationery Inventory Master','fin'=>'inventory_desc','fph'=>'Stationery Inventory Master','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Stationery Inventory Masters List'))

<form action="stationeryinventorymaster" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Stationery Inventory Master </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_inventory_desc" id="search_inventory_desc" value="<?php echo $search_inventory_desc;?>" class="form-control form-filter" /></th>
            
            {{-- For search buttons  --}} 
           @include('layout.search')
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allstationeryinventorymasters as $stationeryinventorymaster)
        <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
        ?>
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $stationeryinventorymaster->inventory_desc }} </td>
            <td>    <?php if ($stationeryinventorymaster->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                <?php } else if ($stationeryinventorymaster->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                <?php } else if ($stationeryinventorymaster->status == 0) {?>
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
                            <a data-toggle="modal" href="#view-data-model" data-id="{{ $stationeryinventorymaster->id }}" data-inventory_desc="{{ $stationeryinventorymaster->inventory_desc }}"   class="view-data"><i class="icon-docs"></i> View </a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#responsive" data-id="{{ $stationeryinventorymaster->id }}" data-inventory_desc="{{ $stationeryinventorymaster->inventory_desc }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                        </li>{{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$stationeryinventorymaster,'blade_name'=>'stationeryinventorymaster'))
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Stationery Inventory Master','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Stationery Inventory Master','fin'=>'view_inventory_desc'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Stationery Inventory Master','action'=>'stationeryinventorymaster','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Stationery Inventory Master','fin'=>'edit_inventory_desc','fph'=>'Stationery Inventory Master','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/stationeryinventorymaster.js");?>
@include('layout.footer',array('js' =>$js))


