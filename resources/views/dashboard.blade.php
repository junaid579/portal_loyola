@include('layout.header')
@include('layout.topmenu')
@include('layout.leftsidemenu')
             
<?php $classnames = array(); 
    foreach($allclasses as $classes){
    $classnames[$classes->id] =  $classes->id; 
    $classCount = $classnames[$classes->id];
    } 
    foreach($allsections as $sections){
    $sectionNames[$sections->id] =  $sections->id; 
    $sectionCount = $sectionNames[$sections->id];
    } 
    foreach ($allstaff as $staff ) {
    $staffNames[$staff->id] = $staff->id;
    $staffCount =   $staffNames[$staff->id];
    }
    foreach ($alltransportPickup as $transportpickup) {
    $pickUpNames[$transportpickup->id] = $transportpickup->id;
    $pickupCount = $pickUpNames[$transportpickup->id];
    }
?>

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="/dashboard">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>               
        </div>
        <h1 class="page-title"> Control Panel <small>Quick Links</small></h1>
        <div class="row">
                                    
            @include('layout.tiles',array('idArray'=>$staffCount,'countTitle'=>'Staff Count','countCaption'=>'Add a Staff Member |  View Staff' , 'route' => 'staff' , 'color'=>'red'))

            @include('layout.tiles',array('idArray'=>$sectionCount,'countTitle'=>'Section Count','countCaption'=>'Add a Section |  View Sections' , 'route' => 'sections', 'color'=>'purple'))

            @include('layout.tiles',array('idArray'=>$classCount,'countTitle'=>'Class Count','countCaption'=>'Add a Class |  View Classes' , 'route' => 'classes' ,'color'=>'green'))

            @include('layout.tiles',array('idArray'=>$pickupCount,'countTitle'=>'Transport  facility','countCaption'=>'Add a Pick up Point |  View Points' , 'route' => 'transportPickup', 'color'=>'blue'))
                        
        </div>
    </div>
</div>

    @include('layout.footer')
</body>