<?php
/*
Plugin Name: Comment Word Filter
Plugin URI: http://www.hamyar.org
Description: With This simple plugin you can filter some comment word as you want !
Version: 1.0
Author: Hamyar Programming Team
*/
?>
<?php
add_option('banned_words');
add_option('replace_word', 'FILTERD!');
function filter_comment($text){
    $ban = get_option("banned_words");
    $ban_ar = explode(",",$ban);
    $re = get_option("replace_word");
    $text = str_replace($ban_ar,$re,$text);
    return $text;
}
   add_filter( 'comment_text' , 'filter_comment');
function rows_ok($rows,$post,$name){
    if ($rows == $post){
        echo $name . "Is/Are Saved Succesfuly!";
    }else{
        echo "A Problem occured!";
    }
}
add_action( 'admin_menu', 'my_plugin_menu');
/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
	add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
        echo '<form action="options-general.php?page=my-unique-identifier" method="post">';
	echo '<p>Replaced Word:<input type="text" name="replace" value=' . get_option("replace_word") . ' size="20"></p>';
        echo '<p>Banned Words:<input type="text" name="ban" value=' . get_option("banned_words") . ' size="50"></p>';
        echo '<p><input type="submit" name="Submit" class="button-primary" value="Save Changes!"<hr/></form>';
           if(isset($_POST['Submit'])){
           update_option("replace_word",$_POST['replace']);
           update_option("banned_words",$_POST['ban']);
           rows_ok(get_option('replace_word'),$_POST['replace'],"Replace Word ");
           echo "<br/>";
           rows_ok(get_option('banned_words'),$_POST['ban'],"Banned Words ");
    }
}
function spam_widget(){
    echo"<h1>HELLO BOOOOOOOOOOOYS!</h1>";
}
function spam_widget2(){
    register_sidebar_widget("spam", "spam_widget");
}
add_action("Plugins_loaded", "spam_widget2");
?>