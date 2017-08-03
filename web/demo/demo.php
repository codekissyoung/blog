<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>css</title>
        <style>
            *{
                margin: 0px;
                padding: 0px;
                /*outline: 1px solid red;*/
            }
            .d1{
                margin:40px 0px;
                background-color:#eeffff;
                padding:10px 0px;

            }
            .d2{
                margin: 20px 0px;
                height: 50px;
                background-color: #eeeeee;
            }
            .d3{
                margin:20px 0px;
                padding:10px 0px;
                background-color: pink;
                height: 0;
            }
        </style>
    </head>
    <body style="height:2000px;">
        <div style="height:10px;background-color:black;">
        </div>
        <div class="d1">
            <div class="d2">
            </div>
        </div>

        <div class="d3">
        </div>

    </body>
	<script>
		console.log(innerHeight);
		console.log(innerWidth);
		console.log(pageXOffset);
		console.log(pageYOffset);
		
		console.log(screenX);
		console.log(screenY);

		console.log(document.lastModified);
		for(var x in document)
		{
			console.log( x + ":" + document[x]);
		}
	</script>
</html>
