function ver(id) {
  build_id=id;
  build_id=build_id.replace('build_card_latest','');
  build_id=parseInt(build_id);
  //console.log(build_id);

  var elmnt = document.getElementById(id);
  var cln = elmnt.cloneNode(true);
  document.getElementById('build_more_info').appendChild(cln);
  document.getElementById('build_more_info').style="display: flex;"

  cln.setAttribute('style','transform: scale(1.5);');

  cln.setAttribute('class','build_card build_card_info');

  cln.setAttribute('onclick','');

  var list = document.createElement('div');
  list.setAttribute('class', 'soft_list_div');
  list.setAttribute('style', 'margin-left: 180px; transform: scale(1.4); background-color: white; border-radius: 8px; padding: 12px; font-size: 16px; border: 3px solid #15171e; box-shadow: 0px 0px 0px 3px white;');

  document.getElementById('build_more_info').appendChild(list);

  var soft_list = document.getElementById(id+'_list');
  var soft_list_cln = soft_list.cloneNode(true);
  document.querySelector('.soft_list_div').appendChild(soft_list_cln);
  soft_list_cln.setAttribute('style','transform: scale(1); display: block;');

  soft_list_cln.children[0].setAttribute('style' ,'font-size: 20px; margin: 15px 0 0 0;');


  if (auth) {
    make='useful()';
  } else {
    make='cerrar()';
  }
  var i = document.createElement('i');
  i.setAttribute('class','fas fa-times cross_close');
  i.setAttribute('onclick', make);

  document.getElementById('build_more_info').appendChild(i);
}

function useful() {
  var myNode = document.getElementById("build_more_info");
  while (myNode.firstChild) {
      myNode.removeChild(myNode.firstChild);
  }

  var useful_div = document.createElement('div');
  useful_div.setAttribute('class', 'useful_div');
  useful_div.setAttribute('id', 'useful_div');

  document.getElementById('build_more_info').appendChild(useful_div);

  var useful_text = document.createElement('h4');
  useful_text.innerHTML='Was this build useful?';
  useful_text.setAttribute('class', 'useful_text');

  useful_div.appendChild(useful_text);

  var answer_div = document.createElement('div');
  answer_div.setAttribute('class', 'answer_div');

  useful_div.appendChild(answer_div);

  var i1 = document.createElement('i');
  i1.setAttribute('class', 'fas fa-check');
  i1.setAttribute('onclick', 'like('+build_id+')');
  var line = document.createElement('div');
  line.setAttribute('class', 'useful_line');
  var i2 = document.createElement('i');
  i2.setAttribute('class', 'fas fa-times');
  i2.setAttribute('onclick', 'cerrar()');

  answer_div.appendChild(i1);
  answer_div.appendChild(line);
  answer_div.appendChild(i2);
}

function like(id) {
  var xmlhttp = new XMLHttpRequest();

  function show_error(to_show) {
    if (answer!=="0") {
      var myNode = document.getElementById("useful_div");
      while (myNode.firstChild) {
          myNode.removeChild(myNode.firstChild);
      }

      var text = document.createElement('h4');
      text.innerHTML=to_show;
      text.setAttribute('class', 'useful_text');
      document.getElementById("useful_div").appendChild(text);

      var i = document.createElement('i');
      i.setAttribute('class','fas fa-times cross_close_final');
      i.setAttribute('onclick', 'cerrar()');
      document.getElementById('useful_div').appendChild(i);
    }
  };

  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      answer=xmlhttp.responseText;
      show="";

      switch (answer) {
        case "0":
          show="todo bien";
          break;
        
        case "1":
          show="You can't upvote your own build";
          break;

        case "2":
          show="You can't upvote a build more than one time";
          break;
      
        default:
          break;
      }

      console.log(show);
      //console.log(answer);
      if (show=="todo bien") {
        cerrar();
      }

      show_error(show);
    }
  };

  xmlhttp.open("GET", "/like/"+id, true);
  xmlhttp.send();

  //let token = document.querySelector('meta[name="csrftoken"]').getAttribute('content');
  //let url = "/like/"+id;
}

function cerrar() {
  document.getElementById('build_more_info').style="display: none;"
  var myNode = document.getElementById("build_more_info");
  while (myNode.firstChild) {
      myNode.removeChild(myNode.firstChild);
  }
}



//console.log(auth);

/*<div id="useful" class="useful">
		<i class="fas fa-desktop"></i>
		<i class="fas fa-heart"></i>
</div>*/