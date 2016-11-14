<div class="main">
    <h1>Увійти в систему</h1>
    <div class="login">
        <div class="login_module">
            <div class="module form-module">
                <div class="toggle"><i class="fa fa-times fa-pencil"></i>
                    <div class="tooltip">Зареєструватися</div>
                </div>
                <div class="form">
                    <h2>Увійти</h2>
                    <form id="log" action="main/auth" method="post">
                        <div id="error"></div>
                        <input type="email" name="user_email" placeholder="E-mail" required=" ">
                        <input type="password" name="user_password" placeholder="Пароль" required=" ">
                        <input id="login" type="submit" name="login" value="Увійти">
                    </form>
                </div>
                <div class="form">
                    <h2>Зареєструватися</h2>
                    <form id="reg">
                        <div id="error"></div>
                        <input type="text" name="user_full_name" placeholder="ПІБ" required=" ">
                        <input type="email" name="user_email" placeholder="E-mail" required=" ">
                        <input type="password" name="user_password" placeholder="Пароль" required=" ">
                        <select name="user_role" required=" ">
                            <option value="teach" selected="selected">Викладач</option>
                            <option value="resp_person">Відповідальна особа від кафедри</option>
                            <option value="head_depart">Завідувач кафедрою</option>
                            <option value="resp_person_depart">Відповідальна особа від факультету/інституту</option>
                            <option value="direct_inst">Декан/директор факультету/інституту</option>
                            <option value="resp_person_science">Відповідальна особа від наукового відділу</option>
                            <option value="pro_rector_science">Проректор з наукової роботи</option>
                        </select>
                        <input id="signup" type="submit" name="signup" value="Зареєструватися">
                    </form>
                </div>
                <div class="cta"><a href="#">Нагадати пароль.</a></div>
            </div>
        </div>
        <script>
            $('.toggle').click(function(){
                $(this).children('i').toggleClass('fa-pencil');
                $('.form').animate({
                    height: "toggle",
                    'padding-top': 'toggle',
                    'padding-bottom': 'toggle',
                    opacity: "toggle"
                }, "slow");
            });
        </script>
    </div>
</div>