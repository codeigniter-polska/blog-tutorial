
	<div class="row">
		<div class="span4 offset4 well">
			<legend>Logowanie</legend>     
			<!-- Otwieramy formularz za pomocą funkcji z helpera Form. -->    	
			<?php echo form_open(); ?>
				<!-- 
					Również do definicji pól formularza możemy użyć funkcji z helpera Form, 
					ale w tym przypadku nie widać specjalnych korzyści dla których musielibyśmy to robić, 
					dlatego zostaniemy przy "normalnym" zapisie.
				-->
				<input type="email" id="email" class="span4" name="email" placeholder="Email">
				<input type="password" id="password" class="span4" name="password" placeholder="Hasło">
				<button type="submit" name="submit" class="btn btn-info btn-block">Zaloguj</button>
			<!-- Zamykamu formularz. -->
			<?php echo form_close(); ?>
		</div>
	</div>