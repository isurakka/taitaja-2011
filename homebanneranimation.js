$(document).ready(function()
{
	var banner = $("#bannertd");
	var bannertext = $("#bannertext");
	var images = new Array();
	images[0] = "images/home/homebanner1.jpg";
	images[1] = "images/home/homebanner2.jpg";
	images[2] = "images/home/homebanner3.jpg";
	
	var texts = new Array();
	texts[0] = "Beautiful Enviroments";
	texts[1] = "Amazing Experiences";
	texts[2] = "Exotic Wildlife";
	
	function getRandomNumber()
	{
		return Math.floor(Math.random()*(images.length));
	}
	
	var rnd = getRandomNumber()
	banner.css("background-image", "url(" + images[rnd] + ")");
	bannertext.text(texts[rnd]);
	
	switch(rnd)
	{
		case 0:
		{
			whiteText();
			break;
		}
		case 1:
		{
			blackText();
			break;
		}
		case 2:
		{
			blackText();
			break;
		}
	}
	
	function blackText()
	{
		bannertext.css("color", "#000000");
	}
	
	function whiteText()
	{
		bannertext.css("color", "#FFFFFF");
	}
	
	
});