    var url;
    var text;
	var pilih_category;
	var pilih_tingkatan;
    window.onload = function() {
    	//text = document.getElementById("hasil");
		console.log("java start");
		var pilih_category	= document.getElementById("pilih_category");
		var pilih_tingkatan	= document.getElementById("pilih_tingkatan");
		
		pilih_category.onchange = function(){
		console.log("pilih_category on change start");
			url="http://localhost/kuliah_rpl_oop/web/json/history.php?category="+"'"+pilih_category.value+"'";
	        console.log(url);
			getdata();
	}

	function getdata(){
		//hapus data lama
		while(pilih_tingkatan.firstChild){
			pilih_tingkatan.removeChild(pilih_tingkatan.firstChild);
		}

		//ambil data
        console.log("start");
        var request = new XMLHttpRequest();
        request.open("GET", url, true);
	        request.onreadystatechange = function(){
		        console.log("onreadystatechange");
	    	    var done = 4;
	        	var ok = 200;
		          	if(request.readyState == done && request.status == ok){
		          		console.log(request.response);
		            	data = JSON.parse(request.response);
		            	console.log(data);            
						for(var i =0; i < data.data.length ; i++){			
							console.log(data.data[i].tingkatan);
							var option = document.createElement("option");
							option.setAttribute("value",data.data[i].tingkatan);
							option.text=data.data[i].tingkatan;
							pilih_tingkatan.appendChild(option);	      
		          		}
		            }
	        }
        request.send(null)
    }

}
