/* simple form validation: check if form is empty */

function validateForm(form, input) {
	if (document.forms[form][input] == "") {
		alert("Must be filled out");
		return false;
	}
	return true;
}

