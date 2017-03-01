@include('layout.header',array("pagetitle"=>"Dashboard"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home");
$breadcrumb_url   = array("dashboard");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Dashboard";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

<?php $js = array("js/dashboard.js");?>
@include('layout.footer',array('js' =>$js))