$(document).ready(function(){
    $(document).ajaxStart(function(){
       $("#ajaxLoader").fadeIn('fast');
    });
    $(document).ajaxComplete(function(){
        $("#ajaxLoader").fadeOut('fast');
    });
});

 // $.toaster('No item found!', 'Notice', 'warning');

$(document).ready(function (e) {


    //onload functionalities
    getAssetCategoryList();
    getAssetLocationList();
    getAssetSubCatList();
    getExtraRoles();
    getHeads();
    getHeadsDropdown();
    getSubHeadsDropdown();
    //onload functionalities

    var base_url = $("#base_url").html();
    //form step one
    $("#frm_step_one").on('submit',(function(e) {
        e.preventDefault();

        $.ajax({
            url: base_url+"member_create_step_one",       // Url to which the request is send
            type: "POST",                   // Type of request to be send, called as method
            data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
            contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
            cache: false,                   // To unable request pages to be cached
            processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
            success: function(data)         // A function to be called if request succeeds
            {
                //do something with response
                if(data.indexOf('|') !== -1){
                    var data = data.split('|');
                    $("#message").html(data[0]);
                    $.toaster(data[0], 'Notice', data[1]);
                    if(data[1] =='success'){
                        setTimeout(function(){
                            $("#step_one").hide();
                            $("#step_two").fadeIn();
                            $("#message").html('');
                            $("#member_id_step_one").val(data[2]);
                            $("#member_id_step_two").val(data[2]);
                        }, 1500);
                    }
                }

            }
       });
    }));

    //form step two
    $("#frm_step_two").on('submit',(function(e) {
        e.preventDefault();

        $.ajax({
            url: base_url+"member_create_step_two",       // Url to which the request is send
            type: "POST",                   // Type of request to be send, called as method
            data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
            contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
            cache: false,                   // To unable request pages to be cached
            processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
            success: function(data)         // A function to be called if request succeeds
            {
                //do something with response
                if(data.indexOf('|') !== -1){
                    var data = data.split('|');
                    $.toaster(data[0], 'Notice', data[1]);
                    if(data[1] =='success'){
                        setTimeout(function(){
                            $("#step_two").hide();
                            $("#step_three").fadeIn();
                            $("#message").html('');
                            $("#member_id_step_three").val(data[2]);
                        }, 1500);
                    }else{
                        $("#message").html(data[0]);
                    }
                }

            }
       });
    }));




    //form step three
    $("#frm_step_three").on('submit',(function(e) {
        e.preventDefault();

        $.ajax({
            url: base_url+"member_create_step_three",       // Url to which the request is send
            type: "POST",                   // Type of request to be send, called as method
            data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
            contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
            cache: false,                   // To unable request pages to be cached
            processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
            success: function(data)         // A function to be called if request succeeds
            {
                //do something with response
                if(data.indexOf('|') !== -1){
                    var data = data.split('|');
                    $.toaster(data[0], 'Notice', data[1]);
                    if(data[1] =='success'){
                        setTimeout(function(){
                            $("#step_three").hide();
                            $("#step_four").fadeIn();
                            $("#message").html('');
                        }, 1500);
                    }else{
                        $("#message").html(data[0]);
                    }
                }

            }
       });
    }));





    //update member form step one
    $("#frm_step_one_update_form").on('submit',(function(e) {
        e.preventDefault();

        $.ajax({
            url: base_url+"member_info_update",       // Url to which the request is send
            type: "POST",                   // Type of request to be send, called as method
            data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
            contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
            cache: false,                   // To unable request pages to be cached
            processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
            success: function(data)         // A function to be called if request succeeds
            {
                //do something with response
                if(data.indexOf('|') !== -1){
                    var data = data.split('|');
                    $("#message").html(data[0]);
                    $("#photo").val(data[2]);
                }

            }
       });
    }));



});


//get upazilla list
function getUpazillaList(district){
    var base_url = $("#base_url").html();
    $.post(base_url+"getUpazillaList", {district:district.value}, function(rtm){
        var option = '<option value="">Select Upazila</option>';
        if (rtm.length>0) {
            for (var i = 0; i < rtm.length; i++) {
                option +='<option value="'+ rtm[i]['id'] +'">'+rtm[i]['name']+'</option>';
            };

            $("#upazilla").html('');
            $("#upazilla").html(option);
        };
    }, 'json');
}


