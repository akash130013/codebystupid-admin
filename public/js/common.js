$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function handleClick(titleMsg, textMsg, icon, id, type, status) {
    const apiUrl = $("#actionUrl").val();

    swal({
        title: titleMsg,
        text: textMsg,
        icon: icon,
        type: "warning",
        buttons: ["Cancel", "Yes!"],
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
    }).then((response) => {
        if (response) {
            $.ajax({
                type: "POST",
                url: apiUrl,
                data: {
                    id,
                    type,
                    status,
                },
                success: function (data) {
                    // swal(data.msg);
                    // location.reload();
                    swal({
                        title: "Good job!",
                        text: data.msg,
                        icon: "success",
                        button: "Aww yiss!",
                    }).then(() => {
                        location.reload();
                    });
                },
            });
        }
    });
}
