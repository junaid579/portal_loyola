<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
			<div class="portlet-title">
			    <div class="caption">
			        <i class="icon-equalizer"></i>
			        <span class="caption-subject bold uppercase">{{ $formheading }}</span>
			    </div>
			</div>
			<div class="portlet-body form">
				<form action="{{$action}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
    				<div class="form-body">
    				<div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. 
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button> Your form validation is successful! 
                    </div>