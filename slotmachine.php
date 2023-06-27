<head>
    <link href="slotmachine.css" rel="stylesheet">
    <link href="animationen.css" rel="stylesheet">
</head>
<body>
    <div class="row" id="slotMachine-wrapper">
        <div class="panel panel-primary" id="boxItem">
            <div class="panel-heading">Slot Machine - Testversion</div>
            <div class="slotwrapper" id="slotmachine">
                <ul id="first">
                    <li><img src="https://via.placeholder.com/200x200/d9534f"/></li>
                    <li><img src="https://via.placeholder.com/200x200/f0ad4e"/></li>
                    <li><img src="https://via.placeholder.com/200x200/5cb85c"/></li>
                    <li><img src="https://via.placeholder.com/200x200/337ab7"/></li>
                </ul>
                <ul id="second">
                    <li><img src="https://via.placeholder.com/200x200/d9534f"/></li>
                    <li><img src="https://via.placeholder.com/200x200/f0ad4e"/></li>
                    <li><img src="https://via.placeholder.com/200x200/5cb85c"/></li>
                    <li><img src="https://via.placeholder.com/200x200/337ab7"/></li>
                </ul>
                <ul id="third">
                    <li><img src="https://via.placeholder.com/200x200/d9534f"/></li>
                    <li><img src="https://via.placeholder.com/200x200/f0ad4e"/></li>
                    <li><img src="https://via.placeholder.com/200x200/5cb85c"/></li>
                    <li><img src="https://via.placeholder.com/200x200/337ab7"/></li>
                </ul>
            </div>
            <div>
                <br><button type="button" class="cls_btn" id="btn-slotmachine" onclick="des_cookieSet('boxItem', 10)"><i></i></button>
                <p id="txt_dis" style="background-color: #162761; color: white;">Du hast 5 versuche, davon <span id="display">0</span> verbraucht</p>
            </div>
        </div>
		
		<div id="toggle-wrapper">
		 <div id="win_spin" class="text-center"></div>
         <div id="lose_spin" class="text-center"></div>
		<div id="cookie_mood"><span>Komm morgen nochmal vorbei.</br> und versuch's erneut!</span></br>
        </div>
	  </div>
    </div>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script>

		/* ========= 202010701 Cookie Handling to save config for next visit =================== */
		
// how many spins can clickid
var count = 0;
var clickLimit = 5;
var btn = document.getElementById("btn-slotmachine");
var disp = document.getElementById("display");	
		
function des_cookieSet(name, value, expire) {
    var days = typeof expire == 'undefined' ? 1 : expire;
    var path = '/';
    var domain = document.location.host;
    var ck_name = name;

    var expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = ck_name + '=' + value + '; expires=' + expires.toUTCString() + '; path=' + path + '; domain=' + domain;

    if (count == clickLimit) {
        btn.disabled = true;
        setTimeout(function() {
            //document.getElementById("boxItem").style.display = "none";
			//document.getElementById("cookie_mood").style.display = "block";
			//document.getElementById("lose_spin").style.display = "block";
        }, value * 1000);
    }
    count++;
    disp.innerHTML = count;
}

if (document.cookie) {
    document.getElementById("boxItem").style.display = "none";
    document.getElementById("win_spin").style.display = "none";
    document.getElementById("cookie_mood").style.display = "block";
}
function des_cookieDel(name, settings) {
    var path = '/';
    var domain = document.location.host;
    var ck_name = name;
    document.cookie = ck_name + '=; max-age=0; path=' + path + '; domain=' + domain;
}
function des_getCookie(name) {
    var ck_name = name;
    var b = document.cookie.match('(^|;)\\s*' + ck_name + '\\s*=\\s*([^;]+)');
    return b ? b.pop() : '';
}
function des_debugCookie() {
    return document.cookie.split("; ");
}
/* ========= 202010701 Cookie Handling to save config for next visit =================== */
				
