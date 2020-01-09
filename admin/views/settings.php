<?php
include MY_PLUGIN_PATH . '/params.php';
 $buttons_show=$this->deserializer->get_value( 'tutsplus-custom-data' );
 if($buttons_show=="")
 {
    for($i=0;$i<count($buttons);$i++)
    {
        $buttons_show .="0";
    }
 }
?>
<div class="wrap">
 
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 
    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
 
        <div id="universal-message-container">
            <h2>Социальные кнопки поделиться</h2>
            <div class="options">
                    <label>Вкл./Вкл. нажатием на кнопку</label>
                    <hr/>
                    <div class="social-buttons">
                        <?php foreach ($buttons as $key => $button) {
                            if($buttons_show{$key}==1)
                            {
                                $buttons_show_items .="{$button},";
                                print "<div class=\"social-enabled\" data-number=\"{$key}\" data-id=\"1\" id=\"{$button}\">{$button}</div>";
                            }else{
                                print "<div data-number=\"{$key}\" data-id=\"0\" id=\"{$button}\">{$button}</div>";
                            }
                        }?>
                    </div>
                    <input type="hidden" name="acme-buttons" id="social-buttons" value="<?php print $buttons_show; ?>" /><hr/>
                <?php if($buttons_show_items!=NULL){ ?>
                    <label>Включенные:</label>
                    <div class="ya-share2" data-services="<?php print $buttons_show_items; ?>"></div><hr/>
                <? } ?>

        </div><!-- #universal-message-container -->
    </div>
        <?php
            wp_nonce_field( 'acme-settings-save', 'acme-custom-message' );
            submit_button();
        ?>
    </form>
 
</div><!-- .wrap -->