//get getBranchList
function getBranchList(regional_branch){
    var base_url = $("#base_url").html();
    $.post(base_url+"getBranchList", {regional_branch:regional_branch.value}, function(rtm){
        var option = '<option value="">Select Branch</option>';
        if (rtm.length>0) {
            for (var i = 0; i < rtm.length; i++) {
                option +='<option value="'+ rtm[i]['id'] +'">'+rtm[i]['name']+'</option>';
            };

            $("#branch").html('');
            $("#branch").html(option);
        }else{
            $("#branch").html('<option value="">No branch found</option>');
        }
    }, 'json');
}


//get getSomitiList
function getSomitiList(branch_id){
    var base_url = $("#base_url").html();
    $.post(base_url+"getSomitiList", {branch_id:branch_id.value}, function(rtm){
        var option = '<option value="">Select Somiti</option>';
        if (rtm.length>0) {
            for (var i = 0; i < rtm.length; i++) {
                option +='<option value="'+ rtm[i]['id'] +'">'+rtm[i]['name']+'</option>';
            };

            $("#somiti").html('');
            $("#somiti").html(option);
        }else{
            $("#somiti").html('<option value="">No somiti found</option>');
        }
    }, 'json');
}


// member form
function whereLiveEnableDisable(){
    if($("#house").val() == 'No'){
        $("#where_live").prop( "disabled", false);
    }else{
        $("#where_live").prop( "disabled", true);;
        $("#where_live").val('');
    }
}

//change step
function stepChange(show, hide){
    $(show).fadeIn();
    $(hide).hide();
}


// image preview

function getPreview(objectName,previewNameViewer,fileNameViewer) {

    if (fileNameViewer!="none" || fileNameViewer!='none' || fileNameViewer!=="none" || fileNameViewer!=='none') {
        //send name
        var name = document.getElementById(objectName).files[0].name;
        if (name!=null || name !="" || name!='' || name!=="" || name!=='') {
            document.getElementById(fileNameViewer).value = name;
        }else{
            console.log('Select a photo');
        };

    };



    // get selected file element
    var oFile = document.getElementById(objectName).files[0];

    // get preview element
    var oImage = document.getElementById(previewNameViewer);

    // prepare HTML5 FileReader
    var oReader = new FileReader();
        oReader.onload = function(e){

        // e.target.result contains the DataURL which we will use as a source of the image
        oImage.src = e.target.result;

    };

    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}


//asset management

$("#add_category").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"add_asset_category",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            $("#add_input_category").val("");
            getAssetCategoryList();
        }
   });
}));

//get getAssetCategoryList
function getAssetCategoryList(){
    var base_url = $("#base_url").html();
    if($("#asset_category_list").length>0){
        $.post(base_url+"get_asset_category_list", {}, function(rtm){
            $("#asset_category_list").html("");
            var tr = '';
            if (rtm.length>0) {
                for (var i = 0; i < rtm.length; i++) {
                    tr +='<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td id="'+rtm[i]['id']+'_td_cat_name" >'+rtm[i]['name']+'</td>'+
                            '<td><a href="javascript:" id="'+rtm[i]['id']+'" onclick="edit_asset_category(this.id);" >Edit<a></td>'+
                         '</tr>';
                }
            }else{
                    tr = '<tr><td colspan="2">No data found!</td></tr>';
            }
            $("#asset_category_list").html(tr);

        }, 'json');
    }
}

function edit_asset_category(category_id){
    $("#add_category").hide();
    $("#update_category").fadeIn();
    $("#asset_cat_id").val(category_id);
    $("#update_input_category").val($("#"+category_id+"_td_cat_name").html());
    // console.log(category_id);
}



$("#update_category").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"update_asset_category",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                $("#add_category").fadeIn();
                $("#update_category").hide();
            }
            $("#update_input_category").val("");
            getAssetCategoryList();
        }
   });
}));

