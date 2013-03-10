<?php
/*
Plugin Name: Comment Word Filter
Plugin URI: http://www.hamyar.org
Description: With This simple plugin you can filter some comment word as you want !
Version: 1.1
Author: Hamyar Programming Team
*/
?>
<?php
add_option('banned_words');
add_option('replace_word', 'FILTERD!');
function hamyar_filter_comment($text){
    $ban = get_option("banned_words");
    $ban_ar = explode(",",$ban);
    $re = get_option("replace_word");
    $text = str_replace($ban_ar,$re,$text);
    return $text;
}
   add_filter( 'comment_text' , 'hamyar_filter_comment');
function hamyar_rows_ok($rows,$post,$name){
    if ($rows == $post){
        echo $name . "Is/Are Saved Succesfuly!";
    }else{
        echo "A Problem occured!";
    }
}
add_action( 'admin_menu', 'hamyar_plugin_menu2');
/** Step 2 (from text above). */
add_action( 'admin_menu', 'hamyar_plugin_menu2' );

/** Step 1. */
function hamyar_plugin_menu2() {
	add_options_page( 'Hamyar Comment Filter', 'Hamyar comment filter', 'manage_options', 'Hamyar_Comment_filter', 'hamyar_plugin_options2' );
}

/** Step 3. */
function hamyar_plugin_options2() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
        echo '<form action="" method="post">';
	echo '<p>Replaced Word:<input type="text" name="replace" value=' . get_option("replace_word") . ' size="20"></p>';
        echo '<p>Banned Words:<input type="text" name="ban" value=' . get_option("banned_words") . ' size="50"></p>';
	echo '<b>You can separate words with ","</b>';
        echo '<p><input type="submit" name="hamyar_Submit" class="button-primary" value="Save Changes!"<hr/></form>';
           if(isset($_POST['hamyar_Submit'])){
           update_option("replace_word",$_POST['replace']);
           update_option("banned_words",$_POST['ban']);
           rows_ok(get_option('replace_word'),$_POST['replace'],"Replace Word ");
           echo "<br/>";
           rows_ok(get_option('banned_words'),$_POST['ban'],"Banned Words ");
    }
}
?>