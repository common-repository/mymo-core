<script type="text/javascript">
    var resumeId = encodeURI('5d1d90fdec293317a9cd9bb7c444ead9');
    var playerInstance = jwplayer('ajax-player');
    var files = JSON.parse('{{files}}');

    function mymoResumeVideo(a, b) {
        !0 == mymo_cfg.resume_playback && b.on("ready", function () {
            if ("undefined" != typeof Storage) {
                var c = "MyMoPlayerPosition-" + a;
                if ("" == localStorage[c] || "undefined" == localStorage[c]) {
                    var d = 0
                }
                else {
                    if ("null" == localStorage[c])
                        localStorage[c] = 0;
                    else
                        var d = localStorage[c];
                }
                b.once("play", function () {
	                0 < d && 5 < Math.abs(b.getDuration() - d) && (b.seek(d), $("body").append("<div class=\"modal fade\" id=\"resume\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mobileModalLabel\" aria-hidden=\"true\" style=\"z-index: 99999;\"><div id=\"resumeModal\" class=\"modal-dialog modal-sm\" style=\"position:relative;background: #fff;border: 1px solid #eee;padding: 20px 13px;text-align: center;border-radius: 5px;\"><p>" + mymo_cfg.resume_text + ": <b style=\"color:#f52121;\">" + formatSeconds(d) + "</b></p><div style=\"text-align:center;\"><strong class=\"yes\"><i class=\"hl-ccw\"></i> " + mymo_cfg.playback + "</strong><strong class=\"no\"><i class=\"hl-play-circled-o\"></i> " + mymo_cfg.continue_watching + "</strong></div></div></div>"), setTimeout(function () {
                        $("#resume").modal("show")
                    }, 800), $("body").on("click", ".no", function () {
                        $("#resume").modal("hide"), b.play()
                    }), $("body").on("click", ".yes", function () {
                        $("#resume").modal("hide"), localStorage[c] = 0, b.seek(0), b.play()
                    }))
                }), window.onunload = function () {
                    localStorage[c] = b.getPosition()
                }
            }
            else console.log("Your browser is too old!")
        })
    }

    function mymoJwConfig(a) {
        a.on("ready", function () {
            var b = {width: a.getWidth(), height: a.getHeight()};
            localStorage.setItem("reSizePlayerObject", JSON.stringify(b)), is_Mobile22() || mymoJwAddButton(a)
        }), a.on("error", function () {
            if ("display_modal" == mymo_cfg.player_error_detect) mymoPlayerErrorDetect(); else if ("autoload_server" == mymo_cfg.player_error_detect) {
                var a = svlists[Math.floor(Math.random() * svlists.length)];
                $("#server-item-" + a).click()
            }
            else $.fn.customErrorHandler || customErrorHandler();
            if (!0 == mymo_cfg.auto_reset_cache) {
                var b = $(".mymo-btn.active").data("episode-slug"), c = $(".mymo-btn.active").data("server"),
                    d = $(".mymo-btn.active").data("post-id");
                mymoPlayerResetCache(b, c, d)
            }
        }), a.on("play", function () {
            jQuery("#reLoadPlayerModal").modal("hide")
        }), a.on("complete", function () {
            mymoPlayerAutoNext()
        })
    }

    if(typeof playerInstance != 'undefined'){

        playerInstance.setup({
            key: "ITWMv7t88JGzI0xPwW8I0+LveiXX9SWbfdmt0ArUSyc=",
            primary: "html5",
            playlist: [{
                title: "{{moviename}}",
                image: "{{poster}}",
                sources: files,
                tracks: [],
                captions: {
                    color: "#fff",
                    fontSize: 14,
                    backgroundOpacity: 0,
                    edgeStyle: "raised"
                }
            }],
        floating: {
            dismissible: true
        },
        autoPause: {
            viewability: true,
                pauseAds: true
        },
        base: ".",
            width: "100%",
            height: "100%",
            hlshtml: true,
            autostart: true,
            fullscreen: true,
            playbackRateControls: true,
            displayPlaybackLabel: true,
            aspectratio: "16:9",
            sharing: {
            sites: [
                "reddit",
                "facebook",
                "twitter",
                "email",
                "linkedin"
            ]
        },
    });

        mymoResumeVideo(resumeId, playerInstance);
        mymoJwConfig(playerInstance);
    }

</script>