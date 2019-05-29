<?php 
$k=10;
 ?>
<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
	// var zz= 0;
</script>
<script type="text/javascript">

function queue(order,value,content) {
    this.order = order ;
    this.value = value;   
    this.content = content ;   
}

<?php for($i=0;$i<$k;$i++){?>
var queue<?php echo $i;?> = new queue(<?php echo $i;?>,'/','null');

function intObj<?php echo $i;?>(O,V,C)
{
	queue<?php echo $i;?>.order=O;
	queue<?php echo $i;?>.value=V;
	queue<?php echo $i;?>.content=C;
}

<?php }?>
// queue放入列隊順序 用php迴圈創立k相對應的數量 value放src


function allowDrop(ev)
{
ev.preventDefault();
}

function drag(ev)
{
ev.dataTransfer.setData("Text",ev.target.id);

}
var a = null;



function drop(ev,i)
{
var x = document.getElementById("progressbarTWInput").files;
ev.preventDefault();
var data=ev.dataTransfer.getData("Text");
ev.target.appendChild(document.getElementById(data));

document.getElementById(data).draggable=true;
document.getElementById(data).parentNode.ondragover="";
var srcid =x[i].name;

if(i=="0")
{

	intObj0(i,srcid);

}	
<?php for($i=1;$i<$k;$i++){?>
else if(i == "<?php echo $i;?>")
{
	intObj<?php echo $i;?>(i,srcid);
}
<?php }?>

}

function put()
{

	for (var i = window.zz ; i >= 0; i--) {
		this['queue'+i].content = $("#C"+i).val();
	}
	this['queue']
	var total = "[" + <?php for($i=0 ;$i<$k;$i++){?> JSON.stringify(queue<?php echo $i;?>)  <?php if($i != $k-1){ echo "+ ',' +"; } ?><?php }?> +"]";
	// console.log(total);
	document.getElementById("z").value = total ;

}
</script>
</head>
<body>


<!-- <input type="hidden" id="total1" value=""> -->
<?php 
// for($i=0;$i<$k;$i++){
	?>

<div id=test123></div>
<!-- <div id="div<?php echo $i;?>" ondrop="drop(event,<?php echo $i;?>)" ondragover="allowDrop(event)" ></div> -->
<?php 
// }
?>
<div style="clear:both;"></div>
<br /><br /><br />

<p id="p1"></p>

<form method="post" enctype="multipart/form-data" action="http://127.0.0.1/up1.php"  >

 <input type="file" name="filen[]" id="progressbarTWInput" accept="image/gif, image/jpeg, image/png" multiple/ >
   <div id="preview_progressbarTW_imgs" style="width:100%; height: 200px; overflow:scroll;">
       <p>目前沒有圖片</p>
   </div>
<!-- hidden -->
<input type="" name="z" id="z" value="">
<!-- <button type="button" onclick="put()"  >用log看</button> -->
<input type="submit" name="" onclick="put()" value="123">
</form>


</body>
</html>
<!-- 放重置鈕 -->
<script>
$("#progressbarTWInput").change(function(){
  $("#preview_progressbarTW_imgs").html(""); // 清除預覽
  readURL(this);
});

function readURL(input){
  if (input.files && input.files.length >= 0) {
  	if (input.files.length < 10){
	    for(var j = 0; j < input.files.length; j ++){
	      var xx = 0;
	      var reader = new FileReader();
	      reader.onload = function (e) {
	      	// alert(xx);
	        var img = $("<img width='50' height='50' id='drop"+ xx +"' draggable='true' ondragstart='drag(event)''>").attr('src', e.target.result);
	        $("#preview_progressbarTW_imgs").append(img);
	        // ondrop="drop(event,<?php echo $i;?>)" 
	        var txt = $("<p>1</p><input type='text' id='C"+xx+"' />");
	        var div = $("<div id='div"+ xx +"'></div>").attr('ondrop', "drop(event,"+xx+")").attr('ondragover',"allowDrop(event)");
	        $("#test123").append(div);
	        $("#test123").append(txt);
	        $("#test123").append('<br>');
	        $("#div"+xx).css({"width":"200px","height":"50px","padding":"50px","border":"1px solid #aaaaaa","line-height":"10px","float":"left","display":"inline"});
	        xx +=1 ;
	      }  
	      window.zz = j ;
	      reader.readAsDataURL(input.files[j]);
	    }
	}else{
		alert("超過10張");
		$("#progressbarTWInput").val("");;
		
	}
  }else{
     var noPictures = $("<p>目前沒有圖片</p>");
     $("#preview_progressbarTW_imgs").append(noPictures);
  }
}
</script>