// Ajax Request // Json
// [win_spin] [lose_spin]
$('.cls_btn').click(function() {
            $.ajax({
                url: "index.php",
            }).done(function(data) {
				$('#win_spin').html(data.ergebnis_won).hide();
				$('#lose_spin').html(data.ergebnis_lose).hide();
			if(data.ergebnis_won){
				$( "#lose_spin" ).hide();
				$( "#boxItem" ).show();
				setTimeout(function() { $("#boxItem").hide(); }, 10000);
				$( "#win_spin" ).hide();
				setTimeout(function() { $("#win_spin").fadeIn(); }, 10000);
				}
			else if(data.ergebnis_lose && count == clickLimit){
				$( "#win_spin" ).hide();
				$( "#boxItem" ).show();
				setTimeout(function() { $("#boxItem").hide(); },  10000);
				$( "#lose_spin" ).hide();
				$( "#cookie_mood" ).hide();
				//document.getElementById("cookie_mood").style.display = "block";
				setTimeout(function() { $("#lose_spin").fadeIn(); },  10000);
				setTimeout(function() { $("#cookie_mood").fadeIn(); },  10000);
				} 
				console.log (data);
                //numKeepTrack = 3; 
                $('#slotmachine #first').playSpin({
                    manualStop: false,
                    loops: 6,
                    endNum: data.first
                    // easing: 'easeOutBack'
                });
                $('#slotmachine #second').playSpin({
                    manualStop: false,
                    loops: 6,
					endNum: data.second
                    // easing: 'easeOutBack'
                });
                $('#slotmachine #third').playSpin({
                    manualStop: false,
                    loops: 6,
					endNum: data.third
                    // easing: 'easeOutBack'
                });

				
            })
        });
		
		
var startSeqs = {};
var startNum = 0;

// jQuery FN
// JS SlotMachine Animation
// Ab hier wurde nichts abgeändert oder hinzufügt!
$.fn.playSpin = function(options) {
    if (this.length) {
        if ($(this).is(':animated')) return; // Return false if this element is animating
        startSeqs['mainSeq' + (++startNum)] = {};
        $(this).attr('data-playslot', startNum);

        var total = this.length;
        var thisSeq = 0;

        // Initialize options
        if (typeof options == 'undefined') {
            options = new Object();
        }

        // Pre-define end nums
        var endNums = [];
        if (typeof options.endNum != 'undefined') {
            if ($.isArray(options.endNum)) {
                endNums = options.endNum;
            } else {
                endNums = [options.endNum];
            }
        }

        for (var i = 0; i < this.length; i++) {
            if (typeof endNums[i] == 'undefined') {
                endNums.push(0);
            }
        }

        startSeqs['mainSeq' + startNum]['totalSpinning'] = total;
        return this.each(function() {
            options.endNum = endNums[thisSeq];
            startSeqs['mainSeq' + startNum]['subSeq' + (++thisSeq)] = {};
            startSeqs['mainSeq' + startNum]['subSeq' + thisSeq]['spinning'] = true;
            var track = {
                total: total,
                mainSeq: startNum,
                subSeq: thisSeq
            };
            (new slotMachine(this, options, track));
        });
    }
};

$.fn.stopSpin = function() {
    if (this.length) {
        if (!$(this).is(':animated')) return; // Return false if this element is not animating
        if ($(this)[0].hasAttribute('data-playslot')) {
            $.each(startSeqs['mainSeq' + $(this).attr('data-playslot')], function(index, obj) {
                obj['spinning'] = false;
            });
        }
    }
};

