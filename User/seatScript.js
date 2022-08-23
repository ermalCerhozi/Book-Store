$(document).ready(function () {
    sessionStorage.setItem("numberOfSelection", 0);
    sessionStorage.setItem("timeCheck", true);
    $("#reserve-button").on("click", function (e) {
        e.preventDefault();
        // debugger;
        //kontrolli elementet e formes nese jane te sakta
        //nese true => bej rezervimin ne database pasi e ke kontrolluar qe eshte akoma e lire ne ate orar
        // else => bej alert qe eshte e zene ose errorin perkates
        var start = $("#start").val();
        var end = $("#end").val();
        var data = $("#form").serializeArray();
        var id = {
            name: "id",
            value: sessionStorage.getItem("seat_id")
        };
        // data.push({name:"id",value: sessionStorage.getItem("seat_id")});
        data.push(id);
        console.log(data);
        if ((start > 8 && start <= 18) && (end > 9 || end <= 19) && start < end && sessionStorage.getItem("seat_id") != 0) {
            $.ajax({
                type: "POST",
                url: "makeReservation.php",
                data: data,
                success: function (response) {
                    debugger;
                    //kontrollo nese kemi sukses ose jo
                    //nese true => atehere fshije nga session storeage karrigen
                    var rez = JSON.parse(response);
                    if (rez.Return) {
                        swal({
                            title: "Reservation",
                            text: rez.Message,
                            icon: "success",
                        });
                        $("#" + sessionStorage.getItem("seat_id")).removeClass("selected");
                        sessionStorage.setItem("numberOfSelection", 0);
                        sessionStorage.setItem("seat_id", "");
                    } else {
                        swal({
                            title: "Reservation",
                            text: rez.Message,
                            icon: "error",
                        });
                    }
                }
            });
        } else {
            swal({
                title: "Reservation",
                text:"Keni kaluar afatin e rezervimit ose nuk keni zgjdhur karrige",
                icon: "error",
            });
        }
    });
    setInterval(function () {
        // var start = $("start-time").val();
        // var end = $("end-time").val();
        // console.log(start);
        // console.log(end);
        // var data = {
        //     start: start,
        //     end: end
        // };
        debugger;
        var start = $("#start").val();
        var end = $("#end").val();
        if ((start > 8 && start <= 18) && (end > 9 || end <= 19) && start < end) {
            sessionStorage.setItem("timeCheck", true);
            var data = $("#form").serialize();
            $.ajax({
                type: "GET",
                url: 'pageRefresh-v2.php',
                data: data,
                success: function (response) {
                    // debugger;
                    $("#reserve-button").prop("disabled", false);
                    var rez = JSON.parse(response);
                    var data = rez.Data;
                    var current_occupied_data = $("div.occupied");
                    for (let i = 1; i < current_occupied_data.length; i++) {

                        //check nese id eshte null ose jo para se te kryesh veprimet
                        var element = current_occupied_data[i];
                        var id = $(element).prop("id");
                        if (data.indexOf(id) == -1) {
                            $("#" + id).removeClass("occupied");
                        }
                    }
                    // current_occupied_data.forEach(element => {
                    //     var id = $(element).attr("id");
                    //     console.log(id);
                    //     if (data.indexOf(id) == -1) {
                    //         $(id).removeClass("occupied");
                    //     }
                    // });
                    for (let i = 0; i < data.length; i++) {
                        var element = data[i];
                        $("#" + element).addClass("occupied");
                    }
                    // data.forEach(element => {
                    //     $("#" + element).addClass("occupied");
                    // });
                    // $(".container").html(response);
                    console.log("brenda");
                    // debugger;
                    if (sessionStorage.getItem("seat_id") != "") {
                        debugger;
                        var id = sessionStorage.getItem("seat_id");
                        console.log(id);
                        $("#" + id).addClass("selected");
                        $("#seat-number").html(id);
                    } else {
                        $("#seat-number").html("");
                    }
                    // $(".container #20").addClass("selected");
                }
            });
        } else if (sessionStorage.getItem("timeCheck") == "true") {
            sessionStorage.setItem("timeCheck", false);
            swal({
                title: "User Edit",
                text:"Ju duhet te vendosni nje orar mes ores 8:00 dhe 19:00",
                icon: "error",
            });
            but
            $("#reserve-button").prop("disabled", true);
        }
    }, 1000);
    // $("$start-time").on("keyup", function () {

    // });
    // $("$end-time").on("keyup", function () {

    // });
});
$(document).on("click", ".seat", function (e) {
    debugger;
    e.preventDefault();
    console.log($(this).val());
    if ($(this).hasClass("selected")) {
        $(this).removeClass("selected");
        sessionStorage.setItem("numberOfSelection", 0);
        sessionStorage.setItem("seat_id", "");
    } else if ($(this).hasClass("occupied")) {
        swal({
            title: "User Edit",
            text: "Nuk mund te zgjdihni nje kargie qe eshte zene",
            icon: "error",
        });
    } else if (sessionStorage.getItem("numberOfSelection") == 1) {
        swal({
            title: "User Edit",
            text: "Mund te selektoni te shumten nje karrige",
            icon: "error",
        });
    } else {
        $(this).addClass("selected");
        sessionStorage.setItem("numberOfSelection", 1);
        console.log("Id e seat eshte: " + $(this).attr("id"));
        sessionStorage.setItem("seat_id", $(this).attr("id"));
    }

});


var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();
$(document).on("keyup", ".time-element", function () {
    delay(function () {
        var start = $("#start").val();
        var end = $("#end").val();
        var current_time = new Date().getHours();
        if (!$.isNumeric(start) || !$.isNumeric(end)) {
            localStorage.setItem("timeCheck", false);
            swal({
                title: "User Edit",
                text: "Duhet  te jepni vetem numra",
                icon: "error",
            });
        } else if (current_time >= 18) {
            localStorage.setItem("timeCheck", false);
            swal({
                title: "User Edit",
                text: "Libraria eshte mbyllur per sot.Ju lutem hajdeni nseser perseri",
                icon: "error",
            });
        } else if (start < current_time) {
            localStorage.setItem("timeCheck", false);
            swal({
                title: "User Edit",
                text: "Mund te rezervoni orare ne te ardhmen jo te shkuaren.",
                icon: "error",
            });
        } else if (end > 19) {
            localStorage.setItem("timeCheck", false);
            swal({
                title: "User Edit",
                text: "Libraria eshte hapur deri ne oren 19:00 per rezervime vendesh.",
                icon: "error",
            });
        } else if (end <= current_time) {
            localStorage.setItem("timeCheck", false);
            swal({
                title: "User Edit",
                text: "Koha e mbarimit duhet te jete me e madhe se koha e tanishme.",
                icon: "error",
            });
        } else {
            localStorage.setItem("timeCheck", true);
        }
    }, 2000);
});