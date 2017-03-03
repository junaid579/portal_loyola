@include('layout.header',array("pagetitle"=>"Test Master"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Test Master");
$breadcrumb_url   = array("dashboard", "Test Master");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Test Master";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')

<?php $classnames = array();
foreach ($classes as $class) {
	$classnames[$class->id] = $class->class_name;
}?>

<?php $sectionnames = array();
foreach ($sections as $section) {
    $sectionnames[$section->id] = $section->section_name;
}?>

<?php $subjectnames = array();
foreach ($subjects as $subject) {
    $subjectnames[$subject->id] = $subject->subject_name;
}?>

<?php $testtypenames = array();
foreach ($testtypes as $testtype) {
    $testtypenames[$testtype->id] = $testtype->test_type;
}?>
@include('layout.formopen',array('formheading'=>'Create a Test','action'=>'testmaster','fnid'=>'submit_test'))
@include('layout.formselect',array('ft'=>'Classes','fin'=>'class_id','data'=>$classes,'index'=>'id','value'=>'class_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Sections','fin'=>'section_id','data'=>$sections,'index'=>'id','value'=>'section_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Subjects','fin'=>'subject_id','data'=>$subjects,'index'=>'id','value'=>'subject_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Test Type','fin'=>'testtype_id','data'=>$testtypes,'index'=>'id','value'=>'test_type','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Test Name','fin'=>'test_name','fph'=>'Test Name','fiv'=>''))

@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Tests List'))

<form action="testmaster" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_method" value="post">
<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
        <tr>
            <th> SNO.</th>
            <th> Class </th>
            <th> Section </th>
            <th> Subject </th>
            <th> Test Type </th>
            <th> Test Name </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th> - </th>
            <th>
                <select name="search_class" id="search_class" class="form-control form-filter">
                <option value="" selected="selected">Select</option>
                    <?php foreach ($classes as $class) {
                    	$selected = "";
                    	if ($search_class == $class->id) {
                    		$selected = 'selected="selected"';
                	}?>
                    <option value="<?php echo $class->id;?>" <?php echo $selected;
                	?> > <?php echo $class->class_name;?></option>
	               <?php }?>
            	</select>
            </th>
            <th>
                <select name="search_section" id="search_section" class="form-control form-filter">
                <option value="" selected="selected">Select</option>
                    <?php foreach ($sections as $section) {
                        $selected = "";
                        if ($search_section == $section->id) {
                            $selected = 'selected="selected"';
                    }?>
                    <option value="<?php echo $section->id;?>" <?php echo $selected;
                    ?> > <?php echo $section->section_name;?></option>
                   <?php }?>
                </select>
            </th>
            <th>
                <select name="search_subject" id="search_subject" class="form-control form-filter">
                <option value="" selected="selected">Select</option>
                    <?php foreach ($subjects as $subject) {
                        $selected = "";
                        if ($search_subject == $subject->id) {
                            $selected = 'selected="selected"';
                    }?>
                    <option value="<?php echo $subject->id;?>" <?php echo $selected;
                    ?> > <?php echo $subject->subject_name;?></option>
                   <?php }?>
                </select>
            </th>
            <th>
                <select name="search_testtype" id="search_testtype" class="form-control form-filter">
                <option value="" selected="selected">Select</option>
                    <?php foreach ($testtypes as $testtype) {
                        $selected = "";
                        if ($search_testtype == $testtype->id) {
                            $selected = 'selected="selected"';
                    }?>
                    <option value="<?php echo $testtype->id;?>" <?php echo $selected;
                    ?> > <?php echo $testtype->test_type;?></option>
                   <?php }?>
                </select>
            </th>
            <th> <input type="text" name="search_test_name" id="search_test_name" value="<?php echo $search_section;?>" class="form-control form-filter" /></th>
            {{-- For search buttons  --}} 
           @include('layout.search')
            
            
        </tr>
    </tfoot>
    <tbody><?php $i = 1;?>
@foreach($alltestnames as $testnames)
<?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
?>
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $classnames[$testnames->class_id] }} </td>
            <td> {{ $sectionnames[$testnames->section_id] }} </td>
            <td> {{ $subjectnames[$testnames->subject_id] }} </td>
            <td> {{ $testtypenames[$testnames->testtype_id] }} </td>
            <td> {{ $testnames->test_name }} </td>
            <td>    <?php if ($testnames->status == 1) {?>
	<span class="label label-sm label-info"> Active </span>
	<?php } else if ($testnames->status == 2) {?>
	<span class="label label-sm label-warning"> Suspended </span>
	<?php } else if ($testnames->status == 0) {?>
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
                            <a data-toggle="modal" href="#view-data-model" data-id="{{ $testnames->id }}" data-test_name="{{ $testnames->test_name }}" data-class="{{ $classnames[$testnames->class_id] }}" data-section="{{ $sectionnames[$testnames->section_id] }}" data-subject="{{ $subjectnames[$testnames->subject_id] }}" data-testtype="{{ $testtypenames[$testnames->testtype_id] }}" class="view-data"><i class="icon-docs"></i> View </a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#responsive" data-id="{{ $testnames->id }}" data-test_name="{{ $testnames->test_name }}" data-class="{{ $classnames[$testnames->class_id] }}" data-section="{{ $sectionnames[$testnames->section_id] }}" data-subject="{{ $subjectnames[$testnames->subject_id] }}" data-testtype="{{ $testtypenames[$testnames->testtype_id] }}" class="edit-data"><i class="icon-tag"></i> Edit </a>
                        </li>
                        {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$testnames,'blade_name'=>'testmaster'))
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Test ','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Classes','fin'=>'view_classes'))
@include('layout.forminputvalue',array('ft'=>'Sections','fin'=>'view_sections'))
@include('layout.forminputvalue',array('ft'=>'Subjects','fin'=>'view_subjects'))
@include('layout.forminputvalue',array('ft'=>'Test Types','fin'=>'view_testtypes'))
@include('layout.forminputvalue',array('ft'=>'Test Names','fin'=>'view_test_name'))


@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Test ','action'=>'testmaster','fnid'=>'edit_form'))
@include('layout.formselect',array('ft'=>'Classes','fin'=>'edit_classes','data'=>$classes,'index'=>'id','value'=>'class_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Sections','fin'=>'edit_sections','data'=>$sections,'index'=>'id','value'=>'section_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Subjects','fin'=>'edit_subjects','data'=>$subjects,'index'=>'id','value'=>'subject_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Test Types','fin'=>'edit_testtypes','data'=>$testtypes,'index'=>'id','value'=>'test_type','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Test Name','fin'=>'edit_test_name','fph'=>'Test Name','fiv'=>''))
<?php $js = array("js/testmaster.js");?>
@include('layout.footer',array('js' =>$js))


