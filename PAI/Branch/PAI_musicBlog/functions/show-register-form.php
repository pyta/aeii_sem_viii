<div class="header">
    <h2>Rejestracja</h2>
</div>
<div class="content">
	<div class="text">
	<?php SignUpUser() ?>
  		<form name="Rejestracja" action="subpage.php?page=sinup" method="POST" class="form">
            <table class = "regstyletable">
                <tr>
                    <td colspan = '3'><h5>Pola wymagane</h5></td>
                </tr>
                <tr>
                    <td colspan = '3'>&nbsp;</td>
                </tr>
                <tr>
                    <td><label for="login">login*</label></td>
                    <td><input type = 'text' name = 'login' onblur = "SprawdzWymaganePola();" style = "width: 240px;"/></td>
                    <td><img src = 'images/error.png' id = 'lo'></td>
                </tr>
                <tr>
                    <td><label for="password">hasło*</label></td>
                    <td><input type = 'password' name = 'pass' onblur = "SprawdzWymaganePola();" style = "width: 240px;"/></td>
                    <td><img src = 'images/error.png' id = 'np'></td>
                </tr>
                <tr>
                    <td><label for="repass">powtórz hasło*</label></td>
                    <td><input type = 'password' name = 'repass' onblur = "SprawdzWymaganePola();" style = "width: 240px;"/></td>
                    <td><img src = 'images/error.png' id = 'rp'></td>
                </tr>
                <tr>
                    <td><label for="email">adres e-mail*</label></td>
                    <td><input type = 'text' name = 'mail' onblur = "SprawdzWymaganePola();" style = "width: 240px;"/></td>
                    <td><img src = 'images/error.png' id = 'ma'></td>
                </tr>
                <tr>
                    <td colspan = '3'>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan = '3'><h5>Infromacje dodatkowe</h5></td>
                </tr>
                <tr>
                    <td colspan = '3'>&nbsp;</td>
                </tr>
                <tr>
                    <td><label for="imie">imię</label></td>
                    <td><input type = 'text' name = 'imie' style = "width: 240px;"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="nazwisko">nazwisko</label></td>
                    <td><input type = 'text' name = 'nazwisko' style = "width: 240px;"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="miejscowosc">miejscowość</label></td>
                    <td><input type = 'text' name = 'miejscowosc' style = "width: 240px;"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="plec">płeć</label></td>
                    <td>Kobieta: &nbsp;<input type = 'radio' name = 'plec' value = 'K' />&nbsp;&nbsp;Mężczyzna: &nbsp;<input type = 'radio' name = 'plec' value = 'M'/></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="data-urodz">data urodzenia</label></td>
                    <td>
                    <select name="dzien" style = "width: 58px;">
                        <?php for($i = 1; $i <= 31; ++$i) echo "<option>$i</option>" ?>
                    </select>
                    <select name="miesiac" style = "width: 120px;">
                        <option>Styczeń</option>
                        <option>Luty</option>
                        <option>Marzec</option>
                        <option>Kwiecień</option>
                        <option>Maj</option>
                        <option>Czerwiec</option>
                        <option>Lipiec</option>
                        <option>Sierpień</option>
                        <option>Wrzesień</option>
                        <option>Październik</option>
                        <option>Listopad</option>
                        <option>Grudzień</option>
                    </select>
                    <select name="rok" style = "width: 72px;">
                        <?php for($i = 2011; $i >= 1921; --$i) echo "<option>$i</option>" ?>
                    </select>
                    <td></td>
                </tr>
                <tr>
                    <td colspan = '3'>&nbsp;</td>
                </tr>
                <tr>
                <td colspan="3">
                    <p class="submit" style="text-align:center;">
                        <input type="submit" value="Zarejestruj" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="Reset" />
                    </p>
                </td>
            </tr>
            </table>
		</form>
	</div>
</div>
<div class="footer"></div>