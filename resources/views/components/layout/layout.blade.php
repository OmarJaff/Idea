<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Idea</title>
    @vite(['/resources/css/app.css'])
</head>
<body class="bg-background text-forground">

     <x-layout.nav/>
    <main>
        {{$slot}}
    </main>
</body>
</html>
