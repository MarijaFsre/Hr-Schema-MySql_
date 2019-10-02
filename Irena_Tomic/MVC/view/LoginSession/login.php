<?php
require_once('../php_google_login/settings.php');
session_start();

include('../public/header.php');


if ((isset($_SESSION['logiran'])) && ($_SESSION['logiran']='DA')) {

header("Location: ../employee/listEmployees.php");

}
else {
echo "<h3>Unesite podatke za prijavu</h3>";

echo "<main>
				<div class='main_frame'>
					<div class='search_form'>
						<p>Login</p>
						<form action='./provjera.php' method='POST'>
							<label for='email'>Email</label>
							<input type='text' id='email' name='email' placeholder='email..'>

							<label for='password'>password</label>
							<input type='password' id='password' name='password' class='number' placeholder='password..'>

							<input type='submit' class='button button4' value='Login' name='submit_btn'>
						</form>
					</div>";
					?>
					<a href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>">Login with Google</a>
				 </div>
				</main>;
				<?php
}

include('../public/footer.php');
