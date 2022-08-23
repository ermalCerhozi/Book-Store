var check = true;

function makeInvalid(element) {
    debugger;
    element.removeClass("is-valid");
    element.addClass("is-invalid");
    check = false;
}

function makeValid(element) {
    debugger;
    element.removeClass("is-invalid");
    element.addClass("is-valid");
}

function checkIfEmpty(element, errorSpan) {
    debugger;
    var value = element.val().trim();
    if (value != "") {
        errorSpan.hide();
        return true;
    } else {
        makeInvalid(element);
        errorSpan.html("Fusha eshte bosh");
        errorSpan.show();
        return false;
    }
}

function checkString(element, errorSpan) {
    debugger;
    var value = element.val().trim();
    if (checkIfEmpty(element, errorSpan)) {
        var Regex = new RegExp(/^[a-zA-Z]{3,20}$/);
        console.log(Regex.test(value));
        // console.log(Regex.test(element));
        if (Regex.test(value)) {
            errorSpan.hide();
            element.removeClass("is-invalid");
            element.addClass("is-valid");
            return true;
        } else {
            if (value.length < 3) {
                errorSpan.html("Emri juaj duhet te kete te pakten 3 karaktere");
                errorSpan.show();
                makeInvalid(element);
            } else if (value.length > 30) {
                errorSpan.html("Emri juaj duhet te kete te shumten 30 karaktere");
                errorSpan.show();
                makeInvalid(element);
            } else {
                errorSpan.html("Emri juaj duhet te permbaje vetem karakteree ");
                errorSpan.show();
                makeInvalid(element);
            }
            // errorSpan.html("Pranohen vetem karatere");
            // errorSpan.show();
            // element.removeClass("is-valid");
            // element.addClass("is-invalid");
            return false;
        }
    } else
        return false;
}

function checkEmail(element, errorSpan) {
    debugger;
    if (checkIfEmpty(element, errorSpan)) {
        var value = element.val().trim();
        var regex = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
        if (!regex.test(value)) {
            errorSpan.html("Email nuk eshte i formatit te kerkuar");
            errorSpan.show();
            makeInvalid(element);
            return false;
        }
        errorSpan.hide();
        makeValid(element);
        return true;
    } else {
        return false;
    }
}

function validateDate(element, errorSpan) {
    debugger;
    var data = element.val().trim().split("-");
    var month = parseInt(data[1]);
    var day = parseInt(data[2]);
    var year = parseInt(data[0]);

    if (isNaN(day) || isNaN(month) || isNaN(year)) {
        errorSpan.html("Data nuk eshte e formaitt te sakte");
        errorSpan.show();
        makeInvalid(element);
        return false;
    } else {
        var date = new Date().getFullYear();
        if (year < date - 18 && year > date - 100) {
            errorSpan.hide();
            makeValid(element);
            return true;
        } else {
            errorSpan.html("Jeni i vogel per te perodur programin");
            errorSpan.show();
            makeInvalid(element);
            return true;
        }
    }
}

function checkPostalCode(element, errorSpan) {
    debugger;
    var regex = new RegExp(/^[0-9]{4}$/);
    var value = element.val().trim();
    if (!regex.test(value)) {
        errorSpan.html("kodi postar nuk eshte i formes se kerkuar");
        errorSpan.show();
        makeInvalid(element);
        return false;
    }
    makeValid(element);
    errorSpan.hide();
    return true;
}

function checkStreet(element, errorSpan) {
    debugger;
    var regex = new RegExp(/^[a-zA-Z]+.\s*[a-zA-Z]*$/);
    var value = element.val().trim();
    if (!regex.test(value)) {
        errorSpan.html("Rruga nuk eshte e formatit te kerkuar");
        errorSpan.show();
        makeInvalid(element);
        return false;
    }
    makeValid(element);
    errorSpan.hide();
    return true;
}

function checkIfOptionSelected(element, errorSpan) {
    debugger;
    console.log(element.val());
    if (element.val()) {
        return true;
    } else
        return false;
};
$(document).on("keyup", "#Name",function () {
    debugger;
    return checkString($("#Name"), $("#Name").siblings("span")) == true ? true : false;
});
$(document).on("keyup","#Surname", function () {
    debugger;
    return checkString($("#Surname"), $("#Surname").siblings("span")) == true ? true : false; 
});
$(document).on("keyup","#Email", function () {
    debugger;
    var value = $("#Email").val().trim();
    var span = $("#Email").siblings("span");
    return checkEmail($("#Email"), $("#Email").siblings("span"));
});
$(document).on("keyup","#Birthday", function () {
    debugger;
    return validateDate($("#Birthday"), $("#Birthday").siblings("span"));
});
$(document).on("keyup","#Street", function () {
    debugger;
    return checkStreet($("#Street"), $("#Street").siblings("span"));
});
$(document).on("keyup","#PostalCode", function () {
    debugger;
    return checkPostalCode($("#PostalCode"), $("#PostalCode").siblings("span"));
});
// $("#Name").keyup(function () {
//     debugger;
//     return checkString($("#Name"), $("#Name").siblings("span")) == true ? true : false;
// });
// $("#Surname").keyup(function () {
//     debugger;
//     return checkString($("#Surname"), $("#Surname").siblings("span")) == true ? true : false;
// });
// $("#Email").keyup(function () {
//     debugger;
//     var value = $("#Email").val().trim();
//     var span = $("#Email").siblings("span");
//     return checkEmail($("#Email"), $("#Email").siblings("span"));
// });

