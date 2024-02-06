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
            <title>GuessTheAnime | Home - Challenge your friends</title>
            <meta name="author" content="Mazuky">
            <meta name="copyright" content="Mazuky">
            <meta name="robots" content="index,follow">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Explore the world of Japanese animation with our Guess the Anime game! Test your knowledge, challenge your friends, and immerse yourself in the vibrant universe of anime and manga. Play now for a fun and exciting experience in guessing your favorite anime series and characters. Are you an anime expert? Find out and enjoy the ultimate anime quiz adventure on our site!">
            <meta name="keywords" content="Anime, guesstheanime, guessanime, season, japan, crunchyroll, animeguess, guessgame, guess anime, anime guess, guess the anime, Anime Quiz, Japanese Animation, Manga Puzzles, Otaku Games, Guess the Character, Anime Trivia, Japanese Cartoons, Anime Fan Game, Anime Quiz Game, Guess the Anime Series, Otaku Challenge, Manga Entertainment, Japanese Animation Puzzles, Anime Knowledge, Character Identification Game, Japanese Animation Quiz, Anime Fan Puzzles, Manga Fan Game, Guess the Series, dr. stone, Attack on Titan, Shingeki no Kyojin, Demon Slayer, Kimetsu no Yaiba, My Hero Academia, Boku no Hero Academia, One Punch Man, Jujutsu Kaisen, Death Note, One Piece, Naruto, Tokyo Ghoul">
            <link rel="canonical" href="https://www.guesstheanime.net/">
            <link rel="stylesheet" href="https://www.guesstheanime.net/style.css">
        </head>
        <body>
        <?php include ($_SERVER['DOCUMENT_ROOT']."/header.php");?>
        <main>
            <div class="anime-list">
                <div id="pagination-top">
                    <button id="prev-page-top" disabled>&lt; Vorherige Seite</button>
                    <span id="page-info-top"></span>
                    <button id="next-page-top">Nächste Seite &gt;</button>
                </div>
                <ul id="anime-items">
                    <!-- Hier werden die Anime-Einträge hinzugefügt -->
                </ul>
                <div id="pagination">
                    <button id="prev-page" disabled>&lt; Vorherige Seite</button>
                    <span id="page-info"></span>
                    <button id="next-page">Nächste Seite &gt;</button>
                </div>
            </div>
        </main>
        <footer></footer>
    </body>
