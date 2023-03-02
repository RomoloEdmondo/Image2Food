<form action="registrieren.php" method="post">
    
    <label class="reg_label">Name</label>
    <span class="pflichtmarker"> * </span>
    <input name="name" maxlength="30"
    <?php
        if (isset($_POST['name'])) {  
            echo "value='" . $_POST['name'] . "'";
        }
    ?>
    />
    <span class="fehlermeldung"></span>
    <br>

    <label class="reg_label">Vorname</label>
    <span class="pflichtmarker"> * </span>
    <input name="vorname" maxlength="30"
    <?php
        if (isset($_POST['vorname'])) {  
            echo "value='" . $_POST['vorname'] . "'";
        }
    ?>/>
    <span class="fehlermeldung"></span>
    <br>

    <label class="reg_label">E-mail</label>
    <span class="pflichtmarker"> * </span>
    <input name="email" maxlength="30"
    <?php
        if (isset($_POST['email'])) {  
            echo "value='" . $_POST['email'] . "'";
        }
    ?>/>
    <span class="fehlermeldung"></span>
    <br>

    <label class="reg_label">Userid</label>
    <span class="pflichtmarker"> * </span>
    <input name="userid" maxlength="20"/>
    <span class="fehlermeldung"></span>
    <br>

    <label class="reg_label">Passwort</label>
    <span class="pflichtmarker"> * </span>
    <input type="password" name="pw" maxlength ="50"/>
    <span class="fehlermeldung"></span>
    <br>

    <label class="reg_label">Zusatzinfos</label>
    <span class="pflichtmarker">  </span>
    <textarea name="zusatzinfos" cols="30" rows="5">
    <?php
        if (isset($_POST['zusatzinfos'])) {  
            echo "value='" . $_POST['zusatzinfos'] . "'";
        }
    ?>
    </textarea>
    <span class="fehlermeldung"></span>
    <br>
    <!--  captcha feld -->
    <img src="captchagenerieren.php" alt="Captcha">
	<br>
	<label calss="reg_label">Captcha</label>
	<span class="pflichtmarker"> * </span>
	<input name="captcha">

    <input type="submit">
</form>