// $("#Birthday").keyup(function () {
//     debugger;
//     return validateDate($("#Birthday"), $("#Birthday").siblings("span"));
// });
// $("#Street").keyup(function () {
//     debugger;
//     return checkStreet($("#Street"), $("#Street").siblings("span"));
// });
// $("#PostalCode").keyup(function () {
//     debugger;
//     return checkPostalCode($("#PostalCode"), $("#PostalCode").siblings("span"));
// });


$(document).ready(function () {
    // $("#Name").keyup(function () {
    //     debugger;
    //     return checkString($("#Name"), $("#Name").siblings("span")) == true ? true : false;
    // });
    // $("#Surname").keyup(function () {
    //     debugger;
    //     return checkString($("#Surname"), $("#Surname").siblings("span")) == true ? true : false;
    // });
    // $("#Email").keyup(function () {
    //     debugger;
    //     var value = $("#Email").val().trim();
    //     var span = $("#Email").siblings("span");
    //     return checkEmail($("#Email"), $("#Email").siblings("span"));
    // });

    // $("#Birthday").keyup(function () {
    //     debugger;
    //     return validateDate($("#Birthday"), $("#Birthday").siblings("span"));
    // });
    // $("#Street").keyup(function () {
    //     debugger;
    //     return checkStreet($("#Street"), $("#Street").siblings("span"));
    // });
    // $("#PostalCode").keyup(function () {
    //     debugger;
    //     return checkPostalCode($("#PostalCode"), $("#PostalCode").siblings("span"));
    // });


    $("#Search").on("keyup", function () {
        debugger;
        var search = $("#Search").val();
        var searchCategory = $("#SearchCategory :selected").text();
        //var data = {
        //    Search = search,
        //    SearchCaegory = searchCategory
        //}     
        var data = $("#search-form").serializeArray();
        console.log(data);
        var tmp = data.find(function (input) {
            return input.name == 'SearchCategory';
        }).value = searchCategory;
        tmp = searchCategory;
        console.log(data);
        $.ajax({
            type: "GET",
            /*contentType: "application/json; charset=utf-8",*/
            url: "bokIndex.php",
            data: data,
            contentType: "application/json; charset=utf-8",
            success: function (content) {
                debugger;
                console.log("brenda success");
                $("#display-div").html(content);
            }
        });
        // const htpp = new XMLHttpRequest();
        // htpp.onload = function() {
        //     if (htpp.status == 200 && htpp.readyState == 4) {
                
        //     }
        //     console.log("Brenda");
        // }
    });
    $("#payments-button").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "myPayments.php",
            success: function (response) {
                $(".list-group li").removeClass("active");
                $("#payments-button").addClass("active");
                $(".content-div").html(response);
            }
        });

    });
    $("#profile-button").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "myProfile.php",
            success: function (response) {
                $(".list-group li").removeClass("active");
                $("#profile-button").addClass("active");
                $(".content-div").html(response);
            }
        });
    });
    $("#edit-profile-button").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "editProfileIndex.php",
            success: function (response) {
                $(".list-group li").removeClass("active");
                $("#edit-profile-button").addClass("active");
                $(".content-div").html(response);
            }
        });
    });
    $(".prove").click(function (e) {
        debugger;
        $("#myModal").modal("show");
        var bookFile = $(this).attr("data-file");
        var path = "../book_file/" + bookFile
        $("#_Iframe").attr("src", path);
        console.log($("#_Iframe").attr("src"));
    });
});

