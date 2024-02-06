    var englishNamevar = '';

    function searchDatabase() {
    const searchInput = document.getElementById('searchInput').value;
    const searchResults = document.getElementById('searchResults');
    const xhr = new XMLHttpRequest(); // Hier deklarieren Sie xhr

    // Hier kannst du den Pfad zur Server-Seite angeben, die die Datenbankabfrage durchführt.
    // Stelle sicher, dass die Server-Seite die eingegebene Suchanfrage verarbeitet und die Ergebnisse zurückgibt.
    const serverUrl = '/search.php'; // Beispiel: 'search.php'

    if (searchInput.trim().length <= 3) {
        searchResults.innerHTML = '';
        return;
    }

    // Sende eine AJAX-Anfrage an den Server
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
        searchResults.innerHTML = ''; // Leere das vorherige Ergebnis

        if (results.length === 0) {
        const noResults = document.createElement('div');
        noResults.textContent = 'Kein Treffer';
        searchResults.appendChild(noResults);
        } else {
        results.forEach(function (result) {
            const container = document.createElement('div');
            container.className = 'result-container'; // Füge eine CSS-Klasse hinzu (für das Styling)

            const originalName = document.createElement('div');
            originalName.textContent = result[0];
            originalName.className = 'original-name'; // Füge eine CSS-Klasse hinzu (für das Styling)

            const englishName = document.createElement('div');
            englishName.textContent = result[1];
            englishName.className = 'english-name'; // Füge eine CSS-Klasse hinzu (für das Styling)

            container.appendChild(originalName);
            container.appendChild(englishName);

            container.addEventListener('click', function () {
            document.getElementById('searchInput').value = result[0]; // Setze den Originalnamen beim Klicken
            searchResults.innerHTML = ''; // Ergebnisliste nach der Auswahl ausblenden

            englishNamevar = result[1];

            });
    
            searchResults.appendChild(container);
        });
        }
    }

    // Datum und Zeit für den Startpunkt festlegen (31.10.23 00:00 UTC)
    const startDate = new Date('2023-11-21T00:00:00Z');
    
    // Funktion, um den Zähler zu aktualisieren
    const now = new Date();
    
    // Berechnen Sie die Differenz in Tagen zwischen dem aktuellen Datum und dem Startdatum
    const timeDiff = now - startDate;
    const daysPassed = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
    
    var game_id = daysPassed + 1;

    // Aktualisieren Sie den Zähler
    document.getElementById('counter').innerHTML = game_id;

    document.getElementById('img_01').src = "https://www.guesstheanime.net/picture/" + game_id + "/01_small.webp";
    document.getElementById('img_02').src = "https://www.guesstheanime.net/picture/" + game_id + "/02_small.webp";
    document.getElementById('img_03').src = "https://www.guesstheanime.net/picture/" + game_id + "/03_small.webp";
    document.getElementById('img_04').src = "https://www.guesstheanime.net/picture/" + game_id + "/04_small.webp";
    document.getElementById('img_05').src = "https://www.guesstheanime.net/picture/" + game_id + "/05_small.webp";
    document.getElementById('img_06').src = "https://www.guesstheanime.net/picture/" + game_id + "/06_small.webp";


    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/getCorrectName.php?game_id=' + game_id, false);
    xhr.send();
    if (xhr.status === 200) {
        const correctName = xhr.responseText;
        localStorage.setItem("correctName" + game_id, correctName);
    } else {
        console.error('Fehler bei der Anfrage: ' + xhr.status);
    }

    var currentNumber = 1;
    var Number = 1;
    var loseNumber = 6;
    var allUnlocked = false;
    var win = false;
    var correctName = localStorage.getItem("correctName" + game_id);

    // Check if there is saved progress in local storage
    if (localStorage.getItem("currentNumber" + game_id)) {
        currentNumber = parseInt(localStorage.getItem("currentNumber"  + game_id));
        Number = parseInt(localStorage.getItem("Number"  + game_id));
        loseNumber = parseInt(localStorage.getItem("loseNumber"  + game_id));
        allUnlocked = localStorage.getItem("allUnlocked"  + game_id) === "true";
        win = localStorage.getItem("win"  + game_id) === "true";

        // Restore the UI based on saved progress
        var numbers = document.querySelectorAll(".number");
        var images = document.querySelectorAll(".image");

        if(!win){
            document.getElementById("winner").style.display = 'flex';
            document.getElementById("lose-nail").innerHTML = "Oh no! Better luck next time!";
            document.getElementById("win-name").innerHTML = correctName;
            // Hide all images
            for (var i = 0; i < images.length; i++) {
                images[i].classList.add("hidden");
            }

            // Show the correct image
            images[Number - 1].classList.remove("hidden");

            // Set the active state for number buttons
            for (var i = 0; i < currentNumber; i++) {
                numbers[i].classList.add("active");
            }

            document.getElementById("lose").innerHTML = loseNumber + " guesses remaining!";

            if (allUnlocked) {
                document.getElementById("searchInput").style.display = 'none';
                document.getElementById("searchButtom").style.display = 'none';
                document.getElementById("lose").innerHTML = "";
                document.getElementById("GameEnd").style.display = 'block';
                var skip = document.querySelectorAll(".skip");
                document.getElementById("skip").style.display = 'none';
                var numbers = document.querySelectorAll(".number");
                for (var i = 0; i < numbers.length; i++) {
                    numbers[i].classList.remove("active");
                }
                Number = 1;
            }
        }else{
            var skip = document.querySelectorAll(".skip");
            var numbers = document.querySelectorAll(".number");
            var images = document.querySelectorAll(".image");
            
            for (var i = 0; i < 6; i++) {
                numbers[i].classList.add("active");
            }
            document.getElementById("skip").style.display = 'none';
            document.getElementById("lose").style.display = 'none';
            document.getElementById("winner").style.display = 'flex';
            document.getElementById("win-nail").innerHTML = "You nailed it!";
            document.getElementById("win-name").innerHTML = correctName;
            document.getElementById("searchInput").style.display = 'none';
            document.getElementById("searchButtom").style.display = 'none';
            document.getElementById("GameEnd").style.display = 'block';

            if(currentNumber === 1){
                // Füge die pastelWave-Klasse zu den Zahlen hinzu
                numbers.forEach(function(number, index) {
                    number.classList.add("pastelWave");
                });
                // Füge die pastelWave-Klasse zu den Zahlen hinzu
                skip.forEach(function(skip, index) {
                    skip.classList.add("pastelWave");
                });
            }else{
                numbers[currentNumber -1].classList.add("win");
                for (var i = currentNumber; i < 6; i++) {
                    numbers[i].classList.add("after");
                }
            }
        }
    }

    function enableNextNumber() {
        var skip = document.querySelectorAll(".skip");
        var numbers = document.querySelectorAll(".number");
        var images = document.querySelectorAll(".image");

        if(!win){
            if (!allUnlocked) {
                if (currentNumber < numbers.length) {
                    numbers[currentNumber].classList.add("active");
                    images[currentNumber].classList.remove("hidden");
                    images[currentNumber - 1].classList.add("hidden");
                    images[Number - 1].classList.add("hidden");
                    currentNumber++;
                    loseNumber--;
                    document.getElementById("lose").innerHTML = loseNumber + " guesses remaining!";
                    Number = currentNumber;

                    // Save progress to local storage
                    localStorage.setItem("currentNumber"  + game_id, currentNumber);
                    localStorage.setItem("Number"  + game_id, Number);
                    localStorage.setItem("loseNumber"  + game_id, loseNumber);

                    const container = document.createElement('div');
                    container.className = 'result-container-failed'; // Füge eine CSS-Klasse hinzu (für das Styling)
            
                    const failXContainer = document.createElement('div');
                    failXContainer.innerHTML = '✕';
                    failXContainer.className = 'failX';

                    const helpContainer = document.createElement('div');
                    helpContainer.className = 'orig-eng';

                    const originalName = document.createElement('div');
                    originalName.innerHTML = "Skip";
                    originalName.className = 'original-name-failed'; // Füge eine CSS-Klasse hinzu (für das Styling)
            
                    container.appendChild(failXContainer);
                    container.appendChild(helpContainer);
                    helpContainer.appendChild(originalName);
                    guesses12.appendChild(container);

                    // Speichere die falsche Vermutung im Local Storage
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
                        numbers[i].classList.remove("active");
                    }
                    Number = 1;

                    localStorage.setItem("allUnlocked" + game_id, "true");

                    document.getElementById("winner").style.display = 'flex';
                    document.getElementById("lose-nail").innerHTML = "Oh no! Better luck next time!";
                    document.getElementById("win-name").innerHTML = correctName;
                    
                    /// Save progress to local storage
                    localStorage.setItem("currentNumber"  + game_id, currentNumber);
                    localStorage.setItem("Number"  + game_id, Number);
                    localStorage.setItem("loseNumber"  + game_id, loseNumber);

                    const container = document.createElement('div');
                    container.className = 'result-container-failed'; // Füge eine CSS-Klasse hinzu (für das Styling)
            
                    const failXContainer = document.createElement('div');
                    failXContainer.innerHTML = '✕';
                    failXContainer.className = 'failX';

                    const helpContainer = document.createElement('div');
                    helpContainer.className = 'orig-eng';

                    const originalName = document.createElement('div');
                    originalName.innerHTML = "Skip";
                    originalName.className = 'original-name-failed'; // Füge eine CSS-Klasse hinzu (für das Styling)
            
                    container.appendChild(failXContainer);
                    container.appendChild(helpContainer);
                    helpContainer.appendChild(originalName);
                    guesses12.appendChild(container);

                    // Speichere die falsche Vermutung im Local Storage
                    var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
                    var incorrectGuesses = storedIncorrectGuesses ? JSON.parse(storedIncorrectGuesses) : [];
                    incorrectGuesses.push("Skip");
                    localStorage.setItem("incorrectGuesses"  + game_id, JSON.stringify(incorrectGuesses));
                }
            }
        }
    }

    allUnlocked = localStorage.getItem("allUnlocked"  + game_id) === "true";
    win = localStorage.getItem("win"  + game_id) === "true";
    if(!win){
        if (!allUnlocked) {
            function NextNumber(num) {
                var numbers = document.querySelectorAll(".number");
                var images = document.querySelectorAll(".image");
                if (currentNumber >= num) {
                    images[Number - 1].classList.add("hidden");
                    images[num - 1].classList.remove("hidden");
                    Number = num;

                    // Save progress to local storage
                    localStorage.setItem("Number"  + game_id, Number);
                }
            }
        }else{
            function NextNumber(num) {
                var numbers = document.querySelectorAll(".number");
                var images = document.querySelectorAll(".image");
                var save = currentNumber;
                currentNumber = 6;
                if (currentNumber >= num) {
                    for (var i = 0; i < 6; i++) {
                        images[i].classList.add("hidden");
                    }
                    images[Number - 1].classList.add("hidden");
                    images[num - 1].classList.remove("hidden");
                    Number = num;
                }
                currentNumber = save;
            }
        }
    }else{
        function NextNumber(num) {
            var numbers = document.querySelectorAll(".number");
            var images = document.querySelectorAll(".image");
            var save = currentNumber;
            currentNumber = 6;
            if (currentNumber >= num) {
                for (var i = 0; i < 6; i++) {
                    images[i].classList.add("hidden");
                }
                images[Number - 1].classList.add("hidden");
                images[num - 1].classList.remove("hidden");
                Number = num;
            }
            currentNumber = save;
        }
    }

    function checkName() {
        var skip = document.querySelectorAll(".skip");
        var numbers = document.querySelectorAll(".number");
        var images = document.querySelectorAll(".image");

        // Hole den eingegebenen Namen aus dem Input-Feld
        var enteredName = document.getElementById("searchInput").value;

        // Hier kannst du den vorgegebenen Namen definieren
        

        if (enteredName === correctName) {
            win = true;
            
            // Hier kannst du den aktuellen Stand speichern
            localStorage.setItem("currentNumber"  + game_id, currentNumber);
            localStorage.setItem("Number"  + game_id, Number);
            localStorage.setItem("loseNumber"  + game_id, loseNumber);
            localStorage.setItem("allUnlocked"  + game_id, "true");
            localStorage.setItem("win"  + game_id, "true");

            for (var i = 0; i < 6; i++) {
                numbers[i].classList.add("active");
            }
            ;
            document.getElementById("skip").style.display = 'none';
            document.getElementById("lose").style.display = 'none';
            document.getElementById("winner").style.display = 'flex';
            document.getElementById("win-nail").innerHTML = "You nailed it!";
            document.getElementById("win-name").innerHTML = correctName;
            document.getElementById("searchInput").style.display = 'none';
            document.getElementById("searchButtom").style.display = 'none';
            document.getElementById("GameEnd").style.display = 'block';

            if(currentNumber === 1){
                // Füge die pastelWave-Klasse zu den Zahlen hinzu
                numbers.forEach(function(number, index) {
                    number.classList.add("pastelWave");
                });
                // Füge die pastelWave-Klasse zu den Zahlen hinzu
                skip.forEach(function(skip, index) {
                    skip.classList.add("pastelWave");
                });
            }else{
                numbers[currentNumber -1].classList.add("win");
                for (var i = currentNumber; i < 6; i++) {
                    numbers[i].classList.add("after");
                }
            }

            // AJAX-Anfrage an das PHP-Script (fail.php) senden
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '/info.php?enteredName=' + correctName, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Erfolgreiche Antwort erhalten
                    const response = JSON.parse(xhr.responseText);

                    // Hier kannst du die Daten aus der Antwort verwenden
                    const cgtatext = response.gta_text;
                    const cgta_amazon = response.gta_amazon;
                    const cgta_prime_video = response.gta_prime_video;
                    const cgta_chrunchyroll = response.gta_chrunchyroll;
                    const cgta_netflix = response.gta_netflix;
                    const cgta_name = response.gta_name;

                    // Beispiel:
                    document.getElementById('gtatext').innerHTML = cgtatext;
                    document.getElementById('amazon').href = cgta_amazon;
                    document.getElementById('prime').href = cgta_prime_video;
                    document.getElementById('chrunchyroll').href = cgta_chrunchyroll;
                    document.getElementById('netflix').href = cgta_netflix;

                } else {
                    // Fehler bei der Anfrage
                    console.error('Fehler bei der Anfrage: ' + xhr.status);
                }
            };

            xhr.send();
            
        } else if (enteredName.trim() !== "") {
            // Der eingegebene Name ist falsch
            var skip = document.querySelectorAll(".skip");
            var numbers = document.querySelectorAll(".number");
            var images = document.querySelectorAll(".image");

            if (!allUnlocked) {
                if (currentNumber < numbers.length) {
                    numbers[currentNumber].classList.add("active");
                    images[currentNumber].classList.remove("hidden");
                    images[currentNumber - 1].classList.add("hidden");
                    images[Number - 1].classList.add("hidden");
                    currentNumber++;
                    loseNumber--;
                
                    const container = document.createElement('div');
                    container.className = 'result-container-failed'; // Füge eine CSS-Klasse hinzu (für das Styling)
            
                    const failXContainer = document.createElement('div');
                    failXContainer.innerHTML = '✕';
                    failXContainer.className = 'failX';

                    const helpContainer = document.createElement('div');
                    helpContainer.className = 'orig-eng';

                    const originalName = document.createElement('div');
                    originalName.innerHTML = enteredName;
                    originalName.className = 'original-name-failed'; // Füge eine CSS-Klasse hinzu (für das Styling)
            
                    container.appendChild(failXContainer);
                    container.appendChild(helpContainer);
                    helpContainer.appendChild(originalName);
                    guesses12.appendChild(container);

                    // AJAX-Anfrage an das PHP-Script (fail.php) senden
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', '/fail.php?enteredName=' + enteredName, true);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            // Erfolgreiche Antwort erhalten
                            const response = JSON.parse(xhr.responseText);

                            // Hier kannst du die Daten aus der Antwort verwenden
                            const gtaNameEng = response.gtaNameEng;

                            // Beispiel: 
                            const gtaNameEngElement = document.createElement('div');
                            gtaNameEngElement.innerHTML = gtaNameEng;
                            gtaNameEngElement.className = 'english-name-failed';
                            helpContainer.appendChild(gtaNameEngElement);
                        } else {
                            // Fehler bei der Anfrage
                            console.error('Fehler bei der Anfrage: ' + xhr.status);
                        }
                    };

                    xhr.send();

                    // Speichere die falsche Vermutung im Local Storage
                    var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
                    var incorrectGuesses = storedIncorrectGuesses ? JSON.parse(storedIncorrectGuesses) : [];
                    incorrectGuesses.push(enteredName);
                    localStorage.setItem("incorrectGuesses"  + game_id, JSON.stringify(incorrectGuesses));

                    document.getElementById("lose").innerHTML = loseNumber + " guesses remaining!";
                    Number = currentNumber;

                    // Save progress to local storage
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
                    for (var i = 0; i < numbers.length; i++) {
                        numbers[i].classList.remove("active");
                    }
                    Number = 1;

                    document.getElementById("winner").style.display = 'flex';
                    document.getElementById("lose-nail").innerHTML = "Oh no! Better luck next time!";
                    document.getElementById("win-name").innerHTML = correctName;
                    
                    // Save progress to local storage
                    localStorage.setItem("allUnlocked" + game_id, "true");

                    const container = document.createElement('div');
                    container.className = 'result-container-failed'; // Füge eine CSS-Klasse hinzu (für das Styling)
            
                    const failXContainer = document.createElement('div');
                    failXContainer.innerHTML = '✕';
                    failXContainer.className = 'failX';

                    const helpContainer = document.createElement('div');
                    helpContainer.className = 'orig-eng';

                    const originalName = document.createElement('div');
                    originalName.innerHTML = enteredName;
                    originalName.className = 'original-name-failed'; // Füge eine CSS-Klasse hinzu (für das Styling)
            
                    container.appendChild(failXContainer);
                    container.appendChild(helpContainer);
                    helpContainer.appendChild(originalName);
                    guesses12.appendChild(container);

                    // AJAX-Anfrage an das PHP-Script (fail.php) senden
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', '/fail.php?enteredName=' + enteredName, true);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            // Erfolgreiche Antwort erhalten
                            const response = JSON.parse(xhr.responseText);

                            // Hier kannst du die Daten aus der Antwort verwenden
                            const gtaNameEng = response.gtaNameEng;

                            // Beispiel: 
                            const gtaNameEngElement = document.createElement('div');
                            gtaNameEngElement.innerHTML = gtaNameEng;
                            gtaNameEngElement.className = 'english-name-failed';
                            helpContainer.appendChild(gtaNameEngElement);
                        } else {
                            // Fehler bei der Anfrage
                            console.error('Fehler bei der Anfrage: ' + xhr.status);
                        }
                    };

                    xhr.send();

                    // Speichere die falsche Vermutung im Local Storage
                    var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
                    var incorrectGuesses = storedIncorrectGuesses ? JSON.parse(storedIncorrectGuesses) : [];
                    incorrectGuesses.push(enteredName);
                    localStorage.setItem("incorrectGuesses"  + game_id, JSON.stringify(incorrectGuesses));
                }
            }

            // Leere das Textfeld, wenn der Name falsch ist
            document.getElementById("searchInput").value = "";
            enteredName = document.getElementById("searchInput").value;
        }
    } 

    // Überprüfe, ob die Seite neu geladen wurde und setze den Fortschritt zurück
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

        var nextAnime = "";
        var lastAnime = "";

        if(nextAnime !=''){
            document.getElementById("Next").style.color = 'white';
              document.getElementById("Next").style.border = 'white 1px solid';
              document.getElementById("Last").style.cursor = 'pointer';
        }else{
            document.getElementById("Next").style.color = '#373737';
              document.getElementById("Next").style.border = '#373737 1px solid';
              document.getElementById("Last").style.cursor = 'default'; 
        }

        if(lastAnime != ''){
            document.getElementById("Last").style.color = 'white';
              document.getElementById("Last").style.border = 'white 1px solid';
              document.getElementById("Last").style.cursor = 'pointer';
        }else{
            document.getElementById("Last").style.color = '#373737';
            document.getElementById("Last").style.border = '#373737 1px solid';
            document.getElementById("Last").style.cursor = 'default';
        }

        // Wiederherstellen der gespeicherten falschen Vermutungen
        var storedIncorrectGuesses = localStorage.getItem("incorrectGuesses"  + game_id);
        if (storedIncorrectGuesses) {
            var incorrectGuesses = JSON.parse(storedIncorrectGuesses);
            var guesses12 = document.getElementById("guesses12");

            // Füge falsche Vermutungen zum Div "guesses12" hinzu
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
                    // AJAX-Anfrage an das PHP-Script (fail.php) senden
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', '/fail.php?enteredName=' + guess, true);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            // Erfolgreiche Antwort erhalten
                            const response = JSON.parse(xhr.responseText);

                            // Hier kannst du die Daten aus der Antwort verwenden
                            const gtaNameEng = response.gtaNameEng;

                            // Beispiel: 
                            const gtaNameEngElement = document.createElement('div');
                            gtaNameEngElement.innerHTML = gtaNameEng;
                            gtaNameEngElement.className = 'english-name-failed';
                            helpContainer.appendChild(gtaNameEngElement);
                        } else {
                            // Fehler bei der Anfrage
                            console.error('Fehler bei der Anfrage: ' + xhr.status);
                        }
                    };
                    xhr.send();
                }
            });
        }

        // AJAX-Anfrage an das PHP-Script (fail.php) senden
        var correctName = localStorage.getItem("correctName" + game_id);
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/info.php?enteredName=' + correctName, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Erfolgreiche Antwort erhalten
                const response = JSON.parse(xhr.responseText);

                // Hier kannst du die Daten aus der Antwort verwenden
                const cgtatext = response.gtatext;
                const cgta_amazon = response.gta_amazon;
                const cgta_prime_video = response.gta_prime_video;
                const cgta_chrunchyroll = response.gta_chrunchyroll;
                const cgta_netflix = response.gta_netflix;
                const cgta_name = response.gta_name;

                // Beispiel:
                document.getElementById('gtatext').innerHTML = cgtatext;
                document.getElementById('amazon').href = cgta_amazon;
                document.getElementById('prime').href = cgta_prime_video;
                document.getElementById('chrunchyroll').href = cgta_chrunchyroll;
                document.getElementById('netflix').href = cgta_netflix;

            } else {
                // Fehler bei der Anfrage
                console.error('Fehler bei der Anfrage: ' + xhr.status);
            }
        };

        xhr.send();
    }

    function updateCountdown() {
        // Aktuelles Datum und Zeit in UTC abrufen
        const now = new Date();
        const nowUTC = new Date(now.toUTCString());

        // Zielzeit (Mitternacht UTC) für den nächsten Tag festlegen
        const targetTime = new Date(nowUTC);
        targetTime.setUTCHours(24, 0, 0, 0);

        // Differenz zwischen den beiden Zeiten berechnen
        const timeDifference = targetTime - nowUTC;

        // Zeit in Stunden, Minuten, Sekunden und Millisekunden umrechnen
        const hours = Math.floor(timeDifference / 3600000);
        const minutes = Math.floor((timeDifference % 3600000) / 60000);
        const seconds = Math.floor((timeDifference % 60000) / 1000);

        // Countdown-Anzeige aktualisieren
        const countdownElement = document.getElementById("countdown");
        countdownElement.innerHTML = `${hours.toString().padStart(2, '0')} : ${minutes.toString().padStart(2, '0')} : ${seconds.toString().padStart(2, '0')}`;
    }

    // Countdown alle 1 Sekunde aktualisieren
    setInterval(updateCountdown, 1000);

    // Countdown zu Beginn starten
    updateCountdown();
