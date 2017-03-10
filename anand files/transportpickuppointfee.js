var termsids;
$(document).ready(function() {

	$("#no_of_terms").change(function(){
		var noofterms = $(this).val();
		var content = "";
		var twoway_perterm = ($("#twoway_amount").val()/noofterms).toFixed(2);
		var oneway_perterm = 0;
		if($("#oneway_amount").val() != "" || $("#oneway_amount").val()!=0){
			oneway_perterm = ($("#oneway_amount").val()/noofterms).toFixed(2);
		}
		content = '<div class="form-group"><label class="col-md-3 control-label">&nbsp</label><div class="col-md-9"><label class="side-text bold">TWOWAY</label> <label class="side-text bold">ONEWAY</label> <label class="side-text bold">MONTH</label> <label class="side-text bold">YEAR</label></div></div>';
		for(i=1;i<=noofterms;i++){
			content = content+'<div class="form-group"><label class="col-md-3 control-label bold">Term '+i+'</label><div class="col-md-9"><input name="termamount_twoway'+i+'" id="termamount_twoway'+i+'" class="form-control side input-small" placeholder="Term'+i+'" type="text" value="'+twoway_perterm+'"> <input name="termamount_oneway'+i+'" id="termamount_oneway'+i+'" class="form-control side input-small" placeholder="Term'+i+'" type="text" value="'+oneway_perterm+'"> <select id="month_term'+i+'" name="month_term'+i+'" class="form-control side input-small"><option selected value="0">Select</option><option value="1">Janaury</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select> <select id="year'+i+'" name="year'+i+'" class="form-control side input-small"><option selected value="0">Select</option><option value="2017">2017</option><option value="2018">2018</option></select> </div></div>';
		}
		$("#showhidden").html(content);
	});
	$("#e_no_of_terms").change(function(){
		var noofterms = $(this).val();
		var content = "";
		var twoway_perterm = ($("#e_twoway_amount").val()/noofterms).toFixed(2);
		var oneway_perterm = 0;
		if($("#e_oneway_amount").val() != "" || $("#e_oneway_amount").val()!=0){
			oneway_perterm = ($("#e_oneway_amount").val()/noofterms).toFixed(2);
		}
		content = '<div class="form-group"><label class="col-md-3 control-label">&nbsp</label><div class="col-md-9"><label class="side-text bold">TWOWAY</label> <label class="side-text bold">ONEWAY</label> <label class="side-text bold">MONTH</label> <label class="side-text bold">YEAR</label></div></div>';
		for(i=1;i<=noofterms;i++){
			temp = i-1;
			if(termsids[temp]){
				$termstemp = termsids[temp];
			}else{
				$termstemp = 0;
			}
			content = content+'<div class="form-group"><label class="col-md-3 control-label bold">Term '+i+'</label><div class="col-md-9"><input name="e_termamount_twoway'+i+'" id="e_termamount_twoway'+i+'" class="form-control side input-small" placeholder="Term'+i+'" type="text" value="'+twoway_perterm+'"> <input name="e_termamount_oneway'+i+'" id="e_termamount_oneway'+i+'" class="form-control side input-small" placeholder="Term'+i+'" type="text" value="'+oneway_perterm+'"> <select id="e_month_term'+i+'" name="e_month_term'+i+'" class="form-control side input-small"><option selected value="0">Select</option><option value="1">Janaury</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select> <select id="e_year'+i+'" name="e_year'+i+'" class="form-control side input-small"><option selected value="0">Select</option><option value="2017">2017</option><option value="2018">2018</option></select> <input type="hidden" id="e_terms_ids'+i+'" name="e_terms_ids'+i+'" value="'+$termstemp+'"></div></div>';
		}
		$("#showhidden-edit").html(content);
	});
	$("#sample_1").on("click",".edit-data", function(){
		$("#edit_form")[0].reset();
		$("#showhidden-edit").html("");
        $("#edit_id").val( $(this).data("id") );
        $("#e_pickup_point_name").val( $(this).data("name") );
        $("#e_twoway_amount").val( $(this).data("twoway") );
        $("#e_oneway_amount").val( $(this).data("oneway") );
        $("#e_no_of_terms").val( $(this).data("noofterms") );
        var noofterms = $(this).data("noofterms");
        if(noofterms!=0){
        	var twowayterms = $(this).data("twowayterms").split(",");
        	var onewayterms = $(this).data("onwwayterms").split(",");
        	var termsmonth = $(this).data("monthterms").split(",");
        	var termsyear = $(this).data("yearterms").split(",");
        	termsids = $(this).data("termsids").split(",");
        	content = '<div class="form-group"><label class="col-md-3 control-label">&nbsp</label><div class="col-md-9"><label class="side-text bold">TWOWAY</label> <label class="side-text bold">ONEWAY</label> <label class="side-text bold">MONTH</label> <label class="side-text bold">YEAR</label></div></div>';
        	for(i=0;i<noofterms;i++){
        		var temp = i+1;
        		content = content+'<div class="form-group"><label class="col-md-3 control-label bold">Term '+temp+'</label><div class="col-md-9"><input name="e_termamount_twoway'+temp+'" id="e_termamount_twoway'+temp+'" class="form-control side input-small" placeholder="Term'+temp+'" type="text" value="'+twowayterms[i]+'"> <input name="e_termamount_oneway'+temp+'" id="e_termamount_oneway'+temp+'" class="form-control side input-small" placeholder="Term'+temp+'" type="text" value="'+onewayterms[i]+'"> <select id="e_month_term'+temp+'" name="e_month_term'+temp+'" class="form-control side input-small"><option  value="0">Select</option><option value="1">Janaury</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select> <select id="e_year'+temp+'" name="e_year'+temp+'" class="form-control side input-small"><option value="0">Select</option><option value="2017">2017</option><option value="2018">2018</option></select> <input type="hidden" id="e_terms_ids'+temp+'" name="e_terms_ids'+temp+'" value="'+termsids[i]+'"></div></div>';
        	}
        	$("#showhidden-edit").html(content);
        	for(i=0;i<noofterms;i++){
        		var temp = i+1;
        		$("#e_month_term"+temp).val(termsmonth[i]);
        		$("#e_year"+temp).val(termsyear[i]);
        	}
        }
    });
    $("#sample_1").on("click",".view-data", function(){
    	$("#v_pickup_point_name, #v_twoway_amount, #v_oneway_amount, #v_no_of_terms").html("");
        $("#showhidden-view").html("");
        
        $("#v_pickup_point_name").html( $(this).data("name") );
        $("#v_twoway_amount").html( $(this).data("twoway") );
        $("#v_oneway_amount").html( $(this).data("oneway") );
        $("#v_no_of_terms").html( $(this).data("noofterms") );
        
        var noofterms = $(this).data("noofterms");
        if(noofterms!=0){
        	var twowayterms = $(this).data("twowayterms").split(",");
        	var onewayterms = $(this).data("onwwayterms").split(",");
        	var termsmonth = $(this).data("monthterms").split(",");
        	var termsyear = $(this).data("yearterms").split(",");
        	termsids = $(this).data("termsids").split(",");
        	content = '<div class="form-group"><label class="col-md-3 control-label">&nbsp</label><div class="col-md-9"><label class="side-text bold">TWOWAY</label> <label class="side-text bold">ONEWAY</label> <label class="side-text bold">MONTH</label> <label class="side-text bold">YEAR</label></div></div>';
        	var month =  new Array(); 
        	month[0] = "";
        	month[1] = "Janaury";
        	month[2] = "February";
        	month[3] = "March";
        	month[4] = "April";
        	month[5] = "May";
        	month[6] = "June";
        	month[7] = "July";
        	month[8] = "August";
        	month[9] = "September";
        	month[10] = "October";
        	month[11] = "November";
        	month[12] = "December";
        	for(i=0;i<noofterms;i++){
        		var temp = i+1;
        		content = content+'<div class="form-group"><label class="col-md-3 control-label bold">Term '+temp+'</label><div class="col-md-9"><span class="form-control side-text input-small">'+twowayterms[i]+'</span> <span class="form-control side-text input-small">'+onewayterms[i]+'</span> <span class="form-control side-text input-small">'+month[termsmonth[i]]+'</span> <span class="form-control side-text input-small">'+termsyear[i]+'</span> </div></div>';
        	}
        	$("#showhidden-view").html(content);       
        }
    });
	var t = $('#sample_1').DataTable( {
        language:{
			aria:{
			sortAscending:": activate to sort column ascending",
			sortDescending:": activate to sort column descending"},
			emptyTable:"No data available in table",
			info:"Showing _START_ to _END_ of _TOTAL_ records",
			infoEmpty:"No records found",
			infoFiltered:"(filtered1 from _MAX_ total records)",
			lengthMenu:"Show _MENU_",
			search:"Search:",
			zeroRecords:"No matching records found",
			paginate:{
				previous:"Prev",
				next:"Next",
				last:"Last",
				first:"First"
			}
		},
		bStateSave:!0,
		lengthMenu:[[10,20,30,-1],[10,20,30,"All"]],
		pageLength:10,
		pagingType:"bootstrap_full_number",
		colReorder: true,
		columns: [
	        { name: 'col1' },
	        { name: 'col2' },
	        { name: 'col3' },
	        { name: 'col4' },
	        { name: 'col5' },
	        { name: 'col6' },
	        { name: 'col7' },
	        { name: 'col8' },
	        { name: 'col9' },
    	],
		columnDefs:[
			{
				orderable:false,
				targets:[]
			},{
				searchable:false,
				targets:[5,6,-1,0],
			},{
				className:"dt-right"
			},{
				sortable: false,
        		targets: [5,6,-1,0]
			},{
				visible: false, 
				targets: [5,6] 
			}

		],
		order:[[3,"asc"]],
		buttons: [
            { 	extend: 'print', 
            	exportOptions: {  columns: ':visible' }, 
            	className: 'btn dark btn-outline',
            	title: function () { return getExportHeading(); }
            },
            { extend: 'copy', exportOptions: {  columns: ':visible' }, className: 'btn red btn-outline' },
            { 	extend: 'pdf', 
            	exportOptions: {  columns: ':visible' }, 
            	className: 'btn green btn-outline',
            	filename: function () { return getExportFileName(); },
            	title: function () { return getExportHeading(); },
            },
            { extend: 'excel', exportOptions: {  columns: ':visible' }, className: 'btn yellow btn-outline',filename: function () { return getExportFileName(); } },
            { extend: 'csv', exportOptions: {  columns: ':visible' }, className: 'btn purple btn-outline',filename: function () { return getExportFileName(); } },
            { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
        ],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });
 
    t.on('order.dt search.dt', function () {
        t.column('col1:name', {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
});
function getExportFileName(){
    d = new Date()
    df = d.getDate()+'_'+d.getMonth()+'_'+d.getFullYear()+'_'+(d.getHours()+1)+'_'+d.getMinutes()
    return "Sections_"+df;
}
function getExportHeading(){
    return "Sections";
}