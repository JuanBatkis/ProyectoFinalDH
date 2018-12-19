/*console.log("work");
    expand=1;
    if (expand==1) {
      var h = document.querySelector('.personal_list_li').clientHeight;
      console.log(h);
      document.getElementsByClassName("personal_list_ul_div").style= "height: " + (h+13) + "px;";
      expand=0;
		}*/
		
		expand=0;

		function getCookie(name) {
			var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
			return v ? v[2] : null;
		}
		window.onload = function() {
			var try_show = getCookie("builds");
			final_list={builds:JSON.parse(try_show)};
			if (try_show!==null) {
				please_work();
			}
		};