<?php

class Ws_Bootstrap_Vc_Shortcodes
{
    public static  $instance ;
    public function __construct()
    {
        self::$instance = $this;
        $this->wsShortcodesBootstrap();
    }
    
    public static function instance()
    {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function wsShortcodesBootstrap()
    {
        add_shortcode( 'ws_card', array( $this, 'wsCardShortcode' ) );
        add_shortcode( 'ws_popover', array( $this, 'wsPopoverShortcode' ) );
        add_shortcode( 'ws_jumbotron', array( $this, 'wsJumbotronShortcode' ) );
        add_shortcode( 'ws_alert', array( $this, 'wsAlertShortcode' ) );
    }
    
    public function wsCardShortcode( $atts, $content = null )
    {
        $atts_card = shortcode_atts( array(
            'title'       => '',
            'image_url'   => '',
            'button_text' => '',
            'button_url'  => '',
        ), $atts );
        ob_start();
        ?> 
        <div class="card">
            <img src="<?php 
        echo  $atts_card['image_url'] ;
        ?>" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><?php 
        echo  $atts_card['title'] ;
        ?></h5>
                <p class="card-text"><?php 
        echo  $content ;
        ?></p>
                <?php 
        
        if ( !empty($atts_card['button_text']) ) {
            ?>
                    <a href="#" class="btn btn-primary"><?php 
            echo  $atts_card['button_text'] ;
            ?></a>
                <?php 
        }
        
        ?>
            </div>
        </div>
        <?php 
        return ob_get_clean();
    }
    
    public function wsPopoverShortcode( $atts )
    {
        $atts_popover = shortcode_atts( array(
            'title'        => '',
            'data_content' => '',
        ), $atts );
        ob_start();
        ?> 
        <button type="button" 
                class="btn btn-lg btn-danger" 
                data-toggle="popover" 
                title="<?php 
        echo  $atts_popover['title'] ;
        ?>" 
                data-content="<?php 
        echo  $atts_popover['data_content'] ;
        ?>"><?php 
        echo  $atts_popover['title'] ;
        ?></button>

        <?php 
        return ob_get_clean();
    }
    
    public function wsJumbotronShortcode( $atts, $content = null )
    {
        $atts_jumbotron = shortcode_atts( array(
            'title'       => '',
            'lead'        => '',
            'button_text' => '',
            'button_url'  => '',
        ), $atts );
        ob_start();
        ?> 
        <div class="jumbotron">
          <h1 class="display-4"> <?php 
        echo  $atts_jumbotron['title'] ;
        ?> </h1>
          <p class="lead"> <?php 
        echo  $atts_jumbotron['lead'] ;
        ?> </p>
          <hr class="my-4">
          <p> <?php 
        echo  $content ;
        ?> </p>
          <a class="btn btn-primary btn-lg" href="<?php 
        echo  $atts_jumbotron['button_url'] ;
        ?>" role="button"> <?php 
        echo  $atts_jumbotron['button_text'] ;
        ?> </a>
        </div>
        <?php 
        return ob_get_clean();
    }
    
    public function wsModalShortcode( $atts, $content = null )
    {
    }
    
    public function wsAlertShortcode( $atts, $content = null )
    {
        $atts_alerts = shortcode_atts( array(
            'type' => '',
        ), $atts );
        ob_start();
        ?> 
            <div class="alert <?php 
        echo  ${$atts_alerts['type']} ;
        ?>" role="alert">
                <?php 
        echo  $content ;
        ?>
            </div>
        <?php 
        return ob_get_clean();
    }

}