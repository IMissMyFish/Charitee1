$(window).ready(function(){
	var left, width, cont = "#q-cont";
	var str = 'Poverty';
	$('span').click(function(){
		$(this).css("background","#5a6");
		$('.re').css("background","#d90");
		
		next();
	});
	$('.re').click(function(){
		$(".op").css("background","#d90");
		$('.re').css("background","#5a6");
		$(cont).css("left", "0px");
	});
	
	
	
	function next() {
		width = $(cont).width()/4;
		//var n = $( "option:selected" ).length;
		
		
		
		left = $(cont).css("left").slice(0,-2)*1;
		left -= width;
		$(cont).css("left", left+"px");
		
	}
});