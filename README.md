<p align="center"><a href="https://github.com" target="_blank"><img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" width="400" alt="GitHub Logo"></a></p>

<p align="center">
<a href="https://github.com/github/github/actions"><img src="https://github.com/github/github/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/github/github"><img src="https://img.shields.io/packagist/dt/github/github" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/github/github"><img src="https://img.shields.io/packagist/v/github/github" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/github/github"><img src="https://img.shields.io/packagist/l/github/github" alt="License"></a>
</p>

## About

Laravel Breeze is a minimal, simple implementation of all of Laravel's authentication features, including login, registration, password reset, email verification, and password confirmation. In addition, Breeze includes a simple "profile" page where the user may update their name, email address, and password.

## Setup

1. Clone your repository from the github 'git clone [URL]'
2. Navigate up one level so you are outside of your assignment folder 'cd ..'
3. Create new laravel project in a temporary folder 'laravel new temp-laravel'
4. Move the files from temp-laravel into your as1-progress-check-1 folder and then delete the empty temp-laravel folder afterwards.
5. Navigate back into your assignment folder and set up authentication: <br>
    - 'cd as1-progress-check-1-[YOUR_FOLDER_NAME]' <br>
    - 'composer require laravel/breeze --dev' <br>
    - 'php artisan breeze:install blade'
6. Finally, push your new installation back to your GitHub Classroom repo: <br>
    - 'git add .' <br>
    - 'git commit -m "Initial Laravel setup with Breeze"' <br>
    - 'git push origin main'