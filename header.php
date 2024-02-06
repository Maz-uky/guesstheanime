<header>
    <a href="https://www.guesstheanime.net" style="display: flex;text-decoration: none;">
        <img src="/icon/guess.png" width="50" height="50">
        <span class="name">GuessTheAnime.net</span>
    </a>
    <img id="click-menu" onclick="openmenu()" src="https://www.guesstheanime.net/icon/menu.svg" width="50x" height="50px" alt="menu">
    <img id="click-menu-x" onclick="closemenu()" src="https://www.guesstheanime.net/icon/close.svg" width="50x" height="50px" alt="menu">
    <ul id="menu">
        <a class="mobile" href="https://www.guesstheanime.net/home/"><li><img class="li-img" src="https://www.guesstheanime.net/icon/home.svg" alt="home"><span class="li-text">Home</span></li></a>
        <li onclick="openthanxPopup()"><img class="li-img" src="https://www.guesstheanime.net/icon/favorite.svg" alt="support us"><span class="li-text">Support Us</span></li>
        <li onclick="openstatsPopup()"><img class="li-img" src="https://www.guesstheanime.net/icon/monitoring.svg" alt="analystics"><span class="li-text">Analystics</span></li>
        <li onclick="openaboutPopup()"><img class="li-img" src="https://www.guesstheanime.net/icon/info.svg" alt="information"><span class="li-text">Information</span></li>
        <li onclick="openinfoPopup()"><img class="li-img" src="https://www.guesstheanime.net/icon/help.svg" alt="help"><span class="li-text">Help</span></li>
        <li onclick="opensettingPopup()"><img class="li-img" src="https://www.guesstheanime.net/icon/settings.svg" alt="settings"><span class="li-text">Settings</span></li>
        <?php 
        if( $_SESSION['username'] != "user"){ 
            echo' <li onclick="openAccount()"><img class="li-img" src="https://www.guesstheanime.net/icon/account.svg" alt="account"><span class="li-text">Account</span></li>';
        }else{
            echo' <li onclick="openLoginPopup()"><img class="li-img" src="https://www.guesstheanime.net/icon/account.svg" alt="account"><span class="li-text">Login</span></li>
                <li onclick="opendeletePopup()"><img class="li-img" src="https://www.guesstheanime.net/icon/delete.svg" alt="delete browser data"><span class="li-text">Delete Data</span></li>';
        }?>
    </ul>

    <div class="overlay" id="loginOverlay">
        <div class="popup">
            <span class="close-btn" onclick="closeLoginPopup()">✕</span>
            <h2>Login</h2>
            <span id="loginerror" style="color: #930000;font-size: 14px;"></span>
            <form style="display: flex;flex-direction: column;margin: 5px 0px;">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required="" data-np-uid="23907f2b-9db5-41c6-a069-1c985972c7e4" style="margin: 5px 5px 20px 5px;height: 20px;">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required="" data-np-uid="f1ec8b63-7284-44e0-b0c6-272bb2648b3f" style="margin: 5px 5px 5px 5px;height: 20px;">
                <span onclick="openemailpassPopup()" style="font-size: 13px;width: 105px;margin: 0px 5px 20px 5px;cursor: pointer;">Forgot password?</span>

                <span onclick="login()" style="height: 25px;font-size: 15px;width: 80px;margin: 5px 5px 5px calc(100% - 85px);color: white;background: #930000;border: 0px;border-radius: 5px;cursor: pointer;text-align: center;display: flex;justify-content: center;flex-direction: column;">Log in</span>
                <div>
                    <span style="font-size: 13px;margin: 0px 5px 5px 5px;cursor: pointer;">Don't have an account?</span>
                    <span onclick="openregisterPopup()" style="font-size: 13px;width: 50px;margin: 0px 5px 5px -5px;cursor: pointer;text-decoration: underline;">Sign up</span>
                </div>   
            </form>
        </div>
    </div>
    <div class="overlay" id="account">
        <div class="popup">
            <span class="close-btn" onclick="closeAccount()">✕</span>
            <h2>Wellcome  <?php echo $_SESSION['username']; ?></h2>
            <span id="savedata" style="color: #930000;font-size: 14px;"></span>
            <span onclick="saveData()" style="color: white;display: flex;padding: 10px 15px;justify-content: center;font-size: 13px;margin: 10px 10px;border-radius: 5px;text-decoration: none;border: none;background: #930000;font-weight: bold;width: 60px;">Save data</span>
            <a href="https://www.guesstheanime.net/logout.php" style="color: white;display: flex;padding: 10px 15px;justify-content: center;font-size: 13px;margin: 10px 10px;border-radius: 5px;text-decoration: none;border: none;background: #930000;font-weight: bold;width: 60px;">Logout</a>
        </div>
    </div>
    <div class="overlay" id="register">
        <div class="popup">
            <span class="close-btn" onclick="closeregisterPopup()">✕</span>
            <h2>Sign up</h2>
            <span id="registererror" style="color: #930000;font-size: 14px;"></span>
            <form style="display: flex;flex-direction: column;margin: 5px 0px;">
                <label for="regist_username">Username:</label>
                <input type="text" id="regist_username" name="regist_username" required="" data-np-uid="23907f2b-9db5-41c6-a069-1c985972c7e4" style="margin: 5px 5px 20px 5px;height: 20px;">
                <label for="regist_email">Email address:</label>
                <input type="text" id="regist_email" name="regist_email" required="" data-np-uid="23907f2b-9db5-41c6-a069-1c985972c7e4" style="margin: 5px 5px 20px 5px;height: 20px;">
                <label for="regist_password">Password:</label>
                <input type="password" id="regist_password" name="regist_password" required="" data-np-uid="f1ec8b63-7284-44e0-b0c6-272bb2648b3f" style="margin: 5px 5px 5px 5px;height: 20px;">
                <label for="regist_password">Confirm password:</label>
                <input type="password" id="regist_password-re" name="regist_password-re" required="" data-np-uid="f1ec8b63-7284-44e0-b0c6-272bb2648b3f" style="margin: 5px 5px 20px 5px;height: 20px;">
                <div style="display: flex;align-items: center;margin: 5px 5px 20px 5px;">
                    <input id="CheckboxSingUp" type="checkbox" style="width: 22px;height: 22px;">
                    <label for="checkbox" style="width: 90%;margin: 0px 5px;">I accept the <a href="https://www.guesstheanime.net/terms-of-service/">terms of service</a></label>
                </div>
                <span onclick="register()" style="height: 25px;font-size: 15px;width: 80px;margin: 5px 5px 5px calc(100% - 85px);color: white;background: #930000;border: 0px;border-radius: 5px;cursor: pointer;text-align: center;display: flex;justify-content: center;flex-direction: column;">Sign up</span>
                <div>
                    <span style="font-size: 13px;margin: 0px 5px 5px 5px;cursor: pointer;">Already have an account?</span>
                    <span onclick="openLoginPopup()" style="font-size: 13px;width: 50px;margin: 0px 5px 5px -5px;cursor: pointer;text-decoration: underline;">Log in</span>
                </div> 
            </form>
        </div>
    </div>
    <div class="overlay" id="emailpass">
        <div class="popup">
            <span class="close-btn" onclick="closeemailpassPopup()">✕</span>
            <h2>Password reset</h2>
            <span id="emailerror" style="color: #930000;font-size: 14px;"></span>
            <form style="display: flex;flex-direction: column;margin: 5px 0px;">
                <label for="reset_email">Email address:</label>
                <input type="text" id="reset_email" name="reset_email" required="" data-np-uid="23907f2b-9db5-41c6-a069-1c985972c7e4" style="margin: 5px 5px 20px 5px;height: 20px;">
                <span onclick="resetmail()" style="height: 25px;font-size: 15px;width: 140px;margin: 5px 5px 5px calc(100% - 145px);color: white;background: #930000;border: 0px;border-radius: 5px;cursor: pointer;text-align: center;display: flex;justify-content: center;flex-direction: column;">Send reset email</span>
                <div>
                    <span style="font-size: 13px;margin: 0px 5px 5px 5px;cursor: pointer;">Already have an account?</span>
                    <span onclick="openLoginPopup()" style="font-size: 13px;width: 50px;margin: 0px 5px 5px -5px;cursor: pointer;text-decoration: underline;">Log in</span>
                </div> 
            </form>
        </div>
    </div>
    <div class="overlay" id="thanxPopup">
        <div class="popup">
            <span class="close-btn" onclick="closethanxPopup()">✕</span>
            <h3>Support Us</h3>
            <p>I hope you enjoy this daily puzzle game! If it has brightened your day, the best way you can support us is to share the site with a friend as thanks :D</p>
            <h4>Support Us on Ko-fi</h4>
            <p>If you would like to support Guess The Game development, you can make a donation or become a monthly member at <a href="https://ko-fi.com/guessanime">Ko-Fi</a></p>
            <script type="text/javascript" src="https://storage.ko-fi.com/cdn/widget/Widget_2.js"></script><script type="text/javascript">kofiwidget2.init("Support us", "#930000", "P5P4RFGW0");kofiwidget2.draw();</script> 
            <p>Monthly supporters get an Ad-Free experience but we are planning on adding new subscriber benefits soon!</p>
            <p>If you have supported GuessTheAnime, please <span onclick="openregisterPopup()" style="text-decoration: underline;cursor: pointer;">register with your email address</span> so that we can link your donation.</p>
        </div>
    </div>
    <div class="overlay" id="aboutPopup">
        <div class="popup">
            <span class="close-btn" onclick="closeaboutPopup()">✕</span>
            <h3>About</h3>
            <p>GuessTheAnime.net is a daily puzzle game inspired by GuessThe.Game & Framed.wtf.<br><br>

            Every day, a new anime is selected, and you are presented with 6 screenshots from the anime one at a time (It always comes from a season, scenes are from the intro, outro, and the actual episode!).<br><br>
            
            We strive to have a selection of different anime from various genres and eras. We also aim to present a mix of well-known and obscure anime. Generally, our more challenging anime are featured on the weekends, and the easier ones are on weekdays. However, this is not always the case.<br><br>
            
            Do you have any issues, questions, or suggestions? Reach out to us via <a href="mailto:info@GuessTheAnime.net">Email</a>.<br>
            If you encounter any broken features or bugs, please let me know the device and browser you're using!<br><br>
            
            We're interested in having you help select anime and images for daily puzzles. Want to submit? <a href="">Click here!</a><br><br>
            
            Did we miss your favorite anime, or have you searched for an anime and couldn't find it? <a href="">Submit it here!</a></p>
        </div>
    </div>
    <div class="overlay" id="infoPopup">
        <div class="popup">
            <span class="close-btn" onclick="closeinfoPopup()">✕</span>
            <h3>How to play</h3>
            <p>Search for the anime to which you think the displayed scene belongs.<br><br>

            All 6 scenes belong to the same anime!<br><br>
            
            If you guess wrong, we will show you an additional scene from the anime and provide a little hint to help you. You have a total of 6 attempts.<br><br>
            
            <span style="display: flex;align-items: center;">
                <span class="question-make"></span> = Correct<br>
            </span>
            <span style="display: flex;align-items: center;">
                <span class="question-not"></span>= Incorrect<br>
            </span>
            <span style="display: flex;align-items: center;">
                <span class="question-no"></span>= Not played<br>
            </span>
            <span style="display: flex;align-items: center;">
                <span class="question-no pastelWave"></span>= First guess correct
            </span><br><br>
            
            Note:<br>
            If you guess No Game No Life Zero, it is not excluded that No Game No Life is incorrect.<br><br>
            
            If you guess Sword Art Online II, Sword Art Online: Alicization, Sword Art Online: Alicization – War of Underworld, it is not excluded that Sword Art Online is incorrect.<br><br>
            
            If you guess SAO, you will be marked as incorrect even if Sword Art Online is correct. Abbreviations created by fans and not present in the official Japanese or English titles cannot be used for searching and guessing.<br><br>
            
            Good luck!</p>
        </div>
    </div>
    <?php 
        if( $_SESSION['username'] != "user"){ 
            echo' <div class="overlay" id="statsPopup">
            <div class="popup">
                <span class="close-btn" onclick="closestatsPopup()">✕</span>
                <h3>Stats - Coming Soon</h3>
                <p></p>
            </div>
        </div>';
        }else{
            echo' <div class="overlay" id="statsPopup">
            <div class="popup">
                <span class="close-btn" onclick="closestatsPopup()">✕</span>
                <h3>Stats</h3>
                <p>You can view the statistics once you are <span onclick="openLoginPopup()" style="text-decoration: underline;cursor: pointer;">logged in</span>.<br><br>
    
                If you haven\'t registered yet, you can <span onclick="openregisterPopup()" style="text-decoration: underline;cursor: pointer;">sign up</span> for free.<br><br>
                
                Additionally, if you support us on <a href="https://ko-fi.com/guessanime">Ko-Fi</a>, you can also check out the player statistics.</p>
            </div>
        </div>';
        }?>
    
    <div class="overlay" id="settingPopup">
        <div class="popup">
            <span class="close-btn" onclick="closesettingPopup()">✕</span>
            <h3>Setting - Coming Soon</h3>
            <h4>Language</h4>
        </div>
    </div>
    <div class="overlay" id="deletePopup">
        <div class="popup">
            <span class="close-btn" onclick="closedeletePopup()">✕</span>
            <h3>Delete</h3>
            <p>Let your data be deleted. If you do this, your entire progress will be erased and cannot be restored.<br><br>

            You can also save your data on our server before doing this, <span onclick="openLoginPopup()" style="text-decoration: underline;cursor: pointer;">log in</span> with your account first or <span onclick="openregisterPopup()" 
            style="text-decoration: underline;cursor: pointer;">create</span> a new one for free and secure your data.
            </p>
            <div style="display: flex;justify-content: center;">
                <button onclick="opendelete()" style="margin: 5px;padding: 10px 15px;background: #930000;font-weight: 600;color: white;border: none;border-radius: 5px;">DELETE DATA</button>
            </div>
        </div>
    </div>
    <div id="delete" class="overlay">
        <div class="popup">
            <span class="close-btn" onclick="closedelete()">✕</span>
            <h3>Delete</h3>
            <p>To delete the data, confirm your intention by checking the box.<br>
            If you do this, your entire progress will be erased and cannot be restored.</p>
            <div style="display: flex;align-items: center;">
                <input type="checkbox" id="CheckboxDeleadeData" style="width: 20px;height: 20px;">
                <label for="checkbox">I want to delete my data</label>
            </div>

            <div style="display: flex;justify-content: center;">
                <button onclick="deleteData()" style="margin: 5px;padding: 10px 15px;background: #930000;font-weight: 600;color: white;border: none;border-radius: 5px;">DELETE DATA</button>
            </div>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function openmenu() {
            document.getElementById("menu").style.display = "block";
            document.getElementById("click-menu-x").style.display = "block";
            document.getElementById("click-menu").style.display = "none";
        }
        function closemenu() {
            document.getElementById("menu").style.display = "none";
            document.getElementById("click-menu-x").style.display = "none";
            document.getElementById("click-menu").style.display = "block";
        }
        function saveData() {
            for (var save_game_id = 1; save_game_id <= 99; save_game_id++) {
                var correctEngName = "";
                var currentNumberKey = 'currentNumber' + save_game_id;
                if (localStorage.getItem(currentNumberKey) !== null) {
                    if (localStorage.setItem("correctEngName" + save_game_id, correctEngName)) {
                        correctEngName = localStorage.setItem("correctEngName" + save_game_id, correctEngName);
                    } else {
                        correctEngName = localStorage.setItem("correctEngName" + save_game_id, "N/A");
                    }

                    var dataToSend = {
                        game_id: save_game_id,
                        currentNumber: localStorage.getItem(currentNumberKey),
                        Number: localStorage.getItem('Number' + save_game_id),
                        loseNumber: localStorage.getItem('loseNumber' + save_game_id),
                        allUnlocked: localStorage.getItem('allUnlocked' + save_game_id),
                        win: localStorage.getItem('win' + save_game_id),
                        correctName: localStorage.setItem("correctName" + save_game_id, correctName),
                        correctEngName: correctEngName,
                        guess: localStorage.getItem("incorrectGuesses"  + save_game_id)
                    };

                    // AJAX aufrufen
                    $.ajax({
                        type: "POST",
                        url: "https://www.guesstheanime.net/savedata.php",
                        data: dataToSend,
                        success: function (response) {
                            console.log("Daten für game_id " + save_game_id + " erfolgreich gespeichert");
                        },
                        error: function (error) {
                            console.error("Fehler beim Speichern der Daten für game_id " + save_game_id + ": " + error);
                        }
                    });
                }
            }
        }

        // Login 
        function openLoginPopup() {
            closestatsPopup();
            closedeletePopup();
            closeregisterPopup();
            closeemailpassPopup();
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("loginOverlay").style.display = "flex";
        }
        function closeLoginPopup() {
            document.getElementById("loginOverlay").style.display = "none";
        }

        function login() {
            var usernameValue = document.getElementById("username").value;
            var passwordValue = document.getElementById("password").value;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '/login.php?username=' + usernameValue + '&password=' + passwordValue, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    const error = response.error;
                    const success = response.success;

                    document.getElementById('loginerror').innerHTML = error;

                    if (success) {
                        const dataArray = response.data;
                        dataArray.forEach(data => {
                            localStorage.setItem('currentNumber' + data.game_id, data.currentNumber);
                            localStorage.setItem('Number' + data.game_id, data.Number);
                            localStorage.setItem('loseNumber' + data.game_id, data.loseNumber);
                            localStorage.setItem('allUnlocked' + data.game_id, data.allUnlocked);
                            localStorage.setItem('win' + data.game_id, data.win);
                            localStorage.setItem('incorrectGuesses' + data.game_id, data.guess);
                        });
                        
                        location.reload();
                        closeLoginPopup();
                    }


                } else { 
                    console.error('Error in the request: ' + xhr.status);
                }
            };

            xhr.send();
        }

        // Login 
        function openAccount() {
            closestatsPopup();
            closedeletePopup();
            closeregisterPopup();
            closeemailpassPopup();
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("account").style.display = "flex";
        }
        function closeAccount() {
            document.getElementById("account").style.display = "none";
        }

        // Regist 
        function openregisterPopup() {
            closeLoginPopup();
            closethanxPopup();
            closestatsPopup();
            closedeletePopup();
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("register").style.display = "flex";
        }
        function closeregisterPopup() {
            document.getElementById("register").style.display = "none";
        }

        function register() {
            var usernameValue = document.getElementById("regist_username").value;
            var emailValue = document.getElementById("regist_email").value;
            var passwordValue = document.getElementById("regist_password").value;
            var passwordreValue = document.getElementById("regist_password-re").value;
            var checkbox = document.getElementById("CheckboxSingUp");

            if (isPasswordValid(passwordValue)) {
                if (passwordValue === passwordreValue) {
                    if (checkbox.checked) {
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '/register.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/json');

                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText);

                                const error = response.regist;
                                const fertig = response.registperf;

                                document.getElementById('registererror').innerHTML = error;

                                if(fertig === 1){
                                    closeregisterPopup();
                                }
                            } else {
                                console.error('Fehler bei der Anfrage: ' + xhr.status);
                            }
                        };

                        const data = {
                            username: usernameValue,
                            email: emailValue,
                            password: passwordValue
                        };

                        xhr.send(JSON.stringify(data));
                    } else {
                        document.getElementById('registererror').innerHTML = "Please accept the terms to create an account.";
                    }
                } else {
                    document.getElementById('registererror').innerHTML = "The passwords do not match.";
                }
            } else {
                document.getElementById('registererror').innerHTML = "The password does not meet the required criteria. It must have at least 8 characters, including an uppercase letter, a lowercase letter, a special character, and a number.";
            }

            function isPasswordValid(password) {
                if (password.length < 8) {
                    return false;
                }

                var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*_?&])[A-Za-z\d@$!%*_?&]+$/;
                return regex.test(password);
            }
        }
        
        // Thanx
        function openthanxPopup() {
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("thanxPopup").style.display = "flex";
        }
        function closethanxPopup() {
            document.getElementById("thanxPopup").style.display = "none";
        }

        // About
        function openaboutPopup() {
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("aboutPopup").style.display = "flex";
        }
        function closeaboutPopup() {
            document.getElementById("aboutPopup").style.display = "none";
        }

        // Info
        function openinfoPopup() {
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("infoPopup").style.display = "flex";
        }
        function closeinfoPopup() {
            document.getElementById("infoPopup").style.display = "none";
        }

        // Stats
        function openstatsPopup() {
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("statsPopup").style.display = "flex";
        }
        function closestatsPopup() {
            document.getElementById("statsPopup").style.display = "none";
        }

        // Settings
        function opensettingPopup() {
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("settingPopup").style.display = "flex";
        }
        function closesettingPopup() {
            document.getElementById("settingPopup").style.display = "none";
        }

        // Emailpass
        function openemailpassPopup() {
            closeLoginPopup();
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById("emailpass").style.display = "flex";
        }
        function closeemailpassPopup() {
            document.getElementById("emailpass").style.display = "none";
        }

        function resetmail(){
            var emailValue = document.getElementById("reset_email").value;
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/email.php?email=' + emailValue, true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    const reset = response.reset;
                    const fertig = response.registperf;

                    document.getElementById('emailerror').innerHTML = reset;
                    if (reset === 1) {
                        console.error('Alles OKI');
                        console.error(fertig);
                        closeemailpassPopup();
                    }
                } else {
                    console.error('Error in the request: ' + xhr.status);
                }
            };

            const data = {
                email: emailValue
            };

            xhr.send(JSON.stringify(data));
        }
        // Delete
        function opendeletePopup() {
            if (window.innerWidth <= 570) {
                closemenu();
            }
            document.getElementById('deletePopup').style.display = 'flex';
        }
        function closedeletePopup() {
            document.getElementById('deletePopup').style.display = 'none';
        }
        function opendelete() {
            closedeletePopup()
            document.getElementById('delete').style.display = 'flex';
        }
        function closedelete() {
            document.getElementById('delete').style.display = 'none';
        }
        function deleteData() {
            var checkbox = document.getElementById('CheckboxDeleadeData');

            if (checkbox.checked) {
                localStorage.clear();
                closedelete();
                location.reload(true);
            }else{
                alert('Please confirm your intention to delete.');
            }
        }
    </script>
</header>
