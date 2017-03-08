@include('layout.header',array("pagetitle"=>"Countries"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Countries");
$breadcrumb_url   = array("dashboard", "countries");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Countries";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Countries','action'=>'countries','fnid'=>'submit_countries'))
@include('layout.forminputtext',array('ft'=>'Countries Name','fin'=>'countries_name','fph'=>'Countries Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Countries Code','fin'=>'countries_code','fph'=>'Countries Code','fiv'=>''))

@include('layout.formclose')
<div class="input_fields_wrap">
    <button class="add_field_button">Add More Fields</button>
    <div><input type="text" name="mytext[]"></div>
</div>

@include('layout.datatableopening',array('tableheading'=>'Countriess List'))

<form action="countries" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Countries Name </th>
            <th> Countries Code </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_countries_name" id="search_countries_name" value="<?php echo $search_countries_name;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_countries_code" id="search_countries_code" value="<?php echo $search_countries_code;?>" class="form-control form-filter" /></th>
            
                 {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'countries'])
            </th>
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allcountriess as $countriess)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $countriess->countries_name }} </td>
                <td> {{ $countriess->countries_code }} </td>
                <td>    <?php if ($countriess->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($countriess->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($countriess->status == 0) {?>
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
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $countriess->id }}" data-countries_name="{{ $countriess->countries_name }}" data-countries_code="{{ $countriess->countries_code }}" "  class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $countriess->id }}" data-countries_name="{{ $countriess->countries_name }}" data-countries_code="{{ $countriess->countries_code }}" " class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                             {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$countriess,'blade_name'=>'countries'))
                           
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Countriess','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Countries Name','fin'=>'view_countries_name'))
@include('layout.forminputvalue',array('ft'=>'Countries Code ','fin'=>'view_countries_code'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Countriess','action'=>'countries','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Countries Name','fin'=>'edit_countries_name','fph'=>'Countries Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Countries Code','fin'=>'edit_countries_code','fph'=>'Countries Code','fiv'=>''))

@include('layout.modalformclose')



<?php $js = array("js/countries.js");?>
@include('layout.footer',array('js' =>$js))