var slotMachine = function(el, options, track) {
    var slot = this;
    slot.$el = $(el);

    slot.defaultOptions = {
        easing: 'swing', // String: easing type for final spin
        time: 3000, // Number: total time of spin animation
        loops: 6, // Number: times it will spin during the animation
        manualStop: false, // Boolean: spin until user manually click to stop
        stopSeq: 'random', // String: sequence of slot machine end animation, random, leftToRight, rightToLeft
        endNum: 0, // Number: animation end at which number/ sequence of list
        onEnd: $.noop, // Function: run on each element spin end, it is passed endNum
        onFinish: $.noop // Function: run on all element spin end, it is passed endNum
    };

    slot.spinSpeed = 0;
    slot.loopCount = 0;

    slot.init = function() {
        slot.options = $.extend({}, slot.defaultOptions, options);
        slot.setup();
        slot.startSpin();
    };

    slot.setup = function() {
        var $li = slot.$el.find('li').first();
        slot.liHeight = $li.innerHeight();
        slot.liCount = slot.$el.children().length;
        slot.listHeight = slot.liHeight * slot.liCount;
        slot.spinSpeed = slot.options.time / slot.options.loops;

        $li.clone().appendTo(slot.$el); // Clone to last row for smooth animation

        // Configure stopSeq
        if (slot.options.stopSeq == 'leftToRight') {
            if (track.subSeq != 1) {
                slot.options.manualStop = true;
            }
        } else if (slot.options.stopSeq == 'rightToLeft') {
            if (track.total != track.subSeq) {
                slot.options.manualStop = true;
            }
        }
    };

    slot.startSpin = function() {
        slot.$el
            .css('top', -slot.listHeight)
            .animate({
                'top': '0px'
            }, slot.spinSpeed, 'linear', function() {
                slot.lowerSpeed();
            });
    };

    slot.lowerSpeed = function() {
        slot.loopCount++;

        if (slot.loopCount < slot.options.loops ||
            (slot.options.manualStop && startSeqs['mainSeq' + track.mainSeq]['subSeq' + track.subSeq]['spinning'])) {
            slot.startSpin();
        } else {
            slot.endSpin();
        }
    };

    slot.endSpin = function() {
        if (slot.options.endNum == 0) {
            slot.options.endNum = slot.randomRange(1, slot.liCount);
        }

        // Error handling if endNum is out of range
        if (slot.options.endNum < 0 || slot.options.endNum > slot.liCount) {
            slot.options.endNum = 1;
        }

        var finalPos = -((slot.liHeight * slot.options.endNum) - slot.liHeight);
        var finalSpeed = ((slot.spinSpeed * 1.5) * (slot.liCount)) / slot.options.endNum;

        slot.$el
            .css('top', -slot.listHeight)
            .animate({
                'top': finalPos
            }, finalSpeed, slot.options.easing, function() {
                slot.$el.find('li').last().remove(); // Remove the cloned row

                slot.endAnimation(slot.options.endNum);
                if ($.isFunction(slot.options.onEnd)) {
                    slot.options.onEnd(slot.options.endNum);
                }

                // onFinish is every element is finished animation
                if (startSeqs['mainSeq' + track.mainSeq]['totalSpinning'] == 0) {
                    var totalNum = '';
                    $.each(startSeqs['mainSeq' + track.mainSeq], function(index, subSeqs) {
                        if (typeof subSeqs == 'object') {
                            totalNum += subSeqs['endNum'].toString();
                        }
                    });
                    if ($.isFunction(slot.options.onFinish)) {
                        slot.options.onFinish(totalNum);
                    }
                }
            });
    }

    slot.endAnimation = function(endNum) {
        if (slot.options.stopSeq == 'leftToRight' && track.total != track.subSeq) {
            startSeqs['mainSeq' + track.mainSeq]['subSeq' + (track.subSeq + 1)]['spinning'] = false;
        } else if (slot.options.stopSeq == 'rightToLeft' && track.subSeq != 1) {
            startSeqs['mainSeq' + track.mainSeq]['subSeq' + (track.subSeq - 1)]['spinning'] = false;
        }
        startSeqs['mainSeq' + track.mainSeq]['totalSpinning']--;
        startSeqs['mainSeq' + track.mainSeq]['subSeq' + track.subSeq]['endNum'] = endNum;
    }

    slot.randomRange = function(low, high) {
        return Math.floor(Math.random() * (1 + high - low)) + low;
    };

    this.init();

};
	</script>
</body>