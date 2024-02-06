<?php     

session_start(['cookie_lifetime' => 604800]);
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "user";
    $_SESSION['id'] = "0";
}

include ($_SERVER['DOCUMENT_ROOT']."/data.php");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>GuessTheAnime - Challenge your friends</title>
        <meta name="author" content="Mazuky">
        <meta name="copyright" content="Mazuky">
        <meta name="robots" content="index,follow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Explore the world of Japanese animation with our Guess the Anime game! Test your knowledge, challenge your friends, and immerse yourself in the vibrant universe of anime and manga. Play now for a fun and exciting experience in guessing your favorite anime series and characters. Are you an anime expert? Find out and enjoy the ultimate anime quiz adventure on our site!">
        <meta name="keywords" content="Anime, guesstheanime, guessanime, season, japan, crunchyroll, animeguess, guessgame, guess anime, anime guess, guess the anime, Anime Quiz, Japanese Animation, Manga Puzzles, Otaku Games, Guess the Character, Anime Trivia, Japanese Cartoons, Anime Fan Game, Anime Quiz Game, Guess the Anime Series, Otaku Challenge, Manga Entertainment, Japanese Animation Puzzles, Anime Knowledge, Character Identification Game, Japanese Animation Quiz, Anime Fan Puzzles, Manga Fan Game, Guess the Series, dr. stone, Attack on Titan, Shingeki no Kyojin, Demon Slayer, Kimetsu no Yaiba, My Hero Academia, Boku no Hero Academia, One Punch Man, Jujutsu Kaisen, Death Note, One Piece, Naruto, Tokyo Ghoul">
        <link rel="canonical" href="https://www.guesstheanime.net/">
        <link rel="stylesheet" href="https://www.guesstheanime.net/style.css">
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-3Y1QSW8RJ5"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag("js", new Date());
    
        gtag("config", "G-3Y1QSW8RJ5");
        </script>
    </head>
    <body>
        <?php include ($_SERVER['DOCUMENT_ROOT']."/header.php");?>
        <main>
            <p style="color: rgb(255 255 255);">
                <b>Terms and Conditions for the Use of Mazuky.de and Associated Websites</b><br><br>
                Date: 01.02.2024<br><br>
                1.<b>Scope of Application</b><br>
                These Terms and Conditions (T&C) govern the use of the Mazuky.de website and all associated web and mobile apps (referred to as the "Website"). By using this Website, you agree to abide by the T&C. If you do not agree with the T&C, 
                you are prohibited from using the Website.<br><br>
                
                2.<b>Registration and Data Storage</b><br>
                To fully utilize the services of this Website, registration is required. The following data is collected and stored during registration:<br><br>
                - Username<br>
                - Email address<br>
                - Game data from "GuessTheAnime"<br>
                - Specific data from other associated websites, if the account is used on those<br><br>
                The collected data will only be used for sending promotional emails if a newsletter is subscribed to. The data will be treated in accordance with applicable data protection regulations and will not be disclosed to third parties unless 
                required by law.<br><br>
                
                3.<b>Account Deletion</b><br>
                Users have the right to delete their account at any time. To delete the account, please send an email with your username to info@guessthegame.net. Upon receiving your request, your data will be deleted unless there is a legal 
                obligation to retain it.<br><br>
                
                4.<b>Use of Google Analytics and Google Ads</b><br>
                This Website uses Google Analytics and Google Ads. By using the Website, you agree to the processing of your data by Google as described. The option to deactivate these services is not available.<br><br>
                
                5.<b>Linking to Third-Party Services</b><br>
                The Website may contain links to third-party services such as amazon.de (Prime Video), crunchyroll.com, netflix.com, and ko-fi.com. The operator assumes no liability for the content of these linked websites. 
                Users use these services at their own risk.<br><br>
                
                6.<b>Affiliate Links</b><br>
                Some links to external services, especially amazon.de (Prime Video), may be affiliate links. The use of affiliate links does not affect the price for the user and solely supports and maintains the Website.<br><br>
                
                7.<b>Data Privacy and Security</b><br>
                All personal data collected during the use of the Website will be treated confidentially. Users have the right to access, correct, delete, and block their data. The data will be deleted after termination of the account, unless there is a legal 
                obligation to store it.<br><br>
                
                8.<b>Limitation of Liability for External Content</b><br>
                The operator assumes no liability for the content available on linked third-party websites. Users use these services at their own risk and are subject to the terms of use and privacy policies of these providers. Claims against the third-party 
                provider must be made directly against them.<br><br>
                
                9.<b>Termination and Cessation</b><br>
                The operator reserves the right to change, suspend, or terminate the services of the Website at any time without prior notice. Users have the right to terminate their account and stop using the Website by following the instructions provided in the T&C. 
                Please note that the operator may also terminate the Website without notice.<br><br>
                
                10.<b>Jurisdiction and Applicable Law</b><br>
                The exclusive place of jurisdiction for all disputes arising from or in connection with these T&C is agreed to be the District Court of Dresden. The laws of the Federal Republic of Germany apply.<br>
                For questions or comments regarding these T&C, please contact us at info@mazuky.de.
            </p>
        </main>
        <footer></footer>
    </body>
</html>