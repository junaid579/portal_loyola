@include('layout.header',array("pagetitle"=>"Dashboard"))
@include('layout.topmenu')
@include('layout.leftsidemenu')
<?php $breadcrumb = array("Home", "Dashboard");
$breadcrumb_url   = array("dashboard", "Dashboard");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Dashboard";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))
@include('layout.messages')

<?php $classnames = array();
foreach ($classes as $class) {
	$classnames[$class->id] = $class->id;
}?>
<?php $sectionsnames = array();
foreach ($sections as $section) {
	$sectionsnames[$section->id] = $section->id;
}?>
<?php $paymentTypenames = array();
foreach ($paymentTypes as $paymentType) {
	$paymentTypenames[$paymentType->id] = $paymentType->id;
}?>
<?php $staffnames = array();
foreach ($staffs as $satff) {
	$staffnames[$satff->id] = $satff->id;
}?>
<?php $admissionnames = array();
foreach ($admissions as $admission) {
	$admissionnames[$admission->id] = $admission->id;
}?>

@include('layout.tiles',array('redirection'=>'/admission','tile_name'=>'',
								'caption'=>'Student Admission','tile_color'=>'grey',
									'count'=>'Enroll a Student'))

@include('layout.tiles',array('redirection'=>'/sections','tile_name'=>'Sections',
								'caption'=>'Add a Section','tile_color'=>'red',
									'count'=>$sectionsnames[$section->id] = $section->id))


@include('layout.tiles',array('redirection'=>'/classes','tile_name'=>'Classes',
								'caption'=>'Add a Class','tile_color'=>'blue',
									'count'=>$classnames[$class->id] = $class->id))

@include('layout.tiles',array('redirection'=>'/paymenttypesmaster','tile_name'=>'Payment Types',
								'caption'=>'Add a Payment Type','tile_color'=>'purple',
									'count'=>$paymentTypenames[$paymentType->id] = $paymentType->id))

@include('layout.tiles',array('redirection'=>'/staff','tile_name'=>'Our Staff',
								'caption'=>'Add a Staff member','tile_color'=>'green',
									'count'=>$staffnames[$satff->id] = $satff->id))


<?php $js = array("js/subjects.js");?>
@include('layout.footer',array('js' =>$js))
