<?php
include_once 'config.php';

// Include database connection file 
include_once '../DBconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= initial-scale=1.0">
    <title>Document</title>
</head>
<div class="pro-box">
    <img src="../book_cover/alex-knight-wfwUpfVqrKU-unsplash.jpg" alt="Image" width="100%" height="200px" />
    <div class="body">
        <h5>liber i vjeter</h5>
        <h6>Price: <?php echo '$' . "80" . PAYPAL_CURRENCY; ?></h6>

        <!-- PayPal payment form for displaying the buy button -->
        <form action="<?php echo PAYPAL_URL; ?>" method="post">
            <!-- Identify your business so that you can collect the payments. -->
            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

            <!-- Specify a Buy Now button. -->
            <input type="hidden" name="cmd" value="_xclick">

            <!-- Specify details about the item that buyers will purchase. -->
            <input type="hidden" name="item_name" value="liber i  vjeter">
            <input type="hidden" name="item_number" value="1223232657654">
            <input type="hidden" name="amount" value="80">
            <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

            <!-- Specify URLs -->
            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">

            <!-- Display the payment button. -->
            <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
        </form>
    </div>
    <!-- <div class=" col-md-4 col-xs-6 border-primary mb-3">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="card-header text-white bg-info">
                        <p class="card-text">
                        <h3 id="book-title" class="card-title">
                            liber i vjeter </h3>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="../book_cover/alex-knight-wfwUpfVqrKU-unsplash.jpg" alt="Image" width="100%" height="200px" />
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p id="book-isbn" class="card-text"><b>ISBN: </b>1223232657654</p>
                        <p id="book-price" class="card-text"><b>Price: </b>121</p>
                        <p id="book-author" class="card-text">
                            <b>Auhtor: Carls Dikens" </b>
                        </p>
                        <p id="book-category" class="card-text"><b>Category: </b>Poezi</p>
                        <p id="book-publishing-date" class="card-text"><b>Publishing Date: </b>1999</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card-footer ">
                        <p class="card-text">
                            <a class="btn btn-outline-primary float-right" href="Details/id=@item.ISBN">
                                <i class="bi bi-eye-fill"></i> Show Details
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <body>

    </body>

</html>