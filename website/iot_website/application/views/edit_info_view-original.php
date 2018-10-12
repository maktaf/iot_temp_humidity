<?php 
    echo validation_errors(); 
    echo "<br/>";
    echo "Username: ".$username;
    echo "<br/><br/>";
?>

<?php echo form_open('EditInfo'); ?>
      <div class="input-container">
          <input type="text" name="name" id="name" value="<?php echo $name ?>"/>
        <label for="name">name</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
          <input type="text" name="email" id="email" value="<?php echo $email ?>"/>
        <label for="email">email</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
          <input type="text" name="min_temp" id="min_temp" value="<?php echo $min_temp ?>"/>
        <label for="min_temp">Minimum temperature</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
          <input type="text" name="max_temp" id="max_temp" value="<?php echo $max_temp ?>"/>
        <label for="max_temp">Maximum temperature</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
          <input type="text" name="min_humidity" id="min_humidity" value="<?php echo $min_humidity ?>"/>
        <label for="min_humidity">Minimum Humidity</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
          <input type="text" name="max_humidity" id="max_humidity" value="<?php echo $max_humidity ?>"/>
        <label for="max_humidity">Maximum Humidity</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button><span>Edit</span></button>
      </div>
</form>

<a class="button" href="<?php echo base_url('index.php/dashboard') ?>">back to dashboard</a>