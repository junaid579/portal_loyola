@include('layout.header',array("pagetitle"=>"Pick Up Point"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Pick Up Point");
$breadcrumb_url   = array("dashboard", "pickpoint");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Pick Up Point";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Pick Up Point','action'=>'pickpoint','fnid'=>'submit_pickpoint'))
@include('layout.forminputtext',array('ft'=>'Pick up Point name','fin'=>'pickup_point_name','fph'=>'Pick up Point name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Cost','fin'=>'cost','fph'=>'Cost','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'One way Cost','fin'=>'one_way_cost','fph'=>'One way Cost','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Terms','fin'=>'no_of_terms','fph'=>'Terms','fiv'=>''))

@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Pick Up Point List'))

<form action="pickpoint" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Pick up Point name </th>
            <th> Cost </th>
            <th> One way Cost </th>
            <th> Terms </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_pickup_point_name" id="search_pickup_point_name" value="<?php echo $search_pickup_point_name;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_cost" id="search_cost" value="<?php echo $search_cost;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_one_way_cost" id="search_one_way_cost" value="<?php echo $search_one_way_cost;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_no_of_terms" id="search_no_of_terms" value="<?php echo $search_no_of_terms;?>" class="form-control form-filter" /></th>
            
            {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'pickpoint'])
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allpickpoint as $pickpoint)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $pickpoint->pickup_point_name }} </td>
                <td> {{ $pickpoint->cost }} </td>
                <td> {{ $pickpoint->one_way_cost }} </td>
                <td> {{ $pickpoint->no_of_terms }} </td>
                <td>    <?php if ($pickpoint->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($pickpoint->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($pickpoint->status == 0) {?>
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
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $pickpoint->id }}" data-pickup_point_name="{{ $pickpoint->pickup_point_name }}" data-cost="{{ $pickpoint->cost }}" data-one_way_cost="{{ $pickpoint->one_way_cost }}" data-no_of_terms="{{ $pickpoint->no_of_terms }}"  class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $pickpoint->id }}" data-pickup_point_name="{{ $pickpoint->pickup_point_name }}" data-cost="{{ $pickpoint->cost }}" data-one_way_cost="{{ $pickpoint->one_way_cost }}" data-no_of_terms="{{ $pickpoint->no_of_terms }}" class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                            {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$pickpoint,'blade_name'=>'pickpoint'))
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Pick Up Point','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Pick up Point name','fin'=>'view_pickup_point_name'))
@include('layout.forminputvalue',array('ft'=>'Cost','fin'=>'view_cost'))
@include('layout.forminputvalue',array('ft'=>'One way Cost','fin'=>'view_one_way_cost'))
@include('layout.forminputvalue',array('ft'=>'no_of_terms','fin'=>'view_no_of_terms'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Pick Up Point member','action'=>'pickpoint','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Pick up Point name','fin'=>'edit_pickup_point_name','fph'=>'Pick up Point name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Cost','fin'=>'edit_cost','fph'=>'Cost','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'One way Cost','fin'=>'edit_one_way_cost','fph'=>'One way Cost','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'no_of_terms','fin'=>'edit_no_of_terms','fph'=>'no_of_terms','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/pickpoint.js");?>
@include('layout.footer',array('js' =>$js))