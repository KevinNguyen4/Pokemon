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
    <div class="container">
        <h1>About Me</h1>
        <div class="table-container">
            <p>Hi, I'm Kevin Nguyen. Welcome to my personal page!</p>

            <!-- 1. Button to send an email with a 1-day timer -->
            <form method="POST" action="{{ route('send.email') }}">
                @csrf
                <button type="submit" class="button">Send me an email</button>
            </form>

            <!-- 2. Censored version of my resume -->
            <h2>My Resume</h2>
            <a href="{{ asset('resume_censored.pdf') }}" target="_blank">View my censored resume</a>

            <!-- 3. Cover letter -->
            <h2>Cover Letter</h2>
            <p>
                I have experience in various fields including web development, software engineering, and project management. 
                I have worked on numerous projects that demonstrate my skills and expertise. 
                My resume provides a detailed overview of my professional journey.
            </p>

            <!-- 4. Talk about this project -->
            <h2>About This Project</h2>
            <p>
                This project is a Pokémon database that I created to showcase my skills in web development. 
                It includes features such as searching for Pokémon by name, type, and ability, as well as various quizzes to test your Pokémon knowledge. 
                This project demonstrates my ability to work with databases, create dynamic web applications, and implement user-friendly interfaces.
            </p>

            <!-- 5. Talk about other projects -->
            <h2>Other Projects</h2>
            <p>
                I have worked on several other projects including:
                <ul>
                    <li>Event Tracking System</li>
                    <li>React/Spring Boot Application</li>
                    <li>Google Chrome Extension</li>
                    <li>Game Development</li>
                </ul>
            </p>

            <!-- 6. Contact me -->
            <h2>Contact Me</h2>
            <p>If you would like to get in touch, please send me an email at <a href="mailto:kdn2000job@gmail.com">kdn2000job@gmail.com</a>.</p>

            <!-- 7. Picture of me -->
            <h2>Picture of Me</h2>
            <img src="{{ asset('images/me.jpg') }}" alt="Kevin Nguyen" style="width:200px;height:auto;">
        </div>
    </div>
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
</body>
</html>