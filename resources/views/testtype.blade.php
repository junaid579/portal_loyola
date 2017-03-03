@include('layout.header',array("pagetitle"=>"Test Type"))
@include('layout.topmenu')
@include('layout.leftsidemenu')
<?php $breadcrumb = array("Home", "Test Type");
$breadcrumb_url   = array("dashboard", "Test Type");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Test Type";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))
@include('layout.messages')
@include('layout.formopen',array('formheading'=>'Add Test Type','action'=>'testtype','fnid'=>'submit_test_type'))
@include('layout.forminputtext',array('ft'=>'Test Type','fin'=>'test_type','fph'=>'Test Type','fiv'=>''))
@include('layout.formclose')
@include('layout.datatableopening',array('tableheading'=>'Test Types List'))

<form action="testtype" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Test Type </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_test_type" id="search_test_type" value="<?php echo $search_test_type;?>" class="form-control form-filter" /></th>
             {{-- For search buttons  --}} 
           @include('layout.search')
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($alltesttypes as $testtype)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $testtype->test_type }} </td>
                <td>    <?php if ($testtype->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($testtype->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($testtype->status == 0) {?>
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
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $testtype->id }}" data-test_type="{{ $testtype->test_type }}"   class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $testtype->id }}" data-test_type="{{ $testtype->test_type }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                            {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$testtypes,'blade_name'=>'testtype'))
                            
                       
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Test Type','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Test Type','fin'=>'view_test_type'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Test Type','action'=>'testtype','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Test Type','fin'=>'edit_test_type','fph'=>'Test Type','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/testtype.js");?>
@include('layout.footer',array('js' =>$js))


