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
        <link rel="manifest" href="/manifest.json">
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
            <span class="counter"><i>Anime #<span id="counter">0</span></i></span>
            <p class="count_new">NEW ANIME IN</p>
            <span id="countdown">23:59:59</span>
            <img id="img_01"src="" alt="Picture 1" class="image" width="512" height="288">
            <img id="img_02"src="" alt="Picture 2" class="hidden image" width="512" height="288">
            <img id="img_03"src="" alt="Picture 3" class="hidden image" width="512" height="288">
            <img id="img_04"src="" alt="Picture 4" class="hidden image" width="512" height="288">
            <img id="img_05"src="" alt="Picture 5" class="hidden image" width="512" height="288">
            <img id="img_06"src="" alt="Picture 6" class="hidden image" width="512" height="288">
            <span id="tipp" class="tipp" style="display:none;"></span>
            <div class="image_numer">
                <span class="number active" onclick="NextNumber(1)">1</span>
                <span class="number" onclick="NextNumber(2)">2</span>
                <span class="number" onclick="NextNumber(3)">3</span>
                <span class="number" onclick="NextNumber(4)">4</span>
                <span class="number" onclick="NextNumber(5)">5</span>
                <span class="number" onclick="NextNumber(6)">6</span>
                <span class="skip active" id="skip" onclick="enableNextNumber()">Skip?</span>
            </div>
            <span id="lose">6 guesses remaining!</span>
            <span id="win-nail" class="win-nail"></span>
            <span id="lose-nail" class="lose-nail"></span>
            <div id="winner" style="display:none;">
                <span class="answer">The answer was: </span>
                <span id="win-name" class="win-name"></span>
            </div>
            <div id="winner-english" style="display: none;">
                <span class="answer">English: </span>
                <span id="win-name-eng" class="win-name"></span>
            </div>
            <input placeholder="Search for an Anime..." type="text" id="searchInput" oninput="searchDatabase()">
            <div id="searchResults" class="results"></div>
            <button id="searchButtom" onclick="checkName()">Submit</button>
            <div id="guesses12" class="gess_results"></div>
            <div class="thanks_bar">
                <a class="other" id="Last">‹</a>
                <span class="thanx">
                    Thanx for Playing GuessTheAnime<br>
                    This Site is Created by Mazuky
                </span>
                <a class="other" id="Next">›</a>
            </div>
            <a class="go_home" href="https://guesstheanime.net/home/">
                Go to the overview of all games.
            </a>
            <div id="GameEnd">
                <div class="button-body son">
                    <a onclick="copyText()" class="share">Copy your try.</a>
                    <a id="twitter_share" href="" class="share" target="_blank">Share your try on Twitter</a>
                </div>
                <span class="stream">Watch on the following streaming services.</span>
                <ul class="stream-ul">
                    <li>
                        <a id="prime" href="" target=”_blank”>
                            <img src="https://www.guesstheanime.net/icon/prime-video.png" alt="Prime Video" class="stream-icon">
                            <div id="link-pr"></div>
                        </a>
                    </li>
                    <li>
                        <a id="crunchyroll" href="" target=”_blank”>
                            <img src="https://www.guesstheanime.net/icon/crunchyroll.png" alt="Crunchyroll" class="stream-icon">
                            <div id="link-cru"></div>
                        </a>
                    </li>
                    <li>
                        <a id="netflix" href="" target=”_blank”>
                            <img src="https://www.guesstheanime.net/icon/netflix.png" alt="Netflix" class="stream-icon">
                            <div id="link-net"></div>
                        </a>
                    </li>
                </ul>
                <span class="stream">The licenses/streams may vary depending on your region.</span>
                <p id="gtatext" class="sbut"></p>
                <div class="button-body">
                    <a id="sources" href="https://guesstheanime.net/sources/" class="share">See Screenshot Sources</a>
                </div>
            </div>
        </main>
        <footer></footer>
           
        <script>
            var englishNamevar = '';

            function searchDatabase() {
                const searchInput = document.getElementById('searchInput').value;
                const searchResults = document.getElementById('searchResults');
                const xhr = new XMLHttpRequest();

                const serverUrl = '/search.php';

                if (searchInput.trim().length <= 1) {
                    searchResults.innerHTML = '';
                    return;
                }

                xhr.open('GET', `${serverUrl}?query=${searchInput}`, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        displayResults(response);
                    }
                };

                xhr.send();
            }
            
            function displayResults(results) {
                const searchResults = document.getElementById('searchResults');
                searchResults.innerHTML = '';

                if (results.length === 0) {
                const noResults = document.createElement('div');
                noResults.textContent = 'No results found';
                searchResults.appendChild(noResults);
                } else {
                results.forEach(function (result) {
                    const container = document.createElement('div');
                    container.className = 'result-container';

                    const originalName = document.createElement('div');
                    originalName.textContent = result[0];
                    originalName.className = 'original-name';

                    const englishName = document.createElement('div');
                    englishName.textContent = result[1];
                    englishName.className = 'english-name';

                    container.appendChild(originalName);
                    container.appendChild(englishName);

                    container.addEventListener('click', function () {
                    document.getElementById('searchInput').value = result[0];
                    searchResults.innerHTML = '';

                    englishNamevar = result[1];

                    });
            
                    searchResults.appendChild(container);
                });
                }
            }

            const startDate = new Date('2024-02-01T00:00:00Z');
            
            const now = new Date();
            
            const timeDiff = now - startDate;
            const daysPassed = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            
            var game_id = daysPassed + 1;

            document.getElementById('counter').innerHTML = game_id;

            document.getElementById('img_01').src = "https://www.guesstheanime.net/picture/" + game_id + "/01_small.webp";
            document.getElementById('img_02').src = "https://www.guesstheanime.net/picture/" + game_id + "/02_small.webp";
            document.getElementById('img_03').src = "https://www.guesstheanime.net/picture/" + game_id + "/03_small.webp";
            document.getElementById('img_04').src = "https://www.guesstheanime.net/picture/" + game_id + "/04_small.webp";
            document.getElementById('img_05').src = "https://www.guesstheanime.net/picture/" + game_id + "/05_small.webp";
            document.getElementById('img_06').src = "https://www.guesstheanime.net/picture/" + game_id + "/06_small.webp";
            document.getElementById('sources').href = "https://guesstheanime.net/sources/" + game_id + "/";


            const xhr = new XMLHttpRequest();
            xhr.open('GET', '/getCorrectName.php?game_id=' + game_id, false);
            xhr.send();
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const correctName = response.correctName;
                const correctEngName = response.correctEngName;
                const tipp_1 = response.tipp_1;
                const tipp_2 = response.tipp_2;
                const tipp_3 = response.tipp_3;
                const tipp_4 = response.tipp_4;
                const tipp_5 = response.tipp_5;
                const stream2 = response.stream2;
                const stream3 = response.stream3;
                const stream4 = response.stream4;
                localStorage.setItem("correctName" + game_id, correctName);
                localStorage.setItem("correctEngName" + game_id, correctEngName);
                localStorage.setItem("tipp_1" + game_id, tipp_1);
                localStorage.setItem("tipp_2" + game_id, tipp_2);
                localStorage.setItem("tipp_3" + game_id, tipp_3 + " on IMDb");
                localStorage.setItem("tipp_4" + game_id, tipp_4);
                localStorage.setItem("tipp_5" + game_id, tipp_5);
                if(stream2){
                    document.getElementById('prime').href = stream2;
                    document.getElementById('link-pr').style.display = 'none';
                }
                if(stream3){
                    document.getElementById('crunchyroll').href = stream3;
                    document.getElementById('link-cru').style.display = 'none';
                }
                if(stream4){
                    document.getElementById('netflix').href = stream4;
                    document.getElementById('link-net').style.display = 'none';
                }
            } else {
                console.error('Error in the request: ' + xhr.status);
            }

            var currentNumber = 1;
            var Number = 1;
            var loseNumber = 6;
            var allUnlocked = false;
            var win = false;
            var correctName = localStorage.getItem("correctName" + game_id);
            var correctEnglishName = localStorage.getItem("correctEngName" + game_id);

            if (localStorage.getItem("currentNumber" + game_id)) {
                currentNumber = parseInt(localStorage.getItem("currentNumber"  + game_id));
                Number = parseInt(localStorage.getItem("Number"  + game_id));
                loseNumber = parseInt(localStorage.getItem("loseNumber"  + game_id));
                allUnlocked = localStorage.getItem("allUnlocked"  + game_id) === "true";
                win = localStorage.getItem("win"  + game_id) === "true";

                var numbers = document.querySelectorAll(".number");
                var images = document.querySelectorAll(".image");

                if(!win){
                    if(!allUnlocked){
                        var tipp_1 = localStorage.getItem("tipp_1" + game_id);
                        var tipp_2 = localStorage.getItem("tipp_2" + game_id);
                        var tipp_3 = localStorage.getItem("tipp_3" + game_id);
                        var tipp_4 = localStorage.getItem("tipp_4" + game_id);
                        var tipp_5 = localStorage.getItem("tipp_5" + game_id);
                        document.getElementById("lose").innerHTML = loseNumber + " guesses remaining!";

                        for (var i = 0; i < images.length; i++) {
                            images[i].classList.add("hidden");
                        }

                        images[Number - 1].classList.remove("hidden");

                        for (var i = 0; i < currentNumber; i++) {
                            numbers[i].classList.add("active");
                            numbers[i].classList.add("failed");
                        }

                        if(Number > 1){
                            document.getElementById("tipp").style.display = 'block';
                            if(Number == 2){document.getElementById("tipp").innerHTML = "Rating: " + tipp_1;
                            }else if(Number == 3){document.getElementById("tipp").innerHTML = "Original release: " + tipp_2;
                            }else if(Number == 4){document.getElementById("tipp").innerHTML = "Assessment: " + tipp_3 + " on IMDb";
                            }else if(Number == 5){document.getElementById("tipp").innerHTML = "Genre: " + tipp_4;
                            }else if(Number == 6){document.getElementById("tipp").innerHTML = "Studio: " + tipp_5;
                            }
                        }else{ 
                            document.getElementById("tipp").style.display = 'none';
                            document.getElementById("tipp").innerHTML = "";
                        }

                    }else{
                        document.getElementById("searchInput").style.display = 'none';
                        document.getElementById("searchButtom").style.display = 'none';
                        document.getElementById("lose").innerHTML = "";
                        document.getElementById("GameEnd").style.display = 'block';
                        var skip = document.querySelectorAll(".skip");
                        document.getElementById("skip").style.display = 'none';
                        var numbers = document.querySelectorAll(".number");
                        Number = 1;

                        document.getElementById("winner").style.display = 'flex';
                        document.getElementById("winner-english").style.display = 'flex';
                        document.getElementById("lose-nail").innerHTML = "Oh no! Better luck next time!";
                        document.getElementById("win-name").innerHTML = correctName;
                        document.getElementById("win-name-eng").innerHTML = correctEnglishName;

                        for (var i = 0; i < images.length; i++) {
                            images[i].classList.add("hidden");
                        }

                        images[Number - 1].classList.remove("hidden");

                        for (var i = 0; i < 6; i++) {
                            numbers[i].classList.add("active");
                            numbers[i].classList.add("failed");
                        }

                        var emofalse = "";
                        var emono = "";
                        var smi = "";
                        var emowin = localStorage.getItem("currentNumber" + game_id);
                        if(emowin >= 1){
                            for (var i = 1; i < emowin; i++) {
                                emofalse += "🟥";
                            }
                        }
                        if(emowin < 6){
                            for (var i = emowin; i < 6; i++) {
                                emono += "⬜️";
                            }
                        }
                        if(localStorage.getItem("win"  + game_id) === "true"){
                            smi = "😊 ";
                            emowin = "🟩";
                        }else{
                            smi = "😵 ";
                            emowin = "🟥";
                        }
                        

                        var emote = smi + emofalse + emowin + emono;
                        
                        var textToCopy = '#GuessTheAnime #' + game_id + ' ' + emote + ' https://www.guesstheanime.net/day/' + game_id;
                        document.getElementById("twitter_share").href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(textToCopy);

                    }
                }else{ 
                    var skip = document.querySelectorAll(".skip");
                    var numbers = document.querySelectorAll(".number");
                    var images = document.querySelectorAll(".image");

                    for (var i = 0; i < 6; i++) {
                        numbers[i].classList.add("active");
                        numbers[i].classList.add("failed");
                    };
                    
                    document.getElementById("skip").style.display = 'none';
                    document.getElementById("lose").style.display = 'none';
                    document.getElementById("winner").style.display = 'flex';
                    document.getElementById("winner-english").style.display = 'flex';
                    document.getElementById("win-nail").innerHTML = "You nailed it!";
                    document.getElementById("win-name").innerHTML = correctName;
                    document.getElementById("win-name-eng").innerHTML = correctEnglishName;
                    document.getElementById("searchInput").style.display = 'none';
                    document.getElementById("searchButtom").style.display = 'none';
                    document.getElementById("GameEnd").style.display = 'block';

                    if(currentNumber === 1){
                        numbers.forEach(function(number, index) {
                            number.classList.add("pastelWave");
                        });
                        skip.forEach(function(skip, index) {
                            skip.classList.add("pastelWave");
                        });
                    }else{
                        numbers[currentNumber -1].classList.add("win");
                        for (var i = currentNumber; i < 6; i++) {
                            numbers[i].classList.add("after");
                        }
                        for (var i = 0; i < currentNumber--; i++) {
                            numbers[i].classList.add("failed");
                        }
                    }

                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', '/info.php?enteredName=' + correctName, true);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);

                            const cgtatext = response.gta_text;
                            const cgta_prime_video = response.gta_prime_video;
                            const cgta_crunchyroll = response.gta_crunchyroll;
                            const cgta_netflix = response.gta_netflix;
                            const cgta_name = response.gta_name;

                            document.getElementById('gtatext').innerHTML = cgtatext;
                            document.getElementById('prime').href = cgta_prime_video;
                            document.getElementById('crunchyroll').href = cgta_crunchyroll;
                            document.getElementById('netflix').href = cgta_netflix;

                        } else {
                            console.error('Error in the request: ' + xhr.status);
                        }
                    };

                    xhr.send();

                    var emofalse = "";
                    var emono = "";
                    var smi = "";
                    var emowin = localStorage.getItem("currentNumber" + game_id);
                    if(emowin >= 1){
                        for (var i = 1; i < emowin; i++) {
                            emofalse += "🟥";
                        }
                    }
                    if(emowin < 6){
                        for (var i = emowin; i < 6; i++) {
                            emono += "⬜️";
                        }
                    }
                    if(localStorage.getItem("win"  + game_id) === "true"){
                        smi = "😊 ";
                        emowin = "🟩";
                    }else{
                        smi = "😵 ";
                        emowin = "🟥";
                    }
                    

                    var emote = smi + emofalse + emowin + emono;
                    
                    var textToCopy = '#GuessTheAnime #' + game_id + ' ' + emote + ' https://www.guesstheanime.net/day/' + game_id;
                    document.getElementById("twitter_share").href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(textToCopy);
                }
            }

            function enableNextNumber() {
                var skip = document.querySelectorAll(".skip");
                var numbers = document.querySelectorAll(".number");
                var images = document.querySelectorAll(".image");
                var tipp_1 = localStorage.getItem("tipp_1" + game_id);
                var tipp_2 = localStorage.getItem("tipp_2" + game_id);
                var tipp_3 = localStorage.getItem("tipp_3" + game_id);
                var tipp_4 = localStorage.getItem("tipp_4" + game_id);
                var tipp_5 = localStorage.getItem("tipp_5" + game_id);

                if(!win){
                    if (!allUnlocked) {
                        if (currentNumber < numbers.length) {
                            localStorage.setItem("allUnlocked" + game_id, "false");
                            localStorage.setItem("win" + game_id, "false");
                            numbers[currentNumber].classList.add("active");
                            numbers[currentNumber - 1].classList.add("failed");
                            images[currentNumber].classList.remove("hidden");
                            images[currentNumber - 1].classList.add("hidden");
                            images[Number - 1].classList.add("hidden");
                            currentNumber++;
                            loseNumber--;
                            document.getElementById("lose").innerHTML = loseNumber + " guesses remaining!";
                            Number = currentNumber;
                            if(Number > 1){
                                document.getElementById("tipp").style.display = 'block';
                                if(Number == 2){document.getElementById("tipp").innerHTML = "Rating: " + tipp_1;
                                }else if(Number == 3){document.getElementById("tipp").innerHTML = "Original release: " + tipp_2;
                                }else if(Number == 4){document.getElementById("tipp").innerHTML = "Assessment: " + tipp_3 + " on IMDb";
                                }else if(Number == 5){document.getElementById("tipp").innerHTML = "Genre: " + tipp_4;
                                }else if(Number == 6){document.getElementById("tipp").innerHTML = "Studio: " + tipp_5;
                                }
                            }else{ 
                                document.getElementById("tipp").style.display = 'none';
                                document.getElementById("tipp").innerHTML = "";
                            }

                            localStorage.setItem("currentNumber"  + game_id, currentNumber);
                            localStorage.setItem("Number"  + game_id, Number);
                            localStorage.setItem("loseNumber"  + game_id, loseNumber);

                            const container = document.createElement('div');
                            container.className = 'result-container-failed';
                    
                            const failXContainer = document.createElement('div');
                            failXContainer.innerHTML = '✕';
                            failXContainer.className = 'failX';

                            const helpContainer = document.createElement('div');
                            helpContainer.className = 'orig-eng';

                            const originalName = document.createElement('div');
                            originalName.innerHTML = "Skip";
                            originalName.className = 'original-name-failed';
                    
                            container.appendChild(failXContainer);
                            container.appendChild(helpContainer);
                            helpContainer.appendChild(originalName);
                            guesses12.appendChild(container);

                            var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
                            var incorrectGuesses = storedIncorrectGuesses ? JSON.parse(storedIncorrectGuesses) : [];
                            incorrectGuesses.push("Skip");
                            localStorage.setItem("incorrectGuesses"  + game_id, JSON.stringify(incorrectGuesses));
                        } else if (currentNumber === 6) {
                            allUnlocked = true;
                            document.getElementById("GameEnd").style.display = 'block';
                            document.getElementById("searchInput").style.display = 'none';
                            document.getElementById("searchButtom").style.display = 'none';
                            document.getElementById("lose").innerHTML = "";
                            document.getElementById("skip").style.display = 'none';
                            for (var i = 0; i < numbers.length; i++) {
                                numbers[i].classList.add("active");
                                numbers[i].classList.add("failed");
                            }
                            Number = 1;

                            localStorage.setItem("allUnlocked" + game_id, "true");
                            localStorage.setItem("win" + game_id, "false");

                            document.getElementById("winner").style.display = 'flex';
                            document.getElementById("winner-english").style.display = 'flex';
                            document.getElementById("lose-nail").innerHTML = "Oh no! Better luck next time!";
                            document.getElementById("win-name").innerHTML = correctName;
                            document.getElementById("win-name-eng").innerHTML = correctEnglishName;
                            
                            localStorage.setItem("currentNumber"  + game_id, currentNumber);
                            localStorage.setItem("Number"  + game_id, Number);
                            localStorage.setItem("loseNumber"  + game_id, loseNumber);

                            const container = document.createElement('div');
                            container.className = 'result-container-failed'; 
                    
                            const failXContainer = document.createElement('div');
                            failXContainer.innerHTML = '✕';
                            failXContainer.className = 'failX';

                            const helpContainer = document.createElement('div');
                            helpContainer.className = 'orig-eng';

                            const originalName = document.createElement('div');
                            originalName.innerHTML = "Skip";
                            originalName.className = 'original-name-failed'; 
                    
                            container.appendChild(failXContainer);
                            container.appendChild(helpContainer);
                            helpContainer.appendChild(originalName);
                            guesses12.appendChild(container);

                            var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
                            var incorrectGuesses = storedIncorrectGuesses ? JSON.parse(storedIncorrectGuesses) : [];
                            incorrectGuesses.push("Skip");
                            localStorage.setItem("incorrectGuesses"  + game_id, JSON.stringify(incorrectGuesses));

                            var emofalse = "";
                            var emono = "";
                            var smi = "";
                            var emowin = localStorage.getItem("currentNumber" + game_id);
                            if(emowin >= 1){
                                for (var i = 1; i < emowin; i++) {
                                    emofalse += "🟥";
                                }
                            }
                            if(emowin < 6){
                                for (var i = emowin; i < 6; i++) {
                                    emono += "⬜️";
                                }
                            }
                            if(localStorage.getItem("win"  + game_id) === "true"){
                                smi = "😊 ";
                                emowin = "🟩";
                            }else{
                                smi = "😵 ";
                                emowin = "🟥";
                            }
                            

                            var emote = smi + emofalse + emowin + emono;
                            
                            var textToCopy = '#GuessTheAnime #' + game_id + ' ' + emote + ' https://www.guesstheanime.net/day/' + game_id;
                            document.getElementById("twitter_share").href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(textToCopy);
                        }
                    }
                }
            }

            function NextNumber(num) {
                allUnlocked = localStorage.getItem("allUnlocked"  + game_id) === "true";
                win = localStorage.getItem("win"  + game_id) === "true";
                var numbers = document.querySelectorAll(".number");
                var images = document.querySelectorAll(".image");
                var tipp_1 = localStorage.getItem("tipp_1" + game_id);
                var tipp_2 = localStorage.getItem("tipp_2" + game_id);
                var tipp_3 = localStorage.getItem("tipp_3" + game_id);
                var tipp_4 = localStorage.getItem("tipp_4" + game_id);
                var tipp_5 = localStorage.getItem("tipp_5" + game_id);
                if(win){
                    var save = currentNumber;
                    currentNumber = 6;
                    if (currentNumber >= num) {
                        for (var i = 0; i < 6; i++) {
                            images[i].classList.add("hidden");
                        }
                        images[Number - 1].classList.add("hidden");
                        images[num - 1].classList.remove("hidden");
                        Number = num;
                        if(Number > 1){
                            document.getElementById("tipp").style.display = 'block';
                            if(Number == 2){document.getElementById("tipp").innerHTML = "Rating: " + tipp_1;
                            }else if(Number == 3){document.getElementById("tipp").innerHTML = "Original release: " + tipp_2;
                            }else if(Number == 4){document.getElementById("tipp").innerHTML = "Assessment: " + tipp_3 + " on IMDb";
                            }else if(Number == 5){document.getElementById("tipp").innerHTML = "Genre: " + tipp_4;
                            }else if(Number == 6){document.getElementById("tipp").innerHTML = "Studio: " + tipp_5;
                            }
                        }else{ 
                            document.getElementById("tipp").style.display = 'none';
                            document.getElementById("tipp").innerHTML = "";
                        }
                    }
                    currentNumber = save;
                }else{   
                    if (!allUnlocked) {
                        if (currentNumber >= num) {
                            images[Number - 1].classList.add("hidden");
                            images[num - 1].classList.remove("hidden");
                            Number = num;
                            if(Number > 1){
                                document.getElementById("tipp").style.display = 'block';
                                if(Number == 2){document.getElementById("tipp").innerHTML = "Rating: " + tipp_1;
                                }else if(Number == 3){document.getElementById("tipp").innerHTML = "Original release: " + tipp_2;
                                }else if(Number == 4){document.getElementById("tipp").innerHTML = "Assessment: " + tipp_3 + " on IMDb";
                                }else if(Number == 5){document.getElementById("tipp").innerHTML = "Genre: " + tipp_4;
                                }else if(Number == 6){document.getElementById("tipp").innerHTML = "Studio: " + tipp_5;
                                }
                            }else{ 
                                document.getElementById("tipp").style.display = 'none';
                                document.getElementById("tipp").innerHTML = "";
                            }

                            localStorage.setItem("Number" + game_id, Number);
                        }
                    }else{
                        var save = currentNumber;
                        currentNumber = 6;
                        if (currentNumber >= num) {
                            for (var i = 0; i < 6; i++) {
                                images[i].classList.add("hidden");
                            }
                            images[Number - 1].classList.add("hidden");
                            images[num - 1].classList.remove("hidden");
                            Number = num;
                            if(Number > 1){
                            document.getElementById("tipp").style.display = 'block';
                            if(Number == 2){document.getElementById("tipp").innerHTML = "Rating: " + tipp_1;
                            }else if(Number == 3){document.getElementById("tipp").innerHTML = "Original release: " + tipp_2;
                            }else if(Number == 4){document.getElementById("tipp").innerHTML = "Assessment: " + tipp_3 + " on IMDb";
                            }else if(Number == 5){document.getElementById("tipp").innerHTML = "Genre: " + tipp_4;
                            }else if(Number == 6){document.getElementById("tipp").innerHTML = "Studio: " + tipp_5;
                            }
                        }else{ 
                            document.getElementById("tipp").style.display = 'none';
                            document.getElementById("tipp").innerHTML = "";
                        }
                        }
                        currentNumber = save;

                        var emofalse = "";
                        var emono = "";
                        var smi = "";
                        var emowin = localStorage.getItem("currentNumber" + game_id);
                        if(emowin >= 1){
                            for (var i = 1; i < emowin; i++) {
                                emofalse += "🟥";
                            }
                        }
                        if(emowin < 6){
                            for (var i = emowin; i < 6; i++) {
                                emono += "⬜️";
                            }
                        }
                        if(localStorage.getItem("win"  + game_id) === "true"){
                            smi = "😊 ";
                            emowin = "🟩";
                        }else{
                            smi = "😵 ";
                            emowin = "🟥";
                        }
                        

                        var emote = smi + emofalse + emowin + emono;
                        
                        var textToCopy = '#GuessTheAnime #' + game_id + ' ' + emote + ' https://www.guesstheanime.net/day/' + game_id;
                        document.getElementById("twitter_share").href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(textToCopy);
                    }
                }
            }

            function checkName() {
                var skip = document.querySelectorAll(".skip");
                var numbers = document.querySelectorAll(".number");
                var images = document.querySelectorAll(".image");

                var enteredName = document.getElementById("searchInput").value;                

                if (enteredName === correctName) {
                    win = true;
                    
                    localStorage.setItem("currentNumber"  + game_id, currentNumber);
                    localStorage.setItem("Number"  + game_id, Number);
                    localStorage.setItem("loseNumber"  + game_id, loseNumber);
                    localStorage.setItem("allUnlocked"  + game_id, "true");
                    localStorage.setItem("win"  + game_id, "true");

                    for (var i = 0; i < 6; i++) {
                        numbers[i].classList.add("active");
                        numbers[i].classList.add("failed");
                    };
                    document.getElementById("skip").style.display = 'none';
                    document.getElementById("lose").style.display = 'none';
                    document.getElementById("winner").style.display = 'flex';
                    document.getElementById("winner-english").style.display = 'flex';
                    document.getElementById("win-nail").innerHTML = "You nailed it!";
                    document.getElementById("win-name").innerHTML = correctName;
                    document.getElementById("win-name-eng").innerHTML = correctEnglishName;
                    document.getElementById("searchInput").style.display = 'none';
                    document.getElementById("searchButtom").style.display = 'none';
                    document.getElementById("GameEnd").style.display = 'block';

                    var emofalse = "";
                    var emono = "";
                    var smi = "";
                    var emowin = localStorage.getItem("currentNumber" + game_id);
                    if(emowin >= 1){
                        for (var i = 1; i < emowin; i++) {
                            emofalse += "🟥";
                        }
                    }
                    if(emowin < 6){
                        for (var i = emowin; i < 6; i++) {
                            emono += "⬜️";
                        }
                    }
                    if(localStorage.getItem("win"  + game_id) === "true"){
                        smi = "😊 ";
                        emowin = "🟩";
                    }else{
                        smi = "😵 ";
                        emowin = "🟥";
                    }
                    

                    var emote = smi + emofalse + emowin + emono;
                    
                    var textToCopy = '#GuessTheAnime #' + game_id + ' ' + emote + ' https://www.guesstheanime.net/day/' + game_id;
                    document.getElementById("twitter_share").href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(textToCopy);

                    if(currentNumber === 1){
                        numbers.forEach(function(number, index) {
                            number.classList.add("pastelWave");
                        });
                        skip.forEach(function(skip, index) {
                            skip.classList.add("pastelWave");
                        });
                    }else{
                        numbers[currentNumber -1].classList.add("win");
                        for (var i = currentNumber; i < 6; i++) {
                            numbers[i].classList.add("after");
                        }
                        for (var i = 0; i < currentNumber--; i++) {
                            numbers[i].classList.add("failed");
                        }
                    }

                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', '/info.php?enteredName=' + correctName, true);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            const cgtatext = response.gta_text;
                            const cgta_prime_video = response.gta_prime_video;
                            const cgta_crunchyroll = response.gta_crunchyroll;
                            const cgta_netflix = response.gta_netflix;
                            const cgta_name = response.gta_name;

                            document.getElementById('gtatext').innerHTML = cgtatext;
                            document.getElementById('prime').href = cgta_prime_video;
                            document.getElementById('crunchyroll').href = cgta_crunchyroll;
                            document.getElementById('netflix').href = cgta_netflix;

                        } else {
                            console.error('Error in the request: ' + xhr.status);
                        }
                    };

                    xhr.send();
                    
                } else if (enteredName.trim() !== "") {
                    var skip = document.querySelectorAll(".skip");
                    var numbers = document.querySelectorAll(".number");
                    var images = document.querySelectorAll(".image");

                    if (!allUnlocked) {
                        if (currentNumber < numbers.length) {
                            numbers[currentNumber].classList.add("active");
                            numbers[currentNumber - 1].classList.add("failed");
                            images[currentNumber].classList.remove("hidden");
                            images[currentNumber - 1].classList.add("hidden");
                            images[Number - 1].classList.add("hidden");
                            currentNumber++;
                            loseNumber--;
                        
                            const container = document.createElement('div');
                            container.className = 'result-container-failed';
                    
                            const failXContainer = document.createElement('div');
                            failXContainer.innerHTML = '✕';
                            failXContainer.className = 'failX';

                            const helpContainer = document.createElement('div');
                            helpContainer.className = 'orig-eng';

                            const originalName = document.createElement('div');
                            originalName.innerHTML = enteredName;
                            originalName.className = 'original-name-failed';
                    
                            container.appendChild(failXContainer);
                            container.appendChild(helpContainer);
                            helpContainer.appendChild(originalName);
                            guesses12.appendChild(container);

                            const xhr = new XMLHttpRequest();
                            xhr.open('GET', '/fail.php?enteredName=' + enteredName, true);

                            xhr.onload = function () {
                                if (xhr.status === 200) {
                                    const response = JSON.parse(xhr.responseText);
                                    const gtaNameEng = response.gtaNameEng;
                                    const gtaNameEngElement = document.createElement('div');
                                    gtaNameEngElement.innerHTML = gtaNameEng;
                                    gtaNameEngElement.className = 'english-name-failed';
                                    helpContainer.appendChild(gtaNameEngElement);
                                } else {
                                    console.error('Error in the request: ' + xhr.status);
                                }
                            };

                            xhr.send();

                            var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
                            var incorrectGuesses = storedIncorrectGuesses ? JSON.parse(storedIncorrectGuesses) : [];
                            incorrectGuesses.push(enteredName);
                            localStorage.setItem("incorrectGuesses"  + game_id, JSON.stringify(incorrectGuesses));

                            document.getElementById("lose").innerHTML = loseNumber + " guesses remaining!";
                            Number = currentNumber;

                            localStorage.setItem("currentNumber"  + game_id, currentNumber);
                            localStorage.setItem("Number"  + game_id, Number);
                            localStorage.setItem("loseNumber"  + game_id, loseNumber);
                        } else if (currentNumber === 6) {
                            allUnlocked = true;
                            document.getElementById("GameEnd").style.display = 'block';
                            document.getElementById("searchInput").style.display = 'none';
                            document.getElementById("searchButtom").style.display = 'none';
                            document.getElementById("lose").innerHTML = "";
                            document.getElementById("skip").style.display = 'none';
                            for (var i = 0; i < 6; i++) {
                                numbers[i].classList.add("active");
                                numbers[i].classList.add("failed");
                            }
                            Number = 1;

                            document.getElementById("winner").style.display = 'flex';
                            document.getElementById("winner-english").style.display = 'flex';
                            document.getElementById("lose-nail").innerHTML = "Oh no! Better luck next time!";
                            document.getElementById("win-name").innerHTML = correctName;
                            document.getElementById("win-name-eng").innerHTML = correctEnglishName;
                            
                            localStorage.setItem("allUnlocked" + game_id, "true");

                            const container = document.createElement('div');
                            container.className = 'result-container-failed'; 
                    
                            const failXContainer = document.createElement('div');
                            failXContainer.innerHTML = '✕';
                            failXContainer.className = 'failX';

                            const helpContainer = document.createElement('div');
                            helpContainer.className = 'orig-eng';

                            const originalName = document.createElement('div');
                            originalName.innerHTML = enteredName;
                            originalName.className = 'original-name-failed'; 
                    
                            container.appendChild(failXContainer);
                            container.appendChild(helpContainer);
                            helpContainer.appendChild(originalName);
                            guesses12.appendChild(container);

                            const xhr = new XMLHttpRequest();
                            xhr.open('GET', '/info.php?enteredName=' + correctName, true);

                            xhr.onload = function () {
                                if (xhr.status === 200) {
                                    const response = JSON.parse(xhr.responseText);
                                    const cgtatext = response.gta_text;
                                    const cgta_prime_video = response.gta_prime_video;
                                    const cgta_crunchyroll = response.gta_crunchyroll;
                                    const cgta_netflix = response.gta_netflix;
                                    const cgta_name = response.gta_name;

                                    document.getElementById('gtatext').innerHTML = cgtatext;
                                    document.getElementById('prime').href = cgta_prime_video;
                                    document.getElementById('crunchyroll').href = cgta_crunchyroll;
                                    document.getElementById('netflix').href = cgta_netflix;

                                } else {
                                    console.error('Error in the request: ' + xhr.status);
                                }
                            };

                            xhr.send();

                            var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
                            var incorrectGuesses = storedIncorrectGuesses ? JSON.parse(storedIncorrectGuesses) : [];
                            incorrectGuesses.push(enteredName);
                            localStorage.setItem("incorrectGuesses"  + game_id, JSON.stringify(incorrectGuesses));

                            var emofalse = "";
                            var emono = "";
                            var smi = "";
                            var emowin = localStorage.getItem("currentNumber" + game_id);
                            if(emowin >= 1){
                                for (var i = 1; i < emowin; i++) {
                                    emofalse += "🟥";
                                }
                            }
                            if(emowin < 6){
                                for (var i = emowin; i < 6; i++) {
                                    emono += "⬜️";
                                }
                            }
                            if(localStorage.getItem("win"  + game_id) === "true"){
                                smi = "😊 ";
                                emowin = "🟩";
                            }else{
                                smi = "😵 ";
                                emowin = "🟥";
                            }
                            

                            var emote = smi + emofalse + emowin + emono;
                            
                            var textToCopy = '#GuessTheAnime #' + game_id + ' ' + emote + ' https://www.guesstheanime.net/day/' + game_id;
                            document.getElementById("twitter_share").href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(textToCopy);
                        }
                    }

                    document.getElementById("searchInput").value = "";
                    enteredName = document.getElementById("searchInput").value;
                }
            } 

            function copyText() {
                var emofalse = "";
                var emono = "";
                var smi = "";
                var emowin = localStorage.getItem("currentNumber" + game_id);
                if(emowin >= 1){
                    for (var i = 1; i < emowin; i++) {
                        emofalse += "🟥";
                    }
                }
                if(emowin < 6){
                    for (var i = emowin; i < 6; i++) {
                        emono += "⬜️";
                    }
                }
                if(localStorage.getItem("win"  + game_id) === "true"){
                    smi = "😊 ";
                    emowin = "🟩";
                }else{
                    smi = "😵 ";
                    emowin = "🟥";
                }
                

                var emote = smi + emofalse + emowin + emono;
                
                var textToCopy = '#GuessTheAnime #' + game_id + ' ' + emote + ' https://www.guesstheanime.net/day/' + game_id;
                navigator.clipboard.writeText(textToCopy)
                console.log(textToCopy);

            }

            window.onload = function () {
                var enteredName = "";
                document.getElementById("searchInput").value = "";
                if (localStorage.getItem("resetProgress"  + game_id)) {
                    localStorage.removeItem("currentNumber"  + game_id);
                    localStorage.removeItem("Number"  + game_id);
                    localStorage.removeItem("loseNumber"  + game_id);
                    localStorage.removeItem("allUnlocked"  + game_id);
                    localStorage.removeItem("resetProgress"  + game_id);
                }
        
                if(game_id < 0){
                    var next = game_id + 1;
                    document.getElementById("Next").style.color = 'white';
                    document.getElementById("Next").style.border = 'white 1px solid';
                    document.getElementById("Next").style.cursor = 'pointer';
                    document.getElementById("Next").href = "https://guesstheanime.net/day/" + next;
                }else{
                    document.getElementById("Next").style.color = '#373737';
                    document.getElementById("Next").style.border = '#373737 1px solid';
                    document.getElementById("Next").style.cursor = 'default'; 
                }

                if(game_id > 1){
                    var last = game_id - 1;
                    document.getElementById("Last").style.color = 'white';
                    document.getElementById("Last").style.border = 'white 1px solid';
                    document.getElementById("Last").style.cursor = 'pointer';
                    document.getElementById("Last").href = "https://guesstheanime.net/day/" + last;
                }else{
                    document.getElementById("Last").style.color = '#373737';
                    document.getElementById("Last").style.border = '#373737 1px solid';
                    document.getElementById("Last").style.cursor = 'default';
                }

                var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
                if (storedIncorrectGuesses) {
                    var incorrectGuesses = JSON.parse(storedIncorrectGuesses);
                    var guesses12 = document.getElementById("guesses12");

                    incorrectGuesses.forEach(function (guess) {
                        const container = document.createElement("div");
                        container.className = 'result-container-failed';

                        const failXContainer = document.createElement('div');
                        failXContainer.innerHTML = '✕';
                        failXContainer.className = 'failX';

                        const helpContainer = document.createElement('div');
                        helpContainer.className = 'orig-eng';

                        const originalName = document.createElement('div');
                        originalName.className = 'original-name-failed';
                        originalName.innerHTML = guess;

                        container.appendChild(failXContainer);
                        container.appendChild(helpContainer);
                        helpContainer.appendChild(originalName);
                        guesses12.appendChild(container);

                        if(guess != "Skip"){
                            const xhr = new XMLHttpRequest();
                            xhr.open('GET', '/fail.php?enteredName=' + guess, true);

                            xhr.onload = function () {
                                if (xhr.status === 200) {
                                    const response = JSON.parse(xhr.responseText);
                                    const gtaNameEng = response.gtaNameEng;
                                    const gtaNameEngElement = document.createElement('div');
                                    gtaNameEngElement.innerHTML = gtaNameEng;
                                    gtaNameEngElement.className = 'english-name-failed';
                                    helpContainer.appendChild(gtaNameEngElement);
                                } else {
                                    console.error('Error in the request: ' + xhr.status);
                                }
                            };
                            xhr.send();
                        }
                    });
                }

                var correctName = localStorage.getItem("correctName" + game_id);
                const xhr = new XMLHttpRequest();
                xhr.open('GET', '/info.php?enteredName=' + correctName, true);

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        const cgtatext = response.gta_text;
                        const cgta_prime_video = response.gta_prime_video;
                        const cgta_crunchyroll = response.gta_crunchyroll;
                        const cgta_netflix = response.gta_netflix;
                        const cgta_name = response.gta_name;

                        document.getElementById('gtatext').innerHTML = cgtatext;
                        document.getElementById('prime').href = cgta_prime_video;
                        document.getElementById('crunchyroll').href = cgta_crunchyroll;
                        document.getElementById('netflix').href = cgta_netflix;

                    } else {
                        console.error('Error in the request: ' + xhr.status);
                    }
                };

                xhr.send();
            }
        </script>
        <script>
            function updateCountdown() {
                const now = new Date();
                const nowUTC = new Date(now.toUTCString());
                const targetTime = new Date(nowUTC);
                targetTime.setUTCHours(24, 0, 0, 0);

                const timeDifference = targetTime - nowUTC;
                const hours = Math.floor(timeDifference / 3600000);
                const minutes = Math.floor((timeDifference % 3600000) / 60000);
                const seconds = Math.floor((timeDifference % 60000) / 1000);

                const countdownElement = document.getElementById("countdown");
                countdownElement.innerHTML = `${hours.toString().padStart(2, '0')} : ${minutes.toString().padStart(2, '0')} : ${seconds.toString().padStart(2, '0')}`;
            }

            setInterval(updateCountdown, 1000);

            updateCountdown();
        </script>
    </body>
</html>