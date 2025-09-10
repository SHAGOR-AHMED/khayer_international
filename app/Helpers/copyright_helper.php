<?php
		
	// This function check hacking V.V.I.
	function goodbye() 
	{
		redirect("login");
	}
	
	// Notify message for save/update/delete/error	
	function saved_success()
	{
		return "Saved successfully";
	}
	
	function uploaded_success()
	{
		return "Uploaded successfully";
	}
	
	function updated_success()
	{
		return "Updated successfully";
	}
	
	function deleted_success() 
	{
		return "Deleted successfully.";
	}
	
	function exception() 
	{
		return "Failure, please try again.";
	}
	
	function unauthorized() 
	{
		return "You are not authorized.";
	}
	
    function developed_by() 
	{
		return 'Developed By: WAN IT Ltd.';
	}
	
    function print_date() 
	{
		return 'Print Date: '.date('d-m-Y');
	}
