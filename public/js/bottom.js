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

form_user=document.getElementById("form_user").elements.value;

	function getCookie(name) {
		var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
		return v ? v[2] : null;
	}

	list = getCookie("builds");


	if (list!==null) {
		document.getElementById("test_empty_ul").style.display="none";
		document.getElementById("personal_list_ul").style.opacity="1";
		document.getElementById("personal_list_ul").style.position="unset";
	} else{
		document.getElementById("test_empty_ul").style.display="block";
		document.getElementById("personal_list_ul").style.opacity="0";
		document.getElementById("personal_list_ul").style.position="absolute";
	};



	function please_work(){
		var i;
		for (i = 0; i < final_list.builds.length; i++) {
				//console.log(final_list.builds[i]);
				var div = document.createElement('div');
				div.setAttribute('class','personal_list_ul_div');
				div.setAttribute('id','personal_list_ul_div'+i);
				div.setAttribute('onclick','expandir(this.id)');

				document.getElementById('personal_list_ul').appendChild(div);

				var li = document.createElement('li');
				li.setAttribute('class','personal_list_li');
				li.innerHTML=final_list.builds[i].name;

				div.appendChild(li);

				var a_t = document.createElement('a');
				a_t.setAttribute('class','trash_all');
				a_t.setAttribute('id', i);
				a_t.setAttribute('onclick','borrar(this.id, event)');

				li.appendChild(a_t);

				var i_1 = document.createElement('i');
				i_1.setAttribute('class','trash_bin fas fa-trash');

				a_t.appendChild(i_1);

				var i_2 = document.createElement('i');
				i_2.setAttribute('class','trash_lid fas fa-trash');

				a_t.appendChild(i_2);

				var ul_info = document.createElement('ul');
				ul_info.setAttribute('class','personal_list_ul_ul');

				div.appendChild(ul_info);

				var li_info = document.createElement('li');
				li_info.innerHTML="Ram: "+final_list.builds[i].ram+" gb";
				ul_info.appendChild(li_info);

				var li_info = document.createElement('li');
				li_info.innerHTML="CPU brand: "+final_list.builds[i].cpu_brand;
				ul_info.appendChild(li_info);

				var li_info = document.createElement('li');
				li_info.innerHTML="Bit requirement: "+final_list.builds[i].bit;
				ul_info.appendChild(li_info);
				
				var li_info = document.createElement('li');
				li_info.innerHTML="Multicore: "+final_list.builds[i].multicore;
				ul_info.appendChild(li_info);

				var li_info = document.createElement('li');
				li_info.innerHTML="GPU brand: "+final_list.builds[i].gpu_brand;
				ul_info.appendChild(li_info);

				var li_info = document.createElement('li');
				li_info.innerHTML="Vram: "+final_list.builds[i].v_ram+" gb";
				ul_info.appendChild(li_info);

				var li_info = document.createElement('li');
				li_info.innerHTML="OpenGL: "+final_list.builds[i].openGl;
				ul_info.appendChild(li_info);

				var li_info = document.createElement('li');
				li_info.innerHTML="Disk space: "+final_list.builds[i].disk+" gb";
				ul_info.appendChild(li_info);

				var h = document.querySelector('.personal_list_li').clientHeight;
				document.getElementById('personal_list_ul_div'+i).style= "height: " + (h+13) + "px;";
		}
	};





	/**
 * Checks that an element has a non-empty `name` and `value` property.
 * @param  {Element} element  the element to check
 * @return {Bool}             true if the element is an input, false if not
 */
const isValidElement = element => {
  return element.name && element.value;
};

/**
 * Checks if an element’s value can be saved (e.g. not an unselected checkbox).
 * @param  {Element} element  the element to check
 * @return {Boolean}          true if the value should be added, false if not
 */
const isValidValue = element => {
  return (!['checkbox', 'radio'].includes(element.type) || element.checked);
};

/**
 * Checks if an input is a checkbox, because checkboxes allow multiple values.
 * @param  {Element} element  the element to check
 * @return {Boolean}          true if the element is a checkbox, false if not
 */
const isCheckbox = element => element.type === 'checkbox';

/**
 * Checks if an input is a `select` with the `multiple` attribute.
 * @param  {Element} element  the element to check
 * @return {Boolean}          true if the element is a multiselect, false if not
 */
const isMultiSelect = element => element.options && element.multiple;

/**
 * Retrieves the selected options from a multi-select as an array.
 * @param  {HTMLOptionsCollection} options  the options for the select
 * @return {Array}                          an array of selected option values
 */
const getSelectValues = options => [].reduce.call(options, (values, option) => {
  return option.selected ? values.concat(option.value) : values;
}, []);

/**
 * A more verbose implementation of `formToJSON()` to explain how it works.
 *
 * NOTE: This function is unused, and is only here for the purpose of explaining how
 * reducing form elements works.
 *
 * @param  {HTMLFormControlsCollection} elements  the form elements
 * @return {Object}                               form data as an object literal
 */
const formToJSON_deconstructed = elements => {
  
  // This is the function that is called on each element of the array.
  const reducerFunction = (data, element) => {
    
    // Add the current field to the object.
    data[element.name] = element.value;
    
    // For the demo only: show each step in the reducer’s progress.
    //console.log(JSON.stringify(data));

    return data;
  };
  
  // This is used as the initial value of `data` in `reducerFunction()`.
  const reducerInitialValue = {};
  
  // To help visualize what happens, log the inital value, which we know is `{}`.
  //console.log('Initial `data` value:', JSON.stringify(reducerInitialValue));
  
  // Now we reduce by `call`-ing `Array.prototype.reduce()` on `elements`.
  const formData = [].reduce.call(elements, reducerFunction, reducerInitialValue);
  
  // The result is then returned for use elsewhere.
  return formData;
};

