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
            }
        </style>
        <script src="https://js.pay.jp/v2/pay.js"></script>
    </head>
    <body>
        <h1>PayJPのToken取得画面</h1>
        <h1 id="token-result"></h1>
        <div id="card-element"></div>
        <button id="card-submit">押してね♡</button>
    </body>
    <script>
        const payjp = Payjp('pk_test_55d0d044b48294732c59cfd2')

        const payJpElements = payjp.elements()

        const cardElement = payJpElements.create('card')

        cardElement.mount('#card-element')

        const cardButton = document.getElementById('card-submit');

        cardButton.addEventListener('click', () => {
            payjp.createToken(cardElement).then((response) => {
                if (response.error) {
                    // handle error
                } else {
                    const resultElement = document.getElementById('token-result');
                    resultElement.innerText = response.id;
                }
            })
        })
    </script>
</html>