function show_asset_add_form(){
    $("#update_category").hide();
    $("#add_category").fadeIn();
    $("#update_input_category").val("");
}


$("#add_location").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"add_asset_location",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                $("#location_name").val("");
                $("#location_description").val("");
            }
            getAssetLocationList();
        }
   });
}));

//get getAssetLocationList
function getAssetLocationList(){
    var base_url = $("#base_url").html();
    if($("#asset_location_list").length>0){
        $.post(base_url+"getAssetLocationList", {}, function(rtm){
            $("#asset_location_list").html("");
            var tr = '';
            if (rtm.length>0) {
                for (var i = 0; i < rtm.length; i++) {
                    tr +='<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td id="'+rtm[i]['id']+'_td_loc_name" >'+rtm[i]['name']+'</td>'+
                            '<td id="'+rtm[i]['id']+'_td_loc_desc" >'+rtm[i]['description']+'</td>'+
                            '<td><a href="javascript:" id="'+rtm[i]['id']+'" onclick="edit_asset_location(this.id);" >Edit<a></td>'+
                         '</tr>';
                }
            }else{
                    tr = '<tr><td colspan="3">No data found!</td></tr>';
            }
            $("#asset_location_list").html(tr);

        }, 'json');
    }
}


function edit_asset_location(location_id){
    $("#add_location").hide();
    $("#update_location").fadeIn();
    $("#asset_location_id").val(location_id);
    $("#update_location_name").val($("#"+location_id+"_td_loc_name").html());
    $("#update_location_description").val($("#"+location_id+"_td_loc_desc").html());
    // console.log(location_id);
}

function show_asset__loc_add_form(){
    $("#add_location").fadeIn();
    $("#update_location").hide();
    $("#update_location_name").val("");
    $("#update_location_description").val("");
}


$("#update_location").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"update_asset_location",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                $("#add_location").fadeIn();
                $("#update_location").hide();
            }
            $("#update_location_name").val("");
            $("#update_location_description").val("");
            getAssetLocationList();
        }
   });
}));

// add sub category
$("#add_sub_category").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"add_asset_sub_category",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                $("#category_name").val("");
                $("#sub_category_name").val("");
            }
            getAssetSubCatList();
        }
   });
}));


function getAssetSubCatList(){
    var base_url = $("#base_url").html();
    if($("#asset_sub_cat_list").length>0){
        $.post(base_url+"get_asset_sub_category_list", {}, function(rtm){
            $("#asset_sub_cat_list").html("");
            var tr = '';
            if (rtm.length>0) {
                for (var i = 0; i < rtm.length; i++) {
                    tr +='<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td><input type="hidden" id="'+rtm[i]['id']+'_td_cat_name" value="'+rtm[i]['catID']+'">'+rtm[i]['catName']+'</td>'+
                            '<td id="'+rtm[i]['id']+'_td_sub_cat_name" >'+rtm[i]['name']+'</td>'+
                            '<td><a href="javascript:" id="'+rtm[i]['id']+'" onclick="edit_asset_sub_cat(this.id);" >Edit<a></td>'+
                         '</tr>';
                }
            }else{
                    tr = '<tr><td colspan="3">No data found!</td></tr>';
            }
            $("#asset_sub_cat_list").html(tr);

        }, 'json');
    }
}

function edit_asset_sub_cat(sub_cat_id){
    $("#add_sub_category").hide();
    $("#update_sub_category").fadeIn();
    $("#sub_cat_id").val(sub_cat_id);
    $("#update_category_name").val($("#"+sub_cat_id+"_td_cat_name").val());
    $("#update_sub_category_name").val($("#"+sub_cat_id+"_td_sub_cat_name").html());
    console.log($("#"+sub_cat_id+"_td_cat_name").html());
}

function show_sub_cat_add_form(){
    $("#add_sub_category").fadeIn();
    $("#update_sub_category").hide();
    $("#update_category_name").val("");
    $("#update_sub_category_name").val("");
}

// update_sub_category
$("#update_sub_category").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"update_asset_sub_category",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                $("#add_sub_category").fadeIn();
                $("#update_sub_category").hide();
            }
            $("#update_category_name").val("");
            $("#update_sub_category_name").val("");
            getAssetSubCatList();
        }
   });
}));

