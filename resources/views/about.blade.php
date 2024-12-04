<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Kevin Nguyen</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body>
    @include('layouts.header')
    <div class="container">
        <h1>About Me</h1>
        <div class="table-container">
            <p>Hi, I'm Kevin Nguyen. Welcome to my personal page!</p>

            <!-- 7. Picture of me -->
            <h2>Picture of Me</h2>
            {{-- <img src="{{ asset('images/me.jpg') }}" alt="Kevin Nguyen" style="width:200px;height:auto;"> --}} <!-- goat zoo pic -->
            <img src="{{ asset('images/me2.jpg') }}" alt="Kevin Nguyen2" style="width:200px;height:auto;">
            <br><br>

            <!-- 2. Censored version of my resume -->
            <h2>My Resume</h2>
            <a href="{{ asset('resume_censored.pdf') }}" target="_blank">View my resume</a>
            <br><br>

            <!-- 3. Cover letter -->
            <h2>About Kevin Nguyen</h2>
            <p>
                I'm a 24 year old software engineer that likes to do small passion projects like this in my free time and explore
                different technologies. I want to do a google chrome extension project, game development, and api work next. I'm also 
                pursuing an AWS cloud practitioner certification. I'm currently looking for a full-time software engineering position.
                I have lots of experience with web development(this project) and using google software
                (I did a google ads api project for revenue tracking and a google analytics project for tracking retention). 
                At my previous job I regularly used MySQL and PHP to work across the full stack as well. It was a small company so I had 
                to take on many roles like developer, tester, and project manager. I'm capable of working by myself(like on this project) 
                and with a team. Also I'm not too bad with git. If you get to know me, I've been told I bring a very positive energy, 
                lots of laughs, and a smile to every meeting.
                I have references available upon request as well that can attest to that! Hopefully you'll consider me for a position : )
            </p>
            <br>
            <h4>On a more personal level</h4>
            <p>
                Laufey, league, pokemon(wolfey) running, May, want a big dog, let me know if you're a ___ vs a ____, anime/arcane, cooking 
            </p>
            <br>

            <!-- 4. Talk about this project -->
            <h2>About This Project</h2>
            <p>
                This project was just showing off my love for pokemon. I wanted to do something fun that could actually be useful.
                In this project, I scraped off multiple sites and combined the data into a MYSQL database and used a laravel framework to display the data.
                I used my experience from working at a small company to be able to work across the full stack and create a project that I'm proud of.
                This is all done from scratch, solo, and on github.
                It goes more in depth than just showing basic information like type, for example showing weaknesses, common moves, and abilities.
                This is more geared towards competitive pokemon/VGC than casual play.
                It also has quizzes to test your pokemon knowledge!
            </p>
            <br>

            <!-- 5. Talk about other projects -->
            <h2>Other Projects</h2>
            <h3>Past Projects</h3>
            <ul>
                <li>Google Analytics event tracking system</li>
                <li>Google Ads API Project</li>
                <li>3D maze runner game</li>
            </ul>

            <h3>Future Projects</h3>
            <ul>
                <li>React/Spring Boot Application</li>
                <li>Google Chrome Extension</li>
                <li>Game Development</li>
            </ul>
            <br>

            <!-- 6. Contact me -->
            <h2>Contact Me</h2>
            <p>If you would like to get in touch, please send me an email at <a href="mailto:kdn2000job@gmail.com">kdn2000job@gmail.com</a>.</p>
            <br>

            <!-- 1. Button to send an email with a 1-day timer -->
            <form method="POST" action="{{ route('pokemon.email') }}">
                @csrf
                OR
                <button type="submit" class="button">Send Preset Email</button>
            </form>


        </div>
    </div>
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
</body>
</html>