
$(document).ready(function() {
        
        $("#new_record").click(function () {
                var amount =  parseInt($("#amount").val());
                var tabidx = parseInt($("#tabidx").val());
                $.ajax({
                    url: "http://k-leo/ksystem/purchasing/helper_show_po_form2/" + amount + '/' + tabidx,
                    type: 'GET',
                    success:
                    function(data){
                        $("#addData").append(data);
                        var x = amount + 1;
                        var y = tabidx + 4;
                        $("#amount").val(x);
                        $("#tabidx").val(y);
                    }
                });
            });
            
});
    
function submit_input_po()
{
   alert('okeee');
    
}

function qty_format1(frm, jum_trx)
{
     var show = parseInt($('#qty' +frm).val());
    $('#qty' +frm).val(show);
    
    var reals = parseInt($('#qty' +frm).val());
    $('#qty_real' +frm).val(reals);
    
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
          tot_all_price = tot_all_price + parseInt($("#qty_real" +i).val());
         } 
       }
    
    var amount =  parseInt($("#amount").val());
        var tabidx = parseInt($("#tabidx").val());
        $.ajax({
            url: "http://www.k-linkmember.co.id/ksystem//product/helper_show_po_form2/" +amount + '/' +tabidx,
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
        
       
       var tot_all_price_shows = parseInt(tot_all_price.toString());
       $("#total_all").val(tot_all_price_shows);
       $("#total_all_real").val(tot_all_price);
}


function delete_row1(frm)
{
    //alert('isi' +frm);
       
    var tot_all_price = parseInt($("#total_all_real").val()) - parseInt($("#qty_real" +frm).val());   
    var tot_all_price_shows = parseInt(tot_all_price.toString());
    $("#total_all").val(tot_all_price_shows);
    $("#total_all_real").val(tot_all_price); 
    
    $("tr#" +frm).remove();
} 


function add_new_row1()
{
    var amount =  parseInt($("#amount").val());
    var tabidx = parseInt($("#tabidx").val());
    $.ajax({
        url: "http://www.k-linkmember.co.id/ksystem/product/helper_show_po_form2/" + amount + '/' + tabidx,
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


function save_grouping_product()
{
    
    $("#result").html('<center><img src=http://k-leo/ksystem/images/ajax-loader.gif ></center>');  
        $.post("http://www.k-linkmember.co.id/ksystem/product/post_input_product_grouping" ,$("form").serialize(), function(hasil)
        {  
            $("#content").html(hasil);
            
        }).fail(function() { 
            alert("Error requesting page"); 
            $("#result").html(null)
        });  
}