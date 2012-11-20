<div class="page-header">
	<h1>Dodaj wpis</h1>
</div>

<div class="row">
  	<div class="span12">
  		<!-- Otwieramy formularz -->
    	<?php echo form_open('posts/add', array('class'=>'form-horizontal')); ?>
      		<fieldset>
        		<div class="control-group <?php echo form_error('title') ? 'error' : ''; ?>">
					<label class="control-label" for="title">Tytuł</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="title" name="title" value="<?php echo set_value('title'); ?>">
					</div>
        		</div>
		        <div class="control-group <?php echo form_error('body') ? 'error' : ''; ?>">
		        	<label class="control-label" for="body">Treść</label>
		          	<div class="controls">
		            	<textarea class="span10" id="body" name="body" rows="8" placeholder="Dodaj tekst..."><?php echo set_value('body'); ?></textarea>
		          	</div>
		        </div>
	        	<div class="form-actions">
	          		<button type="submit" class="btn btn-primary">Dodaj wpis</button>
	          		<a class="btn" href="<?php echo site_url('posts'); ?>">Anuluj</a>
	        	</div>
      		</fieldset>
      	<!-- Zamykamu formularz -->
    	<?php echo form_close(); ?>
  	</div>
</div>