// create savings installment
$("#frm_create_installment").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    var member_id = $("#member").val();
    var savings_classificatin = $("#classification").val();
    if($("#diposit").val()>0 && $("#withdraw").val()>0){
        $("#message").html('Check your deposit and withdraw!');
        $.toaster('Check your deposit and withdraw!', 'Notice', 'warning');
        return false;
    }
    $.ajax({
        url: base_url+"create_savings_installment",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            $.toaster(data, 'Notice', 'info');
            $("#message").html(data+' <a href="'+base_url+"savings_installment/"+savings_classificatin+"/"+member_id+'">View details</a>');
            $("#details").val('');
            $("#diposit").val('0');
            $("#withdraw").val('0');
        }
   });
}));

function getSubCatList(category){
    var base_url = $("#base_url").html();
    $.post(base_url+"getSubCatList", {category:category.value}, function(rtm){
        var option = '<option value="">Select sub category</option>';
        if (rtm.length>0) {
            for (var i = 0; i < rtm.length; i++) {
                option +='<option value="'+ rtm[i]['id'] +'">'+rtm[i]['name']+'</option>';
            };

            $("#sub_category_name").html('');
            $("#sub_category_name").html(option);
        };
    }, 'json');
}



//get getMemberList
function getMemberList(somiti){
    var base_url = $("#base_url").html();
    $.post(base_url+"getMemberList", {somiti:somiti.value}, function(rtm){
        var option = '<option value="">All Member</option>';
        if (rtm.length>0) {
            for (var i = 0; i < rtm.length; i++) {
                option +='<option value="'+ rtm[i]['user_id'] +'">'+rtm[i]['name']+'</option>';
            };

            $("#member").html('');
            $("#member").html(option);
        }else{
            $("#member").html('<option value="">No Member</option>');
        }
    }, 'json');
}


//loan 1+year calculation
function addYearToClosingDate(current_date) {
    var d = new Date(current_date);
    d.setFullYear((d.getFullYear())+1);
    var _month = (d.getMonth()+1)<10?  ("0"+(d.getMonth()+1)) : (d.getMonth()+1);
    var _date = (d.getDate())<10?  ("0"+(d.getDate())) : (d.getDate());
    $("#loan_closing_date").val(d.getFullYear()+"-"+(_month.toString())+"-"+_date.toString());
}

//calculate interest
function calcInterest(){
    var loan_amount = parseInt($("#loan_amount").val());
        loan_amount = (!loan_amount)? 0.0 : loan_amount;
    var amount_in_percentage = parseFloat($("#loan_in_percentage").val());
        amount_in_percentage = (!amount_in_percentage)? 0.0 : amount_in_percentage;
    var interest = parseFloat(loan_amount*amount_in_percentage);
        interest = (!interest)? 0.0 : interest;

    //set interest
    $("#loan_interest").val(interest);
    $("#total_amount").val((loan_amount+interest));
}


//get loan serial no

function get_loan_serial(){
    var base_url = $("#base_url").html();
    var somiti_id = $("#somiti").val();
    var member_id = $("#member").val();
    $.post(base_url+"get_loan_serial", {somiti_id:somiti_id, member_id:member_id}, function(rtm){
        $("#loan_serial").val(rtm);
    }, 'json');
}

//get_member_loan_serial
function get_member_loan_serial(){
    var base_url = $("#base_url").html();
    var somiti_id = $("#somiti").val();
    var member_id = $("#member").val();
    $.post(base_url+"get_member_loan_serial", {somiti_id:somiti_id, member_id:member_id}, function(rtm){
        if(rtm==null){
            $("#message").html('This member does not have any active loan!');
            $.toaster('This member does not have any active loan!', 'Notice', 'warning');
            $("#loan_serial").val('');
        }else{
            $("#loan_serial").val(rtm['loan_serial_no']);
            $("#message").html('');
        }
    }, 'json');
}



