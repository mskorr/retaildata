
//  jQuery.noConflict();
function syncAjax(u) {
    var obj = $.ajax({url: u, async: false});
    return $.parseJSON(obj.responseText);
}


var x = 0;
function no(val,shop_id, description) 
{   
    //            alert("desc");
    if(shop_id === 0)
    {
        x = val; 
        
        $("#yes").hide();
        $("#no").hide();
        $(".edit").show();   
    }
    
    else
    {
        //        alert("this is the shop " + val2);
        
        var b = document.getElementById("myModalLabel").innerHTML;  
        showModal(b,shop_id); 
        //        $("#myModal").modal(); 

        $("#myModalShop").html(shop_id); 
        $("#old_description").children().remove(); 
        $("#old_description").append('<li>' + description + '</li>' );       
        
    } 
}

function change_select_item_type(val)
{
    //    alert(val);
    if (val === '1')
    {
        //        alert(val + "thi is the vle");
        $('#comment').prop('disabled', true);
        $('#unit_value').prop('disabled', true);
        $('#unit').prop('disabled', true);
        $('.selectpicker').selectpicker('destroy');
//        $('#family').prop('disabled', true);
//        $('#brand').prop('disabled', true);
        $('#brand_link').prop('disabled', true);  
        $('#description').prop('disabled', true);
        $('#packaging').prop('disabled', true);
        $('#offer_value').prop('disabled', true);
        $('#quality').prop('disabled', true);
    } else 
    {
         $('.selectpicker').selectpicker('render');
        $('#comment').prop('disabled', false);
        $('#unit_value').prop('disabled', false);
        $('#unit').prop('disabled', false);
        $('#family').prop('disabled', false);
        $('#quality').prop('disabled', false);
        $('#brand').prop('disabled', false);
        $('#brand_link').prop('disabled', false);  
        $('#description').prop('disabled', false);
        $('#packaging').prop('disabled', false); 
        $('#offer_value').prop('disabled', false);
    }

}

function login()
{
//            alert("here");
    var user = document.getElementById('user').value;
    var pass = document.getElementById('pass').value;
    //alert(pass);
    var u = "../functions/action.php?cmd=7&user=" + user + "&pass=" + pass;
//            prompt("login", u);  
    var r = syncAjax(u);

    if (r.result === 1)
    {
        //          alert("here 1"); 
        if(r.user_type === 1)
        {
            //             alert("here 2");
            document.location.href = "index.php";
        }
        else if (r.user_type === 2)
        {
            //             alert("here 3");
            document.location.href = "tables.php";
        }
            
    } else if (r.result === 0)
    {
        document.location.href = "login.php";
    }

    //    alert(user + " " + pass);
}

function generate_password()
{
    //    alert("here"); 
    var len = 9;
    var text = " ";

    var charset = "!abcdefghi012345jklmnopqrstuvwxyz6789";

    for (var i = 0; i < len; i++)
        text += charset.charAt(Math.floor(Math.random() * charset.length));
    var generated_password = document.getElementById('generated_password');
    $('#generated_password').show(); 
    generated_password.innerHTML = text; 
    //    alert(text);
}

 

function add_user()
{
    var fname = document.getElementById("firstname").value;
    var lname = document.getElementById("lastname").value;
    var u_type = document.getElementById('user_type');
    var u_name = document.getElementById('user_name').value;
    var user_type = u_type.options[u_type.selectedIndex].value;
    var password = document.getElementById('generated_password').innerHTML;
    alert(password); 
    var u = "../functions/action.php?cmd=5&fname=" + fname + "&lname=" + lname + "&u_type=" + user_type + "&uname=" + u_name + "&pass=" + password;
    //        prompt("creae user", u);
    var r = syncAjax(u);

    if (r.result === 1)
    {
        alert("user succesfuly created!!");
        document.location.href = "manage_users.php";
    }
}

