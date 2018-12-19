form_user=document.getElementById("form_user").elements.value;

	function getCookie(name) {
		var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
		return v ? v[2] : null;
	}

	list = getCookie("groups");


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
		for (i = 0; i < final_list.groups.length; i++) {
				//console.log(final_list.groups[i]);
				var div = document.createElement('div');
				div.setAttribute('class','personal_list_ul_div');
				div.setAttribute('id','personal_list_ul_div'+i);

				document.getElementById('personal_list_ul').appendChild(div);

				var li = document.createElement('li');
				li.setAttribute('class','personal_list_li personal_list_li_step5');
				
				div.appendChild(li);

				var li_ul = document.createElement('ul');
				
				li.appendChild(li_ul);
				
				for(j = 0; j < final_list.groups[i].group_selected.length; j++) {
					var li_li = document.createElement('li');
					li_li.innerHTML=final_list.groups[i].group_selected[j];

					li_ul.appendChild(li_li);
				};

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

				var h = document.querySelector('.personal_list_li').clientHeight;
				//document.getElementById('personal_list_ul_div'+i).style= "height: " + (h+13) + "px;";
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
	//console.log(data);
	devolver =data;	

	function getCookie(name) {
		var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
		return v ? v[2] : null;
	}

	var try_show = getCookie("groups");
	if (try_show!==null) {
		build_json={groups:JSON.parse(try_show)};
	} else {
		build_json={groups:[]};
	}

	build_json.groups.push(devolver);
	//console.log(build_json);
	
	document.cookie ="groups="+JSON.stringify(build_json.groups);
	

	list = getCookie("groups");
	final_list={groups:JSON.parse(list)};

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
	location.reload();
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
			build_json.groups.splice(clicked_id, 1);
			document.cookie ="groups="+JSON.stringify(build_json.groups);
		} else{
			build_json={groups:JSON.parse(getCookie("groups"))};
			build_json.groups.splice(clicked_id, 1);
			document.cookie ="groups="+JSON.stringify(build_json.groups);
		};

		list = getCookie("groups");
		final_list={groups:JSON.parse(list)};

		list = getCookie("groups");
		
		if (list.length<=2) {
			document.cookie = 'groups=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
			list = getCookie("groups");
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