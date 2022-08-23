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
  // debugger;
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
  // debugger;
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

function checkIfCitySelected(element, errorSpan) {
  debugger;
  if (element.val()) {
    return true;
  } else
    return false;
};

$(document).ready(function () {
  debugger;
  $("#Name").keyup("#Name", function () {
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
    return validateDate($("#Birthday"), $("#Birthday").siblings("span"));
  });
  $("#Street").keyup(function () {
    // debugger;
    return checkStreet($("#Street"), $("#Street").siblings("span"));
  });
  $("#PostalCode").keyup(function () {
    // debugger;
    return checkPostalCode($("#PostalCode"), $("#PostalCode").siblings("span"));
  });
  //var check = $("#Name").on("keyup change", checkString($("#Name"), $("#Name").siblings("span")));


  $("#RegisterSubmitButton").on("click", function (e) {
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
    if (!checkIfCitySelected($("#City"),$("#City").siblings("span"))) {
      check = false;
    }

    var data = $("#registraionForm").serialize();
    console.log(data);
    if (check) {
      console.log(data);
      $.ajax({
        url: "completeRegistration.php",
        type: "POST",
        data: data,
        success: function (response) {
          if (response == "Registered") {
            alert("U regjistruat me sukses");
          }
          //alert(response);
          var rez = JSON.parse(response);
          console.log(response);
          if (rez.Return == true) {
            button.prop("disabled", false);
            window.location.href = "login.php";
          } else {
            alert(rez.Message);
            button.prop("disabled", false);
          }
        }
      })
    } else {
      alert("Ka gabime ne forme");
      button.prop("disabled", false);
    }
  });
  var img = $("<img />").attr('src', 'captcha.php').on('load', function () {
    if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
      alert('broken image!');
    } else {

    }
  });
  $("#LogInsubmitButton").on("click", function (e) {
    e.preventDefault();
    debugger;
    var button = $(this);
    button.prop("disabled", true);
    let email = $("#Email").val().trim();
    let password = $("#Password").val().trim();
    check = true;
    // if (!checkEmail(email, $("#Email").siblings("span"))) {
    //   check = false;
    // }

    // if (!checkStrength(password, $("#Password").siblings("span"))) {
    //   check = false;
    // }
    if (!($("#Email").keyup())) {
      check = false;
    }

    if (!$("#Password").keyup()) {
      check = false;
    }

    // if ($("#Captcha").val() == null) {
    //   check = false;
    // }
    console.log("Debugging");
    if (check) {
      var data = $("#formLogIn").serialize();
      console.log(data);
      if (check) {
        console.log(data);
        $.ajax({
          url: "completeLogIn.php",
          type: "POST",
          data: data,
          success: function (response) {
            debugger;
            alert(response);
            var rez = JSON.parse(response);
            console.log(response);
            if (rez.Return == true) {
              button.prop("disabled", false);
              if (rez.Role == "admin" || rez.Role == "worker") {
                window.location.href = "../Admin/home.php"; 
              }
              else{

                window.location.href = "../User/home.php";
              }
            } else {
              if (rez.Message == "Prit") {
                button.prop("disabled", true);
                window.location.href = "login.php";
              } else {
                //s$("#img").attr("src", "captcha.php");
                button.prop("disabled", false);
                window.location.href = "login.php";
              }
              // window.location.href = "login.php";
              
              alert(rez);
            }
          },
          error: function (response) {
            button.prop("disabled", false);
            alert(response);
            window.location.href = "login.php";
          }
        })
      } else {
        alert("Ka gabime ne forme");
      }
    } else {
      button.prop("disabled", false);
      window.location.href = "login.php";
    }
  });

  $("#emailResetButton").on("click", function (e) {
    e.preventDefault();
    debugger;
    var button = $(this);
    button.prop("disabled", true);
    check = true;
    // if (!checkEmail(email, $("#Email").siblings("span"))) {
    //   check = false;
    // }

    // if (!checkStrength(password, $("#Password").siblings("span"))) {
    //   check = false;
    // }
    if (!($("#Email").keyup())) {
      check = false;
    }

    console.log("Debugging");
    if (check) {
      var data = $("#resetPassword").serialize();
      console.log(data);
      if (check) {
        console.log(data);
        $.ajax({
          url: "completeEmailForReset.php",
          type: "POST",
          data: data,
          success: function (response) {
            debugger;
            //alert("Mbaruam")
            //alert(response);
            var rez = JSON.parse(response);
            console.log(response);
            button.prop("disabled", false);
            if (rez.Return == true) {
              window.location.href = "CodeResetAF.php";
            } else {
              alert(rez.Message);
            }
          },
          error: function (response) {
            alert(response.Message);
            button.prop("disabled", false);
          }
        })
      } else {
        button.prop("disabled", false);
        alert("Ka gabime ne forme");
      }
    }
    else {
      button.prop("disabled", false);
      alert("Ka gabime ne forme");
    }
  });
  $("#codeResetButton").on("click", function (e) {
    e.preventDefault();
    debugger;
    var button = $(this);
    button.prop("disabled", true);
    check = true;
    // if (!checkEmail(email, $("#Email").siblings("span"))) {
    //   check = false;
    // }

    // if (!checkStrength(password, $("#Password").siblings("span"))) {
    //   check = false;
    // }
    var value = $("#Code").val();
    var span = $("#Code").siblings("span");
    if (isNaN(value)) {
      makeInvalid($("#Code"));
      span.html("Ju lutem fusni numer")
      span.show();
      check = false;
    } else if (value.length != 6) {
      makeInvalid($("#Code"));
      span.html("Numri duhet te kete 6 shifra")
      span.show();
      check = false;
    }

    console.log("Debugging");

    var data = $("#CodeResetAF").serialize();
    console.log(data);
    if (check) {
      console.log(data);
      $.ajax({
        url: "completeCodeResetAF.php",
        type: "POST",
        data: data,
        success: function (response) {
          debugger;
          //alert("Mbaruam")
          //alert(response);
          var rez = JSON.parse(response);
          console.log(response);
          button.prop("disabled", false);
          if (rez.Return == true) {
            window.location.href = "resetPassword.php";
          } else {
            alert(rez.Message);
          }
        },
        error: function (response) {
          button.prop("disabled", false);
          alert(response.Message);
        }
      })
    } else {
      button.prop("disabled", false);
      //window.location.href = "emailForReset.php";
      // $.ajax({
      //   url: "emailForReset.php",
      //   type: "GET",
      //   success: function (response) {
      //     debugger;
      //     alert("Mbaruam");
      //     $(this).prop("disabled", false);
      //     // alert(response);
      //     // var rez = JSON.parse(response);
      //     // console.log(response);
      //     // if (rez.Return == true) {
      //     //   alert("u ridergua nje kod i ri");
      //     // } else {
      //     //   alert(rez.Message);
      //     // }
      //   },
      //   error: function (response) {
      //     $(this).prop("disabled", false);
      //     alert(response);
      //   }
      //})
    }
  });
  $("#resetPasswordButton").on("click", function (e) {
    e.preventDefault();
    debugger;
    var button = $(this);
    button.prop("disabled", true);
    let password = $("#Password").val().trim();
    let confirmPassword = $("#ConfirmPassword").val().trim();
    check = true;
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
    console.log("Debugging");
    var data = $("#resetPasswordForm").serialize();
    console.log(data);
    if (check) {
      console.log(data);
      $.ajax({
        url: "completeResetPassword.php",
        type: "POST",
        data: data,
        success: function (response) {
          debugger;
          //alert("Mbaruam")
          //alert(response);
          var rez = JSON.parse(response);
          console.log(response);
          button.prop("disabled", true);
          if (rez.Return == true) {
            window.location.href = "CodeResetAF.php";
          } else {
            alert(rez.Message);
            //window.location.href = "login.php";
          }
        },
        error: function (response) {
          button.prop("disabled", false);
          alert(response.Message);
        }
      })
    } else {
      button.prop("disabled", false);
      alert("Ka gabime ne forme");
    }
  });
  $("#GoogleLoginRegisterSubmitButton").on("click", function (e) {
    e.preventDefault();
    debugger;
    var button = $(this);
    button.prop("disabled", true);
    let password = $("#Password").val().trim();
    let confirmPassword = $("#ConfirmPassword").val().trim();
    // let birthday = $("#Birthday").val().trim();
    // let city = $("#City").val().trim();
    // let street = $("#Street").val().trim();
    // let postalCode = $("#PostalCode").val().trim();
    check = true;

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
    // if (!($("#City").keyup())) {
    //   check = false;
    // }
    if (!($("#Street").keyup())) {
      check = false;
    }
    if (!($("#PostalCode").keyup())) {
      check = false;
    }
    if (!checkIfCitySelected($("#City"))) {
      check = false;
    }

    console.log("Debugging");
    var data = $("#googleLoginRegistraionForm").serialize();
    console.log(data);
    if (check) {
      console.log(data);
      $.ajax({
        url: "completeGoogleLoginRegistraionForm.php",
        type: "POST",
        data: data,
        success: function (response) {
          debugger;
          //alert("Mbaruam")
          //alert(response);
          var rez = JSON.parse(response);
          console.log(response);
          button.prop("disabled", false);
          if (rez.Return == true) {
            window.location.href = "login.php";
          } else {
            alert(rez.Message);
          }
        },
        error: function (response) {
          alert(response.Message);
          button.prop("disabled", false);
        }
      })
    } else {
      alert("Ka gabime ne forme");
      button.prop("disabled", false);
    }
  });
})