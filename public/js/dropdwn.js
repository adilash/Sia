console.log(6);
	
	var dp="";
	var pgm="";
	ahidedrop=function(x,y){
		console.log(dp);
		console.log(pgm);
		$.each( y, function( key, value ) {
			console.log("select#add"+x+value);
 		$("select#add"+x+value).hide();
 		$("select#add"+x+value).val(0);
 		console.log(value)	
 		});
		$("select#ayear").hide();
		$("select#year").val(0);
		$("select#ttype").hide();
		$("select#ttype").val(0);
		if($("#filelnk").length)
		{
			$("#filelnk").hide();
		}
	}
	apgdrpdwn=function()
	{
		dp=$("select#adddept").val()
		if(pgm)
		{
			hidedrop(pgm,["Crs"]);
		}
		pgm=$("select#add"+dp+"Pgm").val();
		console.log(dp+"pg");
		$("select#add"+pgm+"Crs").show();
	}
	acrsdrpdwn=function()
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
    $("select#adddept").on('change',function(){
    		if(dp)
    		{	
    			$("select#add"+dp+"Pgm").hide();

    			hidedrop(pgm,["Crs"]);

    		}
        	dp=$(this).val();
        $("select#add"+dp+"Pgm").show();
        console.log(dp);
        console.log(6);
    });
    
    /*$("select#"+dp+"Crs").on('change',function(){
        $("select#year").show();
        $("select#ttype").show();
    });*/