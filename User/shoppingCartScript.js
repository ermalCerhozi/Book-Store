    $(document).ready(function () {

        $(document).on("click", ".delete", function (e) {
            debugger;
            e.preventDefault();
            var siblings = $(this).children("i")
            var id = siblings.attr("data-id");
            console.log(id);
            var data = {
                id: id,
            };
            $.ajax({
                type: "GET",
                url: "deleteFromShoppingCart.php",
                data: data,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (response) {
                    debugger;
                    console.log(response.Message);
                    console.log(response.Return);
                    if (response.Return) {
                        swal({
                            title: "Shoppin Cart Delete",
                            text: response.Message,
                            icon: "success",
                        });
                    } else {
                        swal({
                            title: "Shoppin Cart Delete",
                            text: response.Message,
                            icon: "error",
                        });
                    }
                    window.location.reload();
                }
            });

        });
        $("#continue-shopping").click(function (e) {
            e.preventDefault();
            window.location.href = "../User/books.php";

        });
        $("#finish-payment").click(function (e) {
            // alert("test");
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "finishPayment.php",
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (response) {
                    debugger;
                    console.log(response.Message);
                    console.log(response.Return);
                    if (response.Return) {
                        swal({
                            title: "Shoppin Cart Payment",
                            text: response.Message,
                            icon: "success",
                        });
                    } else {
                        swal({
                            title: "Shoppin Cart Payment",
                            text: response.Message,
                            icon: "error",
                        });
                    }
                    window.location.reload();
                }
            });
        });

    })