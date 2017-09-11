function num(val){
         var result = val.toString().split('').reverse().join("").match(/[0-9]{1,3}/g).join(".").match(/./g).reverse().join("");
    return result     
}


function num_normal(val){
         var result = val.toString().split('').reverse().join("")
                          .match(/[0-9]{1,3}/g).join("")
                          .match(/./g).reverse().join("");
    return result     
}


/*function add_new_sales_row()
{
    var amount =  parseInt($("#amount").val());
    var tabidx = parseInt($("#tabidx").val());
    $.ajax({
        url: "http://www.k-linkmember.co.id/ksystem/sales/helper_show_sales_form2/" + amount + '/' + tabidx,
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
}*/

function add_new_sales_row()
{
    var amount =  parseInt($("#amount").val());
    var tabidx = parseInt($("#tabidx").val());
    var j = tabidx;
    var koma = ",";
        
    var rowshtml = "<tr id="+ amount +">";
    rowshtml +=  "<td><input onchange=show_prod_by_id_for_sales("+ amount +") tabindex="+ j +" type=text class=span12 id=productcode"+ amount +" name=productcode["+ amount +"] /></td>";
    rowshtml +=  "<td><input readonly=yes type=text class=span12 id=productname"+ amount +"  name=productname["+ amount +"] /></td>";
    j++;
    rowshtml += "<td><input onchange=sales_qty_format("+ amount + koma + amount +") tabindex="+ j +" style=text-align:right type=text class=span12 id=qty"+ amount +" name=qty["+ amount +"] />";
    rowshtml += "<input style=text-align:right;  type=hidden class=span12 id=qty_real"+ amount +" name=qty_real["+ amount +"] /></td>";
    j++;
    rowshtml += "<td><input readonly=yes style=text-align:right; type=text class=kanan id=dp"+ amount +"  name=dp["+ amount +"] />";
    rowshtml += "<input style=text-align:right; type=hidden class=kanan id=dp_real"+ amount +" name=dp_real["+ amount +"] /></td>";                     
    rowshtml += "<td><input readonly=yes style=text-align:right; type=text class=kanan id=total_dp"+ amount +"  name=total_dp["+ amount +"] />";
    rowshtml += "<input style=text-align:right; type=hidden class=kanan id=total_dp_real"+ amount +"  name=total_dp_real["+ amount +"]/></td>";
    rowshtml += "<td ><a class=tombol href=# id="+ amount +" onclick=delete_row("+ amount +")><i class=ikon></i> </a>";
    rowshtml += "</tr>";
    var x = amount + 1;
    var y = tabidx + 2;
    $("#amount").val(x);
    $("#tabidx").val(y); 
    $("#addData").append(rowshtml);
    $(".kanan").removeClass().addClass("span12 text-right");
    $(".tombol").removeClass().addClass("btn btn-mini btn-danger");
    $(".ikon").removeClass().addClass("icon-trash icon-white");
    $("#productcode" +amount).focus();
}

function show_prod_by_id_for_sales(frm)
{
    $.ajax({
            dataType: 'json',
            url: "http://www.k-linkmember.co.id/ksystem/sales/helper_show_prod_by_id" ,
            type: 'POST',
            data: {productcode: $("#productcode" +frm).val(), pricecode: $("#pricecode").val()},
            success:
            function(data){
                if(data.response == 'true')
                {
                    $("#productname" +frm).val(data.productname);
                    //$("#dp" +frm).val(data.dp);
                    $("#dp" +frm).val(data.dp_real);
                    $("#dp_real" +frm).val(data.dp_real);
                }
                else
                {
                    alert('product does not exist');
                    $("#productname" +frm).val(null);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                 alert(thrownError + ':' +xhr.status);
            }
        });
}

function sales_qty_format(frm, jum_trx)
{
    //var show = num($('#qty' +frm).val());
    //$('#qty' +frm).val(show);
    
    //var reals = num_normal(show);
    //$('#qty_real' +frm).val(reals);
    var qty = $('#qty' +frm).val();
    var dp = $('#dp_real' +frm).val();
        
        var total = parseInt(qty) * parseInt(dp);
        var shows = num(total.toString());
        $('#total_dp_real' +frm).val(total);
        
        //var preals = num_normal(total);
        $('#total_dp' +frm).val(shows); 

    var tot_all_price = 0;
    var j_trx = $("#amount").val();
    //var tot_all_price = '';
    for(var i = 1; i <= j_trx; i++)
       //for(var  i = 0; i < max; i++)
       
       {
         var ss = $("#qty" +i).val();
         if(ss === undefined)
         {
           
            tot_all_price = tot_all_price + 0;
            //alert('undefined');
         } 
         else   
         {
            tot_all_price += parseInt($("#total_dp_real" +i).val());
         }
        
       } 
   
       var tot_all_price_shows = num(tot_all_price.toString());
       $("#total_all").val(tot_all_price_shows);
       $("#total_all_real").val(tot_all_price); 
       $("#total_dp_pay").val(tot_all_price_shows);
       $("#total_dp_pay_real").val(tot_all_price); 
       var charge = parseInt($("#charge_real").val()); 
       if(charge === undefined)
       {
          charge = 0;
       } 
       var total_net = tot_all_price + charge;
       var total_net_shows = num(total_net);
    
       $("#total_net").val(total_net_shows);
       $("#total_net_real").val(total_net);
       $("#new_record").focus();
       
       $(".sales_payment").val(0);
        
       var tabdx =  parseInt($("#tabidx").val());
       var button_new_record = tabdx + 2;
       $("#new_record").attr('tabindex', button_new_record);
       
       var tab_charge = button_new_record + 1;
       $("#charge").attr('tabindex', tab_charge);
       var tab_pay_cash = tab_charge + 1;
       $("#pay_cash").attr('tabindex', tab_pay_cash);
       var tab_pay_transfer = tab_pay_cash + 1;
       $("#pay_transfer").attr('tabindex', tab_pay_transfer);
       var tab_notes = tab_pay_transfer + 1;
       $("#notes").attr('tabindex', tab_notes); 
      //add_new_sales_row();
      //var next = frm + 1;
      //$("#productcode" +next).focus();  
}  

