$("*[data-toggle='area']").click(function() 
{
    var target = $(this).data("target");
    var btn = this;

    if ($(target).hasClass("active"))
    {
        console.log("has active");
        // Ist momentan noch aktiv
        animate(target, "fadeOut", function()
        {
            $(btn).toggleClass("active");
            $(target).toggleClass("active");
        });
        // $(target).on("animationFinished", );
    }
    else
    {
        console.log("has not active");
        // Ist noch nicht aktiv, wird jetzt aktiviert
        $(btn).toggleClass("active");
        $(target).toggleClass("active");
        animate(target, "fadeIn");
    }
});