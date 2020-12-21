// JavaScript Document
function lo(th,url)
{
	$.ajax(url,{cache:false,success: function(x){$(th).html(x)}})
}
function good(news,user,type)
{
	$.post("api/good.php",{news,user,type},function()
	{
		if(type=="1")
		{
			$("#vie"+news).text($("#vie"+news).text()*1+1)
			$("#good"+news).text("收回讚").attr("onclick","good('"+news+"','"+user+"','2')")
		}
		else
		{
			$("#vie"+news).text($("#vie"+news).text()*1-1)
			$("#good"+news).text("讚").attr("onclick","good('"+news+"','"+user+"','1')")
		}
	})
}