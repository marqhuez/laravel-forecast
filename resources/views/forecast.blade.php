<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="css/app.css" rel="stylesheet">
        <script src="https://unpkg.com/htmx.org@2.0.1"></script>
    </head>
    <body>
        <div>
            <p>Get forecast for city:</p>
            <form hx-get="/forecast" hx-swap="innerHTML" hx-target="#target">
                <input type="text" name="cityName" value="">

                <button type="submit">Get Forecast</button>
            </form>

            <hr>

            <div id="target"></div>
        </div>
    </body>
</html>
