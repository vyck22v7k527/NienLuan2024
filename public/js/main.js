function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data("url");
    let that = $(this);
    Swal.fire({
        title: "Bạn có chắc muốn xóa?",
        text: "",
        icon: "Cảnh báo",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Vâng!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "Get",
                url: urlRequest,
                success: function (data) {
                    if (data.code == 200) {
                        that.parent().parent().remove();
                        Swal.fire(
                            "Đã xóa!",
                            "Dữ liệu đã được xóa.",
                            "Thành công"
                        );
                    }
                },
                error: function (data) {
                    if (data.responseJSON.code == 500) {
                        Swal.fire(
                            "Thông báo",
                            `${data.responseJSON.message}`,
                            ""
                        );
                    }
                },
            });
        }
    });
}

function actionCancel(event) {
    event.preventDefault();
    let urlRequest = $(this).data("url");
    let that = $(this);
    Swal.fire({
        title: "Lý do hủy đơn hàng",
        input: "text",
        inputAttributes: {
            autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Cập nhật",
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            $.ajax({
                type: "Get",
                url: urlRequest,
                data: {
                    note: result.value
                },
                success: function (data) {
                    location.reload();
                    if (data.code == 200) {
                        Swal.fire(
                            "Cập Nhật đơn hàng",
                            data.message,
                            "Thành công"
                        );
                    }
                },
                error: function (data) {
                    if (data.responseJSON.code == 500) {
                        Swal.fire(
                            "Thông báo",
                            `${data.responseJSON.message}`,
                            ""
                        );
                    }
                },
            });
        }
    });
}

function createOrder(event ) {
    event.preventDefault();
    let urlRequest = $(this).data("url");
    let that = $(this);
    $.ajax({
        type: "POST",
        url: urlRequest,
        data: {
            note: result.value
        },
        success: function (data) {
            location.reload();
            if (data.code == 200) {
                Swal.fire(
                    "Cập Nhật đơn hàng",
                    data.message,
                    "Thành công"
                );
            }
        },
        error: function (data) {
            if (data.responseJSON.code == 500) {
                Swal.fire(
                    "Thông báo",
                    `${data.responseJSON.message}`,
                    ""
                );
            }
        },
    });
}

$(function () {
    $(document).on("click", ".action_delete", actionDelete);
    $(document).on("click", ".action_cancel", actionCancel);
    $(document).on("click", ".create_order", createOrder);
});