</html>
<script>
    const startDate = new Date('2024-02-01T00:00:00Z');
            
    const now = new Date();
    const timeDiff = now - startDate;
    const daysPassed = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
    
    var game_max = daysPassed + 1;
 
    const itemsPerPage = 25;
    let currentPage = 1;
    let totalPages = 1;
    let page = 1;

    const animeItems = document.getElementById("anime-items");
    const prevPageButton = document.getElementById("prev-page");
    const nextPageButton = document.getElementById("next-page");
    const prevPageButtonTop = document.getElementById("prev-page-top");
    const nextPageButtonTop = document.getElementById("next-page-top");
    const pageInfo = document.getElementById("page-info");
    const pageInfoTop = document.getElementById("page-info-top");

    let animeList = [];

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "anime_list.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            animeList = JSON.parse(xhr.responseText);
            animeList = animeList.slice(0, game_max);
            currentPage = 1;
            displayAnimeList(currentPage);
            updatePaginationButtons();
        }
    };
    xhr.send();




    function displayAnimeList(page) {
        var animeItems = document.getElementById("anime-items");
        animeItems.innerHTML = "";

        const from = (page - 1) * itemsPerPage + 1;
        const to = Math.min(page * itemsPerPage, animeList.length);
        
        for (var i = from - 1; i < to; i++) {
            var game_id = animeList[i];
            var isGuessed = localStorage.getItem("win" + game_id) === "true";
            var isCorrectGuess = localStorage.getItem("currentNumber" + game_id) === localStorage.getItem("Number" + game_id);
            var allUnlocked = localStorage.getItem("allUnlocked" + game_id) === "true";
            var win = localStorage.getItem("win" + game_id) === "true";
            var currentNumber = parseInt(localStorage.getItem("currentNumber" + game_id));

            var animeEntry = document.createElement("li");
            animeEntry.className = "anime-entry";

            var aElement = document.createElement("a");
            aElement.href = 'https://guesstheanime.net/day/' + game_id;
            aElement.className = "box-a";

            var playText = document.createTextNode("Play Day #" + game_id);
            aElement.appendChild(playText);

            for (var j = 0; j < 6; j++) {
                var questionMark = document.createElement("div");
                questionMark.className = "number question-no";
                aElement.appendChild(questionMark);
                var playText = document.createTextNode("?");
                questionMark.appendChild(playText);
            }

            animeEntry.appendChild(aElement);
            animeItems.appendChild(animeEntry);

            currentNumber = parseInt(localStorage.getItem("currentNumber"  + game_id));
            Number = parseInt(localStorage.getItem("Number"  + game_id));
            loseNumber = parseInt(localStorage.getItem("loseNumber"  + game_id));
            allUnlocked = localStorage.getItem("allUnlocked"  + game_id) === "true";
            win = localStorage.getItem("win"  + game_id) === "true";
            localStorage.getItem("allUnlocked"  + game_id) === "true";


            if (!win) {
                var numbers = animeEntry.querySelectorAll(".number");

                if (allUnlocked) {
                    for (var k = 0; k < 6; k++) {
                        numbers[k].classList.add("question-not");
                        numbers[k].innerHTML = '';
                    };
                }else{
                    for (var k = 0; k < currentNumber - 1; k++) {
                        numbers[k].classList.add("question-not");
                        numbers[k].innerHTML = '';
                    }
                    for (var k = currentNumber - 1; k < 6; k++) {
                        numbers[k].classList.add("question-no");
                    }
                }
            } else {
                var numbers = animeEntry.querySelectorAll(".number");

                if (currentNumber === 1) {
                    for (var k = 0; k < 6; k++) {
                        numbers[k].classList.add("pastelWave");
                        numbers[k].innerHTML = '';
                    };
                } else {
                    for (var k = 0; k < currentNumber - 1; k++) {
                        numbers[k].classList.add("question-not");
                        numbers[k].innerHTML = '';
                    }
                    numbers[currentNumber -1].classList.add("question-make");
                    numbers[currentNumber -1].innerHTML = '';
                    for (var k = currentNumber; k < 6; k++) {
                        numbers[k].classList.add("question-no");
                        numbers[k].innerHTML = '';
                    }
                }
            }
        }
    }






    function updatePaginationButtons() {
        totalPages = Math.ceil(animeList.length / itemsPerPage);
        prevPageButton.disabled = currentPage === 1;
        nextPageButton.disabled = currentPage === totalPages;
        prevPageButtonTop.disabled = currentPage === 1;
        nextPageButtonTop.disabled = currentPage === totalPages;
        const from = (currentPage - 1) * itemsPerPage + 1;
        const to = Math.min(currentPage * itemsPerPage, animeList.length);
        pageInfo.textContent = `Seite ${currentPage} (${from}-${to})`;
        pageInfoTop.textContent = `Seite ${currentPage} (${from}-${to})`;
    }

    prevPageButton.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayAnimeList(currentPage);
            updatePaginationButtons();
        }
    });

    nextPageButton.addEventListener("click", () => {
        if (currentPage < Math.ceil(animeList.length / itemsPerPage)) {
            currentPage++;
            displayAnimeList(currentPage);
            updatePaginationButtons();
        }
    });

    prevPageButtonTop.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayAnimeList(currentPage);
            updatePaginationButtons();
        }
    });

    nextPageButtonTop.addEventListener("click", () => {
        if (currentPage < Math.ceil(animeList.length / itemsPerPage)) {
            currentPage++;
            displayAnimeList(currentPage);
            updatePaginationButtons();
        }
    });

    displayAnimeList(currentPage);
    updatePaginationButtons();
</script>