// create loan installment
$("#frm_loan_installment").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    var member_id = $("#member").val();
    var loan_serial_no = $("#loan_serial").val();
    $.ajax({
        url: base_url+"create_loan_installment",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                $("#message").html('<a href="'+base_url+"loan_details?loan_serial="+loan_serial_no+"&member_id="+member_id+'">Click here to view installments of the member</a>');
            }else{
                $("#message").html('Loan installment failed!');
                $.toaster('Loan installment failed!', 'Notice', 'danger');
            }
            $("#week_no").val('');
            $("#collectable_amount").val('');
            $("#collectable_interest").val('');
            $("#actual_amount").val('');
            $("#actual_interest").val('');
        }
   });
}));

//get_member_loan_serial
function get_member_all_loan_serial(){
    var base_url = $("#base_url").html();
    var somiti_id = $("#somiti").val();
    var member_id = $("#member").val();
    $.post(base_url+"get_member_all_loan_serial", {somiti_id:somiti_id, member_id:member_id}, function(rtm){
        var option = '';
        $("#loan_serial_no").html('');
        if(rtm.length>0){
            for(var i = 0; i< rtm.length; i++){
                option +='<option value="'+rtm[i]['loan_serial_no']+'">'+rtm[i]['loan_serial_no']+'</option>';
            }
            $("#loan_serial_no").html(option);
        }else{
            $("#loan_serial_no").html('');
        }
    }, 'json');
}


//getEmpoyeeList
function getEmpoyeeList(branch){
    var base_url = $("#base_url").html();
    $.post(base_url+"getEmpoyeeList", {branch:branch.value}, function(rtm){
        var option = '';
        $("#employee").html('');
        if(rtm.length>0){
                option = '<option value="">All Employee</option>';
            for(var i = 0; i< rtm.length; i++){
                option +='<option value="'+rtm[i]['id']+'">'+rtm[i]['emp_name']+'</option>';
            }
            $("#employee").html(option);
        }else{
            $("#employee").html('');
        }
    }, 'json');
}


//make diposit or withdraw field 0 if empty/blank
function makeZeroIfEmpty(field){
    if(!field.value){
        field.value = 0;
    }
}

//==================================authorization=====================

// update_sub_category
$("#frm_create_role").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"create_role",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                getExtraRoles();
                $.toaster('Role created successfully.', 'Notice', 'info');
            }
        }
   });
}));


function getExtraRoles(){
    var base_url = $("#base_url").html();
    var role = $("#role").val();
    $.get(base_url+"get_extra_roles", {}, function(rtm){
        var li = '';
        $("#extra_roles").html('');
        if(rtm.length>0){
            for(var i = 0; i< rtm.length; i++){
                li +='<li>'+rtm[i]['name']+'&nbsp;<a href="javascript:" onclick="remove_role('+rtm[i]['id']+')"><i class="fa fa-remove text-danger"></i></a>'+'</li>';
            }
            $("#extra_roles").html(li);
        }else{
            $("#extra_roles").html('');
        }
    }, 'json');
}


function remove_role(role_id){
    var base_url = $("#base_url").html();
    if(confirm('Are you sure?')==false){ return false; }

    $.post(base_url+"remove_role", {role_id:role_id}, function(rtm){
        if(rtm == true){
            getExtraRoles();
        }
    }, 'json');

}

function assign_permission(){
    var base_url = $("#base_url").html();
    var role = $("#role").val();
    var permission = $("#permission").val();
    if(!role){$.toaster('Role is required!', 'Notice', 'warning'); $("#message").html('Role is required!'); return false;}
    if(!permission){$.toaster('Permission is required!', 'Notice', 'warning'); $("#message").html('Permission is required!'); return false;}

    $.post(base_url+"assign_permission", {role:role, permission:permission}, function(rtm){
        if(rtm == true){
            getPermissionList();
        }
    }, 'json');
}

function getPermissionList(){
    var base_url = $("#base_url").html();
    var role = $("#role").val();
    $.post(base_url+"getPermissionList", {role:role}, function(rtm){
        var li = '';
        $("#permission_list").html('');
        if(rtm.length>0){
            for(var i = 0; i< rtm.length; i++){
                li +='<li>'+rtm[i]['label']+'&nbsp;<a href="javascript:" onclick="remove_permission('+rtm[i]['permission_role_id']+')"><i class="fa fa-remove text-danger"></i></a>'+'</li>';
            }
            $("#permission_list").html(li);
        }else{
            $("#permission_list").html('');
        }
    }, 'json');
}

