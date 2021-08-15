<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .card-form-wapper {
                width: 500px;
                border: 1px solid gray;
                border-radius: 8px;
                padding: 16px;
            }
        </style>
        <script src="https://js.stripe.com/v3/"></script>
        <script src="https://js.pay.jp/v2/pay.js"></script>
    </head>
    <body>
        <div class="card-form-wapper">
            <h1>カードを登録してね♡</h1>
            <h2 id="card-token"></h2>
            <div class="form-control mb-3" id="card-number"></div>
            <div class="form-control mb-3" id="card-expiry"></div>
            <div class="form-control mb-3" id="card-cvc"></div>

            <button type="button" class="btn btn-primary" id="card-button" data-secret="seti_1JNXQBHxF6stl85ppOsuc2kA_secret_K1abeP2harYphahUmHHpoWCwRUBp0cy">
                Get Card Token
            </button>
        </div>

        <div id="card-element"></div>
    </body>
    <script>
        const stripe = Stripe('pk_test_Y8GBXhUorqdwEvPFuS7KDBjn');
        const elements = stripe.elements();
        const cardNumber = elements.create('cardNumber');
        const cardExpiry = elements.create('cardExpiry');
        const cardCvc = elements.create('cardCvc');

        cardNumber.mount('#card-number');
        cardExpiry.mount('#card-expiry');
        cardCvc.mount('#card-cvc');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            await stripe.createToken(cardNumber).then(res => {
                document.getElementById('card-token').innerText = res.token.id;
            });
        });
    </script>
</html>