function change_select_family(id)
{
    document.getElementById("family_id").innerHTML = id; 
    //    alert(id); 
    var hierarchy = document.getElementById("family_hierarchy");
    if (id !== '0')
    {
        $('#family_hierarchy').val(''); 
        var u = "../functions/action.php?cmd=11&id=" + id;
        //          prompt("u",u);
        var r = syncAjax(u);
        if(r.result === 1)
        {
            //           alert("this idsfsdfsdfs the id" + id)
            $('#family_hierarchy').show(); 
            hierarchy.innerHTML = '<br> TYPE : ' + r.type + '<br> Category : ' + r.category + '<br> Sub-Cat :' + r.subcategory + '<br><br>';
            //            hierarchy.innerHTML = '<ul><li>Type</li><li><ul>' + r.type + '</ul></li></ul>';
            //            $('#family_hierarchy').val("" + r.subcategory);  
        }
    } else
    {
        hierarchy.innerHTML = '';
        $('#family_hierarchy').hide(); 
        //        $('#family_other').prop('disabled', true);
        //        $('#family_hierarchy').val(''); 
        //       
      
        //        $('#family_other').prop('disabled', false);
        //        $('#family_other').val('');
    } 
}


//function change_select_brand(val)
//{
//    if (val !== '0')
//    {
//        $('#brand_other').prop('disabled', true);
//        $('#brand_other').val('');
//    }
//    else
//    {
//        $('#brand_other').prop('disabled', false);
//        $('#brand_other').val('');
//    }
//}


//function show_manufacturer()
//{
//    
//}

function showModal(barcode,shop_id)
{
    //        alert('dsfdfdfdfsdfsd');
    //  $("#no").hide();
    $("#myModal").modal();
    $("#yes").hide();
    $("#no").hide(); 

    var u = "../functions/action.php?cmd=12&barcode=" + barcode + "&shop_id=" + shop_id;
//        
//         prompt("this is to test",u); 
    var r = syncAjax(u);
    if(r.result === 1)
    {
        //                alert("the result is 1"); 
        document.getElementById("family_id").innerHTML = r.family; 
        $("#description").html(r.item_description);   
        $("#comment").html(r.comment);   
        $("#unit_value").val(r.unit);  
//         $("#family").val(r.r.family); 
//        alert("ythis is the family value " + r.family_value); 
        //        $("#family").select();  
//        
//        $('.selectpicker').selectpicker('val', r.family);
        
//        $('.selectpicker').selectpicker({
//           title:  'this is the value' 
////        });  
        $("#family option").each(function() {
            if($(this).text() === r.family_value) {
                $(this).attr('selected', 'selected');            
            }                         
        });   
//        
         $("#brand option").each(function() {
            if($(this).text() === r.brand_value) {
                $(this).attr('selected', 'selected');            
            }                         
        });  
//        $("#brand").val(r.brand);
if(r.offer_value !== 'null')
{
     $("#offer_value").show();
     $("#radio_yes").prop("checked", true); 
     $("#offer_value").val(r.offer_value);
      
}
else if (r.offer_value === 'null')
{
//    alert("the offer is null") 
    $("#offer_value").val(' ');  
}
//else if(r.offer_value ==='')
//{
//     $("#radio_no").prop("checked", true);
//}
//        $("#offer_value").val(r.offer_value);
        $("#quality").val(r.quality_id);
        $("#unit").val(r.unit_id);
        $("#packaging").val(r.packaging); 

            
        //            setSelectedIndex(document.getElementById("family"),r.family);  
            
//                     $("#family").val(r.family_id);   
        //             $("#unit").val(r.unit); 
        //             $("#selectBox").val(3);
           
    }
    
    //        if(shop_id === 0)
    //        {
    //            
    //        }    
    
} 

// function change_control()
// {
//     
//     var fam  = document.getElementById('family');
////     $("#family").addClass('selectpicker');  
//    fam.classList.add('selectpicker');    
////      alert("this is adding the c;lass");
// }    


