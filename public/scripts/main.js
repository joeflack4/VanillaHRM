// @author Joseph Eugene Flack IV
// @copyright 2015


//==========================================================================
// Function Definitions
//==========================================================================

// System-type Functions
//--------------------------------------------------------------------------

function isEmpty(str) {
    return (!str || 0 === str.length);
}

function elementExists(element) {
	// Tests whether or not an element exists.
	// Must pass aregument as a string.
	//var elementExists = document.getElementById("\"" + element + "\"");
	var elementExists = document.getElementById(element);
	if (elementExists == null) {
		return false;
	} else {
		return true;
	}
}


// Event Listeners
//--------------------------------------------------------------------------
//These functions throw console TypeError if null check is not performed prior to adding listener. 

function cancel_button() {
	var cancelButtonElementId = "cancel_button";
	var cancelButton = cancelButtonElementId;
	
	if (elementExists(cancelButton) === true) {
		document.getElementById(cancelButton).addEventListener("click", function(){
			history.back();
		});	
	}
	
}

function toggleVisibility(elementId) {
		var elementVisibility =document.getElementById(elementId).style.visibility;
		
		if (elementVisibility === "") {
			document.getElementById(elementId).style.visibility = "visible";
		} else if (elementVisibility === null) {
			document.getElementById(elementId).style.visibility = "visible";
		} else if (elementVisibility === "visible") {
			document.getElementById(elementId).style.visibility = "hidden";
		} else if (elementVisibility === "hidden") {
			document.getElementById(elementId).style.visibility = "visible";
		} else {
			console.log("An unknown circumstance occured in 'toggleVisibility'.");
		}		
}

function onClickToggle(toggler, togglee) {
	document.getElementById(toggler).addEventListener("click", function(){
		toggleVisibility(togglee);
	});	
}

function onHoverToggle(toggler, togglee) {
	document.getElementById(toggler).addEventListener("mouseover", function(){
		toggleVisibility(togglee);
	});
		document.getElementById(toggler).addEventListener("mouseout", function(){
		toggleVisibility(togglee);
	});		
}


//==========================================================================
// Function Calls
//==========================================================================

// System-type Functions
//--------------------------------------------------------------------------
	//Empty.

//Element Existence Test
	//var kernieexists = elementExists("kernie");
	//console.log(kernieexists);

// Event Listeners
//--------------------------------------------------------------------------
	//These don't seem to crash or register an error if the elements related are not on the page.

cancel_button();
onClickToggle("instructions_toggler", "instructions_togglee");
//onHoverToggle("toggler_01", "togglee_01");

