swal("Here's a message!")
swal("Here's a message!", "It's pretty, isn't it?")
swal("Good job!", "You clicked the button!", "success")
swal({   title: "Are you sure?",   text: "You will not be able to recover this imaginary file!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){   swal("Deleted!", "Your imaginary file has been deleted.", "success"); });
swal({   title: "Are you sure?",   text: "You will not be able to recover this imaginary file!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   cancelButtonText: "No, cancel plx!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {     swal("Deleted!", "Your imaginary file has been deleted.", "success");   } else {     swal("Cancelled", "Your imaginary file is safe :)", "error");   } });

swal({   title: "Sweet!",   text: "Here's a custom image.",   imageUrl: "images/thumbs-up.jpg" });

swal({   title: "HTML <small>Title</small>!",   text: "A custom <span style="color:#F8BB86">html<span> message.",   html: true });

swal({   title: "Auto close alert!",   text: "I will close in 2 seconds.",   timer: 2000,   showConfirmButton: false });

swal({   title: "An input!",   text: "Write something interesting:",   type: "input",   showCancelButton: true,   closeOnConfirm: false,   animation: "slide-from-top",   inputPlaceholder: "Write something" }, function(inputValue){   if (inputValue === false) return false;      if (inputValue === "") {     swal.showInputError("You need to write something!");     return false   }      swal("Nice!", "You wrote: " + inputValue, "success"); });

swal({   title: "Ajax request example",   text: "Submit to run ajax request",   type: "info",   showCancelButton: true,   closeOnConfirm: false,   showLoaderOnConfirm: true, }, function(){   setTimeout(function(){     swal("Ajax request finished!");   }, 2000); });

title	null (required)	The title of the modal. It can either be added to the object under the key "title" or passed as the first parameter of the function.
text	null	A description for the modal. It can either be added to the object under the key "text" or passed as the second parameter of the function.
type	null	The type of the modal. SweetAlert comes with 4 built-in types which will show a corresponding icon animation: "warning", "error", "success" and "info". You can also set it as "input" to get a prompt modal. It can either be put in the object under the key "type" or passed as the third parameter of the function.
allowEscapeKey	true	If set to true, the user can dismiss the modal by pressing the Escape key.
customClass	null	A custom CSS class for the modal. It can be added to the object under the key "customClass".
allowOutsideClick	false	If set to true, the user can dismiss the modal by clicking outside it.
showCancelButton	false	If set to true, a "Cancel"-button will be shown, which the user can click on to dismiss the modal.
showConfirmButton	true	If set to false, the "OK/Confirm"-button will be hidden. Make sure you set a timer or set allowOutsideClick to true when using this, in order not to annoy the user.
confirmButtonText	"OK"	Use this to change the text on the "Confirm"-button. If showCancelButton is set as true, the confirm button will automatically show "Confirm" instead of "OK".
confirmButtonColor	"#AEDEF4"	Use this to change the background color of the "Confirm"-button (must be a HEX value).
cancelButtonText	"Cancel"	Use this to change the text on the "Cancel"-button.
closeOnConfirm	true	Set to false if you want the modal to stay open even if the user presses the "Confirm"-button. This is especially useful if the function attached to the "Confirm"-button is another SweetAlert.
closeOnCancel	true	Same as closeOnConfirm, but for the cancel button.
imageUrl	null	Add a customized icon for the modal. Should contain a string with the path to the image.
imageSize	"80x80"	If imageUrl is set, you can specify imageSize to describes how big you want the icon to be in px. Pass in a string with two values separated by an "x". The first value is the width, the second is the height.
timer	null	Auto close timer of the modal. Set in ms (milliseconds).
html	false	If set to true, will not escape title and text parameters. (Set to false if you're worried about XSS attacks.)
animation	true	If set to false, the modal's animation will be disabled. Possible (string) values : pop (default when animation set to true), slide-from-top, slide-from-bottom
inputType	"text"	Change the type of the input field when using type: "input" (this can be useful if you want users to type in their password for example).
inputPlaceholder	null	When using the input-type, you can specify a placeholder to help the user.
inputValue	null	Specify a default text value that you want your input to show when using type: "input"
showLoaderOnConfirm	false	Set to true to disable the buttons and show that something is loading.
METHODS

SweetAlert also comes with some simple methods that you can call:

Function	Example	Description
setDefaults	swal.setDefaults({ confirmButtonColor: '#0000' });	If you end up using a lot of the same settings when calling SweetAlert, you can use setDefaults at the start of your program to set them once and for all!
close	swal.close();	Close the currently open SweetAlert programatically.
showInputError	swal.showInputError("Invalid email!");	Show an error message after validating the input field, if the user's data is bad
enableButtons, disableButtons	swal.disableButtons();	Disable or enable the user to click on the cancel and confirm buttons.