$(document).on("click", "#EditSubmitButton", function (e) {
    debugger;
    e.preventDefault();
    var button = $(this);
    button.prop("disabled", true);

    check = true;
    debugger;
    if (!($("#Name").keyup())) {
        alert("emri false");
        check = false;
    }

    if (!($("#Surname").keyup())) {
        alert("mbiemri false");
        check = false;
    }

    if (!($("#Email").keyup())) {
        alert("email false");
        check = false;
    }

    if (!($("#City").keyup())) {
        alert("city false");
        check = false;
    }
    if (!($("#Street").keyup())) {
        alert("street false");
        check = false;
    }
    if (!($("#PostalCode").keyup())) {
        alert("psotal code false");
        check = false;
    }
    if (!checkIfOptionSelected($("#City"), $("#City").siblings("span"))) {
        alert("city false");
        check = false;
    }
    // if (!checkIfOptionSelected($("#role_e :selected"), $("#role_e").siblings("span"))) {
    //     alert("role false");
    //     check = false;
    // }
    //debugger;
    // var form = $("#update_form")[0];
    // var formdata = new FormData(form);
    var formdata = $("#editForm").serialize();
    console.log(formdata);
    if (check) {
        $.ajax({
            type: "POST",
            url: "editProfile.php",
            data: formdata, //$("#user_form").serialize(),
            // processData: false,
            // contentType: false,
            success: function (response) {
                debugger;
                var rez = JSON.parse(response);
                if (rez.Return) {
                    swal({
                        title: "User Edit",
                        text: rez.Message,
                        icon: "success",
                    });
                    //$('body').removeClass('modal-open');
                    // $('.modal-backdrop').remove();
                    // $('#addBookModal').modal('hide');
                    // $("#modal .close").click();
                    // $('.modal').removeClass('show');
                    // $('.modal').removeClass('show');
                    window.location.reload();
                } else {
                    swal({
                        title: "User Edit",
                        text: rez.Message,
                        icon: "error",
                    });
                    button.prop("disabled", false);
                }

                //$("#index-table").html(data);
            }
        });
    } else {
        button.prop("disabled", false);
        swal({
            title: "Edit Profile",
            text: "Ka errore ne forme",
            icon: "error",
        });

    }
});
$(document).on("click", ".add", function (e) {
    // alert("test");
    debugger;
    e.preventDefault();
    var siblings = $(this).children("i")
    var isbn = siblings.attr("data-ISBN");
    var price = siblings.attr("data-price");
    console.log(isbn);
    var data = {
        isbn: isbn,
        price: price
    };
    $.ajax({
        type: "GET",
        url: "bookAddToShoppingCart.php",
        data: data,
        contentType: "application/json; charset=utf-8",
        success: function (response) {
            debugger;
            var rez = JSON.parse(response);

            console.log(response.Message);
            console.log(response.Return);
            if (rez.Return) {
                swal({
                    title: "Shoppin Cart Add",
                    text: rez.Message,
                    icon: "success",
                });
            } else {
                swal({
                    title: "Shoppin Cart Add",
                    text: rez.Message,
                    icon: "error",
                });
            }
            // window.location.reload();
        }
    });

});
$(document).on("click", ".details", function (e) {
    // alert("test");
    debugger;
    e.preventDefault();
    var siblings = $(this).children("i")
    var isbn = siblings.attr("data-ISBN");
    console.log(isbn);
    var data = {
        isbn: isbn,
    };
    window.location.href = "bookShowDetails.php?" + "isbn=" + isbn;
    // $.ajax({
    //     type: "GET",
    //     url: "bookShowDetails.php",
    //     data: data,
    //     contentType: "application/json; charset=utf-8",
    //     success: function (response) {
    //         debugger;
    //         var rez = JSON.parse(response);

    //         console.log(rez.Message);
    //         console.log(rez.Return);
    //         if (rez.Return) {
    //             swal({
    //                 title: "Shoppin Cart Add",
    //                 text: rez.Message,
    //                 icon: "success",
    //               });
    //         }
    //         else{
    //             swal({
    //                 title: "Shoppin Cart Add",
    //                 text: rez.Message,
    //                 icon: "error",
    //               });
    //         }
    //         window.location.reload();
    //     }
    // });

});

$(document).on("click", ".buySubscription", function (e) {
    // alert("test");
    debugger;
    e.preventDefault();
    var siblings = $(this).children("i")
    var isbn = siblings.attr("data-id");
    var price = siblings.attr("data-price");
    var type = siblings.attr("data-subscription-type");
    var sale = siblings.attr("data-sale");
    console.log(isbn);
    var data = {
        id: isbn,
        price: price,
        type: type,
        sale: sale
    };
    $.ajax({
        type: "GET",
        url: "buySubscriptions.php",
        data: data,
        contentType: "application/json; charset=utf-8",
        success: function (response) {
            debugger;
            var rez = JSON.parse(response);
            console.log(rez.Message);
            console.log(rez.Return);
            if (rez.Return) {
                swal({
                    title: "Shoppin Cart Add",
                    text: rez.Message,
                    icon: "success",
                });
            } else {
                swal({
                    title: "Shoppin Cart Add",
                    text: rez.Message,
                    icon: "error",
                });
            }
            // window.location.reload();
        }
    });

});
// $(document).on("click", "#edit-profile-button", function (e) {
//     debugger;
//     console.log("brenda");
//     var name = $(this).attr("data-name");
//     var surname = $(this).attr("data-surname");
//     var email = $(this).attr("data-email");
//     var birthday = $(this).attr("data-birthday");
//     var cityName = $(this).attr("data-cityName");
//     var streetName = $(this).attr("data-streetName");
//     var postalCode = $(this).attr("data-postalCode");
//     $("#name_e").val(name);
//     $("#surname_e").val(surname);
//     $("#email_e").val(email);
//     $("#birthday_e").val(birthday);
//     $("#city_e").val(cityName);
//     $("#postalCode_e").val(postalCode);
//     // $("#book_cover_e").val("~/book_cover"+book_cover);
//     // $("#book_file_e").val("~/book_file"+book_file);
//     $("#streetName_e").val(streetName);
// });