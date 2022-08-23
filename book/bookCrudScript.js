var isbn;
var old_book_cover;
var old_book_file;
var check = true;

function makeInvalid(element) {
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

function checkBookTitle(element, errorSpan) {
    debugger;
    var value = element.val().trim();
    if (checkIfEmpty(element, errorSpan)) {
        var Regex = new RegExp(/^[a-zA-Z0-9\'\"-\.\,\- ]+$/);
        console.log(Regex.test(value));
        // console.log(Regex.test(element));
        if (Regex.test(value)) {
            errorSpan.hide();
            element.removeClass("is-invalid");
            element.addClass("is-valid");
            return true;
        } else if (value.length < 2) {
            errorSpan.html("Libri juaj duhet te kete te pakten 2 karaktere");
            errorSpan.show();
            makeInvalid(element);
        } else if (value.length > 100) {
            errorSpan.html("Emri juaj duhet te kete te shumten 100 karaktere");
            errorSpan.show();
            makeInvalid(element);
        } else {
            errorSpan.html("Emri mund te permbaje numra,germa,karaktere speciale si : \"\' ,-");
            errorSpan.show();
            makeInvalid(element);
            return false;
        }
        // errorSpan.html("Pranohen vetem karatere");
        // errorSpan.show();
        // element.removeClass("is-valid");
        // element.addClass("is-invalid");
        return false;

    } else
        return false;
}

function checkBookDescription(element, errorSpan) {
    // debugger;
    var value = element.val().trim();
    if (checkIfEmpty(element, errorSpan)) {
        var Regex = new RegExp(/^[0-9a-zA-Z ,.""''-]*$/);
        console.log(Regex.test(value));
        // console.log(Regex.test(element));
        if (Regex.test(value)) {
            errorSpan.hide();
            element.removeClass("is-invalid");
            element.addClass("is-valid");
            return true;
        } else if (value.length < 2) {
            errorSpan.html("Libri juaj duhet te kete te pakten 2 karaktere");
            errorSpan.show();
            makeInvalid(element);
        } else if (value.length > 300) {
            errorSpan.html("Description juaj duhet te kete te shumten 100 karaktere");
            errorSpan.show();
            makeInvalid(element);
        } else {
            errorSpan.html("Emri mund te permbaje numra,germa,karaktere speciale si : \"\' ,-");
            errorSpan.show();
            makeInvalid(element);
            return false;
        }
        // errorSpan.html("Pranohen vetem karatere");
        // errorSpan.show();
        // element.removeClass("is-valid");
        // element.addClass("is-invalid");
        return false;

    } else
        return false;
}

function checkISBN(element, errorSpan) {
    // debugger;
    var value = element.val().trim();
    if (checkIfEmpty(element, errorSpan)) {
        var Regex = new RegExp(/^[0-9]{13}$/);
        console.log(Regex.test(value));
        // console.log(Regex.test(element));
        if (Regex.test(value)) {
            errorSpan.hide();
            makeValid(element);
            return true;
        } else {
            errorSpan.html("ISBN nuk eshte sipas formatit prej 13 shifrash nga 0-9");
            errorSpan.show();
            makeInvalid(element);
        }
        // errorSpan.html("Pranohen vetem karatere");
        // errorSpan.show();
        // element.removeClass("is-valid");
        // element.addClass("is-invalid");
        return false;
    } else
        return false;
}

function checkYear(element, errorSpan) {
    debugger;
    var value = parseInt(element.val().trim());
    if (checkIfEmpty(element, errorSpan)) {
        if (element.val().trim().length != 4) {
            errorSpan.html("Viti duhet te kete 4 shifra");
            errorSpan.show();
            return false;
        } else if (!Number.isInteger(value)) {
            errorSpan.html("Viti duhet te jete numer i plote");
            errorSpan.show();
            makeInvalid(element);
            return false;
        } else if (value < 1900) {
            errorSpan.html("Viti eshte shume i hershem");
            errorSpan.show();
            makeInvalid(element);
            return false;
        } else if (value > new Date().getFullYear()) {
            errorSpan.html("Viti eshte jashte kufirit akoma ska ardhur");
            errorSpan.show();
            makeInvalid(element);
            return false;
        } else {
            errorSpan.hide();
            makeValid(element);
            return true;
        }
        //     var Regex = new RegExp(/^[0-9]{13}$/);
        //     console.log(Regex.test(value));
        //     // console.log(Regex.test(element));
        //     if (Regex.test(value)) {

        //     }
        // } else {
        //     errorSpan.html("ISBN nuk eshte sipas formatit prej 13 shifrash nga 0-9");
        //     errorSpan.show();
        //     makeInvalid(element);
        // }
        // // errorSpan.html("Pranohen vetem karatere");
        // // errorSpan.show();
        // // element.removeClass("is-valid");
        // // element.addClass("is-invalid");
        // return false;
    } else
        return false;
}

function checkPrice(element, errorSpan) {
    debugger;
    var value = parseInt(element.val().trim());
    if (checkIfEmpty(element, errorSpan)) {
        if (element.val().trim().length > 6) {
            errorSpan.html("Cmimi ka shume shifra. Kalin limitni");
            errorSpan.show();
            makeInvalid(element);
            return false;
        } else if (value <= 0) {
            errorSpan.html("Cmimi duhet te jete numer pozitiv");
            errorSpan.show();
            makeInvalid(element);
            return false;
        } else {
            errorSpan.hide();
            makeValid(element);
            return true;
        }
        //     var Regex = new RegExp(/^[0-9]{13}$/);
        //     console.log(Regex.test(value));
        //     // console.log(Regex.test(element));
        //     if (Regex.test(value)) {

        //     }
        // } else {
        //     errorSpan.html("ISBN nuk eshte sipas formatit prej 13 shifrash nga 0-9");
        //     errorSpan.show();
        //     makeInvalid(element);
        // }
        // // errorSpan.html("Pranohen vetem karatere");
        // // errorSpan.show();
        // // element.removeClass("is-valid");
        // // element.addClass("is-invalid");
        // return false;
    } else
        return false;
}

function checkIfOptionSelected(element, errorSpan) {
    debugger;
    if (element.val()) {
        errorSpan.hide();
        makeValid(element)
        return true;
    } else {
        errorSpan.html("Duhet te selektoni nje element");
        errorSpan.show();
        makeInvalid(element);
        return false;
    }
};

function checkIfFileSelected(element, errorSpan) {
    debugger;
    if (element.length != 0) {
        errorSpan.hide();
        element.removeClass("is-invalid");
        element.addClass("is-valid");
        return true;
    } else {
        errorSpan.html("Duhet te zgjidnin nje file");
        errorSpan.show();
        makeInvalid(element);
        return false;
    }
};

$(document).ready(function () {
    // $(".modal").on('shown.bs.modal', function () {
    //     //alert("I want this to appear after the modal has opened!");
    //     // $('.modal-backdrop').css('background','#0a0a0ad8');
    //     // $('.modal-backdrop').remove();
    //     $("#pageContent").css({ opacity: 0.5 });
    //     $('#addBookModal').find('.modal-backdrop').removeClass('modal-backdrop');
    //     $('#editBookModal').find('.modal-backdrop').removeClass('modal-backdrop');
    // });
    // $(".modal").on('hide.bs.modal', function () {
    //     //alert("I want this to appear after the modal has opened!");
    //     // $('.modal-backdrop').css('background','#0a0a0ad8');
    //     $('.modal-backdrop').remove();
    // });
    // $( "#editBookModal" ).on('shown.bs.modal', function(){
    //     //alert("I want this to appear after the modal has opened!");
    //     $('.modal-backdrop').removeClass('modal-backdrop');
    // });
    $("#id").keyup(function () {
        // debugger;
        return checkISBN($("#id"), $("#id").siblings("span")) == true ? true : false;
    });
    $("#title").keyup(function () {
        // debugger;
        return checkBookTitle($("#title"), $("#title").siblings("span")) == true ? true : false;
    });
    $("#price").keyup(function () {
        // debugger;
        var value = $("#price").val().trim();
        var span = $("#price").siblings("span");
        return checkPrice($("#price"), $("#price").siblings("span"));
    });
    $("#date").keyup(function () {
        // debugger;
        return checkYear($("#date"), $("#date").siblings("span"));
    });
    $("#description").keyup(function () {
        //debugger;
        return checkBookDescription($("#description"), $("#description").siblings("span"));
    });
    $("#id_e").keyup(function () {
        debugger;
        return checkISBN($("#id_e"), $("#id_e").siblings("span")) == true ? true : false;
    });
    $("#title_e").keyup(function () {
        // debugger;
        return checkBookTitle($("#title_e"), $("#title_e").siblings("span")) == true ? true : false;
    });
    $("#price_e").keyup(function () {
        // debugger;
        var value = $("#price").val().trim();
        var span = $("#price").siblings("span");
        return checkPrice($("#price_e"), $("#price_e").siblings("span"));
    });
    $("#date_e").keyup(function () {
        // debugger;
        return checkYear($("#date_e"), $("#date_e").siblings("span"));
    });
    $("#description_e").keyup(function () {
        //debugger;
        return checkBookDescription($("#description_e"), $("#description_e").siblings("span"));
    });

    $("#tmp").on("click", function (e) {
        debugger;
        $('#addBookModal').modal('show');
    });
    $("#btn-add").on("click", function (e) {
        debugger;
        // e.preventDefault();
        var button = $(this);
        button.prop("disabled", true);

        check = true;

        if (!($("#id").keyup())) {
            check = false;
        }

        if (!($("#title").keyup())) {
            check = false;
        }

        if (!($("#price").keyup())) {
            check = false;
        }

        if (!$("#date").keyup()) {
            check = false;
        }
        if (!$("#description").keyup()) {
            check = false;
        }

        if (!checkIfOptionSelected($("#author_fullname"), $("#author_fullname").siblings("span"))) {
            check = false;
        }
        if (!checkIfOptionSelected($("#publishing_house"), $("#publishing_house").siblings("span"))) {
            check = false;
        }
        if (!checkIfOptionSelected($("#category"), $("#category").siblings("span"))) {
            check = false;
        }
        //e.preventDefault();
        var form = $("#user_form")[0];
        var formdata = new FormData(form);
        if (check) {
            $.ajax({
                type: "POST",
                url: "bookAdd.php",
                data: formdata, //$("#user_form").serialize(),
                processData: false,
                contentType: false,
                success: function (response) {
                    debugger;
                    var rez = JSON.parse(response);
                    if (rez.Return) {
                        swal(rez.Message);
                        $('#addBookModal').modal('hide');
                        //$('body').removeClass('modal-open');
                        // $('.modal-backdrop').remove();
                        // $('#addBookModal').modal('hide');
                        //$("#modal .close").click();
                        // $('.modal').removeClass('show');
                        // $('.modal').removeClass('show');
                        $('#cancel-button').click();
                        // var data = $("#index-table").html();
                        // console.log(data);
                        button.prop("disabled", false);
                        // var div = $(location.href + " #index-table").html();
                        //$("#user_form")[0].reset();
                        //$("#index-table").html(data);
                    } else {
                        swal(rez.Message);
                        button.prop("disabled", false);
                    }
                    //$("#data-div").load("#data-div");
                    window.location.reload();
                }
            });
        } else {
            swal("Ka gabime ne forme");
            button.prop("disabled", false);
        }
    });
    $("#update").on("click", function (e) {
        debugger;
        // e.preventDefault();
        var button = $(this);
        button.prop("disabled", true);

        check = true;

        if (!($("#id_e").keyup())) {
            check = false;
        }

        if (!($("#title_e").keyup())) {
            check = false;
        }

        if (!($("#price_e").keyup())) {
            check = false;
        }

        if (!$("#date_e").keyup()) {
            check = false;
        }
        if (!$("#description_e").keyup()) {
            check = false;
        }

        if (!checkIfOptionSelected($("#author_fullname_e"), $("#author_fullname_e").siblings("span"))) {
            check = false;
        }
        if (!checkIfOptionSelected($("#publishing_house_e"), $("#publishing_house_e").siblings("span"))) {
            check = false;
        }
        if (!checkIfOptionSelected($("#category_e"), $("#category_e").siblings("span"))) {
            check = false;
        }
        var form = $("#update_form")[0];
        var formdata = new FormData(form);
        if (isbn != null) {
            formdata.append("First_ISBN", isbn);
        }
        if (old_book_cover != null) {
            formdata.append("First_book_cover", isbn);
        }
        if (old_book_file != null) {
            formdata.append("First_book_file", isbn);
        }
        if (check) {
            $.ajax({
                type: "POST",
                url: "bookEdit.php",
                data: formdata, //$("#user_form").serialize(),
                processData: false,
                contentType: false,
                success: function (response) {
                    debugger;
                    var rez = JSON.parse(response);
                    if (rez.Return) {
                        swal(rez.Message);
                    }
                    button.prop("disabled", false);
                    $('#editBookModal').modal('hide');
                    //$('body').removeClass('modal-open');
                    // $('.modal-backdrop').remove();
                    // $('#addBookModal').modal('hide');
                    // $("#modal .close").click();
                    // $('.modal').removeClass('show');
                    // $('.modal').removeClass('show');
                    $('#cancel-button-e').click();
                    // var data = $("#index-table").html();
                    // console.log(data);
                    // $("#index-table").load("bookIndex.php");
                    //$("#data-div").load("#data-div");
                    window.location.reload();
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
    //     $("#editBookModal").on("shown.bs.modal", function(){
    //         $('.modal-backdrop.in').css('opacity', '0.9');
    //   });
    // $(".modal").on('shown.bs.modal', function () {
    //     $('.modal-backdrop').css('background', '#00000073');
    // });
    $("#button-delete").on("click", function (e) {
        debugger;
        //e.preventDefault();
        var form = $("#delete-form")[0];
        var formdata = new FormData(form);
        $.ajax({
            type: "POST",
            url: "bookDelete.php",
            data: formdata, //$("#user_form").serialize(),
            processData: false,
            contentType: false,
            success: function (response) {
                debugger;
                var rez = JSON.parse(response);
                if (rez.Return) {
                    swal(rez.Message);
                    $('#deleteBookModal').modal('hide');
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
                    swal(rez.Message);
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
    // $("#add-book-button").click(function (e) {
    //     e.preventDefault();
    //     // alert("brenda");
    //     $("#addBookModal").show();
    // })

})


$(document).on("click", ".update", function (e) {
    debugger;
    e.preventDefault();
    var id = $(this).attr("data-id");
    isbn = id;
    var title = $(this).attr("data-title");
    var price = $(this).attr("data-price");
    var quantity = $(this).attr("data-quantity");
    var date = $(this).attr("data-date");
    var description = $(this).attr("data-description");
    var publishing_house = $(this).attr("data-publishing_house");
    var category = $(this).attr("data-category");
    var author_fullname = $(this).attr("data-author_fullname");
    old_book_cover = $(this).attr("data-book_cover");
    old_book_file = $(this).attr("data-book_file");
    $("#id_e").val(id);
    $("#title_e").val(title);
    $("#price_e").val(price);
    $("#quantity_e").val(quantity);
    $("#date_e").val(date);
    $("#description_e").val(description);
    $("#publishing_house_e").val(publishing_house);
    $("#category_e").val(category);
    // $("#book_cover_e").val("~/book_cover"+book_cover);
    // $("#book_file_e").val("~/book_file"+book_file);
    $("#author_fullname_e").val(author_fullname);
});
$(document).on("click", ".delete", function (e) {
    debugger;
    e.preventDefault();
    var id = $(this).attr("data-id");
    $("#id_d").val(id);
});