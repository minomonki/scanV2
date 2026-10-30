<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<!--<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css"> -->
<style type="text/css">
/* Overide css code กำหนดความกว้างของปฏิทินและอื่นๆ */
.ui-datepicker{
	width:170px;
	font-family:tahoma;
	font-size:11px;
	text-align:center;
}
</style>
</head>

<body>


  <!--<input type="text" name="admit_s" id="admit_s" /> -->
 <!-- <input type="text" name="admit_e" id="admit_e" /> -->
  <!--<input type="text" name="dis_s" id="dis_s" /> -->
  <!--<input type="text" name="dis_e" id="dis_e" /> -->
  
 <!-- <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> -->

<script type="text/javascript">
$(function(){
	var dateBefore=null;
	$("#admit_s").datepicker({
		dateFormat: 'yy-mm-dd',
		showOn: 'button',
		buttonImage: '../datepick/calendar.gif',
		buttonImageOnly: true,
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'], 
		monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		changeMonth: true,
		changeYear: true ,
		beforeShow:function(){
			if($(this).val()!=""){
				var arrayDate=$(this).val().split("-");		
				arrayDate[2]=parseInt(arrayDate[2]);
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
			}
			setTimeout(function(){
				$.each($(".ui-datepicker-year option"),function(j,k){
					//var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
					var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());
					if  (textYear<2400){textYear +=543}
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});				
			},50);

		},
		onChangeMonthYear: function(){
			setTimeout(function(){
				$.each($(".ui-datepicker-year option"),function(j,k){
					//var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
					var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());
					if  (textYear<2400){textYear +=543}
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});				
			},50);		
		},
		onClose:function(){
			if($(this).val()!="" && $(this).val()==dateBefore){			
				var arrayDate=dateBefore.split("-");
				//arrayDate[0]=parseInt(arrayDate[0])+543;
				arrayDate[0]=parseInt(arrayDate[0]);
				if  (arrayDate[0]<2400){arrayDate[0] +=543}
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);	
			}		
		},
		onSelect: function(dateText, inst){ 
			dateBefore=$(this).val();
			var arrayDate=dateText.split("-");
			//arrayDate[0]=parseInt(arrayDate[0])+543;
				arrayDate[0]=parseInt(arrayDate[0]);
				if  (arrayDate[0]<2400){arrayDate[0] +=543}
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
		}

	});
	
});

$(function(){
	var dateBefore=null;
	$("#admit_e").datepicker({
		dateFormat: 'yy-mm-dd',
		showOn: 'button',
		buttonImage: '../datepick/calendar.gif',
		buttonImageOnly: true,
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'], 
		monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		changeMonth: true,
		changeYear: true ,
		beforeShow:function(){
			if($(this).val()!=""){
				var arrayDate=$(this).val().split("-");		
				arrayDate[2]=parseInt(arrayDate[2]);
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
			}
			setTimeout(function(){
				$.each($(".ui-datepicker-year option"),function(j,k){
					//var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
					var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());
					if  (textYear<2400){textYear +=543}
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});				
			},50);

		},
		onChangeMonthYear: function(){
			setTimeout(function(){
				$.each($(".ui-datepicker-year option"),function(j,k){
					//var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
					var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());
					if  (textYear<2400){textYear +=543}
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});				
			},50);		
		},
		onClose:function(){
			if($(this).val()!="" && $(this).val()==dateBefore){			
				var arrayDate=dateBefore.split("-");
				//arrayDate[0]=parseInt(arrayDate[0])+543;
				arrayDate[0]=parseInt(arrayDate[0]);
				if  (arrayDate[0]<2400){arrayDate[0] +=543}
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);	
			}		
		},
		onSelect: function(dateText, inst){ 
			dateBefore=$(this).val();
			var arrayDate=dateText.split("-");
			//arrayDate[0]=parseInt(arrayDate[0])+543;
				arrayDate[0]=parseInt(arrayDate[0]);
				if  (arrayDate[0]<2400){arrayDate[0] +=543}
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
		}

	});
	
});



$(function(){
	var dateBefore=null;
	$("#dis_s").datepicker({
		dateFormat: 'yy-mm-dd',
		showOn: 'button',
		buttonImage: '../datepick/calendar.gif',
		buttonImageOnly: true,
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'], 
		monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		changeMonth: true,
		changeYear: true ,
		beforeShow:function(){
			if($(this).val()!=""){
				var arrayDate=$(this).val().split("-");		
				arrayDate[2]=parseInt(arrayDate[2]);
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
			}
			setTimeout(function(){
				$.each($(".ui-datepicker-year option"),function(j,k){
					//var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
					var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());
					if  (textYear<2400){textYear +=543}
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});				
			},50);

		},
		onChangeMonthYear: function(){
			setTimeout(function(){
				$.each($(".ui-datepicker-year option"),function(j,k){
					//var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
					var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());
					if  (textYear<2400){textYear +=543}
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});				
			},50);		
		},
		onClose:function(){
			if($(this).val()!="" && $(this).val()==dateBefore){			
				var arrayDate=dateBefore.split("-");
				//arrayDate[0]=parseInt(arrayDate[0])+543;
				arrayDate[0]=parseInt(arrayDate[0]);
				if  (arrayDate[0]<2400){arrayDate[0] +=543}
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);	
			}		
		},
		onSelect: function(dateText, inst){ 
			dateBefore=$(this).val();
			var arrayDate=dateText.split("-");
			//arrayDate[0]=parseInt(arrayDate[0])+543;
				arrayDate[0]=parseInt(arrayDate[0]);
				if  (arrayDate[0]<2400){arrayDate[0] +=543}
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
		}

	});
	
});


$(function(){
	var dateBefore=null;
	$("#dis_e").datepicker({
		dateFormat: 'yy-mm-dd',
		showOn: 'button',
		buttonImage: '../datepick/calendar.gif',
		buttonImageOnly: true,
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'], 
		monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		changeMonth: true,
		changeYear: true ,
		beforeShow:function(){
			if($(this).val()!=""){
				var arrayDate=$(this).val().split("-");		
				arrayDate[2]=parseInt(arrayDate[2]);
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
			}
			setTimeout(function(){
				$.each($(".ui-datepicker-year option"),function(j,k){
					//var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
					var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());
					if  (textYear<2400){textYear +=543}
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});				
			},50);

		},
		onChangeMonthYear: function(){
			setTimeout(function(){
				$.each($(".ui-datepicker-year option"),function(j,k){
					//var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
						var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());
					if  (textYear<2400){textYear +=543}
				$(".ui-datepicker-year option").eq(j).text(textYear);
				});				
			},50);		
		},
		onClose:function(){
			if($(this).val()!="" && $(this).val()==dateBefore){			
				var arrayDate=dateBefore.split("-");
				//arrayDate[0]=parseInt(arrayDate[0])+543;
				arrayDate[0]=parseInt(arrayDate[0]);
				if  (arrayDate[0]<2400){arrayDate[0] +=543}
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);	
			}		
		},
		onSelect: function(dateText, inst){ 
			dateBefore=$(this).val();
			var arrayDate=dateText.split("-");
			//arrayDate[0]=parseInt(arrayDate[0])+543;
				arrayDate[0]=parseInt(arrayDate[0]);
				if  (arrayDate[0]<2400){arrayDate[0] +=543}
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
		}

	});
	
});

</script>