// @koala-prepend "../../node_modules/bootstrap/node_modules/jquery/dist/jquery.js"
// @koala-prepend "../../node_modules/bootstrap/node_modules/tether/dist/js/tether.js"
// @koala-prepend "../../node_modules/bootstrap/dist/js/bootstrap.js"
// @koala-prepend "_helpers.js"
// @koala-prepend "_animate.js"
// @koala-prepend "_sign-area.js"

var R = $("html").data("root-url");

function HandleError(errorResponse)
{
    console.error("ERROR");
    console.error(errorResponse);
    $("main").prepend(
        "<div class='handled-alert alert alert-danger'>" + errorResponse.responseText + "</div>"
    );    
    afterHandledAlert();
}

function HandleSuccess(successText)
{
    $("main").prepend(
        "<div class='handled-alert alert alert-success'>" + successText + "</div>"
    );   
    afterHandledAlert()    
}

function afterHandledAlert()
{
    setTimeout(function()
    {
        $(".handled-alert").fadeOut();
    }, 3000);
}

$("#register-form").submit(function(e)
{
    e.preventDefault();

    $.ajax(
        {
            url: R + "Account/Register",
            type: "POST",
            data:
            {
                email: $("#register-email").val(),
                password: $("#register-password").val()
            },
            dataType: "json",
            success: function(response)
            {
                HandleSuccess(response);
            },
            error: function(response)
            {
                HandleError(response);
            }
        }
    );
});

$("#sign-in-form").submit(function(e)
{
    e.preventDefault();

    $.ajax(
        {
            url: R + "Account/SignIn",
            type: "POST",
            data:
            {
                email: $("#sign-in-email").val(),
                password: $("#sign-in-password").val()
            },
            dataType: "json",
            success: function(response)
            {
                // HandleSuccess(response);
                location.reload();
            },
            error: function(response)
            {
                HandleError(response);
            }
        }
    );
});