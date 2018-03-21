function refreshTranslations()
{
    $.ajax(
        {
            url: R + "Translation/GetTranslations",
            dataType: "json",
            type: "GET",
            success: function (translationData)
            {
                translationData.reverse();

                $("#translations-row").empty();
                $.each(translationData, function(k, v)
                {
                    var transEl = $("#tpl-translation").clone();
                    $(transEl).find(".translation").attr("data-id", v.Id);
                    $(transEl).find(".translation-keyword .form-control").attr("value", v.Keyword);
                    $(transEl).find(".translation-english .form-control").text(v.English);
                    $(transEl).find(".translation-german .form-control").text(v.German);

                    $("#translations-row").append($(transEl).html());
                });

                $(document).trigger("gotTranslations");
            },
            error: function (response)
            {
                HandleError(response);
            }
        }
    );    
}

$(document).ready(function()
{
    refreshTranslations();
});

$(document).on("gotTranslations", function()
{
    $(".translation-input").change(function()
    {
        $.ajax(
            {
                url: R + "Translation/UpdateTranslation",
                type: "POST",
                data: 
                {
                    translationId: $(this).closest(".translation").data("id"),
                    colName: $(this).data("col-name"),
                    colValue: $(this).val()
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

    $(".translation-delete-btn").click(function()
    {
        $.ajax(
            {
                url: R + "Translation/DeleteTranslation",
                type: "POST",
                dataType: "json",
                data: 
                {
                    translationId: $(this).closest(".translation").data("id"),
                },
                success: function(response)
                {
                    console.log(response);
                    refreshTranslations();
                },
                error: function(response)
                {
                    HandleError(response);
                }
            }
        );
    });
});

$("#translation-add").click(function()
{
    $.ajax(
        {
            url: R + "Translation/AddTranslation",
            type: "GET",
            dataType: "json",
            success: function(response)
            {
                console.log(response);
                refreshTranslations();
            },
            error: function(response)
            {
                HandleError(response);
            }
        }
    );
});

$.ajax(
    {
        url: R + "Account/GetAccounts",
        type: "GET",
        dataType: "json",
        success: function(accounts)
        {
            $("#accounts-table tbody").empty();

            for (var i = 0; i < accounts.length; i++)
            {
                $("#accounts-table tbody").append(
                    '<tr><td>' + accounts[i].Id + '</td><td>' + accounts[i].Email + '</td><td>' + accounts[i].Role + '</td></tr>'
                );
            }
        },
        error: function(response)
        {
            HandleError(response);
        }
    }
);