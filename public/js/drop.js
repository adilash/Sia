console.log(6);
	
	var dp="";
	var pgm="";
	hidedrop=function(x,y){
		console.log(dp);
		console.log(pgm);
		$.each( y, function( key, value ) {
			console.log("select#"+dp+value);
 		$("select#"+dp+value).hide();
 		$("select#"+dp+value).val(0);
 		console.log(value)	
 		});
		$("select#year").hide();
		$("select#year").val(0);
		$("select#ttype").hide();
		$("select#ttype").val(0);
		if($("#filelnk").length)
		{
			$("#filelnk").hide();
		}
	}
	pgdrpdwn=function()
	{
		dp=$("select#dept").val()
		hidedrop(dp,['Crs'])
		console.log(dp+"pg");
		$("select#"+dp+"Crs").show();
	}
	crsdrpdwn=function()
	{
		$("select#year").show();
		$("select#ttype").show();
	}
	/*$("select#"+dp+"Pgm").on('change',function(){

        	pgm=$(this).val();
        	console.log();	
        $("select#"+dp+"Crs").show();
    });
    */
    $("select#dept").on('change',function(){
    		if(dp)
    		{
    			hidedrop(dp,["Crs","Pgm"]);
    		}
        	dp=$(this).val();
        $("select#"+dp+"Pgm").show();
        console.log(dp);
        console.log(6);
    });
    
    /*$("select#"+dp+"Crs").on('change',function(){
        $("select#year").show();
        $("select#ttype").show();
    });*/