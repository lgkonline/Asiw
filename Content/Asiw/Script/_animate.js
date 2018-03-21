var AnimateDuration = 1000;

function animate(target, animationClass, onFinished)
{
    $(target).addClass("animated " + animationClass);
    setTimeout(function()
    {
        $(target).removeClass("animated " + animationClass);
        
        if (isSet(onFinished))
        {
            onFinished();
        }
    }, AnimateDuration);
}