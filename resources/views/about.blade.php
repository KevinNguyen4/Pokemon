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
    <div class="aboutContainer">
        <h1>About Me</h1>
        <div class="table-container">
            <h2>Hi, I'm Kevin Nguyen. Welcome to my personal page!</h2>
            

            <!-- 7. Picture of me -->
            {{-- <h2>Picture of Me</h2> --}}
            {{-- <img src="{{ asset('images/me.jpg') }}" alt="Kevin Nguyen" style="width:200px;height:auto;"> --}} <!-- goat zoo pic -->
            <img src="{{ asset('images/me2.jpg') }}" alt="Kevin Nguyen2" class="right-image">
            <br><br>

            <!-- 2. Censored version of my resume, make it a drop down -->
            <h2>My Resume</h2>
            <br>
            <a class="button" href="{{ asset('Resume_Kevin_Nguyen.pdf') }}" target="_blank">View my Resume</a>
            <br><br><br>

            <!-- 3. Cover letter -->
            <h2>About Kevin Nguyen</h2>
            <p>
                Hello! I'm a 24 year old software developer that likes to do small passion projects like this in my free time and explore
                different technologies. I want to do a google chrome extension project, game development, and API work next. I'm also 
                pursuing an <b>AWS cloud practitioner certification</b>. 
                <br><br>
                I'm currently looking for a <b>full-time software developer position</b>.
                I have lots of experience with <b>web development</b> and using <b>Google software</b>
                (I did a Google Ads API project for revenue tracking and a Google Analytics project for tracking retention). 
                <br><br>
                At my previous job I regularly used <b>MySQL</b> and <b>PHP</b> to work across the full stack as well. It was a small company so I had 
                to take on many roles like <b>developer, tester,</b> and <b>project manager</b>. I'm capable of working by myself(like on this project) 
                and with a team. Also I'm not too bad with git. I am very experienced with <b>Java</b> as well, as that is my native and preferred coding 
                language.
                <br><br>
                For future jobs, I look forward to <b>engineering new systems, improving old ones</b>, and working with a team to create something great. 
                I'm very excited and passionate about software engineering, the feeling of creating something and seeing it grow is very satisfying to me.
                <br><br>
                If you get to know me, I've been told I bring a very positive energy, lots of laughs, and a smile to every meeting.
                I have references available upon request as well that can attest to that! Hopefully you'll consider me for a position : )
            </p>
            
            {{-- <h4>On a more personal level</h4>
            <p>
                Laufey, league, pokemon(wolfey) running, May, want a big dog, ice breaker: let me know if you're a ____ vs a ____, anime/arcane, cooking 
            </p> --}}
            <br><br>

            <!-- 4. Talk about this project -->
            <h2>About This Project</h2>
            <p>
                This project was just showing off my love for pokemon. I wanted to do something fun that could actually be useful.
                In this project, I scraped off multiple sites and combined the data into a <b>MYSQL</b> database and used a <b>Laravel</b> framework 
                to display the data.
                I used my experience from working at a small company to be able to work across the full stack and create a project that I'm proud of.
                This is all done from scratch, solo, and on github.
                <br><br>
                It goes more in depth than just showing basic information like type, for example showing weaknesses, common moves, and abilities.
                This is more geared towards competitive Pokemon/VGC than casual play.
                It also has quizzes to test your pokemon knowledge!
            </p>
            <br><br>

            <!-- 5. Talk about other projects -->
            <h2>Other Projects</h2>
            <h3>Past Projects</h3>
            <ul>
                <li>Google Analytics Event Tracking system</li>
                <li>Google Ads API Project</li>
                <li>3D maze runner game</li>
            </ul>
            <br>    
            <h3>Future Projects</h3>
            <ul>
                <li>React/Spring Boot Application</li>
                <li>Google Chrome Extension</li>
                <li>Game Development</li>
            </ul>
            <br><br>

            <!-- 6. Contact me -->
            <h2>Contact Me</h2>
            <p>If you would like to get in touch, please send me an email at <a href="mailto:kdn2000job@gmail.com">kdn2000job@gmail.com</a>.</p>
            <br><br><br><br><br>


        </div>
    </div>
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
</body>
</html>