function remove_permission(permission_role_id){
    var base_url = $("#base_url").html();
    if(confirm('Are you sure?')==false){ return false; }
    $.post(base_url+"remove_permission", {permission_role_id:permission_role_id}, function(rtm){
        if(rtm == true){
            getPermissionList();
        }
    }, 'json');
}

function get_member_loan_info(){
    var base_url = $("#base_url").html();
    var somiti_id = $("#somiti").val();
    var member_id = $("#member").val();
    if(!member_id){ return false; }
    var loan_serial_no = $("#loan_serial").val();
    var installment_date = $("#installment_date").val();
    $.post(base_url+"get_member_loan_info", {somiti_id:somiti_id, member_id:member_id, loan_serial:loan_serial_no, installment_date:installment_date}, function(rtm){
        $("#collectable_amount").val(rtm['collectable_amount']);
        $("#collectable_interest").val(rtm['collectable_interest']);
        $("#week_no").val(rtm['week_no']);

        if(rtm['amount'] != 0){
            $("#message").html(rtm['message']+" BDT "+rtm['amount']+".");
            $.toaster(rtm['message']+" BDT "+rtm['amount'], 'Notice', 'info');
        }
    }, 'json');
}


function setRole(role){
    var base_url = $("#base_url").html();
    var employee_id = role.id;
    var role_id = $("#role_"+employee_id).val();
    if(!role_id){
        $.toaster('Role is required!', 'Notice', 'danger');
        return false;
    }
    $.post(base_url+"set_role", {employee_id:employee_id, role_id:role_id}, function(rtm){
        if(rtm){
            $.toaster('Role assigned successfully!', 'Notice', 'info');
        }else{
            $.toaster('Something went wrong, try again latter!', 'Notice', 'warning');
        }
    }, 'json');
}

//============================================================== Accounts =================================================

// create acc heads
$("#frm_create_head").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"create_head",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                getHeads();
                getHeadsDropdown();
                $.toaster('Head created/updated successfully.', 'Notice', 'info');
                $("#create_head_name").val('');
            }
        }
   });
}));


// update acc heads
$("#frm_update_head").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"update_head",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                getHeads();
                getHeadsDropdown();
                $.toaster('Head updated successfully.', 'Notice', 'info');
                $("#update_head_name").val('');
                $("#frm_create_head").show();
                $("#frm_update_head").hide();
            }
        }
   });
}));


function getHeads(){
    var base_url = $("#base_url").html();
    if($("#heads_list").length>0){
        $.get(base_url+"getHeads", {}, function(rtm){
            var li = '';
            $("#heads_list").html('');
            if(rtm.length>0){
                for(var i = 0; i< rtm.length; i++){
                    li +='<li><span id="head_'+rtm[i]['id']+'">'+rtm[i]['name']+'</span>&nbsp;<a href="javascript:" onclick="edit_head('+rtm[i]['id']+')"><i class="fa fa-edit text-primary"></i></a>'+'</li>';
                }
                $("#heads_list").html(li);
            }else{
                $("#heads_list").html('');
            }
        }, 'json');
    }
}

function edit_head(head_id){
    $("#update_head_name").val($("#head_"+head_id).html());
    $("#head_id").val(head_id);
    $("#frm_create_head").hide();
    $("#frm_update_head").show();
}

function cancel_update_head(){
    $("#frm_create_head").show();
    $("#frm_update_head").hide();
}

function getHeadsDropdown(){
    var base_url = $("#base_url").html();
    if($("#head_dropdown").length>0){
        $.get(base_url+"getHeads", {}, function(rtm){
            var option = '<option value="">Select head</option>';
            $("#head_dropdown").html('');
            if(rtm.length>0){
                for(var i = 0; i< rtm.length; i++){
                    option +='<option value="'+rtm[i]['id']+'">'+rtm[i]['name']+'</option>';
                }
                $("#head_dropdown").html(option);
            }else{
                $("#head_dropdown").html('');
            }
        }, 'json');
    }
}


