<?php
/*
Plugin Name: CMS 2 Labb 1 Contact Form
Author: Alexander Maktabi
Version: 1.0.0
Description: A plugin to add a contact form with reCaptcha
*/

Class contactForm {
   public function __construct()
  {
    add_shortcode('contact', array($this, 'formBuilder'));
    add_action('wp_enqueue_scripts', array($this, 'formStyles'));
  }

  // Enqueue styles
  public function formStyles()
  {
    wp_register_style('contactFormStyle', plugin_dir_url(__FILE__ ) . '/assets/style.css');
    wp_enqueue_style('contactFormStyle');
  }

  // Frontend form
  public function formBuilder($atts, $content = null)
  {
    // Default values
    $formAtts = shortcode_atts([
      'subject' => 'Ämne',
      'receiver' => get_option('admin_email'),
      'message' => 'Meddelande',
      'success' => 'Meddelandet har skickats',
      'fail' => 'Du har angett fel svar, var god testa på nytt!',
      'question' => '1+7=?',
      'answer' => '8'
    ],$atts);
    // Call the form handler to handle user inputs on submit
    $this->formHandler($formAtts);
    // HTML output
    ob_start();
   ?>
    <div id="contactForm">
      <h3><?= $content; ?></h3>
      <form method="post">
        <input type="hidden" name="contact-form-set" value="1">
        <input class="subject" type="text" name="contact-form-subject" placeholder="<?= $formAtts['subject'];?>" required>
        <textarea name="contact-form-message" rows="3" min="5" max="3000" cols="50" required placeholder="<?= $formAtts['message'];?>"></textarea>
        <div class="reCaptcha-wrap">
          <input class="reCaptcha" type="text" value="<?= $formAtts['question'];?>" readonly>
          <input class="reCaptcha" type="text" name="reCaptcha-user-input" placeholder="Svar" required>
        </div>
        <input class="submit" type="submit" value="Skicka" name="contact-form-submit">
      </form>
    </div>
   <?php
   $output = ob_get_clean();
   return $output;
  }

  // Backend form handling
  public function formHandler($atts)
  {
    if(isset($_POST['contact-form-set'])) {
      if($atts['answer'] == $_POST['reCaptcha-user-input']) {
        //Send mail
        $to = $atts['receiver'];
        $subject = $_POST['contact-form-subject'];
        $message = $_POST['contact-form-message'];
        $sent = wp_mail($to, $subject, strip_tags($message));
        if($sent) {
          //Show success msg
          echo "<div class='success'>".$atts['success']."</div>";
        }
        else  {
          echo "<div class='error'>Något gick fel, testa igen senare!</div>";
        }
      } else {
        // Fail msg
        echo "<div class='error'>".$atts['fail']."</div>";
      }
    }
  }
}

new contactForm();