function change_select_m(val)
{
    if (val !== '0')
    {
        $("#add_manufacturer").hide();
       
        $('#brand_add').prop('disabled', false); 
        $('#brand_other').prop('disabled', false);
        $('#brand_other').val('');
    } else
    {
        $('#brand_add').prop('disabled', true); 
        $('#brand_other').prop('disabled', true);
        $('#brand_other').val('');
    }
}

function add_brand()
{
    var man = document.getElementById('manufacturer');
    var value_man = man.options[man.selectedIndex].value;
    //    alert("this is the selecte dmanufacturer :" + value_man);
    var brand = document.getElementById('brand_other').value;
    //    alert("this is the selecte dmanufacturer :" + value_man + "this is the brand :" + brand);
    var u = "../functions/action.php?cmd=8&brand=" + brand + "&man_id=" + value_man;
    //    prompt("u", u);
    var r = syncAjax(u);

    if (r.result === 1)
    {
        var b = document.getElementById('brand');

        var opt = document.createElement('option'); 
        opt.innerHTML = r.brand;
        opt.value = r.insert_id;
        $(b.append(opt));
        //        $('#collapseExample').toggle();  
        $("#save_changes").show();   
        y = 0;  
        
    }

}

function change_select_manufacturer()
{
    $('#brand_add').prop('disabled', true); 
    $('#brand_other').prop('disabled', true);
    $('#brand_other').val('');
    $("#add_manufacturer").show();
    $("#manufacturer option").each(function() {
            if($(this).text() === "No manufacturer selected") {
                $(this).attr('selected', 'selected');            
            }                         
        });  
//    $('#manufacturer').val('0').prop('selected', true);

    //    alert(val);
    //        if (val !== '0') 
    //        {
    //            $('#brand_other').prop('disabled', false);
    //            $('#brand_other').val('');
    //            $("#add_manufacturer").hide();
    //        }
    //    else
    //    { 

    //    }
}

function refresh()
{
    document.location.href = "tables.php";  
}
var y = 0;
function hideButton()
{
    if(y === 0)
    {  
//        alert("SCROLLING");
        $("#myModal").scrollTop(5000);
        //         alert("SCROLLINawsdeasdadasdG");
        //        window.scrollBy(0,1500);   
        $("#save_changes").hide();
        y = 1;
      
    }
  
    else if (y === 1) 
    {
        $("#save_changes").show();
        y = 0;
    }
}

function add_manufacturer()
{
    //    alert("added");
    $("#add_manufacturer").hide();
    var man = document.getElementById('manufacturer_other').value;
    //    alert("this is  the added manufacture"  + man);
    var u = "../functions/action.php?cmd=6&manufacturer=" + man;
    //            prompt("u", u);
    var r = syncAjax(u);
    if (r.result === 1)
    {
        var m = document.getElementById('manufacturer');
        $("#add_manufacturer").val('');
        var opt = document.createElement('option');
        opt.innerHTML = r.manufacturer;
        opt.value = r.insert_id;
        $(m.append(opt));  
    }
}

function offerValue(offer_radio)
{
    if(offer_radio === 1)
    {
        $("#offer_value").show();
    }
    else if(offer_radio === 2)
    {
        $("#offer_value").hide();
    }
}

function jsfunction()
{
    alert("lets hope this workds");
}

