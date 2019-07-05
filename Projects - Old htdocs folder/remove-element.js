// Remove an Element
// JS
var thingToRemove = document.querySelectorAll(".remove-me")[0];

thingToRemove.parentNode.removeChild(thingToRemove);

// Empty element, but keep element:

mydiv = document.getElementById('empty-me');
while (mydiv.firstChild) {
  mydiv.removeChild(mydiv.firstChild);
}

Jquery:

$(".remove-me").remove();