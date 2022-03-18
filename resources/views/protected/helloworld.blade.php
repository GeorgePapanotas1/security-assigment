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
            background: #0075fa;
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
            background-color: #207db7;
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

        .text-center{
            text-align: center;
        }

        .h-100 {
            height: 100vh;
        }

        .d-flex{
            display: flex;
        }

        .jcc{
            justify-content: center;
        }

        .aic {
            align-items: center;
        }

        .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }
        .loader {
            margin: 60px auto;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(28,28,28, 0.2);
            border-right: 1.1em solid rgba(28,28,28, 0.2);
            border-bottom: 1.1em solid rgba(28,28,28, 0.2);
            border-left: 1.1em solid #1c1c1c;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }



    </style>
</head>
<body>

    <div class="h-100 d-flex jcc aic">

        <div class="text-center">
            <h1 class="d-none" id="header">Welcome <strong id="name"></strong></h1>
            <h2 id = "password_notice" class="d-none">1 passed since the last password change. Please consider changing it in 29 days to ensure protection.</h2>
            <div class="loaders">
                <div class="loader">Loading...</div>
                <p>Fetching password information</p>
            </div>
            <button class="button ripple" id="button_logout"  data-ripple-color="white" ontouchstart="return true;">LOGOUT</button>
        </div>
    </div>


</body>
<script src="{{ asset('js/globals.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    const baseURL = '{{ url('') }}'
    isAuthenticated(`${baseURL}/api/v3/auth/me`, "/app/helloworld")
        .then(async response => {
            if(response.status === 302 || response.status === 401){
                window.location.href = '/auth/login?ret=/app/helloworld'
                return 0;
            }else if(response.status === 200){
                data = await response.json();

                $("#name").html(data['name'])
                $("#header").fadeIn()
            }
        })
        .then(result => console.log(result))
        .catch(error => console.log('error', error));

    async function checkPassword(url){
        token = getLocal('local-auth-tk');
        token = token.slice(1, -1)

        var myHeaders = new Headers();
        myHeaders.append("Authorization", "Bearer " + token);
        myHeaders.append("Accept", "application/json");

        var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            redirect: 'follow'
        };

        return await fetch(url, requestOptions)
    }


    $(document).ready(function (){

        $('#button_logout').click(function () {
            logout(`${baseURL}/api/v3/auth/logout`)
            .then(async response => {
                if(response.status === 200){
                    window.location.href = '/auth/login?ret=/app/helloworld'
                }
            })
        })

        const pwdRes = checkPassword(`${baseURL}/api/v3/app/password-time`);

        pwdRes.then(async response => {
            if(response.status > 300) {
                // window.location.href = '/auth/login?ret=/app/helloworld'
            }else {
                dt = await response.json();
                $(".loaders").hide();
                $("#password_notice").html(dt['result']).fadeIn()

            }
        })
    })
</script>
</html>
