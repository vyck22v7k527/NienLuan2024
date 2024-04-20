$(".btn-submit").click(function () {
    var paramObject = $(this).data("param");

    // Use .val() directly to set the values
    $("#form-control-id").val(paramObject.id);
    $("#form-control-name").val(paramObject.name);
    $("#huy-cap-nhat").css({
        "display": "block",
        "float": "right"
    });
});

// huy-cap-nhat
$("#huy-cap-nhat").click(function () {
    $("#form-control-id, #form-control-name").val("");
    $("#huy-cap-nhat").css("display", "none");
});