function saveDetail(barcode) 
{
    //    alert("saving");
    var regex = '^[0-9]*(\.[0-9]{1,2})?$';
    var b = barcode; 
    var shop_id = 0;
    if(x===1) 
    {
        shop_id  = document.getElementById('myModalShop').innerHTML;  
        var t =  "../functions/action.php?cmd=10&barcode=" + b + "&decision=" + 2 ;  
        var a = syncAjax(t);
        
        //        alert("modal"); 
        //        alert("modal" + shop_id);  
    }
    else
    {
        //        alert("this is value of x" + x);
        var t =  "../functions/action.php?cmd=10&barcode=" + b + "&decision=" + 1 ;  
        var a = syncAjax(t);
    }
    var packaging = document.getElementById("packaging").value;
    var p = true;
    var u;
    var item = document.getElementById("item_type");
    var item_type = item.options[item.selectedIndex].value;
   
    
    //    alert(item_type + "this is thy type");
    if(item_type === "1")
    {  
        //        alert(b);
        u = "../functions/action.php?cmd=9&barcode=" + b + "&shop_id=" + shop_id;
        //                 prompt("tis sithe non food item save",u);
    }
    else if (item_type === "0")
    {
        //        alert("no");
   
        if(packaging !== '')
        {
            if(packaging.toString().match(regex)) 
            {
                p = true;  
            }
            else
            {
                p = false;
                alert("Please enter the right format for  'PACKAGING'");
            }
        }
        if(p)
        {
            //            alert("p wprds");
            var offer = 0;
            var offer_value= '';
                   
            var quality = document.getElementById("quality");
            var quality_id = quality.options[quality.selectedIndex].value;
            var status;
            var item_des = document.getElementById('description').value;
            var brand = document.getElementById('brand');
            var brand_id = brand.options[brand.selectedIndex].value;
            //    alert(item_des + "item_description");
            var family = document.getElementById('family');
            var family_id = family.options[family.selectedIndex].value;
//            var family_id = document.getElementById("family_id").innerHTML;
            var comment = document.getElementById('comment').value;
            var unit_v = document.getElementById('unit_value').value;
            var unit = document.getElementById('unit');
            var unit_id = unit.options[unit.selectedIndex].value;
   
            u = "../functions/action.php?cmd=4&packaging="+ packaging+"&des=" + item_des + "&quality=" + quality_id + "&shop_id="+shop_id + "&comment=" + comment + "&brand=" + brand_id + "&family=" + family_id + "&unit_v=" + unit_v + "&unit_id=" + unit_id + "&barcode=" + barcode;
        
            if (document.getElementById('radio_ok').checked) 
            {
                status = 1;

            } else if (document.getElementById('radio_not_clear').checked)
            {
                status = 2; 
            }
             
            if (document.getElementById('radio_yes').checked) 
            {
                offer_value = document.getElementById("offer_value").value; 
                offer = 1;
//                alert("the offer is yes and this is the value " + offer_value);
                

            } else if (document.getElementById('radio_no').checked)
            {
                offer = 2; 
                //                alert("the offer is no");
            }
            
           

            u = u + "&status=" + status + "&offer=" + offer + "&offer_value=" + offer_value; 
        }
    } 
//        prompt("u",u);    
    var r = syncAjax(u); 
 
    if (r.result === 1)  
    {
        //        alert("this is x " + x);  
        if(x === 0)
        {
            //            alert("this is x");
            document.location.href = "tables.php"; 
        }
        else if(x === 1)
        {
            //            alert("this is y");
            document.location.href = location.href; 
        }
        
    } 
} 
//   
//

//    }
////  prompt("u", u);

 



//function details()
//{
//
////    family
//    var u = "../functions/action.php?cmd=2";
////var u = "http://212.71.238.208/Barcode_Verification/functions/action.php?cmd=2"; 
//
//    var r = syncAjax(u);
//    var f = document.getElementById('family');
//
//    for (var i = 0; i < r.length; i++) {
//        var opt = document.createElement('option');
//        opt.value = " " + r[i].family_id; 
//        opt.innerHTML = r[i].family;
//          
////        opt.value = r[i].family_id;
//        $(f.append(opt));  
//    }
//    
////    brand
//    var u1 = "../functions/action.php?cmd=3";
////    var u1 = "http://212.71.238.208/Barcode_Verification/functions/action.php?cmd=3";
//
//    var r1 = syncAjax(u1);
//    var b = document.getElementById('brand');
//
//    for (var i = 0; i < r1.length; i++) {
//        var opt1 = document.createElement('option');
//        opt1.innerHTML = r1[i].brand;
//        opt1.value = r1[i].brand;
//        $(b.append(opt1));
//    }
//
//
//
//
////}
//}  


