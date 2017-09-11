

function add_new_row()
{
    var amount =  parseInt($("#amount").val());
    var tabidx = parseInt($("#tabidx").val());
    $.ajax({
        url: "http://www.k-linkmember.co.id/ksystem/purchasing/helper_show_po_form2/" + amount + '/' + tabidx,
        type: 'GET',
        success:
        function(data){
            $("#addData").append(data);
            var x = amount + 1;
            var y = tabidx + 4;
            $("#amount").val(x);
            $("#tabidx").val(y);
        },
            error: function (xhr, ajaxOptions, thrownError) {
                 alert(thrownError + ':' +xhr.status);
            }
        
    });
}





function set_supplier_name()
{    
   $("#suppliername").val($("#suppliercode option:selected").text());
}

function num(val){
         var result = val.toString().split('').reverse().join("")
                          .match(/[0-9]{1,3}/g).join(".")
                          .match(/./g).reverse().join("");
    return result     
}

function num_normal(val){
         var result = val.toString().split('').reverse().join("")
                          .match(/[0-9]{1,3}/g).join("")
                          .match(/./g).reverse().join("");
    return result     
}

/*function delete_row(frm)
{
  
    var tot_all_price = parseInt($("#total_all_real").val()) - parseInt($("#totalpurchaseprice_real" +frm).val());   
    var tot_all_price_shows = num(tot_all_price.toString());
    $("#total_all").val(tot_all_price_shows);
    $("#total_all_real").val(tot_all_price); 
    
    $("tr#" +frm).remove(); 
    //alert("TR urutan ke" +frm);
}   

function submit_input_po()
{
   
    
    
} */

function save_po()
{
    
    $("#result").html('<center><img src=http://k-leo/ksystem/images/ajax-loader.gif ></center>');  
        $.post("http://www.k-linkmember.co.id/ksystem/purchasing/post_input_purchasing_order" ,$("form").serialize(), function(hasil)
        {  
            $("#content").html(hasil);
            
        }).fail(function() { 
            alert("Error requesting page"); 
            $("#result").html(null)
        });  
}

function back_to_form()
{
   $("#formawal").show();
   //$("form #formawal").css('display', 'block');
   $("#result").html(null);   
}

function back_to_form_app()
{
   $("#span_po_app").show();
   //$("#hasil").html(null);   
}




function show_po_form()
{
    var amount = $("#amount").val();
    $.ajax({
            url: "http://www.k-linkmember.co.id/ksystem/purchasing/helper_show_po_form/" +amount,
            timeout:9000,
            type: 'GET',
            success:
            function(data){
                $("#show_form").html(data);
                $("#forbutton").css('display', 'block');
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                 alert(thrownError + ':' +xhr.status);
            }
            
        });
    
} 

