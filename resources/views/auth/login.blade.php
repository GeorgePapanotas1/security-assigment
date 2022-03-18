<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log In</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        html {
            background: white;
            height: 100%;
            font-family: "Montserrat", sans-serif;
            box-sizing: border-box;
        }

        html * {
            box-sizing: inherit;
        }

        body {
            max-width: 400px;
            margin: 0 auto;
            width: 95%;
        }

        .striped-container {
            position: relative;
            margin-top: 24vh;
            min-height: 76vh;
            left: -30%;
            max-width: 300px;
            backface-visibility: hidden;
            background: black;
            background: repeating-linear-gradient(to right, white, white 10px, black 10px, black 20px);
        }

        .striped-container:before {
            content: "";
            display: block;
            position: absolute;
            bottom: 100%;
            left: 0;
            min-height: 12vh;
            width: 100%;
            transform: skewX(-45deg);
            transform-origin: 100% 100%;
            backface-visibility: hidden;
            background: black;
            background: repeating-linear-gradient(to right, white, white 10px, black 10px, black 20px);
        }

        .striped-container:after {
            content: "";
            display: block;
            position: absolute;
            bottom: calc(100% + 12vh);
            left: 0;
            min-height: 12vh;
            width: 100%;
            transform: skewX(45deg);
            transform-origin: 0 0;
            backface-visibility: hidden;
            background: black;
            background: repeating-linear-gradient(to right, white, white 10px, black 10px, black 20px);
        }

        h1 {
            font-weight: normal;
            font-size: 8vh;
        }

        form {
            padding: 2em;
            background: white;
            position: relative;
            left: 34%;
            width: 90vw;
            max-width: 450px;
        }

        input, label {
            display: block;
        }

        input, button {
            width: 100%;
            padding: 0.5em;
            font-size: 1.2em;
            box-sizing: border-box;
            background: transparent;
            border: none;
            outline: none;
            border-bottom: solid 1px black;
            margin: 0.5em 0 1em;
            color: gray;
            font-family: Montserrat, sans-serif;
            transition: background 0.3s ease-in;
        }

        input:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .button {
            background: mediumspringgreen;
            border: none;
            color: white;
            margin-top: 2em;
            position: relative;
            padding: 1em;
            font-family: "Montserrat", sans-serif;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-tap-highlight-color: transparent;
            /* For some Androids */
        }

        .button:hover,
        .button:focus {
            background-color: #00e18a;
        }

        .button:active {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        .error {
            border-bottom: solid 2px gold;
        }

        .error-message {
            color: gold;
            position: absolute;
            margin-top: -0.5em;
            display: block;
        }

        /* Css for ripples */
        .ripple {
            overflow: hidden;
        }

        .ripple-effect {
            position: absolute;
            width: 10px;
            height: 300px;
            background: white;
            -webkit-animation: ripple-animation 1.2s;
        }

        @keyframes ripple-animation {
            from {
                -webkit-transform: scale(1);
                opacity: 0.4;
            }
            to {
                -webkit-transform: scale(100);
                opacity: 0;
            }
        }

        .red{
            color: #ce3232;
        }

        .mb-40{
            margin-bottom: 40px;
        }

        .d-none{
            display: none;
        }
    </style>
</head>
    <body>
        <div class="striped-container">
            <form action="#" method="post">
                <h1>Sign In.</h1>
                <p class="red mb-40 d-none" id="error_item_1">Email or password are invalid. <span ><strong id="tries"></strong></span> tries remaining before <strong>5 minute</strong> restriction.</p>
                <p class="red mb-40 d-none" id="error_item_2"></p>
                <label for="">Email</label>
                <input type="email"  id="email_val" required/>
                <label for="">Password</label>
                <input type="password" id="pwd_val" required/>
                <button class="button ripple" id="button_submit"  data-ripple-color="white" ontouchstart="return true;">LOGIN</button>
            </form>
        </div>
    </body>

<script src="{{ asset('js/globals.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('.ripple').on('click', function(event) {
        event.preventDefault();
        var $div = $('<div/>'),
            btnOffset = $(this).offset(),
            xPos = event.pageX - btnOffset.left,
            yPos = event.pageY - btnOffset.top;

        $div.addClass('ripple-effect');
        var $ripple = $(".ripple-effect");

        $ripple.css("height", $(this).height());
        $ripple.css("width", $(this).height());
        $div
            .css({
                top: yPos - ($ripple.height() / 2),
                left: xPos - ($ripple.width() / 2),
                background: $(this).data("ripple-color")
            })
            .appendTo($(this));

        window.setTimeout(function() {
            $div.remove();
        }, 1200);
    });

    const baseURL = '{{ url('') }}'

    $("#button_submit").click(function(event){

        event.preventDefault();
        $("#error_item_2").fadeOut('fast');
        $("#error_item_1").fadeOut('fast');
        // alert(getLocal('key'));

        const pwd_val = $("#pwd_val").val();
        const email_val = $("#email_val").val();

        body = {
            "email": email_val,
            "password": pwd_val
        }

        const response = request('POST', `${baseURL}/api/v3/auth/login`, body);

        response.then(async data => {

            statusCode = data.status

            if(statusCode === 401) {
                respData = await data.json();

                if(respData['type'] === 'invalid') {
                    tries = 5 - parseInt(respData['retries']);
                    $("#tries").html(tries)
                    $("#error_item_1").fadeIn()
                }else {
                    $("#error_item_2").html(respData['error']).fadeIn()
                }

                return 0;
            }
            dt= await data.json()
            console.log(dt)
            expiration_seconds = dt['expires_in'] * 1000;

            t = new Date(new Date().getTime() + expiration_seconds);

            createLocal('local-auth-tk', dt.access_token);
            createLocal('local-auth-xp', t);

            var urlParams = new URLSearchParams(window.location.search);
            if(urlParams.get('ret')) {
                window.location.href = urlParams.get('ret')
            }else {
                window.location.href = '/app/helloworld'
            }

        })
    })


</script>
</html>
