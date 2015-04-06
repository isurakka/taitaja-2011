$(document).ready(function()
{
	var form = $("#requestform");
	var name = $("#name");
	var email = $("#email");
	var request = $("#request");
	var nameInfo = $("#nameInfo");
	var emailInfo = $("#emailInfo");
	var requestInfo = $("#requestInfo");

	function validateName()
	{
		if(name.val().length < 2)
		{
			nameInfo.text("Name must be at least 2 characters long!");
			return false;
		}
		else
		{
			nameInfo.text("");
			return true;
		}
	}

	function validateEmail()
	{
		var regex = new RegExp("[0-9A-Za-z]+@[0-9A-Za-z]+[\.][A-Za-z]{2,4}");
		if(email.val().length < 5)
		{
			emailInfo.text("Email Address must be at least 5 characters long!");
			return false;
		}
		else if (!regex.test(email.val()))
		{
			emailInfo.text("Invalid Email!");
			return false;
		}
		else
		{
			emailInfo.text("");
			return true;
		}
	}

	function validateRequest()
	{
		if(request.val().length < 3)
		{
			requestInfo.text("Request must be at least 3 characters long!");
			return false;
		}
		else
		{
			requestInfo.text("");
			return true;
		}
	}

	name.blur(validateName);
	email.blur(validateEmail);
	request.blur(validateRequest);

	name.keyup(validateName);
	email.keyup(validateEmail);
	request.keyup(validateRequest);
	
	name.change(validateName);
	email.change(validateEmail);
	request.change(validateRequest);

	form.submit(function()
	{
		if (validateName() & validateEmail() & validateRequest())
		{
			return true;
		}
		else
		{
			return false;
		}
	});
	
	$("#save").hide();
	$("#cancel").hide();
	$("#nameVal").hide();
	$("#emailVal").hide();
	$("#requestVal").hide();
	
	$("#ok").click(function()
	{
		if (validateName() & validateEmail() & validateRequest())
		{
			$("#save").show();
			$("#cancel").show();
			$("#ok").hide();
			
			$("#nameVal").show();
			$("#emailVal").show();
			$("#requestVal").show();
			
			$("#name").hide();
			$("#email").hide();
			$("#request").hide();
			
			$("#nameVal").text($("#name").val());
			$("#emailVal").text($("#email").val());
			$("#requestVal").text($("#request").val());
			
			$("#requesttitle").text("Please confirm your request");
		}
	});
	
	$("#cancel").click(function()
	{
			$("#save").hide();
			$("#cancel").hide();
			$("#ok").show();
			
			$("#nameVal").hide();
			$("#emailVal").hide();
			$("#requestVal").hide();
			
			$("#name").show();
			$("#email").show();
			$("#request").show();
			
			$("#requesttitle").text("Please fill the form below if you need to know something");
	});
});