function show_prod_by_id(frm)
{
    $.ajax({
            dataType: 'json',
            url: "http://www.k-linkmember.co.id/ksystem/purchasing/helper_show_prod_by_id" ,
            type: 'POST',
            data: {productcode: $("#productcode" +frm).val()},
            success:
            function(data){
                if(data.response == 'true')
                {
                    $("#productname" +frm).val(data.productname)
                }
                else
                {
                    alert('product does not exist');
                    $("#productname" +frm).val(null)
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                 alert(thrownError + ':' +xhr.status);
            }
        });
}

function save_purchase()
{
           
    var act =  $("#action2").val();
    $("#result").html('<center><img src=http://k-leo/ksystem/images/ajax-loader.gif ></center>');  
        $.post("http://www.k-linkmember.co.id/ksystem/" +act,$("#formpost").serialize(), function(hasil)
        {             
            $("#result").html(hasil); 
        }); 
        
     /*$.ajax({
            url: "http://www.k-linkmember.co.id/ksystem/" +act,
            timeout:9000,
            type: 'POST',
            data: $(this).serialize(),
            success: function(hasil){
                $("#result").html(hasil)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                 alert(thrownError + ':' +xhr.status);
            }
            
        });    */
}



function qty_format(frm, jum_trx)
{
    var show = num($('#qty' +frm).val());
    $('#qty' +frm).val(show);
    
    var reals = num_normal(show);
    $('#qty_real' +frm).val(reals);
    
    
        var hargabeli = $('#purchaseprice_real' +frm).val();
        
        var total = parseInt(reals) * parseInt(hargabeli);
        var shows = num(total.toString());
        $('#totalpurchaseprice' +frm).val(shows);
   
        $('#totalpurchaseprice_real' +frm).val(total); 

		var tot_all_price = 0;
		
		for(var i = 1; i <= jum_trx; i++)
		   //for(var  i = 0; i < max; i++)
		   {
			 if($("#qty_real" +i).val() != '')
			 {

				tot_all_price = tot_all_price + parseInt($("#totalpurchaseprice_real" +i).val());
			 } 
			
		   } 
	  
		   var tot_all_price_shows = num(tot_all_price.toString());
		   $("#total_all").val(tot_all_price_shows);
		   $("#total_all_real").val(tot_all_price); 
}  

function purchaseprice_format(frm, jum_trx)
{
    var show = num($('#purchaseprice' +frm).val());
    $('#purchaseprice' +frm).val(show);
    
    var reals = num_normal($('#purchaseprice' +frm).val());
    $('#purchaseprice_real' +frm).val(reals);
    
    var qty_real = $('#qty_real' +frm).val();
    
    //$('#totalpurchaseprice' +frm).val(reals)
    var total = parseInt(reals) * parseInt(qty_real);
    var shows = num(total.toString());
    $('#totalpurchaseprice' +frm).val(shows);
    
    //var preals = num_normal(total);
    $('#totalpurchaseprice_real' +frm).val(total); 
    
    /*var tot_qty = 0;
    var tot_purchase_price = 0;
    var tot_sell_price = 0;*/
    var tot_all_price = 0;
    
    for(var i = 1; i <= jum_trx; i++)
       //for(var  i = 0; i < max; i++)
       {
         if($("#qty_real" +i).val() != '')
         {
          /*tot_qty = tot_qty + parseInt($("#qty_real" +i).val() );
          tot_purchase_price = tot_purchase_price + parseInt($("#purchaseprice_real" +i).val() );
          tot_sell_price = tot_sell_price + parseInt($("#sellprice_real" +i).val() );
          */
          tot_all_price = tot_all_price + parseInt($("#totalpurchaseprice_real" +i).val());
         } 
       }
       
       /*var tot_qty_shows = num(tot_qty.toString());
       $("#total_qty").val(tot_qty_shows);
       $("#total_qty_real").val(tot_qty);
       
       var tot_purchase_price_shows = num(tot_purchase_price.toString());
       $("#total_purchaseprice").val(tot_purchase_price_shows);
       $("#total_purchaseprice_real").val(tot_purchase_price);
       
       var tot_sell_price_shows = num(tot_sell_price.toString());
       $("#total_sellprice").val(tot_sell_price_shows);
       $("#total_sellprice_real").val(tot_sell_price);
       */
       var tot_all_price_shows = num(tot_all_price.toString());
       $("#total_all").val(tot_all_price_shows);
       $("#total_all_real").val(tot_all_price); 

}  

function sellprice_format(frm, jum_trx)
{
            
    
    var show = num($('#sellprice' +frm).val());
    $('#sellprice' +frm).val(show);
    
    var reals = num_normal($('#sellprice' +frm).val());
    $('#sellprice_real' +frm).val(reals);
    
    /*var tot_qty = 0;
    var tot_purchase_price = 0;
    var tot_sell_price = 0;*/
    var tot_all_price = 0;
    
    for(var i = 1; i <= jum_trx; i++)
       //for(var  i = 0; i < max; i++)
       {
         if($("#qty_real" +i).val() != '')
         {
          /*tot_qty = tot_qty + parseInt($("#qty_real" +i).val() );
          tot_purchase_price = tot_purchase_price + parseInt($("#purchaseprice_real" +i).val() );
          tot_sell_price = tot_sell_price + parseInt($("#sellprice_real" +i).val() );
          */
          tot_all_price = tot_all_price + parseInt($("#totalpurchaseprice_real" +i).val());
         } 
       }
    
    var amount =  parseInt($("#amount").val());
        var tabidx = parseInt($("#tabidx").val());
        $.ajax({
            url: "http://www.k-linkmember.co.id/ksystem//purchasing/helper_show_po_form2/" +amount + '/' +tabidx,
            type: 'GET',
            success:
            function(data){
                $("#addData").append(data);
                var x = amount + 1;
                var y = tabidx + 4;
                var next = frm + 1;
                $("#amount").val(x);
                $("#tabidx").val(y);
                $("#productcode" +next).focus();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                 alert(thrownError + ':' +xhr.status);
            }
            
        }); 
        
        
       /*var tot_qty_shows = num(tot_qty.toString());
       $("#total_qty").val(tot_qty_shows);
       $("#total_qty_real").val(tot_qty);
       
       var tot_purchase_price_shows = num(tot_purchase_price.toString());
       $("#total_purchaseprice").val(tot_purchase_price_shows);
       $("#total_purchaseprice_real").val(tot_purchase_price);
       
       var tot_sell_price_shows = num(tot_sell_price.toString());
       $("#total_sellprice").val(tot_sell_price_shows);
       $("#total_sellprice_real").val(tot_sell_price);*/
       
       var tot_all_price_shows = num(tot_all_price.toString());
       $("#total_all").val(tot_all_price_shows);
       $("#total_all_real").val(tot_all_price);
       /*$("#totAllBV").val(formatCurrency(+totBV));
       $("#totAllDPR").val(+totDP);
       $("#totAllBVR").val(+totBV);*/

}




    