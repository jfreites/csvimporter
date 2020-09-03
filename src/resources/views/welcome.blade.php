<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CSV Field Import Mapper</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .go-to {
                color: #636b6f;
                font-size: 20px;
                font-weight: bold;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-up-down {
                margin: 40px 0;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                CSV Field Import Mapper
                </div>

                <p class="m-up-down">
                    <a class="go-to" href="{{ route('contact.index') }}">See in action</a>
                </p>

                <div class="links">
                    <a href="https://jonathanfreites.info">Jonathan Freites</a>
                    <a href="https://www.linkedin.com/in/jonathanfreites">Linkedin</a>
                    <a href="https://github.com/jfreites/csvimporter">GitHub Repository</a>
                </div>
            </div>
        </div>
    </body>
</html>