// create acc sub heads
$("#frm_create_sub_head").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"create_sub_head",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                cancel_update_sub_head();                
                $.toaster('Sub head created/updated successfully.', 'Notice', 'info');
                getSubHeads();  
                getSubHeadsDropdown();              
            }
        }
   });
}));

function getSubHeads(){
    var base_url = $("#base_url").html();
    var head = $("#head_dropdown").val();
    if($("#get_head_list").length>0){
        $("#get_head_list").html('Loading...');
        $.post(base_url+"getSubHeads", {head:head}, function(rtm){
            var li = '';
            $("#get_head_list").html('');
            if(rtm.length>0){
                for(var i = 0; i< rtm.length; i++){
                    /*li +='<li><span id="sub_head_'+rtm[i]['id']+'">'+rtm[i]['name']+'</span>'+'</li>';*/
                    li +='<li><span id="sub_head_'+rtm[i]['id']+'">'+rtm[i]['name']+'</span>&nbsp;<a href="javascript:" onclick="edit_sub_head('+rtm[i]['id']+')"><i class="fa fa-edit text-primary"></i></a>'+'</li>';
                }
                $("#get_head_list").html(li);
            }else{
                $("#get_head_list").html('');
            }
        }, 'json');
    }
}

function edit_sub_head(sub_head_id){
    $("#sub_head_name").val($("#sub_head_"+sub_head_id).html());
    $("#sub_head_id").val(sub_head_id);

    $("#subhead-save-button").hide();
    $("#subhead-update-button").show();
}

function cancel_update_sub_head(){
    $("#subhead-save-button").show();
    $("#subhead-update-button").hide();

    $("#sub_head_name").val('');
    $("#sub_head_id").val('');
}

function getSubHeadsDropdown() {
    var base_url = $("#base_url").html();
    if($("#sub_head_dropdown").length>0){
        $.get(base_url+"getSubHeadsDropdown", {}, function(data){
            var option = '<option value="">Select head</option>';
            $("#sub_head_dropdown").html(option);
            $("#sub_head_dropdown").append(data);
        }, 'html');
    }
}


// create acc transaction heads
$("#frm_create_tran_head").on('submit',(function(e) {
    e.preventDefault();
    var base_url = $("#base_url").html();
    $.ajax({
        url: base_url+"create_tran_head",       // Url to which the request is send
        type: "POST",                   // Type of request to be send, called as method
        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,                   // To unable request pages to be cached
        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        success: function(data)         // A function to be called if request succeeds
        {
            if(data){
                cancel_update_tran_head();                
                $.toaster('Transaction head created/updated successfully.', 'Notice', 'info');
                getTranHeads();            
            }
        }
   });
}));

function getTranHeads(){
    var base_url = $("#base_url").html();
    var subhead = $("#sub_head_dropdown").val();
    if($("#get_tran_head_list").length>0){
        $("#get_tran_head_list").html('Loading...');
        $.post(base_url+"getTranHeads", {subhead:subhead}, function(rtm){
            var li = '';
            $("#get_tran_head_list").html('');
            if(rtm.length>0){
                for(var i = 0; i< rtm.length; i++){                    
                    li +='<li><span id="tran_head_'+rtm[i]['id']+'">'+rtm[i]['name']+'</span>&nbsp;<a href="javascript:" onclick="edit_tran_head('+rtm[i]['id']+')"><i class="fa fa-edit text-primary"></i></a>'+'</li>';
                }
                $("#get_tran_head_list").html(li);
            }else{
                $("#get_tran_head_list").html('');
            }
        }, 'json');
    }
}

function edit_tran_head(tran_head_id){
    $("#tran_head_name").val($("#tran_head_"+tran_head_id).html());
    $("#tran_head_id").val(tran_head_id);

    $("#tranhead-save-button").hide();
    $("#tranhead-update-button").show();
}

function cancel_update_tran_head(){
    $("#tranhead-save-button").show();
    $("#tranhead-update-button").hide();

    $("#tran_head_name").val('');
    $("#tran_head_id").val('');
}
