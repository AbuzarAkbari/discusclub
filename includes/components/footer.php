<div class="footer-wrapper ">
  <div class="container-fluid"></div>
     <div class='container'>
        <div class='container-fluid text-center'>
            <div class='row'>
              <div class='col-md-4'>
                  <h3 class='footer-title'><b>Vind ons leuk!</b></h3>
                  <br>
                  <div class="fb-page" data-href="https://www.facebook.com/DiscusClubHolland/?ref=br_rs" data-tabs="timeline" data-height="376" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/DiscusClubHolland/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/DiscusClubHolland/?ref=br_rs">Discus Club Holland</a></blockquote></div>
              </div>
              <div class='col-md-4'>
                  <h3 class='footer-title'><b>Volg ons op Twitter!</b></h3>
                    <br>
                  <a class='twitter-timeline col-md-3' href='https://twitter.com/DiscusHolland?ref_src=twsrc%5Etfw' data-width='380' data-height='376' >Tweets by DiscusHolland</a> <script async src='//platform.twitter.com/widgets.js' charset='utf-8'></script>
              </div>
              <div class='col-md-4'>
                  <h3 class='footer-title'><b>Contact</b></h3>
                  <br>

                  <form class='' action='/includes/tools/verwerk' method='post'>
                      <h5 class="FooterContactTekst">Heeft u feedback, of een vraag?
                          <br>
                          Stuur ons een bericht!
                      </h5>
                      <input class='footer-name' type='text' name='naam' value='' placeholder='Naam'><br>
                      <input class='footer-mail' required type='email' name='email' value='' placeholder='Email'><br>
                      <textarea class='footer-message' name='bericht' placeholder='Uw bericht' style='resize: none;'></textarea><br>
                      <input class='lees-meer-btn footer-btn' type='submit' name='send' value='Verzenden'>
                  </form>
              </div>
            </div>
            <div style="position: fixed; bottom: 0px; right: 0px; cursor: pointer;">
                <img src="../../images/MessengerIcon.png" onclick="showChat()">
            </div>
            <br>
            <div class='col-md-12 text-center'>
                <a href='/'>&copy; Discus Club Holland</a> | <a target="_blank" href='http://succes.media/'>Webdesign door Succes Media</a> | <a arget="_blank" href='/gebruiksvoorwaarden'>Algemene voorwaarden</a>
            </div>
            <br><br>
        </div>
      </div>
        <div class="container-fluid"></div>

  </div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '557243647957650',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v2.10'
        });
    };

    function showChat() {
        $('#show-fb-chat').toggle();
    }
</script>

<div class="fb-page"
     id = "show-fb-chat"
     data-href="https://www.facebook.com/wesley.keiman.35"
     data-tabs="messages"
     data-width="400"
     data-height="300"
     data-small-header="true" style="display: none; position: fixed; bottom: 150px; right: 0px;">
    <div class="fb-xfbml-parse-ignore">
        <blockquote></blockquote>
    </div>
</div>
