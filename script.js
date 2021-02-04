$('.sub').click(function()
{
    var input = $(this).parent().find('input');
    var id = input.data('id');
    var count = parseInt(input.val()) - 1;
    var visibility = "";
    
    count = count < 0 ? 0 : count;
    if (count == 0) visibility = ", Product_visibility=FALSE";
    var query = "UPDATE Products SET Product_quantity="+ count + visibility + " WHERE Id=" + id;

    sendAjax(query);
    if (count == 0)
    {
        $( document ).ajaxStop(function() {
            window.location.reload();
        });
    }
    
    input.val(count);
    input.change();
    
    return false;
});

$('.add').click(function(el)
{
    var input = $(this).parent().find('input');
    var id = input.data('id');
    var newvalue = parseInt(input.val()) + 1;
    var query = "UPDATE Products SET Product_quantity="+ newvalue +" WHERE Id=" + id;

    input.val(newvalue);
    input.change();
    sendAjax(query);

    return false;
});

function hideProduct(el)
{
    var id = el.getAttribute("data-id");
    var query = 'UPDATE Products SET Product_visibility=FALSE WHERE Id='+id;
    
    sendAjax(query);
    $('.' + el.id).hide();
}
function sendAjax(query)
{
    $.ajax({
        url: '/UpdateTable.php',
        method: 'post',
        dataType: 'html',
        data: {querytext: query},
        success: function(data){
            //alert(data);
        }
    });
}