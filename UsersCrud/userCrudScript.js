var check = true;

function makeInvalid(element) {
    element.removeClass("is-valid");
    element.addClass("is-invalid");
    check = false;
}

function makeValid(element) {
    element.removeClass("is-invalid");
    element.addClass("is-valid");
}

function checkIfEmpty(element, errorSpan) {
    // debugger;
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
    // debugger;
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

function checkStrength(password, errorSpan) {
    // debugger;
    if (checkIfEmpty(password, errorSpan)) {
        var strength = 0;
        var value = password.val().trim();
        if (value.length < 6) {
            errorSpan.html("Gjatesia eshte me e vogel se 6");
            errorSpan.show();
            makeInvalid(password);
            return false;
        }
        if (value.length > 7) strength += 1
        // If password contains both lower and uppercase characters, increase strength value.  
        if (value.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
        // If it has numbers and characters, increase strength value.  
        if (value.match(/([a-zA-Z])/) && value.match(/([0-9])/)) strength += 1
        // If it has one special character, increase strength value.  
        if (value.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // If it has two special characters, increase strength value.  
        if (value.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // Calculated strength value, we can return messages  
        // If value is less than 2  
        if (strength < 2) {

            errorSpan.html("Passwrod i dobet");
            errorSpan.show();
            makeInvalid(password);
            return false;
        } else if (strength == 2) {
            errorSpan.html("Password i mire");
            errorSpan.show();
            makeValid(password);
            return true;
        } else {
            errorSpan.html("Passwod i forte");
            errorSpan.show();
            makeValid(password)
            return true;
        }
    } else
        return false;

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
    // debugger;
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
$(document).ready(function () {
    $("#Name").keyup(function () {
        // debugger;
        return checkString($("#Name"), $("#Name").siblings("span")) == true ? true : false;
    });
    $("#Surname").keyup(function () {
        // debugger;
        return checkString($("#Surname"), $("#Surname").siblings("span")) == true ? true : false;
    });
    $("#Email").keyup(function () {
        // debugger;
        var value = $("#Email").val().trim();
        var span = $("#Email").siblings("span");
        return checkEmail($("#Email"), $("#Email").siblings("span"));
    });
    $("#Password").keyup(function () {
        // debugger;
        return checkStrength($("#Password"), $("#Password").siblings("span"));
    });
    $("#ConfirmPassword").keyup(function () {
        //debugger;
        var value = $("#ConfirmPassword").val().trim();
        var span = $("#ConfirmPassword").siblings("span");
        var tmp = $("#Password");

        if (value != tmp.val().trim()) {
            span.show();
            span.html("Passwordi duhet te jete i njejte");
            makeInvalid($("#ConfirmPassword"));
            return false;
        } else {
            span.hide();
            makeValid($("#ConfirmPassword"));
            return true;
        }
    });
    $("#Birthday").keyup(function () {
        debugger;
        return validateDate($("#birthday"), $("#birthday").siblings("span"));
    });
    $("#Street").keyup(function () {
        // debugger;
        return checkStreet($("#street"), $("#street").siblings("span"));
    });
    $("#PostalCode").keyup(function () {
        // debugger;
        return checkPostalCode($("#postalCode"), $("#postalCode").siblings("span"));
    });
    $("#email_e").keyup(function () {
        // debugger;
        var value = $("#email_e").val().trim();
        var span = $("#email_e").siblings("span");
        return checkEmail($("#email_e"), $("#email_e").siblings("span"));
    });
    $("#name_e").keyup(function () {
        debugger;
        var check = checkString($("#name_e"), $("#name_e").siblings("span"))
        console.log("check  eshte: " + check);
        return check;
    });
    $("#surname_e").keyup(function () {
        debugger;
        return checkString($("#surname_e"), $("#surname_e").siblings("span")) == true ? true : false;
    });
    // $("#Password_e").keyup(function () {
    //     // debugger;
    //     return checkStrength($("#Password_e"), $("#Password_e").siblings("span"));
    // });
    // $("#ConfirmPassword_e").keyup(function () {
    //     //debugger;
    //     var value = $("#ConfirmPassword_e").val().trim();
    //     var span = $("#ConfirmPassword_e").siblings("span");
    //     var tmp = $("#Password_e");

    //     if (value != tmp.val().trim()) {
    //         span.show();
    //         span.html("Passwordi duhet te jete i njejte");
    //         makeInvalid($("#ConfirmPassword_e"));
    //         return false;
    //     } else {
    //         span.hide();
    //         makeValid($("#ConfirmPassword_e"));
    //         return true;
    //     }
    // });
    $("#birthday_e").keyup(function () {
        debugger;
        return validateDate($("#birthday_e"), $("#birthday_e").siblings("span"));
    });
    $("#streetName_e").keyup(function () {
        debugger;
        return checkStreet($("#streetName_e"), $("#streetName_e").siblings("span"));
    });
    $("#postalCode_e").keyup(function () {
        // debugger;
        return checkPostalCode($("#postalCode_e"), $("#postalCode_e").siblings("span"));
    });


    $("#btn-add").on("click", function (e) {
        debugger;
        e.preventDefault();
        var button = $(this);
        button.prop("disabled", true);
        // let name = $("#Name").val().trim();
        // // let prove = $("#Name").siblings("span").html("U ndryshua");
        // let surname = $("#Surname").val().trim();
        // let email = $("#Email").val().trim();
        let password = $("#Password").val().trim();
        let confirmPassword = $("#ConfirmPassword").val().trim();
        // let birthday = $("#Birthday").val().trim();
        // let city = $("#City").val().trim();
        // let street = $("#Street").val().trim();
        // let postalCode = $("#PostalCode").val().trim();
        check = true;

        if (!($("#Name").keyup())) {
            check = false;
        }

        if (!($("#Surname").keyup())) {
            check = false;
        }

        if (!($("#Email").keyup())) {
            check = false;
        }

        if (!$("#Password").keyup()) {
            check = false;
        }

        if (password !== confirmPassword) {
            $("#ConfirmPassword").siblings("span").css({
                "visibility": "visible"
            });
            $("#ConfirmPassword").siblings("span").val("Passwordi duhet te jete i njejte");
            check = false;
        }
        if (!($("#Birthday").keyup())) {
            check = false;
        }
        if (!($("#City").keyup())) {
            check = false;
        }
        if (!($("#Street").keyup())) {
            check = false;
        }
        if (!($("#PostalCode").keyup())) {
            check = false;
        }
        if (!checkIfOptionSelected($("#City"), $("#City").siblings("span"))) {
            check = false;
        }
        if (!checkIfOptionSelected($("#Role"), $("#Role").siblings("span"))) {
            check = false;
        }


        var data = $("#registraionForm").serialize();
        console.log(data);
        if (check) {
            console.log(data);
            $.ajax({
                url: "userAdd.php",
                type: "POST",
                data: data,
                success: function (response) {
                    debugger;
                    //alert(response);
                    var rez = JSON.parse(response);
                    console.log(response);
                    if (rez.Return == true) {

                        $('#addUserModal').modal('hide');
                        $('#cancel-button').click();
                        button.prop("disabled", false);

                        swal({
                            title: "User Add",
                            text: rez.Message,
                            icon: "success",
                        });
                        window.location.reload();
                    } else {
                        swal({
                            title: "User Add",
                            text: rez.Message,
                            icon: "error",
                        });
                        button.prop("disabled", false);
                    }
                }
            })
        } else {
            alert("Ka gabime ne forme");
            button.prop("disabled", false);
        }
    });
    $("#update").on("click", function (e) {
        // debugger;
        // e.preventDefault();
        var button = $(this);
        button.prop("disabled", true);

        check = true;
        debugger;
        if (($("#name_e").keyup()) == false) {
            alert("emri false");
            check = false;
        }

        if (!($("#surname_e").keyup())) {
            alert("mbiemri false");
            check = false;
        }

        if (!($("#email_e").keyup())) {
            alert("email false");
            check = false;
        }

        // if (!$("#Password_e").keyup()) {
        //     check = false;
        // }

        // if (password !== confirmPassword) {
        //     $("#ConfirmPassword_e").siblings("span").css({
        //         "visibility": "visible"
        //     });
        //     $("#ConfirmPassword_e").siblings("span").val("Passwordi duhet te jete i njejte");
        //     check = false;
        // }
        if (!($("#birthday_e").keyup())) {
            alert("birthday false");
            check = false;
        }
        if (!($("#city_e").keyup())) {
            alert("city false");
            check = false;
        }
        if (!($("#streetName_e").keyup())) {
            alert("street false");
            check = false;
        }
        if (!($("#postalCode_e").keyup())) {
            alert("psotal code false");
            check = false;
        }
        if (!checkIfOptionSelected($("#role_e"), $("#role_e").siblings("span"))) {
            alert("role false");
            check = false;
        }
        if (!checkIfOptionSelected($("#city_e"), $("#city_e").siblings("span"))) {
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
        var formdata = $("#update_form").serialize();
        console.log(formdata);
        if (check) {
            $.ajax({
                type: "POST",
                url: "userEdit.php",
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
                        $('#editUserModal').modal('hide');
                        //$('body').removeClass('modal-open');
                        // $('.modal-backdrop').remove();
                        // $('#addBookModal').modal('hide');
                        // $("#modal .close").click();
                        // $('.modal').removeClass('show');
                        // $('.modal').removeClass('show');
                        $('#cancel-button-e').click();
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
            swal("Forma ka errore");

        }
        //$('.modal-backdrop').removeClass('modal-backdrop');
        // $(window).on('hidden.bs.modal', function() { 
        //     swal("Forma u be keshtu");
        // });
        // // $('#editBookModal').on('show.bs.modal', function (e) {
        // //     swal("Forma u be keshtu");
        // //   })
    });
    $("#button-delete").on("click", function (e) {
        debugger;
        //e.preventDefault();
        var formdata = $("#delete-form").serialize();
        $.ajax({
            type: "POST",
            url: "UserDelete.php",
            data: formdata, //$("#user_form").serialize(),
            success: function (response) {
                debugger;
                var rez = JSON.parse(response);
                if (rez.Return) {
                    swal({
                        title: "User Edit",
                        text: rez.Message,
                        icon: "success",
                    });
                    $('#deleteUserModal').modal('hide');
                    //$('body').removeClass('modal-open');
                    // $('.modal-backdrop').remove();
                    // $('#addBookModal').modal('hide');
                    // $("#modal .close").click();
                    // $('.modal').removeClass('show');
                    // $('.modal').removeClass('show');
                    $('#cancel-button-d').click();
                    // var data = $("#index-table").html();
                    // console.log(data);
                    // $("#index-table").load("bookIndex.php");
                } else {
                    swal({
                        title: "User Edit",
                        text: rez.Message,
                        icon: "error",
                    });
                }
                window.location.reload();

                //$("#index-table").html(data);
            }
        });
        // $(window).on('hidden.bs.modal', function() { 
        //     swal("Forma u be keshtu");
        // });
        // // $('#editBookModal').on('show.bs.modal', function (e) {
        // //     swal("Forma u be keshtu");
        // //   })
    });
});
$(document).on("click", ".update", function (e) {
    debugger;
    e.preventDefault();
    var name = $(this).attr("data-name");
    var surname = $(this).attr("data-surname");
    var email = $(this).attr("data-email");
    var birthday = $(this).attr("data-birthday");
    var role = $(this).attr("data-role");
    var cityName = $(this).attr("data-cityName");
    var streetName = $(this).attr("data-streetName");
    var postalCode = $(this).attr("data-postalCode");
    $("#name_e").val(name);
    $("#surname_e").val(surname);
    $("#email_e").val(email);
    $("#birthday_e").val(birthday);
    $("#role_e").val(role);
    $("#city_e").val(cityName);
    $("#postalCode_e").val(postalCode);
    // $("#book_cover_e").val("~/book_cover"+book_cover);
    // $("#book_file_e").val("~/book_file"+book_file);
    $("#streetName_e").val(streetName);
});
$(document).on("click", ".delete", function (e) {
    debugger;
    e.preventDefault();
    var id = $(this).attr("data-id");
    var type = $(this).attr("data-type");
    $("#id_d").val(id);
    $("#type_d").val(type);
    if (type == "Activate") {
        $("#first-warning-message").text("Are you sure you want to activate this user?");
        $("#button-delete").attr('class', 'btn btn-success')
        $("#button-delete").text("Activate");
        $("#modal-title").text("Activate User");
    } else {
        $("#first-warning-message").text("Are you sure you want to delete this user?");
        $("#button-delete").attr('class', 'btn btn-danger');
        $("#button-delete").text("Delete");
        $("#modal-title").text("Delete User");
    }
});