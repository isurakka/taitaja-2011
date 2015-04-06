$(document).ready(function()
{
	var btnBack = $("#btnBack");

	var trExh = $("#trExh");
	var trFes = $("#trFes");
	var trPer = $("#trPer");
	var trSpo = $("#trSpo");
	
	var trArray = new Array();
	trArray[0] = trExh;
	trArray[1] = trFes;
	trArray[2] = trPer;
	trArray[3] = trSpo;
	
	btnBack.click(function()
		{
			btnBack.hide();
			resetFocus();
		});
	
	trExh.click(function()
	{ 
	setFocus(trExh); 
	btnBack.show(); 
	$("#newstable_Exhibitions").show();
	$("#newstable_Festivals").hide();
	$("#newstable_PerformingArts").hide();
	$("#newstable_Sports").hide();
	$("#nonews_Exhibitions").show();
	});
	
	trFes.click(function()
	{
	setFocus(trFes); 
	btnBack.show();
	$("#newstable_Exhibitions").hide();
	$("#newstable_Festivals").show();
	$("#newstable_PerformingArts").hide();
	$("#newstable_Sports").hide();
	$("#nonews_Festivals").show();
	});
	
	trPer.click(function()
	{
	setFocus(trPer); 
	btnBack.show();
	$("#newstable_Exhibitions").hide();
	$("#newstable_Festivals").hide();
	$("#newstable_PerformingArts").show();
	$("#newstable_Sports").hide();
	$("#nonews_PerformingArts").show();
	});
	
	trSpo.click(function()
	{
	setFocus(trSpo); 
	btnBack.show(); 
	$("#newstable_Exhibitions").hide();
	$("#newstable_Festivals").hide();
	$("#newstable_PerformingArts").hide();
	$("#newstable_Sports").show();
	$("#nonews_Sports").show();
	});
	
	function setFocus(tr)
	{
		for(i=0;i<=trArray.length-1;i++)
		{
			var thetr = trArray[i];
			if (thetr == tr)
			{
				continue;
			}
			$("#" + thetr.attr("id") + " td").hide();
			$("#" + tr.attr("id") + " td").show();
		}
		$("td.whatsonmargin").css("height", "0px");
		$("#whatsontitle").hide();
	}
	
	function resetFocus()
	{
		for(i=0;i<=trArray.length-1;i++)
		{
			var thetr = trArray[i];
			$("#" + thetr.attr("id") + " td").show();
			$("td.whatsonmargin").css("height", "15px");
		}
		$("#newstable_Exhibitions").hide();
		$("#newstable_Festivals").hide();
		$("#newstable_PerformingArts").hide();
		$("#newstable_Sports").hide();
		$("#nonews_Exhibitions").hide();
		$("#nonews_Festivals").hide();
		$("#nonews_PerformingArts").hide();
		$("#nonews_Sports").hide();
		$("#whatsontitle").show();
	}
	
	

	btnBack.hide();
	resetFocus();
});