/**
 * Retrieves input data from a form and returns it as a JSON object.
 * @param  {HTMLFormControlsCollection} elements  the form elements
 * @return {Object}                               form data as an object literal
 */
const formToJSON = elements => [].reduce.call(elements, (data, element) => {

  // Make sure the element has the required properties and should be added.
  if (isValidElement(element) && isValidValue(element)) {

    /*
     * Some fields allow for more than one value, so we need to check if this
     * is one of those fields and, if so, store the values as an array.
     */
    if (isCheckbox(element)) {
      data[element.name] = (data[element.name] || []).concat(element.value);
    } else if (isMultiSelect(element)) {
      data[element.name] = getSelectValues(element);
    } else {
      data[element.name] = element.value;
    }
  }

  return data;
}, {});

/**
 * A handler function to prevent default submission and run our custom script.
 * @param  {Event} event  the submit event triggered by the user
 * @return {void}
 */
const handleFormSubmit = event => {
  
  // Stop the form from submitting since we’re handling that with AJAX.
  event.preventDefault();
  
  // Call our function to get the form data.
  const data = formToJSON(form.elements);

  // Demo only: print the form data onscreen as a formatted JSON object.
  //const dataContainer = document.getElementsByClassName('results__display')[0];
  
  // Use `JSON.stringify()` to make the output valid, human-readable JSON.
	//dataContainer.textContent = JSON.stringify(data, null, "  ");
  
  // ...this is where we’d actually do something with the form data...
	
	if (data.name==undefined||data.ram==undefined||data.cpu_brand==undefined||data.bit==undefined||data.multicore==undefined||data.gpu_brand==undefined||data.v_ram==undefined||data.openGl==undefined||data.disk==undefined) {
		return;
	}
	
	devolver =data;	

	function getCookie(name) {
		var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
		return v ? v[2] : null;
	}

	var try_show = getCookie("builds");
	if (try_show!==null) {
		build_json={builds:JSON.parse(try_show)};
	} else {
		build_json={builds:[]};
	}

	build_json.builds.push(devolver);
	//console.log(build_json);
	
	document.cookie ="builds="+JSON.stringify(build_json.builds);
	

	list = getCookie("builds");
	final_list={builds:JSON.parse(list)};

	if (list!==null) {
		document.getElementById("test_empty_ul").style.display="none";
		document.getElementById("personal_list_ul").style.opacity="1";
		document.getElementById("personal_list_ul").style.position="unset";
	} else{
		document.getElementById("test_empty_ul").style.display="block";
		document.getElementById("personal_list_ul").style.opacity="0";
		document.getElementById("personal_list_ul").style.position="absolute";
	}

	var myNode = document.getElementById("personal_list_ul");
	while (myNode.firstChild) {
			myNode.removeChild(myNode.firstChild);
	}

	
	please_work();

	//location.reload();
	document.documentElement.scrollTop = 0;
};

/*
 * This is where things actually get started. We find the form element using
 * its class name, then attach the `handleFormSubmit()` function to the 
 * `submit` event.
 */
const form = document.getElementsByClassName('contact-form')[0];
form.addEventListener('submit', handleFormSubmit);


	function borrar(clicked_id, e) {
		function getCookie(name) {
			var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
			return v ? v[2] : null;
		}
    id_trash="personal_list_ul_div"+clicked_id;
		
		if(typeof build_json == undefined){
			build_json.builds.splice(clicked_id, 1);
			document.cookie ="builds="+JSON.stringify(build_json.builds);
		} else{
			build_json={builds:JSON.parse(getCookie("builds"))};
			build_json.builds.splice(clicked_id, 1);
			document.cookie ="builds="+JSON.stringify(build_json.builds);
		};

		list = getCookie("builds");
		final_list={builds:JSON.parse(list)};

		list = getCookie("builds");
		
		if (list.length<=2) {
			document.cookie = 'builds=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
			list = getCookie("builds");
		}


		if (list!==null) {
			document.getElementById("test_empty_ul").style.display="none";
			document.getElementById("personal_list_ul").style.opacity="1";
			document.getElementById("personal_list_ul").style.position="unset";
		} else{
			document.getElementById("test_empty_ul").style.display="block";
			document.getElementById("personal_list_ul").style.opacity="0";
			document.getElementById("personal_list_ul").style.position="absolute";
		};
		
    document.getElementById(id_trash).style.display= "none";
    if (window.event) {
      window.event.cancelBubble=true;
    } else {
      if (e.cancelable ) {e.stopPropagation();}
		}

		location.reload();
  }

  function expandir(clicked_id) {
		x = document.getElementById("personal_list_ul").childElementCount;
		h = document.querySelector('.personal_list_li').clientHeight;
		h_ul = document.querySelector('.personal_list_ul_ul').clientHeight;
		w = document.querySelector('.personal_list_li').clientWidth;
		for(var i=0; i<x; i=i+1) {
			var id="personal_list_ul_div"+i;
			document.getElementById(id).style= "height: " + (h+13) + "px;";
		}

    if (expand==0) {
      document.getElementById(clicked_id).style= "height: " + (h+13+h_ul+10) + "px;";
      expand=1;
    } else {
      document.getElementById(clicked_id).style= "height: " + (h+13) + "px;";
      expand=0;
    }
  }